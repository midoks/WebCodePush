<?php  
class userController{

	//退出登陆
	public function logout(){
		session_start();
		session_destroy();

		if ( PHP_SAPI == 'apache2handler'){
			header('HTTP/1.0 401 Unauthorized');
    		exit("You are unauthorized to enter this area.");
		} else if (strpos(PHP_SAPI, 'fpm') !== false ){
			$url = $this->buildUrl('index', '');
			header("Location: ".$url);
		}
	}

	/**
	 * 组装url
	 */
	public function buildUrl($_m ,$args = array(), $_c = 'main'){
		
		if (!empty($args)){
			//$args = http_build_query($args);
			$tmp = '';
			foreach ($args as $k => $v) {
				if ( $k == 'abspath' ){
					$tmp .= $k.'='.$v.'&';
				} else {
					$tmp .= $k.'='.urlencode($v).'&';
				}
			}

			$tmp = trim($tmp, '&');
			$url = "/index.php?_c={$_c}&_m={$_m}&{$tmp}";
			
			return $url;
		}
		$url = "/index.php?_c={$_c}&_m={$_m}";
		return $url;
	}


	public function jump($url){
		
	}
	
}

?>