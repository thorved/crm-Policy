<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	
	$output = '';
	if(isset($_POST["import"]))
{
	
	set_time_limit(0);
	ob_implicit_flush(1);
	
	
$querysid = $connect->prepare("SELECT MAX(id) FROM clients"); // prepate a query
$querysid->execute(); // actually perform the query
$resultsid = $querysid->get_result(); // retrieve the result so it can be used inside PHP
$r = $resultsid->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
$sid = $r['MAX(id)'];

	
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  
  include("includes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
  
  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   echo "Total Row=  ".$highestRow."........=";
   for($row=2; $row<=$highestRow; $row++)
   {
	   echo $row."  ";
	   
	   	if(ob_get_level() > 0)
		{
			ob_end_flush();
		}
		
	  // sleep(1);
	  
    $output .= "<tr>";
    $Insured_Name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $Reference_Tagging = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
	$Contact_No1 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
	$Contact_No2 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
	$Client_Location = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
	$Net_Amount = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
	$Gross_Amount = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
	$Discount = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
	$Plan = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
	$Person_Covered = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
	$Age_of_Eldest_Person = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
	$Portability = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
	$Medical = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
	$Amount_Covered = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
	$CI_Cover = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
    $Deductible = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
	$Period_Covered = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
	$Auto_Renewal = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
	$excel_date = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
	$Month = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
	$Sourced_By = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
	$Agent_Code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(21, $row)->getValue());
	$Status = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(22, $row)->getValue());
	$Rejection_Reason = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(23, $row)->getValue());
	$Loading = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(24, $row)->getValue());
	$Policy_No = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(25, $row)->getValue());
	$Claim_1 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(26, $row)->getValue());
	$Claim_2 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(27, $row)->getValue());
	$Claim_3 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(28, $row)->getValue());
    $Caller = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(29, $row)->getValue());
	$Caller_Code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(30, $row)->getValue());
	$Company = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(31, $row)->getValue());
	$Mail_Id_2 = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(32, $row)->getValue());
	$Mobile_in_Form = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(33, $row)->getValue());
	$Annual_Income = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(34, $row)->getValue());
	$Occupation = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(35, $row)->getValue());
	$Address = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(36, $row)->getValue());

$unix_date = ($excel_date - 25569) * 86400;
$excel_date = 25569 + ($unix_date / 86400);
$unix_date = ($excel_date - 25569) * 86400;
$Pickup_Date=gmdate("Y-m-d", $unix_date);
	
	
    $query = "INSERT INTO clients(Insured_Name, Reference_Tagging, Contact_No1, Contact_No2, Client_Location, Net_Amount, Gross_Amount, Discount, Plan, Person_Covered, Age_of_Eldest_Person, Portability, Medical, Amount_Covered, CI_Cover, Deductible, Period_Covered, Auto_Renewal, Pickup_Date, Month, Sourced_By, Agent_Code, Status, Rejection_Reason, Loading, Policy_No, Claim_1, Claim_2, Claim_3, xCaller, xCaller_Code, Company, Mail_Id_2, Mobile_in_Form, Annual_Income, Occupation, Address) 
	VALUES ('".$Insured_Name."','".$Reference_Tagging."', '".$Contact_No1."', '".$Contact_No2."', '".$Client_Location."', '".$Net_Amount."', '".$Gross_Amount."', '".$Discount."', '".$Plan."', '".$Person_Covered."', '".$Age_of_Eldest_Person."', '".$Portability."', '".$Medical."', '".$Amount_Covered."', '".$CI_Cover."', '".$Deductible."', '".$Period_Covered."', '".$Auto_Renewal."', '".$Pickup_Date."', '".$Month."', '".$Sourced_By."', '".$Agent_Code."', '".$Status."', '".$Rejection_Reason."', '".$Loading."', '".$Policy_No."', '".$Claim_1."', '".$Claim_2."', '".$Claim_3."', '".$Caller."', '".$Caller_Code."', '".$Company."', '".$Mail_Id_2."', '".$Mobile_in_Form."', '".$Annual_Income."', '".$Occupation."', '".$Address."')";
    mysqli_query($connect, $query);
    $output .= '<td>'.$Insured_Name.'</td>';
    $output .= '<td>'.$Reference_Tagging.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';

$querylid = $connect->prepare("SELECT MAX(id) FROM clients"); // prepate a query
$querylid->execute(); // actually perform the query
$resultlid = $querylid->get_result(); // retrieve the result so it can be used inside PHP
$r = $resultlid->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
$lid = $r['MAX(id)'];

$queryins = $connect->prepare("INSERT INTO importlog (sid,lid,idate) values ('".$sid."','".$lid."','".date("Y-m-d")."')"); // prepate a query
$queryins->execute(); // actually perform the query



 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}




 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Import Client's</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>

	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;Import Client's</h2>
						 <form method="post" enctype="multipart/form-data">
							<div class="form-group">
									
									<label class="col-sm-2 control-label">Select File</label>
									
									<div class="col-sm-4">
									<input type="file" name="excel" class="form-control" />
									</div>
									<div class="col-sm-4">
									<input type="submit" name="import" class="btn btn-primary" value="Import" />
								</div>
							</div>
							
							
							
							</form>
							
							
							   <br />
							<br />
									<?php
										echo $output;
									?>
							
						
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
