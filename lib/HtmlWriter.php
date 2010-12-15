<?php
/**
 * Description of HtmlWriter
 *
 * @author just
 */
class HtmlWriter {
   public function doctype($type = 'html5'){
      switch ($type) {
         case 'html5':
            $doctype = '<!doctype html>';
            break;
         case 'xhtml_strict':
            $doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" '.
            '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
            break;
         default:
            $doctype = '<!doctype html>';
            break;
      }
      
   }
}

?>
