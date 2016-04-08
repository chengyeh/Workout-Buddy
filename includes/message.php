<?php
require_once(LIB_PATH.DS."database.php");

class Message extends DatabaseObject {
   	protected static $table_name = "message_test";
    protected static $db_fields = array('id','user','receiver','message', 'Date','Time','del_receive','del_sent');
    public $id;
    public $user;
    public $receiver;
    public $message;
    public $Date;
    public $Time;
    public $del_receive;
    public $del_sent;
}
?>
