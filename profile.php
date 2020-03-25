<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (empty($location) || empty($music) || empty($travel) || empty($specialization) || empty($hobbies)) {
    // als niet iets ingevuld -> $message = "You have not completed your profile."
    $message = "You have not completed your profile.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <img src="" alt="" id="profilePic">
    <strong id="name"></strong>
    <!-- <php if(isset($message)): ?>
        <div class="alert"><php echo $message ?> Click <a href="">here</a> to complete your profile.</div>
     <php endif; ?> -->
</body>

</html>