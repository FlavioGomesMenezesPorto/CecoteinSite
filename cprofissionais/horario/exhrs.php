<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
<link href="../estilos/pagprincipal.css" type="text/css" rel="stylesheet">
<title>Untitled Document</title>
</head>

<body>
<?php
include '../funcoes/conecta.php';


?>
<div class="principal">
        
<div id="flash" >
                     <!--<object width="1500px" height="65px">
                         <param name="movie" value="../menu/Menu-cliente.swf">
                         <param name="wmode" value="transparent" />
                         <embed wmode="transparent" src="../menu/Menu-cliente.swf" width="900px" height="60px" />
                    </object>-->
                    <?php
					include ("../funcoes/menu_teste.html");
					?>  
</div>

            <div class="conteudo"> 
				
<?php
	session_start();
	if(isset($_COOKIE['pro']))
		$id_pro = $_COOKIE["pro"];
	else
		$id_pro = 0;
	include '../funcoes/conecta.php';
	include '../funcoes/somaHora.php';
	include '../funcoes/funcoes.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());
	date_default_timezone_set('UTC');
	//$id = $_GET['id'];// id do cliente
	$id = !empty($_GET["id"])?$_GET["id"]:"";
	//$hor  = $_GET['hor'];
	$p = $_GET['p'];// id do profissional desmarcado

	// $inicio1 = $_POST["exhr1"];  
	$inicio1 = !empty($_POST["exhr1"])?$_POST["exhr1"]:""; // Hora Inicio
	// $inicio2 = $_POST["exhr2"]; // Hora fim
	$inicio2 = !empty($_POST["exhr2"])?$_POST["exhr2"]:""; // Hora fim
	$data1 = !empty($_POST["exdt1"])?$_POST["exdt1"]:"";
	$data2 = !empty($_POST["exdt2"])?$_POST["exdt2"]:"";
	if (($inicio1 != '') && ($inicio2 != '') && ($data1 != '') && ($data2 != '')) {
		$d = strtotime($data1);
		$data1 = date('Y-m-d',$d);
		$d = strtotime($data2);
		$data2 = date('Y-m-d',$d);
		$data3 = date('Y-m-d'); // dara desmarcada
		$hora3 = date('H:i:s'); // hora desmarcada
		$agora = $data3.' '.$hora3;
		$d = strtotime($data1);
		$semana = date('l', $d);
		$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$p'")or die(mysql_error());
			
		$ter = mysql_fetch_row($termino);
			//echo($dia.' : dia <br> ');
		switch($semana)
		{
			case 'Monday' : $intervalo = $ter[2];
							break;
							
			case 'Tuesday' : $intervalo = $ter[5];
							break;
							 
			case 'Wednesday' : $intervalo = $ter[8];
							break;
							   
			case 'Thursday' : $intervalo = $ter[11];
							break;
							 
			case 'Friday' : $intervalo = $ter[14];
							break;
							
			case 'Saturday' : $intervalo = $ter[17];
							break;
							  
			case 'Sunday' : $intervalo = $ter[20];
							break;
		}
		$dia1 = Verifica_day($semana);
		$m = $dia1[0];
		$t = $dia1[1];
		$n = $dia1[2];
		$d = $dia1[3];
		$x = 1;
		$y = 4;
		if ($ter[$m] >= $inicio1){
			$d = $m;
			$y = 1;
			
		} else {
			if ($ter[$t] >= $inicio1){
				$d = $t;
				$y = 2;
			} else {
				if ($ter[$n] >= $inicio1){
					$d = $n;
					$y = 3;
				}
			}
		}
		
		$dt2 = $data1;
		//$d = strtotime($dt2);
		//$dt2 = date('Y-m-d',$d);
		$hora = $inicio1;
		$inicio_h = $ter[$d+1];
		
		//echo ('dt2 =' .$dt2.', hora = '.$hora.', inicio ='  .$inicio_h. ', dia ='.$d.'<br><br>');
		while ($dt2 <= $data2) {
			if ($hora <= $inicio2) {
				if ($ter[$d] < $inicio_h){
					$sql = mysql_query("select * from horarios_pro where idprofissional_pro='".$p."' and inicio_pro='".$hora."' and data_pro='".$dt2."'")or die(mysql_error());
					$resultado = mysql_fetch_row($sql);
					if ($resultado[0] != "") {
						mysql_query("Insert into desmarcado_pro(id_profissional_pro, id_cliente_pro, horario_pro, data_pro, hora_desmarcado, 						
						id_profissional) values($p, $resultado[5], '$hora', '$dt2', '$agora', '$id_pro') ") or die (mysql_error());
						//echo("Insert into desmarcado_pro(id_profissional_pro, id_cliente_pro, horario_pro, data_pro, hora_desmarcado, 						
						//id_profissional) values(".$p.", ".$resultado[5].", ".$hora.", ".$dt2.", ".$agora.", ".$id_pro.")<br><br>");			
					}
					$hora = somahora($hora,$ter[$d+2]);
				} else {
					$d = $d + 21;
					$inicio_h = $ter[$d]+1;
				}
			} else {
				$dt2 = sumdata_dia($dt2,1);
				$dt1 = strtotime($dt2);
				$dt2 = date('Y-m-d',$dt1);
				$inicio_h = $ter[$d+1];
				$hora = $ter[$d];
				//echo ('dt2 =' .$dt2.', hora = '.$hora.', inicio ='  .$inicio_h. ', dia ='.$d.'<br><br>');
			}
		}
		
		/*echo("Insert into desmarcado_pro(id_profissional_pro, id_cliente_pro, horario_pro, data_pro, hora_desmarcado, 						
			id_profissional) values(".$p.", ".$id.", '".$hora."', '".$data."', '".$agora."', '".$id_pro."') ");*/

		//echo("DELETE FROM horarios_pro WHERE idprofissional_pro =".$p." AND  
		//			 data_pro >= '".$data1."' and data_pro <= '".$data2."' and 
		//			 inicio_pro >='".$inicio1."' and inicio_pro <='".$inicio2."'");
		mysql_query("DELETE FROM horarios_pro WHERE idprofissional_pro =".$p." AND  
		             data_pro >= '".$data1."' and data_pro <= '".$data2."' and 
					 inicio_pro >='".$inicio1."' and inicio_pro <='".$inicio2."'") or die(mysql_error());
		if (mysql_affected_rows() == 1 ) {
			echo('<img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<font size="+2">
			O horário(s) foi desmarcado(s) com sucesso! </font>');
			echo('<form name="voltar">
				<a href="../horario/visualizar_horarios.php?p='.$p.'"> <input type="button" name="Ok" value="Voltar"> </a>
			</form>');
			
		} else {
			echo('<br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
				<font size="+2"> Ocorreu erro na hora de excluir o compromisso. <br><br>
				<a href="javascript:history.back(1);"><input type="button" value="Voltar" name="voltar"></a>');
			echo("Ocorreu erro na hora de excluir o compromisso");
		}
	} else {
		echo('<br><br><center> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
			<font size="+2"> Campos: A partir da data, até a data, A partir da hora e até a hora não podem ficar vazios ! <br><br>
			<a href="javascript:history.back(1);"><input type="button" value="Voltar" name="voltar"></a></center>');
	}
	
?>
</div>

</div>
</body>
</html>