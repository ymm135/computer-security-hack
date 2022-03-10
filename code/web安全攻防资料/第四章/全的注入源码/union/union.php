<?php
$con=mysqli_connect("localhost","union","admin@digo8","sqlin13");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}
$id = $_GET['id'];
$result = mysqli_query($con,"select * from users where `id`=".$id);
$row = mysqli_fetch_array($result);
echo $row['username'] . " : " . $row['address'];
echo "<br>";
?>