<?php
$con = mysql_connect("localhost","root","");
if(!$con){
	die("数据库连接出现错误：".mysql_error());
}
mysql_select_db("newspublish",$con);
mysql_query("set names utf8");
?>