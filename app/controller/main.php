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
			
		
		
	}
	
}

?>