<?
    session_start();

    if (isset($_POST["logout"])){
        session_destroy();
        header("Location: signIn.php");
        exit;
    }

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiilllaisdowdjaiow
    include "sql_setup.php";


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    <?include "header.php";?>
    <form action="<? echo $SERVER['HTTP_HOST'] ?>" method="post" >
        <input type="submit" name="logout" value="yo">
    </form>

</body>
</html>
<?echo $_SESSION["USER"]?>