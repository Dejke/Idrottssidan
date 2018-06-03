<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsdddefsdfdswdwedsadasosdfsfesfdfsdfsdfwkdwdjadwadsdiow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">

	<style type="text/css">
		.containz{
			/*
			border-style: solid;
			border-width: 1px;
			border-radius: 5px;
			*/
		}
	</style>

</head>
<body>
	<?include "header.php";?>

	<div class="container-fluid text-center text-dark">
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
	                	echo "
	                	<span class='h1 pt-3'>".$name."</span>
	                	";

	                	echo "

		                	<div class='row p-5'>
		                		<span class='ol-lg-12 col-md-12 col-sm-12 h3'>".$description."</span>
		                	</div>
		                	<div class='row'>
		                		<span class='ol-lg-12 col-md-12 col-sm-12 h3'>Plats: ".$location."</span>
		                	</div>
		                	<div class='row pb-5'>
		                		<span class='ol-lg-12 col-md-12 col-sm-12 h3'>Tid: ".$time."</span>
		                	</div>
	                	";
	                }

	                $stmt->close();

	                $userId = $_SESSION["USER"];
	                $activityId = $_GET["id"];

	                echo '<div class="container">';

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

			                	<form method="post" class="pb-1" action="db_create_group.php">
							        <input type="hidden" name="userId" value="'.$userId.'">
							        <input type="hidden" name="activityId" value="'.$activityId.'">
							        <input type="hidden" name="groupSize" value="'.$groupSize.'">
							        <input type="submit" class="form-control pb-1" value="Skapa ett lag">
							    </form>

	                			';
	                		} else {
	                			echo "<span>Du är redan med i ett lag</span>";
	                		}

		            	}

	                	// Show groups
		                if ($stmt = $mysqli->prepare("
			                SELECT GROUPS.ID, USERS.FIRST_NAME, USERS.LAST_NAME, USERS.PROGRAMME, USERS.GRADE, USERS.LETTER
			                FROM GROUPS 
			                INNER JOIN USERS
			                ON GROUPS.CREATOR_ID = USERS.ID
			                WHERE GROUPS.ACTIVITY_ID = ?
		            	")){

		                	$stmt->bind_param("i", $_GET["id"]);
	                		$stmt->execute();

	                		$stmt->bind_result($group, $fname, $lname, $programme, $grade, $letter);

	                		echo "<div class='containz border border-secondary rounded'>";
	                		while($stmt->fetch()){

	                			echo "<a href='group?id=".$group."'>

	                			<div class='row p-3'>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$fname."</span>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$lname."</span>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$programme."".$grade."".$letter."</span>
	                			</div>

	                			</a>";
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

			                	<form method="post" class="pb-1" action="db_create_group.php">
							        <input type="hidden" name="userId" value="'.$userId.'">
							        <input type="hidden" name="activityId" value="'.$activityId.'">
							        <input type="hidden" name="groupSize" value="'.$groupSize.'">
							        <input type="submit" class="form-control" value="Gå med i aktivitet">
							    </form>

	                			';
	                		} else {
	                			echo "<span>Du är redan med i aktiviteten</span>";
	                		}
		            	}
		            	
						if ($stmt = $mysqli->prepare("
			                SELECT USERS.FIRST_NAME, USERS.LAST_NAME, USERS.PROGRAMME, USERS.GRADE, USERS.LETTER
			                FROM USERS
			                INNER JOIN GROUPS
			                ON GROUPS.CREATOR_ID = USERS.ID
			                WHERE GROUPS.ACTIVITY_ID = ?
		            	")){

							$stmt->bind_param("i", $_GET["id"]);
							$stmt->execute();

							$stmt->bind_result($fname, $lname, $programme, $grade, $letter);

							echo "<div class='containz border border-secondary rounded'>";
							while($stmt->fetch()){

	                			echo "

	                			<div class='row p-3'>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$fname."</span>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$lname."</span>
	                				<span class='ol-lg-4 col-md-4 col-sm-4'>".$programme."".$grade."".$letter."</span>
	                			</div>

	                			";
	                		}
		            	}
		        	}	

		        	echo "</div>";
		            echo "</div>";

				}
			}
		?>
	</div>

</body>
</html>