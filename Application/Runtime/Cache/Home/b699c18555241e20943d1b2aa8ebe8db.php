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
        header('content-type:text/html;charset=utf-8');
        $mysqli=new mysqli('localhost','root','root','test');
        if($mysqli->errno){
        	die('Connect Error'.$mysqli->error);
        }
        $mysqli->set_charset('UTF8');
        $username=$_POST['username'];
            //$username=$mysqli->escape_string($username);
        $password=md5($_POST['password']);
        // $sql="SELECT * FROM user WHERE username='<?php echo ($username); ?>' AND password='<?php echo ($password); ?>'";
        // $mysqli_result=$mysqli->query($sql);
        // if($mysqli_result && $mysqli_result->num_rows>0){
        // 	echo '登陆成功';
        // }else{
        // 	echo '登陆失败';
        //}

        //$sql="SELECT id,username,password,age FROM user WHERE id=".$id;
        //$mysqli_result=$mysqli->query($sql);
        //if($mysqli_result && $mysqli_result>0){
        //	$row=$mysqli_result->fetch_assoc();
        //}

        $sql="SELECT * FROM user WHERE username=? AND password=?";
        $mysqli_stmt=$mysqli->prepare($sql);
        $mysqli_stmt->bind_param('ss',$username,$password);
        if($mysqli_stmt->execute()){
        	$mysqli_stmt->store_result();
        	if($mysqli_stmt->num_rows>0){
        		echo '登陆成功';
        	}else{
        		echo '登陆失败';
        	}
        }
        //释放结果集
        $mysqli_stmt->free_result();
        //关闭预处理语句
        $mysqli_stmt->close();
        $mysqli->close();



    3、mysqli -------------- tip：
    <pre style='color:#000020;background:#f1f0f0;'>
    $mysqli = new mysqli('localhost','root','root');    //建立到MySQL数据库的连接
    $mysqli->select_db('test');    //打开指定的数据库

    $mysql = new mysqli();
    $mysqli ->connect('localhost','root','root');
    $mysqli->select_db('test');


    header('content-type:text/html;charset=utf-8');
    //1.建立到MySQL的连接
    $mysqli = @new mysqli('localhost','root','root','test');     //建立连接的同时打开指定数据库
    if($mysqli->connect_errno){                             //$mysqli->connect_errno:得到连接产生的错误编号
        die('Connect Error:'.$mysqli->connect_error());    //$mysqli->connect_error:得到连接产生的错误信息
    }
    //2.设置默认的客户端编码方式utf8
    $mysqli->set_charset('utf8');
    //3.执行SQL查询
    $sql=<<<EOF
	CREATE TABLE IF NOT EXISTS mysqli(
		id TINYINT UNSIGNED AUTO_INCREMENT KEY,
		username VARCHAR(20) NOT NULL
	);
EOF;
    $res = $mysqli->query($sql);        //执行单条SQL语句,只能执行一条SQL语句
    var_dump($res);
    /*
     SELECT/DESC/DESCRIBE/SHOW/EXPLAIN执行成功返回mysqli_result对象，执行失败返回false
     对于其它SQL语句的执行，执行成功返回true，否则返回false
     */
    //4、关闭连接
    $mysqli->close();//关闭连接


    $mysqli->errno();//得到上一步操作产生的错误号
    $mysqli->error();//得到上一步操作产生的错误信息

    $mysqli->insert_id();//得到上一插入操作产生的 auto_increment 的值
    $mysqli->affected_rows();//得到上一步操作产生的受影响的记录条数，affected_rows值为3种：1. 受影响的记录条数; 2. -1,代表SQL语句有问题 ;3. 0，代表没有受影响记录的条数

    //获取结果集中所有记录，默认返回的是二维的(索引+索引的形式)
    $rows = $mysqli_result->fetch_all();    //可选参数 MYSQLI_NUM、MYSQLI_ASSOC、 MYSQLI_BOTH

    $row=$mysqli_result->fetch_row();      //取得结果集中一条记录作为索引数组返回
    $row=$mysqli_result->fetch_assoc();    //取得结果集中的一条记录作为关联数组返回
    $row=$mysqli_result->fetch_array();
    $row=$mysqli_result->fetch_array(MYSQLI_ASSOC);
    $row=$mysqli_result->fetch_object();

    //移动结果集内部指针
    $mysqli_result->data_seek(0);
    $row=$mysqli_result->fetch_assoc();
    print_r($row);


    '客户端的信息：'.$mysqli->client_info;
    '客户端的版本：'.$mysqli->client_version;
    '服务器端信息：'.$mysqli->server_info;
    '服务器版本：'.$mysqli->server_version;


    </pre>
</pre>
</body>
</html>