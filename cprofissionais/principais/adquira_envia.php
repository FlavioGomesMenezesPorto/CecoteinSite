<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> CProfissionais - Adquira sua agenda </title>
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
				if(isset($_COOKIE['cli']))
					$id_cli = $_COOKIE["cli"];
				else
					$id_cli = 0;

				if(isset($_COOKIE['pro']))
					$id = $_COOKIE["pro"];
				else
					$id = 0;
			?>
             <div id="menu">
            	<?php include '../funcoes/menu.php' ?>
            </div>
            
            <div id="corpo" >
                <center>
			<?php
            $nome = $_POST["nome"];
			$rg = $_POST["rg"];
			$cpf = $_POST["cpf"];
			$razao = $_POST["razao"];
			$end = $_POST["logradouro"];
			$bairro = $_POST["bairro"];
			$cidade = $_POST["cidade"];
			$uf = $_POST["uf"];
			$cep = $_POST["cep"];
			$email = $_POST["email"];
			$tel = $_POST["tel"];
			$cel = $_POST["cel"];
			$mensagem = $_POST["mensagem"];
			
			$subject = "Pedido do site CProfissionais";
            $message = "
                 
                    Nome = $nome
					RG = $rg
					CPF = $cpf
					Razão social = $razao
					Logradouro = $end
					Bairro = $bairro
					Cidade = $cidade
					UF = $uf
					CEP = $cep
					Email = $email
					Telefone = $tel
					Celular = $cel
					
					Mensagem = $mensagem
                    ";
            /*
                $headers = "MIME-Version: 1.0 \r\n"; 
                $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n"; 
                $headers .= "To: <mauricio@cecotein.com.br> \r \n"; 
                $headers .= "From: <formulario> \r \n";
                $headers .= "Reply-To: $nome <$mail> \r\n"; 
            */
            
            //$header = "From: ". $nome . " <" . $mail . ">\r\n";
            $headers  = "MIME-Version: 1.1\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "From: cprofissionais@cecotein.com.br \r\n"; // remetente
            $headers .= "Return-Path: mauricio@cecotein.com.br \r\n"; // return-path
            $to="mauricio@cecotein.com.br";
            
            $envio = mail("mauricio@cecotein.com.br", $subject, utf8_decode($message), $headers);
            
			$envio = false; // Apenas para apresentação;
			 
            if($envio)
            
               echo ('<img src="../imagens/confirma.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
                    Pedido enviado com sucesso!
                    <br><p align="right"> <a href="javascript:history.back(2);"><input type="button" name="voltar" value="Voltar"></a> </p>');
            
            else
            
                echo(' <img src="../imagens/atencao.png" width="60px" height="60px" title="Confirmado" name="Confirmado" value="confirmado" align="absmiddle"> &nbsp&nbsp&nbsp&nbsp&nbsp
                Não foi possível enviar o pedido, por favor tente mais tarde!  
                <br><p align="right"> <a href="javascript:history.back(2);"><input type="button" name="voltar" value="Voltar"></a> </p>');
            
            
            ?>
            	</center>
            </div> <!-- Fecha a div Conteudo -->
        </div> <!-- Fecha a div Principal -->
	</body>
</html>