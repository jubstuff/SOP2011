<?php

class Myclass {

	private $attr;

	public function __construct($value) {
		$this->attr = $value;
	}

	public function getAttr() {
		return $this->attr;
	}

}

function stampa(array $m) {
	echo $m->getAttr();
}

$my = new Myclass("ciccio");

try {
	stampa("ciccio");
} catch (Exception $e) {
	echo "devi passare un oggetto Myclass alla funzione stampa";
}
?>
