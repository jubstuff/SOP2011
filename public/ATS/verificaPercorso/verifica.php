<?php
require_once 'config.php';
require_once 'Percorso.php';
require_once 'Validator.php';

$v = new Validator($_GET);
$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');

$e = $v->getError();
if (!empty($e)) {
	$r = new Redirect(PUBLIC_URL . '/error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$codiceTurno = urldecode($clean['codiceTurno']);

$percorsi = Percorso::find_by_turno($codiceTurno);



$pageTitle = "Verifica congruenza percorsi";
?>

<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<div id="map-assegnati"></div>
<ul id="elencoPercorsi">
	<?php foreach ($percorsi as $i => $numPercorso): ?>
		<li><a href="codicePercorso=<?php echo $numPercorso; ?>&codiceTurno=<?php echo $codiceTurno; ?>">Percorso <?php echo ($i+1); ?></a></li>
	<?php endforeach; ?>
	</ul>

<div id="map-effettuati"></div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
<script type="text/javascript" src="<?php echo PUBLIC_URL; ?>/js/verificaPercorsi/verificaPercorsi.js"></script>

<?php include HELPERS_DIR . '/piepagina.php'; ?>