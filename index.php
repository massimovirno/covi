<?php
/*
 * ============================================================================
 * @access public
 * ============================================================================
 * index.php
 * ============================================================================
 */

//la funzione __autoload() è richiamata automaticamente se si cerca di 
//utilzzare una classe o una interfaccia non ancora definita
require_once 'includes/autoload.inc.php';

//imposta le variabili per l'applicazione
require_once 'includes/config.inc.php';

// Installazione automatica
if (file_exists("installer.php"))
    header("location: installer.php");

//ricava l'istanza univoca dell'oggetto CHome
$CHome=USingleton::getInstance('CHome');

//Imposta la pagina Home e smista la richiesta ad un controller
$CHome->impostaPagina();
?>