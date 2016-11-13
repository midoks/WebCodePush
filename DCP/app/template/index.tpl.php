
<style>

.main_table{
	margin-top: 20px;
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

<form action=""  method="POST">
<table class='main_table'>

	<tr>
		<th colspan="3" style="text-align: center;font-size:16px;font-weight: bold;">项目部署</th>
	<tr>
	<tr>
		<th style="width: 400px;text-align:center">同步文件</th>
		<th style="text-align:center">同步日志</th>
	<tr>

	<tr class="list" style="background: white;">
		<td colspan="2">

<!-- 部署项目 -->
<div style="width: 405px;float: left;">
			部署项目:<select name='project_name'>
				
<?php				
if (!empty($this->list)){
	foreach($this->list as $k=>$v){
		$str =  "<option>";
		if ($v['project_name'] == $this->index_project_name){
			$str =  "<option selected=selected>";
		}
		$str .=	"{$v['project_name']}";
		$str .= "</option>";
		echo $str;
	}
}
?>
			</select><br />
			<textarea style="margin-top:2px;font-size: 15px;" rows="15" cols="50" name='file_list' 
			spellcheck="false"><?php 
if (!empty($this->file_list)){
	echo $this->file_list;
}
?></textarea>
</div>

<!-- 部署日志 -->
<div style="border-left: 1px solid silver;width:570px;float: left;padding: 5px;">
<?php				
if (!empty($this->rsync_info)){
	echo $this->rsync_info;
}
?>
</div>
	</td>

	</tr>

	<tr class='list'><td colspan="2" style="text-align: left;"><input type="submit" name="submit" value="提交"></td><tr>

</table>
</form>