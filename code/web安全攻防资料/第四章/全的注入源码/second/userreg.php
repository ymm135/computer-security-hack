<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include("/www/web/default/sql/second/connect/sql-connect.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
//error_reporting(1);
$username = addslashes($_POST['username']);
$password = $_POST['password'];
if(strlen($username) < 2){
    exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 2){
    exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
//包含数据库连接文件
//检测用户名是否已经存在
$check_query = mysql_query("select id from user where user='$username' limit 1");
if(mysql_fetch_array($check_query)){
    echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
    exit;
}
//写入数据
$sql = "INSERT INTO user(user,password)VALUES('$username','$password')";
if(mysql_query($sql)){
    $id = mysql_query("select id from user where user='$username' limit 1");
    $row = mysql_fetch_array($id);
    setcookie("my_id",$row['id'],time()+3600);
    print_r("注册成功");
    echo '点击此处 <a href="fabu.html">点击发布</a> 重试';
} else {
    echo '抱歉！添加数据失败：',mysql_error(),'<br />';
    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>

        
        