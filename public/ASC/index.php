<?php 
require_once 'autenticazione.php';
require_once 'config.php';

$pageTitle = "Amministra Sorveglianti e Clienti" ?>
<?php include HELPERS_DIR . '/testata.php'; ?>
      <h1>SOP 2011</h1>
      <p>Cosa vuoi fare?</p>
      <ul>
         <li><a href="sorveglianti/">Amministrare sorveglianti</a></li>
         <li><a href="">Amministrare Clienti </a><span class="nonDisp">Non disponibile</span></li>
		 <li><a href="">Amministra punti di controllo</a><span class="nonDisp">Non disponibile</span></li>
      </ul>
<?php include  HELPERS_DIR . '/piepagina.php'; ?>