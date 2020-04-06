<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
// var_dump($allInformation);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $messageComplete = "You have not completed your profile yet.";
}
if ($allInformation['imdYear'] === "1IMD") {
    $buddymes = "je zoekt een buddy!";
}
if ($allInformation['imdYear'] === "2IMD") {
    $buddymes = "je bent een buddy!";
}
//if ($allInformation['imdYear'] === "3IMD") {
    //$buddymes = "je bent een buddy!";
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <p> <?php echo $buddymes; ?> </p>
    <img src="" alt="" id="profilePic">
    <strong id="name"></strong>
    <?php if (isset($messageComplete)) : ?>
        <div class="alert-info">
            <p><?php echo $messageComplete ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>
</body>

</html>