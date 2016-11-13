<?php  
class userController extends baseController{

	//退出登陆
	public function logout(){
		if ( PHP_SAPI == 'apache2handler'){
			header('HTTP/1.0 401 Unauthorized');
    		exit("You are unauthorized to enter this area.");
		} else if (strpos(PHP_SAPI, 'fpm') !== false ){
			session_destroy();
			$url = $this->buildUrl('index', '');
			$this->jump($url);
		}
	}

	//修改密码
	public function modpwd(){

		if (isset($_POST['submit'])) {

			$pwd = $_POST['pwd'];
			if(empty($pwd)){
				$this->error = '密码不能空';
			}

			$this->userinfo['pwd'] = md5($pwd);

			$content = wcp_add_user($this->userinfo);
			$user_file = WCP_ROOT.'/conf/acl/'.$this->userinfo['username'].'.php';
			$ret = file_put_contents($user_file, $content);
			if($ret){
				$this->jump($this->buildUrl('index', ''));
			} else {
				$this->error = '设置失败';
			}
		}

		$this->title = '修改密码';
		$this->load('userselfmod');
	}
	
}

?>