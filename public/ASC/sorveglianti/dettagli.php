<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';
require_once 'Squadra.php';


$pageTitle = "Dettagli Sorvegliante";

$v = new Validator($_GET);

$v->isNotEmpty('matricola');
$v->isNumeric('matricola');

$e = $v->getError();
if (!empty($e)) {
	$r = new Redirect(PUBLIC_URL . '/error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$clean['matricola'] = urldecode($clean['matricola']);
$s = Sorvegliante::find_by_id($clean['matricola']);
$squadra = Squadra::find_by_id($s->getCodiceSquadra());
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<ul>
	<li>Matricola: <?php echo $s->getMatricola(); ?></li>
	<li>Nome: <?php echo $s->getNome(); ?></li>
	<li>Cognome: <?php echo $s->getCognome(); ?></li>
	<li>Squadra: <?php echo $squadra['nomeSquadra']; ?></li>
</ul>
<p><a href="../sorveglianti/">Indietro</a></p>
<?php include HELPERS_DIR . '/piepagina.php'; ?>