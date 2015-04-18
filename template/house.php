<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>[REPLACE4title]</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link href="../static/reset.css" rel="stylesheet">
	<link href="../static/style.css" rel="stylesheet">
	<script type="text/javascript" src="../static/jquery.js"></script>
	<script type="text/javascript" src="../static/global.js"></script>
</head>
<body>
	<div class="php-code">echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/header.html");</div>
	<div class="page article-page politics-page">
		<div class="container">
			<div class="flag">房产</div>
			<div class="title" data-filestamp="[REPLACE4filestamp]">
				[REPLACE4title]
			</div>
			<div class="subtitle">
				<span class="time">
					<span class="label">发布时间：</span> [REPLACE4time]
				</span>
				<span class="author">
					<span class="label">文章来源：</span> [REPLACE4author]
				</span>
			</div>
			<div class="content">
				[REPLACE4content]
			</div>
		</div>
		<div class="aside"></div>
	</div>
</body>
</html>