<?php require_once 'Sorvegliante.php'; ?>
<!doctype html>
<html>
   <head>
      <title><?php echo ("Sistema Informativo SOP 2011"); ?></title>
   </head>
   <body>
      <h1>SOP 2011</h1>
      <p>Cosa vuoi fare?</p>
      <ul>
         <li><a href="ASC/">Amministrare clienti e sorveglianti</a></li>
         <li><a href="">Amministrare turni e percorsi</a></li>
         <li><a href="">[Sorvegliante] Visualizzare i miei turni e percorsi</a></li>
      </ul>
		<?php 
		$s = Sorvegliante::findAll();
		foreach ($s as $value) {
			echo $value;
}
		?>
   </body>
</html>
