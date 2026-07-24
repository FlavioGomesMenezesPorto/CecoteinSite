<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<title> CProfissionais - Cadastro de profissionais </title>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
		<div class="principal">

            <div id="cabeca" >
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>
            <div class="conteudo">
				<?php
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
					session_start();
					if(isset($_COOKIE['pro']))
					  $id = $_COOKIE["pro"];
				    else
					  $id = 0;
					
				    // $empresa = mysql_query("select cnpj from cadastro_profissionais where id_pro = '$id'");
			        $empresa = mysql_query("select cnpj from cadastro_profissionais where nome_pro like '".$_POST["empresa"]."'");
					$emp = mysql_fetch_row($empresa);
					
					$check = $_POST['check'];
					$nome = $_POST["nome"];
					$registro = $_POST["registro"];
					$especialidade = $_POST["especialidade"];
					$categoria = $_POST["categoria"];
					$cpf = $_POST["cpf"];
					$nasc = $_POST["nasc"];
					$endereco = $_POST["endereco"];
					$numero = $_POST["numero"];
					$bairro = $_POST["bairro"];
					$cidade = $_POST["cidade"];
					$estado = $_POST["estado"];
					$telefone = $_POST["telefone"];
					$empresa = $_POST["empresa"];
					$senha = $_POST["senha"];
					$conf_senha = $_POST["conf_senha"];
					$obs = $_POST["obs"];
					$foto = $_FILES["foto1"];
					$horario[0] = $_POST["man_seg_de"];	 	 	 	 	 	 	
					$horario[1] = $_POST["man_seg_ate"];
					$horario[2] = $_POST["man_seg_tem"]; 
					$horario[3] = $_POST["man_ter_de"];
					$horario[4] = $_POST["man_ter_ate"];
					$horario[5] = $_POST["man_ter_tem"];
					$horario[6] = $_POST["man_qua_de"];
					$horario[7] = $_POST["man_qua_ate"];
					$horario[8] = $_POST["man_qua_tem"];
					$horario[9] = $_POST["man_qui_de"];
					$horario[10] = $_POST["man_qui_ate"];
					$horario[11] = $_POST["man_qui_tem"];
					$horario[12] = $_POST["man_sex_de"];
					$horario[13] = $_POST["man_sex_ate"];
					$horario[14] = $_POST["man_sex_tem"];
					$horario[15] = $_POST["man_sab_de"];
					$horario[16] = $_POST["man_sab_ate"];
					$horario[17] = $_POST["man_sab_tem"];
					$horario[18] = $_POST["man_dom_de"];
					$horario[19] = $_POST["man_dom_ate"];
					$horario[20] = $_POST["man_dom_tem"];
					$horario[21] = $_POST["tar_seg_de"];
					$horario[22] = $_POST["tar_seg_ate"];
					$horario[23] = $_POST["tar_seg_tem"];
					$horario[24] = $_POST["tar_ter_de"];
					$horario[25] = $_POST["tar_ter_ate"];
					$horario[26] = $_POST["tar_ter_tem"];
					$horario[27] = $_POST["tar_qua_de"];
					$horario[28] = $_POST["tar_qua_ate"];
					$horario[29] = $_POST["tar_qua_tem"];
					$horario[30] = $_POST["tar_qui_de"];
					$horario[31] = $_POST["tar_qui_ate"];
					$horario[32] = $_POST["tar_qui_tem"];
					$horario[33] = $_POST["tar_sex_de"];
					$horario[34] = $_POST["tar_sex_ate"];
					$horario[35] = $_POST["tar_sex_tem"];
					$horario[36] = $_POST["tar_sab_de"];
					$horario[37] = $_POST["tar_sab_ate"];
					$horario[38] = $_POST["tar_sab_tem"];
					$horario[39] = $_POST["tar_dom_de"];
					$horario[40] = $_POST["tar_dom_ate"];
					$horario[41] = $_POST["tar_dom_tem"];
					$horario[42] = $_POST["noi_seg_de"];
					$horario[43] = $_POST["noi_seg_ate"];
					$horario[44] = $_POST["noi_seg_tem"];
					$horario[45] = $_POST["noi_ter_de"];
					$horario[46] = $_POST["noi_ter_ate"];
					$horario[47] = $_POST["noi_ter_tem"];
					$horario[48] = $_POST["noi_qua_de"];
					$horario[49] = $_POST["noi_qua_ate"];
					$horario[50] = $_POST["noi_qua_tem"];
					$horario[51] = $_POST["noi_qui_de"];
					$horario[52] = $_POST["noi_qui_ate"];
					$horario[53] = $_POST["noi_qui_tem"];
					$horario[54] = $_POST["noi_sex_de"];
					$horario[55] = $_POST["noi_sex_ate"];
					$horario[56] = $_POST["noi_sex_tem"];
					$horario[57] = $_POST["noi_sab_de"];
					$horario[58] = $_POST["noi_sab_ate"];
					$horario[59] = $_POST["noi_sab_tem"];
					$horario[60] = $_POST["noi_dom_de"];
					$horario[61] = $_POST["noi_dom_ate"];
					$horario[62] = $_POST["noi_dom_tem"];
					$horario[63] = $_POST["mad_seg_de"];
					$horario[64] = $_POST["mad_seg_ate"];
					$horario[65] = $_POST["mad_seg_tem"];
					$horario[66] = $_POST["mad_ter_de"];
					$horario[67] = $_POST["mad_ter_ate"];
					$horario[68] = $_POST["mad_ter_tem"];
					$horario[69] = $_POST["mad_qua_de"];		 	 	 	 	 	 	
					$horario[70] = $_POST["mad_qua_ate"];
					$horario[71] = $_POST["mad_qua_tem"];
					$horario[72] = $_POST["mad_qui_de"];
					$horario[73] = $_POST["mad_qui_ate"];
					$horario[74] = $_POST["mad_qui_tem"];
					$horario[75] = $_POST["mad_sex_de"];
					$horario[76] = $_POST["mad_sex_ate"];
					$horario[77] = $_POST["mad_sex_tem"];
					$horario[78] = $_POST["mad_sab_de"];
					$horario[79] = $_POST["mad_sab_ate"];
					$horario[80] = $_POST["mad_sab_tem"];
					$horario[81] = $_POST["mad_dom_de"];
					$horario[82] = $_POST["mad_dom_ate"];
					$horario[83] = $_POST["mad_dom_tem"];
					$mostrar = !empty($_POST["checke"])?$_POST["checke"]:'';	
					 
					$obs = substitui_str($obs);
					
					if ($mostrar == '')
						$mostrar = 'off';
					
					$confere = mysql_query('SELECT * FROM cadastro_profissionais where cpf_pro = "$cpf"')or die(mysql_error());
					
					if(mysql_num_rows($confere) == 0)
					{ // se não tiver dados, ele insere o dado.
					
						if ($senha == $conf_senha )
						{
							//echo("entrou no if senha <br>");
							if ( !isset($foto))
							{	
								$foto = VerificaFotoPro("foto1");
							}
							else
							{
								//echo("entrou no else empty <br>");
								$foto[0] = '';
								$foto[1] = 1;
							}
							if ($foto[1] == 1 )
							{
								mysql_query("INSERT INTO cadastro_profissionais
								(nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, senha_pro, foto_pro, nasc_pro,  cpf_pro, observacao_pro, man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem, calcula, mostrar_grade, tipo, empresa) 
								VALUES ('$nome', '$registro', '$especialidade', '$categoria', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$telefone', '$senha', '$foto[0]', '$nasc',  '$cpf','$obs', '$horario[0]', '$horario[1]', '$horario[2]', '$horario[3]', '$horario[4]', '$horario[5]', '$horario[6]', '$horario[7]', '$horario[8]', '$horario[9]', '$horario[10]', '$horario[11]', '$horario[12]', '$horario[13]', '$horario[14]', '$horario[15]', '$horario[16]','$horario[17]', '$horario[18]','$horario[19]','$horario[20]', '$horario[21]', '$horario[22]', '$horario[23]', '$horario[24]', '$horario[25]', '$horario[26]', '$horario[27]', '$horario[28]', '$horario[29]', '$horario[30]', '$horario[31]', '$horario[32]', '$horario[33]', '$horario[34]', '$horario[35]', '$horario[36]', '$horario[37]','$horario[38]', '$horario[39]','$horario[40]','$horario[41]', '$horario[42]', '$horario[43]', '$horario[44]', '$horario[45]', '$horario[46]', '$horario[47]', '$horario[48]', '$horario[49]', '$horario[50]', '$horario[51]', '$horario[52]', '$horario[53]', '$horario[54]', '$horario[55]', '$horario[56]', '$horario[57]', '$horario[58]','$horario[59]', '$horario[60]','$horario[61]','$horario[62]', '$horario[63]', '$horario[64]', '$horario[65]', '$horario[66]', '$horario[67]', '$horario[68]', '$horario[69]', '$horario[70]', '$horario[71]', '$horario[72]', '$horario[73]', '$horario[74]', '$horario[75]', '$horario[76]', '$horario[77]', '$horario[78]', '$horario[79]','$horario[80]', '$horario[81]','$horario[82]','$horario[83]', '$horario[0]','$mostrar', 'profissional', '$emp[0]')")or die(mysql_error());
									if ($check == 'check') {
										mysql_query("INSERT INTO cadastro_profissionais2
								(nome_pro, registro_pro, especialidade_pro, categoria_pro, endereco_pro, numero_pro, bairro_pro, cidade_pro, estado_pro, telefone_pro, senha_pro, foto_pro, nasc_pro,  cpf_pro, observacao_pro, man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem, calcula, mostrar_grade, tipo, empresa) 
								VALUES ('$nome', '$registro', '$especialidade', '$categoria', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$telefone', '$senha', '$foto[0]', '$nasc',  '$cpf','$obs', '$horario[0]', '$horario[1]', '$horario[2]', '$horario[3]', '$horario[4]', '$horario[5]', '$horario[6]', '$horario[7]', '$horario[8]', '$horario[9]', '$horario[10]', '$horario[11]', '$horario[12]', '$horario[13]', '$horario[14]', '$horario[15]', '$horario[16]','$horario[17]', '$horario[18]','$horario[19]','$horario[20]', '$horario[21]', '$horario[22]', '$horario[23]', '$horario[24]', '$horario[25]', '$horario[26]', '$horario[27]', '$horario[28]', '$horario[29]', '$horario[30]', '$horario[31]', '$horario[32]', '$horario[33]', '$horario[34]', '$horario[35]', '$horario[36]', '$horario[37]','$horario[38]', '$horario[39]','$horario[40]','$horario[41]', '$horario[42]', '$horario[43]', '$horario[44]', '$horario[45]', '$horario[46]', '$horario[47]', '$horario[48]', '$horario[49]', '$horario[50]', '$horario[51]', '$horario[52]', '$horario[53]', '$horario[54]', '$horario[55]', '$horario[56]', '$horario[57]', '$horario[58]','$horario[59]', '$horario[60]','$horario[61]','$horario[62]', '$horario[63]', '$horario[64]', '$horario[65]', '$horario[66]', '$horario[67]', '$horario[68]', '$horario[69]', '$horario[70]', '$horario[71]', '$horario[72]', '$horario[73]', '$horario[74]', '$horario[75]', '$horario[76]', '$horario[77]', '$horario[78]', '$horario[79]','$horario[80]', '$horario[81]','$horario[82]','$horario[83]', '$horario[0]','$mostrar', 'profissional', '$emp[0]')")or die(mysql_error());
									}
								if(mysql_affected_rows() == 1)
								{
									echo (' <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Registro efetuado com sucesso <BR><br><Br> <a href="../principais/index.php"><input type="button" name="voltar" title="Voltar" value="Voltar"></a> </p>');
								}
								else
								{
									echo (' <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possivel efetuar o cadastro, por favor, tente novamente mais tarde. <BR><br><BR><a href="../principais/index.php"><input type="button" name="voltar" title="Voltar" value="Voltar"></a> </p>');
								}
							}
						}
						else
						{
							echo('<br><br> img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> As senhas digitadas não são iguais, por favor, tente novamente! <br><br><Br> 
							<a href="javascript:history.back(1);"><input type="button"name="voltar" value="Voltar"></a>');
						}
					}
					else
					{
						echo ('<img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2">  CPF Já Cadastrado no Sitema. <BR><br><br> <a href="../principais/index.php"><input type="button" name="voltar" title="Voltar" value="Voltar"></a> </p>');
					}
						
				?>
               
		    </div> <!-- Fecha a div Conteudo -->
      </div> <!-- Fecha a div Principal -->
  </body>
</html>
 

