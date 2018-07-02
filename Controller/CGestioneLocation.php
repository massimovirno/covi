<?php
/**
 * @access public
 * @package Controller
 */
class CGestioneLocation {
    /**  TERMINARE
     * Variabili di servizio
     *
     * @var EEvento
     */
    //private $_eventi_per_pagina=6;
	//private $_evento;
     /**
     * Seleziona location dal database e li mostra all'utente 
     *
     * @return string
     */
    public function lista(){
        $view = USingleton::getInstance('VEvento');
        $FEvento=new FEvento();
        
		$parametri=array();
        $categoria=$view->getCategoria();
        $parola=$view->getParola();
		
        if ($categoria!=false){
            $parametri[]=array('categoria','=',$categoria);
        }
        if ($parola!=false){
            $parametri[]=array('descrizione','LIKE','%'.$parola.'%');
        }
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
                $tmpEvento=$FEvento->load($item->id);
                $array_risultato[]=array_merge(get_object_vars($tmpEvento),array('media_voti'=>$tmpEvento->getMediaVoti()));
                //$array_risultato[]=array(get_object_vars($tmpEvento));
                }
        }
		
		// RECUPERA PARTECIPANTI
        $partecipanti=$tmpEvento->getNumeroPartecipanti();
		debug($partecipanti);
		$view->impostaDati('partecipanti',$partecipanti);
		
		$view->impostaDati('pagine',$pagine);
        $view->impostaDati('task','lista');
        $view->impostaDati('parametri','categoria='.$categoria.'&stringa='.$parola);
        $view->impostaDati('dati',$array_risultato);
        return $view->processaTemplate();
    }
	

    /**
     * Smista le richieste ai vari metodi
     * 
     * @return mixed
     */
    public function smista() {
        $view=USingleton::getInstance('VEvento');
        switch ($view->getTask()) {
            case 'lista':
                return $this->lista();
            case 'dettagli':
                return $this->dettagli();
            case 'Partecipa':
                return $this->partecipa();
	    case 'Effettua il pagamento':
                return $this->salvaPartecipazioneEvento();				
	  //case 'Aggiungi al Carrello':
            //    return $this->aggiungi();
        }
    }
}

?>
