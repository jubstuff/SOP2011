<?php
require_once 'config.php';
require_once 'Turno.php';
$pageTitle = "Gestione turni";
$tuttiITurni = Turno::findAll();
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<p><a href="nuovo.php">Nuovo turno</a></p>
<?php if ( is_array($tuttiITurni) && !empty($tuttiITurni)) : ?>
	<table>
		<tr>
			<th>Data</th>
			<th>Turno</th>
			<th>Squadra</th>
		</tr>
	<?php
	foreach ($tuttiITurni as $t) :
		$codiceTurno = urlencode($t['codiceTurno']);
	?>
		<tr>
			<td><?php echo $t['data']; ?></td>
			<td><?php echo $codiceTurno; ?></td>
			<td><?php echo $t['nomeSquadra']; ?></td>
			<td><a href="dettagli.php?codiceTurno=<?php echo $codiceTurno; ?>">Visualizza turno</a></td>
			<td><a href="modifica.php?codiceTurno=<?php echo $codiceTurno; ?>">Modifica</a></td>
			<td><a href="elimina.php?codiceTurno=<?php echo $codiceTurno ?>">Elimina</a></td>
		</tr>
	<?php
		endforeach;
	else: ?>
		<p>Non ci sono turni</p>
	<?php endif; ?>
	</table>
<?php include HELPERS_DIR . '/piepagina.php'; ?>