<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Chat.php");
include_once(__DIR__ . "/includes/header.inc.php");
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
// var_dump($allInformation);
$user = new User(); //altijd doen als je $user -> functie omdat je nieuwe instantie user van klasse user maakt 
// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
    // als niet iets ingevuld -> $message = "You have not completed your profile yet."
    $messageComplete = "You have not completed your profile yet.";
}

// data andere users ophalen
$arrayUsers = User::getAllUsers(null);
$numberOfRegisteredUsers = count($arrayUsers);
// echo $numberOfRegisteredUsers;
$numberOfBuddies = User::getAllBuddies();
$allBuddys = User::AllBuddys($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>

<body>

    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>
    <?php if (isset($messageComplete)) : ?>
        <div class="alert-info">
            <p class="homepage"><?php echo $messageComplete ?> Click <a href="profileDetails.php">here</a> to complete your profile.</p>
        </div>
    <?php endif; ?>

    <p class="homepage">There are <?php echo $numberOfRegisteredUsers; ?> students registerd.</p>
    <?php if ($numberOfBuddies === 1) : ?>
        <p class="homepage">There is <?php echo $numberOfBuddies; ?> buddy match.</p>
    <?php else : ?>
        <p class="homepage">There are <?php echo $numberOfBuddies; ?> buddy matches.</p>
    <?php endif; ?>

    <table class="table table-bordered table-striped" style=" width: 70%; height: 50px; margin: 0 auto;">
        <tr>
            <th>Username</th>
            <th>Unread</th>
            <th>Action</th>
        </tr>
        <?php foreach ($allBuddys as $b => $row) : ?>
            <?php $Name = User::getAllInformation($row["user2_id"]);  ?>
            <div class="table">
                <tr>
                    <td><?php echo $Name["firstname"]; ?></td>
                    <td><?php
                        $output = "";
                        $count = Chat::unseenMessage($id, $row["user2_id"]);
                        if ($count > 0) {
                            $output = '<span class="label label-succes">' . $count . '</span>';
                        }
                        echo $output;
                        ?></td>
                    <td><a href="chat.php?id=<?php echo $row["user2_id"]; ?>" class="btn btn-primary" name="btnAccept">Chat</a></td>
                </tr>
            </div>
        <?php endforeach; ?>
    </table>
</body>

</html>