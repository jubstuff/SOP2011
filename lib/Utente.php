<?php

/**
 * Description of Utente
 *
 * @author justb
 */
require_once 'DB.php';

class Utente {

	/**
	 * Controlla se esiste un id utente nella sessione
	 * @return <type>
	 */
	public static function isAuthenticated() {
		if (!isset($_SESSION['user_id'])) {
			return false;
		} else {
			return true;
		}
	}

	public static function getInfo($username) {
		$db = DB::getInstance();
		$cleanUsername = $db->escape($username);
		$queryStr = "SELECT userId, nomeUtente, password, ruolo FROM Utenti WHERE nomeUtente='$cleanUsername'";
		try {
			$out = $db->fetchFirst($queryStr); //@todo validare query
			return $out;
		} catch (DatabaseErrorException $exc) {
			echo "<p>Ci sono stati problemi con la query</p>";
			echo "<p>La query usata</p>";
			echo "<p>$queryStr</p>";
		}
	}

	public static function processLogin($username, $password, $ruolo) {
		if ($ruolo != 'SOR') {
			//recupero info dal db
			$utente = self::getInfo($username);
			$userID = $utente['userId'];
			$passwordCriptata = $utente['password'];
			//@todo controllare anche la corrispondenza del ruolo
			if (sha1($password) != $passwordCriptata) {
				return false;
			} else {
				$_SESSION['user_id'] = $userID;
				return true;
			}
		} else {
			//recupera il sorvegliante
		}
	}

	public static function logOut() {
		unset($_SESSION['user_id']);
	}

	public static function getCurrentUserId() {
		if (self::isAuthenticated()) {
			return $_SESSION['user_id'];
		} else {
			return '';
		}
	}

}

?>
