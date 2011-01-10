<?php

require_once 'DB.php';

/**
 * Description of Percorso
 *
 * @author justb
 */

require_once 'DB.php';
class Percorso {

	public static function find_by_turno($codiceTurno) {
		$db = DB::getInstance();
		$queryStr = "SELECT codicePercorso ";
		$queryStr .= "FROM TURNO_PERCORSO ";
		$queryStr .= "WHERE codiceTurno=$codiceTurno";

		$result = $db->query($queryStr);
		$out = array();
		while ($row = $result->fetch_row()) {
			$out[] = $row[0];
		}
		return $out;
	}

	public static function findAll() {
		$db = DB::getInstance();
		//@todo questo dovrebbe stare nella classe Percorso
		$queryStr = "SELECT codicePercorso from Percorsi ORDER BY codicePercorso";
		try {
			$result = $db->query($queryStr);
			$percorsi = array();
			while ($row = $result->fetch_assoc()) {
				$percorsi[] = $row;
			}
			return $percorsi;
		} catch (DatabaseErrorException $e) {
			echo __FILE__ . "Impossibile eseguire la query";
		}
	}

}

?>
