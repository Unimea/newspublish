<!DOCTYPE html>
<?php session_start(); ?>
<?php $host =  $_SERVER["HTTP_HOST"]; ?>
<?php $root =  "http://".$host."/"; ?>
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
		<title>新闻录入</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="static/reset.css" rel="stylesheet">
		<link href="static/style.css" rel="stylesheet">
		<script type="text/javascript" src="static/jquery.js"></script>
		<script type="text/javascript" src="static/global.js"></script>
		<!-- 配置文件 -->
		<script type="text/javascript" src="static/ueditor/ueditor.config.js"></script>
		<!-- 编辑器源码文件 -->
		<script type="text/javascript" src="static/ueditor/ueditor.all.js"></script>
	</head>
	<body>

		<?php include $root_phy."header.php"; ?>
		<?php !isset($gb_import_page_class)?function(){include $root_phy."class.php";}:""; ?>

		<div class="page import-page">
			<form class="edit image hide" action="<?php echo $root; ?>act-file.php" target="frame" enctype="multipart/form-data" method="POST">
				<div class="line">
					<label for="img">特色图像：</label>
					<span class="special-img">
						<input type="file" name="upfile" value="" readonly>
					</span>
					<div class="btn type2 submit submitImage">提交</div>
					<div class="btn type2 previewImage">预览</div>
				</div>
			</form>
			<iframe id="frame" name="frame" class="hide" src="<?php echo $root; ?>act-file.php" frameborder="0"></iframe>
			<form class="edit" action="#" method="POST">
				<div class="line">
					<label for="category">文章标题：</label>
					<select name="category" id="category" class="select" onchange="changeCategory(this)">
						<?php
						foreach ($category as $key => $value) {
							echo "<option value=".$key.">".$value."</option>";
						}
						?>
					</select>
					<div class="btn self global-in">首页显示</div>
					<input class="hide" name="global_in" value="">
					<div class="btn self global-top">首页置顶</div>
					<input class="hide" name="global_top" value="">
					<div class="btn self category-top">分区置顶</div>
					<input class="hide" name="category_top" value="">
					<div class="btn type2 submit submitArticle">提交</div>
				</div>
				<div class="line">
					<label for="title">文章标题：</label><input type="text" name="title" value="">
				</div>
				<div class="line">
					<label for="author">文章来源：</label><input type="text" name="author" value=""><div class="btn self disabled original">原创</div>
				</div>
				<div class="line">
					<label for="link">文章链接：</label>
					<span class="article-link">
						<?php echo $root.'<span class="ajax-category"></span>'.'/'; ?>
						<input type="text" name="filestamp" value="" readonly>
					</span>
					<div class="btn type2 previewArticle">预览</div>
				</div>
				<script id="container" name="content" type="text/plain">
				这里写你的初始化内容
				</script>
				<!-- 实例化编辑器 -->
				<script type="text/javascript">
				var ue = UE.getEditor('container',{
					autoHeight: true,
					initialFrameHeight: 500,
					initialFrameWidth: 1280
				});
				</script>
				<input class="hide" name="time" value=""><!-- 显示时间 -->
				<input class="hide" name="timestamp" value=""><!-- Unix时间 -->
				<input class="hide" name="sp_image" value="">
			</form>
		</div>
	</body>
	</html>
	<script>
	$(function(){
		username = $(".username").text();
		category = "";
		pullTime();
		changeCategory("[name='category']");
	})
	function pullTime(){
		var time  = new Date();
		var stamp = time.getTime();
		// var stamp = time.getFullYear().toString()+(time.getMonth()+1).toString()+time.getDate().toString();
		// stamp     += time.getHours().toString()+time.getMinutes().toString()+time.getSeconds().toString();
		$("[name='time']").val(time.toLocaleString());
		$("[name='timestamp']").val(stamp);
		var a = stamp.toString() + Math.random().toString().substr(3,3);
		$("[name='filestamp']").val(a);
		//$(".time").val(time.toLocaleDateString());
		//$(".time").val(time.toLocaleTimeString());
	}
	function changeCategory (a) {
		category = $(a).val();
		$(".ajax-category").text(category);
		$("[name='link']").val("<?php echo $root; ?>"+category+"/"+$("[name='filestamp']").val()+".html");
	}
	function postArticle(){
		var title     = $("[name='title']").val();
		var author    = $("[name='author']").val();
		var content   = $("[name='content']").val();
		var time      = $("[name='time']").val();
		var filestamp = $("[name='filestamp']").val();
		var category  = $("[name='category']").val();
		var image     = $("[name='image']").val();
		var back      = "";
		$.ajax({
			async: false,
			type: 'POST',
			url: "<?php echo $root; ?>template.php",
			data: {
				'title': title,
				'author': author,
				'content': content,
				'time': time,
				'filestamp': filestamp,
				'category': category,
				'image': image
			},
			success: function(e){
				back = e;
			}
		});
		return back;
	}
	$(".btn:not('.type2')").on('click',function(event) {
		$("[name='global_top']").val($(".global-top").hasClass('selected')?1:0);
		$(".global-top").hasClass('selected')?$(".global-in").addClass('selected'):"";
		$("[name='global_in']").val($(".global-in").hasClass('selected')||$(".global-top").hasClass('selected')?1:0);
		$("[name='category_top']").val($(".category-top").hasClass('selected')?1:0);
		var a = $("[name='author']").val();
		$("[name='author']").val($(".original").hasClass('selected')?"<?php echo $host; ?>":a);
	});
	$(".btn.disabled").on('click',function(event) {
		event.preventDefault();
		if($(this).hasClass('selected')){
			$(this).prev('input').prop('disabled',true);
		}
		else{
			$(this).prev('input').prop('disabled',false);
		}
	});
	$(".btn.global-top").on("click",function(){
		$("form.image").toggleClass("hide");
	})
	$(".btn.submitArticle").on('click', function(event) {
		$("[name='sp_image']").val(document.getElementById('frame').contentWindow.back());
		event.preventDefault();
		postArticle();
		confirm("是否确认提交？")?$(this).parents("form").attr("action","<?php echo $root; ?>act-post.php").submit():"";
	});
	$(".btn.submitImage").on('click', function(event) {
		event.preventDefault();
		confirm("是否确认提交？")?$(this).parents('form').submit():"";
	});
	$(".previewArticle").on("click",function(){
		event.preventDefault();
		var back  = $.trim(postArticle());
		var state = back.substr(0,1);
		var file  = back.substr(1);
		state     == 0?window.open(file):alert(file);
	})
	$(".previewImage").on("click",function(){
		event.preventDefault();
		var image = document.getElementById('frame').contentWindow.back();
		window.open(image);
	})
	</script>
	<?php
};
?>