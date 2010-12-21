<?php
require_once 'config.php';
//require_once 'Validator.php';
require_once 'PuntoDiControllo.php';

$pageTitle = "Modifica Punto di controllo";

//@todo ricordarsi di filtrare l'input
$s = PuntoDiControllo::find_by_id($_GET['id']);

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
		<h1>Modifica punto di controllo</h1>
		<form action="<?php echo ACTION_URL; ?>/puntoDiControllo/modifica.php" method="post">
			<p>
				<label for="indirizzo">Indirizzo</label>
				<input id="indirizzo" name="indirizzo" type="text" value="<?php echo $s->getIndirizzo(); ?> " size="50" />
			</p>
			<p>
				<label for="latitudine">Latitudine</label>
				<input id="lat" name="lat" type="text" value="<?php echo $s->getLatitudine(); ?>" />
			</p>
			<p>
				<label for="longitudine">Longitudine</label>
				<input id="lng" name="lng" type="text" value="<?php echo $s->getLongitudine(); ?>" />
			</p>
			<p>
				<label for="idTag">idTag</label>
				<input id="idTag" name="idTag" type="text" value="<?php echo $s->getIdTag(); ?>" />
			</p>
			<p>
				<label for="codiceCliente">Codice Cliente</label>
				<input id="codiceCliente" name="codiceCliente" type="text" value="<?php echo $s->getCodiceCliente(); ?>" />
			</p>
			<p>
				<input id="submit" name="submit" type="submit" value="Aggiorna" />
				<input type="hidden" name="id" value="<?php echo $s->getCodicePC(); ?>" />
			</p>
		</form>

	</body>
</html>