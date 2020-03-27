<?php

//Connectie klasses
include_once(__DIR__ . "/classes/User.php");

if (!empty($_POST)) {
    try {
        $user = new User();
        if ($user->availableEmail($user->getEmail())) {
            if ($user->endsWith($_POST['email'], "@student.thomasmore.be") === "@student.thomasmore.be") {
                // $error = "klopt!";
            } else {
                $error = "email has to end with @student.thomasmore.be";
            }
        } else {
            $error = "email is already in use";
        }

        if (!isset($error)) {
            $user = new User();
            $user->setEmail(htmlspecialchars($_POST['email']));
            $user->setFirstName(htmlspecialchars($_POST['firstname']));
            $user->setLastName(htmlspecialchars($_POST['lastname']));
            $user->setPassword(htmlspecialchars($_POST['password']));
            $user->save();
        }
    } catch (Throwable $th) {
        $error = $th->getMessage();
    }
}



// $success = "User saved!";


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container--login">
        <div class="wrap">

            <div class="form-group">



                <?php if (isset($error)) : ?>
                    <div class="error" style="color:red;">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>


                <form action="" method="post">
                    <h2 form__title>Create an account</h2>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>



                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>



                    <div class="form__btn">
                        <input type="submit" class="btn btn-primary" name="submit" value="Sign me up!">
                    </div>
                </form>
                <div class="link">
                    <p> <a href="login.php"> Back to login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>