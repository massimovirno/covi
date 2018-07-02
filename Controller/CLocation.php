<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Class CLocation - Gestione della Location
 * ============================================================================
 * lista()  - Seleziona location dal database e li mostra all'utente 
 * smista() - Smista le richieste ai vari controller
 * ============================================================================
 */
class CLocation {
    
    /**
     * ========================================================================
     * @name lista()
     * @return mixed
     * ========================================================================
     * Seleziona location dal database e li mostra all'utente 
     * ========================================================================
     */
    public function lista(){
        $view = USingleton::getInstance('VLocation');
        $FEvento=new FEvento();
        
        // CONTROLLO FLAG PUBBLICATO
        $parametri[]=array('pubblicato','=',1);

        $limit=$view->getPage()*$this->_eventi_per_pagina.','.$this->_eventi_per_pagina;
        $num_risultati=count($FEvento->search($parametri));
        $pagine = ceil($num_risultati/$this->_eventi_per_pagina);
        $risultato=$FEvento->search($parametri, '', $limit);
        // Recupera media voti
        // DA IMPLEMENTARE
		
        if ($risultato!=false) {
            $array_risultato=array();
            foreach ($risultato as $item) {
                $tmpEvento=$FEvento->load($item->eventoID);
                $array_risultato[]=array_merge(get_object_vars($tmpEvento),array('media_voti'=>$tmpEvento->getMediaVoti()));
                //$array_risultato[]=array(get_object_vars($tmpEvento));
            }
        }
		
	// RECUPERA PARTECIPANTI
        $partecipanti=$tmpEvento->getNumeroPartecipanti();
        $view->impostaDati('partecipanti',$partecipanti);
        $view->impostaDati('pagine',$pagine);
        $view->impostaDati('task','lista');
        $view->impostaDati('dati',$array_risultato);
        return $view->processaTemplate();
    }
	
    /**
     * ========================================================================
     * @name smista()
     * @return mixed
     * ========================================================================
     * Smista le richieste ai vari metodi
     * ========================================================================
     */
    public function smista() {
        
        //ricava l'istanza univoca dell'oggetto VLocation
        $view=USingleton::getInstance('VLocation');
        
        switch ($view->getTask()) {
            case 'Partecipa':
                return $this->partecipa();
            case 'dettagli':
                return $this->dettagli();
	    case 'Effettua il pagamento':
                return $this->salvaPartecipazioneEvento();				
            case 'lista':
                return $this->lista();
        }
    }
}
?>
