from django.urls import include, path

urlpatterns = [
    path("", include("pages.urls")),
    path("", include("downloads.urls")),
]
