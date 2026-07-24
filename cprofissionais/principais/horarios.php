<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Horarios </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
        <script src='./js/horarios.js'></script>
	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
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
            <?php
				session_start();
				//Não faz nada
			?>
            <div class='conteudo'>
                    <h1>Horarios Disponíveis</h1> 
                
                        <form action='horarios.php?r=$r' name='pesquisa'>
                                Data:<input type='text' value='' name='data'/>
                                <input type='submit' value='Pesquisar'>
                                <a href='../principais/horarios.php?r=$r' target='_self'>Pesquisar</a>
                        </form>

                    <form action='../login/login.php' name='form1'>
                        <div class='busca'>
                        </div>
                    </form>

                    <a style='right: 0px; position: absolute;' href='../principais/index.php'>INICIO</a>
                    <hr/>
                    
    <!-- ##################################################################################### -->
                    <div id="mostrar" style="top:500px;" >
                     <font color="#FFFFFF"> <br><br><br><br><br><br><Br><br><br><Br><br>
					<?
                        //FUNÇÃO DATE()
                        $data = date("Y/m/d");
                        $dat = $_GET["data"];
                        $datum = $_GET["data"];
						
                        include '../funcoes/conecta.php';
                        mysql_select_db(BASE,$cn)or die(mysql_error());
                        $r = $_COOKIE["pro"];
                        $e = 0;
                        //$vet1 = Array();
                        //$vet2 = Array();
                        
                        $busca=mysql_query('SELECT id_pro,idprofissional_pro, inicio_pro, termino_pro FROM horarios_pro where idprofissional_pro = \'$r\'')or die(mysql_error());
                        if($dat.length>0){
							//$busca2=mysql_query('SELECT id,idprofissional, idcliente, data, inicio, termino FROM agenda where data=\'$dat\' and idprofissional = \'$r\'ORDER BY data')or die(mysql_error());
                        }else{
                            //$busca2=mysql_query('SELECT id,idprofissional, idcliente, data, inicio, termino FROM agenda where data=\'$data\' and idprofissional =\'$r\'ORDER BY data')or die(mysql_error());		
                        }
                        $c1=mysql_num_rows($busca);//recebendo quantidade de registros que possui a tabela horario
                        $c=0;
                        $c2=mysql_num_rows($busca2);//recebendo quantidade de registros para a tabela agenda
                        
                                        
                        if($c1==0){
                            echo "Este profissional nao disponibilizou nenhum horario para a agenda.";
                        }else{
                            while($ver=mysql_fetch_row($busca)){
                                $id=$ver[0]; 
                                $idprofissional=$ver[1];
                                $inicio=$ver[2];
                                $termino=$ver[3];
                                $e=0;
                                $vet1[]="$inicio";
                                $c+=1;
                                //echo"$c";
                            }
                            $c=0;
                            while($ver2=mysql_fetch_row($busca2)){
                                $id2=$ver2[0]; 
                                $idprofissional2=$ver2[1];
                                $idcliente2=$ver2[2];
                                $data2=$ver2[3];		
                                $inicio2=$ver2[4];
                                $termino2=$ver2[5];
                                $obs2=$ver2[6];
                                $vet2[]="$inicio2";
                                $c+=1;
                                //echo"$c";
                            }
                            
                            for($i=0; $i < $c1; $i++){
                                
                                for($i2=0; $i2 < $c2; $i2++){
                                    if($vet1[$i]==$vet2[$i2]){
                                        $e=1;
                                    }
                                }
                                if($e==1){
                                    $e=0;
                                }else{
                                    echo"$vet1[$i]&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <a href='../login/login.php?r=$idprofissional&horario=$vet1[$i]&data=$data'>Agendar</a><br/>";
                                }
                            }
                        
                        }	
						;
					?>		
                    </font>	
				</div>
			</div>
		</div> <!-- Fecha a div Principal -->
	</body>
</html>