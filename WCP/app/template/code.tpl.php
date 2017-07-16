<link rel="stylesheet" href="resoures/css/default.min.css">
<script type="text/javascript" src="resoures/js/highlight.min.js"></script>
<script >hljs.initHighlightingOnLoad();</script>

<style>
/** {
	padding: 0px;
	margin: 0px;
}*/

.main_table {
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

pre {
    position: relative;
    margin-bottom: 24px;
    border-radius: 3px;
    border: 1px solid #C3CCD0;
    background: #FFF;
    overflow: hidden;
}

/*code {
  display: block;
  padding: 12px 24px;
  overflow-y: auto;
  font-weight: 300;
  font-family: Menlo, monospace;
  font-size: 0.8em;
}*/

code .has-numbering {
    margin-left: 21px;
}

.pre-numbering {
    position: absolute;
    top: 0;
    left: 0;
    width: 20px;
    padding: 12px 2px 12px 0;
    border-right: 1px solid #C3CCD0;
    border-radius: 3px 0 0 3px;
    background-color: #EEE;
    text-align: right;
    font-family: Menlo, monospace;
    font-size: 0.8em;
    color: #AAA;
}

table span{
	font-size: 12px;
	height: 20px;
	line-height: 20px;

}
</style>

<table class='main_table'>

<tr>
<th colspan="7" style="text-align: center;font-size:16px;font-weight: bold;">代码查看</th>
<tr>

<tr class='list'>
	<td><div><pre><code class="brush:php;"><?php echo $this->source_code; ?></code></pre></div></td>
<tr>

</table>

<script type="text/javascript">
// $(function(){
//     $('pre code').each(function(){
//         var lines = $(this).text().split('\n').length - 1;
//         var $numbering = $('<ul/>').addClass('pre-numbering');
//         $(this)
//             .addClass('has-numbering')
//             .parent()
//             .append($numbering);
//         for(i=1;i<=lines;i++){
//             $numbering.append($('<li/>').text(i));
//         }
//     });
// });

</script>