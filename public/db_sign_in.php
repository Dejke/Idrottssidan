<?
	
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

			$stmt->bind_results($hash, $id);

			if (password_verify($_POST["password"], $hash)){

				//$_SESSION["USER"] = $id;

			} else {

				header("Location: signIn.php?message=invalidlogin");

			}

		}

	} else {

		header("Location: signIn.php?message=invalidlogin");

	}

?>