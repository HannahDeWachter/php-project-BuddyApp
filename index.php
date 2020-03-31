<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");
session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
// var_dump($allInformation);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (($allInformation['location'] === "") || ($allInformation['music'] === "") || ($allInformation['travel'] === "") || ($allInformation['specialization'] === "") || ($allInformation['hobbies'] === "")) {
  // als niet iets ingevuld -> $message = "You have not completed your profile yet."
  $message = "You have not completed your profile yet.";
}

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
    <div class="alert-info">
      <p><?php echo $message ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
    </div>
  <?php endif; ?>

  <div class="form-group "> 
      <h1> Filters </h1>
  </div>
      <div class="form-group">
                <label for="music" class="">Music</label><br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="pop">Pop
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="rock">Rock
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="disco">Disco
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="rap">Rap
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="techno">Techno
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="dnb">DnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="indie">Indie
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="jazz">Jazz
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]" value="rnb">RnB
                <br>
                <input type="checkbox" class="custom-checkbox" id="music" name="music[]"  value="other">Other
            </div>
            <div class="form-group">
                <label for="hobbies">Hobbies</label><br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]"  value="paint">Paint
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]"  value="sport">Sport
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]"  value="party">Party
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="instrument">Play an instrument
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]" value="read">Read books
                <br>
                <input type="checkbox" class="custom-checkbox" id="hobbies" name="hobbies[]"  value="other">Other
            </div>
            <div class="form-group">
                <label for="travel">Travel places</label><br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]"  value="africa">Africa
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="america">America
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="asia">Asia
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]"  checked value="europe">Europe
                <br>
                <input type="checkbox" class="custom-checkbox" id="travel" name="travel[]" value="oceania">Oceania
            </div>
            <div class="form btn">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
</body>

</html>