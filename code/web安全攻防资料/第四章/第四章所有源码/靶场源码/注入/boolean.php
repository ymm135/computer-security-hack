<?php
$con=mysqli_connect("localhost","root","root","test");
// 检测连接
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}

$id = $_GET['id'];

$sql = "select * from users where id='$id'";

$result = mysqli_query($con,$sql);

$row = mysqli_fetch_array($result);

if ($row) {
	exit("yes");
}else{
	exit("no");
}


?>