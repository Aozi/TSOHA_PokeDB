
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <title>Pokemon tietokanta etusivu</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/cover.css" rel="stylesheet">
  </head>

  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
        
          <div class="inner cover">
            <h1 class="cover-heading">Pokemon tietokanta</h1>
            <p class="lead">Etusivu pokemon tietokannalle</p>
             <?php if (!empty($data->dataa)): ?>
                <?php echo $data->dataa ?>
             <?php endif; ?>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

  </body>
</html>
