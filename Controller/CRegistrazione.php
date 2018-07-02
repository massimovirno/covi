<?php
/**
 * ============================================================================
 * @access public
 * @package Controller
 * ============================================================================
 * Class CRegistrazione - verifica se l'utente è registrato o ne permette la
 *                        registrazione inviando una email di attivazione
 * ============================================================================
 * attivazione()                   - Attiva un utente che inserisce un codice di 
 *                                   attivazione valido oppure clicca sul link 
 *                                   di autenticazione nell'email
 * autentica($username, $password) - Controlla se una coppia username e password
 *                                   corrispondono ad un utente regirtrato ed in 
 *                                   tal caso impostano le variabili di sessione 
 *                                   relative all'autenticazione
 * creaUtente()                    - Crea un utente sul database controllando 
 *                                   che non esista già
 * emailAttivazione(EUtente $utente)-Invia un email contenente il codice di 
 *                                   attivazione per un utente appena registrato
 * getutenteregistrato()           - Controlla se l'utente è registrato ed 
 *                                   autenticato
 * logout()                        - EfFettua il logout
 * moduloRegistrazione()           - Visualizza il modulo di registrazione
 * smista()                        - Smista le richieste ai vari controller
 * ============================================================================
 */
class CRegistrazione {
    /**
     * @var string $_username
     */
    private $_username=null;
    /**
     * @var string $_password
     */
    private $_password=null;
    /**
     * @var string $_errore
     */
    private $_errore='';
    
    /**
     * ========================================================================
     * @name getUtenteRegistrato()
     * @return boolean $autenticato
     * ========================================================================
     * Controlla se l'utente è registrato ed autenticato
     * ========================================================================
     */
    public function getUtenteRegistrato() {
        $autenticato=false;

        //ricava l'istanza univoca dell'oggetto USession
        $Usession=USingleton::getInstance('USession');

        //ricava l'istanza univoca dell'oggetto VRegistrazione
        $VRegistrazione=USingleton::getInstance('VRegistrazione');

        //ricava quale task deve essere eseguito
        $task=$VRegistrazione->getTask();

        //ricava quale controller deve essere eseguito
        $controller=$VRegistrazione->getController();

        //ricava l'attuale username dall'oggetto VRegistrazione
        $this->_username=$VRegistrazione->getUsername();

        //ricava l'attuale password dall'oggetto VRegistrazione
        $this->_password=$VRegistrazione->getPassword();

        //se username è valorizzato, conferma che l'utente autenticato
        //altrinenti controlla autenticazione
        if ($Usession->leggi_valore('username')!=false) {
            //autenticato
            $autenticato=true;
        } 
        elseif ($task=='autentica' && $controller='registrazione') {
            //controlla autenticazione
            $autenticato=$this->autentica($this->_username, $this->_password);
        }

        //se è richiesto uscire, esegue il logout
        if ($task=='esci' && $controller='registrazione') {
            //logout
            $this->logout();
            $autenticato=false;
        }
        
        //Imposta l'eventuale errore nel template
        $VRegistrazione->impostaErrore($this->_errore);
        $this->_errore='';
        return $autenticato;
    }
    
    /**
     * ========================================================================
     * @name autentica($username, $password)
     * @param string $username
     * @param string $password
     * @return boolean
     * ========================================================================
     * Controlla se una coppia username e password corrispondono ad un utente 
     * regirtrato ed in tal caso imposta le variabili di sessione relative 
     * all'autenticazione
     *=========================================================================
     */
    public function autentica($username, $password) {
        $FUtente=new FUtente();
        $utente=$FUtente->load($username);
        if ($utente!=false) {
            if ($utente->getAccountAttivo()) {
                //account attivo
                if ($username==$utente->username && 
                    $password==$utente->password) {
                    //username password errati
                    $Usession=USingleton::getInstance('USession');
                    $Usession->imposta_valore('username',$username);
                    $Usession->imposta_valore('nome_cognome',$utente->nome.' '.$utente->cognome);
                    return true;
                } else {
                    //username password errati
                    $this->_errore='Username o password errati';
                }
            } else {
                //account non attivo
                $this->_errore='L\'account non &egrave; attivo';
            }
        } else {
            //account non esiste
            $this->_errore='L\'account non esiste';
        }
        return false;
    }
    
