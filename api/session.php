<?php
Include ("connection.php");
Include ("functions.php");

function authenticate($flag)
{
	
		if(  isset($_SESSION['id']) &&  $_SESSION['isLoggedIn'] == true)
		{
			if ($flag == 0) {
				response('OK', 'loginstatus',Array('userType'=>$_SESSION["type"]));
			}else{
				return 1;
			}
		}
		else 
		{
			if ($flag == 0) {
				response('OK', 'loginstatus',Array('userType'=>-1));
			}else{
				return 0;
			}
		}
}

function login($username,$password)
{
	$auth = authenticate(1);
	if ($auth == 0) {
		$query = "select * from user where username = '$username' and password = '".md5($password)."' and IsDeleted = ". 0; //Yes it is injectable
		$result = mysql_query($query);
		$userData = mysql_fetch_array($result);
		if(sizeOf($userData) > 1)
		{
			$_SESSION["name"] = $userData['username'];
			$_SESSION["id"] = $userData['id'];
			$_SESSION["type"] = $userData['role_id'];
			$_SESSION['isLoggedIn'] = true;
			$responceToSend['userType'] = $userData['role_id'];
			$responceToSend['loginStatus'] = "success";
			session_write_close();
		}
		else
		{
			$responceToSend['loginStatus'] = "fail";
		}
	}else{
		$responceToSend['loginStatus'] = "LogedIn";
	}
	
	response('OK', 'loginstatus', $responceToSend);













// 	//echo "In Login Function".$username;
// 	//$responceToSend['loginStatus'] = "success";
// 	$query = "select * from user where username = '$username' and password = '".md5($password)."' and IsDeleted = ". 0; //Yes it is injectable
// //	echo $query;
// 	$result = mysql_query($query);
// 	$userData = mysql_fetch_array($result);
//  //	print_r($userData) ;
// 	if(sizeOf($userData) > 1)
// 	{
// 		$_SESSION["name"] = $userData['username'];
// 		$_SESSION["id"] = $userData['id'];
// 		$_SESSION["type"] = $userData['role_id'];
// 		$_SESSION['isLoggedIn'] = true;
// 		$responceToSend['userType'] = $userData['role_id'];
// 		$responceToSend['loginStatus'] = "success";
// 		session_write_close();
// 	}
// 	else
// 	{
// 		$responceToSend['loginStatus'] = "fail";
// 	}
	
// 	response('OK', 'loginstatus', $responceToSend);
}

function logout1()
{
	session_destroy();
	$responceToSend['success'] = true;
	response('OK', 'loginstatus',$responceToSend);
}

function serverSideAuthenticate()
{

	if(  isset($_SESSION['id']) &&  $_SESSION['isLoggedIn'] == true)
	{
		return $_SESSION["type"];
	}
	else
	{
		return -1 ;
	}
}




?>