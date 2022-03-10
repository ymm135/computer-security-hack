<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>web</title>
</head>

<?php
$conn = mysql_connect('localhost','guolu','admin@digo8');
if(!$conn){
die("数据库连接失败".mysql_error());
}
mysql_select_db("sqlin15");
if(isset($_GET['id']))
{
$id=$_GET['id'];
$id = str_replace("union", "", $id);
$id = str_replace("and", "", $id);
$id = str_replace("/**/", "", $id);
$id = str_replace("select", "", $id);
$id = str_replace(" ", "1", $id);
$id = str_replace("where", "", $id);

$sql="SELECT * FROM users WHERE id=$id";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);


	if($row)
	{
  	echo 'Your Login name:'. $row['username'];
  	echo "<br>";
  	echo 'Your Password:' .$row['password'];
  	echo "</font>";
  	}
	else 
	{
	print_r(mysql_error());
	echo "</font>";  
	}
}
?>
</body>
</html>
