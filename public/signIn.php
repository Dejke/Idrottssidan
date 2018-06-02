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
    <link rel="stylesheet" href="stylesheets/signIn.css">

    <?
        $firstFieldsClass = ".login-fields";

        if($_GET["form"]){
            $firstFieldsClass = ".".$_GET["form"]."-fields";
        }
    ?>

    <style type="text/css">
		#email-warning{
            display: none;
			color: red;
		}
		#password-warning{	
            display: none;
			color: red;
		}
        .fields{
            display:none;
        }
        <?echo $firstFieldsClass; ?>{
            display: inline-block;
        }
        .good-message{
            color: green;
        }
        .bad-message{
            color: red;
        }

	</style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript">
        
        function setForm(newForm){

            $(".fields").css("display","none");

            switch(newForm){
                case "signup":
                    $(".signup-fields").css("display", "inline-block");
                    break;
                case "pwreset":
                    $(".pwreset-fields").css("display", "inline-block");
                    break;
                default:
                    $(".login-fields").css("display", "inline-block");
                    break;
            }
            //$("#message").remove();
        }

        function putMessage(text, good, page){

            setForm(page);

            document.getElementById("message").innerHTML = ""+text+"<br><br>";

            if (good){

                document.getElementById("message").classList.remove("bad-message");
                document.getElementById("message").classList.add("good-message");

            }

        }

    </script>
	
</head>
<body>


<div class="containz">

    <div id="logo"></div>

        <span id="message" class="bad-message"></span>

        <?
            if ($_GET["message"]){
                switch ($_GET["message"]) {
                    case "checkemail":
                        message("Vi har skickat ett e-mail till din ksgyf-adress med en länk där du kan återställa ditt lösenord.<br>\n
                        Om du inte ser mailet i inkorgen eller skräpkorgen inom 5 minuter, så kan du försöka igen.", true, "login");
                        break;
                    case "noexistemail":
                        message("Det finns inget konto kopplat till mailadressen du fyllde i.", false, "login");
                        break;
                    case "existingemail":
                        message("Det finns redan ett konto med mailadressen som du fyllde i.", false, "signup");
                        break;
                    case "accountcreated":
                        message("Ditt konto har skapats.", true, "login");
                        break;
                    case "invalidlogin":
                        message("Felaktig mailadress eller lösenord.", false, "login");
                        break;
                    case "passwordchanged":
                        message("Ditt lösenord har ändrats.", true, "login");
                        break;
                    default:
                        message($_GET["message"], true, "login");
                }
            }
<<<<<<< HEAD

            function message($text, $good, $page){
                echo "<script>putMessage('".$text."',".($good ? 'true' : 'false').",'".$page."')</script>";
            }

        ?>

=======
            echo "</span><br>\n<br>\n";
        }
    ?>
>>>>>>> bafb8f4de834a1c2c3f1e4cad6168cd3214aef86
    <!-- LOG IN FORM MEME (VAD I HEL VETE DEN LÄGGER TILL EN BR SOM FÖRSVINNER OM MAN KLICKAR PÅ EN LÄNK OCH SEN TILLBAKA WTff??!?!?!?+ -->
    <form id="loginForm" method="post" action="db_sign_in.php" class="fields login-fields">
        <label>Ksgyf-email</label><br>
		<input type="text" name="email">
        <br><br>
		<label>Lösenord</label><br>
		<input type="password" name="password">
        <br><br>

        <input type="submit" value="Logga in">
    </form>

    <!-- SIGN UP FORM MEME -->
    <form id="signupForm" method="post" action="db_add_user.php" onsubmit="return validate(this)" class="fields signup-fields">

		<span id="email-warning"></span>
		<label>Ksgyf-email</label><br>
		<input type="text" name="email" pattern="[a-zA-Z0-9_.]+@?ksgyf.se" title="Ange en mailadress från ksgyf." onfocusout="studentMailCheck(this);"><br>

        <label>Upprepa ksgyf-email</label><br>
        <input type="text" name="email2"><br><br>


        <span id="password-warning"></span>
		<span>Lösenord</span><br>
		<input type="password" name="password"><br>

        <label>Upprepa lösenord</label><br>
        <input type="password" name="password2"><br><br>

        <label>Klass:</label>
        <select name="programme" class="classFields">
            <option value="TEACHER"></option>
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
        <select name="grade" class="classFields">
            <option value="TEACHER"></option>
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

        <select name = "letter" class = "classFields">
            <option value="TEACHER"></option>
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

    <!-- PASS RESET FORM MEME -->
    <form id="passwordResetForm" method="post" action="db_password_reset.php" class="fields pwreset-fields">
        <label>Ksgyf-email</label><br>
        <input type="text" name="email">
        <br><br>

        <input type="submit" value="Skicka återställningslänk">
    </form>

    <br><br>

    <div class="fields login-fields">
        <a href="#" id="signup">Registrera ett konto</a>
    </div>
    <div class="fields signup-fields">
        <a href="#" id="login">Är du redan registrerad? Logga in</a>
    </div>
    <div class="fields login-fields">
        <a href = "#" id="pwreset">Glömt ditt lösenord?</a>
    </div>
    <div class="fields pwreset-fields">
        <a href = "#" id="login2">Logga in</a>
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
            document.getElementById('email-warning').innerHTML = "Mailadresserna måste matcha<br>";
        }

        if (e["password"].value == e["password2"].value){

            passwordMatch = true;

        } else {

            document.getElementById('password-warning').style.display = "inline";
            document.getElementById('password-warning').innerHTML = "Lösenorden måste matcha<br>";

        }

        return passwordMatch && emailMatch;
    }

    function studentMailCheck(field){
        if(/\.student\@/.test(field.value)){
            <?/* när ".student@" finns i fältet*/?>
            $(".classFields")
                .prop("disabled",false);
        }
        else{
            <?/* när ".student@" inte finns i fältet*/?>
            $(".classFields")
                .val("0")
                .prop("disabled",true);

        }
    }

    $("#signup").click(function(){
        setForm("signup");
    });

    $("#login").click(function(){
        setForm("login");
    });
    
    $("#login2").click(function(){
        setForm("login");
    });

    $("#pwreset").click(function(){
        setForm("pwreset");
    });

    /**jag HATAR cache */

</script>
</html>