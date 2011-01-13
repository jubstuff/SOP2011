<?php
//@todo questo file dovrebbe stare in azioni
require_once 'config.php';
require_once 'Redirect.php';
//@todo fare una validazione più stretta
if( isset($_FILES['turno']) && ($_FILES['turno']['error'] == UPLOAD_ERR_OK) ){
	$tmpPath = ROOT_DIR . '/tmp/' . basename($_FILES['turno']['name']);
	$result = move_uploaded_file($_FILES['turno']['tmp_name'], $tmpPath);
	if(!$result) {
		echo 'cannot move to ' . $tmpPath;
	}
} else {
	echo 'invalid file uploaded';
}

$turno = simplexml_load_file($tmpPath);
$codiceTurno = $turno['id'];
$filename = 'turno' . $codiceTurno . '.xml';
$newPath = ROOT_DIR . '/archivio/' . $filename;
rename($tmpPath, $newPath);
chmod($newPath, 0777);

$r = new Redirect(PUBLIC_URL . '/ATS/verificaPercorso/verifica.php?codiceTurno=' . $codiceTurno);
$r->doRedirect();

?>
