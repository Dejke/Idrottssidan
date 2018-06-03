<?
    session_start();

    if(!isset($_SESSION["USER"])){
        header("Location: signIn.php");
        exit;
    }
    
    //We be testing, yo chiidslllaisdsddowkawdasdawddwdjadwadsdiow*/
    include "sql_setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">

    <style type="text/css">
        

    @media (min-width: 768px) {
    .container-small {
        width: 300px;
    }
    .container-large {
        width: 970px;
    } 
    } 
    @media (min-width: 992px) {
        .container-small {
            width: 500px;
        }
        .container-large {
            width: 1170px;
        } 
    } 
    @media (min-width: 1200px) {
        .container-small {
            width: 700px;
        }
        .container-large {
            width: 1500px;
        } 
    }

    .container-small, .container-large {
        max-width: 100%;
    }


    </style>

</head>
<body>

	<?include "header.php";?>

	<div class="container container-small text-center">
        
        <span class="h3 pb-2">Byt lösenord</span>
        <form id="changePasswordForm" method="post" action="" class="pb-5">

            <div class="input-group">
                <div class="input-group-prepend ">
                    <div class="input-group-text">
                        <i class="fas fa-unlock"></i>
                    </div>
                </div>
                <label class="sr-only">Lösenord</label>
                <input type="text" name="password" class="form-control">
            </div>

            <div class="input-group">
                <div class="input-group-prepend ">
                    <div class="input-group-text">
                        <i class="fas fa-unlock"></i>
                    </div>
                </div>
                <label class="sr-only">Nytt lösenord</label>
                <input type="text" name="newpassword" class="form-control">
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend ">
                    <div class="input-group-text">
                        <i class="fas fa-unlock"></i>
                    </div>
                </div>
                <label class="sr-only">Nytt lösenord</label>
                <input type="text" name="newpassword2" class="form-control">
            </div>

            <input type="submit" value="Byt Lösenord" class="form-control">
        </form>

        <span class="h3 pt-5 mt-5">Byt klass</span>
        <form id="changePasswordForm" method="post" action="" class="">
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

            <input type="submit" value="Byt klass" class="form-control">

        </form>



    </div>

</body>
</html>