<?php

//echo '__FILE__:' . __FILE__;
//echo '<br>';
//echo 'basename(__FILE__): ' . basename(__FILE__);
//echo '<br>';
//echo 'dirname(__FILE__): ' . dirname(__FILE__);
//echo '<br>';
//echo 'dirname(dirname(__FILE__)): ' . dirname(dirname(__FILE__));
//$dir = dirname(dirname(__FILE__));
//echo '<br>';
//echo '$_SERVER[\'REQUEST_URI\'] ' . $_SERVER['REQUEST_URI'];
//echo '<br>';
//echo '$_SERVER[\'HTTP_HOST\'] ' . $_SERVER['HTTP_HOST'];
//echo '<p>' . $_SERVER['HTTP_HOST'] . '/' . basename(dirname(dirname(__FILE__))) . '</p>';
//echo '<br>';
//print_r($_SERVER);

define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
echo 'ROOT_URL ' . ROOT_URL;

?>