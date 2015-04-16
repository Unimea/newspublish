<!DOCTYPE html>
<?php session_start(); ?>
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>
<?php if(isset($_SESSION['username'])){header("location: ".$root);}; ?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>账号</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link href="static/reset.css" rel="stylesheet">
	<link href="static/style.css" rel="stylesheet">
	<script type="text/javascript" src="static/jquery.js"></script>
	<script type="text/javascript" src="static/global.js"></script>
</head>
<body>
	<?php include $root_phy."header.php"; ?>
	<div class="page login-page">
		<form class="form" action="#" method="POST">
			<div class="line">
				<label for="username">用户名：</label><input type="text" name="username">
			</div>
			<div class="line">
				<label for="password">密码：</label><input type="password" name="password">
			</div>
			<div class="line">
				<div class="btn submit" data-way="login">登陆</div>
				<div class="btn submit" data-way="register">注册</div>
			</div>
		</form>
		<!-- <div class="print"></div> -->
	</div>
</body>
</html>
<script>
	$(function(){
		$(".btn.submit").on('click', function(event) {
			event.preventDefault();
			var way          = $(this).data('way');
			var username_val = $("[name='username']").val();
			var passowrd_val = $("[name='password']").val();
			keep  = 1;
			keep2 = 1;
			$("input").each(function(index) {
				$(this).val() == ""?a(this):b(this);
				$(this).focus(function(){
					$(this).removeClass('warn');
				})
			});
			if(keep){
				if(way == "register"){
					var reg = "(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{6,15}";
					keep2   = passowrd_val.match(reg)?1:0;
				}
				if(keep2){
					$.post("act-account.php",{'username': username_val,'password': passowrd_val, 'ask': way},function(e){
						e         = $.trim(e);
						var state = e.substr(0,1);
						e         = e.substr(1);
						if(state == 0){
							var a = confirm(e + "，页面即将跳转至首页？");
							a?window.location.href = "home.php":"";
						}
						else{
							alert(e);
							$(".print").text(e)
						}
					})
				}
				else{
					alert("密码必须且仅包含数字、大写字母和小写字母，且长度为6-15位！")
				}
			}
		});
	})
	function a(a){
		$(a).addClass('warn');
		keep *= 0;
	}
	function b(a){
		$(a).removeClass('warn');
		keep *= 1;
	}
</script>