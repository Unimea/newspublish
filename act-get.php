
<?php $root =  "http://".$_SERVER["HTTP_HOST"]."/"; ?>
<?php $root_phy =  $_SERVER["DOCUMENT_ROOT"]; ?>

<?php include $root_phy."connect-sql.php"; ?>
<?php
session_start();
$category = $_POST['category'];
$title = $_POST['title'];
$author = $_POST['author'];
$timestamp = $_POST['timestamp'];
$link = $_POST['link'];
$global_top = $_POST['global_top'];
$category_top = $_POST['category_top'];
$content = $_POST['content'];
$content_file = $_SERVER['DOCUMENT_ROOT']."/article/".$timestamp.".txt";
file_put_contents($content_file, $content);
$sql = "INSERT INTO article (category, global_top, category_top, title, author, link, content_file) VALUES ($category, $global_top, $category_top, $title, $author, $link, $content_file) ";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
mysql_close($con);
?>