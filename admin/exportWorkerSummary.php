<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

    if(isset($_GET['wid']))
	{
		$wid=$_GET['wid'];
       


	
 
// Filter the excel data 
function filterData(&$str){
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
 
// Excel file name for download 
$fileName = $wid ." ". $_SESSION['summarystartdate_admin']." to " .$_SESSION['summaryenddate_admin']. ".csv"; 


header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\"");

$out = fopen("php://output", 'w');
 
if($wid=="all"){
$sql="SELECT * FROM clients where clients.assigned_date>='$_SESSION[summarystartdate_admin]' AND clients.assigned_date<='$_SESSION[summaryenddate_admin]' ";
}else{
    $sql="SELECT * FROM clients where clients.Caller = '$wid' AND clients.assigned_date>='$_SESSION[summarystartdate_admin]' AND clients.assigned_date<='$_SESSION[summaryenddate_admin]' ";
}
$query = $connect->query($sql); 
if($query->num_rows > 0){ 
    $heading = false;
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        if(!$heading) {
            fputcsv($out, array_keys($row), ',', '"');
            $heading = true;
        }
        array_walk($row, __NAMESPACE__ . '\filterData');
        fputcsv($out, array_values($row), ',', '"');
    }
    fclose($out); 
}else{ 
    fputcsv($out, ['No records found...'], ',', '"');
} 

// Render excel data 
// echo $excelData; 
 
exit;
}

}
