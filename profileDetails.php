<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");


if (!empty($_POST)) {
    $location = $_POST['location'];
    $specialization = $_POST['specialization'];

    if (!empty($_POST['travel'])) {
        $travel = $_POST['travel'];
        $travel = implode(',', $travel);
        echo "$travel<br />\n";
    }
    if (!empty($_POST['music'])) {
        $music = $_POST['music'];
        $music = implode(',', $music);
        echo "$music<br />\n";
    }
    if (!empty($_POST['hobbies'])) {
        $hobbies = $_POST['hobbies'];
        $hobbies = implode(',', $hobbies);
        echo "$hobbies<br />\n";
    }

    echo "$specialization<br />\n";
    echo "$location<br />\n";

    // User::updateUser();
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


    <form action="" method="post">
        <label for="location">In what city do you live?</label><br>
        <input type="text" name="location" id="location">
        <br><br>
        <label for="specialization">Design or Development?</label><br>
        <select name="specialization" id="specialization">
            <option <?php if (isset($specialization) && $specialization === "design") {
                        echo "selected";
                    } ?> value="design">Design</option>
            <option <?php if (isset($specialization) && $specialization === "design") {
                        echo "selected";
                    } ?> value="dev">Development</option>
            <option <?php if (isset($specialization) && $specialization === "design") {
                        echo "selected";
                    } ?> value="both">Both</option>
        </select>
        <br><br>
        <label for="music">Which music do you like?</label><br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="pop">Pop
        <br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="rock">Rock
        <br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="rnb">RnB
        <br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="techno">Techno
        <br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="kpop">K-pop
        <br>
        <input type="checkbox" class="checkbox-inline" id="music" name="music[]" value="other">Other
        <br><br>
        <label for="hobbies">What do you like to do?</label><br>
        <input type="checkbox" class="checkbox-inline" id="hobbies" name="hobbies[]" value="sport">Sport
        <br>
        <input type="checkbox" class="checkbox-inline" id="hobbies" name="hobbies[]" value="instrument">Play an instrument
        <br>
        <input type="checkbox" class="checkbox-inline" id="hobbies" name="hobbies[]" value="sing">Sing
        <br>
        <input type="checkbox" class="checkbox-inline" id="hobbies" name="hobbies[]" value="other">Other
        <br><br>
        <label for="travel">Where have you travelled?</label><br>
        <input type="checkbox" class="checkbox-inline" id="travel" name="travel[]" value="africa">Africa
        <br>
        <input type="checkbox" class="checkbox-inline" id="travel" name="travel[]" value="america">America
        <br>
        <input type="checkbox" class="checkbox-inline" id="travel" name="travel[]" value="asia">Asia
        <br>
        <input type="checkbox" class="checkbox-inline" id="travel" name="travel[]" value="europe">Europe
        <br>
        <input type="checkbox" class="checkbox-inline" id="travel" name="travel[]" value="oceania">Oceania
        <br><br>
        <input type="submit" value="Save">
    </form>
</body>

</html>

<!-- kenmerken: muziek(genre) met checkbox, locatie, hobby's/interesses (zelfde als muziek), design/dev(radio button)(niet op matchen), travel -->