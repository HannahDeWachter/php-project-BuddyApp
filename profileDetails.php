<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");

if (isset($_POST)) {
    if (isset($_POST['music'])) {
        $music = implode(',', $_POST['music']);
        echo $music;
    }
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
    <form action="POST">
        <label for="location">Where do you live?</label><br>
        <input type="text" name="location" id="location">
        <br><br>
        <label for="specialization">Design or Development?</label><br>
        <select name="specialization" id="specialization">
            <option value="design">Design</option>
            <option value="dev">Development</option>
        </select>
        <br><br>
        <label for="music">Which music do you like?</label><br>
        <input type="checkbox" class="checkbox-inline" name="music" value="pop">Pop
        <br>
        <input type="checkbox" class="checkbox-inline" name="music" value="rock">Rock
        <br>
        <input type="checkbox" class="checkbox-inline" name="music" value="rnb">RnB
        <br>
        <input type="checkbox" class="checkbox-inline" name="music" value="techno">Techno
        <br>
        <input type="checkbox" class="checkbox-inline" name="music" value="kpop">K-pop
        <br><br>
        <label for="hobbies">What do you like to do?</label><br>
        <input type="checkbox" class="checkbox-inline" name="hobbies" value="sport">Sport
        <br>
        <input type="checkbox" class="checkbox-inline" name="hobbies" value="instrument">Play an instrument
        <br>
        <input type="checkbox" class="checkbox-inline" name="hobbies" value="sing">Sing
        <br><br>
        <label for="travel">Where have you traveled?</label><br>
        <input type="checkbox" class="checkbox-inline" name="travel" value="africa">Africa
        <br>
        <input type="checkbox" class="checkbox-inline" name="travel" value="america">America
        <br>
        <input type="checkbox" class="checkbox-inline" name="travel" value="asia">Asia
        <br>
        <input type="checkbox" class="checkbox-inline" name="travel" value="europe">Europe
        <br>
        <input type="checkbox" class="checkbox-inline" name="travel" value="oceania">Oceania
        <br><br>
        <input type="submit" value="Save">
    </form>
</body>

</html>

<!-- kenmerken: muziek(genre) met checkbox, locatie, hobby's/interesses (zelfde als muziek), design/dev(radio button)(niet op matchen), travel -->