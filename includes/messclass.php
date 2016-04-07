<?php
require_once(LIB_PATH.DS."database.php");

class Message extends DatabaseObject {
   	protected static $table_name = "wb_messages";
    protected static $db_fields = array('id','user','reciever','message');
    public $id;
    public $user;
    public $reciever;
    public $message;




}
?>
