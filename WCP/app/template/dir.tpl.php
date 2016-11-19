
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
	font-size:12px;
}

.list input{
	padding: 0px 6px 0px 6px;
}
</style>
<?php

	$_args = array();
	if(isset($_GET['project'])){
		$_args = array('project'  => $_GET['project']);
	}
?>
<form id='main_upload' action="<?php echo($this->buildUrl('_copy', $_args)); ?>" method='POST'>
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
	$str .= "<td style='text-align:center;'><input type='checkbox' name='checkbox{$k}' value='true' onfocus='return button_click('o');'></td>";

	$dargs = array('project' => $this->project_info['project_name'],
				   'abspath' => $v['abspath']);
	$args = array_merge($dargs, $_args);

	//目录信息
	$url = $this->buildUrl('_dir', $args);
	//var_dump($url);
	$args = array();
	if($v['type']=='dir'){
		$str .=	"<td>"."<img src='resoures/image/dir.gif' alt='folder'>[<a href='{$url}' style='text-decoration: none;'>{$v['fn']}</a>]</td>";
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
	$str .=	"<input type='hidden' name='file{$k}' value='{$v['abspath']}' />";
	//处理方法
	$str .=	"<td style='text-align:center;'>";
	if($v['type'] == 'file'){
		$str .=	"<input title='查看源码' type='submit' name='single{$k}' value='S' onfocus=return button_click('o') />&nbsp;";
	}
	$str .=	"<input title='复制文件' type='submit' name='single{$k}' value='>' onfocus=return button_click('o') />&nbsp;";
	// $str .=	"<input title='删除项目中不存在的文件' type='submit' name='single{$k}' value='D' onfocus=return button_click('o') />";
	$str .=	"</td>";

	
	$str .= "</tr>";
	echo $str;
}
?>

<script type="text/javascript">
function submit_click(_this){
	var f = document.getElementById('main_upload');
	for (var i=0;i<f.elements.length;i++){
		var e = f.elements[i];
		if (e.type == 'checkbox' && e.name != 'check_all_box'){
			console.log(e.checked,_this.checked);
			e.checked = !e.checked;
		}
	}
}

function button_click(_this){
	if (document && document.forms[0] && document.forms[0].elements['focus']) {
		document.forms[0].elements['focus'].value = name;
	}
	return true;
}

</script>

<tr>
	<th style="font-size:12px;text-align:center;">
		<input type='checkbox' name='check_all_box' value='true' onclick="submit_click(this)">
		<img src='resoures/image/arrow.gif' alt='index'>
		
	</th>
	<th colspan="7" style="text-align:left;">
		<input type='submit' name='submit' value='发布' style="font-size:10px;">
	</th>
<tr>
</table>
</form>