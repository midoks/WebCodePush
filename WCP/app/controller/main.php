<?php  
class mainController extends baseController{

	//项目页
	public function index(){
		
		$list = array();
		if(!empty($this->userinfo['project'])){
			$repos = explode(',', trim($this->userinfo['project']));
			
			foreach ($repos as $repo) {
				$repo_file = WCP_ROOT.'/conf/project/'.$repo.'.php';
				if(file_exists($repo_file)){
					$_info = include($repo_file);
					$_info['project_name'] = $repo;
					$list[] = $_info;
				}
			}

		}

		//var_dump($list);
		//$list = wcp_dir_list($this->config["work_dir"]);
		//$list = wcp_filter_list($list, $this->config['hidden_file']);
		$this->list = $list;

		$this->load('index');
	}
	
	//文件页
	public function _dir(){
		//var_dump($_GET);
		if(!isset($_GET['project'])){
			exit('参数有误');
		}

		$project = $_GET['project'];

		$_info = array();
		$project_file = WCP_ROOT.'/conf/project/'.$project.'.php';
		if(file_exists($project_file)){
			$_info = include($project_file);
			$_info['project_name'] = $project;
		} else {
			exit('项目已经不存在');
		}

		$list = wcp_fileinfo_list($_info['project_source']);
		$list = wcp_filter_list($list, $this->config['hidden_file']);

		$this->list = $list;
		$this->load('dir');
	}

	//项目同步
	public function _copy(){

		if (empty($_POST)){
			exit('error request!!!');
		}

		if(!isset($_GET['target'])){
			exit("error request!!!\r\nwhy not set var target!!!");
		}

		$file = wcp_list_filter_prefex($_POST, 'file');
		$_list = array();
		if (isset($_POST['submit'])){
			$get_list = wcp_list_filter_prefex($_POST, 'checkbox');	
		} else {
			$get_list = wcp_list_filter_prefex($_POST, 'single');
		}

		$get_list_key = array_keys($get_list);
		foreach ($get_list_key as $k) {
			$_list[] = $file[$k];
		}

		$project_config = $this->project_config;
		$target = $_GET['target'];
		if (!isset($project_config[$target]) || !isset($project_config[$target]['target']) ){
			exit(WCP_ROOT.'/conf/project_config.php need config');

		}

		$target_addr = $project_config[$target]['target'];
		$local_project_dir = $this->config['work_dir'].'/'.$target.'/';

		$loginName = $this->getLoginName();
		$error_log = WCP_ROOT."/logs/".$loginName."_error_log.log";
		
		
		foreach ($_list as $key => $value) {

			$relative_position_dir = str_replace($local_project_dir, '', $value);
			$t_addr = $target_addr.'/'.$relative_position_dir;

			//echo "rsync -avz {$value} {$t_addr}\r\n";
			exec(WCP_ROOT."/shell/common.sh {$value} {$t_addr} 2>>{$error_log}", $ret, $status );

			foreach ($ret as $rk => $rv) {
				echo $rv."<br>";
			}
			if ($status > 0 ){
				echo "<span style='color:red;'>rsync -avz {$value} {$t_addr} FAIL</span><br>";
			} else {
				echo "<span style='color:blue;'>rsync -avz {$value} {$t_addr} SUCCESS</span><br>";
			}
			
		}
	}
	
}

?>