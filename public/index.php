<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddowkdwdjadwaVAD I SJÄLVASTE FANdsdiow*/
    include "sql_setup.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <style type="text/css">
            
        body{
            overflow: hidden;
        }

        .activity{
            border-bottom: 1px solid black;
            text-decoration: none !important;
        }

        .activity:hover{
            background-color: rgb(0, 76, 134);
            color: white !important;
            text-decoration: none !important;
        }
        a:hover{
            text-decoration: none !important;    
        }

    </style>

</head>
<body>
    <?include "header.php";?>

    <div class="activities container-fluid text-center">
        <span class="text-dark h1" style="border-bottom: 1px solid black;">Aktiviteter</span>
        <?
            // HÄMTA AKTIVITEdTE
            if ($stmt = $mysqli->prepare("
                SELECT ACTIVITIES.NAME, ACTIVITIES.LOCATION, ACTIVITIES.TIME, ACTIVITIES.ID
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

                $stmt->bind_result($name, $location, $time, $id);

                while($stmt->fetch()){
                    echo 
                    '
                        <a href="activity.php?id='.$id.'">
                        <div class="activity text-center p-4 row justify-content-around text-dark">
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$name.'</span>
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$location.'</span>
                            <span class="col-lg-4 col-md-4 col-sm-4 h3">'.$time.'</span>
                        </div>
                        </a>
                    ';
                }

            } else {
                echo "NÅT GICK FEL";
            }

        ?>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>