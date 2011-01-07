<?php
session_start();
require_once 'config.php';
require_once 'DB.php';
require_once 'Squadra.php';


$pageTitle = "Aggiungi Sorvegliante";
$aggiungiUrl = ACTION_URL . '/sorvegliante/aggiungi.php';
$selected = 'selected="selected"';

$squadre = Squadra::findAll();

$default = array('nome'=>'','cognome'=>'','codiceSquadra'=>1);

if (isset($_SESSION['errors'])) {
	$e = $_SESSION['errors'];
	$c = $_SESSION['clean'];
	
	$default = array_merge($default,$c);
	
	unset($_SESSION['errors']);
	unset($_SESSION['clean']);
}
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
		<h1>Aggiungi nuovo sorvegliante</h1>

		<?php if (isset($e)) : ?>
			<ul class="errorList">
				<?php foreach ($e as $error) : ?>
					<li><?php echo $error; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<form action="<?php echo $aggiungiUrl; ?>" method="post">
			<p>
				<label for="nome">Nome</label>
				<input id="nome" name="nome" type="text" value="<?php echo $default['nome']; ?>" />
			</p>
			<p>
				<label for="cognome">Cognome</label>
				<input id="cognome" name="cognome" type="text" value="<?php echo $default['cognome']; ?>" />
			</p>
			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" />
			</p>
			<p>
				<label for="codiceSquadra">Squadra</label>
				<select id="codiceSquadra" name="codiceSquadra">
					<?php foreach ($squadre as $s) : ?>
						<option value="<?php echo $s['codiceSquadra']; ?>" 
								  <?php if ($default['codiceSquadra'] == $s['codiceSquadra'])
									  echo $selected; ?>>
						<?php echo $s['nomeSquadra']; ?>
						</option>
<?php endforeach; ?>
				</select>
			</p>
			<p>
				<input id="submit" name="submit" type="submit" value="Salva Sorvegliante" />
			</p>
		</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>