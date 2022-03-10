<?php
$con=mysqli_connect("localhost","root","root","test");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

$username = $_GET['username'];
$sql = "select * from users where 'username'='$username'";
if($result = mysqli_query($con,$sql)){
    echo "ok";
}else{
    echo mysqli_error($con);
}

?>