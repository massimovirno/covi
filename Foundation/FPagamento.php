<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FPagamento - accesso ai dati relativi ai Pagamenti presenti sul DB
 * ============================================================================
 * store($object) - Menorizza sul DB lo stato dell'oggetto FLocation
 * ============================================================================
 */
class FPagamento extends Fdb{
    public function __construct() {
        $this->_table='pagamento';
        $this->_key='numero_pagaamento';
        $this->_return_class='EPagamento';
        USingleton::getInstance('Fdb');
    }

    /**
     * ========================================================================
     * @name store($carta)
     * @param string $carta
     * ========================================================================
     * Menorizza sul DB lo stato dell'oggetto FPagamento
     * ========================================================================
     */
    public function store($carta){
        parent::store($carta);
    }	
}
?>