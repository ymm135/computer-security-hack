<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=sql", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM users where `id` = '" . $_GET['id'] . "'");

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
