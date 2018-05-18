<?
	/*
		$_GET
			["recipient"]
			["file"]
	*/
	

	echo $_GET["recipient"];
	echo $_GET["file"];
	$address = test_input($_GET["recipient"]);
	if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
  		$emailErr = "Invalid email format"; 
	}

	ob_start();
    include($_GET["file"]);
    $body=ob_get_contents(); 
	ob_end_clean();
	$body = "MEMES UNITED";
	
////////////////////////MAIL-SCRIPT////////////////////////////////////////////
	ini_set('display_errors', 1);
	error_reporting(~0);

	require_once('phpmailer/class.phpmailer.php');
	//include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	$mail             = new PHPMailer();


	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mailcluster.loopia.se"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the server
	$mail->Port		  = 587;
	$mail->Username   = "noreply@kaggteknik.se";  // username
	$mail->Password   = "bumbibjorn3000";          // password
	
  

	//$mail->SetFrom('noreply@kaggteknik.se', 'Lasse Kagg');
	//$mail->AddReplyTo("noreply@kaggteknik.se","Lasse Kagg");
	
	$mail->SetFrom('sigurd@svampklubben.se', utf8_decode('Ordföranden'));
	$mail->AddReplyTo("noreply@svampklubben.se","svampklubben");
	$mail->Subject    = utf8_decode("Svampklubbens möte");
	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->MsgHTML($body);

	// *********** ADRESSER ATT SKICKA TILL !! *********
	$mail->AddAddress($address);
	//$mail->AddCC("KopiaTill@adress", "Namn på personen");
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  //header('Location: index.php');
	  echo "Your mail has been sent!";
	}
	
?>
