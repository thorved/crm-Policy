<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['wlogin'])==0)
	{	
header('location:index.php');
}
else{
	if(isset($_GET['cid']))
	{
	$cid=$_GET['cid'];
	}
	
if(isset($_POST['submit']))
  {
	
	
	$wcaction=$_POST['wcaction'];
	$nextdate=$_POST['nextdate'];
	$wcomment=$_POST['wcomment'];

	

	$sql="UPDATE clients SET wcaction=(:wcaction),nextdate=(:nextdate),wcomment=(:wcomment) WHERE id=(:cid)";
	
	$query = $dbh->prepare($sql);
	$query-> bindParam(':cid', $cid, PDO::PARAM_INT);
	
	$query-> bindParam(':wcaction', $wcaction, PDO::PARAM_STR);
	$query-> bindParam(':nextdate', $nextdate, PDO::PARAM_STR);
	$query-> bindParam(':wcomment', $wcomment, PDO::PARAM_STR);
	if($query->execute())
	{
	$msg="Report Updated Successfully"; 
	header('location:pendingwork.php');
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
	
	<title>Report</title>

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
		$sql = "SELECT Insured_Name,wcomment,wcaction,nextdate from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.id = :cid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':email', $_SESSION['wlogin'], PDO::PARAM_STR);
		$query->bindParam(':cid', $cid, PDO::PARAM_STR);
		$query->execute();
		$result2=$query->fetch(PDO::FETCH_OBJ);
		
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
                       
							<div class="col-md-12">
                            <h2><i class="fa fa-envelope"></i> &nbsp;Report: <?php echo htmlentities($result2->Insured_Name); ?></h2>
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
   
	<label class="col-sm-2 control-label">Worker Action<span style="color:red">*</span></label>
	<div class="col-sm-4">
	
										<select name="wcaction" class="form-control" required>

											


													<option value="">Select</option>
													<optgroup label="Followup">
													
													<option <?php if ($result2->wcaction == "Jan Followup") echo "selected='selected'";?> value="Jan Followup">Jan Followup</option>
													<option <?php if ($result2->wcaction == "Feb Followup") echo "selected='selected'";?> value="Feb Followup">Feb Followup</option>
													<option <?php if ($result2->wcaction == "Mar Followup") echo "selected='selected'";?> value="Mar Followup">Mar Followup</option>
													<option <?php if ($result2->wcaction == "Apr Followup") echo "selected='selected'";?> value="Apr Followup">Apr Followup</option>
													<option <?php if ($result2->wcaction == "May Followup") echo "selected='selected'";?> value="May Followup">May Followup</option>
													<option <?php if ($result2->wcaction == "June Followup") echo "selected='selected'";?> value="June Followup">June Followup</option>
													<option <?php if ($result2->wcaction == "July Followup") echo "selected='selected'";?> value="July Followup">July Followup</option>
													<option <?php if ($result2->wcaction == "Aug Followup") echo "selected='selected'";?> value="Aug Followup">Aug Followup</option>
													<option <?php if ($result2->wcaction == "Sept Followup") echo "selected='selected'";?> value="Sept Followup">Sept Followup</option>
													<option <?php if ($result2->wcaction == "Oct Followup") echo "selected='selected'";?> value="Oct Followup">Oct Followup</option>
													<option <?php if ($result2->wcaction == "Nov Followup") echo "selected='selected'";?> value="Nov Followup">Nov Followup</option>
													<option <?php if ($result2->wcaction == "Dec Followup") echo "selected='selected'";?> value="Dec Followup">Dec Followup</option>
													
													<option <?php if ($result2->wcaction == "Hot Followup") echo "selected='selected'";?> value="Hot Followup">Hot Followup</option>
													<option <?php if ($result2->wcaction == "Warm Followup") echo "selected='selected'";?> value="Warm Followup">Warm Followup</option>
													<option <?php if ($result2->wcaction == "Cold Followup") echo "selected='selected'";?> value="Cold Followup">Cold Followup</option>
													
													</optgroup>
													<optgroup label="Others">
													<option <?php if ($result2->wcaction == "Ringing") echo "selected='selected'";?> value="Ringing">Ringing</option>
													<option <?php if ($result2->wcaction == "Not reachable") echo "selected='selected'";?> value="Not reachable">Not reachable</option>
													<option <?php if ($result2->wcaction == "Number Busy") echo "selected='selected'";?> value="Number Busy">Number Busy</option>
													<option <?php if ($result2->wcaction == "Wrong number") echo "selected='selected'";?> value="Wrong number">Wrong number</option>
													<option <?php if ($result2->wcaction == "Discussion done, to be called again") echo "selected='selected'";?> value="Discussion done, to be called again">Discussion done, to be called again</option>
													<option <?php if ($result2->wcaction == "Discussion not done, to be called again") echo "selected='selected'";?> value="Discussion not done, to be called again">Discussion not done, to be called again</option>
													<option <?php if ($result2->wcaction == "Not interested") echo "selected='selected'";?> value="Not interested">Not interested</option>
													<option <?php if ($result2->wcaction == "Lead Generated") echo "selected='selected'";?> value="Lead Generated">Lead Generated</option>
													<option <?php if ($result2->wcaction == "Looking for some other product") echo "selected='selected'";?> value="Looking for some other product">Looking for some other product</option>
													<option <?php if ($result2->wcaction == "Lead Closed") echo "selected='selected'";?> value="Lead Closed">Lead Closed</option>
													</optgroup>


										</select>

									
	</div>

	<label class="col-sm-2 control-label">Next Date<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="date" name="nextdate" class="form-control" value="<?php echo htmlentities($result2->nextdate);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
	<div class="col-sm-10">
<textarea rows="5"  name="wcomment" class="form-control" required value=""><?php echo htmlentities($result2->wcomment);?></textarea>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Submit Report</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				
				
<?php
		$sql1 = "select * from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.id = :cid";
		$query1 = $dbh -> prepare($sql1);
		$query1->bindParam(':email', $_SESSION['wlogin'], PDO::PARAM_STR);
		$query1->bindParam(':cid',$cid,PDO::PARAM_INT);
		$query1->execute();
		$result=$query1->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>				
				
				
				
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Client Detail: <?php echo htmlentities($result->Insured_Name); ?></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Details</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">







<!-- _______________________________________________________________________________________________________________ -->
<div class="form-group">
<label class="col-sm-2 control-label">Name</label>
<div class="col-sm-4">
<input type="text" name="Insured_Name" class="form-control" required readonly required value="<?php echo htmlentities($result->Insured_Name);?>">
</div>
<label class="col-sm-2 control-label">Reference Tagging</label>
<div class="col-sm-4">
<input type="text" name="Reference_Tagging" class="form-control" readonly required value="<?php echo htmlentities($result->Reference_Tagging);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Contact No.1</label>
<div class="col-sm-4">
<input type="text" name="Contact_No1" class="form-control" readonly required value="<?php echo htmlentities($result->Contact_No1);?>">
</div>
<label class="col-sm-2 control-label">Contact No.2</label>
<div class="col-sm-4">
<input type="text" name="Contact_No2" class="form-control" readonly required value="<?php echo htmlentities($result->Contact_No2);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Client Location</label>
<div class="col-sm-4">
<input type="text" name="Client_Location" class="form-control" readonly required value="<?php echo htmlentities($result->Client_Location);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Net Amount</label>
<div class="col-sm-4">
<input type="text" name="Net_Amount" class="form-control" readonly required value="<?php echo htmlentities(explode(".",$result->Net_Amount)[0]);?>">
</div>
<label class="col-sm-2 control-label">Gross Amount</label>
<div class="col-sm-4">
<input type="text" name="Gross_Amount" class="form-control" readonly required value="<?php echo htmlentities($result->Gross_Amount);?>">
</div>
<label class="col-sm-2 control-label">Discount</label>
<div class="col-sm-4">
<input type="text" name="Discount" class="form-control" readonly required value="<?php echo htmlentities($result->Discount);?>">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Plan</label>
<div class="col-sm-4">
<input type="text" name="Plan" class="form-control" readonly required value="<?php echo htmlentities($result->Plan);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Person Covered</label>
<div class="col-sm-4">
<input type="text" name="Person_Covered" class="form-control" readonly required value="<?php echo htmlentities($result->Person_Covered);?>">
</div>
<label class="col-sm-2 control-label">Age of Eldest Person</label>
<div class="col-sm-4">
<input type="text" name="Age_of_Eldest_Person" class="form-control" readonly required value="<?php echo htmlentities($result->Age_of_Eldest_Person);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Portability</label>
<div class="col-sm-4">
<input type="text" name="Portability" class="form-control" readonly required value="<?php echo htmlentities($result->Portability);?>">
</div>
<label class="col-sm-2 control-label">Medical</label>
<div class="col-sm-4">
<input type="text" name="Medical" class="form-control" readonly required value="<?php echo htmlentities($result->Medical);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Amount Covered</label>
<div class="col-sm-4">
<input type="text" name="Amount_Covered" class="form-control" readonly required value="<?php echo htmlentities($result->Amount_Covered);?>">
</div>
<label class="col-sm-2 control-label">CI Cover</label>
<div class="col-sm-4">
<input type="text" name="CI_Cover" class="form-control" readonly required value="<?php echo htmlentities($result->CI_Cover);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Deductible</label>
<div class="col-sm-4">
<input type="text" name="Deductible" class="form-control" readonly required value="<?php echo htmlentities($result->Deductible);?>">
</div>
<label class="col-sm-2 control-label">Period Covered</label>
<div class="col-sm-4">
<input type="text" name="Period_Covered" class="form-control" readonly required value="<?php echo htmlentities($result->Period_Covered);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Auto Renewal</label>
<div class="col-sm-4">
<input type="text" name="Auto_Renewal" class="form-control" readonly required value="<?php echo htmlentities($result->Auto_Renewal);?>">
</div>
<label class="col-sm-2 control-label">Pickup_Date</label>
<div class="col-sm-4">
<input type="text" name="Pickup_Date" class="form-control" readonly required value="<?php $formatexpiry_date = new DateTime($result->Pickup_Date); echo htmlentities($formatexpiry_date->format('d-m-Y'));?>">
</div>
<label class="col-sm-2 control-label">Month</label>
<div class="col-sm-4">
<input type="text" name="Month" class="form-control" readonly required value="<?php echo htmlentities($result->Month);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Sourced By</label>
<div class="col-sm-4">
<input type="text" name="Sourced_By" class="form-control" readonly required value="<?php echo htmlentities($result->Sourced_By);?>">
</div>
<label class="col-sm-2 control-label">Agent Code</label>
<div class="col-sm-4">
<input type="text" name="Agent_Code" class="form-control" readonly required value="<?php echo htmlentities($result->Agent_Code);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Status</label>
<div class="col-sm-4">
<input type="text" name="Status" class="form-control" readonly required value="<?php echo htmlentities($result->Status);?>">
</div>
<label class="col-sm-2 control-label">Rejection Reason</label>
<div class="col-sm-4">
<input type="text" name="Rejection_Reason" class="form-control" readonly required value="<?php echo htmlentities($result->Rejection_Reason);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Loading</label>
<div class="col-sm-4">
<input type="text" name="Loading" class="form-control" readonly required value="<?php echo htmlentities($result->Loading);?>">
</div>
<label class="col-sm-2 control-label">Policy No</label>
<div class="col-sm-4">
<input type="text" name="Policy_No" class="form-control" readonly required value="<?php echo htmlentities($result->Policy_No);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Claim 1</label>
<div class="col-sm-4">
<input type="text" name="Claim_1" class="form-control" readonly required value="<?php echo htmlentities($result->Claim_1);?>">
</div>
<label class="col-sm-2 control-label">Claim 2</label>
<div class="col-sm-4">
<input type="text" name="Claim_2" class="form-control" readonly required value="<?php echo htmlentities($result->Claim_2);?>">
</div>
<label class="col-sm-2 control-label">Claim 3</label>
<div class="col-sm-4">
<input type="text" name="Claim_3" class="form-control" readonly required value="<?php echo htmlentities($result->Claim_3);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Caller</label>
<div class="col-sm-4">
<input type="text" name="Caller" class="form-control" readonly required value="<?php echo htmlentities($result->xCaller);?>">
</div>
<label class="col-sm-2 control-label">Caller Code</label>
<div class="col-sm-4">
<input type="text" name="Caller_Code" class="form-control" readonly required value="<?php echo htmlentities($result->xCaller_Code);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Company</label>
<div class="col-sm-4">
<input type="text" name="Company" class="form-control" readonly required value="<?php echo htmlentities($result->Company);?>">
</div>
<label class="col-sm-2 control-label">Mail Id2</label>
<div class="col-sm-4">
<input type="text" name="Mail_Id_2" class="form-control" readonly required value="<?php echo htmlentities($result->Mail_Id_2);?>">
</div>
<label class="col-sm-2 control-label">Mobile in Form</label>
<div class="col-sm-4">
<input type="text" name="Mobile_in_Form" class="form-control" readonly required value="<?php echo htmlentities($result->Mobile_in_Form);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Annual Income</label>
<div class="col-sm-4">
<input type="text" name="Annual_Income" class="form-control" readonly required value="<?php echo htmlentities($result->Annual_Income);?>">
</div>
<label class="col-sm-2 control-label">Occupation</label>
<div class="col-sm-4">
<input type="text" name="Occupation" class="form-control" readonly required value="<?php echo htmlentities($result->Occupation);?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address</label>
<div class="col-sm-4">
<textarea rows="5"  name="Address" class="form-control" readonly required value=""><?php echo htmlentities($result->Address);?></textarea>
</div>
</div>

<br>
<div class="form-group">
<label class="col-sm-2 control-label">Client Status</label>
<div class="col-sm-4">
<input type="text" name="xwstatus" class="form-control" readonly required value="<?php echo htmlentities($result->wcaction);?>">
</div>
<label class="col-sm-2 control-label">Next Date</label>
<div class="col-sm-4">
<input type="text" name="xnextdate" class="form-control" readonly required value="<?php $formatexpiry_date = new DateTime($result->nextdate); echo htmlentities($formatexpiry_date->format('d-m-Y'));?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Worker/Client Comment</label>
<div class="col-sm-4">
<textarea rows="5"  name="xwcomment" class="form-control" readonly required value=""><?php echo htmlentities($result->wcomment);?></textarea>
</div>
</div>
<!-- _______________________________________________________________________________________________________________ -->














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