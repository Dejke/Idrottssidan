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
    
    //We be testing, yo chiidslllaisdsddowdwdjadwadsdiow
    include "sql_setup.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <style type="text/css">
        
        .activity{
            border-bottom: 1px solid black;
        }

    </style>

</head>
<body>
    <?include "header.php";?>

    <div class="activities container-fluid text-center">
        <span class="text-dark h1" style="border-bottom: 1px solid black;">Aktiviteter</span>
        <?
            // HÄMTA AKTIVITETE
            if ($stmt = $mysqli->prepare("
                SELECT ACTIVITIES.NAME, ACTIVITIES.LOCATION, ACTIVITIES.TIME
                FROM ACTIVITIES 
                INNER JOIN ACTIVITY_PAIR
                ON ACTIVITIES.ID = ACTIVITY_PAIR.ACTIVITY_ID
                INNER JOIN USERS
                ON (ACTIVITY_PAIR.USER_PROGRAMME = USERS.PROGRAMME OR ACTIVITY_PAIR.USER_PROGRAMME = '')
                AND (ACTIVITY_PAIR.USER_GRADE = USERS.GRADE OR ACTIVITY_PAIR.USER_GRADE = 0)
                AND (ACTIVITY_PAIR.USER_LETTER = USERS.LETTER OR ACTIVITY_PAIR.USER_LETTER = '')
                WHERE USERS.ID = ?
            ")){

                $stmt->bind_param("i", $_SESSION["USER"]);
                $stmt->execute();

                $stmt->bind_result($name, $location, $time);

                while($stmt->fetch()){
                    echo 
                    '
                        <div class="activity text-center p-4 row justify-content-around text-dark">
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$name.'</span>
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$location.'</span>
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$time.'</span>
                        </div>
                    ';
                }

            } else {
                echo "NÅT GICK FEL";
            }

        ?>
    </div>

</body>
</html>