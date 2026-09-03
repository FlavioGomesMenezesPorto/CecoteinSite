from unittest.mock import MagicMock, patch

from django.core.files.uploadedfile import SimpleUploadedFile
from django.test import SimpleTestCase, override_settings
from django.urls import reverse

from .auth import role_for_password
from .storage import InvalidFilename, sanitize_filename

# The `Download` model maps to the unmanaged legacy table `tb_downloads`
# (MySQL 5.6 on Locaweb); the local MySQL user has no CREATE DATABASE
# privilege to spin up a Django test database against it. These tests
# exercise the view/auth/storage logic in isolation instead, mocking the
# model and using a DB-free session backend.
TEST_SESSION_ENGINE = "django.contrib.sessions.backends.signed_cookies"


@override_settings(
    SESSION_ENGINE=TEST_SESSION_ENGINE,
    DOWNLOAD_USER_PASSWORD="user-secret",
    DOWNLOAD_ADMIN_PASSWORD="admin-secret",
)
class DownloadsSimpleTestCase(SimpleTestCase):
    pass


class RoleForPasswordTests(SimpleTestCase):
    @override_settings(DOWNLOAD_USER_PASSWORD="user-secret", DOWNLOAD_ADMIN_PASSWORD="admin-secret")
    def test_matches_user_password(self):
        self.assertEqual(role_for_password("user-secret"), "user")

    @override_settings(DOWNLOAD_USER_PASSWORD="user-secret", DOWNLOAD_ADMIN_PASSWORD="admin-secret")
    def test_matches_admin_password(self):
        self.assertEqual(role_for_password("admin-secret"), "admin")

    @override_settings(DOWNLOAD_USER_PASSWORD="user-secret", DOWNLOAD_ADMIN_PASSWORD="admin-secret")
    def test_rejects_wrong_or_empty_password(self):
        self.assertIsNone(role_for_password("wrong"))
        self.assertIsNone(role_for_password(""))
        self.assertIsNone(role_for_password(None))


class SanitizeFilenameTests(SimpleTestCase):
    def test_strips_directory_and_odd_characters(self):
        self.assertEqual(sanitize_filename("../../etc/passwd"), "passwd")
        self.assertEqual(sanitize_filename("my report (final).pdf"), "my_report__final_.pdf")

    def test_rejects_empty_or_dot_names(self):
        for bad in ("", ".", ".."):
            with self.assertRaises(InvalidFilename):
                sanitize_filename(bad)


class AuthEndpointTests(DownloadsSimpleTestCase):
    def test_invalid_password_does_not_create_session(self):
        response = self.client.post(reverse("downloads:auth"), {"password": "wrong"})
        self.assertEqual(response.status_code, 200)
        self.assertEqual(response.json(), {"status": "invalido"})
        self.assertEqual(self.client.get(reverse("downloads:session")).json()["role"], None)

    def test_valid_user_password_creates_user_session(self):
        response = self.client.post(reverse("downloads:auth"), {"password": "user-secret"})
        self.assertEqual(response.json(), {"status": "user"})
        self.assertEqual(self.client.get(reverse("downloads:session")).json(), {"role": "user"})

    def test_valid_admin_password_creates_admin_session(self):
        response = self.client.post(reverse("downloads:auth"), {"password": "admin-secret"})
        self.assertEqual(response.json(), {"status": "admin"})

    def test_logout_clears_session(self):
        self.client.post(reverse("downloads:auth"), {"password": "user-secret"})
        self.client.post(reverse("downloads:logout"))
        self.assertIsNone(self.client.get(reverse("downloads:session")).json()["role"])


