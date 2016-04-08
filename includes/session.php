<?php
/**
     * Session object contains all the data necessary to maintain a connection with the database
     *
     */
class Session {
    
    private $logged_in=false; /*!< Variable referencing if user is logged in or otherwise*/
    public $user_id;/*!< Variable keeping track of the user's id*/
    public $user_name;/*!< A variable referencing user_name of logged in user*/
    public $message;/*!< Message indicating user login status*/
    /**
     * Constructor for session class
     *
     */
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
    /**
     * Check if a user is logged in
     *
     * @return Return boolean for whether user is logged in or not
     */
    public function is_logged_in(){
        return $this->logged_in;
    }
	/**
     * Logs a user in and establishes connection with database. Set user_id and user_name according to user information.
     *
     * @param User id
     */ 
    public function login($user){
        if($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->first_name;
            
            $this->user_id = $user->id;
            $this->user_name = $user->first_name;
            
            $this->logged_in = true;
        }
    }
     /**
     * Terminate a users session by logging them out. Set logged_in to false and unset user_id and user_name.
     *
     */
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($this->user_id);
        unset($this->user_name);
        $this->logged_in = false;
    }
     /**
     * Check if a super_user is logged in
     *
     * @return Return boolean for whether super_user is logged in or not
     */
    public function is_super_login(){
        return ($this->logged_in && $_SESSION['user_id'] = 1)? true : false;
    }
     /**
     * Obtain message of session status
     * @param 	A string
     * @return 	Set message based on session status
     */
    public function message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }
     /**
     * Check if a user is logged in. 
     *
     * @return Return true if user is logged in. Else return false. 
     */
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
     /**
     * Check the message displayed by a session
     *
     */
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