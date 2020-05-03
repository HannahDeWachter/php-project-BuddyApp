<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Comment.php");
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

if(isset($_GET["id"])){
$user2_id = ($_GET["id"]);
$user1_id = $id;
$user2 = User::getAllInformation($user2_id);


}






$buddyId = $_GET['id'];
var_dump($id, $buddyId);
$buddyInfo = User::getAllInformation($buddyId);
User::buddy($id, $buddyId);

$allComments = Comment::getAll($buddyId, $id);


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
  
  

  <style>
  html, body{
    height: 100%;
    overflow: hidden;
    padding: 0px;
    margin: 0px;
    
}


  #message{
    border:1px solid black;
    border-radius: 5px;
    width: 96%;
    padding: 5px;
    margin:0px auto;
    margin-top: 2px;
    overflow: auto;
  }

  .post__comments__list{

    list-style: none;
    display: block;
    height: 500px;
    width: 50%;
    overflow: auto;
  }

  #commentText{
    width: 50%;
    height: 10%;
    
  }

  .btnSend{

    /* position: absolute; */
    overflow: auto;
  }
  
  </style>
</head>
<body>

<div class="post__comments">
   

  <ul class="post__comments__list">
  <?php foreach($allComments as $c =>$row): ?>
    <li>
      <div id="message">
        <?php 
        if($row["from_user_id"] == $id){
          $user_name ='<h7>YOU</h7>';
        }else{
          $user_name = '<h7>'. $allInformation["firstname"].'</h7>';
        }    
        echo $user_name;
        ?>
        <br>
        <?php echo $row['chat_message']; ?>
        <br>
        <small><em><?php echo $row['timestamp'];?></em></small>
        <br>
        <small><em><?php echo $row['chat_message_id'];?></em></small>
        <a href="#" id="btnLike" name="btnLike"  data-likeId="<?php echo $row["from_user_id"]; ?>">Like</a>
      </div>
  </li> 
  <?php endforeach; ?> 
  </ul>
  <div class="post__comments__form">
    <input type="text" class="form-control" id="commentText" placeholder="What's on your mind">
    <a href="#" class="btn btn-primary"  class="btnSend" id="btnAddComment" data-buddyId="<?php echo $buddyId; ?>" >Add comment</a>
  </div> 
  </div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/script.js"></script>
<script src="js/like.js"></script>
  <!-- jQuery for Reaction system -->
<script type="text/javascript" src="js/reaction.js"></script>  

<script>


</script>
</body>


</html>
