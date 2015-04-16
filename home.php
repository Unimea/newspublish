<!DOCTYPE html>
<?php session_start(); ?>
<?php $root     =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>新闻首页</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link href="static/reset.css" rel="stylesheet">
	<link href="static/style.css" rel="stylesheet">
	<script type="text/javascript" src="static/jquery.js"></script>
	<script type="text/javascript" src="static/global.js"></script>
</head>
<body>

	<?php include_once $root_phy."config.php"; ?>
	<?php include_once $gb_src['header']; ?>

	<!-- 开始 -->
	<?php
	function product($type){
		$num_record = 10;
		if($type == "latest"){
			$sql["$type"] = "SELECT * FROM article ORDER BY id DESC LIMIT $num_record";
		}
		else{
			$sql["$type"] = "SELECT * FROM home WHERE category = '$type' ORDER BY id DESC LIMIT $num_record";
		}
		$res["$type"] = mysql_query($sql["$type"]) or die("数据库连接出现错误：".mysql_error());
		$num["$type"] = mysql_num_rows($res["$type"]);
		if($num["$type"]){
			while($row_single = mysql_fetch_assoc($res["$type"])){
				$row["$type"][] = $row_single;
			}
			echo "<ul>";
			foreach ($row["$type"] as $row_order => $row_term) {
				echo "<li><a href='".$row_term['category']."/".$row_term['filestamp'].".html"."' data-id='".$row_term['id']."' target='blank' title='".$row_term['title']."'>".$row_term['title']."</a></li>";
			}
			echo "</ul>";
		}
	}
	function productTop($type){
		$num_record = 1;
		$sql["$type"] = "SELECT * FROM home WHERE category = '$type' AND global_top = 1 ORDER BY id DESC LIMIT $num_record";
		$res["$type"] = mysql_query($sql["$type"]) or die("数据库连接出现错误：".mysql_error());
		$num["$type"] = mysql_num_rows($res["$type"]);
		if($num["$type"]){
			while($row_single = mysql_fetch_assoc($res["$type"])){
				$row["$type"][] = $row_single;
			}
			foreach ($row["$type"] as $row_order => $row_term) {
				echo "<li class=top-".$type." style='background-image: url(\"".$row_term['sp_image']."\")'><a href='".$row_term['category']."/".$row_term['filestamp'].".html"."' data-id='".$row_term['id']."' target='blank' title='".$row_term['title']."'>".$row_term['title']."</a></li>";
			}
		}
	}
	?>
	<!-- 结束 -->
	<div class="page home-page">
		<section class="section-1">
			<div class="slide">

				<ul class="title">
					<?php
					foreach ($category as $key => $value) {
						productTop($key);
					}
					?>
				</ul>

				<ul class="fixed-category">
					<?php
					foreach ($category as $key => $value) {
						echo "<li><a href='".$key."'>".$value."</a></li>";
					}
					?>
				</ul>

				<ul class="fixed-button">
					<?php
					for($i = 1;$i <= $category_len;$i++)
						echo "<li data-id=\"".$i."\"></li>";
					?>
				</ul>

			</div>
			<div class="latest <?php echo $type = 'latest'; ?>">
				<h3>最新消息</h3>
				<?php product($type); ?>
			</div>
		</section>
		<!-- category-section -->
		<?php foreach ($category as $key => $value) { ?>
		<section class="section-<?php echo $type = $key; ?>">
			<h3><?php echo $value; ?>消息</h3>
			<?php product($type); ?>
		</section>
		<?php } ?>
	</div>
</body>
</html>
<script>
// $(function(){
// 	ajaxPost("politics");
// })
// function ajaxPost(x){
// 	$.ajax({
// 		type: "POST",
// 		data: {'category':x},
// 		url: "<?php echo $root; ?>act-home.php",
// 		error: function(e){
// 			alert("对不起，服务器暂时繁忙，请稍后再试："+e);
// 		},
// 		success: function(e){
// 			alert(e);
// 		}
// 	})
// }
$(function(){
	$(".fixed-button li").each(function(index){
		$(this).mouseover(function(){
			b(this);
		})
		if($(this).hasClass("selected")){
			a($(this).index());
		}
		function b(x){
			$(x).addClass("selected").siblings("li").mouseout().removeClass("selected");
			a($(x).index());
			clearTimeout();
			// setTimeout(function(){b($(".fixed-button li").eq(($(x).index() + 1 )% 9))},2000);
		}
		function a(num){
			$(".title li").eq(num).addClass("selected").siblings("li").removeClass("selected");
			$(".fixed-category li").eq(num).addClass("selected").siblings("li").removeClass("selected");
			$(".global-nav ul li").eq(num + 1).find("a").addClass("selected").parent("li").siblings("li").find("a").removeClass("selected");;
		}
	})
	$(".fixed-button li").eq(0).mouseover()
})
function test(){
	var node = document.getElementsByTagName("div");
	var len = node.length;
	for(var i = 0;i < len; i++){
		var a = node[i].className.split(" ");
		for(var j = 0;j < len; j++){
			a[j] == "home-page"?alert():"";
		}
	}
}
</script>