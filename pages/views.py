from django.conf import settings
from django.core.mail import EmailMultiAlternatives
from django.http import JsonResponse
from django.shortcuts import render
from django.template.loader import render_to_string
from django.views.decorators.http import require_POST


def home(request):
    return render(request, "pages/home.html")


def sustentabilidade(request):
    return render(request, "pages/sustentabilidade.html")


@require_POST
def contact_submit(request):
    nome = request.POST.get("nome", "").strip()
    email = request.POST.get("email", "").strip()
    telefone = request.POST.get("telefone", "").strip()
    mensagem = request.POST.get("mensagem", "").strip()

    if not nome or not email or not mensagem:
        return JsonResponse(
            {"success": False, "message": "Nome, email e mensagem sao obrigatorios."}
        )

    context = {"nome": nome, "email": email, "telefone": telefone, "mensagem": mensagem}
    html_body = render_to_string("pages/_contact_email.html", context)
    text_body = (
        f"Nome: {nome}\nEmail: {email}\nTelefone: {telefone or 'Nao informado'}\n\n{mensagem}"
    )

    try:
        msg = EmailMultiAlternatives(
            subject=f"Contato pelo site: {nome}",
            body=text_body,
            from_email=settings.DEFAULT_FROM_EMAIL,
            to=[settings.CONTACT_DESTINATARIO],
            reply_to=[email],
        )
        msg.attach_alternative(html_body, "text/html")
        msg.send()
        return JsonResponse({"success": True, "message": "E-mail enviado com sucesso!"})
    except Exception as exc:
        return JsonResponse({"success": False, "message": f"Erro no envio: {exc}"})
