<?php
$con=mysqli_connect("localhost","root","123456","test");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}
$id = intval($_GET['id']);
$result = mysqli_query($con,"select * from users where `id`=".$id);
$row = mysqli_fetch_array($result);
$username = $row['username'];
$result2 = mysqli_query($con,"select * from person where `username`='".$username."'");

if($row2 = mysqli_fetch_array($result2)){
	echo $row2['username'] . " : " . $row2['money'];
}else{
	echo mysqli_error($con);
}
?>
