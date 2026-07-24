<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>
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
               <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a>

            </div>
            
            <div id="flash" >
               <!--<object width="1500px" height="65px">
                     <param name="movie" value="../menu/Menu.swf">
                     <param name="wmode" value="transparent" />
                     <embed wmode="transparent" src="../menu/Menu.swf" width="900px" height="60px" />
                </object> -->
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
				print("idpro = $id");
				
           echo(' <div id="menu">');
		   
		   	include '../funcoes/menu.php';
           
		   echo(' </div> ');
		   
		   include '../funcoes/conecta.php';
		   mysql_select_db(BASE,$cn)or die(mysql_error());
           date_default_timezone_set('UTC');
		   
		   //--- Definindo variáveis ------------
		   
		       $x = 0;
			
		   //------------------------------------
		   	           
		   $pesquisa = mysql_query("Select nome_pro, empresa from cadastro_profissionais where id_pro = '$id'") or die(mysql_error());
		   $dest = mysql_fetch_row($pesquisa);
		   
		   echo('<div id="corpo">');
		   echo('<img src="../imagens/agenda_recado.png" alt="recados" title="recados" width="100px" height="100px" align="left">');
		   echo('<p align="right"><a href="javascript:history.back(1);"><input type="button" name="voltar" value="Voltar"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </p>');
		   if ($id == 0 )
		   {
			   echo("<br><br><br> Nenhum profissional logado no sistema! 
			   <br><br> <a href='../principais/index.php'><input type='button' name='voltar' title='voltar' value='Voltar'></a>");
			  
		   }
		   else
		   {
			    $pesquisa = mysql_query("Select nome_pro, id_pro, empresa from cadastro_profissionais where empresa like '%".$dest[1]."%' order by nome_pro asc") or die(mysql_error());
		   		
				while ($row = mysql_fetch_assoc($pesquisa))
				{
					$prof[$x][0] = $row['nome_pro'];
					$prof[$x][1] = $row['id_pro'];
					$x = $x + 1;
				}
				
				echo('Selecione o profissional para o qual deseja marcar o recado:');
				
				echo(' <table cellpadding="5px" cellspacing="5px" align="center" ');
				echo('<tr> <td> <br> </td></tr> ');
				
				for($y = 0 ; $y < $x ; $y++ )
				{
					echo('<tr>
							<td> <a href="../cadastro/recado.php?p='.$prof[$y][0].'&i='.$prof[$y][1].'">'.$prof[$y][0].'</a></td>
						   </tr>');
				}
				echo(' </table> ');
				echo("</font>");
		   }
		   // Colocar o nome no textbox ;)
           echo('</div>  <!-- Fecha a div "Corpo" -->');
           
         ?>   
         <table ><tr><td>
            <!--<div id="rodape" >
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
            </td></tr>
         </table>
        </div>  <!-- Fecha a div "Principal"-->
	</body>
</html>
