<style>
.main_table{
	margin-top: 5pt;
	margin-right: auto;
	margin-left: auto;
	width:1000px;
	
}
</style>

<table class='main_table'>
<tr>
	<th style="text-align: center;font-size:16px;font-weight: bold;">
		[<a href="/">首页</a>]|
		[<a href="<?php echo $url = $this->buildUrl('logout', '', 'user'); ?>" target="self">退出</a>]|
		[<a href="<?php echo $url = $this->buildUrl('modpwd', '', 'user'); ?>" target="self">修改密码</a>]
	</th>
<tr>
</table>

</body>
</html>