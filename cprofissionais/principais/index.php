<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Home </title>	
        	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	     header('Content-Type: text/html; charset=utf-8');
	     //header("Location: http://www.google.com");
	    ?>
		<link href="../estilos/home.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../calendario/_scripts/jquery.js"></script>
		<style>
			<!--
			.intro{
			position:absolute;
			left:0;
			top:0;
			layer-background-color:orange;
			background-color:orange;
			border:0.1px solid orange
			}
			-->
		</style>

	</head>	
	<!-- #################################################################################### -->
	<body bgcolor="#000000">
	<div id="i1" class="intro"></div>
	<script language="JavaScript1.2">
		//alterar a velocidade aqui
		var speed=1;
		if (document.layers){
		var reference=window.innerWidth/window.innerHeight
		var temp=eval("document.i1.clip")
		temp.left=temp.top=0
		temp.right=window.innerWidth
		temp.bottom=window.innerHeight
		}
		else if (document.all){
		var reference=document.body.clientWidth/document.body.clientHeight
		var rightclip,leftclip,topclip,bottomclip
		var temp=document.all.i1.style
		topclip=leftclip=0
		rightclip=temp.width=document.body.clientWidth
		bottomclip=temp.height=document.body.clientHeight
		}


		function doit(){
		window.scrollTo(0,0)
		if (document.layers){
		if (temp.left>window.innerWidth/2)
		clearInterval(stopit)
		temp.left+=reference*speed
		temp.top+=speed
		temp.right-=reference*speed
		temp.bottom-=speed
		}
		else if (document.all){
		if (leftclip>document.body.clientWidth/2)
		clearInterval(stopit)
		temp.clip="rect( "+topclip+" "+rightclip+" "+bottomclip+" "+leftclip+")"
		leftclip+=reference*speed
		topclip+=speed
		rightclip-=reference*speed
		bottomclip-=speed
		}
		}
		stopit=setInterval("doit()",100)

	</script>



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
				 header('Content-Type: text/html; charset=utf-8');
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
		    echo(' </div> 
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_preferred_2"></a>
					<a class="addthis_button_preferred_3"></a>
					<a class="addthis_button_preferred_4"></a>
		        </div>');
	        include_once("human_gateway_client_api/HumanClientMain.php");
            echo(' <form name="consulta" method="post">
                <div id="corpo">
                    <div class="opcao" style="top: 70px; left: 130px;">
                                <a href="../principais/lista.php?r=advogado">		
                                    <img src="../imagens/advogados.png" class="image" />
                                    <h10> Advogados </h10>
                                </a>
                    </div>
                        
                    <div class="opcao" style="top: 170px; left: 130px;">
                            
                            <a href="../principais/lista.php?r=dentista">
                                <img src="../imagens/dentista.png" class="image" />
                                <h10> Dentistas </h10>
                            </a>
                            <input type="hidden" name="md5(dentistas)">
                    </div>
                    
                    <div class="opcao" style="top: 70px; left: 350px">
                            <a href="../principais/lista.php?r=informatica">
                                <img src="../imagens/informatica.png" class="image" />
                                <h10> Informática </h10>
                            </a>
                            <input type="hidden" name="informatica">
                    </div>
                    
                    <div class="opcao" style="top: 170px; left:350px">
                            <a href="../principais/lista.php?r=medico">		
                                <img src="../imagens/medicina.png" class="image" />
                                <h10> Médicos </h10>
                                <input type="hidden" name="medicos">
                            </a>
                    </div> '); 					
			?>
                </div>  <!-- Fecha a div "Corpo" -->
            </form>
            <!--<div id="rodape">
                <font color="#FFFFFF">	Todos os direitos reservados </font>
            </div>-->
        </div>  <!-- Fecha a div "Principal"-->

	</body>
</html>
