<?php 

	function updateScore($openid,$score){
		$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}
		$mysqli->query("set names utf8");

		$sql = "UPDATE userinfo SET score = $score WHERE openid = '$openid'";

		$result = $mysqli->query($sql);

		$mysqli->close();
	}


	function getScore($openid){
		$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
		if ($mysqli->connect_errno) {
			die($mysqli->connect_error);
		}
		$mysqli->query("set names utf8");

		$sql = "SELECT * FROM userinfo WHERE openid = '$openid'";

		$result = $mysqli->query($sql);
		$score = 0;
		if ($result->num_rows) {
			$user = $result->fetch_assoc();
			$score = $user["score"];
		}

		$mysqli->close();

		return $score;
	}

	$openid = $_GET["openid"];

	$oldScore = getScore($openid);
	$score = $_GET["score"];

	if ($score > $oldScore) {
		updateScore($openid,$score);
		echo $score;
	}else{
		echo $oldScore;
	}

	

 ?>