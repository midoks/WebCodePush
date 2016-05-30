<?php 

define("WCP_APP_DIR", 'app');
define('WCP_ROOT', str_replace('\\', '/', dirname(dirname(__FILE__))));
define('WCP_CORE', WCP_ROOT.'/'.WCP_APP_DIR.'/core');
define('WCP_CTR', WCP_ROOT.'/'.WCP_APP_DIR.'/controller');
define("WCP_TPL", WCP_ROOT.'/'.WCP_APP_DIR.'/template');
include(WCP_CORE.'/func.php');
include(WCP_CTR.'/base.php');

spl_autoload_register('app_autoload');
app_start();

function app_autoload($className){

	$_c = substr($className, 0, -strlen('Controller'));
	$fn = WCP_CTR.'/'.$_c.'.php';
	if (file_exists($fn)){
		include_once($fn);
	} else {
		die("{$c} not found!");
	}
}

function app_start(){

	$query = $_SERVER['QUERY_STRING'];

	$_c = isset($_GET['_c']) ? $_GET['_c'] : 'main';
	$_m = isset($_GET['_m']) ? $_GET['_m'] : 'index';

	$_c = $_c . 'Controller';
	$_obj = new $_c();
	$_obj->$_m();
}

?>