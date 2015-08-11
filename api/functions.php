<?php


///////////////////////////////////////////    ADD FUNCTIONS    ///////////////////////////////////////////////////////
function AddCLASS($arr)
{
	$name = $arr["name"];
	$code = $arr["code"];
	$q1 = "INSERT INTO class (name,code)
VALUES ('$name', $code)"; 

    $result = mysql_query($q1);
    $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Class Added Successfully";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution May Be Your Given ID Is Already Exist";
	}
	response("OK",$msg,$d);
}

function AddIN($arr)
{
	$id = $arr["id"];
	$supplier = $arr["supplier"];
	$pack = $arr["pack"];
	$packs = $arr["packs"];
	$binfrom = $arr["binfrom"];
	$binto = $arr["binto"];
	$total = $arr["total"];
	$wid = $arr["wid"];


// "INSERT INTO stock_in (Item_ID, Supplier, Pack_Of, No_Of_Packs, Price_Per_Item, Bin_From, Bin_To, Created_By, Total)
// VALUES (212, 1, 1, 1, 1, 1, 1, 121212, 21 )";



	$q1 = "INSERT INTO stock_in (Item_ID,
	Supplier, 
	Pack_Of, 
	No_Of_Packs,
	WH_ID, 
	Bin_From, 
	Bin_To,
	Created_By,
	Total)
VALUES ($id, $supplier, $pack, $packs, $wid, $binfrom, $binto, 121212, $total )";

$q10 = "SELECT * FROM inventory_stock where Inv_ID = $id AND WH_ID = $wid AND Pack_Of = $pack";

$result10 = mysql_query($q10);
	while ($row = mysql_fetch_array($result10))
	{
		$ID = $row['ID'];
		$PACKS = $row['No_Of_Packs'];
	}
	if ($ID) {
		$add = $packs + $PACKS;
		$q2 = "UPDATE inventory_stock SET No_Of_Packs = $add WHERE ID = $ID";
		// $q2 = "INSERT INTO inventory_stock (No_Of_Packs)
		// VALUES ($packs ) where ID = $id";
	}else{
		$add = $packs;
		$q2 = "INSERT INTO inventory_stock (Inv_ID,
		WH_ID,
		Pack_Of, 
		No_Of_Packs)
		VALUES ($id, $wid, $pack, $packs )";
	}


// $q2 = "INSERT INTO inventory_stock (Inv_ID, WH_ID, Pack_Of)
// VALUES ($id, $wid, $pack)";
mysql_query($q2);

    $result = mysql_query($q1);
    $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "TRANSECTION SUCCESSFULL: Stock In = ".$packs."  New Stock = ".$add;
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}

function AddOUT($arr)
{
	$id = $arr["id"];
	$supplier = $arr["customer"];
	$pack = $arr["pack"];
	$packs = $arr["packs"];
	$binfrom = $arr["binfrom"];
	$binto = $arr["binto"];
	$adiscount = $arr["adiscount"];
	$total = $arr["total"];
	$wid = $arr["wid"];

// "INSERT INTO stock_in (Item_ID, Supplier, Pack_Of, No_Of_Packs, Price_Per_Item, Bin_From, Bin_To, Created_By, Total)
// VALUES (212, 1, 1, 1, 1, 1, 1, 121212, 21 )";



	$q1 = "INSERT INTO stock_out (Item_ID,
	Customer, 
	Pack_Of, 
	No_Of_Packs, 
	WH_ID,
	Bin_From, 
	Bin_To,
	Additional_Discount,
	Created_By,
	Total)
VALUES ($id, $supplier, $pack, $packs, $wid, $binfrom, $binto, $adiscount, 121212, $total )";

$q10 = "SELECT * FROM inventory_stock where Inv_ID = $id AND WH_ID = $wid AND Pack_Of = $pack";
$PACKS = 0;
$result10 = mysql_query($q10);
	while ($row = mysql_fetch_array($result10))
	{
		$ID = $row['ID'];
		$PACKS = $row['No_Of_Packs'];
	}
	$def = $PACKS - $packs;
	if ($ID && $def >= 0) {
		$q2 = "UPDATE inventory_stock SET No_Of_Packs = $def WHERE ID = $ID";
		mysql_query($q2);
		$result = mysql_query($q1);
		$msg = "Default Message";
		$d = 0;
		if ($result) {
			$msg = "TRANSECTION SUCCESSFULL: Stock Out = ".$packs."  Remaining = ".$def;
		}else{
			$msg = "Sorry there is an error at somewhere in execution";
		}
	}else{
		$d = -1;
		$msg = "TRANSECTION FAILED: You have just ".$PACKS." packs in stock";
	}
	response("OK",$msg,$d);
}



