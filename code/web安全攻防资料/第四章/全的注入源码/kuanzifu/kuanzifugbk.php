<?php

$conn = mysql_connect('localhost', 'kuanzifugbk', 'admin@digo8') or die('bad!');
mysql_query("SET NAMES 'binary'");
mysql_select_db('sqlin5', $conn) OR emMsg("数据库连接失败");

$id_tmp = addslashes($_GET['id']);
$id = iconv("gbk","utf-8",$id_tmp);
$sql="SELECT * FROM users WHERE id='$id' LIMIT 0,1";
$result = mysql_query($sql, $conn) or die(mysql_error()); 
$row = mysql_fetch_array($result);

	if($row)
	{
  	echo '<font>';	
  	echo 'Your Login name:'. $row['username'];
  	echo "<br>";
  	echo 'Your Password:' .$row['password'];
  	echo "</font>";
  	}
	else 
	{
	echo '<font color= "#FFFF00">';
	print_r(mysql_error());
	echo "</font>";  
	}      

?>
</font> 
<?php

echo "<br>The Query String is : ".$sql ."<br>";

?>