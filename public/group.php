<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }

    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stylesheet/main.css">
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

            if ($stmt->fetch()){

                $stmt->close();

            	if ($group_id != $_GET["id"]){

                    if ($stmt = $mysqli->prepare("

                        SELECT count(*), GROUPS.MAX_MEMBERS
                        FROM GROUPS
                        INNER JOIN USERS
                        ON USERS.GROUP_ID = GROUPS.ID
                        WHERE GROUPS.ID = ?

                    ")){

                        $stmt->bind_param("i", $_GET["id"]);
                        $stmt->execute();

                        $stmt->bind_result($amount, $max_members);

                        if ($stmt->fetch()){

                            if ($amount != $max_members){

                        		echo '

                        			<form method="post" action="db_join_group.php">
            							<input type="hidden" name="group_id" value="'.$_GET['id'].'">
            							<input type="submit" value="Joina grupp boi">
            						</form>

                        		';
                            }

                        }   

                    }

            	}

            }

        }

	?>

</body>
</html>