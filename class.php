<?php
	$gb_page_class = ""; // 页面特征变量
?>
<!-- <pre> -->
<?php
/* 路径列表：*/
$gb_url['host']        =  $_SERVER["HTTP_HOST"];
$gb_url['root']        =  "http://".$gb_url['host']."/";
$gb_url['root_phy']    =  $_SERVER["DOCUMENT_ROOT"]."/";
$gb_url_src = array(
	'header','home','import','login','manage',
	'class','connect_sql','single_list','template',
	'act_account','act_account','act_file','act_manage','act_php','act_post'
	);
foreach ( $gb_url_src as $key => $value ) {
	$value = preg_replace("/_/", "-", $value);
	$gb_url[$value] = $gb_url['root'].$value.".php";
	$gb_src[$value] = $gb_url['root_phy'].$value.".php";
}
// echo print_r($gb_url);
?>
<!-- </pre> -->