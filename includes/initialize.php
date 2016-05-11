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
*	@file initialize.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments This file load all the classes.
*/

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :

define('SITE_ROOT', DS.'home'.DS.'dfernand'.DS.'public_html'.DS.'eecs448'.DS.'EECS448_Project3');

defined('LIB_PATH') ? null :
define('LIB_PATH', SITE_ROOT .DS. 'includes');

require_once(LIB_PATH.DS."config.php");

require_once(LIB_PATH.DS."functions.php");

require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");
require_once(LIB_PATH.DS."pagination.php");

//PHPMialer is not being used since System Admin security concerns
// require_once(LIB_PATH.DS."PHPMailer".DS."class.phpmailer.php");
// require_once(LIB_PATH.DS."PHPMailer".DS."class.smtp.php");
// require_once(LIB_PATH.DS."PHPMailer".DS."language".DS."phpmailer.lang-es.php");

require_once(LIB_PATH.DS."user.php");
require_once(LIB_PATH.DS."group.php");
require_once(LIB_PATH.DS."group_members.php");
require_once(LIB_PATH.DS."message.php");
require_once(LIB_PATH.DS."challenge.php");
require_once(LIB_PATH.DS."exercises.php");
require_once(LIB_PATH.DS."routine.php");
require_once(LIB_PATH.DS."log_category.php");
require_once(LIB_PATH.DS."set.php");
require_once(LIB_PATH.DS."types.php");
require_once(LIB_PATH.DS."exercises.php");
require_once(LIB_PATH.DS."event_calendar.php");
require_once(LIB_PATH.DS."log.php");

//This class is used for testing purposes
require_once(LIB_PATH.DS."test_data_employee.php");
?>
