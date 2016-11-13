
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
	

function deleteRepo(url){

	console.log(url);

	var b = confirm('是否真的要删除本文件?');
	if (b){
		location.href = url;
	}

}



</script>

<table class='main_table'>

<tr>
	<th colspan="4" style="text-align: center;font-size:16px;font-weight: bold;">项目管理</th>
<tr>

<tr>
	<th style="text-align:center">项目名</th>
	<th style="text-align:center">源地址</th>
	<th style="text-align:center">目标地址</th>
	<th style="text-align:center">操作[<a href="<?php echo $this->buildUrl('projectadd', '', 'sys'); ?>">添加</a>]</th>
<tr>

<?php
foreach($this->list as $k=>$v){
	
	$str =  "<tr class='list'>";
	$str .=	"<td>[{$v['project_name']}]</td>";


	$str .=	"<td>{$v['project_source']}</td>";
	
	//站点信息
	$str .=	"<td>{$v['project_target']}</td>";

	//操作
	$str .=	"<td>[<a href='".$this->buildUrl('projectmod', array('project'=>$v['project_name']), 'sys')."'>修改</a>]|";
	$str .= '[<a onclick=javaScript:deleteRepo("'.$this->buildUrl('projectdel',array('project'=>$v['project_name']),'sys').'") href="#">删除</a>]</td>';

	$str .= "</tr>";
	
	echo $str;
}
?>

</table>