<?
//php���Կ���
//php+mysqlע��ҳ����ʵ��
/*
1.���ܲ���
2.���ݿ����ӣ�ѡ�񣬶�����ϣ�ִ��
3.���ؽ����������ʾ
*/


//http://127.0.0.1/test.php?x=Mg== 

$id = base64_decode($_GET['id']);//���ܲ�����x��ֵ����ֵ������id
$id=str_replace("","",$id);
$conn = mysql_connect("127.0.0.1","base64","admin@digo8");//�������ݿ�
mysql_select_db("sqlin9",$conn);//ѡ�����ݿ�
$sql = "select * from users where id=$id";//����sql���
$result = mysql_query($sql);//ִ��sql���
while($row = mysql_fetch_array($result)){ //���������ʾ
	echo "ID:".$row['id']."<br >";
	echo "user:".$row['username']."<br >";	
	echo "pass:".$row['password']."<br >";
	echo "<hr>";

}
	mysql_close($conn);//�ر����ݿ�����
	echo "now use".$sql."<hr>";







//php���Խ�β
?>
        
        