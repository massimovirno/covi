<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Class CCreazioneEvento - verifica se l'utente è registrato o ne permette la
 *                          registrazione inviando una email di attivazione
 * ============================================================================
 * salvaEvento()   - Crea evento
 * moduloEvento()  - Mostra il modulo creazione evento
 * smista()        - Smista le richieste ai vari controller
 * ============================================================================
 */
class CCreazioneEvento {
	
    /**
     * ========================================================================
     * @name salvaEvento()
     * @return mixed
     * ========================================================================
     * Crea evento 
     * ========================================================================
     */
    public function salvaEvento(){
        $view = USingleton::getInstance('VCreazioneEvento');	
        //$dati_creazione = $view->getDatiEvento();
		
        $evento=new EEvento();
        $FEvento = new FEvento();
        $FEvento->store($evento);
		
        $view->setLayout('conferma_creazione');
        
        return $view->processaTemplate();
    }

    /**
     * ========================================================================
     * @name moduloEvento()
     * @return mixed
     * ========================================================================
     * Mostra il modulo creazione evento
     * ========================================================================
     */
    public function moduloEvento() {
        $VCreazioneEvento=USingleton::getInstance('VCreazioneEvento');
        $VCreazioneEvento->setLayout('modulo');
        return $VCreazioneEvento->processaTemplate();
    }

    /**
     * ========================================================================
     * @name smista()
     * @return mixed
     * ========================================================================
     * Smista le richieste ai vari controller 
     * ========================================================================
     */
    public function smista() {
        $view=USingleton::getInstance('VCreazioneEvento');
        switch ($view->getTask()) {
            case 'creaevento':
                return $this->moduloEvento();
	    case 'salvaevento':
                return $this->salvaEvento();
        }
    }
}

?>
