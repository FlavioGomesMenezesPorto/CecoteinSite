<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Cadastro de Profissionais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>        
			var aAbas       = new Array();  // Lista de abas do documento atual
			var sAbaAtiva   = ""            // Define qual é a aba ativa no momento
			var ABA_ID      = 1
			var ABA_BLOCO   = 2
			var ABA_CAMPOS  = 3
    function defineAba( sId, sBloco )
			{
			   var aAba  = new Array( ABA_CAMPOS );
			   aAba[ ABA_ID    ]  = sId;
			   aAba[ ABA_BLOCO ]  = sBloco;
			   aAbas.push( aAba );
			}
	
			function defineAbaAtiva( sId )
			{
			   trataCliqueAba( sId );
			}
	
			function trataMouseAba( oAba )
			{
			   oAba.style.cursor  = "pointer";
			}
	
			function trataCliqueAba( sId )
			{
			   for ( var iAba  = 0; iAba < aAbas.length; iAba++ )
			   {
				  var aAba  = aAbas[ iAba ];
				  if ( aAba[ ABA_ID ] == sId ) ativaAba( aAba );
				  else inativaAba( aAba );
			   }
			}
	
			function ativaAba( aAba )
			{
			   var sAba       = aAba[ ABA_ID ];
			   var oAba       = document.getElementById( sAba );
			   mudaClasse( oAba, "abaativa" ); // Esse comando chama a classe css para fazer a troca
	
			   var sBlocoAba  = aAba[ ABA_BLOCO ];
			   var oBlocoAba  = document.getElementById( sBlocoAba );
			   oBlocoAba.style.display  = "block";
			}
	
			function inativaAba( aAba )
			{
			   var sAba       = aAba[ ABA_ID ];
			   var oAba       = document.getElementById( sAba );
			   mudaClasse( oAba, "abainativa" ); // Esse comando chama a classe css para fazer a troca
	
			   var sBlocoAba  = aAba[ ABA_BLOCO ];
			   var oBlocoAba  = document.getElementById( sBlocoAba );
			   oBlocoAba.style.display  = "none";
			}
			
			function mudaClasse( oObjeto, sClasse )
			{
			   oObjeto.className  = sClasse;
			}
</script>
</head>
<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
	include '../funcoes/conecta.php';
	include '../funcoes/funcoes.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	$p = $_GET['valor'];
	if(isset($_COOKIE['pro']))
	{
		$id = $_COOKIE["pro"];
	}
	else{
		$id = 0;
	}
	//echo(';;;;;;;;'.$p);
	if ($p == 'cli') {
$pesquisa = mysql_query("Select nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, foto_pro, nasc_pro,  cpf_pro, observacao_pro, man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem, mostrar_grade, tipo, empresa from cadastro_profissionais2 where id_pro = '$id'");

	}
	if ($p == 'pro') {
		$pesquisa = mysql_query("Select nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, foto_pro, nasc_pro,  cpf_pro, observacao_pro, man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem, mostrar_grade, tipo, empresa from cadastro_profissionais where id_pro = '$id'");
	}
	$ver = mysql_fetch_row($pesquisa);

