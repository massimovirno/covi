<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FUtente - accesso ai dati relativi agli Utenti presenti sul DB
 * ============================================================================
 */
class FUtente extends Fdb{
    public function __construct() {
        $this->_table='utente';
        $this->_key='username';
        $this->_return_class='EUtente';
        USingleton::getInstance('Fdb');
    }
}
?>
