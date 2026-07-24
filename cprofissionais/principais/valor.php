<?
session_start();
include '../funcoes/conecta.php';
//$cn = mysql_connect("localhost","root",""); // Usar somente essa parte do código
//mysql_select_db('shoppingvirtualu',$cn)or die(mysql_error());
mysql_select_db(BASE,$cn)or die(mysql_error());
//$dt = $_GET[valor];
$dt = !empty($_GET["valor"])?$_GET["valor"]:"";
//echo('......'.$dt);
if ($dt == 'carnaval') {
	echo('<tr><td>Carnaval - Nacional. </td></tr>');
	$dt2 = '';
} else {
	if ($dt == 'corpusc') {
		echo('<tr><td>Corpus Crist - Nacional. </td></tr>');
	} else {
		$timestamp = strtotime($dt);
		$dt = date('Y-m-d', $timestamp);
		$dt2 = date('d-m', $timestamp);
	}
}

//echo('......'.$dt2);
$k = 0;
//echo($dt);
$sql = "select * from calendario_pro";
$resposta = mysql_query($sql,$cn) or die (mysql_error());
while ($row = mysql_fetch_assoc($resposta)){
	$fixo = $row['fixo'];
	$ql[$k][0] = $row['data'];
	$timestamp2 = strtotime($ql[$k][0]);
	$ql2[$k][0] = date('d-m', $timestamp2);
	
	//echo($ql[$k][0].' == '.$dt.'<br>');
	if ($fixo == 0){
		if ($ql[$k][0] == $dt) {
			$teste = strtotime($ql[$k][0]);
			$ql[$k][0] = date('d-n-Y', $teste);
			$ql[$k][1] = $row['observacoes'];
			$ql[$k][2] = $row['cidade'];
			echo('<tr><td>'.$ql[$k][1].' - '.$ql[$k][2].'. </td></tr>');
		}
	}
	if ($fixo == 1){
		//echo($ql2[$k][0].'=='.$dt2);
		if ($ql2[$k][0]==$dt2) {
			$teste2 = strtotime($ql[$k][0]);
			$ql2[$k][0] = date('d-n-Y', $teste2);
			$ql2[$k][1] = $row['observacoes'];
			$ql2[$k][2] = $row['cidade'];
			echo('<tr><td>'.$ql2[$k][1].' - '.$ql2[$k][2].'. </td></tr>');
		}
	}
	$k = $k +1;
	
}
?>
