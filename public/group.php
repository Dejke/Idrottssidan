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

    <div class="container text-center text-dark">

    <?

    if(isset($_GET["id"])){

        if ($stmt = $mysqli->prepare("

            SELECT USERS.FIRST_NAME, USERS.LAST_NAME
            FROM USERS
            INNER JOIN GROUPS
            ON USERS.ID = GROUPS.CREATOR_ID
            WHERE GROUPS.ID = ?

        ")){

            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();

            $stmt->bind_result($fname, $lname);

            if ($stmt->fetch()){
<<<<<<< HEAD
                echo "<span class='display-4 pb-3'>".$fname." ".$lname."s lag</span>";
=======
                echo "<span class='h1 pb-3 display-3'>".$fname." ".$lname." ".$programme.$grade.$letter."</span>";
>>>>>>> e36e89c85e2c253a039276428a592fa494840c60
            }

            $stmt->close();

        }

    }

<<<<<<< HEAD
    if (isset($_GET["id"])){

        if ($stmt = $mysqli->prepare("

            SELECT USERS.FIRST_NAME, USERS.LAST_NAME, USERS.PROGRAMME, USERS.GRADE, USERS.LETTER 
            FROM USERS
            WHERE USERS.GROUP_ID = ?

        ")){
=======
    ?>

	<div class="">
		
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

                    echo "<table class = 'table table-striped table-bordered mt-3'>";
                    echo "
                        <thead>
                            <tr>
                                <th style = 'width:65%;'>Namn</th>
                                <th style = 'width:35%;'>Klass</th>
                            </tr>
                        </thead>
                    ";


                	while ($stmt->fetch()) {
                		
                		echo "

                            <tr>
                                <td>".$fname." ".$lname."</td>
                                <td>".$programme."".$grade."".$letter."</td>
                            </tr>
>>>>>>> e36e89c85e2c253a039276428a592fa494840c60

            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();

            $stmt->bind_result($fname, $lname, $programme, $grade, $letter);

<<<<<<< HEAD
            echo "<table class = 'table table-striped table-bordered mt-3'>";
            echo "
                <thead'>
                    <tr>
                        <th style = 'width:65%;'>Namn</th>
                        <th style = 'width:35%;'>Klass</th>
                    </tr>
                </thead>
            ";

            while ($stmt->fetch()) {
                echo "
                    <tr>
                        <td>".$fname." ".$lname."</td>
                        <td>".$programme."".$grade."".$letter."</td>
                    </tr>
                ";
=======


                	$stmt->close();
>>>>>>> e36e89c85e2c253a039276428a592fa494840c60

            }
            echo "</table>";

            $stmt->close();

        } else {

            echo "Gruppen finns inte";

        }

    }


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