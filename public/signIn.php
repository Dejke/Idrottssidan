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
        .signup-fields{
            
            display:none;
        }

	</style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	
</head>
<body>

	<!-- Eller ska den skicka till self?!?!? hmmm idk meme -->
	<form method="post" onsubmit="return validate(this)">
		
		<span id="email-warning">Email måste matcha<br></span>
		<label>Email</label><br>
		<input type="text" name="email"><br>

        <div class="signup-fields">
            <label>Upprepa email</label><br>
            <input type="text" name="email2"><br><br>
        </div>
		
        <span id="password-warning">Lösenord måste matcha<br></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <div class="signup-fields">
            <label>Upprepa lösenord</label><br>
            <input type="password" name="password2"><br><br>

            <label>Klass</label>
            <select name="class">
                <?
                    /*hämta klasser typ*/
                ?>
            </select><br><br>
        </div>
		<div class="login-fields">
            <input formaction="db_login.php" type="submit" value="Logga in">
        </div>
        
        <div class="signup-fields">
            <input formaction="db_add_user.php" type="submit" value="Registrera">
        </div>    
        <br>

	</form>
    <div class="login-fields">
        <a href="#" id="signup">Registrera ett konto</button>
    </div>
    <div class="signup-fields">
        <a href="#" id="signin">Logga in</button>
    </a>
</body>
<script type="text/javascript">
	var currentForm = "signin";

    function validate(form){
        if(currentForm == "signin"){
            return true;
        }
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

    $("#signup").click(function(){
        $(".signup-fields").css("display", "block");
        $(".login-fields").css("display", "none");
        currentForm = "signup";
    });

    $("#signin").click(function(){
        $(".signup-fields").css("display", "none");
        $(".login-fields").css("display", "block");
        currentForm = "signup";
    });
</script>

</html>