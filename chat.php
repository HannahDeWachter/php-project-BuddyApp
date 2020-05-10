<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Chat.php");
include_once(__DIR__ . "/includes/header.inc.php");

$id = $_SESSION['user_id'];
$user1 = User::getAllInformation($id);
$allInformation = User::getAllInformation($id);

//var_dump($user1);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($user1['location']) || is_null($user1['music']) || is_null($user1['travel']) || is_null($user1['specialization']) || is_null($user1['hobbies'])) {
  // als niet iets ingevuld -> $message = "You have not completed your profile yet."
  $message = "You cannot have chats if your profile is not completed.";
}

$user2 = NULL;
if (isset($_GET['id'])) {
  $user2_id = ($_GET['id']);
  $user1_id = $id;
  $user2 = User::getAllInformation($user2_id);
}
// var_dump($user2);
if ($user2 === null) {
  echo "buddy not found";
}

if (isset($_POST['request'])) {
  $email = $user2['email'];
  $name = $user2['firstname'];
  User::sendRequestMail($email, $name);
  // echo "email is sent!";
}

$buddyId = $_GET['id'];
// var_dump($id, $buddyId);
$buddyInfo = User::getAllInformation($buddyId);
User::buddy($id, $buddyId);

$allComments = Chat::getAll($buddyId, $id);

$matchedData = User::getMatchedData($user1_id, $user2_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buddy App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styleChat.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

  <style>
    html,
    body {
      height: 100%;
      overflow: hidden;
      padding: 0px;
      margin: 0px;

    }


    #message {
      border: 1px solid black;
      border-radius: 5px;
      width: 96%;
      padding: 5px;
      margin: 0px auto;
      margin-top: 2px;
      overflow: auto;
    }

    .post__comments__list {

      list-style: none;
      display: block;
      height: 500px;
      width: 50%;
      overflow: auto;
    }

    #commentText {
      width: 50%;
      height: 10%;

    }

    .btnSend {
      /* position: absolute; */
      overflow: auto;
    }
  </style>
  </head>

  <body>

    <div class="post__comments">

      <ul class="post__comments__list">
        <?php foreach ($allComments as $c => $row) : ?>
          <li>
            <div id="message">
              <?php
              if ($row["from_user_id"] == $id) {
                $user_name = "YOU";
              } else {
                $user_name =  $allInformation["firstname"];
              }
              echo htmlspecialchars($user_name);
              ?>
              <br>
              <?php echo htmlspecialchars( $row['chat_message']); ?>
              <br>
              <small><em><?php echo  htmlspecialchars( $row['timestamp']); ?></em></small>
              <a href="#" id="btnLike" name="btnLike" data-likeId="<?php echo htmlspecialchars( $row["from_user_id"]); ?>">Like</a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="post__comments__form">
        <input type="text" class="form-control" id="commentText" placeholder="What's on your mind">
        <a href="#" class="btn btn-primary" class="btnSend" id="btnAddComment" data-buddyId="<?php echo $buddyId; ?>">Add comment</a>
      </div>
    </div>
    <script src="jquery-3.4.1.min.js"></script>


    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/like.js"></script>
    <!-- jQuery for Reaction system -->
    <script type="text/javascript" src="js/reaction.js"></script>

    <script>


    </script>
  </body>


</html>