<?

	include "sql_setup.php";

    if ($_POST["email"] && $_POST["password"]){

    	if ($stmt = $mysqli->prepare("

    		SELECT EMAIL
    		FROM USERS
    		WHERE EMAIL = ?

    	")){

    		$stmt->bind_param("s", $email);

   			$email = $_POST["email"];

   			$stmt->execute();
   			if ($stmt->fetch()){
   				header("Location: signIn.php?form=signup&message=existingemail");
   				exit;
   			}

   			$stmt->close();

    	}

    	if ($stmt = $mysqli->prepare("

    		INSERT INTO USERS (EMAIL, PASSWORD, FIRST_NAME, LAST_NAME, PROGRAMME, GRADE, LETTER)
    		VALUES (?, ?, ?, ?, ?, ?, ?)

    	")){

    		$stmt->bind_param("sssssis", $email, $password, $first_name, $last_name, $programme, $grade, $letter);

    		$email = $_POST["email"];
    		$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    		$first_name = ucfirst(strtolower($_POST["fname"]));
    		$last_name = ucfirst(strtolower($_POST["lname"]));
    		$programme = $_POST["programme"]?$_POST["programme"]:"TEACHER";
    		$grade = $_POST["grade"]?$_POST["grade"]:"TEACHER";
    		$letter = $_POST["letter"]?$_POST["letter"]:"TEACHER";

    		$stmt->execute();
    		$stmt->close();
    		
   			header("Location: signIn.php?message=accountcreated");
   			exit;

    	}


    } else echo "sorry fam";

	$mysqli->close();

?>