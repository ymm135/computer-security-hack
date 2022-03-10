<?php
$con=mysqli_connect("localhost","root","123456","test");
// 检测连接
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}

$username = $_GET['username'];

if($result = mysqli_query($con,"select * from users where `username`='".$username."'")){
	echo "ok";
}else{
	echo mysqli_error($con);
}

?>