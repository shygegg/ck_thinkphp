<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <xmp></xmp>
    <pre style='color:#55cc66;background:#001800;'></pre>
    <pre style='color:#d1d1d1;background:#000000;'></pre>
    <pre style='color:#000020;background:#f6f8ff;'></pre>
    <pre style='color:#000000;background:#f1f0f0;'></pre>
    1、mysqli面向过程：
    <pre style='color:#000020;background:#f1f0f0;'>

    <span style="color:red;">mysqli连接：</span>
    //1.连接
    $link=mysqli_connect('localhost','root','root','test') or die('Connect Error:'.mysqli_connect_errno().":".mysqli_connect_error());

    //2.设置编码方式
    mysqli_set_charset($link,'UTF8');

    //3.执行SQL查询
    $sql="INSERT user(username,password,age) VALUES('imooc1','imooc1',22);";
    $res=mysqli_query($link, $sql);
    if($res){
    	echo 'AUTO_INCREMENT:'.mysqli_insert_id($link);
    	echo 'AFFECTED ROWS:'.mysqli_affected_rows($link);
    }else{
    	echo 'ERROR:';
    	echo mysqli_errno($link).':'.mysqli_error($link);
    }

    $sql="UPDATE user SET age=age+10 WHERE id=41;";
    $sql.="DELETE FROM user WHERE id=40";
    $res=mysqli_multi_query($link, $sql);	//执行多条语句查询
    var_dump($res);

    //4.关闭连接
    mysqli_close($link);
    ============================================================================
    //执行SQL查询
    $sql="SELECT id,username,password,age FROM user";
    $result=mysqli_query($link,$sql);
    if($result && mysqli_num_rows($result)>0){
    	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    		//print_r($row);
    		$rows[]=$row;
    	}
    }
    //print_r($rows);
    //释放结果集
    mysqli_free_result($result);
    mysqli_close($link);
    <span style="color:red;">预处理：</span>
    $sql="INSERT user(username,password,age) VALUES(?,?,?);";
    $stmt=mysqli_prepare($link, $sql);
    $username='test123';
    $password='test123';
    $age=123;
    mysqli_stmt_bind_param($stmt, 'ssi',$username,$password,$age);
    $res=mysqli_stmt_execute($stmt);
    </pre>

    2、mysqli面向对象：
    <pre style='color:#000020;background:#f1f0f0;'>
    <span style="color:red;">mysqli连接：</span>
    //1.连接
    $link=mysqli_connect('localhost','root','root','test') or die('Connect Error:'.mysqli_connect_errno().":".mysqli_connect_error());

    //2.设置编码方式
    mysqli_set_charset($link,'UTF8');

    //3.执行SQL查询
    $sql="INSERT user(username,password,age) VALUES('imooc1','imooc1',22);";
    $res=mysqli_query($link, $sql);
    if($res){
    	echo 'AUTO_INCREMENT:'.mysqli_insert_id($link);
    	echo 'AFFECTED ROWS:'.mysqli_affected_rows($link);
    }else{
    	echo 'ERROR:';
    	echo mysqli_errno($link).':'.mysqli_error($link);
    }

    $sql="UPDATE user SET age=age+10 WHERE id=41;";
    $sql.="DELETE FROM user WHERE id=40";
    $res=mysqli_multi_query($link, $sql);	//执行多条语句查询
    var_dump($res);

    //4.关闭连接
    mysqli_close($link);

    <span style="color:red;">预处理：</span>
    $sql="INSERT user(username,password,age) VALUES(?,?,?);";
    $stmt=mysqli_prepare($link, $sql);
    $username='test123';
    $password='test123';
    $age=123;
    mysqli_stmt_bind_param($stmt, 'ssi',$username,$password,$age);
    $res=mysqli_stmt_execute($stmt);
    </pre>

    3、mysqli 其他连接方式：
    <pre style='color:#000020;background:#f1f0f0;'>
    $mysqli = new mysqli('localhost','root','root');//建立到MySQL数据库的连接
    $mysqli->select_db('test');//打开指定的数据库

    $mysql = new mysqli();
    $mysqli ->connect('localhost','root','root');

    $mysqli = @new mysqli('localhost','root','','test');//建立连接同时打开指定数据库
    if($mysqli->connect_errno){
        die('Connect Error:'.$mysqli->connect_error());
    }
    $mysqli->set_charset('utf8');
    $sql=<<<EOF

EOF;
    $res = $mysqli->query();
    var_dump($res);
    /** SELECT/DESC/DESCRIBE/SHOW/EXPLAIN 执行成功返回 mysqli_result 对象，失败返回false
        对于其他 sql 语句的执行，执行成功返回 true,否则返回 false
    **/
    $mysqli->close();//关闭连接


    </pre>
</pre>
</body>
</html>