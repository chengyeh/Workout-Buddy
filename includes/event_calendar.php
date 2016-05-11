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
/*
*	@file event_calendar.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Helper class the aids to create a Event_Calendar object for
*				for calendar input from the user in form data.
*/

require_once(LIB_PATH.DS."database.php");

class Event_Calendar extends DatabaseObject {
   	protected static $table_name = "wb_event_calendar";
    protected static $db_fields = array('id','user_id','name','description','event_date');
    public $id;
    public $user_id;
    public $name;
    public $description;
    public $event_date;
}
?>