<?php
$con=mysqli_connect("localhost","boolean","admin@digo8","sqlin10");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}
$username = $_GET['username'];
if (preg_match("/union|sleep|benchmark/i", $username)) {
	exit("no");
}
$result = mysqli_query($con,"select * from users where `username`='".$username."'");
$row = mysqli_fetch_array($result);
if ($row) {
	exit("yes");
}else{
	exit("no");
}
?>
        