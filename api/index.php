<?php
//Include("connection.php");
//Include("functions.php");
Include("session.php");
header("Content-Type: application/json");
//JUST FOR GET REQUEST WITH JSON FORMATTED DATA
//$a = $_GET['id'];
$abc = $_POST['posted'];
 //echo $asd["id"];
//var_dump($asd);
//var_dump($final);
// var_dump($a);
//$dic = json_decode($a);


//echo "<<<< JUST STARTED >>>>";
// $order = "Insert";
// $type = "RM";
// $data = array('id' => 1123, 'name' => jeans , 'catid' => 1 , 'whid' => 1 , 'pack' => 2 , 'unit' => 2 , 'style' => nb , 'size' => sm , 'colour' => blue , 'minlevel' => 20 , 'maxlevel' => 2000 , 'dangerlevel' => 10 , 'qty' => 600);
// $arg = array('order' => $order, 'type' => $type, 'data' => $data );

// $send = json_encode($arg);
session_start();
working($abc);

function working($dd)
{
	//echo "stringstringstringstringstringstringstringstring";
//var_dump($dd);
	$total = json_decode($dd, 1);
	if ($total['order'] == 'Insert') {
		if ($total['type'] == 'TEACHER') {//////////
			AddTEACHER($total['data']);
		}else if ($total['type'] == 'CLASS') {///////////////
			AddCLASS($total['data']);
		}else if ($total['type'] == 'IN') {
			AddIN($total['data']);
		}else if ($total['type'] == 'OUT') {
			AddOUT($total['data']);
		}else if ($total['type'] == 'USER') {///////////////////
			AddUSER($total['data']);
		}else if ($total['type'] == 'ROLE') {///////////////
			AddRole($total['data']);
		}else if ($total['type'] == 'SUP') {
			AddSupplier($total['data']);
		}else if ($total['type'] == 'CUS') {
			AddCustomer($total['data']);
		}else if ($total['type'] == 'CAT') {
			AddCategory($total['data']);
		}else if ($total['type'] == 'UNIT') {
			AddUnit($total['data']);
		}else if ($total['type'] == 'SKU') {
			AddSKU($total['data']);
		}else if ($total['type'] == 'DEPT') {
			AddDepartment($total['data']);
		}else if ($total['type'] == 'TRANSFER') {
			AddTRANSFER($total['data']);
		}else{
			echo "<<< DATA CAN'T BE INSERTED Please send an existing type!!! >>>";
		}
	}else if ($total['order'] == 'Fetch') {
		if ($total['type'] == 'PRICE') {
			FetchPrice($total['data']);
		}else if ($total['type'] == 'INV') {
			FetchItemINV($total['data']);
		}else if ($total['type'] == 'WH') {
			FetchItemWH($total['data']);
		}else if ($total['type'] == 'USER') {
			FetchItemUser($total['data']);
		}else if ($total['type'] == 'STOCK') {
			//var_dump($total['data']);
			FetchStock($total['data']);
		}else if ($total['type'] == 'SUP') {
			ItemSupplier($total['data']);
		}else{
			echo "<<< DATA CAN'T BE INSERTED Please send an existing type!!! >>>";
		}
	}else if ($total['order'] == 'Delete') {
		if ($total['type'] == 'INV') {
			DeleteINV($total['data']);
		}else if ($total['type'] == 'WH') {
			DeleteWH($total['data']);
		}else if ($total['type'] == 'USER') {
			DeleteUser($total['data']);
		}else{
			echo "<<< DATA CAN'T BE INSERTED Please send an existing type!!! >>>";
		}
	}else if ($total['order'] == 'Update') {
		if ($total['type'] == 'INV') {
			UpdateINV($total['data']);
		}else if ($total['type'] == 'WH') {
			UpdateWH($total['data']);
		}else if ($total['type'] == 'USER') {
			UpdateUser($total['data']);
		}else{
			echo "<<< DATA CAN'T BE INSERTED Please send an existing type!!! >>>";
		}
	}else if ($total['order'] == 'FetchAllNames') {
		if ($total['type'] == 'ROLE') {///////////////////
			FetchAllNamesROLE();
		}
		if ($total['type'] == 'CAT') {
			FetchAllNamesCAT();
		}
		if ($total['type'] == 'UNIT') {
			FetchAllNamesUNIT();
		}
		if ($total['type'] == 'PACk') {
			FetchAllNamesPACK();
		}
		if ($total['type'] == 'INV_TYPE') {
			FetchAllNamesINV_TYPE();
		}
		if ($total['type'] == 'CUS') {
			FetchAllNamesCUS();
		}
		if ($total['type'] == 'SUP') {
			FetchAllNamesSUP();
		}
		if ($total['type'] == 'DEPT') {
			FetchAllNamesDEPT();
		}
	}else if ($total['order'] == 'FetchAllIds') {
		if ($total['type'] == 'ROLE') {////////////////////
			FetchAllIdsROLE();
		}
		if ($total['type'] == 'RM') {
			FetchAllIdsRM();
		}
		if ($total['type'] == 'INV') {
			FetchAllIdsINV();
		}
		if ($total['type'] == 'INV_TYPE') {
			FetchAllIdsInvType();
		}
		if ($total['type'] == 'PACK') {
			FetchAllIdsPACK();
		}
		if ($total['type'] == 'SUP') {
			FetchAllIdsSUP();
		}
		if ($total['type'] == 'CUS') {
			FetchAllIdsCUS();
		}
		if ($total['type'] == 'DEPT') {
			FetchAllIdsDEPT();
		}
			
	}else if ($total['order'] == 'FetchAllAdmins') {

			FetchAllAdmins();
	}else if ($total['order'] == 'List') 			{
			if ($total['type'] == 'INV') {
			ListINV();
		}else if ($total['type'] == 'USER') {
			ListUser();
		}else if ($total['type'] == 'STOCK') {
			ListStock();
		}else if ($total['type'] == 'WH') {
			ListWH();
		}else if ($total['type'] == 'INV_WH') {
			ListINV_WH($total['data']);
		}else if ($total['type'] == 'WH_INV') {
			ListWH_INV($total['data']);
		}else if ($total['type'] == 'SUP') {
			ListSUP($total['data']);
		}else if ($total['type'] == 'INV_SUP') {
			ListINV_SUP($total['data']);
		}else if ($total['type'] == 'SUP_INV') {
			ListSUP_INV($total['data']);
		}else if ($total['type'] == 'BINS') {
			ListBINS($total['data']);
		}

	}else if ($total['order'] == 'Value') {
		if ($total['type'] == 'WH') {
			ValueWH($total['data']);
		}else if ($total['type'] == 'INV') {
			ValueINV($total['data']);
		}
	}else if ($total['order'] == 'Test') {
		if ($total['type'] == 'DATE') {
			TestDate();
		}else if ($total['type'] == 'BIN') {
			BinMap($total['data']);
		}else if ($total['type'] == 'ItemLevel') {
			ItemLevel($total['data']);
		}
	}
		else if ($total['order'] == 'FetchId') {
		if ($total['type'] == 'WH') {
			FetchIDWH($total['data']);
		}
		if ($total['type'] == 'CAT') {
			FetchIDCAT($total['data']);
		}
		if ($total['type'] == 'UNIT') {
			FetchIDUNIT($total['data']);
		}
		if ($total['type'] == 'ROLE') {///////////////////
			FetchIDROLE($total['data']);
		}
		if ($total['type'] == 'INV_TYPE') {
			FetchIDINV_TYPE($total['data']);
		}
		if ($total['type'] == 'SUP') {
			FetchIDSUP($total['data']);
		}
		if ($total['type'] == 'PACK') {
			FetchIDPACK($total['data']);
		}
		if ($total['type'] == 'CUS') {
			FetchIDCUS($total['data']);
		}
		if ($total['type'] == 'DEPT') {
			FetchIDDEPT($total['data']);
		}
	 }elseif ($total ['order'] == 'login'){
		$recivedArray = $total ['data'];
		//echo "stringstringstringstringstringstringstringstringstringstringstringstringstringstringstringstring";
		login($recivedArray['username'],$recivedArray['password']);
	}else if ($total ['order'] == 'logout'){
		//echo "Logout";
		logout1();
	}else if ($total ['order'] == 'authenticate'){
		authenticate();
	}else{  //Not Logged In Case OR Not Have required Privliges{
		response("OK",'fail',Array ('alertBox' => "Please Login First !" ));
	}
}
//response(OK,12,12);
?>











