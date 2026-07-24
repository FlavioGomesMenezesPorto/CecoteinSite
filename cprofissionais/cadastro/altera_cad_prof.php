<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Altera dados dos profissinais </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
		<div class="principal">

            <div id="cabeca" >
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>
            <div class="texto">
				<?php
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					
					if(isset($_COOKIE['pro']))
						$id = $_COOKIE["pro"];
					else
						$id = 0;
	
					mysql_select_db(BASE,$cn)or die(mysql_error());
					
					session_start();
					
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
					$obs = $_POST["obs"];
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
					$viz = $_POST['viz'];
					
					
					
					
					            
					//echo($viz);
					if ($mostrar == ''){
						$mostrar = 'off';
					}
				if($viz == "pro") {
					//echo($viz);
					
					mysql_query("Update cadastro_profissionais set nome_pro = '$nome' , registro_pro = '$registro' ,  especialidade_pro = '$especialidade' ,  categoria_pro = '$categoria' , endereco_pro = '$endereco' , numero_pro = '$numero' , bairro_pro = '$bairro' , cidade_pro = '$cidade' , estado_pro = '$estado' , telefone_pro = '$telefone' ,  nasc_pro = '$nasc' , cpf_pro = '$cpf' , observacao_pro = '$obs', man_seg_de = '$horario[0]' ,  man_seg_ate = '$horario[1]' , man_seg_tem = '$horario[2]' , man_ter_de = '$horario[3]' , man_ter_ate = '$horario[4]' , man_ter_tem = '$horario[5]' , man_qua_de = '$horario[6]' , man_qua_ate = '$horario[7]' , man_qua_tem = '$horario[8]' , man_qui_de = '$horario[9]' , man_qui_ate = '$horario[10]' , man_qui_tem = '$horario[11]' , man_sex_de = '$horario[12]' , man_sex_ate = '$horario[13]' , man_sex_tem = '$horario[14]' , man_sab_de = '$horario[15]' , man_sab_ate = '$horario[16]' ,  man_sab_tem = '$horario[17]' , man_dom_de ='$horario[18]' , man_dom_ate = '$horario[19]' , man_dom_tem = '$horario[20]' , tar_seg_de = '$horario[21]' , tar_seg_ate = '$horario[22]' , tar_seg_tem = '$horario[23]' , tar_ter_de = '$horario[24]' , tar_ter_ate = '$horario[25]' , tar_ter_tem = '$horario[26]' , tar_qua_de = '$horario[27]' , tar_qua_ate = '$horario[28]' , tar_qua_tem = '$horario[29]' , tar_qui_de = '$horario[30]' , tar_qui_ate = '$horario[31]' , tar_qui_tem = '$horario[32]' , tar_sex_de = '$horario[33]' , tar_sex_ate = '$horario[34]' , tar_sex_tem = '$horario[35]' , tar_sab_de = '$horario[36]' , tar_sab_ate = '$horario[37]' , tar_sab_tem = '$horario[38]' , tar_dom_de = '$horario[39]' , tar_dom_ate = '$horario[40]' , tar_dom_tem = '$horario[41]' , noi_seg_de = '$horario[42]' , noi_seg_ate = '$horario[43]' , noi_seg_tem = '$horario[44]' , noi_ter_de = '$horario[45]' , noi_ter_ate = '$horario[46]' , noi_ter_tem = '$horario[47]' , noi_qua_de = '$horario[48]' , noi_qua_ate = '$horario[49]' , noi_qua_tem = '$horario[50]' , noi_qui_de = '$horario[51]' , noi_qui_ate = '$horario[52]' , noi_qui_tem = '$horario[53]' ,  noi_sex_de = '$horario[54]' , noi_sex_ate = '$horario[55]' , noi_sex_tem = '$horario[56]' , noi_sab_de = '$horario[57]' , noi_sab_ate = '$horario[58]' , noi_sab_tem = '$horario[59]' , noi_dom_de = '$horario[60]' , noi_dom_ate = '$horario[61]' , noi_dom_tem = '$horario[62]' , mad_seg_de = '$horario[63]' , mad_seg_ate = '$horario[63]' ,  mad_seg_tem = '$horario[64]' , mad_ter_de = '$horario[65]' , mad_ter_ate = '$horario[66]' , mad_ter_tem = '$horario[67]' , mad_qua_de = '$horario[68]' ,  mad_qua_ate = '$horario[69]' , mad_qua_tem = '$horario[70]' , mad_qui_de = '$horario[71]' , mad_qui_ate = '$horario[72]' , mad_qui_tem = '$horario[73]' , mad_sex_de = '$horario[74]' , mad_sex_ate = '$horario[75]' , mad_sex_tem = '$horario[76]' , mad_sab_de = '$horario[77]' , mad_sab_ate = '$horario[78]' , mad_sab_tem = '$horario[79]' , mad_dom_de = '$horario[80]' , mad_dom_ate = '$horario[81]' , mad_dom_tem = '$horario[80]' , mostrar_grade = 'on' , empresa = '$empresa' where id_pro = '$id'")or die(mysql_error());
				} else {
					if ($viz == "cli") {
						
						mysql_query("Update cadastro_profissionais2 set nome_pro = '$nome' , registro_pro = '$registro' ,  especialidade_pro = '$especialidade' ,  categoria_pro = '$categoria' , endereco_pro = '$endereco' , numero_pro = '$numero' , bairro_pro = '$bairro' , cidade_pro = '$cidade' , estado_pro = '$estado' , telefone_pro = '$telefone' ,  nasc_pro = '$nasc' , cpf_pro = '$cpf' , observacao_pro = '$obs', man_seg_de = '$horario[0]' ,  man_seg_ate = '$horario[1]' , man_seg_tem = '$horario[2]' , man_ter_de = '$horario[3]' , man_ter_ate = '$horario[4]' , man_ter_tem = '$horario[5]' , man_qua_de = '$horario[6]' , man_qua_ate = '$horario[7]' , man_qua_tem = '$horario[8]' , man_qui_de = '$horario[9]' , man_qui_ate = '$horario[10]' , man_qui_tem = '$horario[11]' , man_sex_de = '$horario[12]' , man_sex_ate = '$horario[13]' , man_sex_tem = '$horario[14]' , man_sab_de = '$horario[15]' , man_sab_ate = '$horario[16]' ,  man_sab_tem = '$horario[17]' , man_dom_de ='$horario[18]' , man_dom_ate = '$horario[19]' , man_dom_tem = '$horario[20]' , tar_seg_de = '$horario[21]' , tar_seg_ate = '$horario[22]' , tar_seg_tem = '$horario[23]' , tar_ter_de = '$horario[24]' , tar_ter_ate = '$horario[25]' , tar_ter_tem = '$horario[26]' , tar_qua_de = '$horario[27]' , tar_qua_ate = '$horario[28]' , tar_qua_tem = '$horario[29]' , tar_qui_de = '$horario[30]' , tar_qui_ate = '$horario[31]' , tar_qui_tem = '$horario[32]' , tar_sex_de = '$horario[33]' , tar_sex_ate = '$horario[34]' , tar_sex_tem = '$horario[35]' , tar_sab_de = '$horario[36]' , tar_sab_ate = '$horario[37]' , tar_sab_tem = '$horario[38]' , tar_dom_de = '$horario[39]' , tar_dom_ate = '$horario[40]' , tar_dom_tem = '$horario[41]' , noi_seg_de = '$horario[42]' , noi_seg_ate = '$horario[43]' , noi_seg_tem = '$horario[44]' , noi_ter_de = '$horario[45]' , noi_ter_ate = '$horario[46]' , noi_ter_tem = '$horario[47]' , noi_qua_de = '$horario[48]' , noi_qua_ate = '$horario[49]' , noi_qua_tem = '$horario[50]' , noi_qui_de = '$horario[51]' , noi_qui_ate = '$horario[52]' , noi_qui_tem = '$horario[53]' ,  noi_sex_de = '$horario[54]' , noi_sex_ate = '$horario[55]' , noi_sex_tem = '$horario[56]' , noi_sab_de = '$horario[57]' , noi_sab_ate = '$horario[58]' , noi_sab_tem = '$horario[59]' , noi_dom_de = '$horario[60]' , noi_dom_ate = '$horario[61]' , noi_dom_tem = '$horario[62]' , mad_seg_de = '$horario[63]' , mad_seg_ate = '$horario[63]' ,  mad_seg_tem = '$horario[64]' , mad_ter_de = '$horario[65]' , mad_ter_ate = '$horario[66]' , mad_ter_tem = '$horario[67]' , mad_qua_de = '$horario[68]' ,  mad_qua_ate = '$horario[69]' , mad_qua_tem = '$horario[70]' , mad_qui_de = '$horario[71]' , mad_qui_ate = '$horario[72]' , mad_qui_tem = '$horario[73]' , mad_sex_de = '$horario[74]' , mad_sex_ate = '$horario[75]' , mad_sex_tem = '$horario[76]' , mad_sab_de = '$horario[77]' , mad_sab_ate = '$horario[78]' , mad_sab_tem = '$horario[79]' , mad_dom_de = '$horario[80]' , mad_dom_ate = '$horario[81]' , mad_dom_tem = '$horario[80]' , mostrar_grade = 'on' , empresa = '$empresa' where id_pro = '$id'")or die(mysql_error());
					}
				}
					
					if (mysql_affected_rows() != 0)	
						echo('<p align="center"> <br> <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Registro alterado com sucesso </font> 
						<BR> <a href="../principais/prof_princ.php?r='.$id.'"><input type="button" name="voltar" title="Voltar" value="Voltar"></a> </p>');
						
						
					
					
					else
					{
						echo("<p align='center'><br> <img src='../imagens/atencao.png' width='60px' height='60px' align='middle'>
						<font size='+2'>  Não foi possivel alterar o cadastro, por favor, tente novamente mais tarde. </font>
						<BR> <a href='../principais/prof_princ.php?r=".$id."'> <input type='button' name='voltar' title='Voltar' value='Voltar'></a> </p>");
					}
					
		?>
	   
		    </div> <!-- Fecha a div Conteudo -->
      </div> <!-- Fecha a div Principal -->
  </body>
</html>
 
