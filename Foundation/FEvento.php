    <?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FEvento - accesso ai dati relativi agli Eventi presenti sul DB
 * ============================================================================
 * store($evento)        - Menorizza sul DB lo stato dell'oggetto $evento
 * load($key)            - Carica dal DB un $evento
 * ============================================================================
 */
class FEvento extends Fdb{
    public function __construct() {
        $this->_table='evento';
        $this->_key='eventoID';
        $this->_auto_increment=true;
        $this->_return_class='EEvento';
        USingleton::getInstance('Fdb');
    }
    
    /**
     * ========================================================================
     * @name store($evento)
     * @param string $evento
     * ========================================================================
     * Menorizza sul DB lo stato dell'oggetto $evento
     * ========================================================================
     */
    public function store($evento){
        //Location		
	//$FLocation=new FLocation();
        //$FLocation->store($evento->_location);		
        //$evento->locationID=$evento->_location->id;
        $evento->utente=$evento->_utente->username;	
		
        //Partecipanti
        /*
        $FEventoPartecipante=new FEventoPartecipante();
        $id = parent::store($evento);
        foreach ($evento->_partecipante as &$partecipante){
            $partecipante->eventoID=$id;
            $FEventoPartecipante->store($partecipante);
        }		
        $evento->id=$id;
	*/   
	}

    /**
     * ========================================================================
     * @name load($key)
     * @param string $key
     * @return string $evento
     * ========================================================================
     * Carica dal DB un evento $evento
     * ========================================================================
     */
    public function load($key){
        $evento=parent::load($key);
        //$FUtente=new FUtente();
        //$utente=$FUtente->load($evento->utente);
        //$evento->setUtente($utente);

        //$FLocation=new FLocation();
        //$location=$FLocation->load($evento->locationID);
        //$evento->setLocation($location);
        //$id = parent::store($evento);
        //$evento->id=$id;
        return $evento;
    }
}

?>
