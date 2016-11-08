
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
用户名:<input type="text" name="username" value="<?php echo $this->userinfo['username']; ?>">
</td><tr>

<tr class='list'><td style="text-align: left;">密&nbsp;&nbsp;&nbsp;&nbsp;码:<input type="password" name="pwd" value=""><span style="color:red;">为空,密码不改变</span></td><tr>

<tr class='list'><td style="text-align: left;">
	权限:<select name='type'>
	<option value='0' <?php 
		if($this->userinfo['type'] == 0){
			echo 'selected="selected"';
		}
	?> >系统管理</option>

	<option value='1' <?php 
		if($this->userinfo['type'] == 1){
			echo 'selected="selected"';
		}
	?>>开发者</option>

	<option value='2' <?php 
		if($this->userinfo['type'] == 2){
			echo 'selected="selected"';
		}
	?>>观察者</option>
</select></td><tr>

<tr class='list'>
	<td style="text-align: left;">
	项目:<textarea rows="15" cols="100" name="project"><?php echo $this->userinfo['project']; ?></textarea>
	添加项目,逗号(,)分割
	</td>
<tr>

<tr class='list'><td style="text-align: left;"><input type="submit" name="submit" value="提交"></td><tr>

</form>

</table>