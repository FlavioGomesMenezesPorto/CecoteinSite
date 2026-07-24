<?php 

function somahora($hour1,$hour2) 
{

	for ($i=0;$i<3;$i++) 
	{
	
		$hora1 = explode(":",$hour1);
		$hora2 = explode(":",$hour2);
		
		$mostre1[$i] = $hora1[$i];
		$mostre2[$i] = $hora2[$i];
	
	}
	
	$soma_hora = $mostre1[0] + $mostre2[0];
	$soma_min = $mostre1[1] + $mostre2[1];
	$soma_seg = $mostre1[2] + $mostre2[2];
	
	
	if ($soma_seg > 59) 
	{
	
	$soma_min++;
	
	$soma_seg = $soma_seg - 60;
	
	if ($soma_min > 59)
	
	$soma_hora++;
	
	$soma_min = $soma_min - 60;
	
	
	} elseif ($soma_min > 59) {
	
	$soma_hora++;
	
	$soma_min = $soma_min - 60;
	
	}
	
	if ($soma_min <= 9) $soma_min = "0".$soma_min;
	if ($soma_seg <= 9) $soma_seg = "0".$soma_seg;
	if ($soma_hora <= 9) $soma_hora = "0".$soma_hora;
	
	if ($soma_hora <= 24)
	{
		//echo ($soma_hora);
		//echo (":".$soma_min);
		//echo (":".$soma_seg);
		//echo ("<br>");
		
		$resultado = $soma_hora.':'.$soma_min.':'.$soma_seg ;
		return $resultado;
	}
}

somahora("59:59:59","59:59:59");

function subhora($hour1,$hour2) 
{

	list($hora1, $min1, $seg1) = explode(":", $hour1, 3);
	list($hora2, $min2, $seg2) = explode(":", $hour2, 3);
	
	/*$soma_hora = $mostre1[0] + $mostre2[0];
	$soma_min = $mostre1[1] + $mostre2[1];
	$soma_seg = $mostre1[2] + $mostre2[2];*/
		
	if ($seg1 >= $seg2) {
		$seg1 = $seg1 - $seg2;
	} else {
		$seg1 = $seg2 - $seg1;
		$seg1 = 60 - $seg1;
		if ($min1 == 0) {
			$min1 = 59;
		} else {
			$min1 = $min1 - 1;
		}
	}
	if ($min1 >= $min2) {
		$min1 = $min1 - $min2;
	} else {
		$min1 = $min2 - $min1;
		$min1 = 60 - $seg1;
		if ($hora1 == 0) {
			$hora1 = 23;
		} else {
			$hora1 = $hora1 - 1;
		}
	}
	if ($hora1 >= $hora2){
		$hora1 = $hora1 - $hora2;
	}

	
	if ($hora1 <= 9) $hora1 = "0".$hora1;
	if ($min1 <= 9) $min1 = "0".$min1;
	if ($seg1 <= 9) $seg1 = "0".$seg1;
	
	if ($hora1 <= 24)
	{
		//echo ($soma_hora);
		//echo (":".$soma_min);
		//echo (":".$soma_seg);
		//echo ("<br>");
		
		$resultado = $hora1.':'.$min1.':'.$seg1 ;
		return $resultado;
	}
}

subhora("59:59:59","59:59:59");


function subdata_dia($data,$valor){ // subtrai o dia das datas pelo valor determinado ate 30 dias
	list($ano, $mes, $dia) = explode('-', $data, 3);
	if ($dia > $valor){
		$dia = $dia - $valor;
	} else {
		$dia = $valor - $dia;
		$mes = $mes - 1;
		if ($mes == 0) {
			$ano = $ano - 1;
			$mes = 12;
		}
		$data = $ano.'-'.$mes.'-'.$dia;
		$temistamp = strtotime($data);
		$m = date('t',$temistam);
		$dia = $mes  - $dia;
	}
	$data = $ano.'-'.$mes.'-'.$dia;
	return $data;	
}

function sumdata_dia($data,$valor){ // subtrai o dia das datas pelo valor determinado ate 30 dias
	list($ano, $mes, $dia) = explode('-', $data, 3);
	$temistamp = strtotime($data);
	$m = date('t',$temistamp);
	if ($dia == $m){
		$dia = $valor;
		$mes = $mes + 1;
		if ($mes == 13) {
			$ano = $ano + 1;
			$mes = 1;
		}
	} else {
		$dia = $valor + $dia;
	}
	$data = $ano.'-'.$mes.'-'.$dia;
	return $data;	
}

/*function somadata($id, $inicio, $date, $soma, $op, $n) {
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem, man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	$ter = mysql_fetch_row($termino);
	$x = 0;
	list($ano, $mes, $dia) = explode('-', $date, 3);
	$n = $n -60;
	//$m = date('j', $date);
	//echo($date.', '.$soma.', '.$op);
	while($x<$soma){
		$data[$x] = $dia.'-'.$mes.'-'.$ano;
		$m = date('j', $data[$x]);
		$semana = date('l', $data[$x]);
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
		} else {
			echo('<script> alert("Existem outros horarios agendados") </script>');
			echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
			break;
		}
		$z=0;
		$y=0;
		
		while ($y<3) {
			if ($inicio == $ter[$n]) {
				$z=1;
			}
			$n = $n+21;
			$y = $y +1;
		}
		if ($z ==1){
			$x++;
		}
	}
	return $data;
}*/

?>
