
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


</style>


<table class='main_table'>

	<tr>
	<th colspan="7" style="text-align: center;font-size:16px;font-weight: bold;">项目管理</th>
	<tr>
	<tr>
		<th style="text-align:center">项目名</th>
		<th style="text-align:center">项目说明</th>
		<th style="text-align:center">目标地址</th>
		<th style="text-align:center">站点名</th>
	<tr>

<?php

if (!empty($this->list)){
	foreach($this->list as $k=>$v){
		
		$str =  "<tr class='list'>";
		
		//目录信息
		$url = $this->buildUrl('_dir', array('project'  => $v['project_name']));
		$str .=	"<td style='width:20%;'>[<a href='{$url}' style='text-decoration: none;'>{$v['project_name']}</a>]</td>";
		
		//介绍
		if (!empty($v['project_desc'])) {
			$str .=	"<td>{$v['project_desc']}</td>";
		} else {
			$str .=	"<td>暂无</td>";
		}

		
		//目标地址
		$str .=	"<td>{$v['project_target']}</td>";
		
		//站点信息
		if (!empty($v['project_site'])) {
			$str .=	"<td>{$v['project_site']}</td>";
		} else {
			$str .=	"<td>暂无</td>";
		}
		
		$str .= "</tr>";
		echo $str;
	}
}
?>
</table>