
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

<script type="text/javascript">

function button_click(url){

	// console.log(url);
	var b = confirm('是否真的要启动命令?');
	if (b){
		location.href = url;
	}

}
</script>

<table class='main_table'>
	
<?php
	//系统管理权限
	if ($this->userinfo['type'] == 0){
?>
	<tr>
		<th colspan="3" style="text-align: center;font-size:16px;font-weight: bold;">
			<a style="text-decoration: none;" href='<?php echo $url = $this->buildUrl('index', '', 'sys'); ?>'>系统设置</a>
		</th>
	<tr>
<?php		
	}
?>

	<tr>
		<th colspan="3" style="text-align: left;font-size:12px;">
		注意事项<br />
	  	rsync同步的排除规则：<br />
	  	--exclude=*svn* --exclude=*.log* --exclude=*conf*<br/>
	 	2 请将类似下面的rsync同步命令发给管理员来操作 <br>
	  	<span style="color:red;">rsync -avz  /var/www/application/test.php rsync://127.0.0.1/application/ </span><br/>
	 	3 同步文件的时候，不出错的时候都会看到下面这些语句：<br /> 
	  	<!-- At revision 10155. <br> -->
	  	building file list ... done test.php sent 191 bytes received 38 bytes 458.00 bytes/sec total size is 119 speedup is 0.52<br/> 
	  	<span style="color:blue;"> rsync -avz /var/www/application/test.php rsync://127.0.0.1/application/ done </span><br/>
	  	4 申请代码上线，只需要把需要上线文件copy出来，文件的绝对路径可以从语句中获取到，如下： <br>
	  	/var/www/application/test.php </br>
		</th>
	</tr>

	<tr>
		<th colspan="3" style="text-align: center;font-size:16px;font-weight: bold;">项目管理</th>
	<tr>
	<tr>
		<th style="text-align:center">项目名</th>
		<th style="text-align:center">项目说明</th>
		<th style="text-align:center">站点名</th>
		<!-- <th style="text-align:center">命令</th> -->
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
			$str .=	"<td style='width:60%;'>{$v['project_desc']}</td>";
		} else {
			$str .=	"<td style='width:60%;'>暂无</td>";
		}
		
		//站点信息
		if (!empty($v['project_site'])) {
			$str .=	"<td style='width:20%;'>{$v['project_site']}</td>";
		} else {
			$str .=	"<td style='width:20%;'>暂无</td>";
		}

		// //命令
		// if (!empty($v['project_cmd'])) {
		// 	$url = $this->buildUrl('_cmd', array('project'  => $v['project_name']));
		// 	$str .=	"<td style='width:20%;'><input title='执行命令' type='button' value='S' onclick=javaScript:button_click('{$url}') /></td>";
		// } else {
		// 	$str .=	"<td style='width:20%;'>暂无</td>";
		// }
		
		$str .= "</tr>";
		echo $str;
	}
}
?>
</table>