function AddTRANSFER($arr)
{
	$id = $arr["id"];
	$dept = $arr["dept"];
	$pack = $arr["pack"];
	$packs = $arr["packs"];
	$status = $arr["status"];
	$binfrom = $arr["binfrom"];
	$binto = $arr["binto"];
	$wid = $arr["wid"];

// "INSERT INTO stock_in (Item_ID, Supplier, Pack_Of, No_Of_Packs, Price_Per_Item, Bin_From, Bin_To, Created_By, Total)
// VALUES (212, 1, 1, 1, 1, 1, 1, 121212, 21 )";



	$q1 = "INSERT INTO stock_transfer (Item_ID,
	Department, 
	Pack_Of, 
	No_Of_Packs, 
	WH_ID,
	Bin_From, 
	Bin_To,
	Status,
	Created_By)
VALUES ($id, $dept, $pack, $packs, $wid, $binfrom, $binto, '$status', 121212 )";

$q10 = "SELECT * FROM inventory_stock where Inv_ID = $id AND WH_ID = $wid AND Pack_Of = $pack";

$result10 = mysql_query($q10);
	while ($row = mysql_fetch_array($result10))
	{
		$ID = $row['ID'];
		$PACKS = $row['No_Of_Packs'];
	}

if ($status == "Recieve") {

	if ($ID) {
		$add = $packs + $PACKS;
		$q2 = "UPDATE inventory_stock SET No_Of_Packs = $add WHERE ID = $ID";
		// $q2 = "INSERT INTO inventory_stock (No_Of_Packs)
		// VALUES ($packs ) where ID = $id";
	}else{
		$q2 = "INSERT INTO inventory_stock (Inv_ID,
		WH_ID,
		Pack_Of, 
		No_Of_Packs)
		VALUES ($id, $wid, $pack, $packs )";
	}
mysql_query($q2);

    $result = mysql_query($q1);
    $msg = "Default Message";
	if ($result) {
		$msg = "TRANSECTION SUCCESSFULL: Stock Transfered = ".$packs."  Remaining = ".$add;
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
}elseif ($status == "Issue") {
	$def = $PACKS - $packs;
	if ($ID && $def >= 0) {
		$q2 = "UPDATE inventory_stock SET No_Of_Packs = $def WHERE ID = $ID";
			// $q2 = "INSERT INTO inventory_stock (No_Of_Packs)
			// VALUES ($packs ) where ID = $id";
		mysql_query($q2);
		$result = mysql_query($q1);
		$msg = "Default Message";
		$d = 0;
		if ($result) {
			$msg = "TRANSECTION SUCCESSFULL: Stock Transfered = ".$packs."  Remaining = ".$def;
		}else{
			$d = -1;
			$msg = "Sorry there is an error at somewhere in execution";
		}
	}else{
		$d = -1;
		$msg = "TRANSECTION FAILED: You have just ".$PACKS." packs in stock";
	}
}
	response("OK",$msg,$d);
}



function AddTEACHER($arr)
{
	$fname = $arr["fname"];
	$lname = $arr["lname"];
	$add = $arr["address"];
	$mail = $arr["mail"];
	$sex = $arr["gender"];
	$q1 = "INSERT INTO teacher (first_name, last_name, gender, email, address)
VALUES ('$fname', '$lname', '$sex', '$mail', '$add')";
	//VALUES ($id, '$name', $createby, '$loc', '$add', $bins, $binsizeh, $binsizew, $binsized, $floors, '$supervisor', $ph, $mob, '$mail', '$website')";
	//VALUES (12, 'test', 121212, 'TestLoc', 'TestAdd', 2020,2, 2, 2, 3, 'TestSupervisor', 123, 123, 'TestMail', 'TestWebsite')";
	

  
    $result = mysql_query($q1);

    $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Teacher Created Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}


