<?php
/**
 * Description of DatabaseErrorException
 *
 * @author just
 */
class DatabaseErrorException extends Exception {
	public function __construct($message, $code=0) {
		parent::__construct($message, $code);
	}
}

?>
