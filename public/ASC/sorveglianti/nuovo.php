<?php
require_once 'config.php';
$pageTitle = "Aggiungi Sorvegliante"; ?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1>Aggiungi nuovo sorvegliante</h1>
		<form action="<?php echo $actionUrl; ?>/sorvegliante/aggiungi.php" method="post">
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
				<input id="submit" name="submit" type="submit" value="Salva Sorvegliante" />
			</p>
		</form>

	</body>
</html>