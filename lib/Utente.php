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
    public static function isAuthenticated(){
		if(!isset($_SESSION['user_id'])) {
			return false;
		} else {
			return true;
		}
	}

	public static function getInfo($userId){
		$db = DB::getInstance();
		$cleanUserId = $db->escape($userId);
		$queryStr = "SELECT userId, nomeUtente, password, ruolo FROM Utenti WHERE userId=$cleanUserId";
		return $db->fetchFirst($queryStr); //@todo validare query
	}

	public static function processLogin($username, $password) {
		$utente = self::getInfo($username);

		$userID = $utente['userId'];
		$passwordCriptata = $utente['password'];
		if(sha1($password) != $passwordCriptata) {
			return false;
		} else {
			$_SESSION['user_id'] = $userID;
			return true;
		}
	}

	public static function logOut() {
		unset($_SESSION['user_id']);
	}

	public static function getCurrentUserId() {
		if(self::isAuthenticated()) {
			return $_SESSION['user_id'];
		} else {
			return false;
		}
	}


}
?>
