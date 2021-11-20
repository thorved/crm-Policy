<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if (isset($_POST)) {
	$cids=$_POST['cids'];
	$cids_arr = explode ("+", $cids);
	$Caller_code=$_POST['callerCode'];
	$asnDate=$_POST['asnDate'];

	$sqlclientsid = implode(" or id=", $cids_arr);
	$sqlreassign_clientsid = implode(" or cid=", $cids_arr);

	$sql = 'UPDATE clients SET Caller_Code=(:Caller_Code),assigned_date=(:assigned_date),wcaction=NULL,nextdate=NULL,wcomment=NULL WHERE id='.$sqlclientsid.';
	 			UPDATE reassign_clients SET assigned_to=(:Caller_Code),reassign_count = reassign_count + 1 WHERE cid='.$sqlreassign_clientsid.';
	 			UPDATE clients,users SET clients.Caller=users.name WHERE clients.Caller_Code=users.caller_code;';
				 

        $query = $dbh->prepare($sql);
        $query->bindParam(':Caller_Code', $Caller_code, PDO::PARAM_STR);
        //$query->bindParam(':idedit', $cid, PDO::PARAM_INT);
		$query->bindParam(':assigned_date', $asnDate, PDO::PARAM_STR);
		$excute = $query->execute();
        if ($execute) {
            $msg = "Information Updated Successfully";
        } else {
            $error = "error";
        }
		echo $execute;
    
	// foreach($cids_arr as $cid)
	// {
	// 	// $sql = "UPDATE clients SET Caller_Code=(:Caller_Code),assigned_date=(:assigned_date) WHERE id=(:idedit)";
	// 	$sql = 'UPDATE clients SET Caller_Code=(:Caller_Code),assigned_date=(:assigned_date),wcaction=NULL,nextdate=NULL,wcomment=NULL WHERE id=(:idedit);
	// 			UPDATE reassign_clients SET assigned_to=(:Caller_Code),reassign_count = reassign_count + 1 WHERE cid=(:idedit);
	// 			UPDATE clients,users SET clients.Caller=users.name WHERE clients.Caller_Code=users.caller_code;';
    //     $query = $dbh->prepare($sql);
    //     $query->bindParam(':Caller_Code', $Caller_code, PDO::PARAM_STR);
    //     $query->bindParam(':idedit', $cid, PDO::PARAM_INT);
	// 	$query->bindParam(':assigned_date', $asnDate, PDO::PARAM_STR);
	// 	$excute = $query->execute();
    //     if ($execute) {
    //         $msg = "Information Updated Successfully";
    //     } else {
    //         $error = "error";
    //     }
	// 	echo $execute;

	// }
		// $sql1 = "UPDATE clients,users SET clients.Caller=users.name WHERE clients.Caller_Code=users.caller_code";
        // $query1 = $dbh->prepare($sql1);
		// $query1->execute();	
}
}