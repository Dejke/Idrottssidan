<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddodwdwwkdwdjadwaVAD I SJÄLVASTE FANdsdidwdwow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<title>Group</title>
</head>
<body>

	<?include "header.php";?>

	<div class="members">
		
		<?

			if (isset($_GET["id"])){

				if ($stmt = $mysqli->prepare("

    				SELECT USERS.FIRST_NAME, USERS.LAST_NAME, USERS.PROGRAMME, USERS.GRADE, USERS.LETTER 
    				FROM USERS
    				WHERE USERS.GROUP_ID = ?

    			")){

					$stmt->bind_param("i", $_GET["id"]);
                	$stmt->execute();

                	$stmt->bind_result($fname, $lname, $programme, $grade, $letter);

                	while ($stmt->fetch()) {
                		
                		echo $fname." ".$lname."".$programme."".$grade."".$letter."<br>";

                	}

                	$stmt->close();

    			} else {

    				echo "Gruppen finns inte";

    			}

			}

		?>

	</div>

	<?

		if ($stmt = $mysqli->prepare("

            SELECT USERS.GROUP_ID
            FROM USERS
            WHERE USERS.ID = ?

        ")){

			$stmt->bind_param("i", $_SESSION["USER"]);
            $stmt->execute();

            $stmt->bind_result($group_id);

            echo "does work?";

            if ($stmt->fetch()){

            	if ($group_id != $_GET["id"]){

            		echo '

            			<form method="post" action="db_join_group.php">
							<input type="hidden" name="group_id" value="'.$_GET['id'].'">
							<input type="submit" value="Joina grupp boi">
						</form>

            		';

            	}

            }

        }

	?>

</body>
</html>