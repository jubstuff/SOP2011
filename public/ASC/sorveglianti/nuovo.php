<?php
require_once 'autenticazione.php';
require_once 'config.php';
require_once 'DB.php';
require_once 'Squadra.php';


$pageTitle = "Aggiungi Sorvegliante";
$aggiungiUrl = ACTION_URL . '/sorvegliante/aggiungi.php';
$selected = 'selected="selected"';

$squadre = Squadra::findAll();

$default = array('nome' => '', 'cognome' => '', 'codiceSquadra' => 1);

if (isset($_SESSION['errors'])) {
	$e = $_SESSION['errors'];
	$c = $_SESSION['clean'];

	$default = array_merge($default, $c);

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

		<form id="nuovoSorvegliante" action="<?php echo $aggiungiUrl; ?>" method="post">
			<p>
				<label for="nome">Nome</label>
				<input class="required" id="nome" name="nome" type="text" value="<?php echo $default['nome']; ?>" />
				<span>*</span>
			</p>
			<p>
				<label for="cognome">Cognome</label>
				<input class="required" id="cognome" name="cognome" type="text" value="<?php echo $default['cognome']; ?>" />
				<span>*</span>
			</p>
			<p>
				<label for="password">Password</label>
				<input class="required" id="password" name="password" type="password" />
				<span>*</span>
			</p>
			<p>
				<label for="codiceSquadra">Squadra</label>
				<select class="required" id="codiceSquadra" name="codiceSquadra">
			<?php foreach ($squadre as $s) : ?>
				<option value="<?php echo $s['codiceSquadra']; ?>" <?php if ($default['codiceSquadra'] == $s['codiceSquadra'])
					echo $selected; ?>><?php echo $s['nomeSquadra']; ?></option>
					<?php endforeach; ?>
		</select>
		<span>*</span>
	</p>
	<p>
		<input id="submit" name="submit" type="submit" value="Salva Sorvegliante" />
	</p>
</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript">

	/*$('#nuovoSorvegliante').submit(function(event){
		console.log('Form inviato!');
		var senzaErrori = true;
		$('.required').each(function(){
			if($(this).val().length == 0) {
				senzaErrori = false;
				$(this).css('border', '2px solid red');
			}

		});
		return senzaErrori;
	});*/
	$(document).ready(function(){

		
		$('#nuovoSorvegliante :input').blur(function(){
			$(this).parents('p:first').removeClass('warning')
			.find('span.error-message').remove();
			if( $(this).hasClass('required') ){
				var $listItem = $(this).parents('p:first');
				if(this.value == ''){
					var errorMessage = 'Questo è un campo obbligatorio';
					$('<span></span>')
					.addClass('error-message')
					.text(errorMessage)
					.appendTo($listItem)
					$listItem.addClass('warning');
					senzaErrori = false;
				}
			}
		});
		$('form').submit(function(event){
			$(':input.required').trigger('blur');
			var numWarnings = $('.warning', this).length;
			if(numWarnings) {
				event.preventDefault();
			}
		});
	});
	

</script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>