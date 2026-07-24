<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../calendario/_style/jquery.click-calendario-1.0.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
<script type="text/javascript" src="../calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>		
<script type="text/javascript" src="../calendario/_scripts/exemplo-calendario.js"></script>
<script src="../cadastro/script.js"></script>
<link href="../estilos/calendario.css" type="text/css" rel="stylesheet">
        <script src="../funcoes/mascaras.js" ></script>
      <script>  
        function submitform1()
			{
				if(document.myform1.onsubmit &&
				!document.myform1.onsubmit())
				{
					return;
				}
			 document.myform1.submit();
			}
			function submitform2()
			{
				if(document.myform2.onsubmit &&
				!document.myform2.onsubmit())
				{
					return;
				}
			 document.myform2.submit();
			}
			function pesquisa(valor)
			{  
				/*valor = document.getElementById(valordata);*/
				//alert(valor);
				//FUNÇÃO QUE MONTA A URL E CHAMA A FUNÇÃO AJAX
				url="valor.php?valor="+valor;
				
				ajax(url);
			}
			function alternativa(valor)
			{  
				/*valor = document.getElementById(valordata);*/
				//alert(valor);
				//FUNÇÃO QUE MONTA A URL E CHAMA A FUNÇÃO AJAX
				url="alternativa.php?valor="+valor;
				
				ajax2(url);
			}
			
		

			</script>
</head>
<body text="#FFFFFF">
<!--<a name="ajuda" onclick="javascript:pesquisa(this.name)">teste</a>-->
<div id="principal">
    <div id="cabeca"  >
                    
                  <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
    </div>
    <div id="flash" >
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
				//header('Content-Type: text/html; charset=utf-8');
				header('Content-Type: text/html; charset=utf-8');
					include ("../funcoes/menu_teste.html");
				?>
            </div>
            

<input type="button" value="voltar" onclick="javasript:history.back(1)"/>
<?php
session_start();
	
    include '../funcoes/conecta.php';
	include '../funcoes/funcoes.php';
	/*echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');*/
$data = date('d-n-Y');	// Salva data atual
echo('teste'.$data);
list($sem1, $sem2, $sem3) = explode('-', $data, 3);
$y = 1;
$data2 = $y.'-'.$sem2.'-'.$sem3;
$timestamp = strtotime($data2);
$data2 = date('d-m-Y', $timestamp);
$semana = date('l',$timestamp);
$z=0;
$k=0;
//$cn = mysql_connect("localhost","root",""); // Usar somente essa parte do código no localhost
//mysql_select_db('shoppingvirtualu',$cn)or die(mysql_error());
mysql_select_db(BASE,$cn)or die(mysql_error());
date_default_timezone_set('UTC');
if(isset($_COOKIE['pro'])){
		$id = $_COOKIE["pro"];
}else{
		$id = 0;
}
$sql = mysql_query("Select cidade_pro, empresa from cadastro_profissionais where id_pro=$id");
$cidade1 = mysql_fetch_row($sql);
//$cidade1[0] = 'Uberaba';
//$cidade1[1] = 'Cecotein informatica ltda';
$sem3 = !empty($_POST["dt"])?$_POST["dt"]:$sem3;
echo(' <div id="principal" style="top: 183px; text-align:center">');
echo('<form name="myform1" method="post" action="calendario.php">');
$anomais = $sem3 +1;
echo('<input type="hidden" name="dt" id="dt" value="'.$anomais.'">');
echo('</form>');
echo('<form name="myform2" method="post" action="calendario.php">');
$anomenos = $sem3 -1;
echo('<input type="hidden" name="dt" id="dt" value="'.$anomenos.'">');
echo('</form>');

