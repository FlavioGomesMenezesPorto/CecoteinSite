<?php
	/*setcookie("hoje",36,0,"/agendavirtual/");
	$sessao = "hoje";
	echo "O valor do cookie é:" . $_COOKIE["hoje"];
	if(!isset($_COOKIE[$sessao]))
	{
		?>
		<script language="javascript">
			alert('Não foi criado o cookie! ');
		</script>
		<?php
	}*/
	
	include '../funcoes/conecta.php';
	mysql_select_db(BASE,$cn)or die(mysql_error());

	//Fazendo a busca apenas do ID e do nome no db.
	$cpf = !empty($_POST["cpf"])?$_POST["cpf"]:'';
	//$cnpj = !empty($_POST["cnpj"])?$_POST["cnpj"]:'';
	$senha = $_POST["senha"];
	
	// Verifica se tem valores nas variáveis para fazer a verificação
	/*if ($cpf == '')
		if ($cnpj != '')
			$cpf = $cnpj;  */
	
	
	//começa a fazer a validação
	$busca=mysql_query("SELECT cpnjcpf_cli, senha_cli, nome_cli FROM cliente where binary senha_cli='$senha' and cpnjcpf_cli = '$cpf'")or die(mysql_error());
	//verifico se existe dados dentro da tabela clientes_pro.
	
	if(mysql_num_rows($busca) == 0)
	{ // se não tiver, faz a busca na tabela dos profissionais
		
		$busca3 = mysql_query("Select cpf_pro, senha_pro, nome_pro, id_pro from cadastro_profissionais where tipo = 'admin'");
		$resul = mysql_fetch_row($busca3);
		
		if (($resul[0] == $cpf) && ($resul[1] == $senha))
		{
			setcookie("pro", $resul[3],time() + 14400,"/");
			
		    $sessao = "pro";
			//echo "O valor do cookie é:" . $_COOKIE["pro"];
			/*if(!isset($_COOKIE[$sessao]))
			{
				?>
				<script language="javascript">
					alert('Não foi criado o cookie! ');
				</script>
				<?php
			}*/
			
			session_start();
			$_SESSION['admin'] = $cpf;
			if ( isset($_SESSION['admin']))
			{			
				echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/admin.php'>");
			}
			else
			{
				echo (" Não foi criada a sessão !");
			}
		}
		else
		{   
			//verifica a parte das empresas  -------------------------------------------
			
			$busca2 = mysql_query("Select cpf_pro, senha_pro, nome_pro, id_pro from cadastro_profissionais where binary senha_pro = '$senha' and cpf_pro = '$cpf' and tipo = 'profissional'") or die(mysql_error());
			
			// se não houver dados dentro da tabela cadastro_profissionais
			if(mysql_num_rows($busca2) == 0 )
			{
				
				$busca4 = mysql_query("Select cnpj, senha_pro, nome_pro, id_pro from cadastro_profissionais  WHERE BINARY  senha_pro = '$senha' and cnpj = '$cpf' and tipo = 'empresa'") or die(mysql_error());
				
				//se não houver dados dentro da tabela cadastro_profisionais
				if(mysql_num_rows($busca4) == 0 )
				{
					?>
                    <script language="javascript">
                    	alert (' CPF ou SENHA invalidos.' );
						window.location = 'javascript:history.back(1)';
					</script>
                    <?php
				}
				else
				{
					$resul = mysql_fetch_row ($busca4);
				
					setcookie("pro", $resul[3],time() + 14400,"/");
			
					$sessao = "pro";
					//echo "O valor do cookie é:" . $_COOKIE['pro'];
					/*if(!isset($_COOKIE[$sessao]))
					{
						?>
						<script language="javascript">
							alert('Não foi criado o cookie! ');
						</script>
						<?php
					}*/
					
					session_start();
					$_SESSION['emp'] = $cpf;
					if ( isset ($_SESSION['emp']))
					{					
						echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/empresa_princ.php'>");
					}
					else
					{
						echo (" Não foi criada a sessão !");
					}
				}
			}
			else
			{
				// faz a criação da sessão do profissional
				
				$resul = mysql_fetch_row ($busca2);
				setcookie("pro", $resul[3],time() + 14400,"/");
			
				$sessao = "pro";
				//echo "O valor do cookie é:" . $_COOKIE['pro'];
				/*if(!isset($_COOKIE[$sessao]))
				{
					?>
					<script language="javascript">
						alert('Não foi criado o cookie! ');
					</script>
					<?php
				} */
				
				session_start();
				$_SESSION['pro'] = $cpf;
				
				if ( isset ($_SESSION['pro']))
				{						
					echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/prof_princ.php'>");
				}
				else
				{
					echo (" Não foi criada a sessão !");
				}
			}
		}
	}
	else
	{
		$resul = mysql_fetch_row ($busca);
		setcookie("cli", $resul[0],time() + 14400,"/");
			
		$sessao = "cli";
		//echo "O valor do cookie é:" . $_COOKIE['cli'];
		/*if(!isset($_COOKIE[$sessao]))
		{
			?>
			<script language="javascript">
				alert('Não foi criado o cookie! ');
			</script>
			<?php
		} */
		
		session_start();
		$_SESSION['cliente'] = $cpf;
		
		if ( isset ($_SESSION['cliente']))
		{	
			?>
			<script language="javascript">
				alert('Seja bem-vindo! ');
			</script>
            <?php
			
			echo("<META HTTP-EQUIV=Refresh CONTENT='1; URL=../principais/principal.php'>");
		}
		else
		{
			echo (" Não foi criada a sessão !");
		}
	} 
	
?>