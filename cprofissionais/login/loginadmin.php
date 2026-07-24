<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Login </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/login.css" type="text/css" rel="stylesheet">
	</head>	
<!-- #################################################################################### -->
	<body>
        <div class="principal">
           <div class="login">
              <?		
			        $atendente = 'cliente';	
                   echo"<div id='titulo'> LOGIN </div>
							<div id='conteudo' >
								<form action='../horario/cadastrohorario.php' name='login' method='post'>
									<table>
										<tr>
											<td><label for='cpf'>CPF:</label></td>
											<td><input type='text' name='cpf' /></td>
										</tr>
										<tr>
											<td><label for='senha'>Senha:</label></td>
											<td><input type='password' name='senha' /></td>
										</tr>
										<tr>
											<td colspan='2'>
												<input type='submit' name='Enviar' value='enviar'>
												<input type='hidden' name='atende' value='".$atendente."'/>
												<a href='../cadastro/cadastrocliente.php'>Cadastre-se</a>
											</td>
										</tr>
								     </table>
								  </form>	
			     			</div>
			    		</div>";
				?>
                
			</div> <!-- Fecha a div Login -->
        </div> <!-- Fecha a div Principal -->
	</body>
</html>