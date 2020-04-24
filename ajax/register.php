<?php

include('../classes/Db.php');
include('../classes/User.php');

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    $user = new User();
    $user->availableEmail($email);
    $user->setEmail($email);

    if ($user->availableEmail($email)) {
        if ($user->endsWith(htmlspecialchars($_POST['email']), "@student.thomasmore.be")) {
            $response = [
                'status' => 'success',
                'body' => htmlspecialchars($user->getEmail()),
                'message' => 'Email available',
            ];
        } else {
            $response = [
                'status' => 'warning',
                'body' => htmlspecialchars($user->getEmail()),
                'message' => 'Email has to end with @student.thomasmore.be',
            ];
        }
    } else {
        $response = [
            'status' => 'fail',
            'body' => htmlspecialchars($user->getEmail()),
            'message' => 'Not available',
        ];
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
