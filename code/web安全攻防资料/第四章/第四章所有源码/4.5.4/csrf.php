<?php
	session_start();
	if (isset($_GET['login'])){
		$con=mysqli_connect("localhost","root","123456","test");
		if (mysqli_connect_errno())
		{
			echo "连接失败: " . mysqli_connect_error();
		}
		$username = addslashes($_GET['username']);
		$password = $_GET['password'];
		$result = mysqli_query($con,"select * from users where `username`='".$username."' and `password`='".md5($password)."'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$_SESSION['isadmin'] = 'admin';
			exit("登录成功");
		}else{
			$_SESSION['isadmin'] = 'guest';
			exit("登录失败");
		}
	}else{
		$_SESSION['isadmin'] = 'guest';
	}
	if ($_SESSION['isadmin'] != 'admin'){
		exit("请登录后台");
	}
	if (isset($_POST['submit'])) {
		$con=mysqli_connect("localhost","root","123456","test");
		if (mysqli_connect_errno())
		{
			echo "连接失败: " . mysqli_connect_error();
		}
		if (isset($_POST['username'])) {
			$result1 = mysqli_query($con,"insert into users(`username`, `password`) VALUES ('".$_POST['username']."','".md5($_POST['password'])."')");
			exit($_POST['username']."添加成功");
		}
	}
?>