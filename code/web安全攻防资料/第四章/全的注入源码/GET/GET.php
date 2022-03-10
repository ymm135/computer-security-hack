<?
//php���Կ���
//php+mysqlע��ҳ����ʵ��
/*
1.���ܲ���
2.���ݿ����ӣ�ѡ�񣬶�����ϣ�ִ��
3.���ؽ����������ʾ
*/





$id = $_GET['id'];//���ܲ�����x��ֵ����ֵ������id
$id=str_replace("","",$id);
$conn = mysql_connect("localhost","digo8","admin@digo8");//�������ݿ�
mysql_select_db("sqlin1",$conn);//ѡ�����ݿ�
$sql = "select * from users where id='$id'";//����sql���
$result = mysql_query($sql);//ִ��sql���
while($row = mysql_fetch_array($result)){ //���������ʾ
	echo "ID:".$row['id']."<br >";
	echo "name:".$row['username']."<br >";	
	echo "pass:".$row['password']."<br >";
	echo "<hr>";

}
	mysql_close($conn);//�ر����ݿ�����
	echo "now select:".$sql."<hr>";







//php���Խ�β
?>
        
        