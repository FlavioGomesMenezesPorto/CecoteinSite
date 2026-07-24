<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$id = $_POST["id"];
$hor = $_POST["hora"];
$dt = $_POST["data"];
$nome = $_POST['nome'];
$end = $_POST['end'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$tel = $_POST['tel'];
$obs = $_POST['obs']; 
$id_hor = $_POST['id_hor'];
$id_cli = $_POST['id_cli'];
$inicio = $_POST['hora'];
session_start();																										
include '../funcoes/conecta.php';
include '../funcoes/funcoes.php';
include '../funcoes/somaHora.php';
		mysql_select_db(BASE,$cn)or die(mysql_error());
		date_default_timezone_set('UTC');		
					
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	$ter = mysql_fetch_row($termino);
	$inicio_h = $inicio;
	$timestamp = strtotime($dt);
	$dt2 = date('Y-m-d',$timestamp);
	$semana = date('l', $timestamp);
	$valor = Verifica_day($semana);
	$m = $valor[0] +1;
	$t = $valor[1] +1;
	$n = $valor[2] +1;
	$d = $valor[3] +1;
	$x = 1;
	$y = 4;
	
	if ($ter[$m] > $inicio_h){
		$d = $m;
		$y = 1;
	} else {
		if ($ter[$t] > $inicio_h){
			$d = $t;
			$y = 2;
		} else {
			if ($ter[$n] > $inicio_h){
				$d = $n;
				$y = 3;
			}
		}
	}
	$d = $d-1;
	while ($x == 1) {
		if ($y !=0){
		
			if ($ter[$d] < $inicio_h){
					//echo($ter[$d].' < '.$inicio_h.' 01<br>');
					$inicio_h = subhora($inicio_h,$ter[$d+2]);
					//echo($ter[$d].' < '.$inicio_h.' ');
					$sql = mysql_query("select * from horarios_pro where idprofissional_pro='".$id."' and inicio_pro='".$inicio_h."' and data_pro='".$dt2."'")or die(mysql_error());
				    //echo("select * from horarios_pro where idprofissional_pro='".$id."' and inicio_pro='".$inicio_h."' and data_pro='".$dt2."'");
					$resultado = mysql_fetch_row($sql);
					//echo(','.$resultado[0]);
					if ($resultado[0] != "") {
						//echo('marcado<br>');
					} else {
						$x=0;
						$timestamp = strtotime($dt2);
						$dt2 = date('d-m-Y',$timestamp);
						echo('<form name="teste" action="../horario/altera_horario.php" method="post">
								 <input type="hidden" name="id" value="'.$id.'">
							 	 <input type="hidden" name="data" value="'.$dt2.'">
								 <input type="hidden" name="hora" value="'.$inicio_h.'">
								 <input type="hidden" name="nome" value="'.$nome.'">
								 <input type="hidden" name="end" value="'.$end.'">
								 <input type="hidden" name="bairro" value="'.$bairro.'">
								 <input type="hidden" name="cidade" value="'.$cidade.'">
								 <input type="hidden" name="estado" value="'.$estado.'" >
								 <input type="hidden" name="tel" value="'.$tel.'">
								 <input type="hidden" name="obs" value="'.$obs.'"> 
								 <input type="hidden" name="id_hor" value="'.$id_hor.'">
								 <input type="hidden" name="id_cli" value="'.$id_cli.'">
							<input type="submit" name="enviar" id="enviar" value="Enviar" style="visibility:hidden;">
							</form>');
						?>
                        
						<script language="javascript">
						
							document.getElementById('enviar').click();
						
						</script>
                        <?
						//echo($x.'livre<br>');
					}
			} else {
				$y = $y - 1;
				$d = $d - 21;
			}
		} else { // else do if despois de ter calculado os quatro periodos
			$dt2 = subdata_dia($dt2,1);
			//echo("data agora eh".$dt2.'<br>');
			//$x++;
			$timestamp = strtotime($dt2);
			$semana = date('l', $timestamp);
			$valor = Verifica_day($semana);
			//echo("semana=".$semana);
			$m = $valor[0] +1;
			$t = $valor[1] +1;
			$n = $valor[2] +1;
			$d = $valor[3] +1;
			if ($ter[$d] != '00:00:00'){
				$inicio = $ter[$d];
				$y = 4;
			} else {
				if ($ter[$n] != '00:00:00'){
					$inicio_h = $ter[$n];
					$y = 3;
					$d = $n;
				} else {
					if ($ter[$t] != '00:00:00'){
						$inicio_h = $ter[$t];
						$y = 2;
						$d = $t;
						
					} else {
						if ($ter[$m] != '00:00:00'){
							$inicio_h = $ter[$m];
							$y = 1;
							$d = $m;
						}
					}
				}
				$d = $d-1;
				//echo($ter[$d].' < '.$inicio_h.' 01<br>');
			}
			
		}
	}
	
?>
</body>
</html>