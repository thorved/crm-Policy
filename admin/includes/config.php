<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','admin');
define('DB_PASS','admin');
define('DB_NAME','crm');
// Establish database connection.
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
