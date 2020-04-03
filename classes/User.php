<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $imdYear;

    private $location;
    private $music;
    private $hobbies;
    private $specialization;
    private $travel;


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("email cannot be empty");
        }

        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        if (empty($password)) {
            //secure those passwords
            throw new Exception("password cannot be empty!");
        }

        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
        $this->password = $password;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($firstname)
    {
        if (empty($firstname)) {
            throw new Exception("Firstname cannot be empty");
        }
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function setLastname($lastname)
    {
        if (empty($lastname)) {
            throw new Exception("Lastname cannot be empty");
        }
        $this->lastname = $lastname;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getMusic()
    {
        return $this->music;
    }
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    public function getHobbies()
    {
        return $this->hobbies;
    }
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getSpecialization()
    {
        return $this->specialization;
    }
    public function setSpecialization($specialization)
    {
        $this->specialization = $specialization;

        return $this;
    }

    public function getTravel()
    {
        return $this->travel;
    }
    public function setTravel($travel)
    {
        $this->travel = $travel;

        return $this;
    }

    public function getImdYear()
    {
        return $this->imdYear;
    }
    public function setImdYear($imdYear)
    {
        $this->imdYear = $imdYear;

        return $this;
    }

    public function updateUser()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET `location` = :abc, music = :music, hobbies = :hobbies, specialization = :specialization,  travel = :travel where id = :userid");

        $userid = $this->getId();
        $location = $this->getLocation();
        $music = $this->getMusic();
        $hobbies = $this->getHobbies();
        $specialization = $this->getSpecialization();
        $travel = $this->getTravel();

        $statement->bindParam(":userid", $userid);
        $statement->bindParam(":abc", $location);
        $statement->bindParam(":music", $music);
        $statement->bindParam(":hobbies", $hobbies);
        $statement->bindParam(":specialization", $specialization);
        $statement->bindParam(":travel", $travel);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function save()
    {
        //conn
        $conn = Db::getConnection();
        //insert query
        $statement = $conn->prepare("insert into users(firstname,lastname,email,password,imdYear) values (:firstname, :lastname, :email, :password, :imdYear)");
        $firstname = $this->getFirstName();
        $lastname = $this->getLastName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $imdYear = $this->getImdYear();

        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":imdYear", $imdYear);

        $result = $statement->execute();
        header('location: login.php');
        // echo "ik ben hier aan het saven";
        // var_dump($result);
        return $result;
    }

    public function endsWith($email, $endString)
    {
        $len = strlen($endString);
        return (substr($email, -$len, $len));
        // echo "emailtje";
    }
    public function availableEmail($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email ");
        $statement->bindParam(":email", $email);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC); //fetchAll geeft array, fetch geeft true/false
        return empty($result); //is hetzelfde als if else hieronder
        /*if (empty($result)) {
            // echo "gestuurd";
            return true;
        } else {
            // echo "niet gestuurd";
            return false;
        }*/
    }
    public static function getAllInformation($id)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
        // $id = $this->getId();

        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    public static function canLogin($email, $password)
    {
        //db connectie
        $conn = Db::getConnection();

        //email zoeken in db
        $statement = $conn->prepare('select * from users where email = :email');
        $statement->bindParam(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //passwoorden komen overeen?
        if (password_verify($password, $user['password'])) {
            //ja -> naar index
            //echo "joepie de poepie!!!!";
            return $user;
        } else {
            //nee -> error
            //echo "jammer joh";
            return false;
        }
    }

    public static function doLogin($user)
    {
        session_start();
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        // var_dump($user);
        header('location: matches.php');
    }

    public static function getAllUsers($id)
    {
        // als je id meegeeft (via session of gewoon) dan krijg je alle user behalve die id terug, als je als parameter null meegeeft dan krijg je alle user incl. jezelf
        $conn = Db::getConnection();
        $statement = $conn->prepare('select * from users where (id != :id or :id is null)');
        $statement->bindParam(":id", $id);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        var_dump($users);
        return $users;
    }
    public static function findMatches($arrayUsers, $dataUser)
    {
        define("locationScore", 20);
        define("musicScore", 10);
        define("hobbiesScore", 15);
        define("travelScore", 25);
        $scoreUsers = [];
        $matchingReason = [];
        $dataUserMusicArray = (explode(",", $dataUser['music']));
        $dataUserHobbiesArray = (explode(",", $dataUser['hobbies']));
        $dataUserTravelArray = (explode(",", $dataUser['travel']));
        // var_dump($dataUserHobbiesArray);
        for ($x = 0; $x < count($arrayUsers); $x++) {
            // niet op specialization matchen!
            $score = 0;
            $matchingString = "";
            $arrayUsersMusicArray = (explode(",", $arrayUsers[$x]['music']));
            $arrayUsersHobbiesArray = (explode(",", $arrayUsers[$x]['hobbies']));
            $arrayUsersTravelArray = (explode(",", $arrayUsers[$x]['travel']));

            if ($arrayUsers[$x]['location'] === $dataUser['location']) { // null = null
                $score += locationScore;
                $matchingString = $matchingString . " Location: " . $dataUser['location'] . ",";
                // TODO: rekening houden met null values matchen?
            }
            // echo $score;
            for ($mx = 0; $mx < count($arrayUsersMusicArray); $mx++) {
                if ($arrayUsersMusicArray[$mx] != '' && in_array($arrayUsersMusicArray[$mx], $dataUserMusicArray)) {
                    $score += musicScore;
                    $matchingString = $matchingString . " Music: " . $arrayUsersMusicArray[$mx] . ",";
                }
            }
            // echo $score;
            for ($hx = 0; $hx < count($arrayUsersHobbiesArray); $hx++) {
                if ($arrayUsersHobbiesArray[$hx] != '' && in_array($arrayUsersHobbiesArray[$hx], $dataUserHobbiesArray)) {
                    $score += hobbiesScore;
                }
            }
            // echo $score;
            for ($tx = 0; $tx < count($arrayUsersTravelArray); $tx++) {
                if ($arrayUsersTravelArray[$tx] != '' && in_array($arrayUsersTravelArray[$tx], $dataUserTravelArray)) {
                    $score += travelScore;
                }
            }
            // echo $score;
            echo $matchingString;
            $scoreUsers[$arrayUsers[$x]['id']] = $score;
        }
        arsort($scoreUsers); // van hoog naar laag (score) sorteren
        return $scoreUsers;
    }
}
