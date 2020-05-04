<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");
$id = $_SESSION['user_id'];
$dataUser = User::getAllInformation($id);
// var_dump($dataUser);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($dataUser['location']) || is_null($dataUser['music']) || is_null($dataUser['travel']) || is_null($dataUser['specialization']) || is_null($dataUser['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $message = "You cannot have matches if your profile is not completed.";
}

// data andere users ophalen
$arrayUsers = User::getAllUsers($id);
// andere users vergelijken met jezelf
$matches = User::findMatches($arrayUsers, $dataUser);
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
//  var_dump($showedMatches);



/*$getnotification = $friend->notificationRequest($id, false);
$checkRequestSender = $friend->senderReq($dataUser->getId(), $matches->getId());
$checkRequestReceiver = $friend->receiverReq($dataUser->getId(), $userProfile->getId());
$getrequestnot = $friend->notificationRequest($dataUser->getId(), false); */

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
        <div class="alert-danger">
            <p><?php echo $message ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>
    <h2>Matches</h2>
    <?php if (!empty($showedMatches)) : ?>
        <?php foreach ($showedMatches as $match) : ?>

            <div class="cardmatch">
                <strong class="title"><?php echo htmlspecialchars($match["name"]); ?></strong>

                <?php if ($match['location'] != "") : ?>
                    <p class="text"><?php echo htmlspecialchars($match["location"]); ?></p>
                <?php endif; ?>
                <?php if ($match['interests'] != "") : ?>
                    <p class="text"><?php echo htmlspecialchars($match["interests"]); ?></p>
                <?php endif; ?>
                <?php if ($match['travel'] != "") : ?>
                    <p class="text"><?php echo htmlspecialchars($match["travel"]); ?></p>
                <?php endif; ?>

                <div class="card-group">
                    <!-- <a href="" class="card-link">Accept</a>
                    <a href="" class="card-link">Decline</a> -->
                    <?php
                    // if ($checkRequestReceiver) {
                    // echo '<button><a href="functions.php?action=ignore_req&id=' . $match->getId() . '">Deny</a></button>&nbsp;
                    // <button><a href="functions.php?action=accept_req&id=' . $match->getId() . '">Accept</a></button>';
                    // } else {
                    // echo '<button><a href="functions.php?action=send_req&id=' . $match->getId() . '">Send Request</a></button>';
                    // } 
                    ?>
                    <a href="chat.php?id=<?php echo htmlspecialchars($match['id']); ?>" class="cardlink">Accept</a>
                    <a href="" class="cardlink">Decline</a>
                </div>
                <form action="" method="POST" class="card-group">
                    <input type="submit" class="submit2" name="request" value="Send buddy request">
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>