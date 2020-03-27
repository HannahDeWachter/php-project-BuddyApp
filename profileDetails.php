<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
session_start();
// $_SESSION['id'] = $id;

if (!empty($_POST)) {
    $user = new User();
    $user->setId($_SESSION['id']);
    $location = $_POST['location'];
    $user->setLocation(htmlspecialchars($location));
    $specialization = $_POST['specialization'];
    $user->setSpecialization($specialization);
    if (!empty($_POST['music'])) {
        $music = $_POST['music'];
        $music = implode(',', $music);
        $user->setMusic($music);
    }
    if (!empty($_POST['hobbies'])) {
        $hobbies = $_POST['hobbies'];
        $hobbies = implode(',', $hobbies);
        $user->setHobbies($hobbies);
    }
    if (!empty($_POST['travel'])) {
        $travel = $_POST['travel'];
        $travel = implode(',', $travel);
        $user->setTravel($travel);
    }

    $details = $user->updateUser();
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

    <a href="profile.php">Go back to profile</a>

    <form action="" method="post">
        <div class="form-group">
            <label for="location">In what city do you live?</label><br>
            <input type="text" class="form-control" name="location" id="location" placeholder="City">
        </div>
        <div class="form-group">
            <label for="specialization">Design or Development?</label><br>
            <select name="specialization" class="form-control" id="specialization">
                <option <?php if (isset($specialization) && $specialization === "design") {
                            echo "selected";
                        } ?> value="design">Design</option>
                <option <?php if (isset($specialization) && $specialization === "dev") {
                            echo "selected";
                        } ?> value="dev">Development</option>
                <option <?php if (isset($specialization) && $specialization === "both") {
                            echo "selected";
                        } ?> value="both">Both</option>
            </select>
        </div>
        <div class="form-group">
            <label for="music">Which music do you like?</label><br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="pop">Pop
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="rock">Rock
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="disco">Disco
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="rap">Rap
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="techno">Techno
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="dnb">DnB
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="indie">Indie
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="jazz">Jazz
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="rnb">RnB
            <br>
            <input type="checkbox" class="form-inline" id="music" name="music[]" value="other">Other
        </div>
        <div class="form-group">
            <label for="hobbies">What do you like to do?</label><br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="paint">Paint
            <br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="sport">Sport
            <br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="party">Party
            <br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="instrument">Play an instrument
            <br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="read">Read books
            <br>
            <input type="checkbox" class="form-inline" id="hobbies" name="hobbies[]" value="other">Other
        </div>
        <div class="form-group">
            <label for="travel">Where have you travelled?</label><br>
            <input type="checkbox" class="form-inline" id="travel" name="travel[]" value="africa">Africa
            <br>
            <input type="checkbox" class="form-inline" id="travel" name="travel[]" value="america">America
            <br>
            <input type="checkbox" class="form-inline" id="travel" name="travel[]" value="asia">Asia
            <br>
            <input type="checkbox" class="form-inline" id="travel" name="travel[]" checked value="europe">Europe
            <br>
            <input type="checkbox" class="form-inline" id="travel" name="travel[]" value="oceania">Oceania
        </div>
        <div class="form btn">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </form>
</body>

</html>