<?php

	//ini_set('display_errors', 1);
	//error_reporting(~0);

	require_once('phpmailer/class.phpmailer.php');
	//include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail             = new PHPMailer();

	//$body             = file_get_contents('contents.html');
	//$body             = eregi_replace("[\]",'',$body);

	$body 				= "
	Här är ditt lösenord: ".$password."<br>"."
	Var snäll och byt lösenord när du loggar in.
							";
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.scorpionshops.com"; // SMTP server
	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the server
	$mail->Port		  = 25;
	$mail->Username   = "kaggnist@kaggteknik.se";  // username
	$mail->Password   = "bumbibjorn3000";          // password

	$mail->SetFrom('olofenstrom.kaggteknik.se', 'Lasse Kagg');
	$mail->AddReplyTo("no-reply@olofenstrom.kaggteknik.se","Lasse Kagg");
	$mail->Subject    = "Aktivering av konto för aktivitetsdagar";
	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->MsgHTML($body);

	// *********** ADRESSER ATT SKICKA TILL !! *********
	$address = "någonsadress@någondomän.se";
	$mail->AddAddress($address, "Namn på personen");
	//$mail->AddCC("KopiaTill@adress", "Namn på personen");
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	
	echo $address.'<br><br>';
	echo $body.'<br>';

	// *********** KODEN HÄR UNDER SKICKAR IVÄG DITT MAIL **********
	/*if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}
	*/
?>