echo('<div  style="top: 0px; text-align:center">');
echo('<table border="2" align="center">
<!--<tr><td>
<td></td><td>Digite o nome da cidade</td><td><input type="text" name="cidade"/></td>
</td>
</tr>-->
<tr id="ano">
	<div id="ano"><td id="ano"></td><td align="center" id="ano">'.$sem3.'</td><td align="right" id="proximo3" style="font-siz:80px"><a href="javascript: submitform2()" title="voltar">◄</a><a href="javascript: submitform1()" title="Avançar">►</a></td></div>
</tr>
<tr>
<td colspan="3" align="center"><div id="pagina"></div></td>

</tr>
');
//echo($sq[1].'..'.$id);
for ($x =1; $x <13; $x++){
	 $data3 = '01-'.$x.'-'.$sem3;
	 $timestamp2 = strtotime($data3);
	 $mes[$x] = date('F', $timestamp2);
	 $nd = date('t', $timestamp2);
	 $semana = date('l',$timestamp2);
			$sem2 = $sem2 + 1;
	for ($k=1; $k<=$nd; $k++){
		$v[$k] = '01-01-0001';
		$f2[$k] = '01-01-0001';
		$cidade[$k] = 'cidade';
	}
	if (($x == 1) || ($x == 4) || ($x == 7) || ($x == 10)|| ($x == 13) )  {
		echo('<tr>');
	} 
	echo('<td valign="top">');
	$z= $z + 1;
	 
	 
	 echo('<table border="0" align="center" cellspacing="2" valign="top">
		<tr >
		<td colspan="7" align="center" bgcolor="#66FFFF" style="color:black" valign="top">'.$mes[$x].'</td>
		</tr>
		<tr>
			<td style="color:red">Domingo</td>
			<td >Segunda</td>
			<td>Terça</td>
			<td >Quarta</td>
			<td >Quinta</td>
			<td >Sexta</td>
			<td >Sabado</td>
		</tr>');
		
		if (($semana == 'Sunday') || ($semana == 'Domingo')) //mes q comeca no domingo
		{
			$d = 1;
			
			while ($d <= $nd) {
				echo('<tr>');
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									$empresa[$d] = $row['empresa'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
										//echo($empresa[$d].'=='.$cidade1[1].'<br>');
									}
								}
								
								//echo($ql.'<br>');
								//echo($ql.'=='.$data4[1].' __'.$d.'<br>');
								
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2]=='Sunday')||($data4[2]=='Domingo')||($data4[1]==$v[$d])||($data==$data4[1])||($f==$f2[$d])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td valign="top">'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
				
			}
			//echo('<tr><td><div id="pagina"></div></td></tr>');
			//echo('<div id="pagina"></div>');
		}
		
								
		if (($semana == 'Monday') || ($semana == 'Segunda-feira')) //mes q comeca na segunda
		{	
			$t = 1;
			$d = 1;
			while ($d <= $nd) {
				echo('<tr>');
				if($t == 1) {
					echo('<td></td>');
					for($i = $t ; $i < 7 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//$empresa[$d] = $row['empresa'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
									echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
								} else {
									if (($data4[1] == $v[$d])) {
										if ($cidade[$d] == 'nacional'){
											echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado" >'.$d.'</a></td>');
										} else {
											if ($cidade[$d] == $cidade1[0]){ 
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado" >'.$d.'</a></td>');
											}else {
												echo('<td valign="top">'.$d.'</td>');
											}
										}
									
									} else {
										echo('<td style="color:red">'.$d.'</td>');
									}
								}
							} else {
								echo('<td>'.$d.'</td>');
							}
						}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t = 0;
				}
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
						$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td>'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
								
		if (($semana == 'Tuesday') || ($semana == 'Terça-feira')) //mes q comeca na terca
		{	
			$d = 1;
			$t2 = 1;
			while ($d <= $nd) {
				echo('<tr>');
				if($t2 == 1) {
					echo('<td></td><td></td>');
					for($i = $t2 ; $i < 6 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
										$v[$d] = $data4[1];
										$cidade[$d] = $row['cidade'];
										//echo($data.'=='.$data4[1].' __'.$d.'<br>');
										//echo($v[$d].'<br>');
									}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
							if ($f == $f2[$d]) {
								if ($cidade[$d] == 'nacional'){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
								} else {
									if ($cidade[$d] == $cidade1[0]){ 
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
									}else {
										if ($empresa[$d] == $cidade1[1]){
											echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
										} else {
											echo('<td valign="top">'.$d.'</td>');
										}
									}
								}
							} else {
								if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
									if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
								} else {
									echo('<td>'.$d.'</td>');
								}
							}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t2 = 0;
				}
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								if ($f2[$d] == $ql2){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver feriado">'.$d.'</a></td>');
								} else {
									echo('<td>'.$d.'</td>');
								}
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
								
		if (($semana == 'Wednesday') || ($semana == 'quarta-feira')) //mes q comeca na quarta
		{	
			$d = 1;
			$t3 = 1;
			while ($d <= $nd ) {
				echo('<tr>');
				if($t3 == 1) {
					echo('<td></td><td></td><td></td>');
					for($i = $t3 ; $i < 5 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
							if ($f == $f2[$d]) {
								if ($cidade[$d] == 'nacional'){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
								} else {
									if ($cidade[$d] == 'Aniversario'){ 
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
									}else {
										if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
										} else {
											echo('<td valign="top">'.$d.'</td>');
										}
									}
								}
							} else {
								if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
									if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
								} else {
									echo('<td>'.$d.'</td>');
								}
							}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t3 = 0;
				}
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional') {
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td>'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
								
		if (($semana == "Thursday") || ($semana == 'Quinta-feira'))//mes q comeca na quinta
		{	
			$d = 1;
			$t4 = 1;
			while ($d <= $nd) {
				echo('<tr>');
				if($t4 == 1) {
					echo('<td></td><td></td><td></td><td></td>');
					for($i = $t4 ; $i < 4 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
							if ($f == $f2[$d]) {
								if ($cidade[$d] == 'nacional'){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
								} else {
									if ($cidade[$d] == $cidade1[0]){ 
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
									}else {
										if ($empresa[$d] == $cidade1[1]){
											echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
										} else {
											echo('<td valign="top">'.$d.'</td>');
										}
									}
								}
							} else {
								if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
									if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
								} else {
									echo('<td>'.$d.'</td>');
								}
							}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t4 = 0;
				}
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td>'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
								
		if (($semana == 'Friday') || ($semana == 'Sexta-feira')) //mes q comeca na sexta
		{	
			$d = 1;
			$t5 = 1;
			
			while ($d <= $nd) {
				echo('<tr>');
				if($t5 == 1) {
					echo('<td></td><td></td><td></td><td></td><td></td>');
					for($i = $t5 ; $i < 3 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							//echo($data.'=='.$data4[1].' __'.$d.'<br>');
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
							if ($f == $f2[$d]) {
								if ($cidade[$d] == 'nacional'){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
								} else {
									if ($cidade[$d] == $cidade1[0]){ 
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
									}else {
										if ($empresa[$d] == $cidade1[1]){
											echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
										} else {
											echo('<td valign="top">'.$d.'</td>');
										}
									}
								}
							} else {
								if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								/*	if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {*/
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									//}
								} else {
									echo('<td valign="top">'.$d.'</td>');
								}
							}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t5 = 0;
				}
				
					for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
						$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday') || ($data4[2] == 'Domingo') || ($data4[1] == $v[$d])|| ($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td>'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
								
		if (($semana == 'Saturday') || ($semana == 'Sábado'))//mes q comeca no sabado
		{	
			$d = 1;
			$t6 = 1;
			while ($d <= $nd ) {
				echo('<tr>');
				if($t6 == 1) {
					echo('<td></td><td></td><td></td><td></td><td></td><td></td>');
					for($i = $t6 ; $i < 2 ; $i++ ){
						if ($d <= $nd) {
							$data4[1] = $d.'-'.$x.'-'.$sem3;
							$f = $d.'-'.$x;
							$timestamp3 = strtotime($data4[1]);
							$data4[2] = date('l',$timestamp3);
							$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
							if ($f == $f2[$d]) {
								if ($cidade[$d] == 'nacional'){
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
								} else {
									if ($cidade[$d] == $cidade1[0]){ 
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
									}else {
										if ($empresa[$d] == $cidade1[1]){
											echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
										} else {
											echo('<td valign="top">'.$d.'</td>');
										}
									}
								}
							} else {
								if (($data4[2] == 'Sunday')||($data4[2] == 'Domingo')||($data4[1] == $v[$d])||($data == $data4[1])) {
									if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												}else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
								} else {
									echo('<td valign="top">'.$d.'</td>');
								}
							}
							$d = $d + 1;
						}
					}
					echo('</tr>');
					$t6 = 0;
				}
				for($i = 0 ; $i < 7 ; $i++ ){
					if ($d <= $nd) {
						$data4[1] = $d.'-'.$x.'-'.$sem3;
						$f = $d.'-'.$x;
						$timestamp3 = strtotime($data4[1]);
						$data4[2] = date('l',$timestamp3);
						$sql = "select * from calendario_pro ORDER BY id DESC";
							$resposta = mysql_query($sql,$cn) or die (mysql_error());
							while ($row = mysql_fetch_assoc($resposta)){
								$ql = $row['data'];
								$fixo = $row['fixo'];
								$teste = strtotime($ql);
								if ($fixo == 0) {
									$ql = date('j-n-Y', $teste);
									if ($data4[1] == $ql) {
									$v[$d] = $data4[1];
									$cidade[$d] = $row['cidade'];
									//echo($data.'=='.$data4[1].' __'.$d.'<br>');
									//echo($v[$d].'<br>');
								}
								} else {
									$ql2 = date('j-n', $teste);
									if ($f == $ql2){
										$f2[$d] = $ql2;
										$cidade[$d] = $row['cidade'];
										$empresa[$d] = $row['empresa'];
									}
								}
							}
						if ($f == $f2[$d]) {
							if ($cidade[$d] == 'nacional'){
								echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
							} else {
								if ($cidade[$d] == $cidade1[0]){ 
									echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
								}else {
									if ($empresa[$d] == $cidade1[1]){
										echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="aniversario" title="Ver aniversário" >'.$d.'</a></td>');
									} else {
										echo('<td valign="top">'.$d.'</td>');
									}
								}
							}
						} else {
							if (($data4[2] == 'Sunday')||($data4[2] == 'Domingo')||($data4[1] == $v[$d])||($data == $data4[1])) {
								if ($data == $data4[1]) {
										echo('<td><a name="'.$data4[1].'" id="hoje" href="#" onclick="javascript:pesquisa(this.name)">'.$d.'</a></td>');
									} else {
										if (($data4[1] == $v[$d])) {
											if ($cidade[$d] == 'nacional'){
												echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="nacional" title="Ver feriado">'.$d.'</a></td>');
											} else {
												if ($cidade[$d] == $cidade1[0]){ 
													echo('<td><a name="'.$data4[1].'" href="#" onclick="javascript:pesquisa(this.name)" id="cidade" title="Ver feriado">'.$d.'</a></td>');
												} else {
													echo('<td valign="top">'.$d.'</td>');
												}
											}
										
										} else {
											echo('<td style="color:red">'.$d.'</td>');
										}
									}
							} else {
								echo('<td valign="top">'.$d.'</td>');
							}
						}
						$d = $d + 1;
					}
				}
				echo('</tr>');
			}
			//echo('<tr><td><div></div></td></tr>');
		}
		echo('</table>');
/* echo('</td>');
 if (($x==3) || ($x==6) || ($x==9)) {
	 echo('</tr>');
 } */
 echo('</td>');
 if ($z == 3) {
		echo('</tr>');
		$z= 0;
		//echo('..'.$x);
	} 

}
echo('</tr></table>');
echo('<div id="rodape">');
//echo('<table align="left"> <tr><td>');
/*$sql = "select * from calendario_pro";
$resposta = mysql_query($sql,$cn) or die (mysql_error());
	while ($row = mysql_fetch_assoc($resposta)){
		$pq[0] = $row['data'];
		$pq[1] = $row['observacoes'];
		$pq[2] = $row['cidade'];
		$teste2 = strtotime($pq[0]);
		$pq[0] = date('d-n-Y', $teste2);
		echo ($pq[0].' - '.$pq[1].' - '.$pq[2].'<br>');
	}
echo('</td></tr></table>');*/
echo('<fieldset class="RadioGroup1" style: "padding: 0px; margin: 0px"><legend text:#ffffff>Datas comemorativas</legend>');
echo('<table align="center" border="0"><tr>');
/*echo('<form action="inseredata.php" method="post">');
	echo('Gravar data<br><input type="text" style="width:78px; size="20" value="'.$data.'" name="dt" id="data_2" maxlength="10" 	
	onKeyPress="mascara(this, \'##-##-####\')" onBlur="TestaData(this)"></td><td>Observacoes<br><input type="text" name="ob"><td>Cidade<br><input type="text" name="cid"><input 
	type="submit" value="ok"/>');*/
if(isset($_COOKIE['pro'])){
		$id = $_COOKIE["pro"];

echo("
	<td ><input style='width:120px' type='button' name='gravar.".$data."' value='Novo' onClick='alternativa(this.name)' /></td>
	<td ><input style='width:120px' type='button' name='apagar.".$data."' value='Excluir' onClick='alternativa(this.name)' /></td>
	<td ><input style='width:120px' type='button' name='alterar.".$data."' value='Alterar' onClick='alternativa(this.name)' /></td>
	
</tr>

</table>");
//echo('<a href="alternativa(this.name)" id="datas">Datas comemorativas</a>');
}else{
		$id = 0;
}
//echo('<div id="b_aniversario"><a href="calendario.php">Aniversario</a></div>');
//echo('</div>');
echo('<div id="area"></div></fieldset>');
?>
</div>

</body>
</html>
