
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<div id='back'>
	Stored in:
	<span id='back-link'></span>
</div>
<script>
function back(){
	return document.getElementById("back-link").innerHTML;
}
</script>
<?php
session_start();
$last_page = $_SERVER["REQUEST_URI"];
$file      = isset($_FILES["upfile"])?$_FILES['upfile']:die();
?>
<?php
if ((($file["type"] == "image/x-png") ||($file["type"] == "image/gif") || ($file["type"] == "image/jpeg") || ($file["type"] == "image/pjpeg")) && ($file["size"] < 2048000))
{
	if ($file["error"])
	{
		die("Return Code: " . $file["error"] . "<br />");
	}
	$dir     = $root."upload/";
	$dir_phy = $root_phy."upload/";
	move_uploaded_file($file["tmp_name"], $dir_phy.$file["name"]);
	$newname =  preg_replace("/([^\.]+)(\.)(png||jpg||jpeg||gif)/", time().sprintf("%03d",rand(0,999))."$2$3", $file['name']);
	rename($dir_phy.$file["name"], $dir_phy.$newname);
	?>

	<?php
	echo "<script>document.getElementById('back-link').innerHTML=";
	echo $dir.$newname;
	echo "</script>";
	?>

	<?php
}
else
{
	echo "注意：图片大小不能超过 2M ！";
}
?>