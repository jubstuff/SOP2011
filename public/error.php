<?php
session_start();
require_once 'config.php';
$pageTitle = "Errore | Sistema Informativo SOP 2011";
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1>Errore</h1>
<?php
if(isset($_SESSION['error'])) {
	var_dump($_SESSION['error']);
}
?>
<p>Siamo spiacenti ma si è verificato un problema tecnico con il sistema.</p>
<p>La preghiamo di riprovare, e se i problemi dovessero persistere, di contattare
	l'amministratore di sistema</p>
<p>Probabilmente può trovare quello che cerca alla <a href="<?php echo PUBLIC_URL; ?>">Home Page</a>.</p>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
