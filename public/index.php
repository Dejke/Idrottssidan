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

    echo $_SESSION["USER"];

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <form action="<? echo $SERVER['HTTP_HOST'] ?>" method="post" >
        <input type="submit" name="logout" value="yo">
    </form>

</body>
</html>