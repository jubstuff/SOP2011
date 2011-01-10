<?php
require_once 'DB.php';

/**
 * Description of Percorso
 *
 * @author justb
 */
class Percorso {
    public static function find_by_turno($codiceTurno) {
		$db = DB::getInstance();
		$queryStr = "SELECT codicePercorso ";
		$queryStr .= "FROM TURNO_PERCORSO ";
		$queryStr .= "WHERE codiceTurno=$codiceTurno";

		$result = $db->query($queryStr);
		$out = array();
		while($row = $result->fetch_row()) {
			$out[] = $row[0];
		}
		return $out;
	}
}
?>
