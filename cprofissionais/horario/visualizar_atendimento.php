<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> CProfissionais - Atendimento </title>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000" text="#FFFFFF">
		<div class="principal">

            <div id="cabeca" >
                
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
				header('Content-Type: text/html; charset=utf-8');
				include ("../funcoes/menu-prof.html");
				?>  
            </div>
            
             <div class="principal" style="top: 183px; text-align:center">
             	<img src="../imagens/horario.png" align="left" width="150" height="100">
                <font color="#FFFFFF"><center>
            	<br>
            	<img src="../imagens/horario_prof.png" width="400" height="50">
                <br><br><br>
                
            <?php
				session_start();
				
				$id = $_GET["r"];
				$nome = !empty($_GET["n"])?$_GET["n"]:"";
				//$hora = $_GET["h"];
				//$data = $_GET["d"];
				$id_hor = $_GET["a"]; //id do horário
				$d = $_GET['d'];
				//$d = $d('d-m-Y');
				$timestamp = strtotime($d);
				$d = date('d-m-Y', $timestamp);
				
				include '../funcoes/conecta.php';
				
				mysql_select_db(BASE,$cn)or die(mysql_error());
				date_default_timezone_set('UTC');
				
				$pesquisa = mysql_query("Select data_pro, inicio_pro, hora_cad from horarios_pro where id_pro = '$id_hor'") or die (mysql_error());
				$ver = mysql_fetch_row($pesquisa);
				
				$data = $ver[0];
				$hora = $ver[1];
				$hora_cad = $ver[2];
				list($hora_cad, $hora_cad2) = explode(' ', $ver[2], 2);
				$timestamp = strtotime($hora_cad);
				$hora_cad = date('d-m-Y', $timestamp);
				
				//muda o formato da data;
				$timestamp = strtotime($data);
				$data = date('d-m-Y', $timestamp);
				
				$pesquisa = mysql_query("Select id_cad, id_cliente_pro, observacoes from horarios_pro where id_pro = '$id_hor'") or die (mysql_error());
				
				$cli = mysql_fetch_row($pesquisa);
    			$id_cli = $cli[1];
				$id_cad = $cli[0];
				//echo('id cadastrado'.$cli[0].'. id cliente'.$cli[1].'. ob'.$cli[2]);
				$sql = mysql_query("Select nome_pro from cadastro_profissionais where id_pro = $cli[0]") or die (mysql_error());
				$nome_pro = mysql_fetch_row($sql);
                                
				$verifica = mysql_query("Select nome_cli, endereco_cli, bairro_cli, cidade_cli, telefone1_cli, estado_cli from cliente where cpnjcpf_cli = $cli[1]") or die (mysql_error());
				
				$cliente = mysql_fetch_row($verifica);
				echo(' <p align="right"><a href="../horario/visualizar_horarios.php?p='.$id.'&dt='.$d.'&n='.$nome.'"> <input type="button" name="voltar" value="Voltar"></a> </p> ');	
				// echo($id_cli);			
				echo(' <form name="altera" action="../horario/altera_horario.php?data='.$d.'&tel='.$cliente[4].'&n='.$nome.'" method="post">
				<table>
					<tr>
						<td colspan="2"> Neste horário estará atendendo:'.$data.' às:'.$hora.' <br> <br></td>
					</tr>
					<tr>
						<td> Nome: </td>
						<td> <input type="hidden" name="nome" value="'.$cliente[0].'"> '.htmlspecialchars_decode(htmlentities($cliente[0])).' </td>
					</tr>
					<tr>
						<td> Endereço: </td>
						<td> <input type="hidden" name="end" value="'.$cliente[1].'">'.$cliente[1].'</td>
					</tr>
					<tr>
						<td> Bairro: </td>
						<td> <input type="hidden" name="bairro" value="'.$cliente[2].'">'.$cliente[2].' </td>
					</tr>
					<tr>
						<td> Cidade: </td>
						<td> <input type="hidden" name="cidade" value="'.$cliente[3].'">'.$cliente[3].' </td>
					<tr>
						<td> Estado: </td>
						<td> <input type="hidden" name="estado" value="'.$cliente[5].'">'.$cliente[5].'</td>
					</tr>
					<tr>
						<td> Telefone: </td>
						<td> <input type="hidden" name="tel" value="'.$cliente[4].'">'.$cliente[4].' </td>
					</tr>
					<tr>
						<td> Observações: </td>
						<td> </td>
					</tr>
					<tr>
						<td> <input type="hidden" name="id" value="'.$id.'">
							 <input type="hidden" name="hora" value="'.$hora.'">
							 <input type="hidden" name="data" value="'.$data.'">	
							 <input type="hidden" name="id_hor" value="'.$id_hor.'">
							 <input type="hidden" name="id_cli" value="'.$id_cli.'">
						</td>
					</tr>
					<tr>
						<td colspan="2"> <input type="hidden" name="obs" value="'.$cli[2].'"> '.$cli[2].' </td>
					</tr>
					
					<tr>
					<br/><br/>
						 <td>Ultima vez atualizado por:</td><td>'.$nome_pro[0].' ás '.$hora_cad.' '.$hora_cad2.'</td>
					</tr>
					<tr>
						<td colspan="2" align="right"> 
						<input type="submit" value="Alterar Compromisso" name="alterar_compromisso">
						<a href="../horario/exclui_horario.php?id='.$id_cli.'&id_p='.$id.'&h='.$hora.'&d='.$d.'&hor='.$id_hor.'">
						<input type="button" value="Apagar compromisso" /></a>
						</td>
					</tr>
				</table> ');
			?> 
            	</center> </font>
            </div>
    	</div>
	</body>
</html>