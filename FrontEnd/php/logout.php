<?php

Include("../Send.php");
 $result = sendRequest("logout","placeholder",0);
 // echo $result;
 // var_dump($result);

 if($result['success'])
{
	echo '<script>window.location.href = "login.php?E3";</script>';
}

?>