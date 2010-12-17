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
		<h1>Amministrazione sorveglianti</h1>
		<p><a href="nuovo.php">Aggiungi Sorvegliante</a></p>
      <table>
			<tr>
				<th>Matricola</th>
				<th>Nome</th>
				<th>Cognome</th>
			</tr>
			<?php foreach ($tuttiISorveglianti as $s) : 
				$id = $s->getMatricola();
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $s->getNome(); ?></td>
					<td><?php echo $s->getCognome(); ?></td>
					<td><a href="modifica.php?id=<?php echo $id; ?>">Modifica</a></td>
					<td><a href="<?php echo $actionUrl; ?>/sorvegliante/elimina.php?id=<?php echo $id; ?>">Elimina</a></td>
				</tr>
			<?php endforeach; ?>
		</table> 
	</body>
</html>