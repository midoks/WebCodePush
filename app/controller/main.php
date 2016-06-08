<?php  
class mainController extends baseController{

	//项目页
	public function index(){
		
		$list = wcp_dir_list($this->config["work_dir"]);
		$list = wcp_filter_list($list, $this->config['hidden_file']);
		$this->list = $list;

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

		$list = wcp_fileinfo_list($abspath);
		$list = wcp_filter_list($list, $this->config['hidden_file']);

		$this->list = $list;

		//var_dump($this->list);
		$this->load('dir');
	}

	//项目同步
	public function _copy(){

		// if (isset($_POST)){
		// 	var_dump($_POST);
		// } else {
		// 	exit('not files ');
		// }
		//$ret = NULL;

		var_dump($_POST);
		// exec(WCP_ROOT."/shell/common.sh file", $ret, $status );

		// var_dump($ret);
		// var_dump($status);

	}
	
}

?>