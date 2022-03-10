<?php
//禁用错误报告
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
header("X-Powered-By: MrYe");
echo "<title>把服务器搞摊</title>";
require_once 'conn.php';
$query = "select  ";//构建查询语句
#x-forword-for:yjs

$id=$_REQUEST['type'];

if (isset($_REQUEST['type'])) { 

$query=$query.$id." from goods ";
}else{
	echo "<font color='red'>请帮管理员找到凭据。使用?type=</font>";
}
$result = mysql_query($query);//执行查询


if (!$result) {
    echo "管理员正在盯着你帮他找凭据";
}

if (mysql_numrows($result)<=0) {
	
}else{
	echo "任性的网页!"."</br>";
if($result_row=mysql_fetch_row(($result)))//取出结果并显示
{
$gname=$result_row[0];
$gprice=$result_row[1];

echo "名称:".$gname."</br>";
echo "价格:".$gprice."</br>";
echo "<hr/>";


}
}





