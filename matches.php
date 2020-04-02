<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/includes/header.inc.php");
session_start();
$id = $_SESSION['user_id'];
$dataUser = User::getAllInformation($id);
var_dump($dataUser);

// data andere users ophalen
$arrayUsers = User::getAllUsers($id);
// andere users vergelijken met jezelf
User::findMatches($arrayUsers);
// goede match? => weergeven
// weergeven waarom goede match ("jullie vinden beiden ... leuk") 


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

</body>

</html>