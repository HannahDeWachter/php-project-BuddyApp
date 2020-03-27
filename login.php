<?php

include_once(__DIR__."/../php-project-BuddyApp/classes/User.php");

if (!empty($_POST)) {
    //email en password opvragen
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::canLogin($email, $password);
    if ($user) {
        User::doLogin($user);
    } else {
        $error = true;
    }
}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eurben</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../GitHub/php-project-BuddyApp/css/style.css" rel="stylesheet" />
  </head>

  <body>






  
      <div class="container">
        
              <form class="form" method="post" action="">



                <div class="header">
                  <h2>BUDDY APP</h2>

                  <h4>Login</h4>

                </div>
                
                <div class="login-body">

                  <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email...">
                  </div>

                  <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password...">
                  </div>

                </div>


                  <input type="submit" value="Sign in" class="btn btn-primary">
                  <?php if (isset($error)): ?>
                  <div class="form__error">
                    <p>
                      Sorry, we can't log you in with that email address and password. Can you try again?
                    </p>
                  </div>
                  <?php endif; ?>


 


              </form>

              <a href="register.php">Not an account yet? Sign up here!</a>

                  </div>
        </div>

