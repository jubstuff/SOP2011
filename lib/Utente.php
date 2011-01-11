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

	public static function getInfo($username){
		$db = DB::getInstance();
		$queryStr = "SELECT * FROM Credenziali WHERE nomeUtente='$username'";
		return $db->fetchFirst($queryStr); //@todo validare query
	}

	public static function isValid($username, $password) {
		$utente = self::getInfo($username);

		$userID = $utente['nomeUtente'];
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
