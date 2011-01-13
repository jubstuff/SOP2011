<?php

/**
 * Description of PuntiDiControllo
 *
 * @author justb
 */
require_once 'DB.php';

class PuntoDiControllo {
	/*
	 * Recupera tutti i punti di controllo con i clienti associati
	 */
	public static function findAll() {
		$db = DB::getInstance();

		$queryStr = "SELECT C.nomeCliente, P.codicePC, P.indirizzo, P.latitudine, P.longitudine ";
		$queryStr .="FROM PuntiDiControllo P JOIN Clienti C ON(P.codiceCliente = C.codiceCliente)";
		$result = $db->query($queryStr);
		$pdc = array();
		while ($row = $result->fetch_assoc()) {
			$pdc[] = $row;
		}
		return $pdc;
	}

}

?>
