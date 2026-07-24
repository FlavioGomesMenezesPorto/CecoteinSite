<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<title> CProfissionais - Agendar </title>
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
                     <param name="movie" value="../menu/Menu-prof.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu-prof.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-prof.html");
				?>
            </div>
			<div class="conteudo">
            	<br><br><br>
               
				<?php
					session_start();																										
					include '../funcoes/conecta.php';
					include '../funcoes/funcoes.php';
					include '../funcoes/somaHora.php';
					//include 'procura.php';
					if(isset($_COOKIE['pro'])){
						$id_cad = $_COOKIE["pro"];
				   }
					else{
						$id_cad = 0;
					}
					mysql_select_db(BASE,$cn)or die(mysql_error());
					//echo('teeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeste');
					$id_cli = $_GET["c"];
					$id     = $_GET["r"];
					$inicio = $_GET["i"];
					$data   = $_GET["d"];
					$ob     = $_POST["obs"];
					$rep 	= $_POST[""];
					//$hora_cad2 = date("H:i:s");  //hora
					//$data2 = date("Y-m-d");
					
					$hora_cad = date("c");
					//$hora_cad = strtotime($hora_cad);
					//echo($hora_cad);
					$ob = substitui_str($ob); //substitui ' por "
					$op1 = $_POST['opcao1'];
					$op2 = $_POST['opcao2'];
					
                    
					if ($op1 == 'manha') {
						$teste = horario($id,$inicio,$data,0,1,2);
						//echo('horario ='.$teste[1].','.$teste[2].','.$teste[3].','.$teste[4]);
					}
					if ($op2 == 'tarde'){
						$teste = horario($id,$inicio,$data,21,22,23);
						//echo($id.','.$inicio.','.$data.',0,1,2');
						//echo('tarde');
					}
					
					for ($y = 1; $y < $teste[0]; $y++){
						echo('valor do horario eh'.$teste[$y]);
					}
					 $gravar = mysql_query("INSERT INTO horarios_pro(id_cad, idprofissional_pro, inicio_pro, hora_cad, id_cliente_pro, data_pro, observacoes) VALUES (".$id_cad.",".$id.", '".$inicio."', '".$hora_cad."', ".$id_cli.", '".$data."', '".$ob."')")or die(mysql_error());
					if ($gravar != 0) 
					{
						echo (' <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Agendamento concluído com sucesso! </font>
								
								<form name="voltar">
								     <a href="../horario/visualizar_horarios.php?p='.$id.'"> <input type="button" name="Ok" value="Voltar"> </a>
								</form>
							  ');
					}
					else
					{
						echo(' <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possível concluir o agendamento, <br> por favor tente mais tarde. <br><br></font>
							   <form name="voltar">
								     <a href="../horario/visualizar_horarios.php?p='.$id.'"> <input type="button" name="Ok" value="Voltar"> </a>
								</form>
							  ');
					}
				    
				?>           
            </div>
         </div>
	</body>
</html>
<?php
function horario($id,$inicio_h,$data,$d,$a,$t) {

//echo('<div style="color:white">teeeste'.$id.','.$inicio.','.$data.','.$d.','.$a.','.$t.'</div>');

// seleciona os horários do profissional
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	
	$ter = mysql_fetch_row($termino);
	$i =  1;
	$x = 0;
	$timestamp = strtotime($data);
	
    $semana = date('l', $timestamp);
	//echo('esta semana eh'.$semana);
	list($hora3, $min, $seg) = explode(":", $inicio_h, 3);
	/////////////////////////////////////////////////////////////
	if (($semana == 'Monday') || ($semana == 'Segunda-feira'))
	{
		$hora[$i] = $ter[$d];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	///////////////////////////////////////////////////////////////		
	if (($semana == 'Tuesday') || ($semana == 'Terça-feira'))
	{
		$hora[$i] = $ter[$d+3];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a+3]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+3]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	////////////////////////////////////////////////////////////////						
	if (($semana == 'Wednesday') || ($semana == 'quarta-feira'))
	{
		$hora[$i] = $ter[$d+6];
		//echo('valor da hora ='.$hora[$i].', ');
		//$hora[$i] = somahora($hora[$i],$ter[$t+6]);
		while ($hora[$i] < $ter[$a+6]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+6]);
			//echo('valor agora eh ='.$hora[$i]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	//////////////////////////////////////////////////////////////						
	if (($semana == "Thursday") || ($semana == 'Quinta-feira'))
	{
		$hora[$i] = $ter[$d+9];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a+9]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+9]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	////////////////////////////////////////////////////////////						
	if (($semana == 'Friday') || ($semana == 'Sexta-feira'))
	{
		$hora[$i] = $ter[$d+12];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a+12]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+12]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	////////////////////////////////////////////////////////						
	if (($semana == 'Saturday') || ($semana == 'Sábado'))
	{
		$hora[$i] = $ter[$d+15];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a+15]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+15]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	//////////////////////////////////////////////////////						
	if (($semana == 'Sunday') || ($semana == 'Domingo'))
	{
		$hora[$i] = $ter[$d+18];
		//echo('valor de hora ='.$hora[$i]);
		while ($hora[$i] <= $ter[$a+18]) {
			$hora[$i+1] = somahora($hora[$i],$ter[$t+18]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='".$id."' and inicio_pro='".$hora[$i]."' and data_pro=".$data."");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] != '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			}
			$hora[0] = $i;
			$i= $i+1;
			//$hora[$i] = $hora[$i-1];
		}
	}
	return $hora;
}
?>