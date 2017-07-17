
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

	<tr><th colspan="4" style="text-align: center;font-size:16px;font-weight: bold;">项目管理</th><tr>

	<tr class="list">
	<td colspan="4" style="text-align: left;font-size:12px;">
		注意事项<br />
	  	rsync同步的排除规则：<br />
	  	<?php echo $this->rsync_config; ?> <br/>
	 	2 请将类似下面的rsync同步命令发给管理员来操作 <br>
	  	<span style="color:red;">rsync -avz  /var/www/application/test.php rsync://127.0.0.1/application/ </span><br/>
	 	3 同步文件的时候，不出错的时候都会看到下面这些语句：<br /> 
	  	<!-- At revision 10155. <br> -->
	  	building file list ... done test.php sent 191 bytes received 38 bytes 458.00 bytes/sec total size is 119 speedup is 0.52<br/> 
	  	<span style="color:blue;"> rsync -avz /var/www/application/test.php rsync://127.0.0.1/application/ done </span><br/>
	  	4 申请代码上线，只需要把需要上线文件copy出来，文件的绝对路径可以从语句中获取到，如下： <br>
	  	/var/www/application/test.php </br>

	</td></tr>

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