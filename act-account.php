
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<?php include $root_phy."connect-sql.php"; ?>
<?php
session_start();
error_reporting(0);

if(isset($_GET['out'])){
	session_destroy();
	die(header("location:".$root."home.php"));
}

$username = $_POST['username'];
$password = md5($_POST['password']);
$ask      = $_POST['ask'];

$sql = "SELECT * FROM account WHERE username = '$username'";
$res = mysql_query($sql,$con);
if (!$res)
{
	die('1Error: ' . mysql_error() . "服务器繁忙，请稍后再试");
}
$arr = mysql_fetch_array($res);
$num = mysql_num_rows($res);

switch ($ask) {
	case 'register':
	{
		if($num == 0){
			$sus = mysql_query("INSERT INTO account (username, password) VALUES ('$username', '$password')");
			if($sus){
				echo "0注册成功";
				$_SESSION['username']    = $username;
				$_SESSION['accessRight'] = 0;
			}
			else{
				die('1Error: ' . mysql_error() . "服务器繁忙，请稍后再试1");
			}
		}
		else{
			echo "1此用户已存在";
		}
	}
	break;
	default:
	{
		if($num == 0){
			echo "1此用户不存在，请检查用户名是否正确，或者注册一个新账号";
		}
		else if($arr['password'] == $password){
			$_SESSION['username']    = $username;
			$_SESSION['accessRight'] = $arr['accessRight'];
			echo "0成功登陆";
		}
		else{
			echo "1密码错误";
		}
	}
	break;
}
mysql_close($con);
?>