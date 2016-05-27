<?php 

define("WCP_APP_DIR", 'app');
define('WCP_ROOT', str_replace('\\', '/', dirname(dirname(__FILE__))));
define('WCP_CORE', WCP_ROOT.'/'.WCP_APP_DIR.'/core');
define("WCP_TPL", WCP_ROOT.'/template');
include(WCP_CORE.'/func.php');

$config = include(WCP_ROOT.'/conf/config.php');

var_dump($config);

$list = wcp_dir_list($config["work_dir"]);
var_dump($list);

// $user = $_SERVER['PHP_AUTH_USER'];
// $pass = $_SERVER['PHP_AUTH_PW'];
// //$type = $_SERVER['AUTH_TYPE']; 

// if(isset($user) && isset($pass)){

// var_dump($user,$pass, $type);
// echo "OK";
// $_SERVER['PHP_AUTH_USER'] = "";
// $_SERVER['PHP_AUTH_PW'] = "";

// } else {


// 	header('WWW-Authenticate: Basic realm="USER LOGIN"');
// 	header('HTTP/1.0 401 Unauthorized');
 

// }


?>