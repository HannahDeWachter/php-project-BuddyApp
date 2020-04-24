<?php
if(isset ($_POST('email'))){
    if ($user->availableEmail($_POST['email'])) {
        if ($user->endsWith($_POST['email'], "@student.thomasmore.be") === "@student.thomasmore.be") {
            // $error = "klopt!";
            $error = "email has to end with @student.thomasmore.be";
            $response=[
                'status' => 'success',
                'body'=> htmlspecialchars($user ->getEmail()),
                'message' => 'Email available',
            ];
        } else {
            $error = "email is already in use";
        $response = [
            'status' => 'fail',
                'body'=> htmlspecialchars($user ->getEmail()),
                'message' => 'Email not available',
        ];
        }
    } else {
        $error = "email is already in use";
        $response = [
            'status' => 'fail',
                'body'=> htmlspecialchars($user ->getEmail()),
                'message' => 'Email not available',
        ];
    }
    header("Content-Type: application/json");
    echo json_encode($response);

}