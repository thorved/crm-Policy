<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if(isset($_POST['submit']))
	{	
		$_SESSION['worker_admin']=$_POST['worker_admin'];
		$_SESSION['pendingworkenddate_admin'] =  $_POST['pendingworkenddate_admin'];
		$_SESSION['pendingworkstartdate_admin'] = $_POST['pendingworkstartdate_admin'];
		$_SESSION['wcaction_admin']=$_POST['wcaction_admin'];
	}
	
	else{
							
		if (strlen($_SESSION['worker_admin']) == 0) {
				$_SESSION['worker_admin']="all";
			}
			
			$lastWeek = date("Y-m-d", strtotime("-7 days"));

		 if (strlen($_SESSION['pendingworkstartdate_admin']) == 0) {
				$_SESSION['pendingworkstartdate_admin']=$lastWeek;
			}
		 if (strlen($_SESSION['pendingworkenddate_admin']) == 0) {
				$_SESSION['pendingworkenddate_admin']=date("Y-m-d");
			}
		 
		 if (strlen($_SESSION['wcaction_admin']) == 0) {
				$_SESSION['wcaction_admin']="Hot Followup";
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
							<h4 class="page-title"><i class="fa fa-users"></i> &nbsp;Pending Work &nbsp;:  <?php $formatpendingworkstartdate = new DateTime($_SESSION['pendingworkstartdate_admin']); echo htmlentities($formatpendingworkstartdate->format('d-m-Y'));?> &nbsp; to &nbsp; <?php $formatpendingworkenddate = new DateTime($_SESSION['pendingworkenddate_admin']); echo htmlentities($formatpendingworkenddate->format('d-m-Y'));?> &nbsp;</h4>
							<form method="post" class="form-horizontal" enctype="multipart/form-data" name="date">
							<div class="form-group">
							<label class="col-sm-1 control-label">Worker<span style="color:red">*</span></label>
									<div class="col-sm-4">
										<select name="worker_admin" class="form-control" required>

											<option value="all">All</option>


											<?php $sql = "SELECT name,caller_code from  users";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<option <?php if ($_SESSION['worker_admin'] == $result->caller_code) echo "selected='selected'";?> value="<?php echo htmlentities($result->caller_code); ?>"><?php echo htmlentities($cnt); ?>.<?php echo htmlentities($result->name); ?></option>
											<?php $cnt = $cnt + 1;
												}
											} ?>





										</select>

									</div>
							
							
							
							
							<label class="col-sm-2 control-label">Worker Action</label>
							<div class="col-sm-4">
							
							<select name="wcaction_admin" class="form-control" required>

											


													
													<option <?php if ($_SESSION['wcaction_admin'] == "all") echo "selected='selected'";?> value="all">All</option>
													
													<optgroup label="Month Followup">
													
													<option <?php if ($_SESSION['wcaction_admin'] == "Jan Followup") echo "selected='selected'";?> value="Jan Followup">Jan Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Feb Followup") echo "selected='selected'";?> value="Feb Followup">Feb Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Mar Followup") echo "selected='selected'";?> value="Mar Followup">Mar Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Apr Followup") echo "selected='selected'";?> value="Apr Followup">Apr Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "May Followup") echo "selected='selected'";?> value="May Followup">May Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "June Followup") echo "selected='selected'";?> value="June Followup">June Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "July Followup") echo "selected='selected'";?> value="July Followup">July Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Aug Followup") echo "selected='selected'";?> value="Aug Followup">Aug Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Sept Followup") echo "selected='selected'";?> value="Sept Followup">Sept Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Oct Followup") echo "selected='selected'";?> value="Oct Followup">Oct Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Nov Followup") echo "selected='selected'";?> value="Nov Followup">Nov Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Dec Followup") echo "selected='selected'";?> value="Dec Followup">Dec Followup</option>
													</optgroup>
													
													<optgroup label="Followup">
													<option <?php if ($_SESSION['wcaction_admin'] == "Hot Followup") echo "selected='selected'";?> value="Hot Followup">Hot Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Warm Followup") echo "selected='selected'";?> value="Warm Followup">Warm Followup</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Cold Followup") echo "selected='selected'";?> value="Cold Followup">Cold Followup</option>
													
													</optgroup>
													<optgroup label="Others">
													<option <?php if ($_SESSION['wcaction_admin'] == "Ringing") echo "selected='selected'";?> value="Ringing">Ringing</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Not reachable") echo "selected='selected'";?> value="Not reachable">Not reachable</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Number Busy") echo "selected='selected'";?> value="Number Busy">Number Busy</option>
													<!--<option <?php if ($_SESSION['wcaction_admin'] == "Wrong number") echo "selected='selected'";?> value="Wrong number">Wrong number</option>-->
													<option <?php if ($_SESSION['wcaction_admin'] == "Discussion done, to be called again") echo "selected='selected'";?> value="Discussion done, to be called again">Discussion done, to be called again</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Discussion not done, to be called again") echo "selected='selected'";?> value="Discussion not done, to be called again">Discussion not done, to be called again</option>
													<!--<option <?php if ($_SESSION['wcaction_admin'] == "Not interested") echo "selected='selected'";?> value="Not interested">Not interested</option>-->
													<option <?php if ($_SESSION['wcaction_admin'] == "Lead Generated") echo "selected='selected'";?> value="Lead Generated">Lead Generated</option>
													<option <?php if ($_SESSION['wcaction_admin'] == "Looking for some other product") echo "selected='selected'";?> value="Looking for some other product">Looking for some other product</option>
													<!--<option <?php if ($_SESSION['wcaction_admin'] == "Lead Closed") echo "selected='selected'";?> value="Lead Closed">Lead Closed</option>-->
													</optgroup>


										</select>
							</div>
							</div>
							
							<div class="form-group">
							<label class="col-sm-1 control-label">Start Date</label>
							<div class="col-sm-4">
							<input type="date" name="pendingworkstartdate_admin" class="form-control" value="<?php echo $_SESSION['pendingworkstartdate_admin'];?>">
							</div>
							
							<label class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-4">
							<input type="date" name="pendingworkenddate_admin" class="form-control" value="<?php echo $_SESSION['pendingworkenddate_admin'];?>">
							</div>
							</div>
							
							<button class="btn btn-primary" name="submit" type="submit">Show</button>							
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
												<th>Next Action Date</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>



											<?php
											if($_SESSION['wcaction_admin']=="all"&&$_SESSION['worker_admin']=="all")
											{
												$sql="select id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Caller_Code from clients where clients.nextdate>=(:pendingworkstartdate_admin) AND clients.nextdate<=(:pendingworkenddate_admin) and clients.wcaction!='Wrong number' and clients.wcaction!='Lead Closed' and clients.wcaction!='Not interested'";
												$query = $dbh->prepare($sql);
											}
											else if($_SESSION['worker_admin']=="all")
											{
												$sql="select id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Caller_Code from clients where clients.nextdate>=(:pendingworkstartdate_admin) AND clients.nextdate<=(:pendingworkenddate_admin) and clients.wcaction=(:wcaction)";
												$query = $dbh->prepare($sql);
												$query->bindParam(':wcaction', $_SESSION['wcaction_admin'], PDO::PARAM_STR);
											}
											
											else if($_SESSION['wcaction_admin']=="all")
											{
												$sql="select id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Caller_Code from clients where clients.nextdate>=(:pendingworkstartdate_admin) AND clients.nextdate<=(:pendingworkenddate_admin) and clients.caller_code=(:worker) and clients.wcaction!='Wrong number' and clients.wcaction!='Lead Closed' and clients.wcaction!='Not interested'";
												$query = $dbh->prepare($sql);
												$query->bindParam(':worker', $_SESSION['worker_admin'], PDO::PARAM_STR);
											}
											else
											{
												$sql="select id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,nextdate,Caller_Code from clients where clients.nextdate>=(:pendingworkstartdate_admin) AND clients.nextdate<=(:pendingworkenddate_admin) and clients.caller_code=(:worker) and clients.wcaction=(:wcaction)";
												$query = $dbh->prepare($sql);
												$query->bindParam(':wcaction', $_SESSION['wcaction_admin'], PDO::PARAM_STR);
												$query->bindParam(':worker', $_SESSION['worker_admin'], PDO::PARAM_STR);
											}
											
											//$query->bindParam(':email', $_SESSION['wlogin'], PDO::PARAM_STR);
											$query->bindParam(':pendingworkstartdate_admin', $_SESSION['pendingworkstartdate_admin'], PDO::PARAM_STR);
											$query->bindParam(':pendingworkenddate_admin', $_SESSION['pendingworkenddate_admin'], PDO::PARAM_STR);
											
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														
														<td><a href="clientdetail-selected.php?cid=<?php echo $result->id;?>" target="_blank">
														<?php echo htmlentities($result->Insured_Name); ?></a></td>
														<td><?php echo htmlentities($result->Reference_Tagging);?></td>
                                            <td><?php echo htmlentities($result->Plan);?></td>
											<td><?php $formatexpiry_date = new DateTime($result->Pickup_Date); echo htmlentities($formatexpiry_date->format('d-m-Y'));?></td>
                                            <td><?php echo htmlentities($result->Sourced_By);?></td>
                                            <td><?php echo htmlentities($result->Company);?> </td>
											<td><?php $formatexpiry_date = new DateTime($result->nextdate); echo htmlentities($formatexpiry_date->format('d-m-Y'));?></td>
<td>
<a href="msgcmt.php?cid=<?php echo $result->id;?>&cname=<?php echo $result->Insured_Name;?>&wid=<?php echo $result->Caller_Code;?>">&nbsp; <i class="fa fa-mail-reply"></i></a>&nbsp;&nbsp;
<a href="rcvmsgcmt-selected.php?cid=<?php echo $result->id;?>">&nbsp; <i class="fa fa-envelope"></i></a>&nbsp;&nbsp;

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