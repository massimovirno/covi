<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FCommento - accesso ai dati relativi ai Commenti presenti sul DB
 * ============================================================================
 * loadCommenti($vinoID) - Carica l'array dei commenti relativi al vino $vinoID
 * store($object)        - Menorizza sul DB lo stato dell'oggetto $Commento
 * ============================================================================
 */
class FCommento extends Fdb {
    public function __construct() {
        $this->_table='commento';
        $this->_key='commentoID';
        $this->_auto_increment=true;
        $this->_return_class='ECommento';
        USingleton::getInstance('Fdb');
    }

    /**
     * ========================================================================
     * @name store($object)
     * @param string $object
     * ========================================================================
     * Menorizza sul DB lo stato dell'oggetto $Commento 
     * ========================================================================
     */
    public function store($object){
        $id = parent::store($object);
        $object->id=$id;
    }

    /**
     * ========================================================================
     * @name loadCommenti($vinoID)
     * @param string $vinoID
     * ========================================================================
     * Carica l'array dei commenti relativi al vino $vinoID
     * ========================================================================
     */
    public function loadCommenti($vinoID){
        $parametri=array();
        $parametri[]=array('vinoID_FK','=',$vinoID);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}

?>