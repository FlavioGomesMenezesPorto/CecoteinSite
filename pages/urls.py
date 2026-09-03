from django.urls import path

from . import views

app_name = "pages"

urlpatterns = [
    path("", views.home, name="home"),
    path("sustentabilidade/", views.sustentabilidade, name="sustentabilidade"),
    path("contato/enviar/", views.contact_submit, name="contact"),
]
