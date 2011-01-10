<?php

require 'DB.php';

/**
 * Description of Turno
 *
 * @author Francesco Paolo
 */
class Turno {

	private static $nomeTabella = 'Turni';
	private $data;
	private $codiceTurno;
	private $codiceSquadra;
	private $percorsi = array();

	public function __construct($data, $codiceSquadra, $codiceTurno='') {
		$this->setData($data);
		$this->setCodiceTurno($codiceTurno);
		$this->setCodiceSquadra($codiceSquadra);
	}

	/*
	 * GETTER
	 */

	public function getData() {
		return $this->data;
	}

	public function getCodiceTurno() {
		return $this->codiceTurno;
	}

	public function getCodiceSquadra() {
		return $this->codiceSquadra;
	}

	/*
	 * SETTER
	 */

	public function setData($data) {
		$this->data = $data;
	}

	public function setCodiceTurno($codiceTurno) {
		$this->codiceTurno = $codiceTurno;
	}

	public function setCodiceSquadra($codiceSquadra) {
		$this->codiceSquadra = $codiceSquadra;
	}

	/**
	 *
	 * @param type $id
	 * @return Turno L'oggetto turno relativo al codiceTurno dato
	 * in ingresso
	 */
	public static function find_by_id($id) {
		$db = DB::getInstance();
		$nomeChiave = 'codiceTurno';
		$queryStr = "SELECT data, codiceTurno, codiceSquadra FROM ";
		$queryStr .= self::$nomeTabella . " WHERE $nomeChiave=$id";

		try {
			$out = $db->fetchFirst($queryStr);
			$t = new Turno($out['data'], $out['codiceSquadra'], $out['codiceTurno']);
			return $t;
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a trovare il Turno.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	/**
	 *
	 * @return array array contenente i dati relativi a tutti i turni
	 */
	public static function findAll() {
		$db = DB::getInstance();
		$queryStr = "SELECT T.codiceTurno, S.nomeSquadra, T.data ";
		$queryStr .= "FROM Turni T JOIN Squadre S ON (T.codiceSquadra = S.codiceSquadra) ";
		$queryStr .= "ORDER BY T.data DESC";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = $row;
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a trovare i Turni.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo $exc->getTraceAsString();
			exit;
		}
	}

	public function __toString() {
		$msg = $this->getData() . ' ' . $this->getCodiceTurno() . ' ' . $this->getCodiceSquadra();
		return $msg;
	}

	public function save() {
		$db = DB::getInstance();
		/* Salvataggio Turno */
		$queryStr1 = "INSERT INTO " . self::$nomeTabella;
		$queryStr1 .= "(data, codiceSquadra) VALUES ('$this->data', $this->codiceSquadra)";
		try {
			$db->query($queryStr1);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
			$msg .= "<p>La query usate: " . $queryStr1 . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
		/*
		$queryStr2 = "INSERT INTO Turno_Percorso (codiceTurno, codicePercorso) VALUES ";
		$len = count($this->percorsi);
		for ($i = 0; $i < $len - 1; $i++) {
			$queryStr2 .= "(LAST_INSERT_ID(), " . $this->percorsi[$i] . "), ";
		}
		$queryStr2 .= "(LAST_INSERT_ID()," . $this->percorsi[$i++] . ");";

		try {
			$db->query($queryStr2);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
			$msg .= "<p>La query usata: " . $queryStr2 . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}*/
	}

	public function update() {
		$db = DB::getInstance();
		$queryStr = "UPDATE " . self::$nomeTabella . " SET nome='" . $this->nome . "', cognome='" . $this->cognome . "' WHERE matricola=" . $this->matricola;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	public function delete() {
		$db = DB::getInstance();
		$queryStr = "DELETE FROM " . self::$nomeTabella . " WHERE codiceTurno=" . $this->codiceTurno;
		//@todo c'è bisogno di un cascade nella tabella turno_percorso
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a cancellare il Turno.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	public function associaPercorsi($arrayPercorsi) {
		$this->percorsi = $arrayPercorsi;
	}

}

?>