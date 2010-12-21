<?php
require_once 'config.php';
require_once 'PuntoDiControllo.php';
$pageTitle = "Amministra punti di controllo";
$tuttiIPdc = PuntoDiControllo::findAll();

?>
<!doctype html>
<html>
   <head>
      <title><?php echo $pageTitle; ?></title>
   </head>
   <body>
		<h1>Amministrazione punti di controllo</h1>
		<p><a href="">Aggiungi punto di controllo</a></p>
      <table>
			<tr>
				<th>Codice</th>
				<th>Indirizzo</th>
				<th>Latitudine</th>
				<th>Longitudine</th>
				<th>IdTag</th>
				<th>Cliente</th>
			</tr>
			<?php foreach ($tuttiIPdc as $s) : 
				$id = $s->getCodicePC();
				?>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $s->getIndirizzo(); ?></td>
					<td><?php echo $s->getLatitudine(); ?></td>
					<td><?php echo $s->getLongitudine(); ?></td>
					<td><?php echo $s->getIdTag(); ?></td>
					<td><?php echo $s->getCodiceCliente(); ?></td>
					<td><a href="modifica.php?id=<?php echo $id; ?>">Modifica</a></td>
					<td><a href="<?php echo $actionUrl; ?>/puntoDiControllo/elimina.php?id=<?php echo $id; ?>">Elimina</a></td>
				</tr>
			<?php endforeach; ?>
		</table> 
	</body>
</html>