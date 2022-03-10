<?php
error_reporting(0);

    $ext_arr = array('flv','swf','mp3','mp4','3gp','zip','rar','gif','jpg','png','bmp');
    $file_ext = substr($_FILES['file']['name'],strrpos($_FILES['file']['name'],".")+1);
    //exit($_FILES['file']['name']);
    if(in_array($file_ext,$ext_arr))
    {
        $tempFile = $_FILES['file']['tmp_name'];
        // 这句话的$_REQUEST['jieduan']造成可以利用截断上传
        $targetPath = "upload/".$_REQUEST['jieduan'].rand(10, 99).date("YmdHis").".".$file_ext;
        if(move_uploaded_file($tempFile,$targetPath))
        {
            echo '上传成功'.'<br>';
            echo '路径：'.$targetPath;
        }
        else
        {
            echo("上传失败");
        }

    }
else
{
    echo("不允许的后缀");
}

?>