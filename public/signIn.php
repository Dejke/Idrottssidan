<!DOCTYPE html>
<html>
<head>
	<title>Skapa konto</title>

	<style type="text/css">
		
		#email-warning{
			display: none;
			color: red;
		}
		#password-warning{
			display: none;
			color: red;
		}

	</style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	
</head>
<body>

	<!-- Eller ska den skicka till self?!?!? hmmm idk meme -->
	<form action="db_add_user.php" method="post" onsubmit="return validate(this)">
		
		<span id="email-warning">Email måste matcha<br></span>
		<label>Email</label><br>
		<input type="text" name="email"><br>

        <div class="signup-fields">
            <label>Email igen</label><br>
            <input type="text" name="email2"><br><br>
        </div>
		
        <span id="password-warning" >Lösenord måste matcha<br></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <div class="signup-fields">
            <label>Lösenord igen</label><br>
            <input type="password" name="password2"><br><br>

            <label>Klass</label><br>
            <select name="class">
                <?
                    /*hämta klasser typ*/
                ?>
            </select><br>
        </div>
		<input type="submit" value="Skapa konto">

	</form>
    
</body>
<script type="text/javascript">
		
    function validate(form){

        var e = form.elements;
        var passwordMatch = false;
        var emailMatch = false;
        var classSelected = true;

        if (e["email"].value == e["email2"].value){

            emailMatch = true;

        } else {
            document.getElementById('email-warning').style.display = "inline";

        }

        if (e["password"].value == e["password2"].value){

            passwordMatch = true;

        } else {

            document.getElementById('password-warning').style.display = "inline";

        }

        return passwordMatch && emailMatch;

    }

</script>

</html>