function AddRole($arr)
{
	$role = $arr ["role"];

	$q1 = "INSERT INTO Role (role)
	VALUES ('$role')";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Role Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}



function AddSupplier($arr)
{
	$name = $arr ["name"];
	$contact = $arr ["contact"];
	$q = "SELECT MAX(ID) FROM supplier";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO supplier (
	ID, Name, Contact)
	VALUES ($t , '$name', '$contact')";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Supplier Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}


function AddCustomer($arr)
{
	$name = $arr ["name"];
	$contact = $arr ["contact"];
	$q = "SELECT MAX(ID) FROM Customers";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO Customers (
	ID, Name, Contact)
	VALUES ($t , '$name', '$contact')";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Customer Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}


function AddCategory($arr)
{
	$name = $arr ["name"];
	$q = "SELECT MAX(ID) FROM category";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO category (
	ID, Name)
	VALUES ($t , '$name' )";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Category Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}


function AddUnit($arr)
{
	$name = $arr ["name"];
	$q = "SELECT MAX(ID) FROM unit";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO unit (
	ID, Name)
	VALUES ($t , '$name' )";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Unit Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}

function AddSKU($arr)
{
	$pack = $arr ["pack"];
	$discount = $arr ["discount"];
	$overhead = $arr ["overhead"];
	$q = "SELECT MAX(ID) FROM sku";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO sku (
	ID, Pack_Of, Discount, Overhead)
	VALUES ($t , $pack , $discount , $overhead )";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "SKU Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}

function AddDepartment($arr)
{
	$name = $arr ["name"];
	$manager = $arr ["manager"];
	$contact = $arr ["contact"];
	$q = "SELECT MAX(ID) FROM Departments";
	$r = mysql_query($q);
	$t = mysql_fetch_array($r);
	$t = $t['MAX(ID)'];
	$t += 1;

	$q1 = "INSERT INTO Departments (
	ID, Name, Manager_Name, Contact)
	VALUES ($t , '$name' , '$manager' , '$contact' )";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Department Added Successfully";
	}else{
		$d = -1;
		$msg = "Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}


////////////////////////////////////    RESPONCE FUNCTION    ///////////////////////////////////////////////////////////
function response($status, $status_messsage, $data)
{
	header("HTTP/1.1 $status $status_messsage");
	$response["status"]=$status;
	$response["status_message"]=$status_messsage;
	$response["data"]=$data;

	$json_reponse=json_encode($response);
	echo $json_reponse;

}





/////////////////////////////////////    FETCH_ALL_NAMES FUNCTIONS    ///////////////////////////////////////////////////
function FetchAllNamesROLE()
{
	$q1 = "SELECT * FROM Role";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['role'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}




////////////////////////////////////////    FETCH_ALL_IDS FUNCTIONS    /////////////////////////////////////////////////////
function FetchAllIdsROLE()
{
	$q1 = "SELECT * FROM Role";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['id'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllIdsRM()
{
	$q1 = "SELECT * FROM raw_materials";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Inv_ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}



function FetchAllIdsINV()
{
	$q1 = "SELECT * FROM inventory_item";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllIdsInvType()
{
	$q1 = "SELECT * FROM inventory_type";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllIdsPACK()
{
	$q1 = "SELECT * FROM sku";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllIdsSUP()
{
	$q1 = "SELECT * FROM supplier";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);}
function FetchAllIdsCUS()
{
	$q1 = "SELECT * FROM Customers";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllIdsDEPT()
{
	$q1 = "SELECT * FROM Departments";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['ID'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}



//////////////////////////////////////    FETCH_ALL_NAMES FUNCTIONS    /////////////////////////////////////////////////////
function FetchAllNamesCAT()
{
	$q1 = "SELECT * FROM category";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllNamesUNIT()
{
	$q1 = "SELECT * FROM unit";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}

	response("OK",$msg,$arr1);
}

function FetchAllNamesPACK()
{
	$q1 = "SELECT * FROM sku";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Pack_Of'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchNamePACK($var)
{
	$q1 = "SELECT Pack_Of FROM sku WHERE ID = $var";
	$result = mysql_query($q1);
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['Pack_Of'];
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$result);
}


function FetchAllNamesINV_TYPE()
{
	$q1 = "SELECT * FROM inventory_type";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchAllNamesCUS()
{
	$q1 = "SELECT * FROM Customers";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchAllNamesSUP()
{
	$q1 = "SELECT * FROM supplier";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchAllNamesDEPT()
{
	$q1 = "SELECT * FROM Departments";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchAllAdmins()
{
	$q1 = "SELECT user.ID FROM user INNER JOIN role ON user.Role_Id=role.ID WHERE role.Role = 'admin'";
	//$q1 = "SELECT * FROM user where Role_ID = 1";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
		 	//echo "AAA";
			$arr1[$i] = $row['ID'];
			$i++;
		 }
//echo "Name Is: ".$row['Name'];
		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	//echo "sdfsdfgh";
	response("OK",$msg,$arr1);
}

function FetchIDWH($var)
{
	$q1 = "SELECT * FROM warehouse where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchIDCAT($var)
{
	$q1 = "SELECT * FROM category where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}
function FetchIDUNIT($var)
{
	$q1 = "SELECT * FROM unit where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}
function FetchIDPACK($var)
{
	$q1 = "SELECT * FROM sku where Pack_Of = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchIDROLE($var)
{
	$q1 = "SELECT * FROM role where role = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['id'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchIDINV_TYPE($var)
{
	$q1 = "SELECT * FROM inventory_type where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchIDSUP($var)
{
	$q1 = "SELECT * FROM supplier where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchIDCUS($var)
{
	$q1 = "SELECT * FROM Customers where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}



function FetchIDDEPT($var)
{
	$q1 = "SELECT * FROM Departments where Name = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['ID'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}





///////////////////////////////////////////////    FETCH_PRICE FUNCTIONS    ///////////////////////////////////////////////
function FetchPrice($var)
{
	$q1 = "SELECT * FROM inventory_item where ID = '$var'";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1 = $row['Price_Per_Item'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}




//////////////////////////////////////////////////    LIST FUNCTIONS    /////////////////////////////////////////////////
function ListINV()
{
	$q1 = "SELECT * FROM inventory_item where IsDeleted = 0";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['ID'];
			$arr1[$i]['name'] = $row['name'];
			$arr1[$i]['type'] = $row['Inventory_Type'];
			$arr1[$i]['category'] = $row['Category_ID'];
			$arr1[$i]['unit'] = $row['Single_Unit'];
			$arr1[$i]['style'] = $row['style'];
			$arr1[$i]['size'] = $row['size'];
			$arr1[$i]['color'] = $row['colour'];
			$arr1[$i]['price'] = $row['Price_Per_Item'];
			$arr1[$i]['min'] = $row['min_stock_level'];
			$arr1[$i]['max'] = $row['max_stock_level'];
			$arr1[$i]['danger'] = $row['danger_stock_level'];
			$arr1[$i]['createby'] = $row['Created_By'];
			$arr1[$i]['createon'] = $row['Created_On'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListINV_WH($arr)
{
	$q1 = "SELECT * FROM inventory_stock where WH_ID = $arr ORDER BY Inv_ID";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['Inv_ID'];
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$arr1[$i]['packs'] = $row['No_Of_Packs'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListWH_INV($arr)
{
	$q1 = "SELECT * FROM inventory_stock where Inv_ID = $arr ORDER BY WH_ID";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['WH_ID'];
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$arr1[$i]['packs'] = $row['No_Of_Packs'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListSUP($arr)
{
	$q1 = "SELECT * FROM supplier";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['ID'];
			$arr1[$i]['name'] = $row['Name'];
			$arr1[$i]['contact'] = $row['Contact'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListINV_SUP($arr)
{
	$q1 = "SELECT DISTINCT Item_ID, Supplier, Pack_Of FROM stock_in WHERE Item_ID = $arr";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['Item_ID'];
			$p = $row['Supplier'];
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$q = "SELECT Name FROM supplier WHERE ID = $p";
			$r = mysql_query($q);
			$res = mysql_fetch_array($r);
			$arr1[$i]['supplier'] = $res['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListSUP_INV($arr)
{
	$q1 = "SELECT DISTINCT Item_ID, Supplier, Pack_Of FROM stock_in WHERE Supplier = $arr";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['Item_ID'];
			$p = $row['Supplier'];
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$q = "SELECT Name FROM supplier WHERE ID = $p";
			$r = mysql_query($q);
			$res = mysql_fetch_array($r);
			$arr1[$i]['supplier'] = $res['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListWH()
{
	$q1 = "SELECT * FROM warehouse where IsDeleted = 0";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['ID'];
			$arr1[$i]['name'] = $row['Name'];
			$arr1[$i]['loc'] = $row['Location'];
			$arr1[$i]['add'] = $row['Address'];
			$arr1[$i]['bins'] = $row['No_of_Bins'];
			$arr1[$i]['binsizeh'] = $row['Bin_Height'];
			$arr1[$i]['binsizew'] = $row['Bin_Width'];
			$arr1[$i]['binsized'] = $row['Bin_Depth'];
			$arr1[$i]['floors'] = $row['No_of_Floors'];
			$arr1[$i]['supervisor'] = $row['Supervisor'];
			$arr1[$i]['ph'] = $row['Phone_No'];
			$arr1[$i]['mob'] = $row['Mobile_No'];
			$arr1[$i]['mail'] = $row['Email_ID'];
			$arr1[$i]['website'] = $row['Website'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListStock()
{
	$q1 = "SELECT * FROM inventory_stock where IsDeleted = 0";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['invid'] = $row['Inv_ID'];
			$arr1[$i]['whid'] = $row['WH_ID'];
			$arr1[$i]['packof'] = $row['Pack_Of'];
			$arr1[$i]['packs'] = $row['No_Of_Packs'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function ListBINS($var)
{
	$q1 = "SELECT * FROM stock_in where WH_ID = $var";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['Item_ID'];
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$arr1[$i]['packs'] = $row['No_Of_Packs'];
			$arr1[$i]['binfrom'] = $row['Bin_From'];
			$arr1[$i]['binto'] = $row['Bin_To'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);

}


function ListUser()
{
	$q1 = "SELECT * FROM user where IsDeleted = 0";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['ID'];
			$arr1[$i]['roleid'] = $row['Role_Id'];
			$arr1[$i]['name'] = $row['Name'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);

}





//////////////////////////////////////////////////    FETCH_ITEM FUNCTIONS     /////////////////////////////////////////
function FetchItemINV($var)
{
	$q1 = "SELECT * FROM inventory_item where ID = $var";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1['id'] = $row['ID'];
			$arr1['name'] = $row['name'];
			$arr1['type'] = $row['Inventory_Type'];
			$arr1['category'] = $row['Category_ID'];
			$arr1['unit'] = $row['Single_Unit'];
			$arr1['style'] = $row['style'];
			$arr1['size'] = $row['size'];
			$arr1['color'] = $row['colour'];
			$arr1['price'] = $row['Price_Per_Item'];
			$arr1['minlevel'] = $row['min_stock_level'];
			$arr1['maxlevel'] = $row['max_stock_level'];
			$arr1['dangerlevel'] = $row['danger_stock_level'];
			$arr1['createby'] = $row['Created_By'];
			$arr1['createon'] = $row['Created_On'];
			$arr1['delete'] = $row['IsDeleted'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchStock($var)
{
	$from = $var["fromdate"];
	$to = $var["todate"];
	$type = $var["stocktype"];
	//echo "asdfghjk".$type;
	$a = "stock_in";
	$q1 = "SELECT * FROM $type";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['id'] = $row['Item_ID'];
			if ($type == "stock_in") {
				$arr1[$i]['Supplier'] = $row['Supplier'];
			}else if ($type == "stock_out") {
				$arr1[$i]['Customer'] = $row['Customer'];
			}
			$arr1[$i]['pack'] = $row['Pack_Of'];
			$arr1[$i]['packs'] = $row['No_Of_Packs'];
			$arr1[$i]['whid'] = $row['WH_ID'];
			$arr1[$i]['createon'] = $row['Created_On'];
			$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

function FetchItemWH($var)
{
	$q1 = "SELECT * FROM warehouse where ID = $var";
	$result = mysql_query($q1);
	//$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1['id'] = $row['ID'];
			$arr1['name'] = $row['Name'];
			$arr1['loc'] = $row['Location'];
			$arr1['add'] = $row['Address'];
			$arr1['bins'] = $row['No_of_Bins'];
			$arr1['binsizeh'] = $row['Bin_Height'];
			$arr1['binsizew'] = $row['Bin_Width'];
			$arr1['binsized'] = $row['Bin_Depth'];
			$arr1['floors'] = $row['No_of_Floors'];
			$arr1['supervisor'] = $row['Supervisor'];
			$arr1['ph'] = $row['Phone_No'];
			$arr1['mob'] = $row['Mobile_No'];
			$arr1['mail'] = $row['Email_ID'];
			$arr1['website'] = $row['Website'];
			//$i++;
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function FetchItemUser($var)
{
	$q1 = "SELECT * FROM user where ID = $var";
	$result = mysql_query($q1);

	while ($row = mysql_fetch_array($result))
		 {
			$arr1['id'] = $row['ID'];
			$arr1['name'] = $row['Name'];
			$arr1['roleid'] = $row['Role_Id'];
			$arr1['add'] = $row['Address'];
			$arr1['cnic'] = $row['CNIC'];
			$arr1['dob'] = $row['Date_Of_Birth'];
			$arr1['ph'] = $row['Phone_No'];
			$arr1['mail'] = $row['Email_ID'];
			$arr1['sex'] = $row['Sex'];
		 }

		 $msg = "Default Message";
	if ($result) {
		$msg = "Everything Is OK";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}





////////////////////////////////////////////////    DELETE FUNCTIONS    ////////////////////////////////////////////////
function DeleteINV($var)
{
	$q1 = "UPDATE inventory_item SET IsDeleted = 1 WHERE ID = $var";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected Item Is Deleted Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}


function DeleteWH($var)
{
	$q1 = "UPDATE warehouse SET IsDeleted = 1 WHERE ID = $var";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected Warehouse Is Deleted Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}



function DeleteUser($var)
{
	$q1 = "UPDATE user SET IsDeleted = 1 WHERE ID = $var";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected User Is Deleted Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}




///////////////////////////////////////////    UPDATE FUNCTIONS    ////////////////////////////////////////////////////////
function UpdateINV($arr)
{
	$pid = $arr["pid"];
	$id = $arr["id"];
	$name = $arr["name"];
	$cat = $arr["catid"];
	$unit = $arr["unit"];
	$style = $arr["style"];
	$size = $arr["size"];
	$color = $arr["color"];
	$min = $arr["minlevel"];
	$max = $arr["maxlevel"];
	$danger = $arr["dangerlevel"];
	$invtype = $arr["invtype"];
	$price = $arr["price"];

	$q1 = "UPDATE inventory_item SET ID = $id, Inventory_Type = $invtype, name = '$name', Category_ID = $cat, Single_Unit = $unit, style = '$style', size = '$size', colour = '$color', Price_Per_Item = $price, min_stock_level = $min, max_stock_level = $max, danger_stock_level = $danger WHERE ID = $pid";
	//$q1 = "UPDATE inventory_item SET ID = 101, Inventory_Type = 1, name = 'jeans', Category_ID = 1, Single_Unit = 1, style = 'nb', size = '32', colour = 'blue', Price_Per_Item = 110, min_stock_level = 10, max_stock_level = 100, danger_stock_level = 5 WHERE ID = 101";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected Item Is Updated Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}


function UpdateWH($arr)
{
	$pid 		= $arr["pid"];
	$id 		= $arr["id"];
	$name 		= $arr["name"];
	$loc 		= $arr["loc"];
	$add 		= $arr["add"];
	$bins 		= $arr["bins"];
	$binsizeh 	= $arr["binsizeh"];
	$binsized 	= $arr["binsized"];
	$binsizew 	= $arr["binsizew"];
	$floors 	= $arr["floors"];
	$supervisor = $arr["supervisor"];
	$ph 		= $arr["ph"];
	$mob 		= $arr["mob"];
	$mail 		= $arr["mail"];
	$website 	= $arr["website"];

	$q1 = "UPDATE warehouse SET ID = $id, Name = '$name', Location = '$loc', Address = '$add', No_of_Bins = $bins, Bin_Height = $binsizeh, Bin_Width = $binsizew, Bin_Depth = $binsized, No_of_Floors = $floors, Supervisor = '$supervisor', Phone_No = $ph, Mobile_No = $mob, Email_ID = '$mail', Website = '$website' WHERE ID = $pid";
	//$q1 = "UPDATE inventory_item SET ID = 101, Inventory_Type = 1, name = 'jeans', Category_ID = 1, Single_Unit = 1, style = 'nb', size = '32', colour = 'blue', Price_Per_Item = 110, min_stock_level = 10, max_stock_level = 100, danger_stock_level = 5 WHERE ID = 101";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected Warehouse Is Updated Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}


function UpdateUser($arr)
{
	$pid 			= $arr ["pid"];
	$name 			= $arr ["name"];
	$role 			= $arr ["role"];
	$birthdate 		= $arr ["birthdate"];
	$cnic 			= $arr ["cnic"];
	$email 			= $arr ["email"];
	$address 		= $arr ["address"];
	$phoneNumber	= $arr ["phoneNumber"];
	$sex 			= $arr ["sex"];


	//$q1 = "UPDATE user SET Name = '$name', Role_Id = $role, Address = '$address', CNIC = $cnic, Email_ID = '$email', Date_Of_Birth = '$birthdate', Phone_No = $phoneNumber, Sex = '$sex' WHERE ID = $pid";
	$q1 = "UPDATE user SET Name = '$name', Role_Id = $role, Address = '$address', CNIC = $cnic, Email_ID = '$email', Date_Of_Birth = '$birthdate', Phone_No = $phoneNumber, Sex = '$sex' WHERE ID = $pid";
	//$q1 = "UPDATE inventory_item SET ID = 101, Inventory_Type = 1, name = 'jeans', Category_ID = 1, Single_Unit = 1, style = 'nb', size = '32', colour = 'blue', Price_Per_Item = 110, min_stock_level = 10, max_stock_level = 100, danger_stock_level = 5 WHERE ID = 101";
	$result = mysql_query($q1);

		 $msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "Your Selected User Is Updated Successfully!!!";
	}else{
		$d = -1;
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$d);
}




////////////////////////////////////////////////    VALUE FUNCTIONS    //////////////////////////////////////////////////////
function ValueWH($arr)
{
	$q1 = "SELECT inventory_item.Price_Per_Item, inventory_stock.Pack_Of, inventory_stock.No_Of_Packs from inventory_stock inner join inventory_item ON inventory_stock.Inv_Id = inventory_item.ID WHERE inventory_stock.WH_ID = $arr";
	$result = mysql_query($q1);
$total = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1['price'] = $row['Price_Per_Item'];
			$p = $row['Pack_Of'];
			$arr1['packs'] = $row['No_Of_Packs'];
			$q = "SELECT Pack_Of FROM sku WHERE ID = $p";
			$r = mysql_query($q);
			$res = mysql_fetch_array($r);
			$total += $arr1['price'] * $res['Pack_Of'] * $arr1['packs'];
		 }
		 $msg = "Default Message";
	if ($result) {
		$msg = "Hey! This is an EMPTY warehouse now...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$total);
}



function ValueINV($arr)
{
	$q1 = "SELECT inventory_item.Price_Per_Item, inventory_stock.Pack_Of, inventory_stock.No_Of_Packs from inventory_stock inner join inventory_item ON inventory_stock.Inv_Id = inventory_item.ID WHERE inventory_stock.Inv_ID = $arr";
	$result = mysql_query($q1);
$total = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1['price'] = $row['Price_Per_Item'];
			$p = $row['Pack_Of'];
			$arr1['packs'] = $row['No_Of_Packs'];
			$q = "SELECT Pack_Of FROM sku WHERE ID = $p";
			$r = mysql_query($q);
			$res = mysql_fetch_array($r);
			$total += $arr1['price'] * $res['Pack_Of'] * $arr1['packs'];
		 }
		 $msg = "Default Message";
	if ($result) {
		$msg = "Hey! Stock does not exist of this item...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$total);
}



function ItemSupplier($arr)
{
	$q1 = "SELECT distinct stock_in.Item_ID, stock_in.Pack_Of, supplier.Name from stock_in inner join supplier ON stock_in.Supplier = supplier.ID WHERE stock_in.Item_ID = $arr";
	$result = mysql_query($q1);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i]['name'] = $row['Name'];
			$arr1[$i]['item'] = $row['Item_ID'];
			$p = $row['Pack_Of'];
			$q = "SELECT Pack_Of FROM sku WHERE ID = $p";
			$r = mysql_query($q);
			$t = mysql_fetch_array($r);
			$arr1[$i]['pack'] = $t['Pack_Of'];
			$i++;
		 }
		 $msg = "Default Message";
	if ($result) {
		$msg = "Hey! Stock does not exist of this item...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function ItemLevel($arr)
{
	$q2 = "SELECT Pack_Of, No_Of_Packs from inventory_stock WHERE Inv_ID = $arr";
	$result2 = mysql_query($q2);
	$quantity = 0;
	$q1 = "SELECT * from inventory_item WHERE ID = $arr";
	$result = mysql_query($q1);
	while ($row = mysql_fetch_array($result))
		 {
			$min = $row['min_stock_level'];
			$max = $row['max_stock_level'];
			$danger = $row['danger_stock_level'];
		}
		while ($row = mysql_fetch_array($result2)) {
			$p = $row['Pack_Of'];
			$arr2['packs'] = $row['No_Of_Packs'];
			$q = "SELECT Pack_Of FROM sku WHERE ID = $p";
			$r = mysql_query($q);
			$res = mysql_fetch_array($r);
			$quantity += $res['Pack_Of'] * $arr2['packs'];
		}
		 	$arr1['min'] = $min;
		 	$arr1['max'] = $max;
		 	$arr1['danger'] = $danger;
		 	$arr1['quantity'] = $quantity;
		 $msg = "Default Message";
	if ($result) {
		$msg = "Hey! Stock does not exist of this item...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}


function BinMap($arr)
{
	$q1 = "SELECT * FROM stock_in WHERE WH_ID = $arr ORDER BY Bin_From";
	$q2 = "SELECT * FROM stock_out WHERE WH_ID = $arr ORDER BY Bin_From";
	$q3 = "SELECT No_of_Bins FROM warehouse WHERE ID = $arr";
	$res = mysql_query($q3);
	$bins = mysql_fetch_array($res);
	
	$result = mysql_query($q1);
	$result2 = mysql_query($q2);
	$i = 0;
	$j = 0;
	$on = 0;
	$off = 0;
	$count = 0;
	while ($row = mysql_fetch_array($result2))
		 {
			$arr2[$j]['from'] = $row['Bin_From'];
			$arr2[$j]['to'] = $row['Bin_To'];
			for ($k=$row['Bin_From']; $k <= $row['Bin_To']; $k++) {
			 	$out[$off] = $k; 
			 	$off++;
		 	}
			$j++;
		 }
	while ($row1 = mysql_fetch_array($result))
		 {
			// $arr1[$i]['from'] = $row['Bin_From'];
			// $arr1[$i]['to'] = $row['Bin_To'];
			 for ($k=$row1['Bin_From']; $k <= $row1['Bin_To']; $k++) {
			 	$count1 = 0;
			 	for ($l=0; $l < $off; $l++) { 
			 		if ($k == $out[$l]) {
			 			$count1 = 1;
			 		}
			 	}
			 	if ($count1 != 1) {
			 		//echo "asdfghjkl";
			 		$in[$on] = $k;
			 			$on++;
			 			
			 	}
		 	}
			$i++;
		 }
		 $in[$on] = $bins['No_of_Bins'];
		 $out[$off] = $bins['No_of_Bins'];

		 $inout['in'] = $in;
		 $inout['out'] = $out;

		 $msg = "Default Message";
	if ($result) {
		$msg = "Hey! Stock does not exist of this item...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$inout);
}





///////////////////////////////////////////////////    USER_MANAGEMENT FUNCTIONS    ////////////////////////////////////////
function AddUSER($arr)
{
	$name = $arr ["name"];
	$password = $arr ["password"];
	$role = $arr ["role"];
	$passwordHash = md5($password);
	$q1 = "INSERT INTO user (password,role_id,username)
	VALUES ('$passwordHash', $role, '$name')";
	
	$result = mysql_query($q1);
	
	$msg = "Default Message";
	if ($result) {
		$d = 0;
		$msg = "User Added Successfully";
	}else{
		$d = -1;
		$msg = "User Id Already Exist... Please Enter Something else";
	}
	response("OK",$msg,$d);
}


function TestDate()
{
	$q = "SELECT * from warehouse";
	$result = mysql_query($q);
	$i = 0;
	while ($row = mysql_fetch_array($result))
		 {
			$arr1[$i] = $row['Established_Date'];
			$i++;
		 }

		  $msg = "Default Message";
	if ($result) {
		$msg = "Hey! Stock does not exist of this item...";
	}else{
		$msg = "Sorry there is an error at somewhere in execution";
	}
	response("OK",$msg,$arr1);
}

?>














