
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

	// console.log(url);
	var b = confirm('是否真的要删除本文件?');
	if (b){
		location.href = url;
	}

}



</script>

<table class='main_table'>

<tr>
	<th colspan="4" style="text-align: center;font-size:16px;font-weight: bold;">用户管理</th>
<tr>

<tr>
	<th style="text-align:center">用户名</th>
	<th style="text-align:center">类型</th>
	<th style="text-align:center">管理项目</th>
	<th style="text-align:center">操作[<a href="<?php echo $this->buildUrl('useradd', '', 'sys'); ?>">添加</a>]</th>
<tr>

<?php
foreach($this->list as $k=>$v){
	
	$str =  "<tr class='list'>";
	$str .=	"<td>[{$v['username']}]</td>";
	
	//类型
	if ($v['type'] == 0){
		$v['type'] = '系统管理员';
	} else if ($v['type'] == 1) {
		$v['type'] = '开发者';
	} else if ($v['type'] == 2){
		$v['type'] = '观察者';
	}

	$str .=	"<td>{$v['type']}</td>";
	
	//站点信息
	$str .=	"<td>{$v['project']}</td>";

	//操作
	$str .=	"<td>[<a href='".$this->buildUrl('usermod', array('username'=>$v['username']), 'sys')."'>修改</a>]|";
	$str .= '[<a onclick=javaScript:deleteRepo("'.$this->buildUrl('userdel',array('username'=>$v['username']),'sys').'") href="#">删除</a>]</td>';

	$str .= "</tr>";
	
	echo $str;
}
?>

</table>