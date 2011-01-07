<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';


$pageTitle = "Modifica Turno";
$v = new Validator($_GET);
//@todo fare decodeurl su matricola
$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');

$e = $v->getError();
if(!empty($e)){
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$t = Turno::find_by_id($clean['codiceTurno']);

$modificaUrl = ACTION_URL . '/turno/modifica.php';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
		<h1><?php echo $pageTitle; ?></h1>
		<form action="<?php echo $modificaUrl; ?>" method="post">
			<p>
				<label for="data">Data</label>
				<input id="data" name="data" type="text" value="<?php echo $t->getData(); ?>" />
			</p>
			
		</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>