<? 
    
    session_start();
    if(isset($_SESSION["USER"])){
        header("Location: index.php");
        exit;
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Logga in</title>

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
        
        @media (: 767.98px) {
            
        }

	</style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	
</head>
<body>
<div class="containz">
    <div id="logo"></div>
    <form id="loginForm" method="post" action="db_sign_in.php" class="fields login-fields">
        <label>Ksgyf-email</label><br>
		<input type="text" name="email">
        <br><br>
		<label>Lösenord</label><br>
		<input type="password" name="password">
        <br><br>

        <input type="submit" value="Logga in">
    </form>

    <form id="signupForm" method="post" action="db_add_user.php" onsubmit="return validate(this)" class="fields signup-fields">

		<span id="email-warning"><br></span>
		<label>Ksgyf-email</label><br>
		<input type="text" name="email" pattern="[a-zA-Z0-9_.]+@?ksgyf.se" title="Ange en emailadress från ksgyf."><br>

        <label>Upprepa ksgyf-email</label><br>
        <input type="text" name="email2"><br><br>


        <span id="password-warning"><br></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <label>Upprepa lösenord</label><br>
        <input type="password" name="password2"><br><br>

        <label>Klass:</label>
        <select name="programme">
            <option value="BA">BA</option>
            <option value="EE">EE</option>
            <option value="FT">FT</option>
            <option value="HV">HV</option>
            <option value="IM">IM</option>
            <option value="IMS">IMS</option>
            <option value="NA">NA</option>
            <option value="TE">TE</option>
            <option value="VF">VF</option>
        </select>
        <select name="grade">
            <?

                // OOOF måste lägga till kommentar för att filstorleken  ändras memex
                if(date('n')>=7){
                    $highestYear = date("Y");
                }
                else{
                    $highestYear = date("Y")-1;
                }

                for($year = $highestYear; $year >= (int)($highestYear-2); $year--){
                    $abbrev = substr($year, -2);
                    echo('<option value="'.$abbrev.'">'.$abbrev.'</option>');
                }
            ?>
        </select>

        <select name = "letter">
                <?
                    for($i = 65; $i <= 65+12; $i++){
                        $chr = chr($i);
                        echo('<option value="'.$chr.'">'.$chr.'</option>');
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

    <div class="fields login-fields">
        <a href="#" id="signup">Registrera ett konto</button>
    </div>
    <div class="fields signup-fields">
        <a href="#" id="login">Är du redan registrerad? Logga in</a>
    </div>
    <div class="fields pwreset-fields">
        <a href = "#" id="pwreset">Glömt ditt lösenord?</a>
    </div>
    
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
            document.getElementById('email-warning').innerHTML = "Emailadresserna måste matcha<br>";

        }

        if (e["password"].value == e["password2"].value){

            passwordMatch = true;

        } else {

            document.getElementById('password-warning').style.display = "inline";
            document.getElementById('password-warning').innerHTML = "Lösenorden måste matcha<br>";

        }

        return passwordMatch && emailMatch;

    }

    $("#signup").click(function(){
        setForm("signup");
    });

    $("#login").click(function(){
        setForm("login");
    });
    
    $("#pwreset").click(function(){
        setForm("pwreset");
    });
    

    function setForm(newForm){
        switch(newForm){
            case "login":
                $(".fields").css("display","none");
                $("#login-fields").css("display);
                break;
            case "signup":

                break;
            case "pwreset":

                break;
            default:
                Console.error("newForm existerar inte.");
        }
    }
</script>

</html>