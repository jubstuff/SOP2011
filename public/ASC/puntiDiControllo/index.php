<?php
require_once 'config.php';
require_once 'PuntoDiControllo.php';
$pageTitle = "Amministra punti di controllo";
$tuttiIPdc = PuntoDiControllo::findAll();

?>
<?php include HELPERS_DIR . '/testata.php'; ?>

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
				$matricola = $s->getCodicePC();
				?>
				<tr>
					<td><?php echo $matricola; ?></td>
					<td><?php echo $s->getIndirizzo(); ?></td>
					<td><?php echo $s->getLatitudine(); ?></td>
					<td><?php echo $s->getLongitudine(); ?></td>
					<td><?php echo $s->getIdTag(); ?></td>
					<td><?php echo $s->getCodiceCliente(); ?></td>
					<td><a href="modifica.php?id=<?php echo $matricola; ?>">Modifica</a></td>
					<td><a href="<?php echo $actionUrl; ?>/puntoDiControllo/elimina.php?id=<?php echo $matricola; ?>">Elimina</a></td>
				</tr>
			<?php endforeach; ?>
		</table> 
<?php include HELPERS_DIR . '/piepagina.php'; ?>