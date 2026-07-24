<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Ajuda </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
    	<div class="principal">

            <div id="cabeca" >
               <a href="http://www.[REDACTED_DB_USERNAME].com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.[REDACTED_DB_USERNAME].com.br" title="www.[REDACTED_DB_USERNAME].com.br" name="CProfissionais"></a>

            </div>
            
            <div id="flash" >
                <!-- <object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?>
            </div>
            <?php
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
				
				session_start();
				
				
           echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
         ?>
				<div id="corpo">
                	<img src="../imagens/ajuda_img.png" width="130px" height="100px" align="left">
                    <p align="right"> <a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a> </p>
                    
           			<img src="../imagens/ajuda.png" width="100" height="45" alt="Recados" title="Recados" align="absmiddle">
                        
                     <?
					 	if ($id != 0 )
						{
							$pesquisa = mysql_query("Select tipo from cadastro_profissionais where id_pro = '$id'");
							$tipo = mysql_fetch_row($pesquisa);
							
							if ($tipo == 'profissional')
							{
								echo('	 <p align="justify">
										 <font face="Arial" color="#FFFFFF" size="3">
										  
										 <b> 1) Para visualizar seu perfil cadastrado no sistema: </b> <br><br>
										 &nbsp&nbsp&nbsp 1.1) Clique em "Dados Pessoais" ou em "Perfil" no menu principal; <br><br>
										   
										 <b> 2) Para visualizar os horários agendados: </b> <br><br>
										 &nbsp&nbsp&nbsp&nbsp 2.1) Clique em "Agenda" no menu principal; <br>
										 &nbsp&nbsp&nbsp&nbsp2.2) Ou clique em "Visualizar horários" na página principal dos profissionais que é acessada ao clicar em "Gerencie" no menu lateral; <br><br>
										 
										 <b> 3) Para visualizar seus recados: </b> <br><br>
										 &nbsp&nbsp 3.1) Clique em "Recados" no menu principal; <br>
										 &nbsp&nbsp 3.2) Ou clique em "Visualizar recados" na página principal dos profissionais; <br><br>
										 
										 <b> 4) Para alterar seus dados pessoais: </b> <br><br>
										 &nbsp&nbsp&nbsp 4.1) Clique em "Alterar Dados" na página principal dos profissionais que é acessada ao clicar em "Gerencie" no menu lateral; <br><br>
										 
										  <b> 5) Em caso de outras dúvidas, envie um email para nossos administradores e para isso clique em "Fale Conosco" no menu lateral; </b> <br><br>
										  
										  </font>
										  </p>
										  ');
							}
							else
							{
								echo('	 <p align="justify">
										 <font face="Arial" color="#FFFFFF" size="3">
										  
										 <b> 1) Para visualizar seu perfil cadastrado no sistema: </b> <br><br>
										 &nbsp&nbsp&nbsp 1.1) Clique em "Dados Pessoais" ou em "Perfil" no menu principal; <br><br>
										   
										 <b> 2) Para visualizar os horários dos profissional de sua empresa </b> <br><br>
										 &nbsp&nbsp&nbsp&nbsp 2.1) Clique em "Agenda" no menu principal e depois em "Visualizar horários por profissional" e em seguida selecione o profissional de sua escolha; <br>
										 &nbsp&nbsp&nbsp&nbsp2.2) Ou clique em "Visualizar profissionais " na página principal das empresas que é acessada ao clicar em "Gerencie" no menu lateral e clique em "Horários" na tabela do profissional de sua escolha; <br><br>
										 
										 <b> 3) Para visualizar os recados dos profissionais que trabalham em sua empresa: </b> <br><br>
										 &nbsp&nbsp 3.1) Clique em "Recados" no menu principal; <br>
										 &nbsp&nbsp 3.2) Ou clique em "Visualizar recados" na página principal das empresas; <br><br>
										 
										 <b> 4) Para alterar seus dados pessoais: </b> <br><br>
										 &nbsp&nbsp&nbsp 4.1) Clique em "Alterar Dados" na página principal das empresas que é acessada ao clicar em "Gerencie" no menu lateral; <br><br>
										 
										  <b> 5) Em caso de outras dúvidas, envie um email para nossos administradores e para isso clique em "Fale Conosco" no menu lateral; </b> <br><br>
										  
										  </font>
										  </p>
										  ');
							}
						}
						else
						{
							if ( $id_cli != 0 )
							{
								echo('	 <p align="justify">
										 <font face="Arial" color="#FFFFFF" size="3">
										  
										 <b> 1) Para visualizar seu perfil cadastrado no sistema: </b> <br><br>
										 &nbsp&nbsp&nbsp 1.1) Clique em "Dados Pessoais" ou em "Perfil" no menu principal; <br><br>
										   
										 <b> 2) Para desmarcar um horário </b> <br><br>
										 &nbsp&nbsp&nbsp&nbsp2.1) Clique em "Desmarcar horário" na página principal dos clientes que é acessada ao clicar em "Gerencie" no menu lateral; <br><br>
										 <b> 3) Para marcar um horário </b> <br><br>
										 &nbsp&nbsp 3.1) Clique em "Marcar horário" na página principal dos clientes que é acessada ao clicar em "Gerencie" no menu lateral; <br>
										 &nbsp&nbsp&nbsp 3.2) Ou clique em "Inicio" no menu principal, depois selecione a categoria do profissional desejado e clique em "Horários" no mini-perfil profissional escolhido, em seguida escolha o horário que deseja e de estiver disponével clique nele; <br><br>
										 
										 <b> 4) Para alterar seus dados pessoais: </b> <br><br>
										 &nbsp&nbsp&nbsp 4.1) Clique em "Alterar Dados" na página principal ddos clientes que é acessada ao clicar em "Gerencie" no menu lateral; <br><br>
										 
										  <b> 5) Em caso de outras dúvidas, envie um email para nossos administradores e para isso clique em "Fale Conosco" no menu lateral; </b> <br><br>
										  
										  </font>
										  </p>
										  ');
							}
							else
							{
								echo('	 <p align="justify">
										 <font face="Arial" color="#FFFFFF" size="3">
										 
								<b> 1) Visualizar ou divulgar as informações de um profissional </b> <br><br>
								&nbsp&nbsp&nbsp 1.1) Clicar em "Lista de cadastro" ou "Início" e depois selecione a categoria: Advogado, Dentista, Informática e Médico; <br>
								&nbsp&nbsp&nbsp 1.2) Clicar em "Visualizar ficha inteira" para ver todo o perfil do profissional desejado; <br><br>

								<b> 2) Agendar ou desmarcar os horários com um profissional </b> <br><br>
								&nbsp&nbsp 2.1) Clicar em "Lista de cadastro" ou "Início" e depois selecione a categoria, Advogado, Dentista, Informática e Médico; <br>
								&nbsp&nbsp 2.2) Clicar em "Horários" para ver ou agendar um horário com o profissional desejado; <br><br>
								
								<b> 3) Ter acesso à agenda virtual </b> <br><br>
								&nbsp&nbsp 3.1) Clicar em "Adquira sua agenda" e preencher o formulário para pedido <br><br>
								
								<b> 5) Em caso de outras dúvidas, envie um email para nossos administradores e para isso clique em "Fale Conosco" no menu lateral; </b> <br><br>
										  
							  </font>
							  </p> ');
								
							}
						}
										  
					?>
                </div>  <!-- Fecha a div "Corpo" -->
           
            
           <!-- <div id="rodape">
            	<br><br><br><br><br><br><br><br><br><Br><br>
                <font color="#FFFFFF">	Todos os direitos reservados <br><br> &nbsp; </font> 
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
