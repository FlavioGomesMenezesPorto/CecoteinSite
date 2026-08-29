# Cecotein Downloads API (FastAPI)

Esta API fornece endpoints simples para autenticação, listagem, download, upload e exclusão de arquivos usados pela interface de Downloads.

Como rodar (dev):

1. Instale dependências (recomendado em virtualenv):

```bash
pip install -r src/backend/requirements.txt
```

2. Execute o servidor:

```bash
uvicorn src.backend.main:app --reload --port 8000
```

A API ficará disponível em `http://localhost:8000`.

Endpoints principais:

- `POST /api/auth` (form-data: `password`) -> `{status: "user"|"admin"|"invalido", token}`
- `GET /api/files` (Bearer token) -> `{files: [...]}`
- `GET /api/files/download/{filename}` (Bearer token) -> arquivo
- `POST /api/files` (form-data: `name`, `file`) (admin) -> adiciona arquivo
- `DELETE /api/files/{id}` (admin) -> remove arquivo

Arquivos enviados ficam na pasta `arquivos/` na raiz do projeto.

