<?php
include '../funcoes/funcoes.php';
include '../funcoes/somaHora.php';
function somadata($id, $inicio, $date, $soma, $op) {
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	$ter = mysql_fetch_row($termino);
	$x = 0;
	list($ano, $mes, $dia) = explode('-', $date, 3);
	
	//$n = $n -60;
	//$m = date('j', $date);
	//echo($date.', '.$soma.', '.$op);
	while($x<$soma){
		$data[$x] = $ano.'-'.$mes.'-'.$dia;
		$timestamb = strtotime($data[$x]);
		$m = date('j', $timestamb);
		//echo('data ='.$data[$x].'<br>');
		$semana = date('l', $timestamb);
		//echo('semana ='.$semana.'<br>');
		$valor = Verifica_day($semana);
		$n = $valor[0];
		//echo('valor da posicao eh ='.$n.'<br>');
		$sql = mysql_query("select * from horarios_pro where idprofissional_pro='".$id."' and inicio_pro='".$inicio."' and data_pro='".$data[$x]."'");
		$resultado = mysql_fetch_row($sql);
	if ($resultado[0] == '') {
		if ($op == "mes"){
			if ($mes ==12){
				$mes = 1;
				$ano++;
			} else {
				$mes++;
			}
		}
		if ($op == "dia"){
			if ($dia > $m) {
				$dia = 1;
				$mes++;
				if ($mes > 12){
					$mes = 1; 
					$ano++;
				}
			} else {
				$dia++;
			}
		}
		if ($op == "semana"){
			$dia = $dia +7;
			if($dia > $m) {
				$dia = $dia - $m;
				$mes++;
				if ($mes > 12){
					$mes = 1;
					$ano++;
				}
			}
		}
		$z=0;
		$y=0;
		$inicio_h = $ter[$n];
		while ($y<4) {
			//echo($inicio.'=='.$ter[$n].','.$n.'<br>');
			while ($inicio_h < $ter[$n+1]){
				echo($inicio_h.'=='.$ter[$n].','.$n.'<br>');
				if ($inicio_h == $inicio) {
					$z=1;
				}
				$inicio_h = somahora($inicio_h,$ter[$n+2]);
			}
			$n = $n+21;
			$y = $y +1;
		}
		if ($z ==1){
			$x++;
		}
	} else {
		echo('<script> alert("Existem outros horarios agendados") </script>');
		echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
		break;
	} 
  }// fecha o while
	return $data;
}