echo('   <!-- Criação das abas -->
                        	<table width="63%" border="0" cellpadding="0" cellspacing="1">
							
                                <tr>
                                    <td width="10%" height="36" align="center" valign="middle" class="abaativa" id="celAbaManha" onClick="trataCliqueAba( this.id );" onMouseOver="trataMouseAba( this );"> Manhã </td>
                                    
                                    <td id="celAbaTarde" align="center" valign="middle" width="10%" class="abainativa" onMouseOver="trataMouseAba( this );" onClick="trataCliqueAba( this.id );"> Tarde </td>
                                    
                                    <td id="celAbaNoite" align="center" valign="middle" width="10%" class="abainativa" onMouseOver="trataMouseAba( this );" onClick="trataCliqueAba( this.id );"> Noite </td>
                                    
                                    <td id="celAbaMadrugada" align="center" valign="middle" width="10%" class="abainativa" onMouseOver="trataMouseAba( this );" onClick="trataCliqueAba( this.id );"> Madrugada </td>
                                </tr>
                        	</table>
                            <br>
                            <!-- Criação o conteúdo da aba manhã -->
                           <div id="Manha" style="display: block">
                                <table border="0" width="63%">
                                    <tr>
                                        <td align="center"><font color="#20B2AA"> <b>Dias da semana </b> </font> </td>
                                        <td align="center"><font color="#20B2AA"> <b>De </b> </font> </td>
                                        <td align="center"><font color="#20B2AA"> <b>Até </b></font></td>
                                        <td align="center"><font color="#20B2AA"> <b>Período </b> </font></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"><font color="#FFFFFF"> Segunda-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_seg_de" title="Hora de início do período" size="7" value="'.$ver[14].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_seg_ate" title="Hora de término" size="7" value="'.$ver[15].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_seg_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[16].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Terça-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_ter_de" title="Hora de início do período" size="7" value="'.$ver[17].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_ter_ate" title="Hora de término" size="7" value="'.$ver[18].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_ter_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[19].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quarta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qua_de" title="Hora de início do período" size="7" value="'.$ver[20].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qua_ate" title="Hora de término" size="7" value="'.$ver[21].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qua_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[22].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quinta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qui_de" title="Hora de início do período" size="7" value="'.$ver[23].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qui_ate" title="Hora de término" size="7" value="'.$ver[24].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_qui_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[25].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sexta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sex_de" title="Hora de início do período" size="7" value="'.$ver[26].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sex_ate" title="Hora de término" size="7" value="'.$ver[27].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sex_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[28].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sábado </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sab_de" title="Hora de início do período" size="7" value="'.$ver[29].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sab_ate" title="Hora de término" size="7" value="'.$ver[30].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_sab_tem" title="De quanto em quanto tempo será criado o compromisso" size="10"value="'.$ver[31].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Domingo </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_dom_de" title="Hora de início do período" size="7" value="'.$ver[32].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_dom_ate" title="Hora de término" size="7" value="'.$ver[33].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="man_dom_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[34].'"></td>
                                    </tr>
                              </table>
                            </div> <!-- Fecha a div Manha -->
                            <div id="Tarde" style="display: none">
                            <!-- Criação do conteudo da div Tarde -->
                                <table border="0" width="63%">
                                    <tr>
                                        <td align="center"> <font color="#20B2AA"> <b> Dias da semana </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> De </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> Até </b></font></td>
                                        <td align="center"> <font color="#20B2AA"> <b> Período </b> </font></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Segunda-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_seg_de" title="Hora de início do período" size="7" value="'.$ver[35].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_seg_ate" title="Hora de término" size="7" value="'.$ver[36].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_seg_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[37].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Terça-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_ter_de" title="Hora de início do período" size="7" value="'.$ver[38].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_ter_ate" title="Hora de término" size="7" value="'.$ver[39].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_ter_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[40].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quarta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qua_de" title="Hora de início do período" size="7" value="'.$ver[41].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qua_ate" title="Hora de término" size="7" value="'.$ver[42].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qua_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[43].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quinta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qui_de" title="Hora de início do período" size="7" value="'.$ver[44].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qui_ate" title="Hora de término" size="7" value="'.$ver[45].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_qui_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[46].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sexta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sex_de" title="Hora de início do período" size="7" value="'.$ver[47].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sex_ate" title="Hora de término" size="7" value="'.$ver[48].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sex_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[49].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sábado </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sab_de" title="Hora de início do período" size="7" value="'.$ver[50].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sab_ate" title="Hora de término" size="7" value="'.$ver[51].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_sab_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[52].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Domingo </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_dom_de" title="Hora de início do período" size="7" value="'.$ver[53].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_dom_ate" title="Hora de término" size="7" value="'.$ver[54].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="tar_dom_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[55].'"></td>
                                    </tr>
                              </table>
                            </div> <!-- Fecha a div Tarde -->
                             <div id="Noite" style="display: none">
                             <!-- Criação da div Noite -->
                                <table border="0" width="63%">
                                    <tr>
                                        <td align="center"> <font color="#20B2AA"> <b> Dias da semana </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> De </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> Até </b></font></td>
                                        <td align="center"> <font color="#20B2AA"> <b> Período </b> </font></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Segunda-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_seg_de" title="Hora de início do período" size="7" value="'.$ver[56].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_seg_ate" title="Hora de término" size="7" value="'.$ver[57].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_seg_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[58].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Terça-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_ter_de" title="Hora de início do período" size="7" value="'.$ver[59].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_ter_ate" title="Hora de término" size="7" value="'.$ver[60].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_ter_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[61].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quarta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qua_de" title="Hora de início do período" size="7" value="'.$ver[62].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qua_ate" title="Hora de término" size="7" value="'.$ver[63].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qua_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[64].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quinta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qui_de" title="Hora de início do período" size="7" value="'.$ver[65].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qui_ate" title="Hora de término" size="7" value="'.$ver[66].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_qui_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[67].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sexta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sex_de" title="Hora de início do período" size="7" value="'.$ver[68].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sex_ate" title="Hora de término" size="7" value="'.$ver[69].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sex_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[70].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sábado </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sab_de" title="Hora de início do período" size="7" value="'.$ver[71].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sab_ate" title="Hora de término" size="7" value="'.$ver[72].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_sab_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[73].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Domingo </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_dom_de" title="Hora de início do período" size="7" value="'.$ver[74].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_dom_ate" title="Hora de término" size="7" value="'.$ver[75].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="noi_dom_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[76].'"></td>
                                    </tr>
                              </table>
                            </div> <!-- Fecha a div Noite -->
                            <div id="Madrugada" style="display: none">
                            <!-- Criação do conteudo da div Madrugada -->
                                <table border="0" width="63%">
                                    <tr>
                                        <td align="center"> <font color="#20B2AA"> <b> Dias da semana </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> De </b> </font> </td>
                                        <td align="center"> <font color="#20B2AA"> <b> Até </b></font></td>
                                        <td align="center"> <font color="#20B2AA"> <b> Período </b> </font></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Segunda-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_seg_de" title="Hora de início do período" size="7" value="'.$ver[77].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_seg_ate" title="Hora de término" size="7" value="'.$ver[78].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_seg_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[79].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Terça-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_ter_de" title="Hora de início do período" size="7" value="'.$ver[80].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_ter_ate" title="Hora de término" size="7" value="'.$ver[81].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_ter_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[82].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quarta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qua_de" title="Hora de início do período" size="7" value="'.$ver[83].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qua_ate" title="Hora de término" size="7" value="'.$ver[84].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qua_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[85].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Quinta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qui_de" title="Hora de início do período" size="7" value="'.$ver[86].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qui_ate" title="Hora de término" size="7" value="'.$ver[87].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_qui_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[88].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sexta-feira </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sex_de" title="Hora de início do período" size="7" value="'.$ver[89].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sex_ate" title="Hora de término" size="7" value="'.$ver[90].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sex_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[91].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Sábado </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sab_de" title="Hora de início do período" size="7" value="'.$ver[92].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sab_ate" title="Hora de término" size="7" value="'.$ver[93].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_sab_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[94].'"></td>
                                    </tr>
                                    <tr> 
                                    	<td align="center"> <font color="#FFFFFF"> Domingo </font> </td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_dom_de" title="Hora de início do período" size="7" value="'.$ver[95].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_dom_ate" title="Hora de término" size="7" value="'.$ver[96].'"></td>
                                        <td> <input type="text" onKeypress="mascara(this, \'##:##:##\')" maxlength="8" name="mad_dom_tem" title="De quanto em quanto tempo será criado o compromisso" size="10" value="'.$ver[97].'"></td>
                                    </tr>
                              </table>
                           </div> <!-- Fecha a div Madrugada -->
					  
					   </tr>
					   
					   
                        <tr>
						</table>

');

?>
<script>
            defineAba( "celAbaManha"  , "Manha"   );
            defineAba( "celAbaTarde" , "Tarde"  );
            defineAba( "celAbaNoite" , "Noite"   );
            defineAba( "celAbaMadrugada", "Madrugada"     );
            defineAbaAtiva( "celAbaManha" );
        </script>
</html>
