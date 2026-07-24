<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Alterar senha </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
		<script src="../js/cadastroprofissional.js"></script>
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">
			 <div id="cabeca" >
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
            </div>
            
            <div id="flash" >
                 <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>	
            <div class="conteudo">
            <?php
				session_start();
				include '../funcoes/conecta.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];  //Traz o CPF/CNPJ do cliente
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];   //Traz o IF do profissional
				else
					$id = 0;
				
            echo(' <br><br>
				   <form border="0" name="cadastroprofissional" action="../cadastro/senha1.php" method="post" onsubmit="return verificacadprofissional(this);return verificacpf(this);"  enctype="multipart/form-data">
                   	<table border="0">
					<tr>
						<td> Senha atual: </td>
						<td> <input type="password" name="atual" id="atual" maxlength="40" size="50" > </td>
					</tr>
					<tr>
						<td> Nova Senha: </td>
						<td> <input type="password" name="nova" id="nova" maxlength="40" size="50"> </td>
					</tr>
					<tr>
						<td> Confirmar nova senha: </td>
						<td> <input type="password" name="confirma" id="confirma" maxlength="40" size="50"> </td>
					</tr>
					<tr>
						<td> <input type="submit" name="confirmar" value="Confirmar" onClick=""> </td>
				    </tr>
					</table>
				</form> ');
			?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>
?>