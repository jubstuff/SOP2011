<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Prova con mysqli</title>
	</head>
	<body>
		<?php

		$conn = new mysqli('localhost', 'sop2011_admin', 'z0m1x9n2', 'sop2011');
		if ( mysqli_connect_errno ( ) ) {
			die('impossibile connettersi');
		}
		$queryStr = "SELECT * FROM Sorveglianti";
		$result = $conn->query($queryStr);
		if ( $result === FALSE ) {
			//query fallita
			echo "<p>Stavo eseguendo la query " . $queryStr . '</p>';
			die("Query Fallita");
		} else {
			//query ok
			echo '<ul>';
			while ($row = $result->fetch_assoc()) {
				echo '<li>' . $row['matricola'] . '-' . $row['nome'] . '-' .
				$row['cognome'] . '</li>';
			}
			echo '</ul>';
		}

		$conn->close();
		?>

	</body>
</html>

