<!DOCTYPE html>
<?php session_start(); ?>
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>
<?php
$accessRight = isset($_SESSION['accessRight'])?$_SESSION['accessRight']:0;
if($accessRight == 0){
	header("location:".$root."home.php");
}
else{
	?>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>新闻管理</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="static/reset.css" rel="stylesheet">
		<link href="static/style.css" rel="stylesheet">
		<script type="text/javascript" src="static/jquery.js"></script>
		<script type="text/javascript" src="static/global.js"></script>
	</head>
	<body>
		<?php include_once $root_phy."header.php"; ?>
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
					echo "<li><a href='".$row_term['link']."' data-id='".$row_term['id']."' target='blank' title='".$row_term['title']."'>".$row_term['title']."</a></li>";
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
					echo "<li class=top-".$type." style='background-image: url(\"".$row_term['sp_image']."\")'><a href='".$row_term['link']."' data-id='".$row_term['id']."' target='blank' title='".$row_term['title']."'>".$row_term['title']."</a></li>";
				}
			}
		}
		?>
		<div class="page manage-page">
			<div class="left-side">
				<ul>
					<li data-category=''><a href='#'>全部</a></li>
					<?php
					foreach ($category as $key => $value) {
						echo "<li data-category='".$key."'><a href='#'>".$value."</a></li>";
					}
					?>
				</ul>
			</div>
			<div class="content">
				<div class="menu">
					<a href="#" class="btn" data-act="edit">编辑</a>
					<a href="#" class="btn" data-act="del">删除</a>
					<a href="#" class="btn" data-act="btn3"></a>
					<a href="#" class="btn" data-act="btn4"></a>
					<a href="#" class="btn" data-act="btn5"></a>
				</div>
				<div class="items">
					<div class="items-title">
						<span class="check">选择</span>
						<span class="title">新闻标题</span>
						<span class="time">发布时间</span>
						<span class="author">新闻来源</span>
					</div>
					<div class="hide extend-check"><span class="btn self">全选</span><span class="btn self">反选</span></div>
					<div class="items-content"></div>
				</div>
			</div>
		</div>
	</body>
	</html>
	<script>
	$(function(){
		$(".left-side ul li").eq(0).click();
		arr_id = new Array();
	})
	$(".items .items-title .check").on("click",function(){
		$(".extend-check").toggleClass("hide");
	})
	$(".left-side ul li").each(function(){
		$(this).on("click",function(){
			$(this).addClass("selected").siblings("li").removeClass("selected");
			$.ajax({
				type: "POST",
				url: "<?php echo $gb_url['single-list']; ?>",
				data: {category: $(this).data("category")},
				success: function(e){
					$(".items .items-content").html(e)
				}
			})
		})
	})
	$(document).on({
		click:function(){
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
				arr_id[$(this).parent("li").index()] = "";
			}
			else{
				$(this).addClass("selected");
				arr_id[$(this).parent("li").index()] = $(this).data("id");
			}
		}
	},".items .items-content li .check")
	$(document).on({
		click:function(){
			eval($(this).data("act")+"()");
		}
	},".menu .btn")
	function edit(){
		alert()
	}
	function del(){
		var del = "";
		for( var i in arr_id){
			if(arr_id[i]){
				$(".items .items-content li").find(".check[data-id='"+arr_id[i]+"']").end().remove();
				del += "&"+arr_id[i];
			}
		}
		$.ajax({
			type: "POST",
			url: "<?php echo $gb_url['single-list']; ?>",
			data: {del: del,category:$(".left-side ul li.selected").data("category")},
			success: function(e){
				$(".items .items-content").html(e);
			}
		})
	}
	</script>
	<?php
}
?>