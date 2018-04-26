<?
	session_start();
	include "sql_setup.php";

	if ($_POST["email"] && $_POST["password"]){

		if ($stmt = $mysqli->prepare("

    		SELECT PASSWORD, ID
    		FROM USERS
    		WHERE EMAIL = ?

    	")){

			$stmt->bind_param("s", $email);
			$email = $_POST["email"];

			$stmt->execute();

			$stmt->bind_result($hash, $id);
			$stmt->close();

			if (password_verify($_POST["password"], $hash)){

				$_SESSION["USER"] = $id;
				header("Location: index.php");
				exit;

			} else {

				header("Location: signIn.php?message=invalidlogin");
				exit;

			}

		}

	} else {

		header("Location: signIn.php?message=skriv");
		exit;

	}

?>