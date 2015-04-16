<?php $root     =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]."/"; ?>

<?php include_once $root_phy."connect-sql.php"; ?>
<?php include_once $root_phy."class.php"; ?>

<ul class="items-list">
	<?php
	foreach ($_POST as $key => $value) {
		$data[$key] = $value;
	}
	if(isset($data['del'])){
		$arr_tmp = split("&", $data['del']);
		foreach ($arr_tmp as $key => $value) {
			mysql_query("DELETE FROM article WHERE filestamp = '".$value."'",$con);
			mysql_query("DELETE FROM home WHERE filestamp = '".$value."'",$con);
		}
	}
	$sql = ($data['category'] == "")?"SELECT * FROM article ORDER BY id DESC":"SELECT * FROM article WHERE category = '".$data['category']."' ORDER BY id DESC";
	$res = mysql_query($sql,$con);
	mysql_num_rows($res)?"":die("No Data Return.");
	while($res_single = mysql_fetch_assoc($res)){
		$row[] = $res_single;
	}
	foreach ($row as $key => $value) {
		?>
		<li>
			<span class="check" data-id="<?php echo $value['filestamp']; ?>"></span>
			<span class="title"><a href="<?php echo $root.$value['category']."/".$value['filestamp'].".html"; ?>" target="_blank" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></span>
			<span class="time"><?php echo $value['time']; ?></span>
			<span class="author"><?php echo $value['author']; ?></span>
		</li>
		<?php
	}
	?>
</ul>