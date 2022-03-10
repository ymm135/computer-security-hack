<?php
$con=mysqli_connect("localhost","root","root","sql");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}
$id = $_GET['id'];
if (preg_match("/union|sleep|benchmark/i", $username)) {
	exit("no");
}
$result = mysqli_query($con,"select * from users where `id`='".$id."'");
$row = mysqli_fetch_array($result);
if ($row) {
	exit("yes");
}else{
	exit("no");
}
?>
