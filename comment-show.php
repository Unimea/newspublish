<?php include_once "config.php";?>
<?php
$filestamp = $_GET['filestamp'];
$sql = "SELECT * FROM comment WHERE filestamp = '$filestamp' ORDER BY time DESC";
$res = mysql_query($sql, $con);
$res_list = array();
while ($res_single = mysql_fetch_assoc($res)) {
	$res_list[] = $res_single;
}
if(!count($res_list)){
	echo "暂无评论，快点抢下沙发！";
}
else{
	?>
	<ul class="comment-list">
		<?php foreach ($res_list as $key => $value) { ?>
		<li class="comment-item" data-id="<?php echo $value['id']; ?>">
			<div class="line">
				<span class="name">@<?php echo $value['username']; ?></span>
				<span class="time">&lt;&lt; <?php echo $value['time']; ?></span>
			</div>
			<div class="line">
				<span class="content">&gt;&gt; <?php echo $value['comment']; ?></span>
			</div>
			<div class="line">
				<span class="reply">回复</span>
				<span class="down" data-behavior="down">呵呵<span class="little">-<?php echo $value['down']; ?></span></span>
				<span class="up" data-behavior="up">点赞<span class="little">+<?php echo $value['up']; ?></span></span>
			</div>
		</li>

		<?php } ?>
	</ul>
	<?php } ?>
