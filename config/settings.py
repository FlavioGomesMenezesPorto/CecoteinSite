"""
Django settings for the Cecotein site project.
"""

import os
from pathlib import Path

from dotenv import load_dotenv

BASE_DIR = Path(__file__).resolve().parent.parent

load_dotenv(BASE_DIR / ".env")


def _env_list(name, default=""):
    return [item.strip() for item in os.environ.get(name, default).split(",") if item.strip()]


SECRET_KEY = os.environ["DJANGO_SECRET_KEY"]

DEBUG = os.environ.get("DJANGO_DEBUG", "false").strip().lower() == "true"

ALLOWED_HOSTS = _env_list("DJANGO_ALLOWED_HOSTS")

CSRF_TRUSTED_ORIGINS = _env_list("DJANGO_CSRF_TRUSTED_ORIGINS")


# Application definition

INSTALLED_APPS = [
    "django.contrib.staticfiles",
    "django.contrib.sessions",
    "pages",
    "downloads",
]

MIDDLEWARE = [
    "django.middleware.security.SecurityMiddleware",
    "whitenoise.middleware.WhiteNoiseMiddleware",
    "django.contrib.sessions.middleware.SessionMiddleware",
    "django.middleware.common.CommonMiddleware",
    "django.middleware.csrf.CsrfViewMiddleware",
    "django.middleware.clickjacking.XFrameOptionsMiddleware",
]

ROOT_URLCONF = "config.urls"

TEMPLATES = [
    {
        "BACKEND": "django.template.backends.django.DjangoTemplates",
        "DIRS": [],
        "APP_DIRS": True,
        "OPTIONS": {
            "context_processors": [
                "django.template.context_processors.request",
            ],
        },
    },
]

WSGI_APPLICATION = "config.wsgi.application"


# Database
# https://docs.djangoproject.com/en/5.2/ref/settings/#databases

DB_TARGET = os.environ.get("DJANGO_DB_TARGET", "local")
_suffix = "PROD" if DB_TARGET == "prod" else "LOCAL"

DATABASES = {
    "default": {
        # Stock django.db.backends.mysql refuses MySQL < 8.0.11; the real
        # Locaweb DB is 5.6.36 and can't be upgraded here, so this project
        # uses a thin subclass that only lowers the accepted minimum
        # version (see config/mysql_legacy/base.py).
        "ENGINE": "config.mysql_legacy",
        "HOST": os.environ[f"MYSQL_HOST_{_suffix}"],
        "USER": os.environ[f"MYSQL_USER_{_suffix}"],
        "PASSWORD": os.environ.get(f"MYSQL_PASSWORD_{_suffix}", ""),
        "NAME": os.environ[f"MYSQL_DATABASE_{_suffix}"],
        "OPTIONS": {"charset": "utf8mb4"},
    }
}

# tb_downloads.data_down is a naive DATETIME (populated via MySQL NOW()); keep
# Django's datetimes naive too so they compare/display consistently with it.
USE_TZ = False


# Internationalization
# https://docs.djangoproject.com/en/5.2/topics/i18n/

LANGUAGE_CODE = "pt-br"

TIME_ZONE = "America/Sao_Paulo"

USE_I18N = True


# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/5.2/howto/static-files/

STATIC_URL = "static/"
STATICFILES_DIRS = [BASE_DIR / "assets"]
STATIC_ROOT = BASE_DIR / "staticfiles"
STORAGES = {
    "default": {
        "BACKEND": "django.core.files.storage.FileSystemStorage",
    },
    "staticfiles": {
        "BACKEND": "whitenoise.storage.CompressedManifestStaticFilesStorage",
    },
}

# Uploaded download files live here, served only through downloads.views.download_file
# (never exposed as a public MEDIA_URL — that would bypass the session-auth gate).
MEDIA_ROOT = BASE_DIR / "arquivos"

DEFAULT_AUTO_FIELD = "django.db.models.BigAutoField"


# Sessions (replace the old hand-rolled bearer-token + tb_sessions design)

SESSION_ENGINE = "django.contrib.sessions.backends.db"
SESSION_COOKIE_AGE = 60 * 60 * 8  # mirrors the old 8h token TTL
SESSION_SAVE_EVERY_REQUEST = False
SESSION_COOKIE_SECURE = not DEBUG
CSRF_COOKIE_SECURE = not DEBUG


# Email (contact form)

EMAIL_BACKEND = "django.core.mail.backends.smtp.EmailBackend"
EMAIL_HOST = os.environ["SMTP_SERVER"]
EMAIL_PORT = int(os.environ["SMTP_PORT"])
EMAIL_HOST_USER = os.environ["EMAIL_REMETENTE"]
EMAIL_HOST_PASSWORD = os.environ["EMAIL_SENHA"]
EMAIL_USE_TLS = True
DEFAULT_FROM_EMAIL = EMAIL_HOST_USER
CONTACT_DESTINATARIO = os.environ.get("EMAIL_DESTINATARIO", EMAIL_HOST_USER)

# Downloads area auth passwords (shared-secret roles, not per-account)
DOWNLOAD_USER_PASSWORD = os.environ["DOWNLOAD_USER_PASSWORD"]
DOWNLOAD_ADMIN_PASSWORD = os.environ["DOWNLOAD_ADMIN_PASSWORD"]
