<?

	session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }

    include "sql_setup.php";

    if($_POST["group_id"]){

        // check for space boi
        if ($stmt = $mysqli->prepare("

            SELECT count(*), GROUPS.MAX_MEMBERS
            FROM GROUPS
            INNER JOIN USERS
            ON USERS.GROUP_ID = GROUPS.ID
            WHERE USERS.GROUP_ID = ?

        ")){

            $stmt->bind_param("i", $_POST["group_id"]);
            $stmt->execute();

            $stmt->bind_result($amount, $max_members);

            if ($stmt->fetch()){
                if ($amount == $max_members){

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;

                }
            }

            $stmt->close();

        }

        // Delete created group
    	if ($stmt = $mysqli->prepare("

    		DELETE FROM GROUPS
    		WHERE GROUPS.CREATOR_ID = ?

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
    //memeMeme

?>