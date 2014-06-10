<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/cover.css" rel="stylesheet">

  </head>
  <body>
<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="Etusivu.php">Pokemon Tietokanta</a>
        </div>
        <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">         
                <?php if (isUserLogged() == 2) : ?>
                      <li><a href="../html-demo/AdminPage.php" id="signin">Admin</a></li>
                      <li><a href="../html-demo/Search.php" id="haku">Selaa Pokemoneja</a></li>
                      <li><a href="../html-demo/logOut.php" class="btn inverse">Kirjaudu ulos</a></li>
                <?php elseif (isUserLogged() == 1) : ?>
                      <li><a href="../html-demo/MyPage.php" id="omasivu">Oma Sivu</a></li>
                      <li><a href="../html-demo/Search.php" id="haku">Selaa Pokemoneja</a></li>
                      <li><a href="../html-demo/logOut.php" class="btn inverse">Kirjaudu ulos</a></li>
                <?php else : ?>
                      <li><a href="../html-demo/SignIn.php" id="signin">Kirjaudu</a></li>
                      <li><a href="../html-demo/Search.php" id="haku">Selaa Pokemoneja</a></li>
                <?php endif; ?>
               </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <?php 
        require '../libs/Views/'.$sivu; 
    ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    </body>
   
</html>
