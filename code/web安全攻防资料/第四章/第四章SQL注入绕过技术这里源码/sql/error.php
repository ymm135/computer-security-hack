<?php
$con=mysqli_connect("localhost","root","root","sql");
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
