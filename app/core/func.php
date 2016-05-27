<?php

/**
 * @dir string 目录地址
 */
function wcp_dir_list($dir){
	if(is_dir($dir)){
		$list = scandir($dir);
		var_dump($list);
		foreach($list as $k=>$v){
		
		}
	}
	return array();
}

?>