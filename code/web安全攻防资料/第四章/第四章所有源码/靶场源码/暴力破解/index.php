<?php
$con=mysqli_connect("localhost","root","root","test");
// 检测连接
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from users where username='$username' and password='$password'";

$result = mysqli_query($con,$sql);

$row = mysqli_fetch_array($result);

if ($row) {
	exit("login success");
}else{
	exit("login failed");
}
?>