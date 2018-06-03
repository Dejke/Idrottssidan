<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsdddefsdfdswdwedsadasosdfsfesfdwadwdfsdfsdfwkdwdjadwadsdiow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">

	<style>
		.link-table td a{
			padding: 0.75rem;
			display:block;
			width :100%;
			height:100%;
		}
		.link-table td{
			padding: 0 !important;
		}
		td a:hover{
			text-decoration:none;
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
	                	<span class='display-3 pt-3'>".$name."</span>
	                	";

	                	echo "

		                	<div class='row my-3 justify-content-center'>
		                		<span class='col-lg-6 col-md-6 col-sm-12 lead'>".$description."</span>
		                	</div>
		                	<div class='row mb-5 justify-content-around'>
		                		<span class='col-lg-6 col-md-6 col-sm-12 display-5'>Plats: ".$location."</span>
		                		<span class='col-lg-6 col-md-6 col-sm-12 display-5'>Tid: ".$time."</span>
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

							echo "<table class = 'table table-striped link-table table-bordered table-hover mt-3'>";
							echo "
								<thead style='background-color:#e5edf2;'>
									<tr>
										<th style = 'width:65%;'>Lag</th>
										<th style = 'width:35%;'>Klass</th>
									</tr>
								</thead>
							";
	                		while($stmt->fetch()){

	                			echo "

								<tr>
							
									<td><a href='group?id=".$group."'>".$fname." ".$lname."s lag</a></td>
									<td><a href='group?id=".$group."'>".$programme."".$grade."".$letter."</a></td>
								</tr>

	                			";
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

							echo "<table class = 'table table-striped table-bordered mt-3'>";
							echo "
								<thead style='background-color:#e5edf2;'>
									<tr>
										<th style = 'width:65%;'>Namn</th>
										<th style = 'width:35%;'>Klass</th>
									</tr>
								</thead>
							";

							while($stmt->fetch()){

	                			echo "

								<tr>
									<td>".$fname." ".$lname."</td>
									<td>".$programme."".$grade."".$letter."</td>
								</tr>

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