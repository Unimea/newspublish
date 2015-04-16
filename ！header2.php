
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>
<div class="global-nav">
	<ul>
		<li><a href="<?php echo $root; ?>home.php">首页</a></li>

		<li><a href="<?php echo $root; ?>politics">时政</a></li>
		<li><a href="<?php echo $root; ?>finance">财经</a></li>
		<li><a href="">体育</a></li>
		<li><a href="">娱乐</a></li>
		<li><a href="">时尚</a></li>
		<li><a href="">军事</a></li>
		<li><a href="">汽车</a></li>
		<li><a href="">房产</a></li>
		<li><a href="">游戏</a></li>
		<?php
		if(isset($_SESSION['username']))
		{
			echo "<li class=\"username right\"><a href='#'>".$_SESSION['username']."</a></li>";
			echo "<ul>";
			echo "<li class=\"hover\"><a href=\"".$root."act-account.php?out=0\">退出登录</a></li>";
			echo "<li class=\"hover\"><a href=\"".$root."import.php\">投稿</a></li>";
			echo "</ul>";
			echo "<li class=\"username right\"><a href=\"".$root."about.php\">欢迎您！</a></li>";
		}
		else{
			echo "<li class=\"right\"><a href=\"".$root."login.php\">登陆</a></li>";
			echo "<li class=\"right\"><a href=\"<?php echo $root; ?>login.php\" target=\"blank\">注册</a></li>";
		}
		?>
	</ul>
</div>