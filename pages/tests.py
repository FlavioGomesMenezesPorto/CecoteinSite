from unittest.mock import patch

from django.core import mail
from django.test import SimpleTestCase, override_settings
from django.urls import reverse

# Template rendering pulls in {% static %}, which needs whitenoise's
# collectstatic manifest. Swap in the plain (non-manifest) storage here so
# these tests check view/template wiring, not whether collectstatic has
# been run.
_STORAGES_WITHOUT_MANIFEST = {
    "default": {"BACKEND": "django.core.files.storage.FileSystemStorage"},
    "staticfiles": {"BACKEND": "django.contrib.staticfiles.storage.StaticFilesStorage"},
}


@override_settings(STORAGES=_STORAGES_WITHOUT_MANIFEST)
class HomeViewTests(SimpleTestCase):
    def test_home_renders(self):
        response = self.client.get(reverse("pages:home"))
        self.assertEqual(response.status_code, 200)
        self.assertTemplateUsed(response, "pages/home.html")

    def test_sustentabilidade_renders(self):
        response = self.client.get(reverse("pages:sustentabilidade"))
        self.assertEqual(response.status_code, 200)
        self.assertTemplateUsed(response, "pages/sustentabilidade.html")


class ContactSubmitTests(SimpleTestCase):
    def test_get_not_allowed(self):
        response = self.client.get(reverse("pages:contact"))
        self.assertEqual(response.status_code, 405)

    def test_missing_required_fields_returns_error(self):
        response = self.client.post(reverse("pages:contact"), {"nome": "Joao"})
        self.assertEqual(response.status_code, 200)
        self.assertFalse(response.json()["success"])
        self.assertEqual(len(mail.outbox), 0)

    def test_valid_submission_sends_email(self):
        response = self.client.post(
            reverse("pages:contact"),
            {
                "nome": "Joao",
                "email": "joao@example.com",
                "telefone": "11999999999",
                "mensagem": "Ola, gostaria de um orcamento.",
            },
        )
        self.assertEqual(response.status_code, 200)
        self.assertTrue(response.json()["success"])
        self.assertEqual(len(mail.outbox), 1)
        self.assertEqual(mail.outbox[0].reply_to, ["joao@example.com"])

    def test_email_send_failure_returns_error_without_raising(self):
        with patch(
            "django.core.mail.message.EmailMultiAlternatives.send",
            side_effect=Exception("smtp down"),
        ):
            response = self.client.post(
                reverse("pages:contact"),
                {"nome": "Joao", "email": "joao@example.com", "mensagem": "Oi"},
            )
        self.assertEqual(response.status_code, 200)
        self.assertFalse(response.json()["success"])
