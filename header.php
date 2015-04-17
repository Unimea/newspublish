<?php $root     =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>
<?php include_once $root_phy."config.php"; ?>
<div class="global-nav">
	<ul>
		<li><a data-rel="root" data-home="" href="home.php">首页</a></li>
		<?php foreach ($category as $key => $value) { ?>
		<li><a data-rel="root" data-<?php echo $key; ?>="" href="<?php echo $key; ?>"><?php echo $value; ?></a></li>
		<?php } ?>

<!-- 		<li class="username right"><a href=''></a></li>
		<ul>
			<li class="hover"><a href="act-account.php?out=0">退出登录</a></li>
			<li class="hover" data-rel="import"><a href="import.php">投稿</a></li>
		</ul>
		<li class="username right"><a href="about.php">欢迎您！</a></li>

		<li class="right"><a href="login.php">登陆</a></li>
		<li class="right"><a href="login.php" target="blank">注册</a></li> -->

	</ul>
</div>
<script>
var nav_rel = window.location.pathname;
nav_rel = nav_rel.replace(/^(\/)(\w*)(\/||\.)(.*)$/,"$2");
$(".global-nav ul li a[data-"+nav_rel+"]").addClass("selected");
</script>
//add first line.
//add second line.

