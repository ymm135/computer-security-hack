<?php
function curl($url){  
	//curl 就是模拟浏览器请求的，比如获取获取远程的网页
    $ch = curl_init();//初始化一个curl会话
    curl_setopt($ch, CURLOPT_URL, $url);//设置抓取的url
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_exec($ch);//运行curl，请求网页
    curl_close($ch);//关闭curl会话
}

$url = $_GET['url'];//从浏览器中传入地址
curl($url);  //传入curl函数中





/*

<?php
// 初始化一个 cURL 对象
$curl = curl_init();

// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL, 'http://www.baidu.com');

// 设置header
curl_setopt($curl, CURLOPT_HEADER, 1);

// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// 运行cURL，请求网页
$data = curl_exec($curl);

// 关闭URL请求
curl_close($curl);

// 显示获得的数据
var_dump($data);
?>


*/







?>



