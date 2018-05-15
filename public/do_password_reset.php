<?
    include "sql_setup.php";
    /*
        $_POST[”email"] vilket konto som ska återställas
        lägger till ett fält i PASSWORD_RESETS
    */
    if(!isset($_POST["email"])){
        echo "no email value in POST";
        break;
    }

    if ($stmt = $mysqli->prepare("

    		SELECT ID
    		FROM USERS
    		WHERE EMAIL = ?

    ")){

        $stmt->bind_param("s", $email);
        $email = $_POST["email"];

        $stmt->execute();

        $stmt->bind_result($id);
        if($stmt->fetch()){
            //An account is associated with the email

            //Remove any existing PASSWORD_RESETS entries
            if($stmt = $mysqli->prepare("
                DELETE FROM PASSWORD_RESETS
                    WHERE ID = ?
            ")){
                    

                $stmt->bind_param("i",$id);
                $stmt->execeute();


                //add a new PASSWORD_RESET entry
                if($stmt = $mysqli->prepare("
                    INSERT INTO PASSWORD_RESETS 
                        RANDOM_STRING, USER_ID
                        VALUES
                            ?,?
                ")){

                    $key = uniqid('',true);
                    $stmt->bind_param("si", $key, $id);
                    $stmt->execute();
                    header("Location:signIn.php?message=pwreset_sent");
                    exit;
                }
            }
        }
        else{
            //email is ZUCC
            header("signIn.php?message=invalidemail");
            break;
        }
    }  


?>

Vi har skickat ett email med en återställningslänk för ditt lösenord. 