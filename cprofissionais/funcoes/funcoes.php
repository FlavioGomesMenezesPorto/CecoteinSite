<?php

	function Mostrar_resultado($data, $hora, $horario, $id, $id_cli, $int)
	{
		date_default_timezone_set('UTC');
		$dt = strtotime($data);
		$dt = date('Y-m-d',$dt);
		echo (' <form>
		<table align="center" style="width:800px;">
			<tr>
				<td align="center" valign="middle"> 
					<center> <img src="../imagens/confir_hor.png" width="120px" height="120px"> </center>
				</td>
				<td>
				   &nbsp&nbsp&nbsp&nbsp&nbsp
				</td>
				<td>
					<br><br><br> <font size="+2">
					Horário Disponível:
					<br><br>
					'.$data.' às '.$hora.'
					<br><br> 
					<form name="confirmar">
						<a href="../horario/confirmado_1.php?r='.$id.'&i='.$horario.'&d='.$dt.'"><input type="button" name="confirma" value="Confirmar agendamento"></a>
						<a href="../horario/proximo.php?r='.$id.'&h='.$horario.'&int='.$int.'&d='.$data.'"> <input type="button" name="proximo" value="Próximo Horário" ></a>
						<a href="../horario/cad_horario_1.php?r=$id&c=$id_cli"> <input type="button" name="voltar" value="Voltar"></a> 
					</form> </font> 
				</td>
			</tr>
			</table>
		</form>');
		return true;
	}
	
	function Mostra_nao_encontrou ($data, $hora, $horario, $id, $id_cli, $int)
	{
		echo (' <br><br><br>
		<form>
		<table align="center" style="width:800px;">
			<tr>
				<td align="center" valign="middle"> 
					<img src="../imagens/cancelar.png" width="60px" height="60px" align="middle">
				</td>
				<td>
				   &nbsp&nbsp&nbsp&nbsp&nbsp
				</td>
				<td>
					<font size="+2">
					Nenhum horário disponível encontrado nessa escolha! <br><br><br>');
			echo ('<form name="voltar">
					<a href="../horario/proximo.php?r='.$id.'&h='.$horario.'&int='.$int.'&d='.$data.'"> <input type="button" name="proximo" value="Próximo Horário"></a>
					<a href="../horario/cad_horario_1.php?r=$id"> <input type="button" name="voltar" value="Voltar"></a> 
					</form></font>
				</td>
			</tr>
		</table>
		</form>');
		
	}
	
	function mostra_vazio($id, $id_cli)
	{
		date_default_timezone_set('UTC');
		
		$valores = mysql_query("select man_seg_de, man_seg_tem from cadastro_profissionais where id_pro='$id'");
		$val = mysql_fetch_row($valores);
		
		$horario = $val[0];
		$int = $val[1];
		
		$data = date('Y-m-d');
		
		echo(' <br><br><br> <font size="+2">
					Nenhum horário marcado!
				<form name="voltar">
				<a href="../horario/proximo.php?r='.$id.'&h='.$horario.'&int='.$int.'&d='.$data.'"> <input type="button" name="proximo" value="Próximo Horário" ></a>
				<a href="../horario/cad_horario_1.php?r=$id&c=$id_cli"> <input type="button" name="voltar" value="Voltar"></a> 
				</form></font>');
	}
	
	
	function VerificaFotoPro($nome)
	{
		$erro = $config = array();
		
		// Prepara a variável do arquivo
		$arquivo = isset($_FILES[$nome]) ? $_FILES[$nome] : FALSE;
		
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = 358400;
		// Largura máxima (pixels)
		$config["largura"] = 600;
		// Altura máxima (pixels)
		$config["altura"]  = 600;
		
		// Formulário postado... executa as ações
		if($arquivo)
		{  
			// Verifica se o mime-type do arquivo é de imagem
			//if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
			if(preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["type"]))
			{
				$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
					bmp, gif ou png. Envie outro arquivo";
			}
			else
			{
				// Verifica tamanho do arquivo
				if($arquivo["size"] > $config["tamanho"])
				{
					$erro[] = "Arquivo em tamanho muito grande! 
				A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
				Envie outro arquivo <br> ";
				}
				
				// Para verificar as dimensões da imagem
				$tamanhos = getimagesize($arquivo["tmp_name"]);
				
				// Verifica largura
				if($tamanhos[0] > $config["largura"])
				{
					$erro[] = "Largura da imagem não deve 
						ultrapassar " . $config["largura"] . " pixels<br>";
				}
		
				// Verifica altura
				if($tamanhos[1] > $config["altura"])
				{
					$erro[] = "Altura da imagem não deve 
						ultrapassar " . $config["altura"] . " pixels<br>";
				}
			}
			
			// Imprime as mensagens de erro
			if(sizeof($erro))
			{
				foreach($erro as $err)
				{
					echo " - " . $err . "<BR>";
				}
		
				echo "<a href=\"../cadastro/cadastroprofissionais.php\">Fazer Upload de Outra Imagem</a> <br><br>";
			}

			else
			{
				 // Pega extensão do arquivo
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
		
				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		
				// Caminho de onde a imagem ficará
				$imagem_dir = "../imagens/profissionais/" . $imagem_nome;
				
				$vet[0] = $imagem_dir;
				$vet[1] = 1;
				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				return $vet;
			}
		}
	}
    
	function VerificaFotoCli($nome)
	{
		$erro = $config = array();
		
		// Prepara a variável do arquivo
		$arquivo = isset($_FILES[$nome]) ? $_FILES[$nome] : '';
		
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = 358400;
		// Largura máxima (pixels)
		$config["largura"] = 600;
		// Altura máxima (pixels)
		$config["altura"]  = 600;
		
		// Formulário postado... executa as ações
		if($arquivo)
		{  
			// Verifica se o mime-type do arquivo é de imagem
			//if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
			if(preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["type"]))
			{
				$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
					bmp, gif ou png. Envie outro arquivo";
			}
			else
			{
				// Verifica tamanho do arquivo
				if($arquivo["size"] > $config["tamanho"])
				{
					$erro[] = "Arquivo em tamanho muito grande! 
				A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
				Envie outro arquivo <br> ";
				}
				
				// Para verificar as dimensões da imagem
				$tamanhos = getimagesize($arquivo["tmp_name"]);
				
				// Verifica largura
				if($tamanhos[0] > $config["largura"])
				{
					$erro[] = "Largura da imagem não deve 
						ultrapassar " . $config["largura"] . " pixels<br>";
				}
		
				// Verifica altura
				if($tamanhos[1] > $config["altura"])
				{
					$erro[] = "Altura da imagem não deve 
						ultrapassar " . $config["altura"] . " pixels<br>";
				}
			}
			
			// Imprime as mensagens de erro
			if(sizeof($erro))
			{
				foreach($erro as $err)
				{
					echo " - " . $err . "<BR>";
				}
		
				echo "<a href=\"../cadastro/cadastrocliente.php\">Fazer Upload de Outra Imagem</a> <br><br>";
			}

			else
			{
				 // Pega extensão do arquivo
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
		
				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		
				// Caminho de onde a imagem ficará
				$imagem_dir = "../imagens/profissionais/" . $imagem_nome;
				
				$vet[0] = $imagem_dir;
				$vet[1] = 1;
				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				return $vet;
			}
		}
	}
	
	function VerificaFotoEmp($nome)
	{
		$erro = $config = array();
		
		// Prepara a variável do arquivo
		$arquivo = isset($_FILES[$nome]) ? $_FILES[$nome] : FALSE;
		
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = 358400;
		// Largura máxima (pixels)
		$config["largura"] = 600;
		// Altura máxima (pixels)
		$config["altura"]  = 600;
		
		// Formulário postado... executa as ações
		if($arquivo)
		{  
			// Verifica se o mime-type do arquivo é de imagem
			//if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
			if(preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["type"]))
			{
				$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
					bmp, gif ou png. Envie outro arquivo";
			}
			else
			{
				// Verifica tamanho do arquivo
				if($arquivo["size"] > $config["tamanho"])
				{
					$erro[] = "Arquivo em tamanho muito grande! 
				A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
				Envie outro arquivo <br> ";
				}
				
				// Para verificar as dimensões da imagem
				$tamanhos = getimagesize($arquivo["tmp_name"]);
				
				// Verifica largura
				if($tamanhos[0] > $config["largura"])
				{
					$erro[] = "Largura da imagem não deve 
						ultrapassar " . $config["largura"] . " pixels<br>";
				}
		
				// Verifica altura
				if($tamanhos[1] > $config["altura"])
				{
					$erro[] = "Altura da imagem não deve 
						ultrapassar " . $config["altura"] . " pixels<br>";
				}
			}
			
			// Imprime as mensagens de erro
			if(sizeof($erro))
			{
				foreach($erro as $err)
				{
					echo " - " . $err . "<BR>";
				}
		
				echo "<a href=\"../cadastro/cadastroempresa.php\">Fazer Upload de Outra Imagem</a> <br><br>";
			}

			else
			{
				 // Pega extensão do arquivo
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
		
				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		
				// Caminho de onde a imagem ficará
				$imagem_dir = "../imagens/profissionais/" . $imagem_nome;
				
				$vet[0] = $imagem_dir;
				$vet[1] = 1;
				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				return $vet;
			}
		}
	}
	
	function CarregaImagem($nome,$id,$f)
	{
		$erro = $config = array();
		//echo('nome ='.$nome);
		// Prepara a variável do arquivo
		$arquivo = isset($_FILES[$nome]) ? $_FILES[$nome] : FALSE;
		
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = 358400;
		// Largura máxima (pixels)
		$config["largura"] = 600;
		// Altura máxima (pixels)
		$config["altura"]  = 600;
		//echo('arquivo='.$arquivo);
		
		// Formulário postado... executa as ações
		if($arquivo)
		{  
			// Verifica se o mime-type do arquivo é de imagem
			//if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
			if(preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["type"]))
			{
				$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
					bmp, gif ou png. Envie outro arquivo";
			}
			else
			{
				// Verifica tamanho do arquivo
				if($arquivo["size"] > $config["tamanho"])
				{
					$erro[] = "Arquivo em tamanho muito grande! 
				A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
				Envie outro arquivo <br> ";
				}
				
				// Para verificar as dimensões da imagem
				$tamanhos = getimagesize($arquivo["tmp_name"]);
				
				// Verifica largura
				if($tamanhos[0] > $config["largura"])
				{
					$erro[] = "Largura da imagem não deve 
						ultrapassar " . $config["largura"] . " pixels<br>";
				}
		
				// Verifica altura
				if($tamanhos[1] > $config["altura"])
				{
					$erro[] = "Altura da imagem não deve 
						ultrapassar " . $config["altura"] . " pixels<br>";
				}
			}
			
			// Imprime as mensagens de erro
			if(sizeof($erro))
			{
				foreach($erro as $err)
				{
					echo " - " . $err . "<BR>";
				}
		
				echo "<a href=\"../cadastro/altera_foto1.php?f=$f\">Fazer Upload de Outra Imagem</a> <br><br>";
			}

			else
			{
				 // Pega extensão do arquivo
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
		
				// Gera um nome único para a imagem
				$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		
				// Caminho de onde a imagem ficará
				$imagem_dir = "../imagens/profissionais/" . $imagem_nome;
				//$imagem_dir = "/" . $imagem_nome;
				$vet[0] = $imagem_dir;
				$vet[1] = 1;
				// Faz o upload da imagem
				move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				
				return $vet;
			}
		}
	}
	
	function Verifica_dia($dia_semana)
	{
		$m = $t = $n = $d = 0;
		switch ($dia_semana)
		{
			case "Segunda-feira" : 	
				$m = 0;
				$t = 21;
				$n = 42;
				$d = 63;
				break;
			case "Terça-feira" :
				$m = 3;
				$t = 24;
				$n = 45;
				$d = 66;
				break;
			case "Quarta-feira" :
				$m = 6;
				$t = 27;
				$n = 48;
				$d = 69;
				break;
			case "Quinta-feira" :
				$m = 9;
				$t = 30;
				$n = 51;
				$d = 72;
				break;
			case "Sexta-feira" :
				$m = 12;
				$t = 33;
				$n = 54;
				$d = 75;
				break;
			case "Sábado" :
				$m = 15;
				$t = 36;
				$n = 57;
				$d = 78;
				break;
			case "Domingo" :
				$m = 18;
				$t = 38;
				$n = 60;
				$d = 81;
				break;									
		}
		
		$valor[0] = $m;
		$valor[1] = $t;
		$valor[2] = $n;
		$valor[3] = $d;
		
		return $valor;
	}
	
	function Verifica_day($dia_semana)
	{
		$m = $t = $n = $d = 0;
		switch ($dia_semana)
		{
			case "Monday" : 	
				$m = 0;
				$t = 21;
				$n = 42;
				$d = 63;
				break;
			case "Tuesday" :
				$m = 3;
				$t = 24;
				$n = 45;
				$d = 66;
				break;
			
			case "Wednesday" :
				$m = 6;
				$t = 27;
				$n = 48;
				$d = 69;
				break;
			
			case "Thursday" :
				$m = 9;
				$t = 30;
				$n = 51;
				$d = 72;
				break;
			case "Friday" :
				$m = 12;
				$t = 33;
				$n = 54;
				$d = 75;
				break;
			case "Saturday" :
				$m = 15;
				$t = 36;
				$n = 57;
				$d = 78;
				break;
			case "Sunday" :
				$m = 18;
				$t = 38;
				$n = 60;
				$d = 81;
				break;									
		}
		
		$valor[0] = $m;
		$valor[1] = $t;
		$valor[2] = $n;
		$valor[3] = $d;
		
		return $valor;
	}
	function controla_dia($dia , $id)
	{
		switch ($dia)
		{
			case "Monday" : $campo = "Select man_seg_de from cadastro_profissionais where id_pro = $id";
							break; 
			case "Tuesday" : $campo = "Select man_ter_de from cadastro_profissionais where id_pro = $id"; 
							 break;
			case "Wednesday" : $campo = "Select man_qua_de from cadastro_profissionais where id_pro = $id"; 
							  break;
			case "Thursday" : $campo = "Select man_qui_de from cadastro_profissionais where id_pro = $id"; 
							  break;
			case "Friday" : $campo = "Select man_sex_de from cadastro_profissionais where id_pro = $id"; 
						    break;
			case "Saturday" : $campo = "Select man_sab_de from cadastro_profissionais where id_pro = $id"; 
							  break;
			case "Sunday" : $campo = "Select man_dom_de from cadastro_profissionais where id_pro = $id"; 
						    break;
		}
		
		return $campo;
	}

	function substitui_str($texto)
	{
		$final = str_replace('\'','"',$texto);
		
		return $final;
	}
	
	function verificaID($hora, $data, $id)
	{
		//echo('entrou na função');
		//echo('Select id_pro from horarios_pro where inicio_pro = '.$hora.' and data_pro = '.$data.' and idprofissional_pro = '.$id);
		$pesquisa = mysql_query("Select id_pro from horarios_pro where inicio_pro = '$hora' and data_pro = '$data' and idprofissional_pro = '$id'") or die(mysql_error());
		
		$id = mysql_fetch_row($pesquisa);
		return $id[0];
	} 
	
	function ValidaData($data)
	{
		$dt = substr($data, pos($data,'-')+1, 2);
		echo($dt.' data <br> ');
	}
	
	function MostraDia($dia)
	{
		switch ($dia)
		{
			case "Segunda-feira" : $tag = 0;
				break; 
			case "Terça-feira"   : $tag = 1;
				break;
			case "Quarta-feira"  : $tag = 2;
				break;
			case "Quinta-feira"  : $tag = 3;
				break;
			case "Sexta-feira"   : $tag = 4;
				break;
			case "Sábado"        : $tag = 5;
				break;
			case "Domingo"       : $tag = 6;
				break;
		}
		
		return $tag;
	}
		
?>

<script>
function mascara(src, mask)
{
	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida)
	{
		src.value += texto.substring(0,1);
	}
}

</script>

<script>
function mascara_tel(src, mask)
{
	var i = src.value.length;
	var saida = mask.substring(1,2);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida)
	{
		src.value += texto.substring(0,1);
	}
}

</script>

<script>
function manda_data(data)
{
	alert(data.value);
	//alert('entrou na função 1');
	alert(document.getElementById(data).value);
	//data = document.getElementById(data).value;
	alert(data);
	return data.value;
}
	
function manda_hora(hora)
{
	alert('entrou na função 2');
	var hora = document.getElementById(hr).value;
	alert(hora);
	//return data;
}
</script>