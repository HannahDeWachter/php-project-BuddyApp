<?php
  
include_once(__DIR__."/classes/User.php");
include_once(__DIR__."/includes/header.inc.php");
session_start();
$id = $_SESSION['user_id'];

var_dump($id);
$userProfile = new User();
$otherUser = $userProfile->getUser($id);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
<?php  include_once(__DIR__ . "/includes/header.inc.php"); ?>
<a href="editProfile.php" id="backto"> Edit profile </a>
<div class="profileContainer">
            <form method="post">
                <div>
                    <div class="col-md-4">
                        <div class="profile-img">
                            <!-- hier moet foto komen !-->
                            <?php echo htmlspecialchars($otherUser['profileImg']); ?>
    
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                      <?php echo htmlspecialchars($otherUser['firstname']) . " " . htmlspecialchars($otherUser['lastname'] ); //hier komt de firstname en lastname   ?>  !
                                    </h5>
                                    <h6 >
                                       <!-- print design or development hier !--> 
                                       <?php echo htmlspecialchars($otherUser['specialization']); ?>
                                    </h6>
                                    <h6> <?php echo htmlspecialchars($otherUser['imdYear']); ?>Hier komt de imdyear wat je hebt ingevuld buddy of buddyzoek</h6>
                                    <p> bio komt hier </p>
                           
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <h3>Hobbies</h3>
                                <p> <?php echo htmlspecialchars($otherUser['hobbies']); ?> </p>
                            <h3>Music</h3>
                                <p> <?php echo htmlspecialchars($otherUser['music']); ?> </p>
                            <h3>Travel</h3>
                                <p><?php echo htmlspecialchars($otherUser['travel']); ?> </p>
                            
                        </div>
                    </div>
                   
                            </div>
                            
            </form>           
        </div>
    
</body>
</html>