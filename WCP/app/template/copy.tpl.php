
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
	padding: 20px;
	background: white;
	font-size:16px;
}

.list td span{
	background: white;
	font-size:16px;
}

</style>
<?php

	$_args = [];
	if(isset($_GET['project'])){
		$_args = array('project'  => $_GET['project']);
	}
?>
<table class='main_table'>
<tr>
<th colspan="8" style="text-align: center;font-size:16px;font-weight: bold;">文件管理</th>
<tr>
<tr>
	<th style="text-align:center;">同步信息</th>
<tr>

<tr class='list'>
<td>
<?php
if(!empty($this->rsync_info)){
	echo $this->rsync_info;
}
?>
</td>
<tr>

<tr>
<td>
</td>
<tr>
</table>