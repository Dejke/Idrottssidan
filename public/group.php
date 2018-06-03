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
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
	<title>Group</title>
</head>
<body>

	<?include "header.php";?>

    <div class="container text-center">

    <?

    if(isset($_GET["id"])){

        if ($stmt = $mysqli->prepare("

            SELECT USERS.FIRST_NAME, USERS.LAST_NAME, USERS.PROGRAMME, USERS.GRADE, USERS.LETTER 
            FROM USERS
            INNER JOIN GROUPS
            ON USERS.ID = GROUPS.CREATOR_ID
            WHERE GROUPS.ID = ?

        ")){

            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();

            $stmt->bind_result($fname, $lname, $programme, $grade, $letter);

            if ($stmt->fetch()){
                echo "<span class='h1 pb-3'>".$fname." ".$lname." ".$programme.$grade.$letter."</span>";
            }

            $stmt->close();

        }

    }

    ?>

	<div class="members border border-secondary rounded">
		
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
                		
                		echo "

                            <div class='row'>

                                <span class='p-3 col-lg-4 col-md-4 col-sm-4'>".$fname."</span>
                                <span class='p-3 col-lg-4 col-md-4 col-sm-4'>".$lname."</span>
                                <span class='p-3 col-lg-4 col-md-4 col-sm-4'>".$programme."".$grade."".$letter."</span>

                            </div>

                        ";

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

                        			<form method="post" class="pt-1" action="db_join_group.php">
            							<input type="hidden" name="group_id" value="'.$_GET['id'].'">
            							<input type="submit" class="form-control" value="Gå med i lag">
            						</form>

                        		';
                            } else {
                                echo "<span>Laget är fullt</span>";
                            }
                        }   
                    }
            	} else {
                    echo "<span>Du är redan med i laget</span>";
                }
            }
        }

	?>

    </div>

</body>
</html>