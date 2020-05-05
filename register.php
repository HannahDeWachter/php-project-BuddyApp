<?php

//Connectie klasses
include_once(__DIR__ . "/classes/User.php");

if (!empty($_POST)) {
    try {
        $user = new User();
        if ($user->availableEmail($_POST['email'])) {
            if ($user->endsWith($_POST['email'], "@student.thomasmore.be")) {
                // $error = "klopt!";
            } else {
                $error = "email has to end with @student.thomasmore.be";
            }
        } else {
            $error = "email is already in use";
        }

        if (!isset($error)) {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setPassword($_POST['password']);
            $user->setImdYear($_POST['imdYear']);
            $user->save();
        }
    } catch (Throwable $th) {
        $error = $th->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
</head>

<body>
<!--<?php // include_once(__DIR__ . "/includes/header.inc.php"); ?> !-->
<img class="logo1" src="./images/buddy-logo.svg">

    <div class="container">
        <form action="" method="post" class="form">
            <div class="header">
                
                <?php if (isset($error)) : ?>
                    <div class="error" style="color:red;">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <h4 id="create">Create an account</h2>
            </div>

            <div class="form-group">
                <label for="email" class="label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                <div id="emailCheck"></div>
            </div>
            <div class="form-group">
                <label for="firstname"class="label">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Fristname">
            </div>
            <div class="form-group">
                <label for="lastname"class="label">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname">
            </div>
           
            <div class="form-group">
                <label for="password"class="label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="radio" name="imdYear" id="buddyZoek" value="buddyZoek" /> Ik zoek een buddy <br>
                <input type="radio" name="imdYear" id="buddy" value="buddy" /> Ik wil een buddy zijn <br>
                <!-- <input type="radio" name="imdYear" id="3IMD" value="3IMD" /> 3IMD <br> !-->
            </div>
            <input type="submit" class="submit" name="submit" value="Sign me up!">
        </form>
        <div class="link">
            <a href="login.php" >Back to login</a>
        </div>
    </div>

    <script src="./js/app.js"></script>
</body>

</html>