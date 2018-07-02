<?php
/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class EVino - oggetto EVino del dominio 
 * ============================================================================
 * generaCodiceAttivazione()   - Genera Codice di Attivazione
 * addEvento(EEvento $aEvento) - Aggiunge Evento al DB
 * getEventi()                 - Restituisce un array con gli eventi memorizzati 
 *                               sul DB
 * getAccountAttivo()          - verifica lo stato di un utente
 * getCodiceAttivazione()      - Restituisce il codice di attivazione di un utente
 * ============================================================================
 */
class EVino {
    /**
     * @AttributeType int
     */
    public $vinoID;
    
    /**
     * @AttributeType string
     */
    public $nome;
   
    /**
     * @AttributeType string
     */
    public $produttore;
    
    /**
     * @AttributeType string
     */
    public $denominazione;
    
    /**
     * @AttributeType string
     */
    public $paese;
    
    /**
     * @AttributeType string
     */
    public $regione;
    
    /**
     * @AttributeType string
     */
    public $descrizione;
    
    /**
     * @AttributeType string
     */
    public $vitigno;

    /**
     * @AttributeType int
     */
    public $annata;

    /**
     * @AttributeType float
     */
    public $grado;

    /**
     * @AttributeType float
     */
    public $volume;

    /**
     * @AttributeType string
     */
    public $colore;
	
    /**
     * @AttributeType string
     */
    public $noteSensoriali;

    /**
     * @AttributeType int
     */
    public $temperaturaServizio;

    /**
     * @AttributeType float
     */
    public $prezzo;	
    
    /**
     * @AttributeType string
     */
    public $etichetta;
    
    /**
     * @AssociationType Entity.ECommento
     * @AssociationMultiplicity 0..*
     * @AssociationKind Aggregation
     */
    public $_commento = array();

    /**
     * ========================================================================
     * @name addCommento(ECommento $commento)
     * @param ECommento $commento
     * ========================================================================
     * Aggiunge un commento all'array di commenti relativi al vino
     * ========================================================================
     */
    public function addCommento(ECommento $commento) {
        array_push($this->_commento, $commento);
    }
    
    /**
     * ========================================================================
     * @name getMediaVoti()
     * @return mixed
     * ========================================================================
     * Restituisce la media dei voti per il vino
     * ========================================================================
     */
    public function getMediaVoti() {
        $somma=0;
        $voti=count($this->_commento);
        if ($voti>1) {
            foreach ($this->_commento as $commento) {
                $somma+=$commento->voto;
            }
            return $somma/$voti;
        }
        elseif (isset($this->_commento[0]->voto)) {
            return $this->_commento[0]->voto;
        } else {
            return false;
        }
    }

    /**
     * ========================================================================
     * @name getCommenti()
     * @return array
     * ========================================================================
     * Restituisce un array di commenti relativi al vino
     * ========================================================================
     */
    public function getCommenti() {
        return ($this->_commento);
    }

    /**
     * ========================================================================
     * @name getNome()
     * @return string
     * ========================================================================
     * Restituisce nome del vino
     * ========================================================================
     */
    public function getNome() {
        return ($this->_nome);
    }
	}
?>