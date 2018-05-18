<?
error_reporting(E_ALL);
ini_set('display_errors', 'on');
    echo "MEME";
    include "sql_setup.php";
    /*
        $_POST[”email"] vilket konto som ska återställas
        lägger till ett fält i PASSWORD_RESETS
    */
    if(!isset($_POST["email"])){
        echo "no email value in POST";
        exit;
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
                    WHERE USER_ID = ?
            ")){
                    

                $stmt->bind_param("i",$id);
                $stmt->execute();


                //add a new PASSWORD_RESET entry
                if($stmt = $mysqli->prepare("
                    INSERT INTO PASSWORD_RESETS 
                        (RANDOM_STRING, USER_ID)
                        VALUES
                            (?,?)
                ")){

                    $key = uniqid('',true);
                    $stmt->bind_param("si", $key, $id);
                    $stmt->execute();
                    header("Location:register_land_page.php");
                    exit;
                }
            }
        }
        else{
            //email is ZUCC 
            header("Location: signIn.php?message=invalidemail");
            exit;
        }
    }  
?>