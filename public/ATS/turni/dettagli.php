<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';
require_once 'Squadra.php';
require_once 'Percorso.php';


$pageTitle = "Dettaglio Turno";

$v = new Validator($_GET);

$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');

$e = $v->getError();
if (!empty($e)) {
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$clean['codiceTurno'] = urldecode($clean['codiceTurno']);
$t = Turno::find_by_id($clean['codiceTurno']);
$squadra = Squadra::find_by_id($t->getCodiceSquadra());

?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<ul>
	<?php var_dump($t); ?>

</ul>
<p><a href="../turni/">Indietro</a></p>
<?php include HELPERS_DIR . '/piepagina.php'; ?>