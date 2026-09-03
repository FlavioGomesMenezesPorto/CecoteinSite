"""
Django's stock MySQL backend refuses to connect to anything older than
MySQL 8.0.11. The real Locaweb-hosted database this project must use is
MySQL 5.6.36 (legacy, shared with the old SIG-2000 system) and cannot be
upgraded as part of this migration. This backend only lowers the accepted
minimum version so Django will talk to it; everything else is stock
django.db.backends.mysql.
"""

from django.db.backends.mysql.base import DatabaseWrapper as MySQLDatabaseWrapper
from django.db.backends.mysql.features import DatabaseFeatures as MySQLDatabaseFeatures


class DatabaseFeatures(MySQLDatabaseFeatures):
    minimum_database_version = (5, 6)


class DatabaseWrapper(MySQLDatabaseWrapper):
    features_class = DatabaseFeatures
