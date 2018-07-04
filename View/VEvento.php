<?php
/**
 * ============================================================================
 * @access public
 * @package view
 * ============================================================================
 * Class VEvento -  estende la classe view del package System e gestisce la 
 *                  visualizzazione e formattazione del sito, inoltre imposta i 
 *                  principali contenuti della pagina, suddivisi in contenuti 
 *                  principali (main_content) e contenuti della barra laterale 
 *                  (side_content)
 * ============================================================================
 * getPage()                - restituisce il numero della pagina (utilizzato 
 *                            nella visualizzazione dei vini) passato per GET o 
 *                            POST
 * processaTemplate()       - Processa il layout scelto nella variabile _layout
 * impostaDati($key,$valore)- restituisce il Task da eseguirsi passata tramite 
 *                            GET o POST
 * getCommento()            - Restituisce il commento
 * getIdEvento()            - Ritorna l'id del libro passato tramite GET o POST
 * getTask()                - restituisce il Task da eseguirsi passata tramite 
 *                            GET o POST
 * getVoto()                - restituisce il voto passato tramite GET o POST
 * getDatiPagamento()       - restituisce i dati relativi alla carta di credito
 * setLayout($layout)       - imposta il layout
 * ============================================================================
 */
class VEvento extends View {
    /**
     * @var string _layout
     */
    private $_layout='default';

    /**
     * ========================================================================
     * @name getPage()
     * @return mixed
     * ========================================================================
     * restituisce il numero della pagina (utilizzato nella visualizzazione 
     * dei vini) passato per GET o POST
     * ========================================================================
     */
    public function getPage() {
        if (isset($_REQUEST['page'])) {
            return $_REQUEST['page'];
        } else {
            return 0;
        }
    }
    
    /**
     * ========================================================================
     * @name processaTemplate()
     * @return string
     * ========================================================================
     * Processa il layout scelto nella variabile _layout
     * ========================================================================
     */
    public function processaTemplate() {
        return $this->fetch('evento_'.$this->_layout.'.tpl');
    }

    /**
    /**
     * ========================================================================
     * @name impostaDati($key,$valore)
     * @param string $key
     * @param mixed  $valore
     * ========================================================================
     * Imposta i dati nel template identificati da una chiave ed il relativo 
     * valore
     * ========================================================================
     */
    public function impostaDati($key,$valore) {
        $this->assign($key,$valore);
    }

    /**
     * ========================================================================
     * @name getIdEvento()
     * @return mixed
     * ========================================================================
     * Ritorna l'id del libro passato tramite GET o POST
     * ========================================================================
     */
    public function getIdEvento() {
        if (isset($_REQUEST['eventoID'])) {
            return $_REQUEST['eventoID'];
        } else {
            return false;
        }
    }

    /**
     * ========================================================================
     * @name setLayout($layout)
     * @param string $layout
     * ========================================================================
     * imposta il layout
     * ========================================================================
     */
    public function setLayout($layout) {
        $this->_layout=$layout;
    }

    /**
     * ========================================================================
     * @name getVoto()
     * @param mixed
     * ========================================================================
     * restituisce il voto passato tramite GET o POST
     * ========================================================================
     */
    public function getVoto() {
        if (isset($_REQUEST['voto'])) {
            return $_REQUEST['voto'];
        } else {
            return false;
        }
    }
    
    /**
     * ========================================================================
     * @name getController()
     * @return mixed
     * ========================================================================
     * Restituisce il controller passato tramite richiesta GET o POST
     * ========================================================================
     */
    public function getController() {
        if (isset($_REQUEST['controller'])) {
            return $_REQUEST['controller'];
        } else {
            return false;
        }
    }

    /**
     * ========================================================================
     * @name getTask()
     * @param mixed
     * ========================================================================
     * restituisce il Task da eseguirsi passato tramite GET o POST
     * ========================================================================
     */
    public function getTask() {
            if (isset($_REQUEST['task'])) {
            return $_REQUEST['task'];
        } else {
            return false;
        }
    }

    /**
     * ========================================================================
     * @name getCommento()
     * @return string
     * ========================================================================
     * Restituisce il commento
     * ========================================================================
     */
    public function getCommento() {
        if (isset($_REQUEST['commento'])) {
            return $_REQUEST['commento'];
        } else {
            return false;
        }
    }
    
    /**
     * ========================================================================
     * @name getDatiPagamento()
     * @return array $dati_pagamento
     * ========================================================================
     * restituisce i dati relativi al pagamento
     * ========================================================================
     */
    public function getDatiPagamento() {
        $dati_richiesti=array('numero_pagamento','nome_titolare','cognome_titolare','cartacredito_numero','data_scadenza','ccv','importo','tipo_pagamento');
        $dati_pagamento=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato])) {
                $dati_pagamento[$dato] = $_REQUEST[$dato];
            }
        }
        return $dati_pagamento;
    }
}
?>