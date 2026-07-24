<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
	   <script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
	   <script language="javascript" type="text/javascript">

	    function submitform1()
			{
				document.getElementById('btn-submit').disabled = true;
				$('#btn-submit').prop('disabled', true);
			}
       </script>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
    
    	<div class="principal">

            <div id="cabeca" >
               <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a>

            </div>
            
            <div id="flash" >
               <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object>-->
                <?php
					include ("../funcoes/menu_teste.html");
				?> 
            </div>
            
            <?php
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
				
				session_start();
				
				$dest = !empty($_GET["p"])?$_GET["p"]:""; //nome
				$mes = !empty($_POST["mens"])?$_POST["mens"]:"";  //mensagem
				$remet = !empty($_GET["i"])?$_GET["i"]:""; //id do destinatario
				
           echo(' <div id="menu">');
		   		include '../funcoes/menu.php';
           echo(' </div> ');
		   
		   include '../funcoes/conecta.php';
		   
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
           
		   //seleciona o nome e a empresa do profissional que está criando o recado
		   $pesquisa = mysql_query("Select nome_pro, empresa, tipo from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
		   $prof = mysql_fetch_row($pesquisa);
		   
		   echo('<div id="corpo">');
		   echo('<img src="../imagens/agenda_recado.png" alt="recados" title="recados" width="100px" height="100px" align="left">');
		   
		   if ($id == 0 )
		   {
			   echo("<br><br><br> Nenhum profissional logado no sistema! 
			   <br><br> <a href='../principais/index.php'><input type='button' name='voltar' title='voltar' value='Voltar'></a>");
			  
		   }
		   else
		   {
				if ( $prof[2] <> 'profissional')
				{
					echo("<br><br><br> Nenhum profissional logado no sistema! 
			  		<br><br> <a href='../principais/index.php'><input type='button' name='voltar' title='voltar' value='Voltar'></a>");
				}
				else
				{
					echo('
					<font face="Arial" color="#FFFFFF" size="+1">
					 <form name="recados" method="post" onsubmit="submitform1()" action="../cadastro/salva_recado.php">
						  <table align="center" style="text-align:left;">
							<tr>
								<td> Para o profissional: <input type="text" size="40" name="nome" id="nome" value="'.$dest.'"> &nbsp&nbsp&nbsp <a href="../cadastro/busca_prof.php"><img src="../imagens/botoes/busca.png" align="absbotton" ></a></td>
							</tr>
							<tr>
								<td> <br></td>
							</tr>
							<tr>
								<td> Mensagem: <br><br> </td>
							</tr>
							<tr>
								<td> <textarea name="mensagem" id="mensagem" cols="50" rows="5" style="font-family:Arial;"></textarea> </td>
							</tr>
							<tr>
								<td> <input type="hidden" name="prof" value="'.$prof[0].'">
									<input type="hidden" name="empresa" value="'.$prof[1].'">
									<br><br>
								</td>
							<tr>	
								<td> <input type="submit" class="btn-submit" id="btn-submit" name="salvar" value="Salvar">	</td>
							</tr>
						   </table>
					 </form> ');
				}
		   }
           echo('</div>  <!-- Fecha a div "Corpo" -->');
           
         ?>   
          <!-- <div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
