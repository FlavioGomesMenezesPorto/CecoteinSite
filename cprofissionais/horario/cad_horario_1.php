<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Cadastro de horário </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/cadastro.css" type="text/css" rel="stylesheet">
	</head>	
	<!-- #################################################################################### -->
	<body>
		<div class="principal">

            <div id="cabeca" >
                <a href="http://www.cecotein.com.br"><img src="../imagens/Logo 1.png" width="900px" height="110px" alt="www.cecotein.com.br" title="www.cecotein.com.br" name="CProfissionais"></a> 
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
            
            <div class="principal" style="top: 183px;">
            	<p align="right"><a href="../principais/index.php"><input type="button" name="voltar" value="Voltar"></a></p>
            	<font color="#FFFFFF">
                <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp • Selecione o horário que deseja marcar: </b>
                <?php
				 
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$pro = $_COOKIE["pro"];
				else
					$pro = 0;
				
				$id = $_GET["r"];
				session_start();
				
                echo ('<form method="post" action="../horario/VerificaHorario.php?r='.$id.'&c='.$id_cli.'" name="verifica">
                	<div id="horario">
                     	<br> <input type="checkbox" name="0" id="0" value="00"> 00:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="12" id="12" value="12"> 12:00
						
                        <br> <input type="checkbox" name="1" id="1" value="01"> 01:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="13" id="13" value="13"> 13:00
						
                        <br> <input type="checkbox" name="2" value="02"> 02:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="14" id="14" value="14"> 14:00
						
						
                        <br> <input type="checkbox" name="3" id="3" value="03"> 03:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="15" id="15" value="15"> 15:00
						
                        <br> <input type="checkbox" name="4" id="4" value="04"> 04:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="16" id="16" value="16"> 16:00
						
                        <br> <input type="checkbox" name="5" id="5" value="05"> 05:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="17" id="17" value="17"> 17:00
						
                        <br> <input type="checkbox" name="6" id="6" value="06"> 06:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="18" ,id="18" value="18"> 18:00
						
                        <br> <input type="checkbox" name="7" id="7" value="07"> 07:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="19" id="19" value="19"> 19:00
						
                        <br> <input type="checkbox" name="8" id="8" value="08"> 08:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="20" id="20" value="20"> 20:00
						
                        <br> <input type="checkbox" name="9" id="9" value="09"> 09:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="21" id="21" value="21"> 21:00
						
                        <br> <input type="checkbox" name="10" id="10" value="10"> 10:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="22" id="22" value="22"> 22:00
						
                        <br> <input type="checkbox" name="11" id="11" value="11"> 11:00
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="checkbox" name="23" id="23" value="23"> 23:00
						<br><br><br>
                     </div> <!-- Fecha a div horario -->
                    <div id="semana">
                        <br>
                    	<input type="checkbox" name="segunda" id="segunda" value="segunda"> Segunda <br> 
                        <input type="checkbox" name="terca" id="terca" value="terca"> Terça  <br> 
                        <input type="checkbox" name="quarta" id="quarta" value="quarta"> Quarta <br> 
                        <input type="checkbox" name="quinta" id="quinta" value="quinta"> Quinta <br> 
                        <input type="checkbox" name="sexta" id="sexta" value="sexta"> Sexta <br> 
                        <input type="checkbox" name="sabado" id="sabado" value="sabado"> Sábado <br> 
                        <input type="checkbox" name="domingo" id="domingo" value="domingo"> Domingo <br> 
                    </div> <!-- Fecha a div Semana -->
                    <div id="complemento">
                        ');
						   date_default_timezone_set('UTC'); 
						   $data = date('d-m-Y');
						   $data2 = date('Y-m-d');
                    	   echo(' A partir da data: <input type="text" name="data" id="data" value='.$data.'> '); 
						echo(' <br><br>
                        <input type="submit" name="buscar" value="Buscar horário livre">
                        <input type="reset" name="limpar" value="Limpar">
                        
                    </div>
                </form> '); 
				?>
               </font>
            </div>
         </div>    
	</body>
</html>