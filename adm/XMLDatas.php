<?php
    include_once("conecta.php");
    
    $Modulos = array("Agenda","Cadastro","CConecta","CEnterprise","CLaborat","COMPRAS","CONTAB","contratos","estoque","FATURAM","Vendas (Exec","Financeiro","Gerador","Hoteleiro","Livros Fiscais","Mesas","Orcamento","Ordem de Serv","de Pessoal","Qualidade","Hospitalar","Tabelas e Segura","Tele-Marketing","Varejo");
    $Names   = array();
    $Dates   = array();
    $QryDownloads = mysql_query("select * from tb_downloads order by nm_down")  or die ("ERRO QUERY DOWNLOADS");

    $i = 0;
    while ($downloads = mysql_fetch_array($QryDownloads)) {
      $nm_down   = $downloads['nm_down'];
      $data_down = $downloads['linkerts_down'];    
      if ($data_down == ''){
        $data_down = $downloads['data_down'];
      }
      //$data_down = $downloads['data_down'];
      //$data_down = substr($data_down,8,2)."/".substr($data_down,5,2)."/".substr($data_down,0,4);
      //2016-12-09 11:27:56
      $data_down = substr($data_down,8,2)."/".substr($data_down,5,2)."/".substr($data_down,0,4).' '.substr($data_down,11,8);
      for ($z = 0;$z <= (count($Modulos)-1);$z++){
        if ((mb_stripos($nm_down,$Modulos[$z]) !== false) and (mb_stripos($nm_down,"2000)") !== false)) {
          array_unshift($Names,$nm_down);
          array_unshift($Dates,$data_down); 
          break;  
        } 
      }
    }

    $Names = array_reverse($Names);
    $Dates = array_reverse($Dates);
    //$xml = new DOMDocument( '1.0', 'utf-8');
    $xi = 0;
    $xml = new DOMDocument('1.0','utf8');
    $xml->formatOutput = true;
    $root = $xml->createElement('DatasModulos');
    $xml->appendChild($root);
    for ($xi = 0;$xi <= (count($Dates)-1);$xi++) {
      $TagName = $xml->createElement("Nome-$xi");
      $TagName->nodeValue = utf8_encode($Names[$xi]);
      $TagDate = $xml->createElement("Data-$xi");
      $TagDate->nodeValue = $Dates[$xi];
      $root->appendChild($TagName);
      $root->appendChild($TagDate);
    }
    Header('Content-type: text/xml');
    echo $xml->saveXML();
?>