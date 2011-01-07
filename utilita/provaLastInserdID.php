<?php
require_once 'DB.php';
require_once 'DatabaseErrorException.php';

$db = DB::getInstance();
$queryStr = "INSERT INTO Percorsi(partenza,arrivo) VALUES(1,2)";
try{
$db->query($queryStr);
} catch (DatabaseErrorException $e) {
    printf("c'è stato un errore. \n La query usata %s", $queryStr);
    exit;
}
printf("L'id dell'ultimo percorso è %d", $db->lastInsertId());
?>
