

<style type="text/css">

.login{
	width: 300px;
	height: 200px;
	margin: 100px auto auto auto;
	/*background-color: red;*/
	border: 1px solid gray;
}	

</style>
<form id='main_upload' method='POST'>
<div class='login'>

	<div  style="width:200px;margin: 70px auto auto auto;">
		<table>

		<?php
			if(!empty($this->login_err)){
				echo('<tr><td colspan="2" style="color:red;text-align:center;">'.$this->login_err.'</td></tr>');
			}
		?>

		<tr>
		<td style="text-align:right;">用户名:</td>
		<td><input type="text" name="user" value="" /> </td>
		<tr>

		<tr>
		<td style="text-align:right;">密码:</td>
		<td><input type="password" name="pwd" value="" /> </td>
		<tr>

		<tr>
		<td colspan="2" style="text-align:center;">
			<input type="submit" name="submit" value="提交">
		</td>
		</tr>


		</table>

	</div>

</div>
</form>