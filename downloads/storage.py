import os
import shutil
import uuid

from django.conf import settings
from django.http import HttpResponseBadRequest

ARQUIVOS_DIR = settings.MEDIA_ROOT
ARQUIVOS_DIR.mkdir(parents=True, exist_ok=True)


class InvalidFilename(Exception):
    pass


def sanitize_filename(filename):
    clean_name = os.path.basename(filename or "").strip()
    clean_name = "".join(
        char if char.isalnum() or char in (".", "-", "_") else "_" for char in clean_name
    )
    if not clean_name or clean_name in {".", ".."}:
        raise InvalidFilename("Nome de arquivo invalido")
    return clean_name


def save_uploaded_file(uploaded_file, filename):
    dest = ARQUIVOS_DIR / filename
    if dest.exists():
        filename = f"{uuid.uuid4().hex}_{filename}"
        dest = ARQUIVOS_DIR / filename

    with dest.open("wb") as buffer:
        shutil.copyfileobj(uploaded_file.file, buffer)
    return filename


def delete_file(filename):
    path = ARQUIVOS_DIR / sanitize_filename(filename)
    if path.exists():
        path.unlink()


def file_path(filename):
    return ARQUIVOS_DIR / sanitize_filename(filename)
