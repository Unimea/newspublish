<?php session_start();?>
<?php include_once 'connect-sql.php';?>
<?php
if(isset($_GET['behavior'])){
	$sql = "UPDATE comment SET ".$_GET['behavior']." = ".$_GET['behavior']." + 1 WHERE id = '".$_GET['id']."'";
	echo mysql_query($sql, $con) ? "评论成功！" : mysql_error();
}
else{
	$i_key = '';
	$i_value = '';
	foreach ($_GET as $key => $value) {
		if (isset($key)) {
			$i_key .= $key . ',';
			$i_value .= "'".$value."'" . ',';
		}
	}
	$i_key = strrev(substr(strrev($i_key), 1));
	$i_value = strrev(substr(strrev($i_value), 1));
	$sql = "INSERT INTO comment ($i_key,username) VALUES ($i_value,'".$_SESSION['username']."')";
	echo mysql_query($sql, $con) ? "评论成功！" : mysql_error();
}
?>
