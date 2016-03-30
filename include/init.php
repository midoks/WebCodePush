<?php 

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
//$type = $_SERVER['AUTH_TYPE']; 

if(isset($user) && isset($pass)){

var_dump($user,$pass, $type);
echo "OK";
$_SERVER['PHP_AUTH_USER'] = "";
$_SERVER['PHP_AUTH_PW'] = "";

} else {


	header('WWW-Authenticate: Basic realm="USER LOGIN"');
	header('HTTP/1.0 401 Unauthorized');
 

}


?>