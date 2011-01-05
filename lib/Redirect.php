<?php
/**
 * Description of Redirect
 *
 * @author just
 */
class Redirect {
	private $url;
	
	public function __construct($url) {
		$this->url = $url;
	}
	
	public function doRedirect() {
		header("Location: $this->url");
		exit;
	}
}

?>
