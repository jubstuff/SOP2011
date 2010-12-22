<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';


$pageTitle = "Modifica Sorvegliante";
$v = new Validator($_GET);
//@todo fare decodeurl su matricola
$v->isNotEmpty('matricola');
$v->isNumeric('matricola');

$e = $v->getError();
if(!empty($e)){
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$s = Sorvegliante::find_by_id($clean['matricola']);

$modificaUrl = ACTION_URL . '/sorvegliante/modifica.php';
?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1><?php echo $pageTitle; ?></h1>
		<form action="<?php echo $modificaUrl; ?>" method="post">
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
				<input type="hidden" name="matricola" value="<?php echo $s->getMatricola(); ?>" />
			</p>
		</form>

	</body>
</html>