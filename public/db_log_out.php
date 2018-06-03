<?
	session_start();
    
	session_destroy();
    header("Location: signIn.php?message=loggedout");
    exit;
?>

