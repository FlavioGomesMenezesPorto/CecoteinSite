from django.http import FileResponse, HttpResponseNotAllowed, JsonResponse, QueryDict
from django.shortcuts import render
from django.utils import timezone
from django.views.decorators.csrf import ensure_csrf_cookie
from django.views.decorators.http import require_GET, require_POST

from .auth import SESSION_ROLE_KEY, role_for_password, role_required
from .models import Download
from .storage import InvalidFilename, delete_file, file_path, save_uploaded_file, sanitize_filename


@ensure_csrf_cookie
def page(request):
    return render(request, "downloads/downloads.html")


@require_POST
def auth(request):
    password = request.POST.get("password", "")
    role = role_for_password(password)
    if not role:
        return JsonResponse({"status": "invalido"})

    request.session.cycle_key()
    request.session[SESSION_ROLE_KEY] = role
    return JsonResponse({"status": role})


@require_GET
def session_info(request):
    return JsonResponse({"role": request.session.get(SESSION_ROLE_KEY)})


@require_POST
def logout(request):
    request.session.flush()
    return JsonResponse({"status": "ok"})


@role_required()
def _list_files(request):
    files = [
        {
            "id": d.cd_down,
            "name": d.nm_down,
            "filename": d.arq_down,
            "created_at": str(d.data_down),
        }
        for d in Download.objects.all()
    ]
    return JsonResponse({"files": files})


@role_required("admin")
def _upload_file(request):
    name = request.POST.get("name", "").strip()
    uploaded = request.FILES.get("file")
    if not name or not uploaded:
        return JsonResponse({"detail": "name e file sao obrigatorios"}, status=400)

    try:
        filename = sanitize_filename(uploaded.name)
    except InvalidFilename:
        return JsonResponse({"detail": "Nome de arquivo invalido"}, status=400)

    saved_filename = save_uploaded_file(uploaded, filename)
    Download.objects.create(nm_down=name, arq_down=saved_filename, data_down=timezone.now())
    return JsonResponse({"status": "ok", "filename": saved_filename})


def files_collection(request):
    if request.method == "GET":
        return _list_files(request)
    if request.method == "POST":
        return _upload_file(request)
    return HttpResponseNotAllowed(["GET", "POST"])


@require_GET
@role_required()
def download_file(request, filename):
    if not Download.objects.filter(arq_down=filename).exists():
        return JsonResponse({"detail": "Arquivo nao encontrado"}, status=404)

    try:
        path = file_path(filename)
    except InvalidFilename:
        return JsonResponse({"detail": "Nome de arquivo invalido"}, status=400)

    if not path.exists():
        return JsonResponse({"detail": "Arquivo nao encontrado no servidor"}, status=404)

    return FileResponse(path.open("rb"), as_attachment=True, filename=filename)


@role_required("admin")
def _update_file(request, file_id):
    data = QueryDict(request.body)
    name = data.get("name", "").strip()
    if not name:
        return JsonResponse({"detail": "name e obrigatorio"}, status=400)

    try:
        record = Download.objects.get(cd_down=file_id)
    except Download.DoesNotExist:
        return JsonResponse({"detail": "Arquivo nao encontrado"}, status=404)

    record.nm_down = name
    record.save(update_fields=["nm_down"])
    return JsonResponse({"status": "updated"})


@role_required("admin")
def _delete_file(request, file_id):
    try:
        record = Download.objects.get(cd_down=file_id)
    except Download.DoesNotExist:
        return JsonResponse({"detail": "Arquivo nao encontrado"}, status=404)

    filename = record.arq_down
    record.delete()
    delete_file(filename)
    return JsonResponse({"status": "deleted"})


def files_item(request, file_id):
    if request.method == "PUT":
        return _update_file(request, file_id)
    if request.method == "DELETE":
        return _delete_file(request, file_id)
    return HttpResponseNotAllowed(["PUT", "DELETE"])
