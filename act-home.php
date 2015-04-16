<?php include $root_phy . "connect-sql.php";?>
<?php
$num_record = isset($_POST['num']) ? $_POST['num'] : 10;
$category   = isset($_POST['category']) ? $_POST['category'] : "politics";

$arr = array("politics", "finance", "sports", "entertainment", "fashion", "military", "car", "house", "game");

$a        = 10;
$otherVar = 20;
$third    = 30;
if ($category == "all") {
	foreach ($arr as $val) {
		$sql[$val] = "SELECT * FROM home WHERE category = '$val' ORDER BY id DESC LIMIT $num_record";
		$res[$val] = mysql_query($sql[$val]) or die("数据库连接出现错误：" . mysql_error());
		while ($row_single = mysql_fetch_assoc($res[$val])) {
			$row[$val][] = $row_single;
		}
		$num[$val] = mysql_num_rows($res[$val]);
	}
} else {
	$sql[$category] = "SELECT * FROM home WHERE category = '$category' ORDER BY id DESC LIMIT $num_record";
	$res[$category] = mysql_query($sql[$category]) or die("数据库连接出现错误：" . mysql_error());
	while ($row_single = mysql_fetch_assoc($res[$category])) {
		$row[$category][] = $row_single;
	}
	$num[$category] = mysql_num_rows($res[$category]);
	foreach ($row[$category] as $row_order => $row_term) {
		'title:' . $row_term['title'] . ';title:' . $row_term['link'] . ';title:' . $row_term['id'];
	}
}
?>