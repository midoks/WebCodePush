<?php  
class mainController extends baseController{

	//项目页
	public function index(){
		
		$list = wcp_dir_list($this->config["work_dir"]);
		$this->list = $list;
		$this->project_config = include(WCP_ROOT.'/conf/project_config.php');
		$this->load('index');
	}
	
	//文件页
	public function _dir(){	
		//var_dump($_GET);
		if(!isset($_GET['abspath'])){
			exit('参数有误');
		}

		$abspath = $_GET['abspath'];

		if(!file_exists($abspath)){
			exit('目录不存在');
		}

		$this->list = wcp_fileinfo_list($abspath);

		//var_dump($this->list);
		$this->load('dir');
	}

	//项目同步
	public function _copy(){

		echo '';
	}
	
}

?>