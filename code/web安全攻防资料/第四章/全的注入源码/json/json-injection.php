<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/javascript" src=" /www/web/default/sql/json/js/jquery-3.2.0.min.js"></script>
    <script type="application/javascript">

        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };

        function onClik(){
            //var data = $("#form1").serializeArray(); //自动将form表单封装成json
            //alert(JSON.stringify(data));
            var jsonuserinfo = $('#form1').serializeObject();
            //alert(JSON.stringify(jsonuserinfo));
            var xxx= JSON.stringify(jsonuserinfo);
            $.ajax({
                type: "POST",
                url:"/pentest/json-injection.php",
                data:xxx,// 你的formid
                async: true,
                error: function(request) {
                    alert("Connection error");
                },
                success: function(data) {
                    $("#commonLayout_appcreshi").parent().html(data);
                }
            });
        }
    </script>
</head>

<body>
<form id="form1" name="form1" onkeydown="if(event.keyCode==13)return false;">
    <p>用户名 :
        <label for="name"></label>
        <input type="text" name="username" id="name" />
    </p>
    <p> </p>
    <input type="button" name="submit" onclick="onClik();"  value="提交"/>
</form>
</body>
<div id="commonLayout_appcreshi"></div>
</html>

<?php
//including the Mysql connect parameters.
include("/www/web/default/sql/json/sql-connections/sql-connect.php");
error_reporting(0);
$json = file_get_contents('php://input');
$json = urldecode($json);
$username=json_decode($json)->{'username'};
if ($username) {
    @$sql = "SELECT username FROM admin WHERE username LIKE '%" . $username . "%'LIMIT 0,1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    if ($row) {
        //echo '<font color= "#0000ff">';

        echo "<br>";
        echo '<font color= "#0000ff" font size = 3>';
        //echo " You Have successfully logged in\n\n " ;
        echo 'result:' . $row['username'];
        echo "<br>";
        echo "<br>";
        echo "</font>";
        echo "<br>";
        echo "<br>";

        echo "</font>";
    } else {
        echo "<br>";
        echo '<font color= "#0000ff" font size="3">未找到该用户';
        //echo "Try again looser";
        print_r(mysql_error());
        echo "</br>";
        echo "</br>";
        echo "</br>";
        echo "</font>";
    }
}

?>