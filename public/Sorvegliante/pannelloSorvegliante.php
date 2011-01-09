<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';

$pageTitle = "Area privata sorveglianti";

$v = new Validator($_GET);
$v->isNotEmpty('matricola');
$v->isNumeric('matricola');

$e = $v->getError();
if (!empty($e)) {
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$clean['matricola'] = urldecode($clean['matricola']);
$sorvegliante = Sorvegliante::find_by_id($clean['matricola']);

?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<?php var_dump($sorvegliante); ?>
<ul>
	<li><a href="">Visualizza i miei turni</a></li>
</ul>
<?php include HELPERS_DIR . '/piepagina.php'; ?>

