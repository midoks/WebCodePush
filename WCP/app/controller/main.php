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

		$this->project_info = $_info;
		$project_dir = $_info['project_source'];
		if (isset($_GET['abspath']) && file_exists($_GET['abspath'])){
			$project_dir = $_GET['abspath'];

			if ($this->userinfo['type'] !=0 ){//检查权限
				if (substr($project_dir, 0, strlen($_info['project_source'])) != $_info['project_source']){
					$this->jump($this->buildUrl('index', ''));
				}
			}
		}

		$list = wcp_fileinfo_list($project_dir);
		$list = wcp_filter_list($list, $this->config['hidden_file']);
		$list = wcp_file_sort($list);
		
		//var_dump($list);exit;
		$this->list = $list;
		$this->load('dir');
	}

	//项目同步
	public function _copy(){

		if (empty($_POST)){
			exit('error request!!!');
		}

		if(!isset($_GET['project'])){
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
		$get_list_value = array_values($get_list);
		


		$project = $_GET['project'];
		$_info = array();
		$project_file = WCP_ROOT.'/conf/project/'.$project.'.php';
		if(file_exists($project_file)){
			$_info = include($project_file);
			$_info['project_name'] = $project;
		} else {
			exit('项目已经不存在');
		}
		
		$local_project_dir 	= $_info['project_source'];
		$target_addrs		= $_info['project_target'];
		$loginName = $this->getLoginName();
		$op_log = WCP_ROOT."/logs/".$loginName.'_'.date('Y-m-d')."_op.log";

		if(empty($target_addrs)){
			exit("项目未设置完整!!!");
		}

		$target_addrs = explode(',', $target_addrs);
		//var_dump($target_addrs);exit;

		$rsync_info = '';
		include(ABSPATH.'/app/core/cp_op.php');

		foreach($target_addrs as $target_addr){

			if (isset($get_list_value[0]) && $get_list_value[0] == 'D'){

				foreach ($_list as $key => $value) {
					$relative_position_dir 	= str_replace($local_project_dir, '', $value);
					$relative_position_dir 	= trim($relative_position_dir, '/');
					$target_addr 			= trim($target_addr, '/');
					$target_service_addr 	= $target_addr.'/'.$relative_position_dir;

					#if (is_dir($value)){
						$target_service_addr = dirname($target_service_addr).'/';
						$value = dirname($value).'/';
					#}

					//var_dump($value, $target_service_addr);exit;

					$config = "--delete --exclude=*svn* --exclude=*.log* --exclude=*conf*";
					$cmd ="rsync -avz {$config} {$value} {$target_service_addr} 2>>{$op_log}";
					//passthru($cmd, $ret);
					exec($cmd, $ret, $status);
					#$rsync_info .= $cmd."<br>";

					foreach ($ret as $rk => $rv) {
						$rsync_info .= $rv."<br>";
					}
					$rsync_info .=  "<br>";

					if ($status != 0 ){
						$rsync_info .= "<span style='color:red;'>rsync -avz --delete {$target_service_addr} {$value} FAIL</span><br>";
						$this->rycLog($op_log, "rsync -avz --delete {$target_service_addr} {$value} FAIL");
					} else {
						$rsync_info .= "<span style='color:blue;'>rsync -avz --delete {$target_service_addr} {$value}  SUCCESS</span><br>";
						$this->rycLog($op_log, "rsync -avz --delete {$target_service_addr} {$value} SUCCESS");
					}
				}
			} else {

				foreach ($_list as $key => $value) {
					$relative_position_dir 	= str_replace($local_project_dir, '', $value);
					$relative_position_dir 	= trim($relative_position_dir, '/');
					$target_addr 			= trim($target_addr, '/');
					$target_service_addr 	= $target_addr.'/'.$relative_position_dir;

					if (is_dir($value)){
						$target_service_addr = dirname($target_service_addr);
					}

					//echo "rsync -avz {$value} {$t_addr}\r\n";
					$config = '--exclude=*svn* --exclude=*.log* --exclude=*conf*';
					// $config = '';
					$cmd = "rsync -avz {$config} {$value} {$target_service_addr} 2>>{$op_log}";
					//$exe_string = passthru($cmd, $ret);
					exec($cmd, $ret, $status);
					foreach ($ret as $rk => $rv) {
						$rsync_info .=  $rv."<br>";
					}
		

					if ($status != 0 ){
						$rsync_info .= "<span style='color:red;'>rsync -avz {$value} {$target_service_addr} FAIL</span><br>";
						$this->rycLog($op_log, "rsync -avz {$target_service_addr} {$value} FAIL");
					} else {
						$rsync_info .= "<span style='color:blue;'>rsync -avz {$value} {$target_service_addr} SUCCESS</span><br>";
						$this->rycLog($op_log, "rsync -avz {$target_service_addr} {$value} SUCCESS");
					}
				}
			}
		}

		

		$this->rsync_info = $rsync_info;
		$this->load('copy');
	}
	
}

?>