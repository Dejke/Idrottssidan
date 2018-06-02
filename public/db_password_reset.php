<<<<<<< HEAD
<?
    include "secret.php";
    require_once('phpmailer/class.phpmailer.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
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

    		SELECT USERS.ID
    		FROM USERS
    		WHERE USERS.EMAIL = ?

    ")){

        $address = strtolower( $_POST["email"]);
        $stmt->bind_param("s", $address);

        $stmt->execute();
        $stmt->bind_result($id);


        if($stmt->fetch()){

            $stmt->close();

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
                        exit;
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
	                $mail->SetFrom('noreply@kaggteknik.se', 'Lasse Kagg');
                    $mail->AddReplyTo("noreply@kaggteknik.se","Lasse Kagg");
                    $mail->subject = "Lösenordsåterställning";
                    $mail->MsgHTML($_SERVER["HTTP_HOST"]."/password_change.php?str=".$key);
                    $mail->AddAddress($address);




                    if(!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        header("Location: signIn.php?form=pwreset&message=checkemail");
                        exit;
                    }
                }
            }
            else{
                echo $mysqli->error;
            }
        }
        else{
            //email is ZUCC 
            header("Location: signIn.php?message=noexistemail");
            exit;
        }
    }  
=======
<?
    include "secret.php";
    require_once('phpmailer/class.phpmailer.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
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

    		SELECT USERS.ID
    		FROM USERS
    		WHERE USERS.EMAIL = ?

    ")){

        $address = strtolower( $_POST["email"]);
        $stmt->bind_param("s", $address);

        $stmt->execute();
        $stmt->bind_result($id);


        if($stmt->fetch()){

            $stmt->close();

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
                        exit;
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
	                $mail->SetFrom('noreply@kaggteknik.se', 'Lasse Kagg');
                    $mail->AddReplyTo("noreply@kaggteknik.se","Lasse Kagg");
                    $mail->subject = "Lösenordsåterställning";
                    $mail->MsgHTML($_SERVER["HTTP_HOST"]."/password_change.php?str=".$key);
                    $mail->AddAddress($address);




                    if(!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        header("Location: signIn.php?form=pwreset&message=checkemail");
                        exit;
                    }
                }
            }
            else{
                echo $mysqli->error;
            }
        }
        else{
            //email is ZUCC 
            header("Location: signIn.php?form=pwreset&message=noexistemail");
            exit;
        }
    }  
>>>>>>> d6e4e6221b28a6ea887a838d5e3d658da57a84a3
?>