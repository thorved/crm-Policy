<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    
    $conn = new mysqli('localhost', 'admin', 'admin', 'crm');  
mysqli_select_db($conn, 'crud');  
    $sql = "SELECT id,Insured_Name FROM clients Where 1=0 ";  
    $setRec = mysqli_query($conn, $sql);  
    $columnHeader = '';  
    $columnHeader = "Id" . "\t" . "First Name" . "\t";  
    $setData = '';  
      while ($rec = mysqli_fetch_row($setRec)) {  
        $rowData = '';  
        foreach ($rec as $value) {  
            $value = '"' . $value . '"' . "\t";  
            $rowData .= $value;  
        }  
        $setData .= trim($rowData) . "\n";  
    }  
      
    header("Content-type: application/octet-stream");  
    header("Content-Disposition: attachment; filename=User_Detail.xls");  
    header("Pragma: no-cache");  
    header("Expires: 0");  
    
      echo ucwords($columnHeader) . "\n" . $setData . "\n";  
}

?> 