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

    <?
        // HÄMTA AKTIVITETER

        if ($stmt = $mysqli->prepare("
            SELECT ACTIVITIES.NAME
            FROM ACTIVITIES 
            INNER JOIN ACTIVITY_PAIR
            ON ACTIVITIES.ID = ACTIVITY_PAIR.ACTIVITY_ID
            INNER JOIN USERS
            ON (ACTIVITY_PAIR.USER_PROGRAMME = USERS.PROGRAMME OR ACTIVITY_PAIR.USER_PROGRAMME IS NULL)
            AND (ACTIVITY_PAIR.USER_GRADE = USERS.GRADE OR ACTIVITY_PAIR.USER_GRADE IS NULL)
            AND (ACTIVITY_PAIR.USER_LETTER = USERS.LETTER OR ACTIVITY_PAIR.USER_LETTER IS NULL)
            WHERE USERS.ID = ?
        ")){

            $stmt->bind_param("i", $_SESSION["USER"]);
            $stmt->execute();

            $stmt->bind_result($name);

            while($stmt->fetch()){
                echo $name."<br>";
            }

        } else {
            echo "NÅT GICK FEL";
        }

    ?>

</body>
</html>
<?echo $_SESSION["USER"]?>