<?php 


	function insertUserInfo($userObj){

		// 获取用户信息
		$openid = $userObj->openid;
		$nickname = $userObj->nickname;

		$sexNum = $userObj->sex;

		if ($sexNum == 0) {
			$sex = "未知";
		}elseif ($sexNum == 1) {
			$sex = "男";
		}else{
			$sex = "女"; 
		}

		$province = $userObj->province;
		$city = $userObj->city;
		$country = $userObj->country;
		$headimgurl = $userObj->headimgurl;

		// 1.连接数据库

		// 网络数据库主机域名等查找方式: SAE - 应用 - 环境变量
		$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);

		// 2.判断数据是否连接成功
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}

		// 3.执行sql语句
		$mysqli->query("set names utf8");

		$sql = "INSERT INTO userinfo(openid,nickname,sex,province,city,country,headimgurl) VALUES('$openid','$nickname','$sex','$province','$city','$country','$headimgurl')";

		$result = $mysqli->query($sql);

		// 4.关闭数据库
		$mysqli->close();
	}

	function isUserExist($openid){
		// 1.连接数据库
		// 网络数据库主机域名等查找方式: SAE - 应用 - 环境变量
		$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
		// 2.判断数据是否连接成功
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}
		// 3.执行sql语句
		$mysqli->query("set names utf8");
		$sql = "SELECT * FROM userinfo WHERE openid = '$openid'";
		$result = $mysqli->query($sql);

		$isExist = false;
		if ($result->num_rows) {
			 $isExist = true;
		}else{
			 $isExist = false;
		}
		// 关闭数据库
		$mysqli->close();

		return $isExist;
	}


 ?>