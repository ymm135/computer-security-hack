<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>留言板</title>
</head>
<body>
	<center>
	<h6>输入留言内容</h6>
	<form action="" method="post">
		标题：<input type="text" name="title"><br />
		内容：<textarea name="content"></textarea><br />
		<input type="submit">
	</form>
	<hr>
	<?php

		$con=mysqli_connect("localhost","root","root","test");
		if (mysqli_connect_errno())
		{
			echo "连接失败: " . mysqli_connect_error();
		}
		if (isset($_POST['title'])) {
			$result1 = mysqli_query($con,"insert into xss(`title`, `content`) VALUES ('".$_POST['title']."','".$_POST['content']."')");
		}

		$result2 = mysqli_query($con,"select * from xss");

		echo "<table border='1'><tr><td>标题</td><td>内容</td></tr>";
		while($row = mysqli_fetch_array($result2))
		{
			echo "<tr><td>".$row['title'] . "</td><td>" . $row['content']."</td>";
		}
		echo "</table>";
	?>
	</center>
</body>
</html>