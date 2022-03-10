<html>
<head>
	<meta http-equiv=Content-Type content="text/html;charset=utf-8">
	<title>个人信息</title>
</head>

<body>

<?php

$con=mysqli_connect("localhost","root","root","test");
if (mysqli_connect_errno())
{
	echo "连接失败: " . mysqli_connect_error();
}

if (isset($_GET['username'])) {
	$result = mysqli_query($con,"select * from users where `username`='".addslashes($_GET['username'])."'");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	exit(
		'用  户:<input type="text" name="username" value="'.$row['username'].'" > <br />'.
		'密  码:<input type="password" value="'.$row['password'].'" > <br />'.
		'邮  箱:<input type="text" value="'.$row['email'].'" > <br />'.
		'地  址:<input type="text" value="'.$row['address'].'" > <br />'
		);

}else{

	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysqli_query($con,"select * from users where `username`='".addslashes($username)."' and `password` = '".$password."'");
	$row = mysqli_fetch_array($result);

	if ($row) {
		exit("登录成功"."<a href='login.php?username=".$username."' >个人信息</a>");
	}else{
		exit("登录失败");
	}
}
?>

</body>
</html>