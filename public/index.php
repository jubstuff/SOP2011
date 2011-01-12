<?php
session_start();
require_once 'config.php';
$pageTitle = "Sistema Informativo SOP 2011";
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<!--
<p>Cosa vuoi fare?</p>
<ul>
	<li><a href="ASC/">Amministrare clienti e sorveglianti</a></li>
	<li><a href="ATS/">Amministrare turni e percorsi</a></li>
	<li><a href="Sorvegliante/">[Sorvegliante] Visualizzare i miei turni e percorsi</a></li>
</ul>-->
<?php
//@todo aggiungere visualizzazione errori


if (isset($_SESSION['errors'])) {
	$e = $_SESSION['errors'];
	unset($_SESSION['errors']);

	var_dump($e);
}
?>
<form action="<?php echo ACTION_URL; ?>/utente/login.php" method="post">
	<p>
		<label for="username">Username</label>
		<input id="username" name="username" type="text" />
	</p>
	<p>
		<label for="password">Password</label>
		<input id="password" name="password" type="password" />
	</p>
	<p>
		<label for="ruolo">Ruolo</label>
		<select id="ruolo" name="ruolo">
			<option value="ASC">Amministratore sorveglianti e clienti</option>
			<option value="ATS">Amministratore turni e percorsi</option>
			<option value="SOR">Sorvegliante</option>
		</select>
	</p>
	<p>
		<input id="submit" name="submit" type="submit" value="Login" />
	</p>
</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
