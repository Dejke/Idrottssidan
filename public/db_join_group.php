<?

	session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }

    if($_POST["group_id"]){

    	if ($stmt = $mysqli->prepare("

    		DELETE FROM GROUPS
    		INNER JOIN USERS
    		ON GROUPS.ID = USERS.GROUP_ID
    		WHERE USERS.ID = ?

    	")){

    		$stmt->bind_param("i", $_SESSION["USER"]);
            $stmt->execute();

            $stmt->close();
    	}

    	// Join new group
    	if ($stmt = $mysqli->prepare("

    		UPDATE USERS
    		SET USERS.GROUP_ID = ?
    		WHERE USERS.ID = ?

    	")){

    		$stmt->bind_param("ii", $_POST["group_id"], $_SESSION["USER"]);
            $stmt->execute();

            $stmt->close();

       	}

    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>