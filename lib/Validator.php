<?php

/**
 * Validator
 * Presa una richiesta HTTP in ingresso permette di validarla
 *
 * @author just
 */
class Validator {
	/**
	 *
	 * @var array La richiesta ($_POST o $_GET) iniziale
	 */
	private $rawRequest;
	/**
	 *
	 * @var array La richiesta con i campi validati
	 */
	private $cleanRequest;
	/**
	 *
	 * @var array Elenco di errori da mostrare
	 */
	private $errors;

	public function __construct(array $request) {
		$this->rawRequest = $request;
		$this->cleanRequest = array();
		$this->errors = array();
	}

	public function addError($error) {
		$this->errors[] = $error;
	}

	public function getError() {
		return $this->errors;
	}

	public function addClean($key, $value) {
		$this->cleanRequest[$key] = $value;
	}

	public function getClean() {
		return $this->cleanRequest;
	}

	public function isAlnum($key, $msg='') {
		if ( isset ($this->rawRequest[$key]) && ctype_alnum($this->rawRequest[$key]) ) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			if(!strlen($msg)) {
				$msg = "Il campo $key deve essere alfanumerico";
			}
			$this->addError($msg);
			return FALSE;
		}
	}

	public function isNumeric($key, $msg='') {
		if ( isset ($this->rawRequest[$key]) && is_numeric($this->rawRequest[$key]) ) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			if(!strlen($msg)) {
				$msg = "Il campo $key deve essere numerico";
			}
			$this->addError($msg);
			return FALSE;
		}
	}

	public function isNotEmpty($key, $msg='') {
		if ( isset($this->rawRequest[$key]) && strlen(trim($this->rawRequest[$key])) ) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			if(!strlen($msg)) {
				$msg = "Il campo $key è obbligatorio";
			}
			$this->addError($msg);
			return FALSE;
		}
	}

	public function isEqual($key, $value, $msg='') {
		if(isset($this->rawRequest[$key]) && ($this->rawRequest[$key] == $value)) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			if(!strlen($msg)) {
				$msg = "Il campo $key deve essere uguale a $value";
			}
			$this->addError($msg);
			return FALSE;
		}
	}
	/**
	 * 
	 * 
	 * @return mixed 
	 */
	public function valida_numericita_di() {
		$output = array();
		$all_parameters = func_get_args();
		foreach ($all_parameters as $key => $value) {
			if ( !is_numeric($value) ) {
				$output[$key] = $value;
			}
		}
		return $output;
	}

}

/*
 * Per validare i campi richiesti usiamo isset e strlen
 * Esempio
 * 
 * if( !isset($_POST['var']) && strlen($_POST['var]) )
 * 		echo 'devi inserire var';
 * 
 * Per validare input che viene mostrato a video usare
 * htmlentities($string, ENT_QUOTES, 'UTF-8')
 * Il secondo parametro dice che deve convertire in entità sia le virgolette
 * doppie che le singole.
 * 
 */
?>
