<!doctype html>
<html>
	<head>
		<title>Prova validator - form</title>
	</head>
	<body>
		<form action="valida.php" method="post">
			Uno <input type="text" name="uno" id="uno" />
			Due <input type="text" name="due" id="due"/>
			Tre <select name="tre" id="tre">
				<option value="" selected="selected">[Seleziona un'opzione]</option>
				<option value="a">a</option>
				<option value="b">b</option>
				<option value="c">c</option>
				<option value="d">d</option>
			</select>
			<input type="submit" name="submit" value="Invia" />
		</form>
	</body>
</html>