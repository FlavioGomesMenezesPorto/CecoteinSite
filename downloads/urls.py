from django.urls import path

from . import views

app_name = "downloads"

urlpatterns = [
    path("downloads/", views.page, name="page"),
    path("api/auth", views.auth, name="auth"),
    path("api/session", views.session_info, name="session"),
    path("api/logout", views.logout, name="logout"),
    path("api/files", views.files_collection, name="files_collection"),
    path("api/files/download/<str:filename>", views.download_file, name="download_file"),
    path("api/files/<int:file_id>", views.files_item, name="files_item"),
]
