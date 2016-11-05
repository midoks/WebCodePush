
<style>
.main_table{
	margin-top: 20pt;
	margin-right: auto;
	margin-left: auto;
	width:1000px;
	
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
</style>

<table class='main_table'>
<tr>
<th colspan="3" style="text-align: center;font-size:16px;font-weight: bold;">项目管理</th>
<tr>
<tr>
<th style="text-align:center">项目名</th><th style="text-align:center">项目说明</th><th style="text-align:center">站点名</th>
<tr>

<?php
foreach($this->list as $k=>$v){
	
	$str =  "<tr class='list'>";
	
	//目录信息
	$url = $this->buildUrl('_dir', array(
			'abspath' => $v['abspath'],
			'target'  => $v['fn'],
		));
	$str .=	"<td style='width:20%;'>[<a href='{$url}' style='text-decoration: none;'>{$v['fn']}</a>]</td>";
	
	//介绍
	$info = isset($this->project_config[$v['fn']]) ? $this->project_config[$v['fn']] : '';
	if (!empty($info)) {
		$str .=	"<td style='width:60%;'>{$info['instro']}</td>";
	} else {
		$str .=	"<td style='width:60%;'>暂无</td>";
	}
	
	//站点信息
	if (!empty($info)) {
		$str .=	"<td style='width:20%;'>{$info['site']}</td>";
	} else {
		$str .=	"<td style='width:20%;'>暂无</td>";
	}
	
	
	$str .= "</tr>";
	
	echo $str;
}
?>
</table>