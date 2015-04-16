<?php session_start(); ?>
<?php $root     =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<?php
$arr  = array(
		'title'     => $_POST['title'],
		'author'    => $_POST['author'],
		'time'      => $_POST['time'],
		'filestamp' => $_POST['filestamp'],
		'content'   => $_POST['content'],
		'category'  => $_POST['category']
	 );

// 获取模板并替换

$cont = file_get_contents($root_phy."template/".$arr['category'].".php");
$res = "";
foreach ($arr as $name => $value) {
	$pattern     = "/(\[REPLACE4".$name."])/";
	$replacement = $value;
	$cont = preg_replace($pattern, $replacement, $cont);
}
// 生成静态文件并返回链接

$file = $arr['category']."/".$arr['filestamp'].".html";
$back = file_put_contents($root_phy.$file, $cont);
if($back > 0){
	echo "0".$root.$file;
}
else{
	echo "1"."对不起，服务器繁忙，请稍后重试！";
}
?>