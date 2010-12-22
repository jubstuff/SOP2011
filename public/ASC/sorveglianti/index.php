<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
$pageTitle = "Amministra Sorveglianti";
$tuttiISorveglianti = Sorvegliante::findAll();
?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1><?php echo $pageTitle ?></h1>
		<p><a href="nuovo.php">Aggiungi Sorvegliante</a></p>
      <table>
			<tr>
				<th>Matricola</th>
				<th>Nome</th>
				<th>Cognome</th>
			</tr>
			<?php foreach ($tuttiISorveglianti as $s) : 
				$matricola = $s->getMatricola();
				$matricolaClean = urlencode($matricola);
				$modificaUrl = 'modifica.php?matricola=' . $matricolaClean;
				$eliminaUrl = 'elimina.php?matricola=' . $matricolaClean;
				?>
				<tr>
					<td><?php echo $matricola; ?></td>
					<td><?php echo $s->getNome(); ?></td>
					<td><?php echo $s->getCognome(); ?></td>
					<td><a href="<?php echo $modificaUrl; ?>">Modifica</a></td>
					<td><a href="<?php echo $eliminaUrl; ?>">Elimina</a></td>
				</tr>
			<?php endforeach; ?>
		</table> 
	</body>
</html>