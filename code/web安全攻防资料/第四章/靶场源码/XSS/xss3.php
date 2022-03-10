<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Test</title>
	<script type="text/javascript">
		function tihuan(){
			document.getElementById("id1").innerHTML = document.getElementById("dom_input").value;
		}
	</script>
</head>
<body>
	<center>
	<h6 id="id1">这里会显示输入的内容</h6>
	<form action="" method="post">
		<input type="text" id="dom_input" value="输入"><br />
		<input type="button" value="替换" onclick="tihuan()">
	</form>
	<hr>
	
	</center>
</body>
</html>