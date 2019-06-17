<?php
    namespace http;
    use Database;
    use User;
    class PagesController extends Database{
        public static $data = null;
        public static function CreateView($viewName,$data = null){
            self::$data = $data;
            require_once("../resources/views/$viewName.php");
        }

        public static function signup(){
            $username = $_POST['username'];
            $id = $_POST['id'];
            $pin = password_hash($_POST['pin'],PASSWORD_DEFAULT);
            $balance = 0.00;
            $user = new User($id,$username,$pin,$balance);
        }
        public static function login(){
            $id = $_POST['id'];
            $pin = strval($_POST['pin']);
            $user = User::find($id);
            if($user != null){
                $user1 =$user[0];
                $user_pin = $user1[2];
                if (password_verify($pin, $user_pin)) {
                    setcookie('userid', $id, time() + (86400 * 30), "/"); // 86400 = 1 day
                    echo $id;
                }else{
                    echo null;
                }
            }else{
                echo null;
            }
        }
        public static function logout(){
            setcookie('userid', null, -1, '/');
            echo 'Logged Out Successfully';
        }
        public static function getUserInfo(){
            $user = User::find($_COOKIE['userid']);
            $user1 =$user[0];
            echo json_encode($user1);
        }
        public static function userWithdraw(){
            $id = $_POST['id'];
            $amount = $_POST['input_amount'];
            $user = User::find($id);
            $user1 =$user[0];
            $cur_balance = $user1[3];
            $total_balance = $cur_balance - $amount;
            $params = [$total_balance,$id];
            self::query('UPDATE exam_users SET balance = ? WHERE id=?',$params);
        }
        public static function userDeposit(){
            $id = $_POST['id'];
            $amount = $_POST['input_amount'];
            $user = User::find($id);
            $user1 =$user[0];
            $cur_balance = $user1[3];
            $total_balance = $cur_balance + $amount;
            $params = [$total_balance,$id];
            self::query('UPDATE exam_users SET balance = ? WHERE id=?',$params);
        }
    }
?>