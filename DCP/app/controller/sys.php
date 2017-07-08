<?php
/**
 * 系统管理
 * 作者 midoks
 * 创建时间 2016-11-05
 * 1.添加项目
 * 2.添加用户
 */
class sysController extends baseController{

	//初始化
	public function __construct(){
		parent::__construct();

		if($this->userinfo['type'] != 0 ){
			$this->jump($this->buildUrl('index'));
		}
	}

	//项目页
	public function index(){
		$this->load('sys');
	}

	//项目
	public function project(){

		$projects = wcp_dir_list(WCP_ROOT.'/conf/project/');
		$projects = wcp_filter_list($projects, $this->config['hidden_file']);
		
		$list = array();
		foreach ($projects as $project) {
			$_tmp = include($project['abspath']);
			$_tmp['project_name'] = str_replace('.php', '', $project['fn']);
			$list[] = $_tmp;
		}

		foreach ($list as $key => $value) {
			$t = $list[$key]['project_target'];
			$list[$key]['project_target'] = str_replace(',', "<br/>", $t);
		}

		$this->list = $list;
		$this->title = "项目管理";
		$this->load('project');
	}

	//项目添加
	public function projectadd(){

		if (isset($_POST['submit'])) {

			$content = wcp_add_project($_POST);
			$repo = $_POST['project_name'];
			$repo = WCP_ROOT.'/conf/project/'.$repo.'.php';
			if (file_exists($repo)){
				$this->error = "已经存在此项目!!!";
			} else {
				$ret = file_put_contents($repo, $content);
				if($ret){
					$this->jump($this->buildUrl('project', '', 'sys'));
				} else {
					$this->error = "添加失败!!";
				}
			}

		}

		$this->title = "添加项目";
		$this->load('project_add');
	}

	public function projectmod(){

		if (isset($_POST['submit'])) {

			$content = wcp_add_project($_POST);

			$repo = $_POST['project_name'];
			$repo = WCP_ROOT."/conf/project/{$repo}.php";
			
			$ret = file_put_contents($repo, $content);
			if($ret){
				$this->jump($this->buildUrl('project', '', 'sys'));
			} else {
				$this->error = "添加失败!!";
			}
		}

		if (isset($_GET['project'])){
			$repo = $_GET['project'];
			$repo = WCP_ROOT.'/conf/project/'.$repo.'.php';

			if(file_exists($repo)){
				$project_info = include($repo);
				$project_info['project_name'] = $_GET['project'];
				$project_info['project_target'] = str_replace(',', "\r\n", $project_info['project_target']);

				$this->project_info = $project_info;
			} else {
				$this->jump($this->buildUrl('project', '', 'sys'));
			}
		} else {
			$this->jump($this->buildUrl('project', '', 'sys'));
		}

		$this->title = "项目修改";		
		$this->load('project_add');
	}

	//删除项目
	public function projectdel(){

		if (isset($_GET['project'])){
			$repo = $_GET['project'];
			$repo = WCP_ROOT.'/conf/project/'.$repo.'.php';
			if(!file_exists($repo)){
				exit('项目不存在');
			}

			$ret = unlink($repo);
			if($ret){
				$this->jump($this->buildUrl('project', '', 'sys'));
			} else {
				exit('删除失败');
			}
		}
	}

	//用户管理
	public function user(){

		$users = wcp_dir_list(WCP_ROOT.'/conf/acl/');
		//var_dump($users);
		$users = wcp_filter_list($users, $this->config['hidden_file']);
		//var_dump($users);
		$list = array();
		foreach ($users as $user) {
			$_tmp = include($user['abspath']);
			$_tmp['username'] = str_replace('.php', '', $user['fn']);
			$list[] = $_tmp;
		}
		$this->list = $list;
		$this->load('user');
	}

	//添加用户
	public function useradd(){

		if (isset($_POST['submit'])) {

			$username = $_POST['username'];
			$user_file = WCP_ROOT.'/conf/acl/'.$username.'.php';
			if (file_exists($user_file)){
				$this->error = "已经存在此用户";
			} else {
				$_POST['pwd'] = md5($_POST['pwd']);
				$ret = update_user_info($_POST);
				if($ret){
					$this->jump($this->buildUrl('user', '', 'sys'));
				} else {
					$this->error = "添加失败!!";
				}
			}
		}

		$this->title = "添加用户";
		$this->load('useradd');
	}

	//用户设置
	public function usermod(){

		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$user_file = WCP_ROOT.'/conf/acl/'.$username.'.php';
			$_tmp_user = include($user_file);

			//密码为空,就不修改
			if(isset($_POST['pwd']) && empty($_POST['pwd'])){
				$_POST['pwd'] = $_tmp_user['pwd'];
			} else {
				$_POST['pwd'] = md5($_POST['pwd']);
			}

			$ret = update_user_info($_POST);
			if($ret){
				$this->jump($this->buildUrl('user', '', 'sys'));
			} else {
				$this->error = "修改失败!!";
			}
		}

		$username 	= $_GET['username'];
		$user_file 	= WCP_ROOT.'/conf/acl/'.$username.'.php';

		if(!file_exists($user_file)){
			$this->jump($this->buildUrl('user', '', 'sys'));
		}

		$userinfo 	= include($user_file); 
		$userinfo['username'] = $username;


		$this->title 	= "用户修改";
		$this->userinfo = $userinfo;
		$this->load('usermod');
	}

	//删除用户
	public function userdel(){

		if (isset($_GET['username'])){
			$username = $_GET['username'];
			$user_file = WCP_ROOT.'/conf/acl/'.$username.'.php';

			if(!file_exists($user_file)){
				exit('用户不存在');
			}

			$ret = unlink($user_file);
			if($ret){
				$this->jump($this->buildUrl('user', '', 'sys'));
			} else {
				exit('删除失败');
			}
		}
	}
	
}

?>