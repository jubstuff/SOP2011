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
	$r = new Redirect(PUBLIC_URL . 'error.php');
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
	<?php var_dump($squadra); ?>
</ul>
<ul id="percorsiWrapper">
	<?php foreach ($t->getPercorsi() as $p) : ?>
		<li><?php echo $p; ?></li>
	<?php endforeach; ?>
	</ul>
<div id="map"></div>
<div id="panel"></div>
	<p><a href="../turni/">Indietro</a></p>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
	<script type="text/javascript" src="<?php echo PUBLIC_URL; ?>/js/turni/cercaPercorsiHover.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>