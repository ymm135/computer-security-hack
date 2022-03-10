<?php
//禁用错误报告
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
header("X-Powered-By: MrYe");
echo "<title>管理员遗失的凭据</title>";
require_once 'conn.php';
$query = "select * from goods ";//构建查询语句
#x-forword-for:yjs

if (isset($_SERVER['HTTP_HOST'])) { 
if(strstr($_SERVER['HTTP_HOST'],"union")||strstr($_SERVER['HTTP_HOST'],"select")||strstr($_SERVER['HTTP_HOST'],"or")){
	echo "您改变了浏览器发送的数据，并输入了<font color='red'>".$_SERVER['HTTP_HOST']."</font><br/>如果正确显示了得到的结果，请截图证明!!!"; 
$query=$query.$_SERVER['HTTP_HOST'];
}else{
	echo "<font color='red'>请帮管理员找到凭据。</font>";
}
} 

$result = mysql_query($query);//执行查询


if (!$result) {
    die("could not to the database\n" . mysql_error());
}

if (mysql_numrows($result)<=0) {
	//恢复1条数据
	$insertSql = "insert into user(gname, gprice,gnum) values('苹果', 1000,20) ";
	$result = mysql_query($insertSql);
	echo "<script type='text/javascript'>alert('数据被挖空，请稍候，数据恢复中~~~~！');location.href='index.php'</script>";
}else{
	echo "<hr/></br>";
	echo "今日水果特价,欢迎选购!"."</br><marquee style='WIDTH: 200px; HEIGHT: 30px' scrollamount='2' direction='left' >清仓大处理，最后一天大甩卖了！！</marquee >";
	echo "<hr/></br>";
while($result_row=mysql_fetch_row(($result)))//取出结果并显示
{
$gname=$result_row[1];
$gprice=$result_row[2];
$gnum=$result_row[3];

echo "名称:".$gname."</br>";
echo "价格:".$gprice."</br>";
echo "数量:".$gnum."</br>";
echo "<hr/>";


}
}





