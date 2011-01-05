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

function stampa(Myclass $m) {
	echo $m->getAttr();
}

$my = new Myclass("ciccio");
stampa('3,5');
?>
