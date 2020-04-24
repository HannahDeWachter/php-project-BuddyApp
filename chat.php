<?php

include_once(__DIR__ . "/classes/User.php");

session_start();
$id = $_SESSION['user_id'];
$user1 = User::getAllInformation($id);
//var_dump($user1);

// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($user1['location']) || is_null($user1['music']) || is_null($user1['travel']) || is_null($user1['specialization']) || is_null($user1['hobbies'])) {
  // als niet iets ingevuld -> $message = "You have not completed your profile yet."
  $message = "You cannot have chats if your profile is not completed.";
}

$user2 = NULL;
if (isset($_GET["id"])) {
  $user2_id = ($_GET["id"]);
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

  <div id="new-message">
    <p class="m-header">new message</p>
    <p class="m-body">
      <form method="post" id="form-message">
        <input type="text" list="" onkeyup="check_in_db()" name="user_name" id="user_name" class="message-input" placeholder="user_name"><br><br>
        <datalist id="user"></datalist>
        <br><br>
        <textarea class="message-input" placeholder="write your message"></textarea>
        <input type="submit" value="send" name="send">
        <button onclick="document.getElementById('new-message').style.display='none'">cancel</button>
      </form>
    </p>
    <p class="m-footer">click send</p>
  </div>

  <div id="containerChat">
    <div id="menuChat">
      <?php echo $user1["firstname"] . " " . $user1["lastname"]; ?>
    </div>
    <div id="left-col">
      <div id="container-left-col">
        <div class="white-back" onclick="document.getElementById('new-message').style.display='block'">
          <p align="center">new message</p>
        </div>
        <div class="grey-back">
          <img src="images/<?php echo $user2["profileImg"] ?>" class="chatImage" alt="profileImage" />
          <strong><?php echo $user2["firstname"] . " " . $user2["lastname"]; ?></strong>
          <?php //if(status === "chat"): 
          ?>
          <form action="" method="POST">
            <input type="submit" class="btn btn-primary" name="request" value="Send buddy request">
          </form>
          <?php //endif; 
          ?>
          <!-- <br>
            <br>
            <br> -->
          <!-- <strong>Common intressests</strong> -->
          <!-- <p>?php echo $showedMatches[$user2]["location"]; ?></p>
            <p>?php echo $showedMatches[$user2]["interests"]; ?></p>
            <p>?php echo $showedMatches[$user2]["travel"]; ?></p> -->
        </div>
      </div>
    </div>
    <div id="right-col">
      <div id="container-right-col">
        <div id="container-message">
          <div class="grey-message">
            <a href="#"><?php echo $user1["firstname"]; ?></a>
            <p>this message is grey</p>
          </div>
          <div class="white-message">
            <a href="#"><?php echo $user2["firstname"]; ?></a>
            <p>this message is white</p>
          </div>
        </div>
        <form method="post" id="message-form">
          <textarea class="textarea" name="message_text" id="message_text" placeholder="Write your message here"></textarea>
          <button id="send-message" name="send-message" class="btn btn-primary" type="submit">Send</button>
        </form>
      </div>
    </div>
  </div>
  <script src="jquery-3.4.1.min.js"></script>
  <script>



  </script>
</body>

</html>