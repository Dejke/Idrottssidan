<?
	session_start();
	include "sql_setup.php";

	if ($_POST["email"] && $_POST["password"]){

		if ($stmt = $mysqli->prepare("

    		SELECT ID, PASSWORD
    		FROM USERS
    		WHERE EMAIL = ?

    	")){

			$stmt->bind_param("s", $email);
			$email = $_POST["email"];

			$stmt->execute();

			$stmt->bind_result($id, $hash);

			if ($stmt->fetch()) {

				if (password_verify($_POST["password"], $hash)){

					$_SESSION["USER"] = $id;
					header("Location: index.php");
					exit;

				} else {

					header("Location: signIn.php?message=invalidlogin");
					exit;
				}
			}
			else{
				header("Location: signIn.php?message=invalidlogin");
				exit;
			}

		}

	} else {
		header("Location: signIn.php?message=invalidlogin");
		exit;
	}

?>