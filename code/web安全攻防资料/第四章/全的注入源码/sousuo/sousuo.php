<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索型注入</title>
</head>
<body>
<form method="post" action="">
    <input type="text" name="keywords" /> <br>
    <input type="submit" value="查询" />
</form>
</body>
</html>
<?php
/**
 * Cora laboratory - QX
 * 2017.02.16
 */
$link = mysql_connect('localhost','sousuo','admin@digo8')or die('Mysql Cannot Connect');
mysql_select_db('sqlin7');
$id = isset($_POST['keywords'])?$_POST['keywords']:exit('select * from users where id like %$key%');
$sql="select * from users where id like '%".$id."%'";
$unionReplace = str_replace('union','',$sql);
echo '<hr>原始语句：'.$sql;
echo '<hr>REPLACE : '.$unionReplace;
if(!$result = mysql_query($sql)){
    exit(mysql_error($link));
}
$data = mysql_fetch_assoc($result);
echo 'ID   = '.$data['id'].'<br>';
echo 'NAME = '.$data['username'].'<br>';
echo 'PASS  = '.$data['password'].'<br>';
?>
        
        