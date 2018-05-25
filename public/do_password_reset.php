<?
    include "secret.php";
    require_once('phpmailer/class.phpmailer.php');
    

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
                    if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
                          header("Location: signIn.php?message=invalidemail");
                    }
                    $key = uniqid('',true);
                    $stmt->bind_param("si", $key, $id);
                    $stmt->execute();

                    /* 
                        SEND AN EMAIL
                    */
                    $mail             = new PHPMailer();


                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host       = "mailcluster.loopia.se"; // SMTP server
                    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->SMTPSecure = "tls";                 // sets the prefix to the server
                    $mail->Port		  = 587;
                    $mail->Username   = "noreply@kaggteknik.se";  // username
                    $mail->Password   = $SECRET["mail_password"]; 

                    $mail->SetFrom('noreply@kaggteknik.se', utf8_decode('Lars Kagg'));

                    $mail->MsgHTML("http://kasperdejke.kaggteknik.se/Idrottssidan/");
                    $mail->AddAddress($_POST["email"]);

                    if(!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        header("Location:register_land_page.php");
                        exit;
                    }
                    
                }
            }
        }
        else{
            //email is ZUCC 
            header("Location: signIn.php?message=noexistemail");
            exit;
        }
    }  
?>