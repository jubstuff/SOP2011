<?php

require_once 'DB.php';

/**
 * Description of Sorvegliante
 *
 * @author just
 */
class Sorvegliante {

	private static $nomeTabella = 'Sorveglianti';
	private $matricola;
	private $nome;
	private $cognome;
	private $password;
	private $codiceSquadra;

	public function __construct($nome, $cognome, $matricola='', $password='', $squadra=1) {
		$this->setNome($nome);
		$this->setCognome($cognome);
		$this->setPassword($password);
		$this->setMatricola($matricola);
		$this->setCodiceSquadra($squadra);
	}

	/*
	 * GETTER
	 */

	public function getMatricola() {
		return $this->matricola;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getCognome() {
		return $this->cognome;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getCodiceSquadra() {
		return $this->codiceSquadra;
	}

	/*
	 * SETTER
	 */

	public function setMatricola($matricola) {
		$this->matricola = $matricola;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setCognome($cognome) {
		$this->cognome = $cognome;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setCodiceSquadra($squadra) {
		$this->codiceSquadra = $squadra;
	}

	/**
	 *
	 * @param type $id
	 * @return Sorvegliante L'oggetto sorvegliante relativo alla matricola data 
	 * in ingresso
	 */
	public static function find_by_id($id) {
		$db = DB::getInstance();
		$nomeChiave = 'matricola';
		$queryStr = "SELECT nome,cognome,matricola,password,codiceSquadra FROM ";
		$queryStr .= self::$nomeTabella . " WHERE $nomeChiave=$id";

		try {
			$out = $db->fetchFirst($queryStr);
			$s = new Sorvegliante($out['nome'], $out['cognome'], $out['matricola'],
								 $out['password'], $out['codiceSquadra']);
			return $s;
		} catch (DatabaseErrorException $exc) {
//			$msg = "<p>Errore! Non riesco a trovare il Sorvegliante.</p>";
//			$msg .= "<p>La query usata: " . $queryStr . "</p>";
//			echo $msg;
//			echo '<p>' . $exc->getTraceAsString() . '</p>';
//			exit;
			return '';
		}
	}

	/**
	 *
	 * @return array array contenente matricola,nome e cognome di tutti i sorveglianti 
	 */
	public static function findAll() {
		$db = DB::getInstance();
		$queryStr = "SELECT matricola, nome, cognome FROM Sorveglianti";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = new Sorvegliante($row['nome'], $row['cognome'], $row['matricola']);
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a trovare i Sorveglianti.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	public function __toString() {
		$db = DB::getInstance();
		$msg = $this->getMatricola() . ' ' . $this->getNome() . ' ' . $this->getCognome();
		return $msg;
	}

	public function save() {
		$db = DB::getInstance();
		$queryStr = "INSERT INTO " . self::$nomeTabella;
		$queryStr .= "(nome, cognome, password, codiceSquadra) VALUES ('$this->nome', '$this->cognome', SHA1('$this->password'), $this->codiceSquadra)";
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a salvare il Sorvegliante.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	public function update() {
		$db = DB::getInstance();
		$queryStr = "UPDATE " . self::$nomeTabella . " SET nome='" . $this->nome . "', cognome='" . $this->cognome . "', codiceSquadra='" . $this->codiceSquadra ."' WHERE matricola=" . $this->matricola;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a salvare il Sorvegliante.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

	public function delete() {
		$db = DB::getInstance();
		$queryStr = "DELETE FROM " . self::$nomeTabella . " WHERE matricola=" . $this->matricola;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			$msg = "<p>Errore! Non riesco a cancellare il Sorvegliante.</p>";
			$msg .= "<p>La query usata: " . $queryStr . "</p>";
			echo $msg;
			echo '<p>' . $exc->getTraceAsString() . '</p>';
			exit;
		}
	}

}

?>