<?php
  $con=mysqli_connect("localhost","root","root","test");
  if (mysqli_connect_errno())
  {
  	echo "连接失败: " . mysqli_connect_error();
  }

  if(getenv('HTTP_CLIENT_IP')) {
    $ip = getenv('HTTP_CLIENT_IP');
  } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  } elseif(getenv('REMOTE_ADDR')) {
    $ip = getenv('REMOTE_ADDR');
  } else {
    $ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
  }

  $result = mysqli_query($con,"select * from users where `ip`='$ip'");
  if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
  }
  $row = mysqli_fetch_array($result);
  echo $row['username'] . " : " . $row['password'];
  echo "<br>";
?>

