<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Comment.php");
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



$arrayUsers = User::getAllUsers($id);
// andere users vergelijken met jezelf
$matches = User::findMatches($arrayUsers, $allInformation);
// var_dump($matches);
// goede match? (score >= 25) => weergeven
$showedMatches = [];
for ($x = 0; $x < count($matches); $x++) {
  $matchInterestsReason = "";
  $matchLocationReason = "";
  $matchTravelReason = "";
  $travelString = "";
  $interestString = "";
  if ($matches[$x]['score'] >= 25) {
      // echo "Match!";
      $matchId = $matches[$x]["id"];
      $key = array_search($matchId, array_column($arrayUsers, 'id'));
      $matchName = $arrayUsers[$key]['firstname'] . " " . $arrayUsers[$key]['lastname'];
      // weergeven waarom goede match ("jullie vinden beiden ... leuk")
      if ($matches[$x]['location'] != "") {
          $matchLocationReason = "You both live in " . $matches[$x]['location'] . ".";
      }
      if ($matches[$x]['interests'] != "") {
          $interestsArray = (explode(",", $matches[$x]['interests']));
          $i = count($interestsArray) - 2; // er staat nog komma achter de laatste waarde dus '' is de laatste waarde in array. Nu is $i gelijk aan de array index
          while ($i >= 0) {
              // echo $i;
              if ($i === count($interestsArray) - 2) {
                  $interestString = $interestsArray[$i] . ".";
              } else {
                  if ($i === count($interestsArray) - 3) {
                      $interestString = $interestsArray[$i] . " and " . $interestString;
                  } else {
                      $interestString = $interestsArray[$i] . ", " . $interestString;
                  }
              }
              $i--;
          }

          $matchInterestsReason = "You both like " . $interestString;
      }
      if ($matches[$x]['travel'] != "") {
          $travelArray = (explode(",", $matches[$x]['travel']));
          // var_dump($travelArray);
          $i = count($travelArray) - 2; // er staat nog komma achter de laatste waarde dus '' is de laatste waarde in array
          while ($i >= 0) {
              // echo $i;
              if ($i === count($travelArray) - 2) {
                  $travelString = $travelArray[$i] . ".";
              } else {
                  if ($i === count($travelArray) - 3) {
                      $travelString = $travelArray[$i] . " and " . $travelString;
                  } else {
                      $travelString = $travelArray[$i] . ", " . $travelString;
                  }
              }
              $i--;
          }
          $matchTravelReason = "You have both travelled in " . $travelString;
      }
      $showedMatches[$x] = array("id" => $matchId, "name" => $matchName, "location" => $matchLocationReason, "interests" => $matchInterestsReason, "travel" => $matchTravelReason);
  } else {
      $x = count($matches); // array is gesorteerd op score, dus als er een kleiner is dan 25 moet de rest niet meer bekeken worden
  }
}
 //var_dump($showedMatches);



if(isset($_POST["btnAccept"])){

    echo key($match);
}

$allBuddys = User::AllBuddys($id);

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

  <table class="table table-bordered table-striped" style=" width: 70%; height: 50px; margin: 0 auto;">
  <tr>
        <th>Username</th>
        <th>Unread</th>
        <th>Action</th>
    </tr>
    <?php foreach($allBuddys as $b => $row): ?>
        <?php $Name = User::getAllInformation($row["user2_id"]);  ?>
        <div class="table">
        <tr>
            <td><?php echo $Name["firstname"]; ?></td>
            <td><?php 
            $output = "";
            $count = Comment::unseenMessage($id, $row["user2_id"]);
            if( $count>0){
                $output = '<span class="label label-succes">'.$count.'</span>';
            }
            echo $output;
            ?></td>
            <td><a href="chat.php?id=<?php echo $row["user2_id"];?>" class="btn btn-primary" name="btnAccept">Chat</a></td>
        </tr>
        </div>
    <?php endforeach; ?>
  </table>
 
  <?php if (!empty($showedMatches)) : ?>
        <?php foreach ($showedMatches as $match => $buddy ) : ?>
            <div class="table">
                <!-- <strong>?php echo $match["name"]; ?></strong>
                <p>?php echo $match["location"]; ?></p>
                <p>?php echo $match["interests"]; ?></p>
                <p>?php echo $match["travel"]; ?></p> -->

                <strong><?php echo $buddy["name"]; ?></strong>
                <p><?php echo $buddy["location"]; ?></p>
                <p><?php echo $buddy["interests"]; ?></p>
                <p><?php echo $buddy["travel"]; ?></p>
            </div>
            <a href="chat.php?id=<?php echo $buddy["id"]; ?>" class="btn btn-primary" name="btnAccept">Accept</a>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- href="forumdocument.php?rowid=".$row['ID']." -->


</body>

</html>