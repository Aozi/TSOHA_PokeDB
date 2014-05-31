<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Signin.css" rel="stylesheet">
  </head>

  <body>
      
    <div class="container">

        <form action="../html-demo/SignIn.php" method="POST" class="form-Signin" role="form">
        <h2 class="form-Signin-heading">Please sign in</h2>
        <input type="username" class="form-control" placeholder="Username" required autofocus name="username" value="<?php echo $data->kayttaja; ?>">
        <input type="password" class="form-control" placeholder="Password" required name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class= "btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; ?>
      </form>

    </div>
  </body>
</html>