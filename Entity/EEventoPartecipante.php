<?php

/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class EEventoPartecipante - oggetto EEventoPartecipante del dominio 
 * ============================================================================
 * getPartecipante()           - Restituisce un array con i partecipanti
 * setEventoID(Int $id_evento) - Imposta l'ID dell'evento
 * setPartecipante($username)  - Imposta un partecipante
 * ============================================================================
 */
class EEventoPartecipante {
    
    /** 
     * @AttributeType int
     */
    public $eventoPartecipanteID;
    
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     * @AttributeType string
     */
    public $username_FK;
    
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     * @AttributeType string
     */
    public $numero_pagamento_FK;

    /**
     * @AssociationType Entity.EEvento
     * @AssociationMultiplicity 1
     * @AttributeType int
     */
    public $eventoID_FK;
       
    /**
     * @AttributeType tinyint
     */
    public $pagato;
    
    /**
     * ========================================================================
     * @name setPartecipante($username)
     * @param String $username 
     * ========================================================================
     * Imposta un partecipante
     * ========================================================================
     */
    public function setPartecipante($username) {
        $this->_partecipante=$username;
    }
    
    /**
     * ========================================================================
     * @name getPartecipante()
     * @return string $data 
     * ========================================================================
     * Restituisce un array con i partecipanti
     * ========================================================================
     */
    public function getPartecipante() {
        return $this->_partecipante;
    }
	
    /**
     * ========================================================================
     * @name setEventoID(Int $id_evento)
     * @param int Id_evento
     * ========================================================================
     * Imposta l'ID dell'evento
     * ========================================================================
     */
    public function setEventoID(Int $id_evento) {
        $this->_eventoID=$id_evento;
    }		
}
?>