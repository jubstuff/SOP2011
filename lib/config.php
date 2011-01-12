<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
define("BASE_URL", 'http://' . $_SERVER['HTTP_HOST'] . ROOT_URL) ;
define("PUBLIC_URL", BASE_URL . '/public');
define("ACTION_URL", BASE_URL . '/azioni');
define("HELPERS_DIR", ROOT_DIR . '/viewHelpers');
?>
