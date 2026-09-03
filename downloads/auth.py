import secrets
from functools import wraps

from django.conf import settings
from django.http import JsonResponse

SESSION_ROLE_KEY = "download_role"

AUTH_PASSWORDS = {
    "user": lambda: settings.DOWNLOAD_USER_PASSWORD,
    "admin": lambda: settings.DOWNLOAD_ADMIN_PASSWORD,
}


def role_for_password(password):
    submitted = (password or "").strip()
    if not submitted:
        return None

    for role, get_expected in AUTH_PASSWORDS.items():
        if secrets.compare_digest(submitted, get_expected()):
            return role
    return None


def role_required(min_role=None):
    def decorator(view):
        @wraps(view)
        def wrapped(request, *args, **kwargs):
            role = request.session.get(SESSION_ROLE_KEY)
            if not role:
                return JsonResponse({"detail": "Missing session"}, status=401)
            if min_role == "admin" and role != "admin":
                return JsonResponse({"detail": "Permissao negada"}, status=403)
            return view(request, *args, **kwargs)

        return wrapped

    return decorator
