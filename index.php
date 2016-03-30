<?php 



$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

if(isset($user) && isset($pass)){

var_dump($user,$pass);
echo "OK";
$_SERVER['PHP_AUTH_USER'] = NULL;
$_SERVER['PHP_AUTH_PW'] = NULL;

} else {


	header('WWW-Authenticate: Basic realm="USER LOGIN"');
	header('HTTP/1.0 401 Unauthorized');
 

}



?>