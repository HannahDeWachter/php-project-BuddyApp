<?php

include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");

class Chat
{

        private $text;
        private $to_user_id;
        private $from_user_id;



        /**
         * Get the value of text
         */
        public function getText()
        {
                return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */
        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }

        /**
         * Get the value of to_user_id
         */
        public function getTo_user_id()
        {
                return $this->to_user_id;
        }

        /**
         * Set the value of to_user_id
         *
         * @return  self
         */
        public function setTo_user_id($to_user_id)
        {
                $this->to_user_id = $to_user_id;

                return $this;
        }

        /**
         * Get the value of from_user_id
         */
        public function getFrom_user_id()
        {
                return $this->from_user_id;
        }

        /**
         * Set the value of from_user_id
         *
         * @return  self
         */
        public function setFrom_user_id($from_user_id)
        {
                $this->from_user_id = $from_user_id;

                return $this;
        }



        public function saveComment()
        {
                $conn = Db::getConnection();

                $statement = $conn->prepare("INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) VALUES (:to_user_id, :from_user_id, :chat_message, :status)");

                $text = $this->getText();
                $to_user_id = $this->getTo_user_id();
                $from_user_id = $this->getFrom_user_id();

                $statement->bindValue(":chat_message", $text);
                $statement->bindValue(":to_user_id", $to_user_id);
                $statement->bindValue(":from_user_id", $from_user_id);
                $statement->bindValue(":status", '1');


                $result = $statement->execute();
                return $result;
        }



        public static function getAll($buddyId, $id)
        {

                $conn = Db::getConnection();
                $statement = $conn->prepare("SELECT * FROM chat_message WHERE to_user_id = $buddyId AND from_user_id = $id OR to_user_id = $id AND from_user_id = $buddyId ORDER BY timestamp ASC");
                $statement->execute();

                $result =  $statement->fetchAll(PDO::FETCH_ASSOC);

                $statement = $conn->prepare("UPDATE chat_message SET status = '0' WHERE to_user_id = $id AND from_user_id = $buddyId AND status = '1' ");
                $statement->execute();
                return $result;
        }

        public static function unseenMessage($id, $buddyId)
        {

                $conn = Db::getConnection();

                $statement = $conn->prepare("SELECT * FROM chat_message WHERE from_user_id = $buddyId AND to_user_id = $id AND status = '1'");
                $statement->execute();
                $count = $statement->rowCount();

                // $output = '';
                // if($count>0){
                //         $output = '<span class="label label-succes">'.$count.'</span>';
                // }

                // return $output;

                return $count;
        }
}
