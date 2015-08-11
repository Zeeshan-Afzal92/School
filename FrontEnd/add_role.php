<?php
Include("./Send.php");

if(isset($_POST['SubmitButton']))
{
	$name        = $_POST['name'];
//echo "$name";
    $myArray = array('role' => $name );
    echo sendRequest("Insert","ROLE",$myArray);
}
?>
<form method="post">
	<label>Role Name:</label>
	<input type="text" placeholder="Role Name" name="name" required>
	<br/><br/>
	<button type="submit" name='SubmitButton'>Add</button>
</form>