<?php

include_once(__DIR__ . "/Db.php");


class User
{
    private $email;
    private $firstname;
    private $lastname;
    private $password;
    private $profileImage;
    private $bio;


    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("email cannot be empty");
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        if (empty($firstname)) {
            throw new Exception("Firstname cannot be empty");
        }
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        if (empty($lastname)) {
            throw new Exception("Lastname cannot be empty");
        }
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        if (empty($password)) {
            //secure those passwords
            //$salt = "djghdiguhosifj";
            throw new Exception("password cannot be empty!");
        }

        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]); // niet goed --> md5($password.$salt); //te snel
        $this->password = $password;

        return $this;
    }


     /**
     * Get the value of profileImage
     */ 
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * Set the value of profileImage
     *
     * @return  self
     */ 
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;

        return $this;
    }





    public function save()
    {
        //try {
        //conn
        $conn = Db::getConnection();
        //insert query
        $statement = $conn->prepare("insert into users(firstname,lastname,email,password) values (:firstname, :lastname, :email, :password)");
        $firstname = $this->getFirstName();
        $lastname = $this->getLastName();
        $email = $this->getEmail();
        $password = $this->getPassword();


        $statement->bindParam(":firstname", $firstname);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);

        $result = $statement->execute();
        echo "ik ben hier aan het saven";
        return $result;
        //return result
        // } catch ( Throwable $t ) {
        // print "Error!: " . $t->getMessage() . "<br/>";
        // die();
        //  }

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
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMITS 1");
        $statement->bindparam(":email", $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // echo "emailtje dubbel?";
        if ($result == false) {
            return true;
        } else {
            return false;
        }
    }

    public static function profileImage(){

        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_COLUMN);
        

        $statement = $conn->prepare("SELECT profileImage FROM users WHERE users.id=:id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $profileImage = $statement->fetch(PDO::FETCH_COLUMN);

     

        return $profileImage;
    }  
   

    /**
     * Get the value of bio
     */ 
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */ 
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    public static function bio(){

        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare("SELECT bio FROM users WHERE users.id=:id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $bio = $statement->fetch(PDO::FETCH_COLUMN);

       

        return $bio;
        
    }

    public static function updateBio(){

        $conn = Db::getConnection();

        if(isset($_POST['submit'])){
            $bio = htmlspecialchars($_POST['bio']);

            if(empty($bio)){
                echo '<p>Write something nice</p>';
            } else {
                $statement = $conn -> prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_COLUMN);

                $insert = $conn->prepare("UPDATE users SET bio = :bio WHERE users.id=:id");
                $insert->bindParam(':bio', $bio);
                $insert->bindParam(':id', $id);
                $insert->execute();
            }
            return $insert;
        }
    }

    public static function changeEmail(){

        $conn = Db::getConnection();

        if(isset($_POST['submit'])){
            $newEmail = htmlspecialchars($_POST['newEmail']);
            $password = htmlspecialchars($_POST['password']);

            if(empty($password)){
                echo "You need to fill in your password!";
            } else {
                $statement = $conn->prepare("SELECT id FROM users WHERE email ='".$_SESSION['email']."'");
                $statement->execute();
                $id =$statement->fetch(PDO::FETCH_COLUMN);

                $insert = $conn->prepare("UPDATE users SET email = :email WHERE users.id = '".$_SESSION['id']."'");
                $insert->bindParam(':email', $newEmail);
                $insert->execute();
                header('Location:index.php');
            }
            return $insert;

        }
    }


    public static function changePassword(){
        $conn=Db::getConnection();

        $statement = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $conn->prepare("SELECT password FROM users WHERE users.id = '".$id."'");
        $statement->bindParam(':password', $password);
        $statement->execute();

        if(!empty($_POST)){
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            $confPassword = $_POST['confPassword'];
      
            if(empty($newPassword)|| empty($confPassword)  || $newPassword != $confPassword){
                $error = "All the fields need to be filled in and the 2 passwords need to be the same!";

                if(password_verify($oldPassword, $password)){
                    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT,['cost'=>12]);
    
                    $insert = $conn->prepare("UPDATE users SET password = :password WHERE users.id = '".$id."'");
                    $insert->bindParam(':password', $newPassword);
                    $insert->execute();

                    echo "Your password is updated!";

                } else {
                
                    echo "Your old password is incorrect!";
               
                }            
            }
            return $insert;
        }
    }
}
