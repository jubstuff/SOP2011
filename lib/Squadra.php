<?php

/**
 * Description of Squadra
 *
 * @author justb
 */
class Squadra {
	private static $nomeTabella = 'Squadre';
	public static function find_by_id($id){
		$db = DB::getInstance();
		$queryStr = "SELECT codiceSquadra,nomeSquadra from " . self::$nomeTabella . " WHERE codiceSquadra=$id";
		try {
			$out = $db->fetchFirst($queryStr);
			return $out;
		} catch (DatabaseErrorException $e) {
			echo __FILE__ . " Impossibile eseguire la query";
			exit;
		}
	}

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
