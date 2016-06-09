<?php


if (strpos(PHP_OS, 'Windows')){
	return array(
		'work_dir'		=> 'D:/YOKA/HTML/',	//项目地址
		'hidden_file'	=> array(
			'.', '..', '.metadata','.DS_Store',
			'.svn',
		),
	);
}

return array(
	'work_dir'		=> '/Users/midoks/Desktop/www',	//项目地址
	'hidden_file'	=> array(
		'.', '..', '.metadata','.DS_Store',
		'.svn',
	),
);

?>