
<?php

    class Database{
        public static $host = "localhost";
        public static $dbname = "exam";
        public static $username = "root";
        public static $password = "";

        public static function connect(){
            $pdo  = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.'', ''.self::$username.'', ''.self::$password.'');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        public static function query($query, $params = array()){
            try{
                $statement = self::connect()->prepare($query);
                $statement->execute($params);
                $pieces = explode(' ', $query);
                if($pieces[0] == 'SELECT'){
                    $data = $statement->fetchAll();
                    return $data;
                }
            }catch(Exception $e){
                return 'Caught exception: '.  $e->getMessage(). "\n";
            }
        }
    }
?>