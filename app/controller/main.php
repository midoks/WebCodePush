<?php  
class mainController extends baseController{

	public function index(){
		$list = wcp_dir_list($this->config["work_dir"]);
		$this->list = $list;
		$this->load('index');
	}
	
}

?>