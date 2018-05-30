<?
    include "secret.php";
    require_once('phpmailer/class.phpmailer.php');
    
    echo "01";

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

    		SELECT ID
    		FROM USERS
    		WHERE `EMAIL` = ?

    ")){
        echo "02";
        $stmt->bind_param("s", $email);
        $email = $_POST["email"];

        $stmt->execute();

        $stmt->bind_result($id);
        if($stmt->fetch()){
            echo "025";
            //An account is associated with the email

            //Remove any existing PASSWORD_RESETS entries
            if($stmt = $mysqli->prepare("
                DELETE FROM PASSWORD_RESETS
                    WHERE USER_ID = ?
            ")){

                echo "03";
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

                    echo "1";
                    $key = uniqid('',true);
                    echo "1.1";
                    $stmt->bind_param("si", $key, $id);
                    echo "1.2";
                    $stmt->execute();
                    echo "1.3";

                    /* 
                        SEND AN EMAIL

                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ                        DANSKEN ATTACKERAR GÖM DIG JAG VILL DÖ krävs det shakespeare?
                    */
                    $mail             = new PHPMailer();


                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host       = "mailcluster.loopia.se"; // SMTP server
                    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)

                    echo "2";
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->SMTPSecure = "tls";                 // sets the prefix to the server
                    $mail->Port		  = 587;
                    $mail->Username   = "noreply@kaggteknik.se";  // username
                    echo "3";
                    $mail->Password   = $SECRET["mail_password"]; 
                    echo "4";
	                $mail->SetFrom('noreply@kaggteknik.se', 'Lasse Kagg');
	                $mail->AddReplyTo("noreply@kaggteknik.se","Lasse Kagg");
                    $mail->MsgHTML($_SERVER["HTTP_HOST"]."/password_change.php?str=".$key);
                    echo "5";
                    $mail->AddAddress($_POST["email"]);

                    echo "6";


                    if(!$mail->Send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        echo $_POST["email"];
                        exit;
                    }
                }
            }
            else{
                echo $mysqli->error;
                echo $stmt->error;
            }
        }
        else{
            //email is ZUCC 
            header("Location: signIn.php?message=noexistemail");
            exit;
        }
    }  
?>