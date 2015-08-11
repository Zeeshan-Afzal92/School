<?php
Include("./Send.php");
if(isset($_POST['SubmitButton']))
{
	$fname        = $_POST['fname'];
	$lname        = $_POST['lname'];
	$sex        = $_POST['sex'];
	$mail        = $_POST['mail'];
	$add        = $_POST['address'];
    $myArray = array('fname' => $fname,'lname' => $lname,'gender' => $sex ,'mail' => $mail,'address' => $add );
    echo sendRequest("Insert","TEACHER",$myArray);
}
?>
<form method="post">
<div>
	<label>First Name:</label>
	<input type="text" placeholder="First Name" name="fname" required>
	<br/><br/>
	<label>Last Name:</label>
	<input type="text" placeholder="Last Name" name="lname" required>
	<br/><br/>
	<label>Gender:</label>
	<input type="radio" name="sex" value="M" checked>Male
	<input type="radio" name="sex" value="F">Female
	<br><br>
	<label>Email ID:</label>
	<input type="text" placeholder="Email" name="mail" required>
	<br/><br/>
	<label>Address:</label>
	<input type="text" placeholder="Address" name="address" required>
	<br/><br/>
	<button type="submit" name='SubmitButton'>Add</button>
</div>
</form>