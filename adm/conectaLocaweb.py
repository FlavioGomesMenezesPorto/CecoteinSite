import mysql.connector


def conectar_bd(is_production=False):
    # Configurações padrão (Localhost)
    dbhost = "localhost"
    dbuser = "root"
    dbpasswd = ""
    database = "[REDACTED_DB_USERNAME]"

    # Se for ambiente de produção
    if is_production:
        dbhost = "177.153.63.66"
        dbuser = "[REDACTED_DB_USERNAME]"
        dbpasswd = "Cecote1212#"
        database = "[REDACTED_DB_USERNAME]"

    # Cria a conexão
    conexao = mysql.connector.connect(
        host=dbhost, user=dbuser, password=dbpasswd, database=database
    )

    return conexao


# --- BLOCO DE TESTE ---
if __name__ == "__main__":
    try:
        print("Tentando conectar ao banco de dados...")
        # Definido como True para testar o servidor remoto da Locaweb
        db = conectar_bd(is_production=True)

        if db.is_connected():
            info = db.server_info  # Propriedade atualizada sem aviso de depreciação
            print(f"✅ Conexão estabelecida com sucesso! Versão do MySQL: {info}")

            cursor = db.cursor()

            # 1. Confirma qual banco de dados está ativo
            cursor.execute("SELECT DATABASE();")
            banco_atual = cursor.fetchone()
            print(f"✅ Banco selecionado: {banco_atual[0]}\n")

            # 2. Lista todas as tabelas do banco
            cursor.execute("SHOW TABLES;")
            tabelas = cursor.fetchall()

            print("📋 Tabelas encontradas:")
            print("-" * 35)
            for tabela in tabelas:
                print(f"  - {tabela[0]}")
            print("-" * 35)

            cursor.close()
            db.close()
            print("\n🔒 Conexão fechada com segurança.")

    except mysql.connector.Error as err:
        print(f"❌ Erro ao conectar ao MySQL: {err}")