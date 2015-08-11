<?php
Include("../Send.php");
$var = sendRequest("authenticate","placeholder",0);

if(isset($_POST['SubmitButton']))
{
	$name        = $_POST['name'];

    $myArray = array('name' => $name );
    sendRequest("Add","Role",$myArray);
}
?>
<div>
	<label>Role Name:</label>
	<div>
		<input type="text" placeholder="Role Name" name="name" required>
	</div>

	<div class="pull-right">
		<button type="submit" name='SubmitButton' class="btn btn-primary">Add</button>
	</div>
</div>  