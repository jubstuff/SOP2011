<?php
require_once 'config.php';

if( isset($_FILES['turno']) && ($_FILES['turno']['error'] == UPLOAD_ERR_OK) ){
	$newPath = ROOT_DIR . basename($_FILES['turno']['name']);
	if(move_uploaded_file($_FILES['turno']['tmp_name'], $newPath)) {
		echo 'moved to ' . $newPath;
	} else {
		echo 'cannot move to ' . $newPath;
	}
} else {
	echo 'invalid file uploaded';
}

?>
