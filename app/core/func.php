<?php

/**
 * @dir string 获取目录地址和相关信息
 */
function wcp_dir_list($dir){
	$list = array();
	if(is_dir($dir)){
		$_list = scandir($dir);
		foreach($_list as $k=>$v){
			$arr = array();
			if($v == '.' || $v == '..'){
			} else {
				$arr['fn'] = $v;
				$abspath = rtrim($dir,'/').'/'.$v;

				if(is_dir($abspath)){
					$arr['type'] = 'dir';
				} else if (is_file($abspath)){
					$arr['type'] = 'file';
				} else {
					$arr['type'] = 'unknown';
				}

				$arr['abspath'] = rtrim($dir,'/').'/'.$v;
				$list[] = $arr;
			}
		}
	}
	return $list;
}

/**
 * @dir string 获取目录地址和相关信息
 */
function wcp_fileinfo_list($dir){
	clearstatcache();
	$list = array();
	if(is_dir($dir)){
		$_list = scandir($dir);
		foreach($_list as $k=>$v){
			$arr = array();
			if($v == '.' || $v == '..'){
			} else {
				$arr['fn'] = $v;
				$abspath = rtrim($dir,'/').'/'.$v;

				if(is_dir($abspath)){
					$arr['type'] = 'dir';
				} else if (is_file($abspath)){
					$arr['type'] = 'file';
				} else {
					$arr['type'] = 'unknown';
				}

				$arr['abspath'] = rtrim($dir,'/').'/'.$v;
				$arr['info'] = stat($arr['abspath']);

				$arr['info']['mtime'] = date('Y-m-d H:i:s', $arr['info']['mtime']);

				$arr['info']['filegroup'] = filegroup($arr['abspath']);
				$arr['info']['fileowner'] =  GetUsernameFromUid( fileowner($arr['abspath']) );
				$arr['info']['fileperms'] = fileperms($arr['abspath']);

				$list[] = $arr;
			}
		}
	}
	return $list;
}


function GetUsernameFromUid($uid){
	var_dump($uid);
	var_dump(get_current_user());
	if (function_exists('posix_getpwuid')) { 
		$a = posix_getpwuid($uid); 
		return $a['name']; 
	} 
	# This works on BSD but not with GNU 
	elseif (strstr(php_uname('s'), 'BSD')) { 
		exec('id -u ' . (int) $uid, $o, $r); 
		if ($r == 0) {
		  return trim($o['0']); 
		} else {
		  return $uid; 
		}
	} elseif (is_readable('/etc/passwd')) { 
		exec(sprintf('grep :%s: /etc/passwd | cut -d: -f1', (int) $uid), $o, $r); 
		if ($r == 0){
		  return trim($o['0']); 
		} else {
		  return $uid;
		}
	} else {
		return $uid;
	}
} 


?>