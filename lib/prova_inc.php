<?php
echo '__FILE__:' . __FILE__;
echo '<br>';
echo 'basename(__FILE__): ' . basename(__FILE__);
echo '<br>';
echo 'dirname(__FILE__): ' . dirname(__FILE__);
echo '<br>';
echo 'dirname(dirname(__FILE__)): ' . dirname(dirname(__FILE__));
$dir = dirname(dirname(__FILE__));
echo '<br>';
echo $_SERVER['REQUEST_URI'];
echo '<p>'.$_SERVER['HTTP_HOST'] . '/' .basename(dirname(dirname(__FILE__))).'</p>';
?>
