<?php
Include("./Send.php");
$role_Ids = sendRequest("FetchAllNames","ROLE",0);
if(isset($_POST['SubmitButton']))
{


	$name        = $_POST['name'];
	$pass        = $_POST['pass'];
	$role        = $_POST['Role_Id'];
	$role = sendRequest("FetchId","ROLE",$role);
    //echo "$role";
    $myArray = array('name' => $name,'password' => $pass,'role' => $role );
    echo sendRequest("Insert","USER",$myArray);
}
?>
<form method="post">
<div>
	<label>Username:</label>
	<input type="text" placeholder="Username" name="name" required>
	<br/><br/>
	<label>Password:</label>
	<input type="text" placeholder="Password" name="pass" required>
	<br/><br/>
	<label>Role ID:</label>
	<select class="form-control"  name="Role_Id" id="Role_Id" required>
		<option>Select</option>
		<?php
		for ($i=0; $i <count($role_Ids) ; $i++) {
			echo "<option>".$role_Ids[$i]."</option>";
		}
		?>
	</select>
	<br/><br/>
	<button type="submit" name='SubmitButton'>Add</button>
</div>
</form>