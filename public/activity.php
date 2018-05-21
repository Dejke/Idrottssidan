<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddowkdwdjadwadsdiow*/
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

	<?

		if (isset($_GET["id"])){

			if ($stmt = $mysqli->prepare("
                SELECT ACTIVITIES.NAME, ACTIVITIES.LOCATION, ACTIVITIES.TIME, ACTIVITIES.DESCRIPTION
                FROM ACTIVITIES 
                WHERE ACTIVITIES.ID = ?
            ")){

				$stmt->bind_param("i", $_GET["id"]);
                $stmt->execute();

                $stmt->bind_result($name, $location, $time, $description);

                if ($stmt->fetch()){
                	echo $name."<br>";
                	echo $description."<br>";
                	echo $location."<br>";
                	echo $time."<br>";
                }

			} else {
				echo "Aktiviteten finns inte";
			}

		} else {
			echo "Aktiviteten finns inte";
		}

	?>

</body>
</html>