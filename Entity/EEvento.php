<?php

/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class EEvento - oggetto Evento del dominio 
 * ============================================================================
 * setData($data)                   - Imposta la data nel formato AAAA-MM-DD
 * setUtente(EUtente $utente)       - Imposta l'utente
 * removeItem($pos)                 - rimuove l'item nella posizione $pos dell'array
 * getUtente()                      - restituisce l'utente creatore dell'evento
 * getMediaVoti()                   - restituisce la media dei voti
 * getNumeroPartecipanti()          - restituisce il numero dei partecipanti
 * setLocation(ELocation $location) - imposta la location dell'evento
 * getPartecipanti()                - Restituisce un array con i partecipanti
 * ============================================================================
 */
class EEvento {
    
    /**
     * @AttributeType int
     */
    public $eventoID;

    /**
     * @AssociationType Entity.EVino
     * @AssociationMultiplicity 1
     * @AttributeType int
     */
    public $vinoID_FK;

    /**
     * @AssociationType Entity.ELocation
     * @AssociationMultiplicity 1
     * @AttributeType int
     */
    public $locationID_FK;
    /**
     * @AttributeType string
     */
    public $nome;
    
    /**
     * @AttributeType Datetime
     */
    public $data_chiusura; 

    /**
     * @AttributeType int
     */
    public $posti;

    /**
     * @AttributeType string
     */
    public $descBreve;
    
    /**
     * @AttributeType string
     */
    public $descrizione;
    
    /**
     * @AttributeType float
     */
    public $prezzo;

    /**
     * @AttributeType string
     */
    public $foto;  
  
	/**
     * @AttributeType tinyint
     */
    public $pubblicato;
	
    /**
     * @AssociationType Entity.EEventoPartecipante
     * @AssociationMultiplicity 1..*
     * @AssociationKind Aggregation
     */
    public $_partecipante = array();
    
    /**
     * @AssociationType Entity.ECommento
     * @AssociationMultiplicity 0..*
     * @AssociationKind Aggregation
     */
    // DA IMPLEMENTARE
    //public $_commento = array();
 	
    // METODI 
    // RIVEDERE
    
    /**
     * ========================================================================
     * @name setData($data)
     * @param string $data 
     * ========================================================================
     * Imposta la data nel formato AAAA-MM-DD
     * ========================================================================
     */
public function setData($data) {
        $anno=substr($data, 6);
        $mese=substr($data, 3, 2);
        $giorno=substr($data, 0, 2);
        $this->data="$anno-$mese-$giorno";
    }
    
    /**
     * ========================================================================
     * @name setUtente(EUtente $utente)
     * @param EUtente $utente 
     * ========================================================================
     * Imposta l'utente
     * ========================================================================
     */
    public function setUtente(EUtente $utente) {
        $this->_utente=$utente;
    }
    
    /**
     * ========================================================================
     * @name removeItem($pos)
     * @param int $pos
     * ========================================================================
     * rimuove l'item nella posizione $pos dell'array
     * ========================================================================
     */
    public function removeItem($pos) {
        unset($this->_item[$pos]);
        $this->_item=array_values($this->_item);
    }
    
    /**
     * ========================================================================
     * @name getUtente()
     * @return EUtente
     * ========================================================================
     * restituisce l'utente creatore dell'evento
     * ========================================================================
     */
    public function getUtente() {
        return $this->_utente;
    }
    
    /**
     * ========================================================================
     * @name getMediaVoti()
     * @return float $somma
     * ========================================================================
     * restituisce la media dei voti
     * ========================================================================
     */
    public function getMediaVoti() {
        $somma=0;
		// FINTA!
        return $somma;
    }
	
    /**
     * ========================================================================
     * @name getNumeroPartecipanti()
     * @return int $totale
     * ========================================================================
     * Restituisce il numero di partecipanti per evento
     * ========================================================================
     */
    public function getNumeroPartecipanti() {
        $totale=0;
        $partecipanti=count($this->_partecipante);
        if ($partecipanti > 1) {
            foreach ($this->partecipante as $partecipante) {
                $totale++;
            }
            return $totale;
        }
        //elseif (isset($this->_commento[0]->voto))
        //    return $this->_commento[0]->voto;
        else {
            return false;
        }
    }
	 
    /**
     * ========================================================================
     * @name setLocation(ELocation $location)
     * @param ELocation $location
     * ========================================================================
     * imposta la location dell'evento
     * ========================================================================
     */
    public function setLocation(ELocation $location) {
        $this->_location=$location;
    }
    
    /**
     * ========================================================================
     * @name getPartecipanti()
     * @return array
     * ========================================================================
     * Restituisce un array con i partecipanti
     * ========================================================================
     */
    public function getPartecipanti() {
        return ($this->_partecipante);
    }	
}
?>