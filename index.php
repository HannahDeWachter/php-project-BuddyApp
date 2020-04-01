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
                <select id="music"> 
                  <option value="pop"> Pop </option>
                  <option value="rock">Rock</option>
                  <option value="disco">Disco</option>
                  <option value="rap">Rap</option>
                  <option value="techno">Techno</option>
                  <option value="dnb">Dnb</option>
                  <option value="indie">Indie</option>
                  <option value="jazz">Jazz</option>
                  <option value="rnb">Rnb</option>
  </select>
            </div>
            <br>
        <div class="form-group">
                <label for="hobbies"class="">Hobbies</label><br>
                <select id="hobbies"> 
                  <option value="paint"> Paint </option>
                  <option value="sport">Sport</option>
                  <option value="party">Party</option>
                  <option value="instrument">Play an instrument</option>
                  <option value="read">Read books</option>
  </select>
        <div class="form-group">
                <label for="travel"class="">Travel</label><br>
                <select id="travel"> 
                  <option value="africa"> Africa </option>
                  <option value="america">America</option>
                  <option value="asia">Asia</option>
                  <option value="europe">Europe</option>
                  <option value="oceania">Oceania</option>
  </select> <br> <br>
 <div class="form btn">
  <input type="submit" class="btn btn-primary" value="Search">
            </div>
            <br>

<div class="form-group"> 
  <label for="search" class=""> Search name </label>
  <input type="text" name="namesearch" id="namesearch" placeholder="@name"> 
</div> <br>
<div class="form btn">
                <input type="submit" class="btn btn-primary" value="search name">
            </div>
            <br>

</body>

</html>