<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
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
    public $id;/*!< A variable keeping track of message ID*/
    public $user;/*!< A variable keeping track of the sender's user_id*/
    public $receiver;/*!< A variable keeping track of the receiver's user_id*/
    public $message;/*!< A unlimited text field that stores the sender's message*/
    public $Date;/*!< A unlimited text field that stores the date the message was sent*/
    public $Time;/*!< A unlimited text field that stores the time the message was sent*/
    public $del_receive;/*!< A variable keeping track of the receiver's deletion status*/
    public $del_sent;/*!< A variable keeping track of the sender's deletion status*/
    public $read_message;/*!< A variable which serves as a marker if the user read inbox messages*/

}
?>
