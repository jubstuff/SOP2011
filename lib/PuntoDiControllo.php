<?php

require 'DB.php';

/**
 * Description of PuntoDiControllo
 *
 * @author Francesco Paolo Cimmino <fpcimmino@gmail.com>
 */
class PuntoDiControllo {

	private static $nomeTabella = 'PuntiDiControllo';
	private $codicePC;
	private $indirizzo;
	private $latitudine;
	private $longitudine;
	private $idTag;
	private $codiceCliente;

	public function __construct($codicePC, $indirizzo, $latitudine, $longitudine, $idTag, $codiceCliente) {
		$this->setCodicePC($codicePC);
		$this->setIndirizzo($indirizzo);
		$this->setLatitudine($latitudine);
		$this->setLongitudine($longitudine);
		$this->setIdTag($idTag);
		$this->setCodiceCliente($codiceCliente);
	}

	/*
	 * GETTER
	 */

	public function getLongitudine() {
		return $this->longitudine;
	}

	public function getCodicePC() {
		return $this->codicePC;
	}

	public function getIndirizzo() {
		return $this->indirizzo;
	}

	public function getLatitudine() {
		return $this->latitudine;
	}
	
	public function getIdTag() {
		return $this->idTag;
	}

	public function getCodiceCliente() {
		return $this->codiceCliente;
	}

	/*
	 * SETTER
	 */

	public function setLongitudine($longitudine) {
			$this->longitudine = $longitudine;
	}

	public function setCodicePC($codicePC) {
		$this->codicePC = $codicePC;
	}

	public function setIndirizzo($indirizzo) {
		$this->indirizzo = $indirizzo;
	}

	public function setLatitudine($latitudine) {
		$this->latitudine = $latitudine;
	}
	
	public function setIdTag($idTag) {
		$this->idTag = $idTag;
	}

	public function setCodiceCliente($codiceCliente) {
		$this->codiceCliente = $codiceCliente;
	}

	/**
	 *
	 * @param type $id
	 * @return Sorvegliante 
	 */
	public static function find_by_id($id) {
		$db = DB::getInstance();
		$nomeChiave = 'codicePC';
		$queryStr = "SELECT * FROM " . self::$nomeTabella . " WHERE $nomeChiave=$id";

		try {
			$out = $db->fetchFirst($queryStr);
			$s = new PuntoDiControllo($out['codicePC'], $out['indirizzo'], $out['latitudine'], $out['longitudine'], $out['idTag'], $out['codiceCliente']);
			return $s;
		} catch (DatabaseErrorException $exc) {
			echo '<p>', $queryStr, '</p>';
			echo $exc->getTraceAsString();
		}
	}

	/**
	 *
	 * @return PuntoDiControllo 
	 */
	public static function findAll() {
		$db = DB::getInstance();
		 $queryStr = "SELECT codicePC, indirizzo, latitudine, longitudine, idTag, C.nomeCliente ";
		 $queryStr .= "FROM PuntiDiControllo P JOIN Clienti C ON(P.codiceCliente = C.codiceCliente)";
		 //$queryStr = "SELECT codicePC, indirizzo, latitudine, longitudine, idTag, codiceCliente FROM PuntiDiControllo";
		try {
			$result = $db->query($queryStr);
			$out = array();
			while ($row = $result->fetch_assoc()) {
				$out[] = new PuntoDiControllo($row['codicePC'], $row['indirizzo'], $row['latitudine'], $row['longitudine'], $row['idTag'], $row['nomeCliente']);
			}
			return $out;
		} catch (DatabaseErrorException $exc) {
			echo $exc->getTraceAsString();
		}
	}

	public function __toString() {
		$db = DB::getInstance();
		$msg = $this->getcodicePC() . ' ' . $this->getIndirizzo() . ' ' . $this->getLatitudine . ' ' . $this->getLongitudine . ' ' . $this->getIdTag;
		return $msg;
	}

	public function save() {
		//@todo validare i dati 
		$db = DB::getInstance();
		$queryStr = "INSERT INTO " . self::$nomeTabella . "(indirizzo, latitudine, longitudine, idTag, codiceCliente) 
		             VALUES ('$this->indirizzo', '$this->latitudine', '$this->longitudine', '$this->idTag', '$this->codiceCliente')"; //@todo ricordarsi di modificare SHA1
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			echo $exc->getTraceAsString();
		}
	}

	public function update() {
		$db = DB::getInstance();
		$queryStr = "UPDATE ".self::$nomeTabella." ";
		$queryStr .= "SET indirizzo='".$this->indirizzo."', latitudine=".$this->latitudine.", longitudine=".$this->longitudine.", idTag=".$this->idTag.", codiceCliente=".$this->codiceCliente." ";
		$queryStr .= "WHERE codicePC=".$this->codicePC;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			echo "Update fallito<br>";
			echo "La query che hai eseguito: " . $queryStr;
			//echo $exc->getTraceAsString();
		}
	}

	public function delete(){
		$db = DB::getInstance();
		$queryStr = "DELETE FROM " . self::$nomeTabella . " WHERE codicePC=". $this->codicePC;
		try {
			$db->query($queryStr);
		} catch (DatabaseErrorException $exc) {
			echo $queryStr;
			//echo $exc->getTraceAsString();
		}
	}

}

?>