    /**
     * ========================================================================
     * @ name creaUtente()
     * @return mixed
     * ========================================================================
     * Crea un utente sul database controllando che non esista già
     * ========================================================================
     */
    public function creaUtente() {
        $view=USingleton::getInstance('VRegistrazione');
        $dati_registrazione=$view->getDatiRegistrazione();
        $utente=new EUtente();
        $FUtente=new FUtente();
        $result = $FUtente->load($dati_registrazione['username']);
        $registrato=false;
        if ($result==false) {
            //utente non esiste
            if($dati_registrazione['password_1']==$dati_registrazione['password']) {
                unset($dati_registrazione['password_1']);
                $keys=array_keys($dati_registrazione);
                $i=0;
                foreach ($dati_registrazione as $dato) {
                    $utente->$keys[$i]=$dato;
                    $i++;
                }
                $utente->generaCodiceAttivazione();
                $FUtente->store($utente);
                $this->emailAttivazione($utente);
                $registrato=true;
            } else {
                $this->_errore='Le password immesse non coincidono';
            }
        } else {
            //utente esistente
            $this->_errore='Username gi&agrave; utilizzato';
        }
        if (!$registrato) {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('modulo');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        } else {
            $view->setLayout('conferma_registrazione');
            return $view->processaTemplate();
        }
    }
    
    /**
     * ========================================================================
     * @name emailAttivazione(EUtente $utente)
     * @global array $config
     * @param (EUtente $utente)
     * @return boolean
     * ========================================================================
     * Invia una email contenente il codice di attivazione per un utente appena 
     * registrato
     * ========================================================================
     */
    public function emailAttivazione(EUtente $utente) {
        global $config;
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_attivazione');
        $view->impostaDati('username',$utente->username);
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('codice_attivazione',$utente->getCodiceAttivazione());
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $view->impostaDati('url',$config['url_condivino']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->email,$utente->nome.' '.$utente->cognome,'Attivazione account',$corpo_email);
    }
    
    /**
     * ========================================================================
     * @name attivazione()
     * @return string
     * ========================================================================
     * Attiva un utente che inserisce un codice di attivazione valido oppure 
     * clicca sul link di autenticazione nell'email
     * ========================================================================
     */
    public function attivazione() {
        $view = USingleton::getInstance('VRegistrazione');
        $dati_attivazione=$view->getDatiAttivazione();
        $FUtente=new FUtente();
        $utente=$FUtente->load($dati_attivazione['username']);
        if ($dati_attivazione!=false) {
            if ($utente->getCodiceAttivazione()==$dati_attivazione['codice']) {
                $utente->stato='attivo';
                $FUtente->update($utente);
                $view->setLayout('conferma_attivazione');
            } else {
                $view->impostaErrore('Il codice di attivazione &egrave; errato');
                $view->setLayout('problemi');
            }
        } else {
            $view->setLayout('attivazione');
        }
        return $view->processaTemplate();
    }
    
    /**
     * ========================================================================
     * @name moduloRegistrazione()
     * @return string
     * ========================================================================
     * Visualizza il modulo di registrazione
     * ========================================================================
     */
    public function moduloRegistrazione() {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('modulo');
        return $VRegistrazione->processaTemplate();
    }
    
    /**
     * ========================================================================
     * @name logout()
     * ========================================================================
     * EfFettua il logout
     * ========================================================================
     */
    public function logout() {
        $Usession=USingleton::getInstance('USession');
        $Usession->cancella_valore('username');
        $Usession->cancella_valore('nome_cognome');
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

        //ricava l'istanza univoca dell'oggetto Vregistrazione
        $view=USingleton::getInstance('VRegistrazione');

        switch ($view->getTask()) {
            case 'recupera_password':
                return $this->recuperaPassword();
            case 'registra':
                return $this->moduloRegistrazione();
            case 'salva':
                return $this->creaUtente();
            case 'attivazione':
                return $this->attivazione();
        }
    }
}
?>
