<?php 

class baseController{

	const VERSION = '2.0';
	const AUTHOR = 'midoks';
	const AUTHOR_EMAIL = 'midoks@163.com';
	public $config;

	//初始化
	public function __construct(){
		
		$this->_acl();

		$this->config = include(WCP_ROOT.'/conf/config.php');
		$this->project_config = include(WCP_ROOT.'/conf/project_config.php');


		header('WCP_VERSION: '.self::VERSION);
		header('WCP_AUTHOR: '.self::AUTHOR);
		header('WCP_AUTHOR_EMAIL: '.self::AUTHOR_EMAIL);
	}

	//权限管理
	private function _acl(){
		if ( PHP_SAPI == 'apache2handler'){
			$this->_acl_apache();
		} else if (strpos(PHP_SAPI, 'fpm') !== false ){
			$this->_acl_nginx();
		} else {
			echo('need nginx or apache as server');
		}
	}

	/**
	 * 通过apache判断权限
	 */
	private function _acl_apache(){
		$user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
		$pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
		$type = isset($_SERVER['AUTH_TYPE']) ? $_SERVER['AUTH_TYPE'] : '';

		if(!empty($user) && !empty($pass)){
			if ($this->_check_user($user, $pass)){
			} else {
				header("WWW-Authenticate:Basic realm='Private'");
				header('HTTP/1.0 401 Unauthorized');
    			exit("You are unauthorized to enter this area.");
			}
		} else {
			header("WWW-Authenticate:Basic realm='Private'");
    		header('HTTP/1.0 401 Unauthorized');
    		exit("You are unauthorized to enter this area.");
		}
	}

	/**
	 * 通过nginx判断权限
	 */
	private function _acl_nginx(){
		session_start();

		if(isset($_POST)){
			$user = isset($_POST['user']) ? $_POST['user'] : '';
			$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

			if(!empty($user) && !empty($pwd)){
				if ($this->_check_user($user, $pwd)){

					$_SESSION['isLogin'] = array(
						'user' => $user,
						'pwd'  => $pwd,
					);
				} else {
					$_SESSION['isLogin'] = NULL;
					$this->login_err = "登陆失败";
				}
			}
		}

		if ( isset($_SESSION['isLogin']) && $_SESSION['isLogin']) {
			$user = isset($_SESSION['isLogin']['user']) ? $_SESSION['isLogin']['user'] : '';
			$pwd = isset($_SESSION['isLogin']['pwd']) ? $_SESSION['isLogin']['pwd'] : '';
			$this->_check_user($user, $pwd);
		} else {
			$this->loadLogin('login');
			exit;
		}
	}

	public function getLoginName(){
		$user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
		if (empty($user)){
			$user = isset($_SESSION['isLogin']['user']) ? $_SESSION['isLogin']['user'] : '';
		}
		if (empty($user)){
			return false;
		}

		return $user;
	}

	private function _check_user($user, $passwod){
		$file = WCP_ROOT."/conf/acl/{$user}.php";
		if (file_exists($file)){
			$config = include($file);
			if ($config['pwd'] == $passwod) {

				if ($config['type'] == 0 ) {
					return true;
				} else if ($config['type'] == 1) {

					if (isset($_GET['abspath']) ){
						$acl_list_repo = explode('|', $config['acl']);
						$repo_name = $this->getRepoName();
						if (in_array($repo_name, $acl_list_repo)){
							return true;
						} else {
							exit($repo_name.' - You are unauthorized to enter this area.');
						}
					}
				}
				return true;
			}
			
		}
		return false;
	}

	public function getRepoName(){
		$abspath = isset($_GET['abspath']) ? $_GET['abspath'] : '';
		$_tmp = str_replace($this->config['work_dir'], '', $abspath);	
		$_tmp = trim($_tmp, '/');

		$_f_list = explode('/', $_tmp);
		return $_f_list[0];
	}

	public function safeEcho($var){
		ob_start();
		echo($var);
		ob_get_contents();
	}

	public function safeDump($var){
		ob_start();
		var_dump($var);
		ob_get_contents();
	}

	/**
	 *	加载模板
	 *	@name string 模板
	 */
	public function load($name){
		include_once(WCP_TPL.'/header.tpl.php');
		include_once(WCP_TPL.'/'.$name.'.tpl.php');
		include_once(WCP_TPL.'/footer.tpl.php');
	}

	/**
	 *	加载模板
	 *	@name string 模板
	 */
	public function loadLogin($name){
		include_once(WCP_TPL.'/header.tpl.php');
		include_once(WCP_TPL.'/'.$name.'.tpl.php');
		include_once(WCP_TPL.'/login_footer.tpl.php');
	}
	
	/**
	 * 组装url
	 */
	public function buildUrl($_m ,$args = array(), $_c = 'main'){
		
		if (!empty($args)){
			$args = http_build_query($args);
			$url = "/index.php?_c={$_c}&_m={$_m}&{$args}";
			return $url;
		}
		$url = "/index.php?_c={$_c}&_m={$_m}";
		return $url;
	}

	public function jump($url){
		header("Location: ".$url);
	}

}
?>