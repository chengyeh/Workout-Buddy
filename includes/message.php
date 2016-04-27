<?php
require_once(LIB_PATH.DS."database.php");

class Message extends DatabaseObject {
   	protected static $table_name = "wb_messages";
    protected static $db_fields = array('id','user','receiver','message', 'Date','Time','del_receive','del_sent','read_message');
    public $id;
    public $user;
    public $receiver;
    public $message;
    public $Date;
    public $Time;
    public $del_receive;
    public $del_sent;
    public $read_message;

}
?>
