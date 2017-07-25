<?php 

/**
 * 系统管理
 * 作者 midoks
 * 创建时间 2016-11-05
 */

class baseController{

	const VERSION = '2.0';
	const AUTHOR = 'midoks';
	const AUTHOR_EMAIL = 'midoks@163.com';

	public $config;
	public $userinfo;
	public $project_config;

	//初始化
	public function __construct(){
		
		$this->_acl();
		$this->conf = include(WCP_ROOT.'/conf/conf.php');


		$username = $this->getLoginName();
		
		$acl_file = WCP_ROOT."/conf/acl/{$username}.php";
		if(!file_exists($acl_file)){
			session_destroy();
			$this->jump($this->buildUrl('index'));
		}

		$this->userinfo = include($acl_file);
		$this->userinfo['username'] = $username;
	
		header('WCP_VERSION: '.self::VERSION);
		header('WCP_AUTHOR: '.self::AUTHOR);
		header('WCP_AUTHOR_EMAIL: '.self::AUTHOR_EMAIL);

		if (!empty($_POST)){
			$this->recTrim($_POST);
		}

		if (!empty($_GET)){
			$this->recTrim($_GET);
		}
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

	//获取用户项目列表
	public function getUserProjectList(){
		$list = array();
		if(!empty($this->userinfo['project'])){
			$repos = explode(',', trim($this->userinfo['project']));
			
			foreach ($repos as $repo) {
				$repo = trim($repo);
				$repo_file = WCP_ROOT.'/conf/project/'.$repo.'.php';
				if(file_exists($repo_file)){
					$_info = include($repo_file);
					$_info['project_name'] = $repo;
					$list[] = $_info;
				}
			}
		}
		return $list;
	}

	private function _check_user($user, $passwod){
		$file = WCP_ROOT."/conf/acl/{$user}.php";
		if (file_exists($file)){
			$config = include($file);
			if ($config['pwd'] == md5($passwod)) {

				if ($config['type'] == 0 ) {
					return true;
				} else if ($config['type'] == 1) {
					if (isset($_GET['abspath']) ){
						$acl_list_repo = explode(',', $config['project']);
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
		return $_GET['project'];
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

	//记录同步的日
	public function rycLog($file, $content){
		$fp = fopen($file, 'ab');
		fwrite($fp, '['.date('H:i:s').']:'."\t".$content."\n");
		fclose($fp);

	}

	//递归处理
	public function recTrim($var){
		//ar_dump($var);
		if (is_array($var)){
			foreach ($var as $k => $v) {
				if (is_string($v)){
					$var[$k] = $v;
				} else {
					$var[$k] = $this->recTrim($v);
				}
			}
			return $var;
		} else if(is_string($var)) {
			return trim($var); 
		} else {
			return $var;
		}
	}

	public function jump($url){
		header("Location: ".$url);
	}

}
?>