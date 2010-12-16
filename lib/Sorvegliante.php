<?php

require 'DB.php';

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

	public function __construct($nome, $cognome, $matricola='', $password='') {
		$this->setNome($nome);
		$this->setCognome($cognome);
		$this->setPassword($password);
		$this->setMatricola($matricola);
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
		$this->password = sha1($password);
	}

	/**
	 *
	 * @param type $id
	 * @return Sorvegliante 
	 */
	public static function find_by_id($id) {
		$db = DB::getInstance();
		$nomeChiave = 'matricola';
		$id = $db->escape($id);
		$queryStr = "SELECT * FROM " . self::$nomeTabella . " WHERE $nomeChiave=$id";

		try {
			$out = $db->fetchFirst($queryStr);
			$s = new Sorvegliante($out['nome'], $out['cognome'], $out['matricola'], $out['password']);
			return $s;
		} catch (DatabaseErrorException $exc) {
			echo '<p>', $queryStr, '</p>';
			echo $exc->getTraceAsString();
		}
	}

	/**
	 *
	 * @return Sorvegliante 
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
			echo $exc->getTraceAsString();
		}
	}

	public function __toString() {
		$db = DB::getInstance();
		$msg = $this->getMatricola() . ' ' . $this->getNome() . ' ' . $this->getCognome();
		return $msg;
	}

	public function save() {
		//@todo validare i dati 
		$db = DB::getInstance();
		$queryStr = "INSERT INTO " . self::$nomeTabella . "(nome, cognome, password) VALUES ('$this->nome', '$this->cognome', SHA1('$this->password'))"; //@todo ricordarsi di modificare SHA1
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			echo $exc->getTraceAsString();
		}
	}

}

?>
