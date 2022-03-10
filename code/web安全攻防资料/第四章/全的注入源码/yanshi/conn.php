<?php
$host = 'localhost';
$database = 'sqlin8';
$username = 'yanshi';
$password = 'admin@digo8';

$connection = mysql_connect($host, $username, $password);//连接到数据库
mysql_query("set names 'utf8'");//编码转化
if (!$connection) {
    die("could not connect to the database.\n" . mysql_error());//诊断连接错误
}
$selectedDb = mysql_select_db($database);//选择数据库
if (!$selectedDb) {
    die("could not to the database\n" . mysql_error());
}