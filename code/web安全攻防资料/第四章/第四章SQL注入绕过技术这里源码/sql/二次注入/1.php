<?php
    $con=mysqli_connect("localhost","root","root","sql");
    if (mysqli_connect_errno())
    {
        echo "连接失败: " . mysqli_connect_error();
    }
    $username = $_GET['username'];
    $password = $_GET['password'];
    $result = mysqli_query($con,"insert into users(`username`,`password`) values ('".addslashes($username)."','".md5($password)."')");
    echo "新 id 为: " . mysqli_insert_id($con);
    setcookie("user", "Alex Porter", time()+3600);
    ?>
