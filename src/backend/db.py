from typing import List, Dict, Optional
import time
import traceback

# tentar usar a conexão do arquivo adm/conectaLocaweb.py (MySQL)
try:
    from adm.conectaLocaweb import conectar_bd
except Exception:
    conectar_bd = None

SESSION_TTL = 60 * 60 * 8  # 8 hours


def _get_mysql_conn():
    if not conectar_bd:
        return None
    # tenta conexão local, se falhar tenta produção
    try:
        return conectar_bd(is_production=False)
    except Exception:
        try:
            return conectar_bd(is_production=True)
        except Exception:
            return None


def ensure_db():
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute(
            """
            CREATE TABLE IF NOT EXISTS tb_sessions (
                token VARCHAR(255) PRIMARY KEY,
                role VARCHAR(50) NOT NULL,
                expires_at BIGINT NOT NULL
            )
            """
        )
        cur.execute(
            """
            CREATE TABLE IF NOT EXISTS tb_downloads (
                cd_down INT AUTO_INCREMENT PRIMARY KEY,
                nm_down VARCHAR(255) NOT NULL,
                arq_down VARCHAR(255) NOT NULL UNIQUE,
                data_down DATETIME NOT NULL
            )
            """
        )
        conn.commit()
        cur.close()
        conn.close()


def add_download(name: str, filename: str):
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute(
            "INSERT INTO tb_downloads (nm_down, arq_down, data_down) VALUES (%s,%s,NOW())",
            (name, filename),
        )
        conn.commit()
        cur.close()
        conn.close()


def list_downloads() -> List[Dict]:
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("SELECT cd_down, nm_down, arq_down, data_down FROM tb_downloads ORDER BY data_down DESC")
        rows = cur.fetchall()
        cur.close()
        conn.close()
        return [{"id": r[0], "name": r[1], "filename": r[2], "created_at": str(r[3])} for r in rows]
    return []


def get_download_by_id(did: int) -> Optional[Dict]:
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("SELECT cd_down, nm_down, arq_down, data_down FROM tb_downloads WHERE cd_down=%s", (did,))
        row = cur.fetchone()
        cur.close()
        conn.close()
        if not row:
            return None
        return {"id": row[0], "name": row[1], "filename": row[2], "created_at": str(row[3])}
    return None


def get_download_by_filename(filename: str) -> Optional[Dict]:
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("SELECT cd_down, nm_down, arq_down, data_down FROM tb_downloads WHERE arq_down=%s", (filename,))
        row = cur.fetchone()
        cur.close()
        conn.close()
        if not row:
            return None
        return {"id": row[0], "name": row[1], "filename": row[2], "created_at": str(row[3])}
    return None


def delete_download(did: int):
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("DELETE FROM tb_downloads WHERE cd_down=%s", (did,))
        conn.commit()
        cur.close()
        conn.close()


def create_session(token: str, role: str):
    expires = int(time.time()) + SESSION_TTL
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("REPLACE INTO tb_sessions (token, role, expires_at) VALUES (%s,%s,%s)", (token, role, expires))
        conn.commit()
        cur.close()
        conn.close()


def get_session(token: str) -> Optional[Dict]:
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("SELECT token, role, expires_at FROM tb_sessions WHERE token=%s", (token,))
        row = cur.fetchone()
        cur.close()
        conn.close()
        if not row:
            return None
        if int(row[2]) < int(time.time()):
            return None
        return {"token": row[0], "role": row[1], "expires_at": row[2]}
    return None


def update_download(did: int, new_name: str):
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("UPDATE tb_downloads SET nm_down=%s WHERE cd_down=%s", (new_name, did))
        conn.commit()
        cur.close()
        conn.close()


def delete_session(token: str):
    conn = _get_mysql_conn()
    if conn:
        cur = conn.cursor()
        cur.execute("DELETE FROM tb_sessions WHERE token=%s", (token,))
        conn.commit()
        cur.close()
        conn.close()
