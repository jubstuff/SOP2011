<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author just
 */
class Validator {
	public function valida_numericita_di(){
		$output = array();
		$all_parameters = func_get_args();
		foreach ($all_parameters as $key => $value) {
			if(!is_numeric($value)) {
				$output[$key] = $value;
			}
		}
		return $output;
	}
}

?>
