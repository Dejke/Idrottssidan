<?
    //We be testing, yo chiilllaiowdjaiow
    include "secret.php";

    
    $mysqli = new mysqli($SECRET["url"], $SECRET["user"], $SECRET["password"], $SECRET["database"]);
    
    if($mysqli->connect_errno){
        echo "yo waddup";
    }
    else{
        echo "no boi";
    }
?>