class FilesCollectionTests(DownloadsSimpleTestCase):
    def test_list_without_session_is_401(self):
        response = self.client.get(reverse("downloads:files_collection"))
        self.assertEqual(response.status_code, 401)

    @patch("downloads.views.Download")
    def test_list_with_session_returns_files(self, mock_download):
        record = MagicMock(cd_down=1, nm_down="Catalogo", arq_down="catalogo.pdf", data_down="2026-01-01")
        mock_download.objects.all.return_value = [record]

        self.client.post(reverse("downloads:auth"), {"password": "user-secret"})
        response = self.client.get(reverse("downloads:files_collection"))

        self.assertEqual(response.status_code, 200)
        self.assertEqual(
            response.json()["files"],
            [{"id": 1, "name": "Catalogo", "filename": "catalogo.pdf", "created_at": "2026-01-01"}],
        )

    def test_upload_as_non_admin_is_403(self):
        self.client.post(reverse("downloads:auth"), {"password": "user-secret"})
        response = self.client.post(reverse("downloads:files_collection"), {"name": "x"})
        self.assertEqual(response.status_code, 403)

    @patch("downloads.views.Download")
    @patch("downloads.views.save_uploaded_file", return_value="catalogo.pdf")
    def test_upload_as_admin_creates_record(self, mock_save, mock_download):
        self.client.post(reverse("downloads:auth"), {"password": "admin-secret"})
        upload = SimpleUploadedFile("catalogo.pdf", b"pdf-bytes")

        response = self.client.post(
            reverse("downloads:files_collection"), {"name": "Catalogo", "file": upload}
        )

        self.assertEqual(response.status_code, 200)
        self.assertEqual(response.json(), {"status": "ok", "filename": "catalogo.pdf"})
        mock_download.objects.create.assert_called_once()
        self.assertEqual(mock_download.objects.create.call_args.kwargs["arq_down"], "catalogo.pdf")

    def test_upload_missing_fields_is_400(self):
        self.client.post(reverse("downloads:auth"), {"password": "admin-secret"})
        response = self.client.post(reverse("downloads:files_collection"), {})
        self.assertEqual(response.status_code, 400)


class DownloadFileTests(DownloadsSimpleTestCase):
    def test_requires_session(self):
        response = self.client.get(reverse("downloads:download_file", args=["catalogo.pdf"]))
        self.assertEqual(response.status_code, 401)

    @patch("downloads.views.Download")
    def test_unknown_filename_is_404(self, mock_download):
        mock_download.objects.filter.return_value.exists.return_value = False
        self.client.post(reverse("downloads:auth"), {"password": "user-secret"})

        response = self.client.get(reverse("downloads:download_file", args=["missing.pdf"]))

        self.assertEqual(response.status_code, 404)


class FilesItemTests(DownloadsSimpleTestCase):
    @patch("downloads.views.Download")
    def test_update_as_admin_renames_file(self, mock_download):
        record = MagicMock()
        mock_download.objects.get.return_value = record
        self.client.post(reverse("downloads:auth"), {"password": "admin-secret"})

        response = self.client.put(
            reverse("downloads:files_item", args=[1]),
            data="name=Novo+Nome",
            content_type="application/x-www-form-urlencoded",
        )

        self.assertEqual(response.status_code, 200)
        self.assertEqual(record.nm_down, "Novo Nome")
        record.save.assert_called_once_with(update_fields=["nm_down"])

    def test_update_as_non_admin_is_403(self):
        self.client.post(reverse("downloads:auth"), {"password": "user-secret"})
        response = self.client.put(
            reverse("downloads:files_item", args=[1]),
            data="name=x",
            content_type="application/x-www-form-urlencoded",
        )
        self.assertEqual(response.status_code, 403)

    @patch("downloads.views.delete_file")
    @patch("downloads.views.Download")
    def test_delete_as_admin_removes_record_and_file(self, mock_download, mock_delete_file):
        record = MagicMock(arq_down="catalogo.pdf")
        mock_download.objects.get.return_value = record
        self.client.post(reverse("downloads:auth"), {"password": "admin-secret"})

        response = self.client.delete(reverse("downloads:files_item", args=[1]))

        self.assertEqual(response.status_code, 200)
        record.delete.assert_called_once()
        mock_delete_file.assert_called_once_with("catalogo.pdf")
