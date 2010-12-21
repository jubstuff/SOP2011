<?php
require_once 'config.php';
require_once 'Validator.php';
require_once 'PuntoDiControllo.php';

//echo "Il referer è " . $_SERVER['HTTP_REFERER'];
if ( is_numeric($_GET['id']) ) {
	$id = $_GET['id'];
} else {
	die('Non dovresti essere qui!');
}
echo "<p>Vuoi cancellare il punto di controllo con codice $id</p>";
?>
