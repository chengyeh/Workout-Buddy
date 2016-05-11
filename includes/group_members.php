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
/**
 *  @file group_members.php
 *  @date 5/4/2016
 *  @comments Helper class use to query all the group members
 *              form wb_group_members table for form input.
 */

require_once(LIB_PATH.DS."database.php");

class GroupMember extends DatabaseObject {
   	protected static $table_name = "wb_group_members"; /*!<Name of table storing group member data in database*/
    protected static $db_fields = array('id','group_id','member_id'); /*!< An array keeping track of all member variables of group_members.php*/
    public $id; /*!< A 11 digits INT keeping track of group members ID*/
    public $group_id; /*!< A 11 digits INT keeping track of groups (wb_group) ID*/
    public $member_id; /*!< A 11 digits INT keeping track of group members (wb_users) ID*/
}

?>