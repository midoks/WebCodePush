<?php 
set_time_limit(0);
define("WCP_APP_DIR", 'app');
define('WCP_ROOT', str_replace('\\', '/', dirname(dirname(__FILE__))));
define('WCP_CORE', WCP_ROOT.'/'.WCP_APP_DIR.'/core');
define('WCP_CTR', WCP_ROOT.'/'.WCP_APP_DIR.'/controller');
define("WCP_TPL", WCP_ROOT.'/'.WCP_APP_DIR.'/template');
include(WCP_CORE.'/func.php');
include(WCP_CORE.'/opt.php');
include(WCP_CTR.'/base.php');

date_default_timezone_set('PRC');
spl_autoload_register('app_autoload');
app_start();

function app_autoload($className){

	$_c = substr($className, 0, -strlen('Controller'));
	$fn = WCP_CTR.'/'.$_c.'.php';
	//var_dump(file_exists($fn));
	if (file_exists($fn)){
		include_once($fn);
	} else {
		include_once(WCP_CTR.'/main.php');
		//die("{$c} not found!");
	}
}

function app_start(){

	$query = $_SERVER['QUERY_STRING'];

	$_c = !empty($_GET['_c']) ? $_GET['_c'] : 'main';
	$_m = !empty($_GET['_m']) ? $_GET['_m'] : 'index';

	$_c = $_c . 'Controller';
	$_obj = new $_c();
	if (method_exists($_obj, $_m)){
		$_obj->$_m();
	} else {
		$_obj->index();
		//die("{$c} not found method {$_m}");
	}
}

?>