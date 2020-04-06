<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
session_start();
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
//  var_dump($allInformation);


// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $messageComplete = "You have not completed your profile yet.";
}
if ($allInformation['imdYear'] === "1IMD") {
    $buddymes = "je zoekt een buddy!";
}
if ($allInformation['imdYear'] === "2IMD") {
    $buddymes = "je bent een buddy!";
}
//if ($allInformation['imdYear'] === "3IMD") {
    //$buddymes = "je bent een buddy!";
//}



if(isset($_POST["submitProfileImg"])){
    try{     
        $fileImg = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $size = $_FILES["file"]["size"];
        $temp = $_FILES["file"]["tmp_name"];

        $path = "images/".$fileImg;

        $directory = "images/";

        if(empty($fileImg)){
            $error = "Please select an image.";
        }
        else if($type == "image/jpg" || $type == 'image/jpeg' || $type == 'image/png')
        {
            if(!file_exists($path)){

                if($size<5000000){
                    // $newfilename = move_uploaded_file($temp, "images/".$fileImg);

                    unlink($directory.$row['profileImg']);
                    move_uploaded_file($temp, "images/".$fileImg);
                
                } else {
                    $error = "Your file is to large please upload 2MB size.";
                }
            } else {
                $error = "This file already exists.";
            }
        } else {
            $error = "Upload JPG, JPEG, PNG file format please.";
        }
        
        if(!isset($error)){
            
            User::uploadImg($fileImg);           
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}


if(isset($_POST['submitBio'])){

    $text = htmlspecialchars($_POST['text']);

    if(empty($text)){
        $error="The text field needs to be filled in, write something nice😀";
    }else{
        User::uploadBio($text);
    }

}

// User::changePassword();

if(isset($_POST['submitPassword'])){

    $oldPassword = htmlspecialchars($_POST["oldPassword"]);
    $newPassword =htmlspecialchars($_POST["newPassword"]);

    $options = [
        'cost' => 14,
            ];
    $newPassword =  password_hash($newPassword, PASSWORD_DEFAULT, $options);

    if(empty($oldPassword) || empty($newPassword)){
        $error="All fields need to be filled in";
    }
        else if($oldPassword == $newPassword){
            $error="The old and new password need to be different";
        }
            else if(password_verify($oldPassword,$allInformation['password'])){
                User::changePassword($newPassword);
                $error="Your password has been updated 😎";
            } else {
                $error="Old password and current one don't match.";
            }
}


if(isset($_POST["submitEmail"])){

    $oldEmail = htmlspecialchars($_POST["oldEmail"]);
    $newEmail =htmlspecialchars($_POST["newEmail"]);

    if(empty($oldEmail) || empty($newEmail)){
        $error="All fields need to be filled in.";
    } 
        else if($oldEmail == $newEmail) {
        $error="The old and new email need to be different";
        }
            else if($oldEmail == $allInformation['email']){
                $confEmail = new User();
                if($confEmail->availableEmail($_POST['newEmail'])){
                    if($confEmail->endsWith($_POST['newEmail'], "@student.thomasmore.be") === "@student.thomasmore.be") {
                        User::changeEmail($newEmail);
                    } else {
                            $error="Your email needs to end with '@student.thomasmore.be";
                    }
                }else{
                    $error="The new email adress is already in use.";
                }                  

            } else {
                $error ="The old email doesn't match your current one.";
            }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Buddy Profile</title>
</head>

<body>
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>

    <p> <?php echo $buddymes; ?> </p>
    
 <!-- <p> ?php echo $buddymes; ?> </p> -->
    <img src="" alt="" id="profilePic">
    <strong id="name"></strong>
    <?php if (isset($messageComplete)) : ?>
        <div class="alert-info">
            <p><?php echo $messageComplete ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>


    <?php if (isset($error)) : ?>
        <div class="error" style="color:red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

<div class="contianerProfileImg">
<img src="images/<?php echo $fileImg; ?>" height="100px" width="100px">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profilImg">Upload profile image</label>
            <input type="file" class="form-control-file" id="profileImg" name="file" >            
        </div>
        <button type="submit" name="submitProfileImg" class="btn btn-primary">Upload</button>
    </form>
</div>

<div class="containerBio">
    <p></p>
    <form method="POST">    
    <div class="form-group">
        <label for="bio">Write something nice about yourself</label>
        <textarea class="form-control" id="bio" name="text" value="text" rows="3"></textarea>
    </div>
    <button type="submit" name="submitBio" class="btn btn-primary">Upload</button>
    </form>
</div>

<div class="containerChange">
    <form method="POST">
        <div class="form-group">
            <label for="oldPassword">Old password</label>
            <input type="password" class="form-control" name="oldPassword" id="oldPassword">
        </div>
        <div class="form-group">
            <label for="newPassword">New password</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword">
        </div>
        <button type="submit" name="submitPassword" class="btn btn-primary">Submit</button>
    </form>
    <form method="POST">
        <div class="form-group">
            <label for="oldEmail">Old email</label>
            <input type="email" class="form-control" name="oldEmail" id="oldEmail">
        </div>
        <div class="form-group">
            <label for="newEmail">New email</label>
            <input type="email" class="form-control" name="newEmail" id="newEmail">
        </div>
        <button type="submit" name="submitEmail" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>

</html>