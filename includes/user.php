<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a user object
 * @pre: Login session or Sign up
 * @post: Database access
 * @return: Creates a user object
 */
class User extends DatabaseObject {

    protected static $table_name="wb_users";/*!<Name of table storing user data in database*/
    protected static $db_fields = array('id','first_name','last_name','hashed_password','email','active','activation_code','registration_date');/*!< An array keeping track of all member variables of user.php*/
    public $id;/*!< A variable keeping track of User ID*/
    public $first_name;/*!< A text field keeping track of user first name*/
    public $last_name;/*!< A text field keeping track of user last name*/
    public $hashed_password;/*!< A hashed code authenticated when password used or created*/
    public $email;/*!< A text field keeping track of user email*/
    public $active;/*!< A variable keeping track of user active status*/
    public $activation_code;/*!< A text field of a code that activates the user*/
    public $registration_date;/*!< A text field that keeps track of the datewhen the user was created*/

	 /**
	 * authenticate($email="", $password="") is used to authenticate the password and email for the user
	 * @pre: email and password
	 * @post: user session
	 * @return: boolean value for activity status
	 */
    public static function authenticate($email="", $password=""){
        global $database;
        $email = $database->escape_value($email);
        $password = sha1($database->escape_value($password));

        $sql  = "SELECT * FROM wb_users ";
        $sql .= "WHERE email = '{$email}' ";
        $sql .= "AND hashed_password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        if(!empty($result_array)){
            $user = array_shift($result_array);

            if($user->is_active()){
                return $user;
            } else {
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function is_active(){
        if($this->active == 1){
            return true;
        }else{
            return false;
        }

    }

	/**
	 * full_name() is used to obtain the first and last name of the user
	 * @pre: user object with a first and last name
	 * @post: none
	 * @return: first and last name in a single string
	 */
    public function full_name()
    {
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . " " . $this->last_name;
        }
        else
        {
            return "";
        }
    }

	/**
	 * display_log() is used to obtain all the log categories that belong to the user
	 * @pre: user object and session
	 * @post: none
	 * @return: Array of all log categories that belong to the user
	 */
	public function display_log()
	{
		global $database;
    	$sql = "SELECT * FROM wb_log_category WHERE user_id=".$this->id;
    	$log_array = $database->query($sql);
    	return $log_array;
	}


	/**
	 * find_groups() is used to obtain all the groups that are created by the user
	 * @pre: user object and session
	 * @post: none
	 * @return: Array of all groups that belong to the user
	 */
    public function find_groups()
    {
    	$sql = "SELECT * FROM wb_group WHERE group_owner=".$this->id. " ORDER BY group_name ASC, group_status DESC";
    	$groups_object_array = Group::find_by_sql($sql);
    	return $groups_object_array;
    }

	/**
	 * groups_joined() is used to obtain all the groups that the user joined
	 * @pre: user object and session
	 * @post: none
	 * @return: Array of all groups that the user is in but in which the user is not the owner of
	 */
	public function groups_joined(){
    	$sql = "SELECT * FROM wb_group_members WHERE member_id=".$this->id;
    	$group_members_object_array = GroupMember::find_by_sql($sql);
    	return $group_members_object_array;
    }

	/**
	 * get_messages() is used to obtain all the messages sent and are not deleted to the user
	 * @pre: user object and session, message object that was created by user
	 * @post: none
	 * @return: Array of all messages that the user sent but did not delete
	 */
      public function get_messages()
      {
    	global $database;
    	$a=0;
    	$sql = "SELECT * FROM wb_messages WHERE user=".$this->id." AND del_sent=".$a;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

	/**
	 * receive_messages() is used to obtain all the messages received by the user but were not deleted by the user
	 * @pre: user object and session, message object that was created by a sender to the user
	 * @post: none
	 * @return: Array of all messages that the user received but did not delete
	 */
      public function receive_messages()
      {
    	global $database;
    	$a=0;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$this->id." AND del_receive=".$a;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

	/**
	 * exercise_routines_added() is used to obtain all routines that belong to the user
	 * @pre: user object and session
	 * @post: none
	 * @return: Array of all routines that belong to the user
	 */
    public function exercise_routines_added()
    {
    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

	/**
	 * find_last_routine() is a tool used to obtain the last routine that belongs to the user in order to create another routine
	 * @pre: user object and session, previous routines queried that belong to the user
	 * @post: none
	 * @return: Array of all routines that belong to the user
	 */
    public function find_last_routine()
    {
    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

	/**
	 * find_all_exercises($a,$b) is used to obtain all exercises that belong to the user
	 * @pre: user object and session, routine object, exercise object, and exercise set object
	 * @post: none
	 * @return: Array of all exercises that belong to the user
	 */
    public function find_all_exercises($a,$b)
    {
    	$sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$a." AND routine_id=".$b;
    	$exercise_array = Exercises::find_by_sql($sql);
    	return $exercise_array;
    }

	/**
	 * find_last_exercise($a) is a tool to obtain the last exercise that belong to the user
	 * @pre: user object and session, routine object, exercise object, and exercise set object
	 * @post: none
	 * @return: Array of all exercises that belong to the user
	 */
    public function find_last_exercise($a)
    {
    	$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$a;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

		/**
	 * find_type($a) is a used to obtain name of a type
	 * @pre: user object and session
	 * @post: none
	 * @return: name of type
	 */
	 	public function find_type($a)
	   {
	   		global $database;
	    	$sql = "SELECT name FROM wb_exercise_type WHERE id=".$a;
	    	$name_type = $database->query($sql);
	    	return $name_type;
	    }

}

?>
