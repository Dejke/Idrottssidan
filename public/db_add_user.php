<?

	include "sql_setup.php";

    if ($_POST["email"] && $_POST["password"] && $_POST["fname"] && $_POST["lname"]){

    	if ($stmt = $mysqli->prepare("

    		SELECT EMAIL
    		FROM USERS
    		WHERE EMAIL = ?

    	")){

    		$stmt->bind_param("s", $email);

   			$email = $_POST["email"];

   			$stmt->execute();
   			if ($stmt->fetch()){
   				header("Location: signIn.php?message=existingemail");
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
    		$first_name = $_POST["fname"];
    		$last_name = $_POST["lname"];
    		$programme = $_POST["programme"];
    		$grade = $_POST["grade"];
    		$letter = $_POST["letter"];

    		$stmt->execute();
    		$stmt->close();
    		
   			header("Location: signIn.php?message=accountcreated");
   			exit;

    	}


    } else {

    	header("Location: signIn.php?message=missinginfo");
    	exit;

    }

	$mysqli->close();

?>