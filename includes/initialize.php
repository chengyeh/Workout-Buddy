<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :
    define('SITE_ROOT', DS.'home'.DS.'clee28'.DS.'public_html'.DS.'EECS448'.DS.'EECS448_Project3');

defined('LIB_PATH') ? null :
    define('LIB_PATH', SITE_ROOT .DS. 'includes');
    
require_once(LIB_PATH.DS."config.php");

require_once(LIB_PATH.DS."functions.php");

require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");
// require_once(LIB_PATH.DS."pagination.php");
require_once(LIB_PATH.DS."PHPMailer".DS."class.phpmailer.php");
require_once(LIB_PATH.DS."PHPMailer".DS."class.smtp.php");
require_once(LIB_PATH.DS."PHPMailer".DS."language".DS."phpmailer.lang-es.php");

require_once(LIB_PATH.DS."user.php");
//require_once(LIB_PATH.DS."photograph.php");
//require_once(LIB_PATH.DS."comment.php");
//require_once(LIB_PATH.DS."glaze.php");
//require_once(LIB_PATH.DS."ingredient.php");
//require_once(LIB_PATH.DS."image_resize.php");
?>