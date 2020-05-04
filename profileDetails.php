<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
$id = $_SESSION['user_id'];
$dataUser = User::getAllInformation($id);

$musicArray = (explode(",", $dataUser['music']));
$hobbiesArray = (explode(",", $dataUser['hobbies']));
$travelArray = (explode(",", $dataUser['travel']));

if (!empty($_POST)) {
    $user = new User();
    $user->setId($id);
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
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <a href="profile.php"id="backto">Go back to profile</a>
    

    <div class="container">

        <form action="" method="post" class="form">
            <h4 class="title">Complete your profile, <?php echo htmlspecialchars($dataUser['firstname']); ?></h4>
            <div class="form-group">
                <label for="location">In what city do you live?</label><br>
                <input type="text" class="form-control" name="location" id="location" placeholder="City" value="<?php echo htmlspecialchars($dataUser['location']); ?>">
            </div>
            <div class="form-group">
                <label for="specialization">Design or Development?</label><br>
                <select name="specialization" class="form-control" id="specialization">
                    <option <?php if (isset($dataUser['specialization']) && $dataUser['specialization'] === "design") {
                                echo "selected";
                            } ?> value="design">Design</option>
                    <option <?php if (isset($dataUser['specialization']) && $dataUser['specialization'] === "dev") {
                                echo "selected";
                            } ?> value="dev">Development</option>
                    <option <?php if (isset($dataUser['specialization']) && $dataUser['specialization'] === "both") {
                                echo "selected";
                            } ?> value="both">Both</option>
                </select>
            </div>
            <div class="form-group">
                <label for="music" class="">Which music do you like?</label><br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("pop", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="pop">Pop
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("rock", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="rock">Rock
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("disco", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="disco">Disco
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("rap", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="rap">Rap
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("techno", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="techno">Techno
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("dnb", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="dnb">DnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("indie", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="indie">Indie
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("jazz", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="jazz">Jazz
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("rnb", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="rnb">RnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" <?php if (in_array("other", $musicArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="other">Other
            </div>
            <div class="form-group">
                <label for="hobbies">What do you like to do?</label><br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("paint", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="to paint">Paint
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("sport", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="sport">Sport
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("party", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="to party">Party
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("instrument", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="to play an instrument">Play an instrument
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("read", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="to read">Read books
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" <?php if (in_array("other", $hobbiesArray)) {
                                                                                                    echo "checked";
                                                                                                } ?> value="other">Other
            </div>
            <div class="form-group">
                <label for="travel">Where have you travelled?</label><br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" <?php if (in_array("africa", $travelArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="africa">Africa
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" <?php if (in_array("america", $travelArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="america">America
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" <?php if (in_array("asia", $travelArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="asia">Asia
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" <?php if (in_array("europe", $travelArray)) {
                                                                                                echo "checked";
                                                                                            } ?> checked value="europe">Europe
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" <?php if (in_array("oceania", $travelArray)) {
                                                                                                echo "checked";
                                                                                            } ?> value="oceania">Oceania
            </div>
            <input type="submit" class="submit" value="Save">
        </form>
    </div>
</body>

</html>