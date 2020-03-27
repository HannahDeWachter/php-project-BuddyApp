<?php
    
    class User{
        private $email;
        private $password;

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
        public function setEmail($email){
                
                if(empty($email)){
                    throw new Exception("email cannot be empty.");
                }
                $this->email = $email;

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
                $this->password = $password;

                return $this;
        }

        
        
        public static function canLogin($email, $password)
        {
            //db connectie
            $conn = new PDO('mysql:host=localhost;dbname=login', "root", "");

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
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            header('location: index.php');
        }

        public static function getUserId()
        {
            $email = $_SESSION['email'];
            $conn = new PDO('mysql:host=localhost;dbname=login', "root", "");
            $statement = $conn->prepare('select id from users where email = :email');
            $statement->bindParam(':email', $email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            return $user['id'];
        }
}





?>


























        
<!---     public function save(){
            //conn
            $conn = new PDO('mysql:host=localhost;dbname=login', "root", "");
            
            $statement = $conn->prepare("insert into users(email, password) values (:email, :password)");

            $email = $this->getEmail();
            $password = $this->getPassword();


            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);

            $result = $statement->execute();

            return $result;

        }

        public function checkLogin(){
                
        }
    }


