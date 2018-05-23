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
                SELECT ACTIVITIES.NAME, ACTIVITIES.LOCATION, ACTIVITIES.TIME, ACTIVITIES.DESCRIPTION, ACTIVITIES.MAX_GROUP_SIZE
                FROM ACTIVITIES 
                WHERE ACTIVITIES.ID = ?
            ")){

				$stmt->bind_param("i", $_GET["id"]);
                $stmt->execute();

                $stmt->bind_result($name, $location, $time, $description, $groupSize);

                if ($stmt->fetch()){
                	echo $name."<br>";
                	echo $description."<br>";
                	echo $location."<br>";
                	echo $time."<br>";
                }

                // get groups or students
                if ($groupSize > 1){

                	// Create group button
                	echo '

                	<form method="post" action="db_create_group.php">
				        <input type="hidden" name="userId" value="'.$_SESSION["USER"].'">
				        <input type="hidden" name="activityId value="'.$_GET["id"].'">
				        <input type="hidden" name="groupSize value="'.$groupSize.'">
				        <input type="submit" value="Skapa ett lag">
				    </form><br>

                	';

                	// Show groups
	                if ($stmt = $mysqli->prepare("
		                SELECT GROUPS.ID
		                FROM GROUPS 
		                WHERE ACTIVITY_ID = ?
	            	")){

	                	$stmt->bind_param("i", $_GET["id"]);
                		$stmt->execute();

                		$stmt->bind_result($group);

                		while($stmt->fetch()){
                			echo $group."<br>";
                		}

	            	}

	        	} else { // IF groupsize is less than 1

	        		// Join ACtivity
                	echo '
                	
                	<form method="post" action="db_create_group.php">
				        <input type="hidden" name="userId" value="'.$_SESSION["USER"].'">
				        <input type="hidden" name="activityId value="'.$_GET["id"].'">
				        <input type="hidden" name="groupSize value="'.$groupSize.'">
				        <input type="submit" value="Gå med i aktivitet">
				    </form><br>

                	';

					if ($stmt = $mysqli->prepare("
		                SELECT USERS.FIRST_NAME
		                FROM USERS
		                INNER JOIN GROUPS
		                ON GROUPS.ACTIVITY_ID = ACTIVITIES.ID
		                WHERE GROUPS.ACTIVITY_ID = ?
	            	")){

						$stmt->bind_param("i", $_GET["id"]);
						$stmt->execute();

						$stmt->bind_result($fName);

						while($stmt->fetch()){
                			echo $fName."<br>";
                		}

	            	}	        		

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