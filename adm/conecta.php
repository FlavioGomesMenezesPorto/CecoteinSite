<?
$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$database = '[REDACTED_DB_USERNAME]';
if ($_SERVER['HTTP_HOST'] != 'localhost') 
{
   $dbhost = '177.153.63.66';
   $dbuser = '[REDACTED_DB_USERNAME]';
   $dbpasswd = 'Cecote1212#';
   $database = '[REDACTED_DB_USERNAME]';
}
mysql_connect($dbhost,$dbuser,$dbpasswd);
mysql_select_db($database);
?>
