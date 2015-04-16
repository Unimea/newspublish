<?php
	$gb_page_config = ""; // 页面特征变量
?>
<?php $root     =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<?php include_once $root_phy."connect-sql.php"; ?>
<?php include_once $root_phy."class.php"; ?>
<?php
$sql       = "SELECT name,label FROM structure WHERE first_nav = 1 ORDER BY id ASC";
$class_res = mysql_query($sql);
while( $res_single = mysql_fetch_assoc($class_res) ){
	$class_row[] = $res_single;
}
foreach ($class_row as $key => $value) {
	$category[$value['label']] = $value['name'];
}
$category_len = count($category);
?>