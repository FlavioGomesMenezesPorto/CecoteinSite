<?php
    function GetLinkerTimeStampEx($ExeName) {
      ///usr/bin/public_html/adm/
      $ExecutableDate = escapeshellcmd("GetTimeStampPro.exe ".$ExeName." -Date");
      $ExecutableTime = escapeshellcmd("GetTimeStampPro.exe ".$ExeName." -Time") ;
      exec($ExecutableDate, $out, $Idate);
      echo "Saída da Data: ".$Idate."<br>";
      exec($ExecutableTime, $out, $Itime);
      echo "Saída do Tempo: ".$Itime."<br>";
      $DATE = (string)$Idate;
      $TIME = (string)$Itime;
      if (strlen($DATE) == 7) {
          $DATE = "0".$DATE;
      }
      if (strlen($TIME) == 5) {
          $TIME = "0".$TIME;
      }
      $DATE = substr($DATE,0,2)."/".substr($DATE,2,2)."/".substr($DATE,4,4);
      $TIME = substr($TIME,0,2).":".substr($TIME,2,2).":".substr($TIME,4,4);
      $DATETIME = $DATE." ".$TIME;
      return $DATETIME;  
    }
    function GetLinkerTimeStamp($ExeName){
        $ExecutableName = "GetLinkerTimeStamp.exe ".$ExeName." -DateTimeFile";
        exec($ExecutableName);
        $ExeName = "CConecta.exe";
        $filename = "Data".$ExeName.".txt";
        $handle = fopen($filename,"r");
        $contents = fread($handle,filesize($filename));
        fclose($handle);
        unlink($filename);
        return $contents;
    }
    echo "Data do arquivo: ".GetLinkerTimeStampEx("CConecta.exe");
?>