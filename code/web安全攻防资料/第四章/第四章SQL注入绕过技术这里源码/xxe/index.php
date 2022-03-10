<?php

$xml = file_get_contents("php://input");
$data = simplexml_load_string($xml);

foreach ($data as $key => $value){
	echo "test-" . translate($key) . " «" . $value . "<br>";
}

function translate($str){
	switch ($str){
		case "name":
			return "xing ming";
		case "wechat":
			return "weixin";
		case "public_wechat":
			return "wangzhi";
		case "website":
			return "test";
	}
}
