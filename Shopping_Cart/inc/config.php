<?php
if(!isset($_SESSION)){
    session_start();
}


// site domain with http
//example http://www.shoppingsite.com

defined("SITE_URL")
 || define("SITE_URL","http://".$_SERVER['SERVER_NAME']);

//dynamic directory seperator (WINDOWS,UNIX)
defined("DS")
 || define("DS", DIRECTORY_SEPARATOR);




defined("ROOT_PATH")
  || define("ROOT_PATH", realpath(dirname(__FILE__).DS."..".DS));


// classes folder
defined("CLASSES_DIR")
	|| define("CLASSES_DIR", "classes");

// pages directory
defined("PAGES_DIR")
	|| define("PAGES_DIR", "pages");

// modules folder
defined("MOD_DIR")
	|| define("MOD_DIR", "mod");
	
// inc folder
defined("INC_DIR")
	|| define("INC_DIR", "inc");

defined("CSS_DIR")
|| define("CSS_DIR", "css");
	
// templates folder
defined("TEMPLATE_DIR")
	|| define("TEMPLATE_DIR", "template");

//emails path
defined("EMAILS_PATH")
    || define("EMAILS_PATH",ROOT_PATH.DS."emails");


// catalogue images path
defined("CATALOGUE_PATH")
   || define("CATALOGUE_PATH",ROOT_PATH.DS."media".DS."catalogue");


/*
 * Sets the include path for directories viz classes,pages,mod,inc,template
 * One does not have to write include_once(../inc/config.php)
 * instead we can write include_once(config.php).
 * Parser will search all the paths seperated by PATH_SEPERATOR ";" => WINDOWS and ":" => UNIX
 * and includes the filename mentioned in include_once or similar statements.
 */

$paths = array(
    realpath(ROOT_PATH.DS.CLASSES_DIR),
    realpath(ROOT_PATH.DS.PAGES_DIR),
    realpath(ROOT_PATH.DS.MOD_DIR),
    realpath(ROOT_PATH.DS.INC_DIR),
    realpath(ROOT_PATH.DS.TEMPLATE_DIR),
    get_include_path() 
);

set_include_path(implode(PATH_SEPARATOR, array(
	realpath(ROOT_PATH.DS.CLASSES_DIR),
	realpath(ROOT_PATH.DS.PAGES_DIR),
	realpath(ROOT_PATH.DS.MOD_DIR),
	realpath(ROOT_PATH.DS.INC_DIR),
	realpath(ROOT_PATH.DS.TEMPLATE_DIR),
        realpath(ROOT_PATH.DS.CSS_DIR),
	get_include_path()
)));

/*$path = implode(PATH_SEPARATOR, $paths);
echo $path;
set_include_path($path);

echo "<pre>";
print_r($paths);
echo get_include_path();
*/

?>
