
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
	<td>过滤文件</td>
	<td style="text-align: left;">
		<textarea rows="2" cols="63" name="var[filter]"><?php echo isset($this->conf['filter']) ? $this->conf['filter'] : ''; ?></textarea>
		</td>
	<td><span>过滤一些文件,不同步到目标地址去!!!(,分割)例如:conf,svn</span></td>
<tr>

<tr class='list'>
	<td>隐藏文件</td>
	<td style="text-align: left;">
		<textarea rows="2" cols="63" name="var[hidden]"><?php echo isset($this->conf['hidden']) ? $this->conf['hidden'] : ''; ?></textarea>
		</td>
	<td><span>隐藏一些文件!!!(,分割)例如:.,..,DS_Store,metadata</span></td>
<tr>

<tr class='list'>
	<td>可看文件</td>
	<td style="text-align: left;">
		<textarea rows="2" cols="63" name="var[source_view]"><?php echo isset($this->conf['source_view']) ? $this->conf['source_view'] : ''; ?></textarea>
		</td>
	<td><span>可以观察文件(,分割)例如:html,php</span></td>
<tr>


<tr class='list'>
	<td colspan="3" style="text-align: center;">
		<input type="submit" name="submit" value="提交">
	</td>
<tr>

</form>

</table>