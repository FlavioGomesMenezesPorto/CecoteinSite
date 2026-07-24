<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
function horario($id,$inicio_h,$data,$d,$a,$t) {
include '../funcoes/conecta.php';
include '../funcoes/funcoes.php';	
include '../funcoes/somaHora.php';

$inicio_h = $_POST['inicio']; 
$data = $_POST['data'];
$id = $_POST['id'];

// seleciona os horários do profissional
	$termino = mysql_query("Select man_seg_de, man_seg_ate, man_seg_tem, man_ter_de, man_ter_ate, man_ter_tem,man_qua_de, man_qua_ate, man_qua_tem, man_qui_de, man_qui_ate, man_qui_tem, man_sex_de, man_sex_ate, man_sex_tem, man_sab_de, man_sab_ate, man_sab_tem, man_dom_de, man_dom_ate, man_dom_tem, tar_seg_de, tar_seg_ate, tar_seg_tem, tar_ter_de, tar_ter_ate, tar_ter_tem, tar_qua_de, tar_qua_ate, tar_qua_tem, tar_qui_de, tar_qui_ate, tar_qui_tem, tar_sex_de, tar_sex_ate, tar_sex_tem, tar_sab_de, tar_sab_ate, tar_sab_tem, tar_dom_de, tar_dom_ate, tar_dom_tem, noi_seg_de, noi_seg_ate, noi_seg_tem, noi_ter_de, noi_ter_ate, noi_ter_tem, noi_qua_de, noi_qua_ate, noi_qua_tem, noi_qui_de, noi_qui_ate, noi_qui_tem, noi_sex_de, noi_sex_ate, noi_sex_tem, noi_sab_de, noi_sab_ate, noi_sab_tem, noi_dom_de, noi_dom_ate, noi_dom_tem, mad_seg_de, mad_seg_ate, mad_seg_tem, mad_ter_de, mad_ter_ate, mad_ter_tem, mad_qua_de, mad_qua_ate, mad_qua_tem, mad_qui_de, mad_qui_ate, mad_qui_tem, mad_sex_de, mad_sex_ate, mad_sex_tem, mad_sab_de, mad_sab_ate, mad_sab_tem, mad_dom_de, mad_dom_ate, mad_dom_tem FROM cadastro_profissionais where id_pro = '$id'")or die(mysql_error());
	
	$ter = mysql_fetch_row($termino);
	$i =  0;
	$x = 0;
	$timestamp = strtotime($data);
	
    $semana = date('l', $timestamp);
	list($hora, $min, $seg) = explode(":", $inicio_h, 3);
	/////////////////////////////////////////////////////////////
	if (($semana == 'Monday') || ($semana == 'Segunda-feira'))
	{
		$hora = $ter[$d];
		while ($hora < $ter[$a]) {
			$hora[$i] = somahora($hora,$ter[$t]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}
	}
	///////////////////////////////////////////////////////////////		
	if (($semana == 'Tuesday') || ($semana == 'Terça-feira'))
	{
		$hora = $ter[$d+3];
		while ($hora < $ter[$a+3]) {
			$hora[$i] = somahora($hora,$ter[$t+3]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../login/login.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}	
	}
	////////////////////////////////////////////////////////////////						
	if (($semana == 'Wednesday') || ($semana == 'quarta-feira'))
	{
		$hora = $ter[$d+6];
		while ($hora < $ter[$a+6]) {
			$hora[$i] = somahora($hora,$ter[$t+6]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}		
	}
	//////////////////////////////////////////////////////////////						
	if (($semana == "Thursday") || ($semana == 'Quinta-feira'))
	{
		$hora = $ter[$d+9];
		while ($hora < $ter[$a+9]) {
			$hora[$i] = somahora($hora,$ter[$t+9]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}
	}
	////////////////////////////////////////////////////////////						
	if (($semana == 'Friday') || ($semana == 'Sexta-feira'))
	{
		$hora = $ter[$d+12];
		while ($hora < $ter[$a+12]) {
			$hora[$i] = somahora($hora,$ter[$t+12]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}	
	}
	////////////////////////////////////////////////////////						
	if (($semana == 'Saturday') || ($semana == 'Sábado'))
	{
		$hora = $ter[$d+15];
		while ($hora < $ter[$a+15]) {
			$hora[$i] = somahora($hora,$ter[$t+15]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}
	}
	//////////////////////////////////////////////////////						
	if (($semana == 'Sunday') || ($semana == 'Domingo'))
	{
		$hora = $ter[$d+18];
		while ($hora < $ter[$a+18]) {
			$hora[$i] = somahora($hora,$ter[$t+18]);
			$sql = mysql_query("select * from horario_pro where idprofissional_pro='$id' and inicio_pro='$hora' data_pro=$data");
			$resultado = mysql_fetch_row($sql);
			if ($resultado[0] == '') {
				echo('<script alert("Existem outros horarios agendados") </script>');
				$x = 1;
				echo ("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../horario/visualizar_horarios.php?r=$id_pro&d=$data&i=$inicio'>");
				break;
			}
			$i ++;
		}	
	}
	for ($y=0; $y < $i; $y++){
		mysql_query("INSERT INTO `horarios_pro` (`id_pro`, `id_cad`, `idprofissional_pro`, `inicio_pro`, `hora_cad`, `id_cliente_pro`, `data_pro`, `observacoes`) VALUES ('', '$id_cad', '$id', '$hora[$i]', '$hora_cad', '$id_cli', '$data', '$ob');");
	}
	if ($x==0){
		echo (' <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<font size="+2"> Agendamento concluído com sucesso! </font>
								
								<form name="voltar">
								     <a href="../horario/visualizar_horarios.php?p='.$id.'"> <input type="button" name="Ok" value="Voltar"> </a>
								</form>
							  ');
	}else
					{
						echo(' <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possível concluir o agendamento, <br> por favor tente mais tarde. <br><br></font>
							   <form name="voltar">
								     <a href="../horario/visualizar_horarios.php?p='.$id.'"> <input type="button" name="Ok" value="Voltar"> </a>
								</form>
							  ');
					}
	
}
?>


</body>
</html>