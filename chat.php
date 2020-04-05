<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");

session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
//var_dump($allInformation);


// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $message = "You cannot have matches if your profile is not completed.";
}

// data andere users ophalen
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

if(isset($_GET['id'])){
  $user2 = $_GET['id'];
  $user1 = $id;
  $infoUser2 = User::getAllInformation($showedMatches[$user2]["id"]);
  
}else{

die("an ID is missing 😕");

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
  <link rel="stylesheet" href="css/styleChat.css">
  


</head>

<body>
  <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>
  <!-- <strong>?php echo $showedMatches[$user2]["name"];?></strong>
  <p>?php echo $showedMatches[$user2]["location"]; ?></p>
  <p>?php echo $showedMatches[$user2]["interests"]; ?></p>
  <p>?php echo $showedMatches[$user2]["travel"]; ?></p> -->

  <div id="containerChat">
    <div id="menuChat">
      <?php echo $allInformation["firstname"]." ".$allInformation["lastname"]; ?>
    </div>
    <div id="left-col">
      <div id="container-left-col">
        <div class="grey-back">
            <img src="images/<?php echo $infoUser2["profileImg"] ?>" class="chatImage" alt="profileImage"/>
            <p><?php echo $showedMatches[$user2]["name"]; ?></p>
        </div>
      </div>
    </div>
    <div id="right-col">
      <div id="container-right-col">
        <div id="container-message">
          <div class="grey-message">
            <a href="#"><?php echo $allInformation["firstname"];?></a>
            <p>this message is grey</p>
          </div>
          <div class="white-message">
            <a href="#"><?php echo $showedMatches[$user2]["name"]; ?></a>
            <p>this message is white</p>
          </div>
        </div>
        <textarea class="textarea"  placeholder="Write your message here"></textarea>
      </div>
    </div>
  </div>

</body>

</html>