<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Classe CHome - Imposta la pagina Home e che smista le richieste ai vari 
 *                controller
 * ============================================================================
 * impostaPagina() - imposta e visualizza la pagina Home
 * smista()        - Smista le richieste ai vari controller
 * ============================================================================
 */
class CHome {
    
    /**
     * ========================================================================
     * @name impostaPagina()
     * ========================================================================
     * imposta e visualizza la pagina
     * ========================================================================
     */
   
    public function impostaPagina() {

        //ricava l'istanza univoca dell'oggetto CRegistrazione
        $CRegistrazione=USingleton::getInstance('CRegistrazione');

        //Controlla se l'utente è registrato ed autenticato
        $registrato=$CRegistrazione->getUtenteRegistrato();

        //ricava l'istanza univoca dell'oggetto VHome
        $VHome=USingleton::getInstance('VHome');

        //Smista le richieste ai vari controller
        $contenuto=$this->smista();

        //imposta il contenuto della pagina
        $VHome->impostaContenuto($contenuto);
        
        //distingue i contenuti in base allo stato dell'utente
        if ($registrato) {
            $VHome->impostaPaginaRegistrato();
        } else {
            $VHome->impostaPaginaGuest();
        }
        
        //visualizza pagina
        $VHome->mostraPagina();
    }
    
    /**
     * ========================================================================
     * @ smista()
     * @return mixed 
     * ========================================================================
     * Smista le richieste ai vari controller
     * ========================================================================
     */
    public function smista() {

        //ricava l'istanza univoca dell'oggetto VHome
        $view=USingleton::getInstance('VHome');

        switch ($view->getController()) {
            case 'registrazione':
                $CRegistrazione=USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
            case 'evento':
                $CEvento=USingleton::getInstance('CEvento');
                return $CEvento->smista();	
            case 'creazioneevento':
                $CCreazioneEvento=USingleton::getInstance('CCreazioneEvento');
                return $CCreazioneEvento->smista();		                
            case 'ricerca':
                $CRicerca=USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            default:
                $CRicerca=USingleton::getInstance('CRicerca');
		return $CRicerca->smista();
        }
    }
}
?>
