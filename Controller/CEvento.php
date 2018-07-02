<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Classe CEvento - Imposta la pagina Home e che smista le richieste ai vari 
 *                  controller
 * ============================================================================
 * dettagli()                          - Seleziona sul database gli eventi 
 *                                       disponibili per mostrarli all'utente 
 * emailConfermaEvento(EEvento $evento)- Invia un email di conferma all'utente 
 *                                       che ha effettuato il pagamento
 * lista()                             - Seleziona sul database gli eventi 
 *                                       disponibili per mostrarli all'utente
 * moduloPagamento()                   - Mostra il modulo per il pagamento
 * partecipa()                         - Salva l'ordine nel database
 * salvaPartecipazioneEvento()         - Salva partecipazione evento           
 * smista()                            - Smista le richieste ai vari controller
 * ============================================================================
 */
class CEvento {
    /**
     * @var string $_eventi_per_pagina
     */
    private $_eventi_per_pagina=6;

    /**
     * @var string $_evento
     */
    private $_evento;

    /**
     * ========================================================================
     * @name lista()
     * @return string
     * ========================================================================
     * Seleziona sul database gli eventi disponibili per mostrarli all'utente 
     * ========================================================================
     */
    public function lista(){

        //ricava l'istanza univoca dell'oggetto VEvento
        $view = USingleton::getInstance('VEvento');

        //Crea un nuovo oggetto FEvento
        $FEvento=new FEvento();
        
        //definisce l'array $parametri
        $parametri=array();
        
        // memorizza nell'array PARAMETRI il flag PUBBLICATO=1
	// $parametri[]=array('pubblicato','=',1);
    
	//impostazioni per la visualizzazione degli eventi per pagina
        $limit=$view->getPage()*$this->_eventi_per_pagina.','.$this->_eventi_per_pagina;
	$num_risultati=count($FEvento->search($parametri));
        $pagine = ceil($num_risultati/$this->_eventi_per_pagina);
        
        //
        $risultato=$FEvento->search($parametri, '', $limit);

        // Recupera media voti
        if ($risultato!=false) {
            $array_risultato=array();
            
            foreach ($risultato as $item) {
                $tmpEvento=$FEvento->load($item->eventoID);
                $array_risultato[]=array_merge(get_object_vars($tmpEvento),array('media_voti'=>$tmpEvento->getMediaVoti()));
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
     * @name dettagli()
     * @return string
     * ========================================================================
     * Mostra i dettagli dell'evento, con la descrizione completa solo per 
     * utenti registrati
     * ========================================================================
     */
	//TERMINARE
    public function dettagli() {
        $view = USingleton::getInstance('VEvento');
        $id_evento=$view->getIdEvento();
        
	//$id_evento=1;     
        //echo "ID_EVE_DET+$id_evento";
		
		$FEvento=new FEvento();
        $evento=$FEvento->load($id_evento);
        $dati=get_object_vars($evento);
        $view->impostaDati('dati',$dati);
	    
        $partecipanti=$evento->getPartecipanti();
        $arrayPartecipanti=array();
		
        // LEGGI DATI VINO
        $FVino=new FVino();
        $id_vino=$evento->vinoID_FK;
        $vino=$FVino->load($id_vino);
        $dati_vino=get_object_vars($vino);
        $view->impostaDati('dati_vino', $dati_vino);

        // LEGGI DATI LOCATION
        $FLocation=new FLocation();
        $id_location=$evento->locationID_FK;
        $location=$FLocation->load($id_location);
        $dati_location=get_object_vars($location);
        $view->impostaDati('dati_location', $dati_location);

        // LEGGI PARTECIPANTI
        if ( is_array( $partecipanti )  ) {
	    foreach ($partecipanti as $partecipante){
		$arrayPartecipanti[]=get_object_vars($partecipante);
	    }
        }

        $dati['partecipante']=$arrayPartecipanti;

        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        if ($username != false) {
            $view->setLayout('dettagli_registrato');
        } else {
            $view->setLayout('dettagli');
        }
        return $view->processaTemplate();
    }

    /**
     * ========================================================================
     * @name moduloPagamento()
     * @return string
     * ========================================================================
     * Mostra il modulo per il pagamento
     * ========================================================================
     */
    public function moduloPagamento() {
        $view = USingleton::getInstance('VEvento');
        $id_evento=$view->getIdEvento();
    
        $view->setLayout('pagamento');
        return $view->processaTemplate();
    }
	
    /**
     * ========================================================================
     * @name partecipa()
     * @return string
     * ========================================================================
     * Salva l'ordine nel database
     * ========================================================================
     */
    public function partecipa() {
        $view = USingleton::getInstance('VEvento');
        // DATI EVENTO
        $id_evento=$view->getIdEvento();
        $FEvento=new FEvento();
        $evento=$FEvento->load($id_evento);
	$dati=get_object_vars($evento);
	$view->impostaDati('dati',$dati);
		
	// DATI UTENTE
	$session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
	$FUtente=new FUtente();
		
        // TERMINARE Associare utente a pagamento e registrare in eventoPartecipanti
        /**
	$dati_pagamento=$view->getDatiPagamento();
        $carta_credito= new EPagamento();
        $carta_credito->ccv=$dati_pagamento['ccv'];
        $carta_credito->numero_pagamento=$dati_pagamento['numero_carta'];
        $carta_credito->nome_titolare=$dati_pagamento['nome_titolare'];
        $carta_credito->cognome_titolare=$dati_pagamento['cognome_titolare'];
        $carta_credito->setDataScadenza($dati_pagamento['scadenza']);
	*/
	$eventoPartecipante=new EEventoPartecipante();
	$eventoPartecipante->setPartecipante($username);
		
        //$this->_carrello->setCartaCredito($carta_credito);
        //$this->_carrello->setCartaCredito($carta_credito);
        //$FOrdine=new FOrdine();
        //$this->_carrello->setData(date('d-m-Y'));
        //$FOrdine->store($this->_carrello);
        
        //$this->emailConfermaEvento($this->_carrello);
        $view->setLayout('pagamento');
        //$session=USingleton::getInstance('USession');
        //$session->cancella_valore('carrello');
        return $view->processaTemplate();
    }

    /**
     * ========================================================================
     * @name salvaPartecipazioneEvento()
     * @return string
     * ========================================================================
     * Salva partecipazione evento
     * ========================================================================
     */
    public function salvaPartecipazioneEvento() {
        $view = USingleton::getInstance('VEvento');
        $id_evento=$view->getIdEvento();
        
        $dati_pagamento=$view->getDatiPagamento();
        $carta_credito= new FCartaCredito();
        $carta_credito->ccv=$dati_pagamento['ccv'];
        $carta_credito->numero_pagamento=$dati_pagamento['cartacredito_numero'];
        $carta_credito->nome_titolare=$dati_pagamento['nome_titolare'];
        $carta_credito->cognome_titolare=$dati_pagamento['cognome_titolare'];
        $carta_credito->setDataScadenza($dati_pagamento['data_scadenza']);
	$FCartaCredito = new FCartaCredito();
        $FCartaCredito->store($carta_credito);
        // -------
        
        // Carica oggetto vuoto, assegna id ed inscrive il partecipante
        //
        $EveP=new EEventoPartecipante(); 
        $FEventoPartecipante=new FEventoPartecipante();
        $EveP->eventoID=$id_evento;
        $FEventoPartecipante->store($EveP);
        $view->setLayout('termine');
        return $view->processaTemplate();
    }
	
    /**
     * ========================================================================
     * @name emailConfermaEvento(EEvento $evento)
     * @param EEvento $evento
     * @return boolean
     * ========================================================================
     * Invia un email di conferma all'utente che ha effettuato il pagamento
     * ========================================================================
     */
	 // COMPLETARE
    public function emailConfermaEvento(EEvento $evento) {
        global $config;
        $view=USingleton::getInstance('VOrdine');
        $view->setLayout('email_conferma');
        $utente=$ordine->getUtente();
        $dati_utente=get_object_vars($utente);
        $view->impostaDati('dati_utente',$dati_utente);
        $items=$ordine->getItems();
        $carrello['vini']=array();
        $carrello['totale']=$this->_carrello->getPrezzoTotale();
        foreach ($items as $item) {
            $carrello['vini'][]=array_merge(get_object_vars($item->getVino()), array('quantita' => $item->quantita));
        }
        $view->impostaDati('ordine',$carrello);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->email,$utente->nome.' '.$utente->cognome,'Conferma ordine',$corpo_email,'Contenuto non visibile, necessario client che supporti l\'HTML',true);
    }
	
    /**
     * ========================================================================
     * @name smista()
     * @return mixed
     * ========================================================================
     * Smista le richieste ai relativi metodi della classe
     * ========================================================================
     */
    public function smista() {
 
        //ricava l'istanza univoca dell'oggetto VEvento
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
