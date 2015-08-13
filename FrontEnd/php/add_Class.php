<?php
Include("../Send.php");
if(isset($_POST['SubmitButton']))
{
	$name        = $_POST['name'];
	$code        = $_POST['code'];
    $myArray = array('name' => $name,'code' => $code);
    echo sendRequest("Insert","CLASS",$myArray);
}
?>
<form method="post">
<div>
	<label>Class Name:</label>
	<input type="text" placeholder="Class Name" name="name" required>
	<br/><br/>
	<label>Class Code:</label>
	<input type="text" placeholder="Class Code" name="code" required>
	<br/><br/>
	<button type="submit" name='SubmitButton'>Add</button>
</div>
</form>