<?php
$con=mysqli_connect("localhost","root","root","sql");
// 检测连接
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($con,"select * from users where `username`='".addslashes($username)."' and `password`='".addslashes($password)."'");

$row = mysqli_fetch_array($result);

if ($row) {
	exit("login success");
}else{
	exit("login failed");
}
?>
