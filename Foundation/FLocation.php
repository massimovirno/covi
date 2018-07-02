<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FLocation - accesso ai dati relativi alle Location presenti sul DB
 * ============================================================================
 * store($object) - Menorizza sul DB lo stato dell'oggetto FLocation
 * ============================================================================
 */
class FLocation extends Fdb {
    public function __construct() {
        $this->_table='location';
        $this->_key='locationID';
        $this->_auto_increment=true;
        $this->_return_class='ELocation';
            USingleton::getInstance('Fdb');
    }

    /**
     * ========================================================================
     * @name store($object)
     * @param string $object
     * ========================================================================
     * Menorizza sul DB lo stato dell'oggetto FLocartion
     * ========================================================================
     */
    public function store($object){
        $id = parent::store($object);
        $object->id=$id;
    }
}
?>
