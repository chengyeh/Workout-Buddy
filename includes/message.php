<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a message object
 * @pre: none
 * @post: message send, inbox, database access
 * @return: creates a message object
 */
class Message extends DatabaseObject {
   	protected static $table_name = "wb_messages";/*!<Name of table storing message data in database*/
    protected static $db_fields = array('id','user','receiver','message', 'Date','Time','del_receive','del_sent','read_message');/*!< An array keeping track of all member variables of message.php*/
    public $id;/*!< A 11-bit INT variable keeping track of message ID*/
    public $user;/*!< A 11-bit INT variable keeping track of the sender's user_id*/
    public $receiver;/*!< A 11-bit INT variable keeping track of the receiver's user_id*/
    public $message;/*!< A unlimited text field that stores the sender's message*/
    public $Date;/*!< A unlimited text field that stores the date the message was sent*/
    public $Time;/*!< A unlimited text field that stores the time the message was sent*/
    public $del_receive;/*!< A 11-bit INT variable keeping track of the receiver's deletion status*/
    public $del_sent;/*!< A 11-bit INT variable keeping track of the sender's deletion status*/
    public $read_message;/*!< A 11-bit INT variable which serves as a marker if the user read inbox messages*/

}
?>
