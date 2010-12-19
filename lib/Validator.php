<?php

/**
 * Description of Validator
 *
 * @author just
 */
class Validator {

	private $rawRequest;
	private $cleanRequest;
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

	public function isAlnum($key) {
		if (ctype_alnum($this->rawRequest[$key])) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			$this->addError("Il campo $key deve essere alfanumerico");
			return FALSE;
		}
	}

	public function isNumeric($key) {
		if (is_numeric($this->rawRequest[$key])) {
			$this->addClean($key, $this->rawRequest[$key]);
			return TRUE;
		} else {
			$this->addError("Il campo $key deve essere numerico");
			return FALSE;
		}
	}

	public function isEmpty($var) {
		$var = trim($var);
		if ($var == '') {
			return TRUE;
		}
		return FALSE;
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
			if (!is_numeric($value)) {
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
