<?
$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$database = 'cecotein';
if ($_SERVER['HTTP_HOST'] != 'localhost') 
{
   $dbhost = '177.153.63.66';
   $dbuser = 'cecotein';
   $dbpasswd = 'Cecote1212#';
   $database = 'cecotein';
}
mysql_connect($dbhost,$dbuser,$dbpasswd);
mysql_select_db($database);
?>
