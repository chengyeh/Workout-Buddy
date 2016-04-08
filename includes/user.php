<?php
require_once(LIB_PATH.DS."database.php");

class User extends DatabaseObject {

    protected static $table_name="wb_users";/*!< Name of the table in the database storing user information*/
    protected static $db_fields = array('id','first_name','last_name','hashed_password','email','active','activation_code','registration_date');/*!< String defining database fields and order to query database*/
    public $id;/*!< A 11-bit int containing a unique user_id*/
    public $first_name;/*!< A 256-bit varchar storing users first name*/
    public $last_name;/*!< A 256-bit varchar storing users last name*/
    public $hashed_password;/*!< A 32-bit hashed password to maintain user confidentiality*/
    public $email;/*!< A 256-bit varchar storing users email address*/
    public $active;/*!< A 256-bit varchar storing users first_name*/
    public $activation_code;/*!< An activation code associated with user and sent to their email*/
    public $registration_date;/*!< A variable keeping track of when user signed up*/
    public $num;

	/**
     * Authenticates user information by comparing email and password to the wb_user table in the database 
     *
     * @param $email
	 * @param $password
     * @return True if parameters match, else false.
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
	/**
     * Checks if user has an active connection to the website. 
     *
     * @return True if user is active, else false.
     */
    public function is_active(){
        if($this->active == 1){
            return true;
        }else{
            return false;
        }

    }
	/**
     * Obtains users full name. The last name and first name are concatenated.
     *
     * @return Full name string. Else empty string.
     */
    public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }
	/**
     * Queries database for all groups that user object is part of and places it into an array. 
     *
     * @return Array containing all groups
     */
    public function find_groups(){
    	$sql = "SELECT * FROM wb_group WHERE group_owner=".$this->id. " ORDER BY group_name ASC, group_status DESC";
    	$groups_object_array = Group::find_by_sql($sql);
    	return $groups_object_array;
    }
	/**
     * Queries database for all members of groups that user owns ad place sthem into an array. 
     *
     * @return Array containing all group members
     */
	public function groups_joined(){
    	$sql = "SELECT * FROM wb_group_members WHERE member_id=".$this->id;
    	$group_members_object_array = GroupMember::find_by_sql($sql);
    	return $group_members_object_array;
    }
	
	/**
     * Queries database for all messages sent to other users and places all instances found into an array
     *
     * @return Array containing all messages
     */
    public function get_messages()
      {
    	global $database;
    	$sql = "SELECT * FROM wb_messages WHERE user=".$this->id;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }
	/**
     * Queries database for all messages recieved from other users and places all instances found into an array
     *
     * @return Array containing all messages
     */
      public function receive_messages()
      {
    	global $database;
    	$sql = "SELECT * FROM wb_messages WHERE reciever=".$this->id;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

}

?>
