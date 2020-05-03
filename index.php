<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/includes/header.inc.php");
$id = $_SESSION['user_id'];
$allInformation = User::getAllInformation($id);
$allrequest = User::getAllRequest($id);

// var_dump($allInformation);
$user = new User(); //altijd doen als je $user -> functie omdat je nieuwe instantie user van klasse user maakt 
// checken of velden (location, music, travel, specialization, hobbies) allemaal zijn ingevuld
if (is_null($allInformation['location']) || is_null($allInformation['music']) || is_null($allInformation['travel']) || is_null($allInformation['specialization']) || is_null($allInformation['hobbies'])) {
  // als niet iets ingevuld -> $message = "You have not completed your profile yet."
  $messageComplete = "You have not completed your profile yet.";
}

if (!empty($_POST['name'])) {
  $namesearch = htmlspecialchars($_POST['namesearch']);
  $results = $user->searchpeop($namesearch);
}


if (!empty($_POST['filter'])) {
  $music = $_POST['music'];
  $hobbies = $_POST['hobbies'];
  $travel = $_POST['travel'];

  $filters = $user->filter($music, $hobbies, $travel);
}




if(isset($_POST["btnAccept"])){

    echo key($match);
}

if (!empty($_POST['deny_reason'])) {
  $deny_reason = htmlspecialchars($_POST['deny_reason']);
  $reason = $user->setDeny_reason($deny_reason);
  /**
   * Update record where one of the id's is equal to your $_SESSION['id] (if you're logged in), the other is the id of the person sending the request and the reason why you deny the request
   */
  $user->denyreason($_SESSION['user_id'], 1, $deny_reason);
}



if ($allrequest['status'] === "verzoek") {
  $request = true;
  
}
if ($allrequest['status'] === "deny") {
  $request->denyreason();
 
}
if (isset($_POST['accept'])) {

  $status = $user->setAccept('buddies');
   
  $user->accept($_SESSION['user_id'], 1, $status);


  
  /**
   * 1 is the output of the $friend->getId(); or something that needs to come here.
   * Sort of like this
        $user = new User();
        $user->getUserById($_SESSION["id"]);

        $friend = new Friend();
        
        $userProfile = new User();
        $userProfile->getUserById($_GET["id"]);

      Update record where one of the id's is equal to your $_SESSION['id] (if you're logged in), the other is the id of the person sending the request and the status is 
   */
}

/*if(!empty($_POST)){
    $users = new User();
    $user1->setUser1($_POST('user1'));
    $user2->setUser2($_POST('user2'));

    $users->save();
    $success = "User Saved";
}*/

$users = User::buddies();

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
  <div class="container">

    <?php //if(isset($request)) : 
    ?>
    <!-- als een verzoek bestaat => status in matched is verzoek  dus request moet verzoek zijn van db !-->
    <form action="" method="post">
      <p> Je hebt een verzoek ontvangen! </p>
      <div class="form btn">
        <input type="submit" class="btn btn-primary" name="accept" value="accept">
      </div>
      <div class="form btn">
        <input type="submit" class="btn btn-primary" name="deny" value="deny">
      </div>
    </form>
    <?php  //endif;  
    ?>

    <?php if (isset($_POST['deny'])) : ?>
      <!-- als er op de knop deny wordt gedrukt, komt deze input text te voorschijn !-->
      <form action="" method="post">
        <div class="form-group">
          <label for="deny">Reason</label>
          <input type="text" class="form-control" id="deny_reason" name="deny_reason" placeholder="type text">
        </div>
        <div class="form btn">
          <input type="submit" class="btn btn-primary" name="deny_reasonsubmit" value="submit"> <!-- als er gesubmit wordt moet de text in de kolom deny_reason komen !-->
        </div>
      </form>
    <?php endif; ?>

    <?php if (isset($_POST['accept'])) : ?>
        <p>Jullie zijn nu een match!</p>
    <?php endif; ?>


     
    <?php include_once(__DIR__ . "/includes/header.inc.php"); ?>
      
    
    <?php if (isset($messageComplete)) : ?>
      <div class="alert-info">
        <p><?php echo $messageComplete ?> Click<a class="here" href="profileDetails.php">here</a> to complete your profile.</p>
      </div>
    <?php endif; ?>
    <form action="" method="post" class="form">
      <div class="form-group ">
        <h4 id="filter"> Filters </h4>
      </div>
      <div class="form-group">
        <label for="music" class="">Music</label><br>
        <select id="music" name="music">
          <option value=""> -- Select an item -- </option>
          <option value="pop"> Pop </option>
          <option value="rock">Rock</option>
          <option value="disco">Disco</option>
          <option value="rap">Rap</option>
          <option value="techno">Techno</option>
          <option value="dnb">Dnb</option>
          <option value="indie">Indie</option>
          <option value="jazz">Jazz</option>
          <option value="rnb">Rnb</option>
        </select>
      </div>


      <div class="form-group">
        <label for="hobbies" class="">Hobbies</label><br>
        <select id="hobbies" name="hobbies">
          <option value=""> -- Select an item -- </option>
          <option value="paint"> Paint </option>
          <option value="sport">Sport</option>
          <option value="party">Party</option>
          <option value="instrument">Play an instrument</option>
          <option value="read">Read books</option>
        </select>
    </div>
        
      <div class="form-group">
        <label for="travel" class="">Travel</label><br>
        <select id="travel" name="travel">
            <option value=""> -- Select an item -- </option>
            <option value="africa"> Africa </option>
            <option value="america">America</option>
            <option value="asia">Asia</option>
            <option value="europe">Europe</option>
            <option value="oceania">Oceania</option>
          </select> </div> 

          <div>
            <input type="submit" class="submit" name="filter" value="Search">
          </div>
          <br>

    </form>
    <p> <b> Results: </b> </p>
    <?php if (isset($filters)) : ?>
      <?php foreach ($filters as $filter) : ?>
        <div class="card">
          <?php //echo htmlspecialchars($filter['profileimg']), ?> <!-- geen image in db !-->
         <img src="" alt="John" style="width:100%">
        <br>
         <h3><?php echo htmlspecialchars($filter['firstname']) . " " . htmlspecialchars($filter['lastname']);  ?> <!-- resultaat van searchfilter() moet hier komen !--></h3>
         <p class="title"><?php echo htmlspecialchars($filter['specialization']); ?> </p> 
        
          
         <p><a href="profile.php?id=<?php echo $filter['id']; ?>" class="submit">Profile</a></p>
