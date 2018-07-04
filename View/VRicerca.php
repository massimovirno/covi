<?php
/**
 * ============================================================================
 * @access public
 * @package view
 * ============================================================================
 * Class VRicerca -  estende la classe view del package System e gestisce la 
 *                   visualizzazione e formattazione del sito, inoltre imposta i
 *                   principali contenuti della pagina, suddivisi in contenuti 
 *                   principali (main_content) e contenuti della barra laterale 
 *                   (side_content)
 * ============================================================================
 * getIdVino()               - Ritorna l'id del vino passato tramite GET o POST
 * getPage()                 - restituisce il numero della pagina (utilizzato 
 *                             nella visualizzazione dei vini) passato per GET o 
 *                             POST
 * getVoto()                 - restituisce il voto passato tramite GET o POST
 * impostaDati($key,$valore) - Imposta i dati nel template identificati da una 
 *                             chiave ed il relativo valore
 * processaTemplate()        - Processa il Template registrazione_layout.tpl
 * setLayout($layout)        - imposta il layout
 * ============================================================================
 */
class VRicerca extends View {
    /**
     * @var string _layout
     */
    private $_layout='default';

    /**
     * ========================================================================
     * @name getPage()
     * @return mixed
     * ========================================================================
     * restituisce il numero della pagina (utilizzato nella visualizzazione dei 
     * vini) passato per GET o POST
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
     * @return mixed
     * ========================================================================
     * restituisce il numero della pagina (utilizzato nella visualizzazione dei 
     * vini) passato per GET o POST
     * ========================================================================
     */
    public function processaTemplate() {
        return $this->fetch('ricerca_'.$this->_layout.'.tpl');
    }
    
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
     * @name getIdVino()
     * @return mixed
     * ========================================================================
     * Ritorna l'id del vino passato tramite GET o POST
     * ========================================================================
     */
    public function getIdVino() {
        if (isset($_REQUEST['ID'])) {
            return $_REQUEST['ID'];
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
     * @return mixed
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
}
?>