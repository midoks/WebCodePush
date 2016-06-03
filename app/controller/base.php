<?php 

class baseController{

	public $config;

	//初始化
	public function __construct(){

		$this->_acl();


		$this->config = include(WCP_ROOT.'/conf/config.php');
	}

	private function _acl(){
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
	}

	/**
	 *	加载模板
	 *	@name string 模板
	 */
	public function load($name){
		include(WCP_TPL.'/header.tpl.php');
		include(WCP_TPL.'/'.$name.'.tpl.php');
		include(WCP_TPL.'/footer.tpl.php');
	}
	
	/**
	 * 组装url
	 */
	public function buildUrl($_m ,$args = array(), $_c = 'main'){
		$args = http_build_query($args);
		$url = "/index.php?_c={$_c}&_m={$_m}&{$args}";
		return $url;
	}

}
?>