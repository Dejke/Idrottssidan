<?
    session_start();
    /*
        $_GET["str"] = RANDOM_STRING i PASSWORD_RESETS
    
        ELLER (FRÅN SIG SJÄLV) 
        $_POST["password"] (det nya)
    */

    
    include "sql_setup.php";

    if($_POST["password"]&&$_SESSION["pwChangeId"]){
        if($stmt =  $mysqli->prepare("
            UPDATE USERS 
                SET PASSWORD = ? 
                WHERE ID = ?
        ")){
            $stmt->bind_param("si", password_hash($_POST["password"], PASSWORD_BCRYPT), $_SESSION["pwChangeId"]);
            $stmt->execute();

            $stmt->close();

            session_destroy();
            if($stmt = $mysqli->prepare(
                "
                    DELETE FROM PASSWORD_RESETS 
                        WHERE USER_ID = ?
                "
            )){
                $stmt->bind_param("i", $_SESSION["pwChangeId"]);
                $stmt->execute();
                $stmt->close();
                header("Location: signIn.php?message=passwordchanged");
                exit;
            }
            else{
                echo "something broke";
                exit;
            }
                
        }
        else{
            echo "tror jag dog";
        }
    }

?>
<html>
<head>
    <meta charset = "utf-8">
    <title>Byt lösenord</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/signIn.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    
</head>


<body>
    <div class="containz">
    <div id="logo"></div>

    <?

        /* 
        * Rensar fält som är mer än 1 timme gamla från tabellen
        */
        if($stmt = $mysqli->prepare("
            DELETE
                FROM PASSWORD_RESETS
                WHERE TIME_CREATED < DATE_SUB(NOW(), INTERVAL 1 HOUR);
        ")){
            $stmt->execute();
            $stmt->close();
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
            $bool = $stmt->fetch();

            if($bool)
                $_SESSION["pwChangeId"] = $id;
            if($bool):
            ?>
                <form method = "post" action="<?$_SERVER["PHP_SELF"]?>" onsubmit="return validate(this)">
                    <label class = "sr-only">Nytt lösenord</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-unlock"></i>
                            </div>
                        </div>
                        <input type="password" name="password" id="pw1" class="form-control" placeholder = "Nytt Lösenord">

                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-unlock"></i>
                            </div>
                        </div>
                        <label class="sr-only">Upprepa nytt lösenord</label>
                        <input type="password" id="pw2" placeholder = "Upprepa lösenord" class= "form-control">
                    </div>
                    <input type="submit" value="Bekräfta" class = "form-control">
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

    <script>
        function validate(){
            if(document.getElementById("pw1").value == document.getElementById("pw2").value){
                return true;
            }
        }
    </script>
</body>
</html>