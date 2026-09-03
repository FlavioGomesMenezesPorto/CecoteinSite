from django.db import models


class Download(models.Model):
    cd_down = models.AutoField(primary_key=True, db_column="cd_down")
    nm_down = models.CharField(max_length=255, db_column="nm_down")
    arq_down = models.CharField(max_length=255, unique=True, db_column="arq_down")
    data_down = models.DateTimeField(db_column="data_down")

    class Meta:
        managed = False
        db_table = "tb_downloads"
        ordering = ["-data_down"]

    def __str__(self):
        return self.nm_down
