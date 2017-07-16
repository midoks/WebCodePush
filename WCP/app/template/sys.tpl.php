
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
	<th style="text-align: center;font-size:16px;font-weight: bold;">发布系统管理</th>
<tr>

<tr>
	<th style="text-align:center;width:100px;">
		<div>
		<a href="<?php echo $this->buildUrl('project', '', 'sys'); ?>">项目管理</a>
		<a href="<?php echo $this->buildUrl('user', '', 'sys'); ?>">开发者管理</a>
		<a href="<?php echo $this->buildUrl('index', '', 'conf'); ?>">配置管理</a>
		</div>
	</th>
<tr>

</table>