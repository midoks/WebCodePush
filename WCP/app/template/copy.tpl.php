
<style>
.main_table{
	margin-top: 30pt;
	margin-right: auto;
	margin-left: auto;
	width:620px;
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
	padding: 20px;
	background: white;
	font-size:16px;
}

.list td span{
	background: white;
	font-size:16px;
}

</style>
<?php

	$_args = array();
	if(isset($_GET['project'])){
		$_args = array('project'  => $_GET['project']);
	}
?>
<table class='main_table'>
<tr>
<th colspan="8" style="text-align: center;font-size:16px;font-weight: bold;">
文件管理
<b id="copy" style="float: right;color:red;cursor:pointer;">复制</b>
<script type="text/javascript" src="resoures/js/clipboard.min.js"></script>
</th>

<script type="text/javascript">


var clipboard = new Clipboard('#copy', {
    text: function() {

    	var s = "";
    	$(".need_copy_value").each(function(i){
			var v = $(this).text();
			var t = $(".need_copy_value");

			//console.log(i,t);
			if (i == (t.length-1) ){
				s += v;
			} else {
				s += v+"\n";
			}
		});
        return s;
    }
});

//复制成功执行的回调，可选
clipboard.on('success', function(e) {
    alert("复制成功!!");
});

//复制失败执行的回调，可选
clipboard.on('error', function(e) {
    alert("复制失败!!,更换合适的浏览器");
});

</script>

<tr>
<tr>
	<th style="text-align:center;">同步信息</th>
<tr>

<tr class='list'>
<td>
<?php
if(!empty($this->rsync_info)){
	echo $this->rsync_info;
}
?>
</td>
<tr>

<tr>
<td>
</td>
<tr>
</table>