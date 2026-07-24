<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Atendimento </title>
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
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
				include ("../funcoes/menu-prof.html");
				?>  
            </div>
            
             <div class="principal" style="top: 183px; text-align:center">
             	<img src="../imagens/horario.png" align="left" width="150" height="100">
                <font color="#FFFFFF"><center>
            	<br>
            	                
            <?php
				if(isset($_COOKIE['cli']))      //Contém o CPF/CNPJ do cliente logado no sistema
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id_cad = $_COOKIE["pro"];
				else
					$id_cad = 0;

				session_start();
				include '../funcoes/conecta.php';
				include '../funcoes/funcoes.php';
				$id = $_POST['id']; //id do profissional
				$hora = $_POST['hora']; //hora de inicio
				$data = $_POST['data'];
				$data = !empty($_GET["dt"])?$_GET["dt"]:$_POST["data"];
				//muda o formato da data
				$timestamp = strtotime($data);
				$data = date('Y-m-d', $timestamp);
				$obs = $_POST['obs'];
				$id_hor = $_POST['id_hor'];
				$id_cli = $_POST['id_cli'];
				$hora_cad2 = date("H:i:s");  //hora
				$data2 = date("Y-m-d");
				$hora_cad = $hora_cad2.' '.$data2;
				
				
				//echo($hora.' hora <br> ');
				//echo($data.' dia <br> ');
				//echo($id_hor.' id_hor <br> ');
						
				
				
				mysql_select_db(BASE,$cn)or die(mysql_error());
				date_default_timezone_set('UTC');
				$sql = "select * from cadastro_profissionais";
				$resposta = mysql_query($sql, $cn);
				while ($linha = mysql_fetch_array($resposta)) {	
					if ($linha['id_pro'] == $id){
						$nome = $linha['nome_pro']; 
					}
				}
				
				
				//troca os ' (apostrofes) por " ( aspas duplas)
				$obs = substitui_str($obs);
				
				$pesquisa = mysql_query("Select * from horarios_pro where idprofissional_pro = '".$id."' and inicio_pro = '".$hora."' and data_pro = '".$data."'") or die (mysql_error());
				$verifica = mysql_num_rows($pesquisa);
				
				
				//Se não houver horário marcado naquele dia
				if($verifica == 0 )
				{
					$insere = mysql_query("Update horarios_pro set id_cad=$id_cad, hora_cad='$hora_cad', inicio_pro = '$hora', data_pro = '$data', observacoes = '$obs' where id_pro = '$id_hor'") or die (mysql_error());
					
					if(mysql_affected_rows() == 1)
					{
						echo('<br><br> <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<font size="+2"> Compromisso alterado com sucesso! </font><br><Br>
							  <a href="../horario/visualizar_horarios.php?p='.$id.'&n='.$nome.'"><input type="button" value="Voltar" name="voltar"></a>');
					}
					else
					{
						echo('<br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
							<font size="+2"> Não foi possível alterar seu compromisso, por favor tente mais tarde! <br><br>
							  <a href="../horario/visualizar_atendimento.php?r='.$id.'&h='.$hora.'&d='.$data.'"><input type="button" value="Voltar" name="voltar"></a>');
					}
				}
				else
				{
				
							$sql = "update horarios_pro set id_cad=$id_cad, hora_cad='$hora_cad', id_cliente_pro=$id_cli, observacoes='$obs' where id_pro = '".$id_hor."' and idprofissional_pro = '".$id."' and inicio_pro = '".$hora."' and data_pro = '".$data."'";
							$resposta = mysql_query($sql,$cn);
							if (mysql_affected_rows() !=0) {
							echo('<br><br> <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<font size="+2"> Compromisso alterado com sucesso! </font><br><Br>
							  <a href="../horario/visualizar_horarios.php?p='.$id.'&n='.$nome.'"><input type="button" value="Voltar" name="voltar"></a>');
							  
							} else {
								echo('<br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
							<font size="+2"> O horário escolhido já foi marcado por outro cliente! Selecione outro horário. <br><br>
							 <a href="javascript:history.back(1);"><input type="button" value="Voltar" name="voltar"></a>');
							}

				}
			?>
            	</center> </font>
            </div>
    	</div>
	</body>
</html>