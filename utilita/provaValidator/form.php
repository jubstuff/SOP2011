<?php
session_start();
?>


<!doctype html>
<html>
	<head>
		<title>Prova validator - form</title>
	</head>
	<body>
		<?php
		$selected = 'selected="selected"';
		if (isset($_SESSION['errors'])) {
			$e = $_SESSION['errors'];
			$default = $_SESSION['clean'];
			unset($_SESSION['errors']);
			foreach ($e as $error) {
				echo '<p style="color:#F00">' . $error . '</p>';
			}
		} else {
			$default['uno'] = $default['due'] = $default['tre'] = '';
			
		}
		?>
		<form action="valida.php" method="post">
			Uno <input type="text" name="uno" id="uno" value="<?php echo $default['uno'] ?>" />
			Due <input type="text" name="due" id="due" value="<?php echo $default['due'] ?>"/>
			Tre <select name="tre" id="tre">
				<option value="" <?php echo ($default['tre']=='' ? $selected : ''); ?>>[Seleziona un'opzione]</option>
				<option value="a" <?php echo ($default['tre']=='a' ? $selected : ''); ?>>a</option>
				<option value="b" <?php echo ($default['tre']=='b' ? $selected : ''); ?>>b</option>
				<option value="c" <?php echo ($default['tre']=='c' ? $selected : ''); ?>>c</option>
				<option value="d" <?php echo ($default['tre']=='d' ? $selected : ''); ?>>d</option>
			</select>
			<input type="submit" name="submit" value="Invia" />
		</form>
	</body>
</html>