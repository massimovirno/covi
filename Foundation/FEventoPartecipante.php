<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FEventoPartecipante - accesso ai dati relativi agli FEventoPartecipante
 *                             presenti sul DB
 * ============================================================================
 * store(EEventoPartecipante & $item)- Menorizza sul DB lo stato dell'oggetto 
 *                                     EEventoPartecipante
 * ============================================================================
 */
class FEventoPartecipante extends Fdb {
    public function __construct() {
        $this->_table='eventoPartecipante';
        $this->_key='eventoPartecipanteID';
        $this->_auto_increment=true;
        $this->_return_class='EEventoPartecipante';
        USingleton::getInstance('Fdb');
    }
     
    /**
     * ========================================================================
     * @name store(EEventoPartecipante & $item)
     * @param EEventoPartecipante
     * @param string $item
     * ========================================================================
     * Menorizza sul DB lo stato dell'oggetto EEventoPartecipante
     * ========================================================================
     */
    public function store(EEventoPartecipante & $item) {
            
        // Event ID
        
        // Utente 
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        $item->partecipante=$username;
        
        // Pagato
        $item->pagato=1;
        
        $id = parent::store($item);
        $item->id=$id;
    }
}

?>
