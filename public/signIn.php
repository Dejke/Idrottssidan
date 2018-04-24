<? include"sql_setup.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Skapa konto</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<style type="text/css">
		.containz{
            background-color:lightgray;
            width: 300px;
            margin: 0 auto;
            text-align:center;
            padding: 15px;
            padding-top: 80px;
            display: inline-block;
            position: relative;
        }
		#email-warning{
            display: none;
			color: red;
		}
		#password-warning{
			
            display: none;
			color: red;
		}

        #logo{
            position:absolute;
            top:-50px;
            left: calc(50% - 50px);
            width: 100px;
            height: 120px;
            background:url("images/logo.png");
            background-size:cover;
        }
        .signup-fields{
            
            display:none;
        }
        body{
            display:flex;
            justify-content:center;
            align-items:center;
        }   
        html{
            padding:80px 0 50px 0;
        }
        html,body{
            height:100%;
        }
        
        @media (max-width: 767.98px) {
            .containz{
                width: 100%;
                /*
                    Fix bomile thanks
                */
            }
        }

	</style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	
</head>
<body>

<div class="containz">
    <div id="logo"></div>
    <form id="loginForm" method="post" action="db_login.php" class="login-fields">
        <label>Email</label><br>
		<input type="text" name="email">
        <br><br>
		<label>Lösenord</label><br>
		<input type="password" name="password">
        <br><br>

        <input type="submit" value="Logga in">
    </form>

    <form id="signupForm" method="post" action="db_add_user.php" onsubmit="return validate(this)" class="signup-fields">

		<span id="email-warning">Email måste matcha<br></span>
		<label>Email</label><br>
		<input type="text" name="email"><span>@ksgyf.se</span><br>

        <label>Upprepa email</label><br>
        <input type="text" name="email2"><span>@ksgyf.se</span><br><br>


        <span id="password-warning">Lösenord måste matcha<br></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <label>Upprepa lösenord</label><br>
        <input type="password" name="password2"><br><br>

        <label>Klass</label>
        <select name="class">
            <?
                if ($stmt = $mysqli->prepare("

                    SELECT NAME, ID 
                    FROM CLASSES

                ")) {

                    $stmt->execute();
                    $stmt->bind_result($name, $id);

                    while($stmt->fetch()){

                        echo "<option value='".$id."'>".$name."</option>";

                    }

                    $stmt->close();

                }
            ?>
        </select>
        <br><br>
        <label>Förnamn</label><br>
        <input type="text" name="fname" max="64">
        <br>
        <label>Efternamn</label>
        <br>
        <input type="text" name="lname" max="64">
        <br><br>
        <input type="submit" value="Registrera">
    </form>

    <br>

    <div class="login-fields">
        <a href="#" id="signup">Registrera ett konto</button>
    </div>
    <div class="signup-fields">
        <a href="#" id="signin">Är du redan registrerad? Logga in</button>
    </a>
</div>
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

    $("#signup").click(function(){
        $(".signup-fields").css("display", "block");
        $(".login-fields").css("display", "none");
    });

    $("#signin").click(function(){
        $(".signup-fields").css("display", "none");
        $(".login-fields").css("display", "block");
        $("#email-warning, #password-warning").css("display","none");
    });
</script>

</html>