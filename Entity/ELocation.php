<?php
/**
 * ============================================================================
 * @access public
 * @package Entity
 * ============================================================================
 * Class ELocation - oggetto ELocation del dominio 
 * ============================================================================
 */
class ELocation {

    /**
     * @AttributeType int
     */
    public $locationID;
	
    /**
     * @@AttributeType string
     */
    public $nome_location;

    /**
     * @@AttributeType string
     */
    public $via_location;

    /**
     * @@AttributeType string
     */
    public $CAP_location;

    /**
     * @@AttributeType string
     */
    public $citta_location;
    
    /**
     * @@AttributeType string
     */
    public $email_location;

    /**
     * @@AttributeType string
     */
    public $telefono_location;
}
?>