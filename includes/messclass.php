<?php
require_once(LIB_PATH.DS."database.php");
/**
     * Class containing all the messages attributes to store in a table. This class is invoked anytime user wants to send a new message
     *
     * @param  
     * @return All rows from table are returned
     */
class Message extends DatabaseObject {
   	protected static $table_name = "wb_messages";/*!<Name of table storing message data in database*/
    protected static $db_fields = array('id','user','reciever','message');/*!< An array keeping track of all member variables of messclass*/
    public $id;/*!< A 11-bit INT variable keeping track of message ID*/
    public $user;/*!< A 11-bit INT variable keeping track of which user sent the ID*/
    public $reciever;/*!< A 11-bit INT variable keeping track of who receives the message*/
    public $message;/*!< A blob keeping track of message content*/




}
?>
