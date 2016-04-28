<?php

class Session {

    private $logged_in=false;
    public $user_id;
    public $user_name;
    public $user_lastname;
    public $message;

    function __construct(){
        session_start();
        $this->check_message();
        $this->check_login();
        if($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }

    public function is_logged_in(){
        return $this->logged_in;
    }

    public function login($user){
        if($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->first_name;
            $_SESSION['user_lastname'] = $user->$last_name;
            $this->user_id = $user->id;
            $this->user_name = $user->first_name;

            $this->logged_in = true;
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset(  $_SESSION['user_lastname']);
        unset($this->user_id);
        unset($this->user_name);
        $this->logged_in = false;
    }

    public function is_super_login(){
        return ($this->logged_in && $_SESSION['user_id'] = 1)? true : false;
    }

    public function message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->user_name = $_SESSION['user_name'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            unset($this->user_name);
            $this->logged_in = false;
        }
    }

    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}

$session = new Session();
$message = $session->message();
?>
