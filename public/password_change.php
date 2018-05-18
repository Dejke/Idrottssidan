<?
    /*
        $_POST["str"] = RANDOM_STRING i PASSWORD_RESETS
    */
?>
<?
    include "sql_setup.php";

    /* 
     * Rensar fält som är mer än 1 timme gamla från tabellen
     */
    if($mysqli->prepare("
        DELETE
            FROM PASSWORD_RESETS
            WHERE TIME_CREATED < DATE_SUB(NOW(), INTERVAL 1 HOUR);
    ")){

    }
    else{
        echo $mysqli->error;
    }


    $mysqli->prepare(
        "
            SELECT USER_ID 
                FROM PASSWORD_RESETS
                WHERE RANDOM_STRING = ?
        "
    ){
        $mysqli->bind_param("s", $_POST)
    }
    else{
        echo $mysqli->error;
    }
?>