<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Class CRicerca - Ricerca
 * ============================================================================
 * lista()             - Seleziona sul database i vini per mostrarli all'utente 
 *                       e li filtra in base alle variabili passate
 * dettagli()          - Mostra i dettagli di un vino, con la descrizione 
 *                       completa, i commenti e il form per l'invio di commenti. 
 *                       solo per utenti registrati
 * inserisciCommento() - Inserisce un commento nel database collegandolo al 
 *                       relativo vino
 * smista()            - Smista le richieste ai vari metodi
 * ============================================================================
 */
class CRicerca {

    /**
     * @var int
     */
    private $_bottiglie_per_pagina=6;

    /**
     * ========================================================================
     * @name lista()
     * @return string
     * ========================================================================
     * Seleziona sul database i vini per mostrarli all'utente e li filtra 
     * in base alle variabili passate
     * ========================================================================
     */
    public function lista(){
        
        //ricava l'istanza univoca dell'oggetto VRicerca
        $view = USingleton::getInstance('VRicerca');
        
        //Crea un nuovo oggetto FVino
        $FVino=new FVino();

        //definisce l'array $parametri
        $parametri=array();

        //impostazioni per la visualizzazione delle bottiglie per pagina
        $limit=$view->getPage()*$this->_bottiglie_per_pagina.','.$this->_bottiglie_per_pagina;
        
        //ricava il numero delle bottiglie trovate nel Database e crea un array
        //con tutti i dati delle bottiglie trovate
        $num_risultati=count($FVino->search($parametri));
        
        //numero pagine = numero bottiglie trovate/numero bottiglie per pagina (6)
        $pagine = ceil($num_risultati/$this->_bottiglie_per_pagina);
        
        //array dei vini trovati in base ai criteri di ricerca
        $risultato=$FVino->search($parametri, '', $limit);

        // Recupera media voti
        if ($risultato!=false) {
            $array_risultato=array();
            foreach ($risultato as $item) {
                //carica i dati del vino con chiave vinoID
                $tmpVino=$FVino->load($item->vinoID);
                 $array_risultato[]=array_merge(get_object_vars($tmpVino),array('media_voti'=>$tmpVino->getMediaVoti()));
            }
        }

        $view->impostaDati('pagine',$pagine);
        $view->impostaDati('task','lista');
        $view->impostaDati('dati',$array_risultato);
        return $view->processaTemplate();
    }
    
    /**
     * ========================================================================
     * @name dettagli
     * @return string
     * ========================================================================
     * Mostra i dettagli di un vino, con la descrizione completa, i commenti e 
     * il form per l'invio di commenti.
     * Solo per utenti registrati
     * ========================================================================
     */
    public function dettagli() {
        $view = USingleton::getInstance('VRicerca');
        $id_Vino=$view->getIdVino();
        $FVino=new FVino();
        $vino=$FVino->load($id_Vino);
        $commenti=$vino->getCommenti();
        $arrayCommenti=array();
        $dati=get_object_vars($vino);

	if ( is_array( $commenti )  ) {
	    foreach ($commenti as $commento){
		$arrayCommenti[]=get_object_vars($commento);
	    }
        }

        $dati['commento']=$arrayCommenti;
        $view->impostaDati('dati',$dati);

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
     * @name inserisciCommento()
     * @return string
     * ========================================================================
     * Inserisce un commento nel database collegandolo al relativo vino
     * ========================================================================
     */
    public function inserisciCommento() {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        if ($username!=false) {
            $view = USingleton::getInstance('VRicerca');
            $ECommento = new ECommento();
            $ECommento->voto=$view->getVoto();
            $ECommento->testo=$view->getCommento();
            $FCommento=new FCommento();
            $FCommento->store($ECommento);
            return $this->dettagli();
        }
    }

    /**
     * ========================================================================
     * @name smista()
     * @return mixed
     * ========================================================================
     * Smista le richieste ai vari Controller   
     * ========================================================================
     */
    public function smista() {
        
        //ricava l'istanza univoca dell'oggetto VRegistrazione
        //$view=USingleton::getInstance('VRicerca');
        //MAX
	$view=USingleton::getInstance('VRegistrazione');
		
        switch ($view->getTask()) {
            case 'ultimi_arrivi':
                return $this->ultimiArrivi();
            case 'dettagli':
                return $this->dettagli();
            case 'Inserisci':
                return $this->inserisciCommento();
            case 'lista':
                return $this->lista();
            case 'Cerca':
                return $this->lista();
        }
    }
}
?>
