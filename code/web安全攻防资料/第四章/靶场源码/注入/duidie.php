<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");//连接数据库，初始化一个pdo对象
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//设置一个属性
    $id = $_GET['id'];
    $sql = "select * from users where id=$id";
    echo "<hr />";
    echo "当前执行语句为：".$sql;
    echo "<hr />";

    $stmt = $conn->query($sql);

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach($stmt->fetchAll() as $k=>$v) {
        foreach ($v as $key => $value) {
            echo $value;
        }
    }
    $dsn = null;
}
catch(PDOException $e)
{
    echo "error";
}
$conn = null;
?>