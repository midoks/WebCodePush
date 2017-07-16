
<script type="text/javascript" src="resoures/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="resoures/syntaxhighlighter/scripts/shBrushPhp.js"></script>
<link rel="stylesheet" href="resoures/syntaxhighlighter/styles/shCoreDefault.css">
<script >SyntaxHighlighter.all();</script>

<style>
.main_table {
	margin-top: 20pt;
	margin-right: auto;
	margin-left: auto;
	width:1000px;
}

.main_table tr{
	background: #eee;
  width: 800px;
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

<table class='main_table'>

<tr>
<th style="text-align: center;font-size:16px;font-weight: bold;">代码查看</th>
<tr>

<tr class='list'>
	<td><pre class="brush:php;"><?php echo $this->source_code; ?></pre></td>
<tr>

</table>