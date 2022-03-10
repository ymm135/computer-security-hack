<?php
$id = base64_decode($_GET['id']);
$conn = mysql_connect("localhost","root","root");
mysql_select_db("test",$conn);
$sql = "select * from users where id=$id";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	echo "ID:".$row['id']."<br >";
	echo "user:".$row['username']."<br >";	
	echo "pass:".$row['password']."<br >";
	echo "<hr>";
}
	mysql_close($conn);
	echo "now use ".$sql."<hr>";

?>

