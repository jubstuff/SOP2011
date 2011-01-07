<?php

/**
 * Description of Squadra
 *
 * @author justb
 */
class Squadra {
	private static $nomeTabella = 'Squadre';

	public static function findAll() {
		$db = DB::getInstance();
		$queryStr = "SELECT codiceSquadra,nomeSquadra from " . self::$nomeTabella;
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = $row;
			}
			return $out;
		} catch (DatabaseErrorException $e) {
			echo __FILE__ . "Impossibile eseguire la query";
			exit;
		}
	}

}

?>
