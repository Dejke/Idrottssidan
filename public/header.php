<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style type="text/css">

  .btn i{
    font-size: 2em; 
  }
  .btn:focus, .btn:active:focus, .btn.active:focus{
    outline:none;
    box-shadow:none;
  }
  .navbar{
    background-color: #e5edf2;
  }
  .navbuttonz{
    -o-transition:.25s;
    -ms-transition:.25s;
    -moz-transition:.25s;
    -webkit-transition:.25s;
    transition:.25s;
    background-color: #e5edf2;
  }
  .navbuttonz:hover{
    color: #444444;
  }

  .btn:focus i{
    -webkit-text-stroke: 2px #004788;
  }

  .btn:focus, .btn:active:focus, .btn.active:focus{
    outline:none;
    box-shadow:none;
  }

  .user-name{
    font-size: 1.5rem;
    position: relative;
    top: 12px;
  }

</style>

<nav class="navbar navbar-expand-lg" >
    <a class="navbar-brand" href="index">
    <div style= "
                    background:url('images/logo.svg');
                    width: 90px;
                    height:108px;
                    background-size:cover;
                    margin: -20px 0 -40px 0;
                    position: relative;
                    top: 10px;
                "
            alt = "Lars Kagg"></div>
    </a>

  <div class="btn-group ml-auto" style="float: right;">
  <button type="button" class="btn btn-lg user text-center navbuttonz vertical-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 20px; background: none; ">
    <span class="user-name mr-1" style="position:relative; top:-5px;"><?/*vackert.*/?>
      
      <?

        // GET NAMEn
        if ($stmt = $mysqli->prepare("

            SELECT USERS.FIRST_NAME, USERS.LAST_NAME
            FROM USERS
            WHERE USERS.ID = ?

        ")){
          
            $stmt->bind_param("i", $_SESSION["USER"]);
            $stmt->execute();

            $stmt->bind_result($fname, $lname);

            if ($stmt->fetch()){
              echo $fname." ".$lname;
            }

            $stmt->close();

        } 

      ?>

    </span>
    
      <i class="fas fa-user"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right mt-3"  >
      <a class="dropdown-item p-2" href="user_page.php"><i class="fas fa-cog"></i> Kontoinställningar</a>
      <a class="dropdown-item p-2" href="db_log_out.php"><i class="fas fa-sign-out-alt"></i> Logga ut</a>
    </div>
   
  </div>

</nav>
