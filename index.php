<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");
session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
// var_dump($allInformation);
$user = new User(); //altijd doen als je $user -> functie omdat je nieuwe instantie user van klasse user maakt 
// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
  // als niet iets ingevuld -> $message = "You have not completed your profile yet."
  $messageComplete = "You have not completed your profile yet.";
}

if (!empty($_POST['name'])) {
  $namesearch = htmlspecialchars($_POST['namesearch']);
  $results = $user->searchpeop($namesearch);
}



if (!empty($_POST['filter'])) {
  $music = $_POST['music'];
  $hobbies = $_POST['hobbies'];
  $travel = $_POST['travel'];
  // $result = User::filter($music, $hobbies, $travel);
  $filters = $user->filter($music, $hobbies, $travel);
}

if(!empty($_POST['denyreason'])){
 // $denyreason = htmlspecialchars($_POST['denyreason']);
  $denyreason->setdenyReason(htmlspecialchars($_POST['denyreason']));
  //$request->deny();

}
if ($allInformation['state'] === "request") {
  $request = true;
}
if ($allInformation['state'] === "deny") {
  $request->deny();
}
if ($allInformation['state'] === "accept") {
  $request->accept();
}




/*if(!empty($_POST)){
    $users = new User();
    $user1->setUser1($_POST('user1'));
    $user2->setUser2($_POST('user2'));

    $users->save();
    $success = "User Saved";



}*/

$users = User::buddies();

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
<?php if(isset($request)) : ?>
  <form action="" method="post">
<p> Je hebt een verzoek ontvangen! </p> 
<div class="form btn">
      <input type="submit" class="btn btn-primary" name="accept" value="accept">
    </div>
<div class="form btn">
      <input type="submit" class="btn btn-primary" name="deny" value="deny">
    </div>
    </form>
<?php  endif;  ?>

   <?php if($_POST['deny']) : ?>
    <div class="form-group">
                <label for="deny">Reason</label>
                <input type="text" class="form-control" id="denyreason" name="denyreason" placeholder="type text">
            </div>
            <div class="form btn">
      <input type="submit" class="btn btn-primary" name="denyreasonsubmit" value="submit">
    </div>
   <?php endif; ?>
  
  <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>
  <?php if (isset($messageComplete)) : ?>
    <div class="alert-info">
      <p><?php echo $messageComplete ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
    </div>
  <?php endif; ?>
  <form action="" method="post">
    <div class="form-group ">
      <h1> Filters </h1>
    </div>
    <div class="form-group">
      <label for="music" class="">Music</label><br>
      <select id="music" name="music">
        <option value=""> -- Select an item -- </option>
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


    <div class="form-group">
      <label for="hobbies" class="">Hobbies</label><br>
      <select id="hobbies" name="hobbies">
        <option value=""> -- Select an item -- </option>
        <option value="paint"> Paint </option>
        <option value="sport">Sport</option>
        <option value="party">Party</option>
        <option value="instrument">Play an instrument</option>
        <option value="read">Read books</option>
      </select>
      <br>
      <br>
      <div class="form-group">
        <label for="travel" class="">Travel</label><br>
        <select id="travel" name="travel">
          <option value=""> -- Select an item -- </option>
          <option value="africa"> Africa </option>
          <option value="america">America</option>
          <option value="asia">Asia</option>
          <option value="europe">Europe</option>
          <option value="oceania">Oceania</option>
        </select> <br> <br>
        <div class="form btn">
          <input type="submit" class="btn btn-primary" name="filter" value="Search">
        </div>
        <br>

  </form>
  <p> <b> Results: </b> </p>
  <?php if (isset($filters)) : ?>
    <?php foreach ($filters as $filter) : ?>
      <p><?php echo $filter['firstname'] . " " . $filter['lastname'];  ?> </p> <!-- resultaat van searchfilter() moet hier komen !-->
    <?php endforeach; ?>
  <?php endif; ?>
  <hr>
  </hr>
  <!-- dit is de namesearch div !-->
  <h1> Filter op naam </h1>
  <br>
  <form action="" method="post">
    <div class="form-group">
      <label for="namesearch" class=""> Search name </label>
      <input type="text" name="namesearch" id="namesearch" placeholder="name">
    </div> <br>
    <div class="form btn">
      <input type="submit" class="btn btn-primary" name="name" value="searchname">
    </div>
  </form>
  <br>

  <p> <b> Results: </b> </p>
  <?php if (isset($results)) : ?>
    <?php foreach ($results as $result) : ?>
      <p><?php echo $result['firstname'] . " " . $result['lastname'];  ?> </p> <!-- resultaat van searchpeop() moet hier komen !-->
    <?php endforeach; ?>
  <?php endif; ?>
  


  <p> <b> Buddies:</b></p>

  <?php foreach ($users as $user) : ?>
    <p><?php echo $user['user1'] . " and " . $user['user2'] . " are now buddies."; ?></p>
  <?php endforeach;  ?>

</body>



</html> 