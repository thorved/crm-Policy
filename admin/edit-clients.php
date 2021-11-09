<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}


	
if(isset($_POST['submit']))
  {
	
	
	$Insured_Name=$_POST['Insured_Name'];
	$Reference_Tagging=$_POST['Reference_Tagging'];
	$Contact_No1=$_POST['Contact_No1'];
	$Contact_No2=$_POST['Contact_No2'];
	$Client_Location=$_POST['Client_Location'];
	$Net_Amount=$_POST['Net_Amount'];
	$Gross_Amount=$_POST['Gross_Amount'];
	$Discount=$_POST['Discount'];
	$Plan=$_POST['Plan'];
	$Person_Covered=$_POST['Person_Covered'];
	$Age_of_Eldest_Person=$_POST['Age_of_Eldest_Person'];
	$Portability=$_POST['Portability'];
	$Medical=$_POST['Medical'];
	$Amount_Covered=$_POST['Amount_Covered'];
	$CI_Cover=$_POST['CI_Cover'];
	$Deductible=$_POST['Deductible'];
	$Period_Covered=$_POST['Period_Covered'];
	$Auto_Renewal=$_POST['Auto_Renewal'];
	$Pickup_Date=$_POST['Pickup_Date'];
	$Month=$_POST['Month'];
	$Sourced_By=$_POST['Sourced_By'];
	$Agent_Code=$_POST['Agent_Code'];
	$Status=$_POST['Status'];
	$Rejection_Reason=$_POST['Rejection_Reason'];
	$Loading=$_POST['Loading'];
	$Policy_No=$_POST['Policy_No'];	
	$Claim_1=$_POST['Claim_1'];
	$Claim_2=$_POST['Claim_2'];	
	$Claim_3=$_POST['Claim_3'];
	$Caller=$_POST['Caller'];
	$Caller_Code=$_POST['Caller_Code'];
	$Company=$_POST['Company'];
	$Mail_Id_2=$_POST['Mail_Id_2'];
	$Mobile_in_Form=$_POST['Mobile_in_Form'];	
	$Annual_Income=$_POST['Annual_Income'];
	$Occupation=$_POST['Occupation'];	
	$Address=$_POST['Address'];
	

	$sql="UPDATE clients SET Insured_Name=(:Insured_Name), Reference_Tagging=(:Reference_Tagging), Contact_No1=(:Contact_No1), Contact_No2=(:Contact_No2), Client_Location=(:Client_Location), Net_Amount=(:Net_Amount),
			Gross_Amount=(:Gross_Amount),Discount=(:Discount),Plan=(:Plan),Person_Covered=(:Person_Covered),
			Age_of_Eldest_Person=(:Age_of_Eldest_Person),Portability=(:Portability),Medical=(:Medical),Amount_Covered=(:Amount_Covered),
			CI_Cover=(:CI_Cover),Deductible=(:Deductible),Period_Covered=(:Period_Covered),Auto_Renewal=(:Auto_Renewal),
			Pickup_Date=(:Pickup_Date),Month=(:Month),Sourced_By=(:Sourced_By),Agent_Code=(:Agent_Code),
			Status=(:Status),Rejection_Reason=(:Rejection_Reason),Loading=(:Loading),Policy_No=(:Policy_No),
			Claim_1=(:Claim_1),Claim_2=(:Claim_2),Claim_3=(:Claim_3),xCaller=(:Caller),
			xCaller_Code=(:Caller_Code),Company=(:Company),Mail_Id_2=(:Mail_Id_2),Mobile_in_Form=(:Mobile_in_Form),
			Annual_Income=(:Annual_Income),Occupation=(:Occupation),Address=(:Address)      WHERE id=(:idedit)";
	
	$query = $dbh->prepare($sql);
	$query-> bindParam(':Insured_Name', $Insured_Name, PDO::PARAM_STR);
	$query-> bindParam(':Reference_Tagging', $Reference_Tagging, PDO::PARAM_STR);
	$query-> bindParam(':Contact_No1', $Contact_No1, PDO::PARAM_STR);
	$query-> bindParam(':Contact_No2', $Contact_No2, PDO::PARAM_STR);
	$query-> bindParam(':Client_Location', $Client_Location, PDO::PARAM_STR);
	$query-> bindParam(':Net_Amount', $Net_Amount, PDO::PARAM_STR);
	$query-> bindParam(':Gross_Amount', $Gross_Amount, PDO::PARAM_STR);
	$query-> bindParam(':Discount', $Discount, PDO::PARAM_STR);
	$query-> bindParam(':Plan', $Plan, PDO::PARAM_STR);
	$query-> bindParam(':Person_Covered', $Person_Covered, PDO::PARAM_STR);
	$query-> bindParam(':Age_of_Eldest_Person', $Age_of_Eldest_Person, PDO::PARAM_STR);
	$query-> bindParam(':Portability', $Portability, PDO::PARAM_STR);
	$query-> bindParam(':Medical', $Medical, PDO::PARAM_STR);
	$query-> bindParam(':Amount_Covered', $Amount_Covered, PDO::PARAM_STR);
	$query-> bindParam(':CI_Cover', $CI_Cover, PDO::PARAM_STR);
	$query-> bindParam(':Deductible', $Deductible, PDO::PARAM_STR);
	$query-> bindParam(':Period_Covered', $Period_Covered, PDO::PARAM_STR);
	$query-> bindParam(':Auto_Renewal', $Auto_Renewal, PDO::PARAM_STR);
	$query-> bindParam(':Pickup_Date', $Pickup_Date, PDO::PARAM_STR);
	$query-> bindParam(':Month', $Month, PDO::PARAM_STR);
	$query-> bindParam(':Sourced_By', $Sourced_By, PDO::PARAM_STR);
	$query-> bindParam(':Agent_Code', $Agent_Code, PDO::PARAM_STR);
	$query-> bindParam(':Status', $Status, PDO::PARAM_STR);
	$query-> bindParam(':Rejection_Reason', $Rejection_Reason, PDO::PARAM_STR);
	$query-> bindParam(':Loading', $Loading, PDO::PARAM_STR);
	$query-> bindParam(':Policy_No', $Policy_No, PDO::PARAM_STR);
	$query-> bindParam(':Claim_1', $Claim_1, PDO::PARAM_STR);
	$query-> bindParam(':Claim_2', $Claim_2, PDO::PARAM_STR);
	$query-> bindParam(':Claim_3', $Claim_3, PDO::PARAM_STR);
	$query-> bindParam(':Caller', $Caller, PDO::PARAM_STR);
	$query-> bindParam(':Caller_Code', $Caller_Code, PDO::PARAM_STR);
	$query-> bindParam(':Company', $Company, PDO::PARAM_STR);
	$query-> bindParam(':Mail_Id_2', $Mail_Id_2, PDO::PARAM_STR);
	$query-> bindParam(':Mobile_in_Form', $Mobile_in_Form, PDO::PARAM_STR);
	$query-> bindParam(':Annual_Income', $Annual_Income, PDO::PARAM_STR);
	$query-> bindParam(':Occupation', $Occupation, PDO::PARAM_STR);
	$query-> bindParam(':Address', $Address, PDO::PARAM_STR);

	
	
	
	
	
	$query-> bindParam(':idedit', $editid, PDO::PARAM_INT);
	if($query->execute())
	{
	$msg="Information Updated Successfully"; 
	}else {$error="error"; } 
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
	
	<title>Edit User</title>

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

	<script type= "text/javascript" src="../vendor/countries.js"></script>
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
<?php
		$sql = "SELECT * from clients where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Edit User : <?php echo htmlentities($result->Insured_Name); ?></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">







<!-- _______________________________________________________________________________________________________________ -->
<div class="form-group">
<label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="Insured_Name" class="form-control" required value="<?php echo htmlentities($result->Insured_Name);?>">
</div>
<label class="col-sm-2 control-label">Reference Tagging</label>
<div class="col-sm-4">
<input type="text" name="Reference_Tagging" class="form-control" value="<?php echo htmlentities($result->Reference_Tagging);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Contact No.1</label>
<div class="col-sm-4">
<input type="text" name="Contact_No1" class="form-control" value="<?php echo htmlentities($result->Contact_No1);?>">
</div>
<label class="col-sm-2 control-label">Contact No.2</label>
<div class="col-sm-4">
<input type="text" name="Contact_No2" class="form-control" value="<?php echo htmlentities($result->Contact_No2);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Client Location</label>
<div class="col-sm-4">
<input type="text" name="Client_Location" class="form-control" value="<?php echo htmlentities($result->Client_Location);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Net Amount</label>
<div class="col-sm-4">
<input type="text" name="Net_Amount" class="form-control" value="<?php echo htmlentities($result->Net_Amount);?>">
</div>
<label class="col-sm-2 control-label">Gross Amount</label>
<div class="col-sm-4">
<input type="text" name="Gross_Amount" class="form-control" value="<?php echo htmlentities($result->Gross_Amount);?>">
</div>
<label class="col-sm-2 control-label">Discount</label>
<div class="col-sm-4">
<input type="text" name="Discount" class="form-control" value="<?php echo htmlentities($result->Discount);?>">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Plan</label>
<div class="col-sm-4">
<input type="text" name="Plan" class="form-control" value="<?php echo htmlentities($result->Plan);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Person Covered</label>
<div class="col-sm-4">
<input type="text" name="Person_Covered" class="form-control" value="<?php echo htmlentities($result->Person_Covered);?>">
</div>
<label class="col-sm-2 control-label">Age of Eldest Person</label>
<div class="col-sm-4">
<input type="text" name="Age_of_Eldest_Person" class="form-control" value="<?php echo htmlentities($result->Age_of_Eldest_Person);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Portability</label>
<div class="col-sm-4">
<input type="text" name="Portability" class="form-control" value="<?php echo htmlentities($result->Portability);?>">
</div>
<label class="col-sm-2 control-label">Medical</label>
<div class="col-sm-4">
<input type="text" name="Medical" class="form-control" value="<?php echo htmlentities($result->Medical);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Amount Covered</label>
<div class="col-sm-4">
<input type="text" name="Amount_Covered" class="form-control" value="<?php echo htmlentities($result->Amount_Covered);?>">
</div>
<label class="col-sm-2 control-label">CI Cover</label>
<div class="col-sm-4">
<input type="text" name="CI_Cover" class="form-control" value="<?php echo htmlentities($result->CI_Cover);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Deductible</label>
<div class="col-sm-4">
<input type="text" name="Deductible" class="form-control" value="<?php echo htmlentities($result->Deductible);?>">
</div>
<label class="col-sm-2 control-label">Period Covered</label>
<div class="col-sm-4">
<input type="text" name="Period_Covered" class="form-control" value="<?php echo htmlentities($result->Period_Covered);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Auto Renewal</label>
<div class="col-sm-4">
<input type="text" name="Auto_Renewal" class="form-control" value="<?php echo htmlentities($result->Auto_Renewal);?>">
</div>
<label class="col-sm-2 control-label">Pickup_Date</label>
<div class="col-sm-4">
<input type="date" name="Pickup_Date" class="form-control" value="<?php echo htmlentities($result->Pickup_Date);?>">
</div>
<label class="col-sm-2 control-label">Month</label>
<div class="col-sm-4">
<input type="month" name="Month" class="form-control" value="<?php echo htmlentities($result->Month);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Sourced By</label>
<div class="col-sm-4">
<input type="text" name="Sourced_By" class="form-control" value="<?php echo htmlentities($result->Sourced_By);?>">
</div>
<label class="col-sm-2 control-label">Agent Code</label>
<div class="col-sm-4">
<input type="text" name="Agent_Code" class="form-control" value="<?php echo htmlentities($result->Agent_Code);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Status</label>
<div class="col-sm-4">
<input type="text" name="Status" class="form-control" value="<?php echo htmlentities($result->Status);?>">
</div>
<label class="col-sm-2 control-label">Rejection Reason</label>
<div class="col-sm-4">
<input type="text" name="Rejection_Reason" class="form-control" value="<?php echo htmlentities($result->Rejection_Reason);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Loading</label>
<div class="col-sm-4">
<input type="text" name="Loading" class="form-control" value="<?php echo htmlentities($result->Loading);?>">
</div>
<label class="col-sm-2 control-label">Policy No</label>
<div class="col-sm-4">
<input type="text" name="Policy_No" class="form-control" value="<?php echo htmlentities($result->Policy_No);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Claim 1</label>
<div class="col-sm-4">
<input type="text" name="Claim_1" class="form-control" value="<?php echo htmlentities($result->Claim_1);?>">
</div>
<label class="col-sm-2 control-label">Claim 2</label>
<div class="col-sm-4">
<input type="text" name="Claim_2" class="form-control" value="<?php echo htmlentities($result->Claim_2);?>">
</div>
<label class="col-sm-2 control-label">Claim 3</label>
<div class="col-sm-4">
<input type="text" name="Claim_3" class="form-control" value="<?php echo htmlentities($result->Claim_3);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Caller</label>
<div class="col-sm-4">
<input type="text" name="Caller" class="form-control" value="<?php echo htmlentities($result->xCaller);?>">
</div>
<label class="col-sm-2 control-label">Caller Code</label>
<div class="col-sm-4">
<input type="text" name="Caller_Code" class="form-control" value="<?php echo htmlentities($result->xCaller_Code);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Company</label>
<div class="col-sm-4">
<input type="text" name="Company" class="form-control" value="<?php echo htmlentities($result->Company);?>">
</div>
<label class="col-sm-2 control-label">Mail Id2</label>
<div class="col-sm-4">
<input type="text" name="Mail_Id_2" class="form-control" value="<?php echo htmlentities($result->Mail_Id_2);?>">
</div>
<label class="col-sm-2 control-label">Mobile in Form</label>
<div class="col-sm-4">
<input type="text" name="Mobile_in_Form" class="form-control" value="<?php echo htmlentities($result->Mobile_in_Form);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Annual Income</label>
<div class="col-sm-4">
<input type="text" name="Annual_Income" class="form-control" value="<?php echo htmlentities($result->Annual_Income);?>">
</div>
<label class="col-sm-2 control-label">Occupation</label>
<div class="col-sm-4">
<input type="text" name="Occupation" class="form-control" value="<?php echo htmlentities($result->Occupation);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address</label>
<div class="col-sm-4">
<textarea rows="5"  name="Address" class="form-control" value=""><?php echo htmlentities($result->Address);?></textarea>
</div>
</div>

<!-- _______________________________________________________________________________________________________________ -->








<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
	</div>
</div>






</form>
									</div>
								</div>
							</div>
						</div>
						
					

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