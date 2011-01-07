<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Prova con mysqli</title>
	</head>
	<body>
		<?php
		require_once 'Sorvegliante.php';
		require_once 'DB.php';
		$db = DB::getInstance();
		$queryStr = "SELECT * FROM Sorveglianti";
		$result = $db->query($queryStr);
		//query ok
		echo '<ul>';
		while ($row = $result->fetch_assoc()) {
			echo '<li>' . $row['matricola'] . '-' . $row['nome'] . '-' .
			$row['cognome'] . '</li>';
		}
		echo '</ul>';
		
		
		$s = Sorvegliante::find_by_id(2);
		echo $s;
		
		?>


	</body>
</html>

