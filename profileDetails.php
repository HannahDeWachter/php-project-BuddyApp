<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
session_start();
$id = $_SESSION['user_id'];
$dataUser = User::getAllInformation($id);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <a href="profile.php">Go back to profile</a>
    <?php var_dump($dataUser); ?>
    <div class="container wrap form-group input-group-text">

        <form action="" method="post">
            <h2 class="form__title">Complete your profile, <?php echo $dataUser['firstname']; ?></h2>
            <div class="form-group">
                <label for="location">In what city do you live?</label><br>
                <input type="text" class="form-control" name="location" id="location" placeholder="City" value="<?php echo $dataUser['location']; ?>">
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
            <div class="form-group ">
                <label for="music" class="">Which music do you like?</label><br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="pop">Pop
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="rock">Rock
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="disco">Disco
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="rap">Rap
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="techno">Techno
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="dnb">DnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="indie">Indie
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="jazz">Jazz
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="rnb">RnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="other">Other
            </div>
            <div class="form-group">
                <label for="hobbies">What do you like to do?</label><br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="paint">Paint
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="sport">Sport
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="party">Party
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="instrument">Play an instrument
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="read">Read books
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="other">Other
            </div>
            <div class="form-group">
                <label for="travel">Where have you travelled?</label><br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="africa">Africa
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="america">America
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="asia">Asia
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" checked value="europe">Europe
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="oceania">Oceania
            </div>
            <div class="form btn">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>
</body>

</html>