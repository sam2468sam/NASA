<?php

	header('Content-Type: apllication/x-www-form-urlencoded; charset=UTF-8');

	//$request=$_REQUEST[""];
	//$post=$_POST[""];
	//$get=$_GET[""];

	if ($_SERVER['REQUEST_METHOD']=="POST"){
		$value=$_POST["value"];
		$uri=$_SERVER['REQUEST_URI'];
		$servername="127.0.0.1";
		$user="user";
		$passwd="password";
		$db="lab7";
		$key=substr($uri,5);

		//echo "value : ".$value."\n";
		//echo "eri : ".$uri."\n";


		$conn = mysqli_connect($servername, $user, $passwd, $db);
		//if($conn)
		//	echo "connect success";
		//else
		//	echo "connect fail";
		//
		$sql="select id from tb where id='$key'";
		$retval=mysqli_query($conn,$sql);
		$rows=mysqli_num_rows($retval);
		if($rows > 0){
			//GET DATA SUCCESS, update it
			$sql0 = "update tb set value='$value' where id = '$key'";
			mysqli_query($conn, $sql0);
			//echo "get data, update successfully\n";
			echo "OK";
		}
		else{
			//no data, INSERT DATA
			$sql1 = "insert into tb (id, value) values ('$key', '$value')";
			mysqli_query($conn, $sql1);
			//echo "no data, insert successful\n";
			echo "OK";
		}
		mysqli_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD']=="GET"){
		$uri=$_SERVER["REQUEST_URI"];
		$servername="127.0.0.1";
		$user="user";
		$passwd="password";
		$db="lab7";
		$key=substr($uri,5);

		$conn = mysqli_connect($servername, $user, $passwd, $db);
		$sql3="select id, value from tb";
		$retval2=mysqli_query($conn,$sql3);
		//$value="";
		while($rows = mysqli_fetch_assoc($retval2)){
			$value = $rows["value"];
			if ($key == $rows["id"]){
				$flag=1;
				break;
			}
			else {
				$flag=0;
			}
		}
		if ($flag) {
			// UPDATE
			//if ($value == "")
			//	echo "key not found!\n";
			//else
				echo $value;
		}
		else {
			echo "key not found!";
		}
		mysqli_close($conn);
	}
	
?>
