<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
session_start();

$user = new User();
$id = 1;
$user->setId($id); // session -> $_SESSION['id'];
$allInformation = $user->getAllInformation();
// var_dump($allInformation);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (($allInformation[$id - 1]['location'] === "") || ($allInformation[$id - 1]['music'] === "") || ($allInformation[$id - 1]['travel'] === "") || ($allInformation[$id - 1]['specialization'] === "") || ($allInformation[$id - 1]['hobbies'] === "")) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $message = "You have not completed your profile yet.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <img src="" alt="" id="profilePic">
    <strong id="name"></strong>
    <?php if (isset($message)) : ?>
        <div class="alert-warning">
            <p><?php echo $message ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>
</body>

</html>