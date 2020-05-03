<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/includes/header.inc.php");

session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
//var_dump($allInformation);


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
  <?php include_once 'includes/header.inc.php'; ?>

  

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