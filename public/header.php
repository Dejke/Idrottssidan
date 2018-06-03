<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style type="text/css">
  
  .navbuttonz i{
    font-size: 1.7em; 
  }
  .navbuttonz:focus i{
    text-shadow: 0px 0px 4px #004788;
    
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

</style>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
      <a class="navbar-brand" href="index">
      <div style= "
                      background:url('images/logo.svg');
                      width: 100px;
                      height:120px;
                      background-size:cover;
                      margin: -32px 0 -40px 0;
                      position: relative;
                      top: 20px;
                  "
              alt = "Lars Kagg"></div>
      </a>

    <div class="btn-group ml-auto" style="float: right;">
     
      <a href="user_page.php"><button class="btn navbuttonz"><i class="fas fa-cog text-dark"></i></button></a>
      <a href="db_log_out.php"><button class="btn navbuttonz"><i class="fas fa-sign-out-alt text-dark"></i></button></a>
    </div>
   
  </div>

</nav>