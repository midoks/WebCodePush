
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

<form action=""  method="POST">
<table class='main_table'>

<tr>
	<th colspan="4" style="text-align: center;font-size:16px;font-weight: bold;">
		<?php echo $this->title; ?>
	</th>
<tr>

<?php 
if (isset($this->error)){
?>
	<tr class='list'><td style="text-align: center;color: red;"><?php echo $this->error; ?></td><tr>
<?php
}
?>

<tr class='list'><td style="text-align: left;">
	项目名:<input type="text" name="project_name" value="
<?php 
	if(isset($this->project_info['project_name'])){
		echo $this->project_info['project_name'];
	}
?>
	">
	<span style="color: red;">bbs,www</span>
</td><tr>

<tr class='list'><td style="text-align: left;">
	站&nbsp;&nbsp;&nbsp;名:<input style="width: 200px;" type="text" name="project_site" value="
<?php 
	if(isset($this->project_info['project_site'])){
		echo $this->project_info['project_site'];
	}
?>
	">
	<span style="color: red;">http://www.baidu.com/</span>
</td><tr>

<tr class='list'><td style="text-align: left;">
	源地址:<input style="width: 500px;" type="text" name="project_source" value="<?php 
	if(isset($this->project_info['project_source'])){
		echo $this->project_info['project_source'];
	}
?>">
	<span style="color: red;">/usr/local/web/bbs/</span>
</td><tr>

<tr class='list'><td style="text-align: left;">
	目标地址命令:<textarea rows="20" cols="100" name="project_target"><?php 
	if(isset($this->project_info['project_target'])){
		echo $this->project_info['project_target'];
	}
?></textarea>
	<span style='color:red;'>多个地址,用换行或(,)逗号 <br/>
	例子:rsync://127.0.0.1/application/</span>
</td><tr>

<tr class='list'><td style="text-align: left;">
	目标地址命令:<textarea rows="20" cols="100" name="project_cmd"><?php
	if(isset($this->project_info['project_cmd'])){
		echo $this->project_info['project_cmd'];
	}
?></textarea>
	<span style='color:red;'>多个命令,用换行或(,)逗号</span>
</td><tr>

<tr class='list'><td style="text-align: left;">
	项目描述:<textarea rows="10" cols="100" name="project_desc"><?php 
	if(isset($this->project_info['project_desc'])){
		echo $this->project_info['project_desc'];
	}
?></textarea>
	<span style='color:red;'>这是论坛</span>
</td><tr>

<tr class='list'><td style="text-align: left;"><input type="submit" name="submit" value="提交"></td><tr>

</form>

</table>