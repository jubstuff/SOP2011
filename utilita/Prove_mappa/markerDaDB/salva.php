<?php
$nomePercorso = urldecode($_POST['form']);
$form = explode('=', $nomePercorso);
$percorso =  $form[1];

$fp = fopen ("Json.txt", "w+");
fwrite ($fp, $percorso);
fclose($fp);

?>
