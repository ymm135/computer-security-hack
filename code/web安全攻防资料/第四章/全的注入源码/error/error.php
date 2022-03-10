<?
//php语言开端
//php+mysql注入页面编程实现
/*
1.接受参数
2.数据库连接，选择，定义组合，执行
3.返回结果并处理显示
*/





$id = $_GET['id'];//接受参数名x的值并赋值给变量id
$id=str_replace("","",$id);
$conn = mysql_connect("127.0.0.1","error","admin@digo8");//连接数据库
mysql_select_db("sqlin2",$conn);//选择数据库
$sql = "select * from users where id='$id'";//定义sql语句
$result = mysql_query($sql);//执行sql语句
if(!$result){
	die('<p>Error: ' . mysql_error() . '</p>');
} else{
	

while($row = mysql_fetch_array($result)){ //遍历结果显示
	echo "ID：".$row['id']."<br >";
	echo "user：".$row['username']."<br >";	
	echo "pass:".$row['password']."<br >";
	echo "<hr>";
}

	mysql_close($conn);//关闭数据库连接
	echo "now select：".$sql."<hr>";


}




//php语言结尾
?>
        
        