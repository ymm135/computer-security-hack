<?php
  $id = $_COOKIE['id'];
  $value = "1";
  setcookie("id",$value);
  $con=mysqli_connect("localhost","root","root","test");
  if (mysqli_connect_errno())
  {
  	echo "连接失败: " . mysqli_connect_error();
  }
  $result = mysqli_query($con,"select * from users where `id`=".$id);
  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  $row = mysqli_fetch_array($result);
  echo $row['username'] . " : " . $row['password'];
  echo "<br>";
?>

