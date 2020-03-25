<?php
include_once(__DIR__ . "/Db.php");

class User
{
    protected $id;
    protected $firstname;
    protected $lastname;
    private $email;
    private $password;

    private $location;
    private $music;
    private $hobbies;
    private $specialization;
    private $travel;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function updateUser()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE `users` SET `location`=:location,`music`=:music,`hobbies`=:hobies,`specialization`=:specialization, `travel`=:travel where user_id = :userid");

        $userid = $this->getId();
        $statement->bindParam(":userid", $userid);
        $statement->bindParam(":location", $location);
        $statement->bindParam(":music", $music);
        $statement->bindParam(":hobbiees", $hobbies);
        $statement->bindParam(":specialization", $specialization);
        $statement->bindParam(":travel", $travel);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
