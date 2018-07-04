<?php
/* 
 * config.inc.php - imposta le variabili per l'applicazione
 * - smarty             template 
 * - debug              abilita/disabilita il debug
 * - MySQL              impostazioni per MySQL
 * - smtp               per l'invio di email
 * - email_webmaster    email del webmaster
 * - url_condivino      url di accesso a condivino
 */

global $config;

// template smarty
$config['smarty']['template_dir'] = './templates/main/template/';
$config['smarty']['compile_dir'] = './templates/main/templates_c/';
$config['smarty']['config_dir'] = './templates/main/configs/';
$config['smarty']['cache_dir'] = './templates/main/cache/';

// abilita/disabilita il debug
$config['debug']=false;
//$config['debug']=true;

// impostazioni per MySQL
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = '';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'covi';

//configurazione server smtp per invio email
$config['smtp']['host'] = 'smtp.cheapnet.it';
$config['smtp']['port'] = '25';
$config['smtp']['smtpauth'] = false;
$config['smtp']['username'] = '';
$config['smtp']['password'] = '';

$config['email_webmaster']='webmaster@covi.it';
$config['url_condivino']='http://localhost/covi';

// istruzioni di debug
function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

?>
