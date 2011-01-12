<?php

require_once 'config.php';
require_once 'DB.php';
require_once 'Redirect.php';

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

	public function getPercorsi() {
		return $this->percorsi;
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

	public function setPercorsi($arrayPercorsi) {
		$this->percorsi = $arrayPercorsi;
	}

	/**
	 * Recupera il Turno con l'id specificato e con i percorsi associati
	 * 
	 * @param int $id
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
			$percorsi = $t->recuperaPercorsi();
			$t->setPercorsi($percorsi);
			return $t;
		} catch (DatabaseErrorException $exc) {
			$_SESSION['error'] = 'Impossibile trovare il turno';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

	/**
	 *
	 * @return array array contenente i dati relativi a tutti i turni
	 */
	public static function findAll() {
		$db = DB::getInstance();

		$queryStr = "SELECT T.codiceTurno, S.nomeSquadra, DATE_FORMAT(T.data,'%e-%b-%Y') AS data ";
		$queryStr .= "FROM Turni T JOIN Squadre S ON (T.codiceSquadra = S.codiceSquadra) ";
		$queryStr .= "ORDER BY T.data ASC";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = $row;
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a trovare i Turni.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo $exc->getTraceAsString();
//			exit;
			$_SESSION['error'] = 'Impossibile trovare turni';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

	public static function find_by_codice_squadra($codiceSquadra) {
		$db = DB::getInstance();
		$queryStr = "SELECT T.codiceTurno, S.nomeSquadra, DATE_FORMAT(T.data,'%e-%b-%Y') AS data ";
		$queryStr .= "FROM Turni T JOIN Squadre S ON (T.codiceSquadra = S.codiceSquadra) ";
		$queryStr .= "WHERE T.codiceSquadra=$codiceSquadra ";
		$queryStr .= "ORDER BY T.data DESC";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = $row;
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a trovare i Turni.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo $exc->getTraceAsString();
//			exit;
			$_SESSION['error'] = 'Impossibile trovare turni associati alla squadra';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

	public function __toString() {
		$msg = $this->getData() . ' ' . $this->getCodiceTurno() . ' ' . $this->getCodiceSquadra();
		return $msg;
	}

	/**
	 * Salva il turno nel DB
	 */
	public function save() {
		$db = DB::getInstance();
		/* Salvataggio Turno */
		$queryStr1 = "INSERT INTO " . self::$nomeTabella;
		$queryStr1 .= "(data, codiceSquadra) VALUES ('$this->data', $this->codiceSquadra)";
		try {
			$db->query($queryStr1);
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
//			$msg .= "<p>La query usate: " . $queryStr1 . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			$_SESSION['error'] = 'Impossibile inserire il nuovo turno';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
		/* salvataggio Turno_percorso */
		$turnoID = $db->lastInsertId();

		$temp = array();
		foreach($this->percorsi as $p) {
			$temp[] = "(" . $turnoID . ", " . $p . ")";
		}
		$listaPercorsiNuovi = implode(',', $temp);
		$queryStr2 = "INSERT INTO TURNO_PERCORSO(codiceTurno, codicePercorso) VALUES $listaPercorsiNuovi";

		try {
			$db->query($queryStr2);
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
//			$msg .= "<p>La query usata: " . $queryStr2 . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			$_SESSION['error'] = 'Impossibile inserire i percorsi per il nuovo turno';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

	public function update($vecchiPercorsi) {
		$db = DB::getInstance();
		$queryStr = "UPDATE " . self::$nomeTabella . " SET codiceSquadra='" . $this->getCodiceSquadra() . "', data='" . $this->getData() . "' WHERE codiceTurno=" . $this->getCodiceTurno();
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a salvare il Turno.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			$_SESSION['error'] = 'Impossibile aggiornare la tabella Turni';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}

		$cancellati = array_diff($vecchiPercorsi, $this->getPercorsi());
		if (!empty($cancellati)) {
			$cancellatiStr = implode(',', $cancellati);
			$queryDel = "DELETE FROM TURNO_PERCORSO WHERE codiceTurno=" . $this->getCodiceTurno() . " AND codicePercorso IN ($cancellatiStr)";
			try {
				$db->query($queryDel);
			} catch (DatabaseErrorException $exc) {
				$_SESSION['error'] = 'Impossibile cancellare i vecchi percorsi del turno';
				$r = new Redirect(PUBLIC_URL . '/error.php');
				$r->doRedirect();
			}
		}
		$inseriti = array_diff($this->getPercorsi(), $vecchiPercorsi);

		if (!empty($inseriti)) {
			$temp = array();
			foreach ($inseriti as $p) {
				$temp[] = "(" . $this->getCodiceTurno() . ", " . $p . ")";
			}
			$listaPercorsiNuovi = implode(',', $temp);


			$queryIns = "INSERT INTO TURNO_PERCORSO(codiceTurno, codicePercorso) VALUES $listaPercorsiNuovi";

			try {
				echo $queryIns;
				$db->query($queryIns);
			} catch (DatabaseErrorException $exc) {
				$_SESSION['error'] = 'Impossibile inserire i nuovi percorsi per il turno';
				$r = new Redirect(PUBLIC_URL . '/error.php');
				$r->doRedirect();
			}
		}
	}

	/**
	 * Elimina il turno
	 */
	public function delete() {
		$db = DB::getInstance();
		$queryStr = "DELETE FROM " . self::$nomeTabella . " WHERE codiceTurno=" . $this->codiceTurno;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a cancellare il Turno.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			$_SESSION['error'] = 'Impossibile cancellare il turno';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

	/**
	 * Recupera i percorsi associati al turno
	 * @return <type>
	 */
	public function recuperaPercorsi() {
		$db = DB::getInstance();
		$queryStr = "SELECT codicePercorso ";
		$queryStr .= "FROM TURNO_PERCORSO ";
		$queryStr .= "WHERE codiceTurno=$this->codiceTurno";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_row()) {
				$out[] = $row[0];
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a cancellare il Turno.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			$_SESSION['error'] = 'Impossibile recuperare i percorsi associati al turno';
			$r = new Redirect(PUBLIC_URL . '/error.php');
			$r->doRedirect();
		}
	}

}

?>