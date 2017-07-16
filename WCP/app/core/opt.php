<?php



/**
 * 更新用户数据
 * 
 */
function update_user_info(array $info){
	$data = php_args_align($info);
	$user_file = WCP_ROOT.'/conf/acl/'.$info['username'].'.php';
	return file_put_contents($user_file, $data);
}


/**
 * PHP文件数据对齐
 * 必须是数组信息
 */
function php_args_align(array $info){

	$content = "<?php\r\nreturn array(\r\n";

	foreach($info as $k => $v){
		$content .= "\t'$k'=>'$v', \r\n";
	}

	$content .= ");\r\n?>";
	return $content;

}


function wcp_add_project(array $info){
	$content = php_args_align($info);
	return $content;
}

?>