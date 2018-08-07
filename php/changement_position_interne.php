<?php
define("DB_HOST", "localhost"); //Databse Host.
define("DB_USER", "of2ds84i_robert"); //Databse User.
define("DB_PASS", "Pm7xojnz"); //database password.
define("DB_NAME", "of2ds84i_wp587"); //database Name.
/*define("DB_USER", "root"); //Databse User.
define("DB_PASS", "root"); //database password.
define("DB_NAME", "eko_tasks"); //database Name.*/

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno > 0) {
    die('Unable to connect to database 1 [' . $db->connect_error . ']');
}
$db->set_charset("utf8");

$id_projet = $_GET['id_projet'];
$id_tache = $_GET['id_tache'];

$etat = $_GET['etat'];
$position = explode(",",$_GET['position']);

$a = 1;
foreach($position as $pos) {
  $query2 = "UPDATE `affectation` SET `ordre` = '".$a."' WHERE `affectation`.`id` = '".$pos."' ;";
  echo $query2;
  $result2 = $db->query($query2) or die($db->error);
  $a++;
}


?>
