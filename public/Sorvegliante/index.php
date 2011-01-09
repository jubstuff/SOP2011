<?php
require_once 'config.php';
require_once 'Sorvegliante.php';

$pageTitle = "Area privata sorveglianti";

$sorveglianti = Sorvegliante::findAll();

?>
<?php include HELPERS_DIR . '/testata.php'; ?>

<h1><?php echo $pageTitle; ?></h1>
<p>Quale sorvegliante sei?</p>
<ul>
	<?php foreach ($sorveglianti as $s):
		$matricola = $s->getMatricola();
		$matricolaClean = urlencode($matricola);
		$nome = $s->getNome() . ' ' . $s->getCognome();
		?>
	<li><a href="pannelloSorvegliante.php?matricola=<?php echo $matricolaClean; ?>"><?php echo $nome; ?></a></li>
	<?php	endforeach; ?>
</ul>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
