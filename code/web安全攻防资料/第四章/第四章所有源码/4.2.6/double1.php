<?php
$con=mysqli_connect("localhost","root","123456","test");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}
$username = $_GET['username'];
$password = $_GET['password'];
$result = mysqli_query($con,"insert into users(`username`,`password`) values ('".addslashes($username)."','".md5($password)."')");
?>
