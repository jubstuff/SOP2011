<?php
require_once 'config.php';
require_once 'DB.php';
$pageTitle = "Aggiungi Sorvegliante";
$aggiungiUrl = ACTION_URL . '/sorvegliante/aggiungi.php';

//@fixme questo dovrebbe andare nella classe Squadra
$db = DB::getInstance();
$queryStr = "SELECT codiceSquadra,nomeSquadra from Squadre";
try {
	$result = $db->query($queryStr);
	$out = array();
	while ($row = $result->fetch_assoc()) {
		$out[] = $row;
	}
} catch (DatabaseErrorException $e) {
	echo __FILE__ . "Impossibile eseguire la query";
}

?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1>Aggiungi nuovo sorvegliante</h1>
		<form action="<?php echo $aggiungiUrl; ?>" method="post">
			<p>
				<label for="nome">Nome</label>
				<input id="nome" name="nome" type="text" />
			</p>
			<p>
				<label for="cognome">Cognome</label>
				<input id="cognome" name="cognome" type="text" />
			</p>
			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" />
			</p>
			<p>
				<label for="codiceSquadra">Squadra</label>
				<select id="codiceSquadra" name="codiceSquadra">
					<?php foreach ($out as $s) : ?>
						<option value="<?php echo $s['codiceSquadra']; ?>"><?php echo $s['nomeSquadra']; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<input id="submit" name="submit" type="submit" value="Salva Sorvegliante" />
			</p>
		</form>
	</body>
</html>