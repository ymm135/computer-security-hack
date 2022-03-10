<?php
//including the Mysql connect parameters.
include("../sql-connections/sql-connect.php");
error_reporting(0);
// take the variables
if(isset($_GET['id']))
{
    $id=$_GET['id'];

//logging the connection parameters to a file for analysis.

// connectivity


    $sql="SELECT * FROM admin WHERE id='$id' LIMIT 0,1";
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);

    if($row)
    {

        echo 'Your Login name:'. $row['username'];
        echo "<br>";
        echo 'Your Password:' .$row['password'];
        echo "</font>";
    }
    else
    {

        print_r(mysql_error());
        echo "</font>";
    }
}
else { echo "Please input the ID as parameter with numeric value";}

?>