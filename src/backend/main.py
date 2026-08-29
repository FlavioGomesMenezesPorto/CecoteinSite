from fastapi import FastAPI, HTTPException, UploadFile, File, Form, Depends, Header
from fastapi.responses import JSONResponse, FileResponse
from fastapi.middleware.cors import CORSMiddleware
from pathlib import Path
import uuid
import shutil
from typing import Optional
import os

from . import db

app = FastAPI(title="Cecotein Downloads API")

# CORS - allow all for dev; lock down in production
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

PROJECT_ROOT = Path(__file__).resolve().parents[2]
ARQUIVOS_DIR = PROJECT_ROOT / "arquivos"
ARQUIVOS_DIR.mkdir(parents=True, exist_ok=True)

# passwords mapping
PASSWORDS = {
    "CECOTEIN": "user",
    "DEUSSALVA": "admin",
}

# Initialize DB
db.ensure_db()

# dependency to check token
def get_current_role(authorization: Optional[str] = Header(None)):
    if not authorization:
        raise HTTPException(status_code=401, detail="Missing Authorization header")
    if not authorization.lower().startswith("bearer "):
        raise HTTPException(status_code=401, detail="Invalid Authorization header")
    token = authorization.split(" ", 1)[1]
    session = db.get_session(token)
    if not session:
        raise HTTPException(status_code=401, detail="Invalid or expired token")
    return session["role"]

@app.post("/api/auth")
async def auth(password: str = Form(...)):
    password = (password or "").strip().upper()
    role = PASSWORDS.get(password)
    if not role:
        return {"status": "invalido"}
    token = str(uuid.uuid4())
    db.create_session(token, role)
    return {"status": role, "token": token}

@app.get("/api/files")
async def list_files(role: str = Depends(get_current_role)):
    # both user and admin allowed
    files = db.list_downloads()
    return {"files": files}

@app.get("/api/files/download/{filename}")
async def download_file(filename: str, role: str = Depends(get_current_role)):
    # check file present in db and on disk
    rec = db.get_download_by_filename(filename)
    if not rec:
        raise HTTPException(status_code=404, detail="Arquivo não encontrado")
    path = ARQUIVOS_DIR / filename
    if not path.exists():
        raise HTTPException(status_code=404, detail="Arquivo não encontrado no servidor")
    return FileResponse(str(path), media_type="application/octet-stream", filename=filename)

@app.post("/api/files")
async def upload_file(name: str = Form(...), file: UploadFile = File(...), role: str = Depends(get_current_role)):
    if role != "admin":
        raise HTTPException(status_code=403, detail="Permissão negada")
    # sanitize filename
    filename = os.path.basename(file.filename)
    filename = "".join(c if c.isalnum() or c in (".", "-", "_") else "_" for c in filename)
    dest = ARQUIVOS_DIR / filename
    # avoid overwrite: if exists, append uuid
    if dest.exists():
        filename = f"{uuid.uuid4().hex}_{filename}"
        dest = ARQUIVOS_DIR / filename
    with dest.open("wb") as buffer:
        shutil.copyfileobj(file.file, buffer)
    db.add_download(name, filename)
    return {"status": "ok", "filename": filename}

@app.delete("/api/files/{file_id}")
async def delete_file(file_id: int, role: str = Depends(get_current_role)):
    if role != "admin":
        raise HTTPException(status_code=403, detail="Permissão negada")
    rec = db.get_download_by_id(file_id)
    if not rec:
        raise HTTPException(status_code=404, detail="Arquivo não encontrado")
    path = ARQUIVOS_DIR / rec["filename"]
    try:
        if path.exists():
            path.unlink()
        db.delete_download(file_id)
    except Exception as e:
        raise HTTPException(status_code=500, detail="Erro ao excluir arquivo")
    return {"status": "deleted"}

@app.put("/api/files/{file_id}")
async def update_file(file_id: int, name: str = Form(...), role: str = Depends(get_current_role)):
    if role != "admin":
        raise HTTPException(status_code=403, detail="Permissão negada")
    rec = db.get_download_by_id(file_id)
    if not rec:
        raise HTTPException(status_code=404, detail="Arquivo não encontrado")
    try:
        db.update_download(file_id, name)
    except Exception as e:
        raise HTTPException(status_code=500, detail="Erro ao atualizar arquivo")
    return {"status": "updated"}

# simple health check
@app.get("/api/health")
async def health():
    return {"status": "ok"}


@app.get("/api/debug-db")
async def debug_db():
    try:
        ok = db._get_mysql_conn() is not None
        cnt = len(db.list_downloads())
        return {"mysql_connected": ok, "downloads_count": cnt}
    except Exception as e:
        return {"error": str(e)}


@app.get("/api/debug-connect")
async def debug_connect():
    try:
        from adm.conectaLocaweb import conectar_bd
        try:
            c = conectar_bd(is_production=False)
            c.close()
            return {"local": True}
        except Exception as e:
            local_err = str(e)
        try:
            c = conectar_bd(is_production=True)
            c.close()
            return {"production": True}
        except Exception as e:
            prod_err = str(e)
        return {"local_error": local_err, "prod_error": prod_err}
    except Exception as e:
        return {"error_import": str(e)}
