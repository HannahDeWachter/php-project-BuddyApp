<?php

    include_once(__DIR__."/../classes/Chat.php");
    include_once(__DIR__."/../classes/User.php");
    session_start();

    if(!empty($_POST)){

        //new comment
        $c = new Chat();
        $c->setText($_POST['text']);
        $c->setTo_user_id($_POST["buddyId"]);
        $c->setFrom_user_id($_SESSION["user_id"]);

        //save()
        $c->saveComment();

        //succes teruggeven
        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);  
    }
?>