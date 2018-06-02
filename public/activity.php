<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddosdfsdfwkdwdjadwadsdiow*/
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

                $stmt->close();

                $userId = $_SESSION["USER"];
                $activityId = $_GET["id"];

                // get groups or students
                if ($groupSize > 1){


                	if ($stmt = $mysqli->prepare("

		                SELECT USERS.GROUP_ID, GROUPS.ID
		                FROM USERS
		                INNER JOIN GROUPS
		                ON GROUPS.ID = USERS.GROUP_ID
		                WHERE USERS.ID = ? AND GROUPS.ACTIVITY_ID = ?

		            ")){

                		$stmt->bind_param("ii", $_SESSION["USER"], $_GET["id"]);
                		$stmt->execute();

                		$stmt->bind_result($tempUserGroupId, $tempGroupId);
                		$button = true;

                		if ($stmt->fetch()){
                			if ($tempGroupId == $tempUserGroupId) $button = false;
                		}

                		$stmt->close();

                		if ($button){
                			echo '

		                	<form method="post" action="db_create_group.php">
						        <input type="hidden" name="userId" value="'.$userId.'">
						        <input type="hidden" name="activityId" value="'.$activityId.'">
						        <input type="hidden" name="groupSize" value="'.$groupSize.'">
						        <input type="submit" value="Skapa ett lag">
						    </form><br>

                			';
                		} else {
                			echo "Du är redan med boi<br>";
                		}

	            	}

                	// Show groups
	                if ($stmt = $mysqli->prepare("
		                SELECT USERS.FIRST_NAME, GROUPS.ID
		                FROM GROUPS 
		                INNER JOIN USERS
		                ON GROUPS.CREATOR_ID = USERS.ID
		                WHERE GROUPS.ACTIVITY_ID = ?
	            	")){

	                	$stmt->bind_param("i", $_GET["id"]);
                		$stmt->execute();

                		$stmt->bind_result($name, $group);

                		while($stmt->fetch()){
                			echo "<a href='group?id=".$group."'>".$name."</a><br>";
                		}

	            	} else echo $mysqli->error;

	        	} else { // IF groupsize is less than 1

	        		// Join ACtivity
                	if ($stmt = $mysqli->prepare("

		                SELECT USERS.GROUP_ID, GROUPS.ID
		                FROM USERS
		                INNER JOIN GROUPS
		                ON GROUPS.ID = USERS.GROUP_ID
		                WHERE USERS.ID = ? AND GROUPS.ACTIVITY_ID = ?

		            ")){

                		$stmt->bind_param("ii", $_SESSION["USER"], $_GET["id"]);
                		$stmt->execute();

                		$stmt->bind_result($tempUserGroupId, $tempGroupId);
                		$button = true;

                		if ($stmt->fetch()){
                			if ($tempGroupId == $tempUserGroupId) $button = false;
                		}

                		$stmt->close();

                		if ($button){
                			echo '

		                	<form method="post" action="db_create_group.php">
						        <input type="hidden" name="userId" value="'.$userId.'">
						        <input type="hidden" name="activityId" value="'.$activityId.'">
						        <input type="hidden" name="groupSize" value="'.$groupSize.'">
						        <input type="submit" value="Gå med i aktivitet">
						    </form><br>

                			';
                		} else {
                			echo "Du är redan med boi<br>";
                		}

	            	}

					if ($stmt = $mysqli->prepare("
		                SELECT USERS.FIRST_NAME
		                FROM USERS
		                INNER JOIN GROUPS
		                ON USERS.GROUP_ID = GROUPS.ID
		                WHERE GROUPS.ACTIVITY_ID = ?
	            	")){

						$stmt->bind_param("i", $_GET["id"]);
						$stmt->execute();

						$stmt->bind_result($fName);

						while($stmt->fetch()){
                			echo $fName."<br>";
                		}

	            	} else echo"AYYA";        		

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