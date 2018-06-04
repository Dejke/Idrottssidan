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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link rel="stylesheet" href="stylesheets/signIn.css">

    <?
        $firstFieldsClass = ".login-fields";

        if($_GET["form"]){
            $firstFieldsClass = ".".$_GET["form"]."-fields";
        }
    ?>

    <style type="text/css">
        .fields{
            display:none;
        }
        <?echo $firstFieldsClass; ?>{
            display: inline-block;
        }

	</style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript">
        
        function setForm(newForm){
            document.getElementById("message").classList = "";
            document.getElementById("message").innerHTML = "";
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
        }

        function putMessage(text, type){


            document.getElementById("message").innerHTML = text;


            document.getElementById("message").classList = "";
            document.getElementById("message").classList.add("alert");
            document.getElementById("message").classList.add("alert-"+type);

        }

    </script>
	
</head>
<body>


<div class="containz">

    <div id="logo"></div>

        <div id="message"></div>

        <?
            if ($_GET["message"]){
                switch ($_GET["message"]) {
                    case "checkemail":
                        message("Vi har skickat ett e-mail till din Ksgyf-adress med en länk där du kan återställa ditt lösenord. Om du inte ser mailet i inkorgen eller skräpkorgen inom 5 minuter, så kan du försöka igen.", "info");
                        break;
                    case "noexistemail":
                        message("Det finns inget konto kopplat till mailadressen du fyllde i.", "warning");
                        break;
                    case "existingemail":
                        message("Det finns redan ett konto med mailadressen som du fyllde i.", "warning");
                        break;
                    case "accountcreated":
                        message("Ditt konto har skapats.", "success");
                        break;
                    case "invalidlogin":
                        message("Felaktig mailadress eller lösenord.", "danger");
                        break;
                    case "passwordchanged":
                        message("Ditt lösenord har ändrats.", "success");
                        break;
                    case "loggedout":
                        message("Du har loggats ut.", "info");
                        break;
                    default:
                        message($_GET["message"], true);
                }
            }

            function message($text, $type){
                echo "<script>putMessage('".$text."','".$type."')</script>";
            }

        ?>

    <!-- LOG IN FORM MEME (VAD I HEL VETE DEN LÄGGER TILL EN BR SOM FÖRSVINNER OM MAN KLICKAR PÅ EN LÄNK OCH SEN TILLBAKA WTff??!?!?!?+ -->
    <form id="loginForm" method="post" action="db_sign_in.php" class="fields login-fields">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
            </div>
            <label class="sr-only">Ksgyf-email</label>
            <input type="text" name="email" class="form-control" placeholder = "Ksgyf-email">
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
            </div>
            <label class="sr-only">Lösenord</label>
            <input type="password" name="password" class="form-control">
        </div>

        <input type="submit" value="Logga in" class="form-control">
    </form>

    <!-- SIGN UP FORM MEME -->
    <form id="signupForm" method="post" action="db_add_user.php" class="fields signup-fields needs-validation" novalidate>
        
        <div class="input-group row mb-4" style = "margin-left:0;">
            <div class="input-group-prepend ">
                <div class="input-group-text">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <label class="sr-only">Förnamn</label>
            <input type="text" name="fname" max="64" class="form-control col-6" placeholder = "Förnamn" required>
            <label class="sr-only">Efternamn</label>
            <input type="text" name="lname" max="64"class="form-control col-6" placeholder = "Efternamn" required style= "border-left:0;">
            <div class="invalid-feedback">
                Fyll i ett för- och efternamn.
            </div>
        </div>

        
        <div class="control-group mb-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-at"></i></div>
                </div>
                <label class="sr-only">Ksgyf-email</label>
                <input type="text" name="email" id = "email2" pattern="[a-zA-Z0-9_.]+@?ksgyf.se" title="Ange en mailadress från ksgyf." onfocusout="studentMailCheck(this);" class="form-control" placelholder = "Ksgyf-email" required>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-at"></i></div>
                </div>
                <label class="sr-only">Upprepa Ksgyf-email</label>
                <input type="text" name="email2" id = "email1" class="form-control" placeholder = "Upprepa Ksgyf-email" required>

                <div class="invalid-feedback">
                    Fyll i två matchande Ksgyf-emailadresser
                </div>
            </div>
        </div>

        <div class="form-group">
            <span id="password-warning"></span>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                </div>
                <label class="sr-only">Lösenord</label>
                <input type="password" name="password" id = "pw1" class="form-control" placeholder = "Lösenord" required>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                </div>
                <label class="sr-only">Upprepa lösenord</label>
                <input type="password" name="password2" id = "pw2" class="form-control" placeholder = "Upprepa lösenord" required>

                <div class="invalid-feedback">
                    Lösenorden måste matcha.
                </div>
            </div>
        </div>

        <label id = "classLabel">Klass</label>

        <div class="form-group row mb-4" style = "margin-right: 0; margin-left:0;">
            <select name="programme" class="classFields form-control col-4" required>
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
            <select name="grade" class="classFields form-control col-4" required>
                <option value="TEACHER"></option>
                <?
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

            <select name = "letter" class = "classFields form-control col-4" required>
                <option value="TEACHER"></option>
                    <?
                        for($i = 65; $i <= 65+12; $i++){
                            $chr = chr($i);
                            echo('<option value="'.$chr.'">'.$chr.'</option>');
                        }
                    ?>
            </select>
        </div>

        
        <input type="submit" value="Registrera"class="form-control">

    </form>

    <!-- PASS RESET FORM MEME -->
    <form id="passwordResetForm" method="post" action="db_password_reset.php" class="fields pwreset-fields">
        <div class="input-group mb-4">
            <div class="input-group-prepend ">
                <div class="input-group-text">
                    <i class="fas fa-at"></i>
                </div>
            </div>
            <label class="sr-only">Ksgyf-email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <input type="submit" value="Skicka återställningslänk" class="form-control">
    </form>
    <div class="mt-4">
        <div class="fields signup-fields pwreset-fields w-100">
            <a href="#" id="login">Logga in</a>
        </div>
        <div class="fields login-fields pwreset-fields w-100">
            <a href="#" id="signup">Registrera ett konto</a>
        </div>
        <div class="fields login-fields signup-fields w-100">
            <a href = "#" id="pwreset">Glömt ditt lösenord?</a>
        </div>
    </div>
    
</div>
</body>


<script type="text/javascript">
 
    var form = document.getElementById("signupForm");
    form.addEventListener("submit", function(event){
        

        document.querySelectorAll("#signupForm input:not([type='submit'])").forEach(function(obj){
            obj.classList.remove("is-invalid");
            obj.classList.add("is-valid");
        });

        required = document.querySelectorAll("#signupForm [required]:not([disabled])");
        required.forEach(function(obj){
            if(obj.value == ""){
                obj.classList.add("is-invalid");
                event.preventDefault();
                event.stopPropagation();
            }
        });


        var email1 = document.getElementById("email1");
        var email2 = document.getElementById("email2");

        var pw1 = document.getElementById("pw1");
        var pw2 = document.getElementById("pw2");



        if (email1.value != email2.value){
            email1.classList.add("is-invalid");
            email2.classList.add("is-invalid");
            event.preventDefault();
            event.stopPropagation();
        }

        if (pw1.value != pw2.value){

            pw1.classList.add("is-invalid");
            pw2.classList.add("is-invalid");
            event.preventDefault();
            event.stopPropagation();
        }

        document.querySelectorAll("#signupForm select").forEach(function(obj){
            if(obj.value == "TEACHER" && !obj.disabled){
                obj.classList.add("is-invalid");
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });

    function studentMailCheck(field){
        if(/\.student\@/.test(field.value)){
            <?/* när ".student@" finns i fältet*/?>
            $(".classFields")
                .prop("disabled",false);
            $("#classLabel").css("opacity", "1");
        }
        else{
            <?/* när ".student@" inte finns i fältet*/?>
            $(".classFields")
                .val("0")
                .prop("disabled",true);
            $("#classLabel").css("opacity", "0");

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


</script>
</html>