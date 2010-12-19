<?php
require_once 'config.php';
require_once 'Sorvegliante.php';

$pageTitle = "Modifica Sorvegliante";

$validator = new Validator($_GET);
if($validator->isNumeric('id')) {
	$s = Sorvegliante::find_by_id($clean['id']);
}
//$clean = array();
//$errors = array();
//if (isset($_GET['id']) && strlen($_GET['id']) && is_numeric($_GET['id'])) {
//	$clean['id'] = $_GET['id'];	
//} else {
//	/* errore */
//	die("Non dovresti essere qui!");
//}


?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1>Modifica sorvegliante</h1>
		<form action="<?php echo ACTION_URL; ?>/sorvegliante/modifica.php" method="post">
			<p>
				<label for="nome">Nome</label>
				<input id="nome" name="nome" type="text" value="<?php echo $s->getNome(); ?>" />
			</p>
			<p>
				<label for="cognome">Cognome</label>
				<input id="cognome" name="cognome" type="text" value="<?php echo $s->getCognome(); ?>" />
			</p>
			<p>
				<input id="submit" name="submit" type="submit" value="Aggiorna Sorvegliante" />
				<input type="hidden" name="id" value="<?php echo $s->getMatricola(); ?>" />
			</p>
		</form>

	</body>
</html>