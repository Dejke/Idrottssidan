<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style type="text/css">

  .user{
    width: 50px;
    height: 50px;
  }
  .user i{
    font-size: 3em;
  }
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

</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
    <div style= "
                    background:url('images/logo.png');
                    width: 90px;
                    height:108px;
                    background-size:cover;
                    margin: -10px 0 -40px 0;
                "
            alt = "Lars Kagg"></div>
    </a>

  <div class="user navbar-nav ml-auto">

    <i class="fas fa-user"></i>

    <div class="drop h4 text-center">

      <span class="">HALLÅs</span><br>
      <a class="" href="db_log_out.php">Logga ut</a>

    </div>

  </div>
  

    <!--
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button">
        Dropdown button
      </button>ko
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>s
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>
    -->
    

</nav>
<script type="text/javascript">
  
  $(".user i").click(function(){

    $(".drop").fadeToggle(100);

  });

</script>
