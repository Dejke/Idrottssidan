<<<<<<< HEAD
<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddowkawdasdawddwdjadwadsdiow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="stylesheet/main.css">
</head>
<body>

	<?include "header.php";?>

	hihihaha

</body>
=======
<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddowkawdasdawddwdjadwadsdiow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="stylesheet/main.css">
</head>
<body>

	<?include "header.php";?>

	hihihaha

</body>
>>>>>>> 0f17326623a4b437097701079dcae2498b99f028
</html>