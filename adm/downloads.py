"""Servidor de desenvolvimento para a API de downloads.

Este script expõe a aplicação FastAPI definida em `src/backend/main.py`.
Execute `python adm/downloads.py` a partir da pasta do projeto para iniciar o servidor
na porta 8000 (endpoints em /api/*), usado pela página `adm/downloads.html`.
"""

from pathlib import Path
import sys

# garantir que o pacote src esteja no path para importar backend
ROOT = Path(__file__).resolve().parents[1]
SRC = ROOT / "src"
# adicionar raiz do projeto ao path para permitir imports como `adm.*`
sys.path.insert(0, str(ROOT))
sys.path.insert(0, str(SRC))

try:
	from backend import main as backend_main
except Exception as e:
	raise RuntimeError("Não foi possível importar a API em src/backend/main.py: {}".format(e))

app = backend_main.app

def run():
	try:
		import uvicorn
	except Exception:
		raise RuntimeError("Instale 'uvicorn' para executar o servidor: pip install uvicorn")
	uvicorn.run(app, host="0.0.0.0", port=8000)

if __name__ == "__main__":
	run()
