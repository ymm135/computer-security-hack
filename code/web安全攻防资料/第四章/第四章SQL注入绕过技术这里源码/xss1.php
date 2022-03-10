<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>XSS利用输出的环境来构造代码</title>
</head>
<body>
	<center>
	<h6>把我们输入的字符串 输出到input里的value属性里</h6>
	<form action="" method="get">
		<h6>请输入你想显现的字符串</h6>
		<input type="text" name="xss_input_value" value="输入"><br />
		<input type="submit">
	</form>
	<hr>
	<?php
		if (isset($_GET['xss_input_value'])) {
			echo '<input type="text" value="'.$_GET['xss_input_value'].'">';
		}else{
			echo '<input type="text" value="输出">';
		}
	?>
	</center>
</body>
</html>