<!DOCTYPE html>
<html>
<head>
	<title>Skapa konto</title>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
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


    <form id="loginForm" method="post" action="db_login.php" class="login-fields">
        <label>Email</label><br>
		<input type="text" name="email"><br>

		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <input type="submit" value="Logga in">
    </form>

    <form id="signupForm" method="post" action="db_add_user.php" onsubmit="return validate(this)" class="signup-fields">
        
		
		<span id="email-warning">Email måste matcha<br></span>
		<label>Email</label><br>
		<input type="email" name="email"><br>

        <label>Upprepa email</label><br>
        <input type="email" name="email2"><br><br>


        <span id="password-warning">Lösenord måste matcha<br></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <label>Upprepa lösenord</label><br>
        <input type="password" name="password2"><br><br>

        <label>Klass</label>
        <select name="class">
            <?
                /*hämta klasser typ*/
            ?>
        </select><br><br>
        
        <input type="submit" value="Registrera">
    </form>
	<!-- Eller ska den skicka till self?!?!? hmmm idk meme -->

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
        $("#email-warning, #password-warning").css("display","none")
        currentForm = "signin";
    });
</script>

</html>