<?php
//echo "Richiesta ricevuta dalla mappa";
$percorso =  json_encode($_POST['p']);
//$json = json_decode($_POST['s']);
//
$fp = fopen ("Json.txt", "w+");
fwrite ($fp, $percorso);
fclose($fp);
//var_dump($_POST);
?>
