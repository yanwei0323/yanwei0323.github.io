<?php 
	$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
	// 2.判断数据是否连接成功
	if ($mysqli->connect_errno) {
		die($mysqli->connect_error);
	}
	// 3.执行sql语句
	$mysqli->query("set names utf8");
	$sql = "SELECT * FROM userinfo ORDER BY score DESC";
	$result = $mysqli->query($sql);
	$arr = array();
	if ($result->num_rows) {
		while ($u = $result->fetch_assoc()) {
			array_push($arr, $u);
		}
	}

	$mysqli->close();

	$str = json_encode($arr);
	echo $str;
 ?>