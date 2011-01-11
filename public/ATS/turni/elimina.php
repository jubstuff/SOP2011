<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$pageTitle = 'Elimina turno';

$v = new Validator($_GET);
$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');
//@todo fare decodeurl su matricola
$e = $v->getError();
if(!empty($e)){
	$r = new Redirect(PUBLIC_URL . '/error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$t = Turno::find_by_id($clean['codiceTurno']);
$eliminaUrl = ACTION_URL . '/turno/elimina.php';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
		<h1><?php echo $pageTitle; ?></h1>
                <p>Sei sicuro di voler cancellare il turno "<?php echo $t; ?>"?</p>
		<form action="<?php echo $eliminaUrl; ?>" method="post">
			<p><input type="radio" name="elimina" id="eliminaSI" value="SI" />Si</p>
			<p><input type="radio" name="elimina" id="eliminaNO" value="NO" checked="checked" />No</p>
			<p>
				<input id="submit" name="submit" type="submit" value="Invia" />
				<input type="hidden" name="codiceTurno" value="<?php echo $t->getCodiceTurno(); ?>" />
			</p>
		</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>