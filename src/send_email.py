import json
import os
import smtplib
import sys
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Carregar dados JSON enviados pelo PHP
try:
    payload = json.load(sys.stdin)
except json.JSONDecodeError:
    print(json.dumps({'success': False, 'message': 'Payload inválido.'}, ensure_ascii=False))
    sys.exit(1)

nome = payload.get('nome', '').strip()
email = payload.get('email', '').strip()
telefone = payload.get('telefone', '').strip()
mensagem = payload.get('mensagem', '').strip()

if not nome or not email or not mensagem:
    print(json.dumps({'success': False, 'message': 'Nome, email e mensagem são obrigatórios.'}, ensure_ascii=False))
    sys.exit(1)

# Configurações de envio de email
SMTP_SERVER = os.environ.get('SMTP_SERVER', 'smtp.gmail.com')
SMTP_PORT = int(os.environ.get('SMTP_PORT', '587'))     
EMAIL_REMETENTE = os.environ.get('EMAIL_REMETENTE', 'seu_email@gmail.com')
EMAIL_SENHA = os.environ.get('EMAIL_SENHA', 'sua_senha_ou_app_password')
EMAIL_DESTINATARIO = os.environ.get('EMAIL_DESTINATARIO', EMAIL_REMETENTE)

msg = MIMEMultipart('alternative')
msg['Subject'] = f'Contato pelo site: {nome}'
msg['From'] = EMAIL_REMETENTE
msg['To'] = EMAIL_DESTINATARIO

html = f"""
<html>
  <body>
    <h2>Novo contato do site</h2>
    <p><strong>Nome:</strong> {nome}</p>
    <p><strong>Email:</strong> {email}</p>
    <p><strong>Telefone:</strong> {telefone or 'Não informado'}</p>
    <p><strong>Mensagem:</strong></p>
    <p>{mensagem.replace(chr(10), '<br>')}</p>
  </body>
</html>
"""

msg.attach(MIMEText(html, 'html'))

try:
    server = smtplib.SMTP(SMTP_SERVER, SMTP_PORT, timeout=30)
    server.starttls()
    server.login(EMAIL_REMETENTE, EMAIL_SENHA)
    server.sendmail(EMAIL_REMETENTE, EMAIL_DESTINATARIO, msg.as_string())
    server.quit()
    print(json.dumps({'success': True, 'message': 'E-mail enviado com sucesso!'}, ensure_ascii=False))
    sys.exit(0)
except Exception as exc:
    print(json.dumps({'success': False, 'message': f'Erro no envio: {exc}'}, ensure_ascii=False))
    sys.exit(1)
