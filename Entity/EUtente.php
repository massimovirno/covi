<?php

/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class EUtente - oggetto EUtente del dominio 
 * ============================================================================
 * generaCodiceAttivazione()   - Genera Codice di Attivazione
 * addEvento(EEvento $aEvento) - Aggiunge Evento al DB
 * getEventi()                 - Restituisce un array con gli eventi memorizzati 
 *                               sul DB
 * getAccountAttivo()          - verifica lo stato di un utente
 * getCodiceAttivazione()      - Restituisce il codice di attivazione di un utente
 * ============================================================================
 */
class EUtente {
    
    /**
     * @AttributeType string
     */
    public $username;
    
    /**
     * @AttributeType string
     */
    public $password;
    
    /**
     * @AttributeType string
     */
    public $nome;

    /**
     * @AttributeType string
     */
    public $cognome;

    /**
     * @AttributeType string
     */
    public $via;
    
    /**
     * @AttributeType string
     */
    public $CAP;
    
    /**
     * @AttributeType string
     */
    public $citta;
    
    /**
     * @AttributeType string
     */
    public $email;
    
    /**
     * @AttributeType string
     */
    public $sesso;
	
    /**
     * @AttributeType datetime
     */
    public $data_nascita;
	
    /**
     * @AttributeType string
     */
    public $codice_fiscale;

    /**
     * @AttributeType string
     */
    public $telefono;
  
    /**
     * @AttributeType string
     */
    public $codice_attivazione;
    
    /**
     * @AttributeType string
     */
    public $stato='non_attivo';
    
    /**
     * @AssociationType Entity.EEvento
     * @AssociationMultiplicity 0..*
     * @AssociationKind Aggregation
     */
    public $_eventi = array();
    
    /**
     * ========================================================================
     * @name generaCodiceAttivazione()
     * @return float
     * ========================================================================
     * Genera Codice di Attivazione
     * ========================================================================
     */
    public function generaCodiceAttivazione() {
        $this->codice_attivazione=mt_rand();
    }

    /**
     * ========================================================================
     * @name addEvento(EEvento $aEvento)
     * @param EEvento $aEvento
     * ========================================================================
     * Aggiunge Evento al DB
     * ========================================================================
     */
    public function addEvento(EEvento $aEvento) {
        $this->_eventi[]=$aEvento;
    }

    /**
     * ========================================================================
     * @name getEventi()
     * @return array
     * ========================================================================
     * Restituisce un array con gli eventi memorizzati sul DB
     * ========================================================================
     */
    public function getEventi() {
        return $this->_eventi;
    }
    
    /**
     * ========================================================================
     * @name getAccountAttivo()
     * @return boolean
     * ========================================================================
     * verifica lo stato di un utente
     * ========================================================================
     */
    public function getAccountAttivo() {
        if ($this->stato == 'attivo') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * ========================================================================
     * @name getCodiceAttivazione()
     * @return string
     * ========================================================================
     * Restituisce il codice di attivazione di un utente
     * ========================================================================
     */
    public function getCodiceAttivazione() {
        return $this->codice_attivazione;
    }
}

?>