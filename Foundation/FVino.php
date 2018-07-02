<?php
/**
 * ============================================================================
 * @access public
 * @package Foundation
 * ============================================================================
 * Class FVino - accesso ai dati relativi ai Vini presenti sul DB
 * ============================================================================
 * store($vino)    - Menorizza sul DB l'oggetto $vino ed i commenti
 * load($key)      - Carica dal DB lo stato dell'oggetto $vino
 * delete(& $vino) - Cancella dal DB l'oggetto $vino
 * ============================================================================
 */
class FVino extends Fdb {
    public function __construct() {
        $this->_table='vino';
        $this->_key='vinoID';
        $this->_return_class='EVino';
        USingleton::getInstance('Fdb');
    }
    
    /**
     * ========================================================================
     * @name store($vino)
     * @param $vino
     * ========================================================================
     * Menorizza sul DB l'oggetto $vino ed i commenti
     * ========================================================================
     */
    public function store($vino) {
        parent::store($vino);
        $FCommento=new FCommento();
        $arrayCommentiEsistenti=$FCommento->loadCommenti($vino->vinoID);
        if ($arrayCommentiEsistenti!=false) {
            foreach ($arrayCommentiEsistenti as $itemCommento) {
                $FCommento->delete($itemCommento);
            }
        }
        $arrayCommenti=$vino->getCommenti();
        foreach ($arrayCommenti as &$commento) {
            $commento->vinoID=$vino->vinoID;
            $FCommento->store($commento);
        }
    }
    
    /**
     * ========================================================================
     * @name load($key)
     * @param $key
     * @return $vino
     * ========================================================================
     * Carica dal DB lo stato dell'oggetto $vino
     * ========================================================================
     */
    public function load($key) {
        $vino=parent::load($key);
        $FCommento=new FCommento();
        $arrayCommenti=$FCommento->loadCommenti($vino->vinoID);
        $vino->_commento=$arrayCommenti;
        return $vino;
    }

    /**
     * ========================================================================
     * @name delete(& $vino)
     * @param $vino
     * ========================================================================
     * Cancella dal DB l'oggetto $vino
     * ========================================================================
     */
    public function delete(& $vino) {
        $arrayCommenti=& $vino->getCommenti();
        $FCommento= new FCommento();
        foreach ($arrayCommenti as &$commento) {
            $FCommento->delete($commento);
        }
        parent::delete($vino);
    }
}
?>