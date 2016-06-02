
<style>
.main_table{
	margin-top: 30pt;
	margin-right: auto;
	margin-left: auto;
	width:620px;
}

.main_table tr{
	background: #eee;
}

.main_table th{
	border: 1px solid silver;
	padding: 3px;
}

.list{

}

.list td{
	border: 1px solid silver;
	padding: 3px;
	background: white;
}

.list a{
	font-size:14px;
}

.list input{
	padding: 0px 6px 0px 6px;
}
</style>

<table class='main_table'>
<tr>
<th colspan="8" style="text-align: center;font-size:16px;font-weight: bold;">文件管理</th>
<tr>
<tr>
	<th style="text-align:center;">选择</th>
	<th style="text-align:center;">文件名</th>
	<th style="text-align:center">大小</th>
	<th style="text-align:center">最后修改时间</th>
	<th style="text-align:center">权限</th>
	<th style="text-align:center">所有者</th>
	<th style="text-align:center">组</th>
	<th style="text-align:center">处理方法</th>
<tr>

<?php
foreach($this->list as $k=>$v){
	
	$str =  "<tr class='list'>";

	//选择
	$str .= "<td style='text-align:center;'><input type='checkbox' name='checked' value='true'></td>";

	//目录信息
	$encode_abspath = urlencode($v['abspath']);
	if($v['type']=='dir'){
		$str .=	"<td>"."<img src='resoures/image/dir.gif' alt='folder'>".
				"[<a href='/?_c=main&_m=_dir&abspath={$encode_abspath}' style='text-decoration: none;'>{$v['fn']}</a>]</td>";
	} else {
		$str .=	"<td><img src='resoures/image/file.gif' alt='file'>[{$v['fn']}]</td>";
	}
	
	//大小
	$str .=	"<td>{$v['info']['size']}</td>";

	//最近修改时间
	$str .=	"<td>{$v['info']['mtime']}</td>";

	//权限
	$str .=	"<td>{$v['info']['fileperms']}</td>";

	//所有者
	$str .=	"<td>{$v['info']['fileowner']}</td>";

	//所属组
	$str .=	"<td>{$v['info']['filegroup']}</td>";

	//处理方法
	$str .=	"<td style='text-align:center;'><input class='small' type='submit' name='submit' value='>' /></td>";
	
	$str .= "</tr>";
	
	echo $str;
}
?>

<tr>
	<th style="font-size:12px;text-align:center;">
		<input type='checkbox' name='checked' value='true'>
		<img src='resoures/image/arrow.gif' alt='index'>
		
	</th>
	<th colspan="7" style="text-align:left;">
		<input type='submit' name='checked' value='发布' style="font-size:10px;">
	</th>
<tr>
</table>