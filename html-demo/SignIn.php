<!DOCTYPE html>
<html>

  <head>
    <?php 
        include '../resources/Header.php'; 
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Signin.css" rel="stylesheet">
  </head>

  <body>
      
    <div class="container">

      <form class="form-Signin" role="form">
        <h2 class="form-Signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class= "btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>
  </body>
</html>