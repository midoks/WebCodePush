<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="zh-CN">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="zh-CN">
<![endif]-->
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta charset="UTF-8" />
<script type="text/javascript" src="resoures/js/jquery.min.js"></script>
<title>DCP「网站代码同步」</title>
<style>
* {
	margin:0px;
	padding:0px;
	font: small sans-serif;
	font-size: 14px;
	/*line-height: 14px;*/
	outline:none;
}

a {
	font-size:14px;
	text-decoration:none;
}



textarea:focus {outline: none;}
/*textarea {resize:none;}*/
textarea {padding: 4px;}
    
</style>
</head>
<body>

<div style="margin:8px;text-align: right;">

<?php if (isset($this->userinfo['username'])) { ?>
<span>(<?php echo $this->userinfo['username'];?>) | </span>
<?php } ?>

<span><a href='<?php echo $url = $this->buildUrl('index', ''); ?>'>部署代码</a></span>
<span>|</span>
<span><a href='<?php echo $url = $this->buildUrl('project_list', ''); ?>'>项目列表</a></span>


<?php
	//系统管理权限
	if ($this->userinfo['type'] == 0){
?>
	<span>|</span>
	<span><a href='<?php echo $url = $this->buildUrl('index', '', 'sys'); ?>'>系统设置</a></span>
<?php		
	}
?>
	

</div>

<hr />