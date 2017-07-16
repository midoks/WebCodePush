
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

<tr class='list'>
	<td>账号</td>
	<td style="text-align: left;"><?php echo $this->userinfo['username']; ?></td>
<tr>

<tr class='list'>
	<td>密码</td>
	<td style="text-align: left;"><input type="password" name="pwd" value=""><span style="color:red;"></span>
	</td>
<tr>


<tr class='list'>
	<td colspan="2" style="text-align: center;">
		<input type="submit" name="submit" value="提交">
	</td>
<tr>

</form>

</table>