</div>
        <p>
      <?php endforeach; ?>
    <?php endif; ?>
    <hr>
    </hr>
    <!-- dit is de namesearch div !-->
    <h4 id="filternaam"> Filter op naam </h4>
    <br>
    <form action="" method="post" class="form">
      <div id="naamsearch">
        <label for="namesearch" class=""> Search name </label>
        <input type="text" name="namesearch" id="namesearch" placeholder="name">
      </div> <br>
      <div>
        <input type="submit" class="submit" name="name" value="searchname">
      </div>
    </form>
    <br>

  </form>
  <p> <b> Results: </b> </p>
  <?php if (isset($filters)) : ?>
    <?php foreach ($filters as $filter) : ?>
      <p><?php echo $filter['firstname'] . " " . $filter['lastname'];  ?> </p> <!-- resultaat van searchfilter() moet hier komen !-->
    <?php endforeach; ?>
  <?php endif; ?>
  <hr>
  </hr>
  <!-- dit is de namesearch div !-->
  <h1> Filter op naam </h1>
  <br>
  <form action="" method="post">
    <div class="form-group">
      <label for="namesearch" class=""> Search name </label>
      <input type="text" name="namesearch" id="namesearch" placeholder="name">
    </div> <br>
    <div class="form btn">
      <input type="submit" class="btn btn-primary" name="name" value="searchname">
    </div>
  </form>
  <br>

  <p> <b> Results: </b> </p>
  <?php if (isset($results)) : ?>
    <?php foreach ($results as $result) : ?>
      <p><?php echo $result['firstname'] . " " . $result['lastname'];  ?> </p> <!-- resultaat van searchpeop() moet hier komen !-->
    <?php endforeach; ?>
  <?php endif; ?>

  
 
      <!-- href="forumdocument.php?rowid=".$row['ID']." -->


    <p> <b> Results: </b> </p>
    <?php if (isset($results)) : ?>
      <?php foreach ($results as $result) : ?>
        <div class="card">
         <img src="" alt="John" style="width:100%">
         <?php //echo htmlspecialchars($filter['profileimg']), ?> <!-- geen image in db !-->
        <br>
         <h3><?php echo htmlspecialchars($result['firstname']) . " " . htmlspecialchars($result['lastname']);  ?></h3>
         <p class="title"><?php echo htmlspecialchars($result['specialization']); ?></p>
         
          
         <p><a href="profile.php?id=<?php echo $result['id']; ?>" class="submit">Profile</a></p>
</div>
        
        <!-- profiel moet afgeprint worden dus first last name, image en miss bio + knop bekijk profiel !-->
      <?php endforeach; ?>
    <?php endif; ?>



    <p> <b> Buddies:</b></p>

    <?php foreach ($users as $user) : ?>
      
      <p><?php echo htmlspecialchars($user['user1']) . " and " . htmlspecialchars($user['user2']) . " are now buddies."; ?></p>
    <?php endforeach;  ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>



</html>