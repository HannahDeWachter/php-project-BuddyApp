<?php

include_once(__DIR__ . "/classes/User.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();

// connectie met de databank
$conn = Db::getConnection();

if (isset($_FILES['profileImg'])) {

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];


    if ($fileError > 0) {
        switch ($fileError) {
        case 1:
        $msg = 'You can only upload 2MB';
        break;
        default:
        $msg = 'There went something wrong with your upload';
            echo "<button onclick=\"location.href='index.php'\">Try again</button>";
        }
    } else {
        $allowedTypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileinfo = $finfo->file($fileTmpName);

        if (in_array($fileinfo, $allowedTypes)) {
            //move uploaded file
            $fileNewName = 'images/profile_images/'.$fileName;
            //id
            $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $id = $stm->fetch(PDO::FETCH_COLUMN);

            if (move_uploaded_file($fileTmpName, $fileNewName)) {
                $insert = $conn->query("UPDATE users
                SET profileImage = '".$fileNewName."'
                WHERE users.id='".$id."';");

                header('location:profile.php');
            } else {
                $msg = 'Sorry, your upload failed';
            }
        } else {
            $msg = 'Only images are allowed';
        }
    }
}



?>