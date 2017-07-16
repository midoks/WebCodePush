<?php
/**
 * 配置管理
 * 作者 midoks
 * 创建时间 2016-11-05
 */
class confController extends baseController{

	//初始化
	public function __construct(){
		parent::__construct();

		if($this->userinfo['type'] != 0 ){
			$this->jump($this->buildUrl('index'));
		}
	}

	//配置管理
	public function index(){
		
		if (isset($_POST['submit'])) {

			$file = WCP_ROOT.'/conf/conf.php';
			$var = $_POST['var'];
			
		
			$_POST['pwd'] = md5($_POST['pwd']);
			$data = php_args_align($var);
			$ret = file_put_contents($file, $data);
			if($ret){
				$this->jump($this->buildUrl('index', '', 'conf'));
			} else {
				$this->error = "添加失败!!";
			}
			$this->conf = include($file);
		}

		$this->title = "配置管理";
		$this->load('conf');
	}
}

?>