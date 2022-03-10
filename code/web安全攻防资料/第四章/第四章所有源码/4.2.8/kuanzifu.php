<?php

$conn = mysql_connect('localhost', 'root', '123456') or die('bad!');
mysql_select_db('test', $conn) OR emMsg("数据库连接失败");
mysql_query("SET NAMES 'gbk'",$conn);

$id = addslashes($_GET['id']);
$sql="SELECT * FROM kuanzifu WHERE id='$id' LIMIT 0,1";
$result = mysql_query($sql, $conn) or die(mysql_error()); 
$row = mysql_fetch_array($result);

	if($row)
	{
  	echo $row['username'] . $row['address'];
  	}
	else 
	{
	print_r(mysql_error());
	}      

?>
</font> 
<?php

echo "<br>The Query String is : ".$sql ."<br>";

?>
