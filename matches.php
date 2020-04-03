<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");
session_start();
$id = $_SESSION['user_id'];
$dataUser = User::getAllInformation($id);
var_dump($dataUser);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($dataUser['location']) || is_null($dataUser['music']) || is_null($dataUser['travel']) || is_null($dataUser['specialization']) || is_null($dataUser['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $message = "You cannot have matches if your profile is not completed.";
}

// data andere users ophalen
$arrayUsers = User::getAllUsers($id);
// andere users vergelijken met jezelf
var_dump(User::findMatches($arrayUsers, $dataUser));
// goede match? => weergeven

// weergeven waarom goede match ("jullie vinden beiden ... leuk") 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buddy App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <?php if (isset($message)) : ?>
        <div class="alert-danger">
            <p><?php echo $message ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>
</body>

</html>