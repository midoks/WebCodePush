<?php  
class userController extends baseController{

	//退出登陆
	public function logout(){
		session_destroy();
		$url = $this->buildUrl('index', '');
		$this->jump($url);
	}
	
}

?>