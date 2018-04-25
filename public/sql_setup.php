<?
	
	include "secret.php";
	$mysqli = new mysqli($SECRET["url"], $SECRET["user"], $SECRET["password"], $SECRET["database"]);
    
    if($mysqli->connect_errno){
        echo "something is wrong my dude ".$mysqli->connect_error;
        exit;
    }

    $mysqli->set_charset("utf8");
	
?>