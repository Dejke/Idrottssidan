<?
	// 1post-LKteInf18 <- Lmao viktigt lösenord
	session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }

	include "sql_setup.php";

	if ($_POST["userId"] && $_POST["activityId"] && $_POST["groupSize"]){

		if ($stmt = $mysqli->prepare("

    		INSERT INTO GROUPS (ACTIVITY_ID, MAX_MEMBERS)
    		VALUES (?, ?)

    	")){

			$stmt->bind_param("ii", $_POST["activityId"], $_POST["groupSize"]);

			$stmt->execute();
    		$stmt->close();	

    		$groupId = $mysqli->insert_id;

    		if ($stmt = $mysqli->prepare("

	    		UPDATE USERS 
	    		SET USERS.GROUP_ID = ?
	    		WHERE USERS.ID = ?

    		")){

    			$stmt->bind_param("ii", $groupId, $_SESSION["USER"]);

    			$stmt->execute();
    			$stmt->close();	

    			header('Location: ' . $_SERVER['HTTP_REFERER']);
    			exit;

    		} else echo "Kunde inte lägga in användare i grupp";

    	} else echo "Kunde inte skapa grupp";

	} else echo "Saker stämde inte";

?>