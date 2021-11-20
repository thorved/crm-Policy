<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['wlogin']) == 0) {
	header('location:index.php');
} else {
	if(isset($_POST['submit']))
	{
		//$date=$_POST['selectdate'];
		
		$_SESSION['pendingworkenddate'] =  $_POST['pendingworkenddate'];
		$_SESSION['pendingworkstartdate'] = $_POST['pendingworkstartdate'];
		
		$wcaction=$_POST['wcaction'];
		$_SESSION['wcaction']=$wcaction;
	}
	
	else{	
		 $lastWeek = date("Y-m-d", strtotime("-7 days"));

		 if (strlen($_SESSION['pendingworkstartdate']) == 0) {
				$_SESSION['pendingworkstartdate']=$lastWeek;
			}
		 if (strlen($_SESSION['pendingworkenddate']) == 0) {
				$_SESSION['pendingworkenddate']=date("Y-m-d");
			}	
			
			
			
		 $wcaction="Hot Followup";
		 
		 if (strlen($_SESSION['wcaction']) == 0) {
				$_SESSION['wcaction']=$wcaction;
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

		<title>Pending Work</title>

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
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #5cb85c;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">


							<div class="form-group">
							<h4 class="page-title"><i class="fa fa-users"></i> &nbsp;Pending Work &nbsp;:  <?php $formatpendingworkstartdate = new DateTime($_SESSION['pendingworkstartdate']); echo htmlentities($formatpendingworkstartdate->format('d-m-Y'));?> &nbsp; to &nbsp; <?php $formatpendingworkenddate = new DateTime($_SESSION['pendingworkenddate']); echo htmlentities($formatpendingworkenddate->format('d-m-Y'));?> &nbsp;</h4>
							<form method="post" class="form-horizontal" enctype="multipart/form-data" name="date">
							
							<div class="form-group">
							<label class="col-sm-1 control-label">Worker Action</label>
							<div class="col-sm-4">
							
							<select name="wcaction" class="form-control" required>

											


													<option <?php if ($_SESSION['wcaction'] == "all") echo "selected='selected'";?> value="all">All</option>
													
													<optgroup label="Month Followup">
													
													<option <?php if ($_SESSION['wcaction'] == "Jan Followup") echo "selected='selected'";?> value="Jan Followup">Jan Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Feb Followup") echo "selected='selected'";?> value="Feb Followup">Feb Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Mar Followup") echo "selected='selected'";?> value="Mar Followup">Mar Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Apr Followup") echo "selected='selected'";?> value="Apr Followup">Apr Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "May Followup") echo "selected='selected'";?> value="May Followup">May Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "June Followup") echo "selected='selected'";?> value="June Followup">June Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "July Followup") echo "selected='selected'";?> value="July Followup">July Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Aug Followup") echo "selected='selected'";?> value="Aug Followup">Aug Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Sept Followup") echo "selected='selected'";?> value="Sept Followup">Sept Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Oct Followup") echo "selected='selected'";?> value="Oct Followup">Oct Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Nov Followup") echo "selected='selected'";?> value="Nov Followup">Nov Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Dec Followup") echo "selected='selected'";?> value="Dec Followup">Dec Followup</option>
													</optgroup>
													
													<optgroup label="Followup">
													<option <?php if ($_SESSION['wcaction'] == "Hot Followup") echo "selected='selected'";?> value="Hot Followup">Hot Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Warm Followup") echo "selected='selected'";?> value="Warm Followup">Warm Followup</option>
													<option <?php if ($_SESSION['wcaction'] == "Cold Followup") echo "selected='selected'";?> value="Cold Followup">Cold Followup</option>
													
													</optgroup>
													<optgroup label="Others">
													<!-- <option <?php if ($_SESSION['wcaction'] == "Ringing") echo "selected='selected'";?> value="Ringing">Ringing</option> -->
													<!-- <option <?php if ($_SESSION['wcaction'] == "Not reachable") echo "selected='selected'";?> value="Not reachable">Not reachable</option> -->
													<!-- <option <?php if ($_SESSION['wcaction'] == "Number Busy") echo "selected='selected'";?> value="Number Busy">Number Busy</option> -->
													<!--<option <?php if ($_SESSION['wcaction'] == "Wrong number") echo "selected='selected'";?> value="Wrong number">Wrong number</option>-->
													<option <?php if ($_SESSION['wcaction'] == "Discussion done, to be called again") echo "selected='selected'";?> value="Discussion done, to be called again">Discussion done, to be called again</option>
													<option <?php if ($_SESSION['wcaction'] == "Discussion not done, to be called again") echo "selected='selected'";?> value="Discussion not done, to be called again">Discussion not done, to be called again</option>
													<!--<option <?php if ($_SESSION['wcaction'] == "Not interested") echo "selected='selected'";?> value="Not interested">Not interested</option>-->
													<option <?php if ($_SESSION['wcaction'] == "Lead Generated") echo "selected='selected'";?> value="Lead Generated">Lead Generated</option>
													<!-- <option <?php if ($_SESSION['wcaction'] == "Looking for some other product") echo "selected='selected'";?> value="Looking for some other product">Looking for some other product</option> -->
													<!--<option <?php if ($_SESSION['wcaction'] == "Lead Closed") echo "selected='selected'";?> value="Lead Closed">Lead Closed</option>-->
													</optgroup>


										</select>
							</div>
							<button class="btn btn-primary" name="submit" type="submit">Show</button><br>
							</div>
							
							<div class="form-group">
							<label class="col-sm-1 control-label">Start Date</label>
							<div class="col-sm-4">
							<input type="date" name="pendingworkstartdate" class="form-control" value="<?php echo $_SESSION['pendingworkstartdate'];?>">
							</div>
							
							<label class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-4">
							<input type="date" name="pendingworkenddate" class="form-control" value="<?php echo $_SESSION['pendingworkenddate'];?>">
							</div>
							</div>
							
														
							</form>
							</div>


							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">List Clients</div>
								<div class="panel-body">
									<?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<!--	//<th>Image</th>-->
												<th>Insured Name</th>
                                                <th>Reference Tagging</th>
												<th>Plan</th>
												<th>Pickup Date</th>
                                                <th>Sourced By</th>
                                                <th>Company</th>
												<th>Contact No</th>
												<th style="display:none;">Contact No</th>
												<th>Next Action Date</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>



											<?php
											$_SESSION['redirect_worker_page'] = 'location:pendingwork.php';
											if($_SESSION['wcaction']=="all")
											{
												$sql="select clients.id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Contact_No1,Contact_No2,Mobile_in_Form from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.nextdate>=(:pendingworkstartdate) AND clients.nextdate<=(:pendingworkenddate) and clients.wcaction!='Wrong number' and clients.wcaction!='Lead Closed' and clients.wcaction!='Not interested' and clients.wcaction!='Ringing' and clients.wcaction!='Not reachable' and clients.wcaction!='Number Busy' and clients.wcaction!='Looking for some other product'";
												$query = $dbh->prepare($sql);
											}
											else
											{
												$sql="select clients.id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Contact_No1,Contact_No2,Mobile_in_Form from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.nextdate>=(:pendingworkstartdate) AND clients.nextdate<=(:pendingworkenddate) and clients.wcaction=(:wcaction)";
												$query = $dbh->prepare($sql);
												$query->bindParam(':wcaction', $_SESSION['wcaction'], PDO::PARAM_STR);
											}
											
											$query->bindParam(':email', $_SESSION['wlogin'], PDO::PARAM_STR);
											$query->bindParam(':pendingworkstartdate', $_SESSION['pendingworkstartdate'], PDO::PARAM_STR);
											$query->bindParam(':pendingworkenddate', $_SESSION['pendingworkenddate'], PDO::PARAM_STR);
											
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											function hidephoneno($phone)
												{
													$times=strlen(trim(substr($phone,4,4)));
													$star='';
													for ($i=0; $i <$times ; $i++) { 
														$star.='*';
													}
													return str_replace(substr($phone,4,4), $star, $phone);
												}
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<!--<td><img src="../images/<?php echo htmlentities($result->image); ?>" style="width:50px; border-radius:50%;"/></td> -->
														<td><a href="wcreport.php?cid=<?php echo $result->id;?> ">
														<?php echo htmlentities($result->Insured_Name); ?></a></td>
														<td><?php echo htmlentities($result->Reference_Tagging);?></td>
                                            <td><?php echo htmlentities($result->Plan);?></td>
											<td><?php $formatexpiry_date = new DateTime($result->Pickup_Date); echo htmlentities($formatexpiry_date->format('d-m-Y'));?></td>
                                            <td><?php echo htmlentities($result->Sourced_By);?></td>
                                            <td><?php echo htmlentities($result->Company);?> </td>
											<td><?php echo htmlentities(hidephoneno($result->Contact_No1));?><br><?php echo htmlentities(hidephoneno($result->Contact_No2));?><br><?php echo htmlentities(hidephoneno($result->Mobile_in_Form));?> </td>	
											<td style="display:none;"><?php echo htmlentities($result->Contact_No1);?><br><?php echo htmlentities($result->Contact_No2);?><br><?php echo htmlentities($result->Mobile_in_Form);?> </td>	
											<td><?php $formatexpiry_date = new DateTime($result->nextdate); echo htmlentities($formatexpiry_date->format('d-m-Y'));?> </td>
<td>
<a href="msgcmt.php?cid=<?php echo $result->id;?>&cname=<?php echo $result->Insured_Name;?>"><i class="fa fa-mail-reply"></i></a>
<a href="rcvmsgcmt-selected.php?cid=<?php echo $result->id;?>">&nbsp; <i class="fa fa-envelope"></i></a>
<a href="wcreport.php?cid=<?php echo $result->id;?>">&nbsp; <h5 style="color:Tomato;"><b>REPORT</b></h5></a>
</td>														
													</tr>


											<?php $cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table>
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
			$(document).ready(function() {
				setTimeout(function() {
					$('.succWrap').slideUp("slow");
				}, 3000);
			});
		</script>

	</body>

	</html>
<?php } ?>