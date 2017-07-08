
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
		<th style="width: 450px;text-align:center">同步文件</th>
		<th style="text-align:center">同步日志</th>
	<tr>

	<div id='data_list' style="display: none;"><?php echo json_encode($this->list); ?></div>

	<tr class="list" style="background: white;">
		<td>

<!-- 部署项目 -->
部署项目:<select id="project_name" name='project_name'>
	<option>请选择项目</option>
<?php	
	

if (!empty($this->list)){
	foreach($this->list as $k=>$v){

		$str =  "<option>";
		$str .=	"{$v['project_name']}";
		$str .= "</option>";
		echo $str;
	}
}
?>
			</select><br />
			<div id="pub_id" style="display:none;">前端服务器:</div>
			<div id="project_source" style="display:none;">测试路径:</div>
			<br />
			<textarea style="margin-top:2px;font-size: 15px;" rows="15" cols="50" name='file_list' 
			spellcheck="false"><?php

if (!empty($this->file_list)){
	//var_dump($this->file_list);
	if( is_array($this->file_list) ) {
		foreach ($this->file_list as $value) {
			echo $value;
		}
	} else if( is_string($this->file_list) ){
		echo $this->file_list;
	}
}

?></textarea>

<script type="text/javascript">
	
$('#project_name').bind('change', function(){
	var name = $(this).val();
	var data = $.parseJSON($('#data_list').text());

	if (name == '请选择项目'){
		$('#pub_id').css('display', 'none');
		$('#project_source').css('display', 'none');
		return;
	}

	for (i in data){
		var t = data[i];

		if (t['project_name'] == name){
			//console.log(t);

			$('#pub_id').html("前端服务器:<br/>"+t['project_pub_ip']).css('display', 'block');
			$('#project_source').html('测试路径:<br>' + t['project_source'] ).css('display', 'block');
		}

		
	}


	//console.log(name, data);
});

</script>

<!-- 部署日志 -->
</div>
	</td>

	<td style="margin-top:0;padding-top: 0;display: block;min-height:400px;">
<?php				
if (!empty($this->rsync_info)){
	echo $this->rsync_info;
}
?>
	</td>

	</tr>

	<tr class='list'><td colspan="2" style="text-align: center;"><input type="submit" name="submit" value="提交"></td><tr>

</table>
</form>