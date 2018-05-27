<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style type="text/css">

  .user{
    width: 50px;
    height: 50px;
  }
  .user i{
    font-size: 3em;
  }

  /*
  .drop{
    font-size: 1em;

    width: 200px;
    min-height: auto;

    background-color: green;
    display: none;

    position: relative;
    left:-150px;
    top: 10px;
    z-index: 10;
  }
  .drop *{
    margin-top: 10px !important;
    margin-bottom: 10px !important;
  }
  */

</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index">
    <div style= "
                    background:url('images/logo.svg');
                    width: 90px;
                    height:108px;
                    background-size:cover;
                    margin: -10px 0 -40px 0;
                "
            alt = "Lars Kagg"></div>
    </a>

  <!--
  <div class="user navbar-nav ml-auto">

    <i class="fas fa-user"></i>

    <div class="drop h4 text-center">

      <span class="">HALLÅs</span><br>
      <a class="" href="db_log_out.php">Logga ut</a>

    </div>

  </div>
  -->

  <div class="btn-group ml-auto" style="float: right;">
    <button type="button" class="btn btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #3c5fdf; border-color: #3c5fdf; border-radius: 4px ">
      <i class="fas fa-user"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right mt-0">
      <a class="dropdown-item" href="db_log_out.php">LOGGA UT XDDDD</a>
    </div>
  </div>
  </nav>
    

</nav>
<script type="text/javascript">
  
  $(".user i").click(function(){

    $(".drop").fadeToggle(100);

  });

</script>
