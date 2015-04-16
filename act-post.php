
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<?php include $root_phy."connect-sql.php"; ?>
<?php
session_start();
$last_page = $_SERVER["REQUEST_URI"];
foreach ($_POST as $key => $value) {
	$data[$key] = $value;
}
$data['content_link'] = $root_phy."/article/".$data['filestamp'].".txt";

file_put_contents($data['content_link'], $data['content']);

$sql = "INSERT INTO article (filestamp,category,title,author,time,global_in,global_top,category_top,sp_image) VALUES ('".$data['filestamp']."','".$data['category']."','".$data['title']."','".$data['author']."','".$data['time']."','".$data['global_in']."','".$data['global_top']."','".$data['category_top']."','".$data['sp_image']."')";
if (!mysql_query($sql,$con))
{
	die('Error: ' . mysql_error() . "服务器繁忙，请稍后再试");
	header("location: ".$last_page);
}
echo "1 record added";
//如果置顶的话，插入 home 表:
if($data['global_in']){
	if($data['global_top']){
		if(mysql_num_rows(mysql_query("SELECT * FROM home WHERE category = '".$data['category']."' AND global_top = 1 "))){
			$sql = "UPDATE home SET filestamp = '".$data['filestamp']."', global_top = '".$data['global_top']."', category_top = '".$data['category_top']."', category = '".$data['category']."', title = '".$data['title']."', author = '".$data['author']."', time = '".$data['time']."', sp_image = '".$data['sp_image']."'WHERE category = '".$data['category']."' AND global_top = 1 ";
		}
		else{
			$sql = "INSERT INTO home (filestamp, global_top, category_top, category, title, author, time, sp_image) VALUES ('".$data['filestamp']."','".$data['global_top']."','".$data['category_top']."','".$data['category']."','".$data['title']."','".$data['author']."','".$data['time']."','".$data['sp_image']."')";
		}
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error() . "服务器繁忙，请稍后再试2");
			header("location: ".$last_page);
		}
	}
	else{
		$sql = "INSERT INTO home (filestamp, global_top, category_top, category, title, author, time) VALUES ('".$data['filestamp']."','".$data['global_top']."','".$data['category_top']."','".$data['category']."','".$data['title']."','".$data['author']."','".$data['time']."')";
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error() . "服务器繁忙，请稍后再试2");
			header("location: ".$last_page);
		}
	}
}
mysql_close($con);
header("location: ".$root.$data['category']."/".$data['filestamp'].".html");
?>