# Cecotein Site

Site institucional da Cecotein, implementado em Django. Serve as páginas
públicas (home, sustentabilidade, formulário de contato por e-mail) e uma
área de downloads protegida por senha (papéis `user`/`admin`) que lê e
grava na tabela legada `tb_downloads` de um MySQL 5.6 hospedado na Locaweb.

## Estrutura

- `config/` — settings, URLs raiz e o backend `config.mysql_legacy`, uma
  subclasse do backend MySQL do Django que só reduz a versão mínima aceita
  (5.6 em vez de 8.0.11) para falar com o banco legado da Locaweb.
- `pages/` — home, página de sustentabilidade e endpoint de contato
  (`pages/views.py`) que envia e-mail via SMTP.
- `downloads/` — área de downloads: autenticação por senha compartilhada
  (`downloads/auth.py`), armazenamento de arquivo (`downloads/storage.py`)
  e o model `Download`, mapeado (`managed = False`) para `tb_downloads`.
- `assets/` — imagens estáticas de origem; `staticfiles/` é gerado por
  `collectstatic` (whitenoise) e não deve ser editado à mão.
- `arquivos/` — armazenamento dos arquivos enviados pela área de
  downloads (`MEDIA_ROOT`); nunca é exposto por URL pública, só através de
  `downloads.views.download_file`, que exige sessão autenticada.

## Setup local

1. Crie e ative um virtualenv, depois instale as dependências:

   ```bash
   python -m venv .venv
   .venv/Scripts/activate        # Windows
   pip install -r requirements.txt
   ```

2. Copie `.env.example` para `.env` e preencha os valores (credenciais do
   MySQL local, senhas da área de downloads, SMTP, `DJANGO_SECRET_KEY`
   etc.). Com `DJANGO_DB_TARGET=local`, o projeto usa
   `MYSQL_*_LOCAL`; com `prod`, usa `MYSQL_*_PROD`.

3. O banco (`tb_downloads`, sessões) precisa existir antes de rodar as
   migrations, já que `Download` é `managed = False` — ele só é lido, não
   criado pelo Django. Aplique as migrations do Django (sessões):

   ```bash
   python manage.py migrate
   ```

4. Rode o servidor de desenvolvimento:

   ```bash
   python manage.py runserver
   ```

5. Rode os testes:

   ```bash
   python manage.py test
   ```

## Deploy

Produção usa `DJANGO_DEBUG=false`, `DJANGO_DB_TARGET=prod` e
`DJANGO_ALLOWED_HOSTS`/`DJANGO_CSRF_TRUSTED_ORIGINS` apontando para o
domínio real. Arquivos estáticos são servidos via whitenoise
(`CompressedManifestStaticFilesStorage`); rode `collectstatic` antes de
publicar:

```bash
python manage.py collectstatic --noinput
```
