<?php
    class User extends Database{ 
        public static $id,$name,$age,$created_at,$updated_at;

        function __construct( $account_number,$name,$pin,$balance)
        {
            $timestamp = date("Y-m-d H:i:s");
            $params = [$account_number,$name,$pin,$balance,$timestamp,null];
            self::query('INSERT INTO exam_users (id,username,pin,balance,created_at,updated_at) VALUES (?,?,?,?,?,?)',$params);
        }
        public static function test()
        {
            return self::query('SELECT * FROM users');
        }
        public static function find($id)
        {
            $params = [$id];
            return self::query('SELECT * FROM exam_users WHERE id=?',$params);
        }
    }