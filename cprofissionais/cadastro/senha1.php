<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Alterar senha </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
        <script language="javascript">
		
			function Verifica()
			{
				var atual = document.getElementById("atual").value;
				var nova = document.getElementById("nova").value;
				var confirma = document.getElementById("confirma").value;
				var senha = document.getElementById("pesquisa").value;
				
				if (senha == atual)
				{
					alert(' Senha correta ');
					
					if ( nova == confirma )
					{
						alert('As senhas são iguais ');
					    
						Update("Update cadastro_profissionais set senha_pro = '$nova' where id_pro = '$id'");
						
						//if ( mysql_affected_rows() == 1)
						//{ 
                       	  //  alert(' Dados Alterados com sucesso!');  
						
						///}else 
							// alert(' Não foi possivel alterar a senha, tente novamente mais tarde!'); 
					}
					else
							alert(' As senhas digitadas não são iguais ! ');
							return ('');
				}
				else
					alert('A senha atual está incorreta!'); 
			}
		</script>
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
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="Menu-emp.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../Menu-emp.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu-emp.html");
				?>
            </div>	
            <div class="texto">
            <?php
				session_start();
				include '../funcoes/conecta.php';
				mysql_select_db(BASE,$cn)or die(mysql_error());
				
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
					
				$atual = $_POST["atual"];
				$nova = $_POST['nova'];
				$conf = $_POST['confirma'];
				
				if ($id != 0)
				{
					$pesquisa = mysql_query("Select senha_pro, tipo from cadastro_profissionais where id_pro = '$id'");
					$ver = mysql_fetch_row($pesquisa);
				}
				if ($id_cli != 0)
				{
					$pesquisa = mysql_query("Select senha_cli from cliente where cpnjcpf_cli = '$id_cli'");
					$ver = mysql_fetch_row($pesquisa);
				}
				if ( $ver[0] == $atual )
				{
					if ($nova == $conf)
					{
						
						if ($id != 0)
							mysql_query("Update cadastro_profissionais set senha_pro = '$nova' where id_pro = '$id'");						
							
						if ($id_cli != 0)
							mysql_query("Update cliente set senha_cli = '$nova' where cpnjcpf_cli = '$id_cli'");
						
						if (mysql_affected_rows() != 0)
						{
							echo('<br><br> <img src="../imagens/confirma.png" width="60px" height="60px" align="middle"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
							<font size="+2"> Senha alterada com sucesso!</font> <br><br>');
							
							if($id != 0)
							{
								if ($ver[1] == 'empresa')
									echo('<a href="../cadastro/altera_emp.php"> <input type="button" name="voltar" value="Voltar"></a>');
								else
									echo('<a href="../cadastro/altera_prof.php"> <input type="button" name="voltar" value="Voltar"></a>');	
							}
							if($id_cli != 0)
								echo('<a href="../cadastro/altera_cli.php"> <input type="button" name="voltar" value="Voltar"></a>');
													
						}
						else
						{
							echo('<br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> Não foi possível atualizar seu cadastro, tente novamente mais tarde! </font> <br><br>');
							if($id != 0)
							{
							
								if ($ver[1] == 'empresa')
									echo('<a href="../cadastro/altera_emp.php"> <input type="button" name="voltar" value="Voltar"></a> </p>');
								else
									echo('<a href="../cadastro/altera_prof.php"> <input type="button" name="voltar" value="Voltar"></a> </p>');				
							}
							if($id_cli != 0)
								echo('<a href="../cadastro/altera_cli.php"> <input type="button" name="voltar" value="Voltar"></a>');	
						}
						
					}
					else
					{
						echo('<br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> As senhas digitadas não são iguais, por favor digite novamente! </font> <br><br>
						<a href="../cadastro/senha.php"> <input type="button" name="voltar" value="Voltar"></a> ');
					}
				}
				else
				{
					echo(' <br><br> <img src="../imagens/atencao.png" width="60px" height="60px" align="middle">
						<font size="+2"> A senha atual está incorreta! </font> <br><br>
					<a href="../cadastro/senha.php"> <input type="button" name="voltar" value="Voltar"></a> <br><br>');
				}
				
			   
			   
			?>
            </div> <!-- Fecha a div Conteudo -->
		</div> <!-- Fecha a div Principal -->
	</body>
</html>

