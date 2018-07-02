<?php
/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class ECommento - oggetto Commento del dominio 
 * ============================================================================
 */
class ECommento {
    
    /**
     * @AttributeType int
     */
    public $commentoID ;

    /**
     * @AssociationType Entity.EVino
     * @AssociationMultiplicity 1
     * @AttributeType int
     */
    public $vinoID_FK;

    /**
     * @AttributeType string
     */
    public $testo;

    /**
     * @AttributeType float
     */
    public $voto;

}
?>