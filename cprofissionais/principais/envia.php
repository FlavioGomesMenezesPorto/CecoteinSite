<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Fale Conosco </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
	   header('Content-Type: text/html; charset=utf-8');
	   ?>
		<link href="../estilos/lista.css" type="text/css" rel="stylesheet">
	</head>	
    <!-- #################################################################################### -->
	<body>
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
				session_start();
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

			?>
             <div id="menu">
            	<?php include '../funcoes/menu.php' ?>
            </div>
            
            <div id="corpo" >
                <center>
			<?php
            $assunto = $_POST["assunto"];
            $nome = $_POST["nome"];
            $mail = $_POST["email"];
            $mensagem = $_POST["mensagem"];
            $subject = "Mensagem encaminha do site CProfissionais";
            $message = "
                    
                    Assunto: $assunto
                    Nome: $nome
                    E-mail: $mail
                    Mensagem: $mensagem
                    ";
            /*
                $headers = "MIME-Version: 1.0 \r\n"; 
                $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n"; 
                $headers .= "To: <mauricio@[REDACTED_DB_USERNAME].com.br> \r \n"; 
                $headers .= "From: <formulario> \r \n";
                $headers .= "Reply-To: $nome <$mail> \r\n"; 
            */
            
            //$header = "From: ". $nome . " <" . $mail . ">\r\n";
            $headers  = "MIME-Version: 1.1\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "From: mauricio@[REDACTED_DB_USERNAME].com.br \r\n"; // remetente
            $headers .= "Return-Path: mauricio@[REDACTED_DB_USERNAME].com.br \r\n"; // return-path
            $to="mauricio@[REDACTED_DB_USERNAME].com.br";
            
            $envio = mail("mauricio@[REDACTED_DB_USERNAME].com.br", $subject, utf8_decode($message), $headers);
            
			//$envio = false;
			 
            if($envio)
            
               echo ('<img src="../imagens/confirma.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
                    Mensagem enviada com sucesso!

                    <br><br> <a href="../principais/index.php"><input type="button" value="Voltar" name="voltar">');
            
            else
            
                echo(' <img src="../imagens/atencao.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
                Não foi possível enviar a mensagem, por favor tente mais tarde!  

                <br><br> <a href="../principais/index.php"><input type="button" value="Voltar" name="voltar">');
            
            
            ?>
            	</center>
            </div> <!-- Fecha a div Conteudo -->
        </div> <!-- Fecha a div Principal -->
	</body>
</html>