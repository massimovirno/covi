<?php
/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class EPagamento - oggetto EPagamento del dominio 
 * ============================================================================
 * eScaduta() - Controlla se la carta di credito e' scaduta
 * ============================================================================
 */
class EPagamento {

    /**
     * @AttributeType string
     */
    public $numero_pagamento;

    /**
     * @AttributeType string
     */
    public $nome_titolare;

    /**
     * @AttributeType string
     */
    public $cognome_titolare;

    /**
     * @AttributeType string
     */
    public $cartacredito_numero;

    /**
     * @AttributeType datetime
     */
    public $data_scadenza;

    /**
     * @AttributeType string
     */
    public $ccv;

    /**
     * @AttributeType float
     */
    public $importo;

    /**
     * @AttributeType string
     */
    public $tipo_pagamento='contanti';
    
    /**
     * ========================================================================
     * @name eScaduta()
     * @return boolean
     * ========================================================================
     * Controlla se la carta di credito e' scaduta
     * ========================================================================
     */
    public function eScaduta() {
        $date2 = time();
        $dateArr = explode("-",$this->data_scadenza);
        $date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
        if (($date1Int - $date2) < 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Imposta la data di scadenza nel formato AAAA-MM-DD
     * @access public
     * @param $data DateTime
     */
    /**
     * ========================================================================
     * @name setDataScadenza($data)
     * @param string $data
     * ========================================================================
     * Controlla se la carta di credito e' scaduta
     * ========================================================================
     */
    public function setDataScadenza($data) {
        $anno='20'.substr($data, 3);
        $mese=substr($data, 0, 2);
        $giorno='01';
        $this->data_scadenza="$anno-$mese-$giorno";
    }
}
?>