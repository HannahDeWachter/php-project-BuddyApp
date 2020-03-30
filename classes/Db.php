<?php
class Db
{
    private static $conn;

    public static function getConnection()
    {
        try {
            include_once(__DIR__ . "/../settings/settings.php");

            if (self::$conn != null) {
                echo ('connectie is er');

                /**
                 * ⚠️ Return connection when not empty ⚠️
                 */
                return self::$conn;
            } else {
                echo ('connectie moet aangemaakt worden');
                /**
                 * Create new connection when self::$conn === null ⚠️
                 */
                self::$conn = new PDO('mysql:host=' . SETTINGS['db']['host'] . ';port=' . SETTINGS['db']['port']. ';dbname=' . SETTINGS['db']['dbname'], SETTINGS['db']['user'], SETTINGS['db']['password']);
                return self::$conn;
            }
        } catch (Throwable $t) {
            //echo ('ik zit in de catch');
            echo ($t->getMessage());
        }
    }
}
