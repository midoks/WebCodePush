
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
	<td style="width:90px;">名称</td>
	<td>输入内容</td>
	<td>描述</td>

</tr>

<tr class='list'>
	<td>项目名</td>
	<td><input style="width: 400px;" type="text" name="project_name" value="<?php echo isset($this->project_info['project_name']) ? $this->project_info['project_name'] : '';?>"></td>
	<td><span>exp:bbs,www</span></td>
<tr>

<tr class='list'>
	<td>站&nbsp;&nbsp;&nbsp;名</td>
	<td><input style="width: 400px;" type="text" name="project_site" value="<?php echo isset($this->project_info['project_site']) ? $this->project_info['project_site'] : ''; ?>">
	</td>
	<td><span>http://www.baidu.com/</span></td>
<tr>

<tr class='list'>

	<td>源地址</td>
	<td>
		<input style="width: 400px;" type="text" name="project_source" value="<?php echo isset($this->project_info['project_source']) ? $this->project_info['project_source'] : ''; ?>">
	</td>
	
	<td><span>/usr/local/web/bbs/</span></td>
<tr>


<tr class='list'>
	<td>目标地址(测试)</td>
	<td>
		<textarea rows="1" cols="63" name="project_target"><?php echo isset($this->project_info['project_target']) ? $this->project_info['project_target'] : ''; ?></textarea>
	</td>
	
	<td><span>多个地址,用换行或(,)逗号 <br/>
	例子:rsync://127.0.0.1/application/<br/>
	需要配置<a style="font-size: 12px;" target="_blank" href="https://github.com/midoks/midoks/blob/master/wiki/ssh_nopwd.md">SSH免密码登录</a>|<a style="font-size: 12px;" target="_blank" href="https://github.com/midoks/midoks/blob/master/wiki/rsync.md">RSYNC同步配置</a>
	</span> 
	
	</td>
<tr>


<tr class='list'>
	<td>项目描述</td>
	<td>
		<textarea rows="2" cols="63" name="project_desc"><?php echo isset($this->project_info['project_desc']) ? $this->project_info['project_desc'] : ''; ?></textarea>
	</td>
	<td><span>这是论坛</span></td>
<tr>

<tr class='list'><td colspan="3" style="text-align: center;"><input type="submit" name="submit" value="提交"></td><tr>

</form>

</table>