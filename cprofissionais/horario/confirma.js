function botao()
{
  decisao = confirm("Clique em um botão!");
  if (decisao){
	document.moderador.variavel.value = "true";
  } else {
	document.moderador.variavel.value = "false";
  }
}