<?
    /*
        $_GET["str"] = RANDOM_STRING i PASSWORD_RESETS
    */
?>
<html>
<head>
    <meta charset = "utf-8">
    <title>Byt lösenord</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/signIn.css">
    
</head>


<body>
    <div class="containz">
    <div id="logo"></div>

    <?
        include "sql_setup.php";

        /* 
        * Rensar fält som är mer än 1 timme gamla från tabellen
        */
        if($stmt = $mysqli->prepare("
            DELETE
                FROM PASSWORD_RESETS
                WHERE TIME_CREATED < DATE_SUB(NOW(), INTERVAL 1 HOUR);
        ")){
            $stmt->execute();
        }
        else{
            echo $mysqli->error;
            exit;
        }


        if($stmt = $mysqli->prepare(
            "
                SELECT USER_ID 
                    FROM PASSWORD_RESETS
                    WHERE RANDOM_STRING = ?
            "
        )){
            $stmt->bind_param("s", $_GET["str"]);
            $stmt->bind_result($id);
            $stmt -> execute();
            if($stmt->fetch()):
            ?>
                <form method = "post" action="<?$_SERVER["PHP_SELF"]?>">
                    <label>Nytt lösenord</label><br>
                    <input type="password" name="password" id="pw1"><br><br>
                    <label>Upprepa nytt lösenord</label><br>
                    <input type="password" id="pw2"><br><br>
                    <input type="submit" value="Bekräfta">
                </form>
            <?
            else:
            ?>
            Länken har utgått. <br> <a href='signIn.php'>Gå till inloggningssidan för att skicka en ny återställningslänk</a>
            <?
            endif;
            
        }
        else{
            echo $mysqli->error;
        }
    ?>
    </div>
</body>
</html>