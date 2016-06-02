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
				$arr['info']['size'] = GetFileSize($arr['info']['size']);

				$arr['info']['filegroup'] = filegroup($arr['abspath']);
				//$arr['info']['fileowner'] =  GetUsernameFromUid( fileowner($arr['abspath']) );
				$arr['info']['fileowner'] =  GetUsernameFromUid( $arr['info']['uid'] );
				//$arr['info']['fileperms'] = GetFileperms(fileperms($arr['abspath']));
				$arr['info']['fileperms'] = GetFileperms($arr['info']['mode']);

				$list[] = $arr;
			}
		}
	}
	return $list;
}

function GetFileSize($size){
	return  number_format(($size/1024),2)."K";
}

function GetUsernameFromUid($uid){

	if(strpos(php_uname(), 'Windows') !== false){
		return get_current_user();
	}
	
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

function GetFileperms($perms){

	if (($perms & 0xC000) == 0xC000) {
	    // Socket
	    $info = 's';
	} elseif (($perms & 0xA000) == 0xA000) {
	    // Symbolic Link
	    $info = 'l';
	} elseif (($perms & 0x8000) == 0x8000) {
	    // Regular
	    $info = '-';
	} elseif (($perms & 0x6000) == 0x6000) {
	    // Block special
	    $info = 'b';
	} elseif (($perms & 0x4000) == 0x4000) {
	    // Directory
	    $info = 'd';
	} elseif (($perms & 0x2000) == 0x2000) {
	    // Character special
	    $info = 'c';
	} elseif (($perms & 0x1000) == 0x1000) {
	    // FIFO pipe
	    $info = 'p';
	} else {
	    // Unknown
	    $info = 'u';
	}

	// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	            (($perms & 0x0800) ? 's' : 'x' ) :
	            (($perms & 0x0800) ? 'S' : '-'));

	// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	            (($perms & 0x0400) ? 's' : 'x' ) :
	            (($perms & 0x0400) ? 'S' : '-'));

	// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	            (($perms & 0x0200) ? 't' : 'x' ) :
	            (($perms & 0x0200) ? 'T' : '-'));

	return $info;
}


?>