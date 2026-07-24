
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
    <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<title> CProfissionais - Atendimento </title>
        <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script language="javascript">
		var data = '';
		var hora = '';
		function mostra_data(dt)
		{
			alert('entrou na função ');
			alert(document.getElementById(dt).value);
			data = document.getElementById(dt).value;
			hora = document.getElementById(hr).value;	
		}
		function mostra()
		{
			alert(' Set focus no edit da data ');
		}
		</script>
        <link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000" text="#FFFFFF">
		<div class="principal">

            <div id="cabeca" >
                
                <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a> 
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
				if(isset($_COOKIE['cli'])){          // Contém o CPF/CNPJ do cliente logado no sistema
					$id_cli = $_COOKIE["cli"];
				}else{
					$id_cli = 0;
				}
				if(isset($_COOKIE['pro'])){          // Contém o CPF/CNPJ do profissional logado no sistema
					$id_cli = $_COOKIE["pro"];
				session_start();
				//$id = $_POST["id"];//
				//$id = !empty($_GET["id"])?$_GET["id"]:$id;//
				$id = !empty($_GET["id"])?$_GET["id"]:$id_cli;//
				$hora = !empty($_POST["hora"])?$_POST["hora"]:$_GET["hora"];//
				$data = !empty($_POST["data"])?$_POST["data"]:$_GET["data"];
				$data2 = !empty($_GET["data"])?$_GET["data"]:$data;//
				//$nome = $_POST['nome'];
				$nome = !empty($_POST["nome"])?$_POST["nome"]:$_GET["nome"];
				//$end = $_POST['end'];
				$end = !empty($_POST["end"])?$_POST["end"]:$_GET["end"];
				//$bairro = $_POST['bairro'];
				$bairro = !empty($_POST["bairro"])?$_POST["bairro"]:$_GET["bairro"];
				//$cidade = $_POST['cidade'];
				$cidade = !empty($_POST["cidade"])?$_POST["cidade"]:$_GET["cidade"];
				//$estado = $_POST['estado'];
				$estado = !empty($_POST["estado"])?$_POST["estado"]:$_GET["estado"];
				//<!--$tel = $_POST['tel'];-->
				//echo('tel ='.$_POST['tel']);
				if ((!empty($_POST["tel"])) || (!empty($_GET["tel"]))) {
				  $tel = !empty($_POST["tel"])?$_POST["tel"]:$_GET["tel"];
				} else {
				  $tel = "";
				}
				//$obs = $_POST['obs']; 
				//$obs = !empty($_GET["obs"])?$_GET["obs"]:$obs;//
				if ((!empty($_POST["obs"])) || (!empty($_GET["obs"]))) {
				  $obs = !empty($_POST["obs"])?$_POST["obs"]:$_GET["obs"];
                } else {
				  $obs = "";
				}
				//$id_hor = $_POST['id_hor'];
				//$id_hor = !empty($_GET["id_hor"])?$_GET["id_hor"]:$id_hor;//
				$id_hor = !empty($_POST["id_hor"])?$_POST["id_hor"]:$_GET["id_hor"];
				//$id_cli = $_POST['id_cli'];
				//$id_cli = !empty($_GET["id_cli"])?$_GET["id_cli"]:$id_cli;//
				$id_cli = !empty($_POST["id_cli"])?$_POST["id_cli"]:$_GET["id_cli"];
				//echo('id_cli'.$id_cli);
				
				include '../funcoes/funcoes.php';
				include '../funcoes/conecta.php';
				//include '../horario/procura_horario.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				date_default_timezone_set('UTC');
				$sql = mysql_query("SELECT nome_cli, endereco_cli, bairro_cli, cidade_cli, estado_cli, telefone1_cli  FROM cliente WHERE cpnjcpf_cli =  ".$id_cli);
				$c = mysql_fetch_row($sql);
				
				$timestamp = strtotime($data);
				$data = date('d-m-Y', $timestamp);
				$semana = date('l',$timestamp);
				if ($semana == 'Monday') {
					$semana = 'Segunta-feira';
				}
				if ($semana == 'Tuesday') {
					$semana = 'Terça-feira';
				}
				if ($semana == 'Wednesday') {
					$semana = 'Quarta-feira';
				}
				if ($semana == 'Thursday') {
					$semana = 'Quinta-feira';
				}
				if ($semana == 'Friday') {
					$semana = 'Sexta-feira';
				}
				if ($semana == 'Saturday') {
					$semana = 'Sabado';
				}
				if ($semana == 'Sunday') {
					$semana = 'Domingo';
				}
				echo(' 
				   <table>
				   	<tr>
						<td colspan="2"><h4>Informações sobre o atendimento do profissional: </h4></td>
					</tr>
					<tr>
					<tr>
						<td>Alterar Cliente: </td>
						<td> <!-- formulário para alterar o cliente -->
							<form name=" buscar_cliente" method="post" action="altera_horario2.php?d='.$data2.'">
							
							<input type="text" name="nome" value="'.htmlspecialchars_decode(htmlentities($c[0])).'" id="nome" style="width:160px">
							<input type="hidden" name="data" value="'.$data.'">
							<input type="hidden" name="id" value="'.$id.'">
							<input type="hidden" name="hora" value="'.$hora.'">
							<input type="hidden" name="end" value="'.$end.'">
							<input type="hidden" name="bairro" value="'.$bairro.'">
							<input type="hidden" name="cidade" value="'.$cidade.'">
							<input type="hidden" name="estado" value="'.$estado.'">
							<input type="hidden" name="tel" value="'.$tel.'">
							<input type="hidden" name="obs" value="'.$obs.'"> 
							<input type="hidden" name="id_hor" value="'.$id_hor.'">
							<input type="hidden" name="id_cli" value="'.$id_cli.'">
							<input type="submit" name="buscar" value="Buscar" >
						</td>
						</form>
					</tr>
						<td> Dia: </td>
						<td>  <!-- formulário para procurar próximo dia -->
							 <form name="proximo_dia" action="../horario/procura_dia.php" method="post"> 
							 
							 <input type="text" style="width:78px; name="data" value="'.$data.'" id="dt" disabled>
							 <input type="text" style="width:82px; name="semana" value="'.$semana.'" id="sem" disabled>
							 <input type="hidden" name="data" value="'.$data.'">
							 <input type="hidden" name="id" value="'.$id.'">
							 <input type="hidden" name="hora" value="'.$hora.'">
							 <input type="hidden" name="nome" value="'.$nome.'">
							 <input type="hidden" name="end" value="'.$end.'">
							 <input type="hidden" name="bairro" value="'.$bairro.'">
							 <input type="hidden" name="cidade" value="'.$cidade.'">
							 <input type="hidden" name="estado" value="'.$estado.'">
							 <input type="hidden" name="tel" value="'.$tel.'">
							 <input type="hidden" name="obs" value="'.$obs.'"> 
							 <input type="hidden" name="id_hor" value="'.$id_hor.'">
							 <input type="hidden" name="id_cli" value="'.$id_cli.'">
							 <input type="submit" name="proximo" value="Próximo dia" >
							 </form>
						</td>
						<td>	 
							 <!-- formulário para procurar dia anterior -->
							 <form name="proximo_dia" action="../horario/procura_dia_ant.php" method="post"> 
							 <input type="hidden" name="nome" value="'.$c[0].'" id="nome">
							 <input type="hidden" name="data" value="'.$data.'">
							 <input type="hidden" name="id" value="'.$id.'">
							 <input type="hidden" name="hora" value="'.$hora.'">
							 <input type="hidden" name="nome" value="'.$nome.'">
							 <input type="hidden" name="end" value="'.$end.'">
							 <input type="hidden" name="bairro" value="'.$bairro.'">
							 <input type="hidden" name="cidade" value="'.$cidade.'">
							 <input type="hidden" name="estado" value="'.$estado.'" >
							 <input type="hidden" name="tel" value="'.$tel.'">
							 <input type="hidden" name="obs" value="'.$obs.'"> 
							 <input type="hidden" name="id_hor" value="'.$id_hor.'">
							 <input type="hidden" name="id_cli" value="'.$id_cli.'">
                             <input type="submit" name="proximo2" value="Dia Anterior" >
							 </form>
							 
						</td>
					</tr>
					<tr>
						<td> Hora: </td>
						<td> <form name="proximo" action="../horario/procura_horario.php" method="post"> 
						 	 	<input type="text" name="hr" id="hr" value="'.$hora.'" disabled > 
                            	<input type="hidden" name="id" value="'.$id.'">
								<input type="hidden" name="nome" value="'.$c[0].'" id="nome">
								<input type="hidden" name="data" value="'.$data.'">
								<input type="hidden" name="hora" value="'.$hora.'">
								<input type="hidden" name="nome" value="'.$nome.'">
								<input type="hidden" name="end" value="'.$end.'">
								<input type="hidden" name="bairro" value="'.$bairro.'">
								<input type="hidden" name="cidade" value="'.$cidade.'">
								<input type="hidden" name="estado" value="'.$estado.'" >
								<input type="hidden" name="tel" value="'.$tel.'">
								<input type="hidden" name="obs" value="'.$obs.'"> 
								<input type="hidden" name="id_hor" value="'.$id_hor.'">
								<input type="hidden" name="id_cli" value="'.$id_cli.'">
							    <input type="submit" name="proximo" value="Próximo Horário" onFocus="recebe_hora()">
							 </form>
						</td>
						<td> <form name="proximo" action="../horario/horario_anterior.php" method="post"> 
						 	 	<input type="hidden" name="hr" id="hr" value="'.$hora.'" disabled > 
                            	<input type="hidden" name="id" value="'.$id.'">
								<input type="hidden" name="nome" value="'.$c[0].'" id="nome">
								<input type="hidden" name="data" value="'.$data.'">
								<input type="hidden" name="hora" value="'.$hora.'">
								<input type="hidden" name="nome" value="'.$nome.'">
								<input type="hidden" name="end" value="'.$end.'">
								<input type="hidden" name="bairro" value="'.$bairro.'">
								<input type="hidden" name="cidade" value="'.$cidade.'">
								<input type="hidden" name="estado" value="'.$estado.'" >
								<input type="hidden" name="tel" value="'.$tel.'">
								<input type="hidden" name="obs" value="'.$obs.'"> 
								<input type="hidden" name="id_hor" value="'.$id_hor.'">
								<input type="hidden" name="id_cli" value="'.$id_cli.'">
							    <input type="submit" name="proximo" value="Horário Anterior" onFocus="recebe_hora()">
							 </form>
						</td>
					</tr>
					<tr>
						<td> <form name="alterar" action="../horario/altera_horario1.php?id='.$id.'" method="post">
							<input type="hidden" name="data" value="'.$data.'">
							<input type="hidden" name="hora" value="'.$hora.'">
							<input type="hidden" name="id_cli" value="'.$id_cli.'">
						</td>
					</tr>
					<tr> 
						<td> Nome: </td>
						<td> '.htmlspecialchars_decode(htmlentities($c[0])).'</td>
					</tr>
					<tr>
						<td> Endereço: </td>
						<td> '.$c[1].'</td>
					</tr>
					<tr>
						<td> Bairro: </td>
						<td> '.$c[2].' </td>
					</tr>
					<tr>
						<td> Cidade: </td>
						<td> '.$c[3].'</td>
					<tr>
						<td> Estado: </td>
						<td> '.$c[4].'</td>
					</tr>
					<tr>
						<td> Telefone: </td>
						<td> '.$c[5].'</td>
					</tr>
					<tr>
						<td> Observações: </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
					</tr>
					<tr>
						<td colspan="2"> <textarea name="obs" cols="45" rows="5" style="font-family:Arial">'.$obs.'</textarea></td>
					</tr>
					<tr>	
						<td> <input type="hidden" name="id" value="'.$id.'">
							<input type="hidden" name="id_hor" value="'.$id_hor.'">
					<tr>
						<td colspan="2" align="right"> <input type="submit" value="Salvar" name="salvar" onFocus="recebe_hora()"> 
						<a href="../horario/visualizar_atendimento.php?a='.$id_hor.'&r='.$id.'&d='.$data2.'">
						<input type="button" value="Voltar" name="voltar"></a> </td>
						</td>
					</tr>
				</table> 
				
				</form>');
				}else{
					$id_cli = 0;
				}
			?>
          <!-- <input type="text" name="data" value="'.$data.'" id="data" style="visibility:inherit;"> -->
            	</center> </font>
            </div>
    	</div>
	</body>
</html>

<? 

// Deve ser feito em JS

function recebe_data()
{
	$data = "<script>document.write(data)</script>";
	echo('<br><br>'.$data.' data <br> ');
}

function recebe_hora()
{
	$hora = "<script>document.write(hr)</script>";
	echo('<br><br>'.$hora.' hora <br> ');

}