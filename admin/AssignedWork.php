<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {



if (isset($_POST['filter'])) 
{
	$caller_code=$_POST['caller_code'];
	
	if($_POST['work_load']=='UN-Assigned'){$work_load='where caller_code is null';}
	else if($_POST['work_load']=='Assigned'){$work_load='where caller_code is not null';}
	else {$work_load='where 1=1';}

	
$querysidlid = $connect->prepare("SELECT MAX(lid),MIN(sid) from importlog where idate='".$_POST['importdate']."'"); // prepate a query
$querysidlid->execute(); // actually perform the query
$resultsidlid = $querysidlid->get_result(); // retrieve the result so it can be used inside PHP
$r = $resultsidlid->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
$lid = $r['MAX(lid)'];
$sid = $r['MIN(sid)'];
$importdate=' and id>='.$sid.' and id<='.$lid.'';
$date=$_POST['importdate'];

if($_POST['selectoption']=='all'){$checked='checked="checked"';}
else{$checked='';}

if($_POST['sourceby']=='all'){$sourceby='';}
else{$sourceby=" and Sourced_By='".$_POST['sourceby']."'";}

if($_POST['Company']=='all'){$Company='';}
else{$Company=" and Company='".$_POST['Company']."'";}

$adate=$_POST['assigneddate'];
}
else
{
	//$caller_code='r1';
	$date=date("Y-m-d");
	$adate=date("Y-m-d");
	$importdate='';
	$Company='';
	$sourceby='';
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

		<title>Assigne Work</title>

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
							<?php
											if (isset($caller_code)) {
											$sql = "SELECT name from  users where caller_code=(:caller_code)";
											$query = $dbh->prepare($sql);
											$query->bindParam(':caller_code', $caller_code, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													
														<?php echo '<h3 class="page-title"><i class="fa fa-user"></i> &nbsp;Worker: ' . $result->name . ' &nbsp; <button class="btn btn-primary" id="work" name="submit" type="submit"><h4>&nbsp;Give Work&nbsp;</h4></button></h3>'; ?>
														<input type="hidden" id="callerCodeVal" value="<?php echo $caller_code?>"/>
														
													


										<?php 
												}
											}
										}
										?>
						</div>	
						
						<div class="panel-body">
						<form method="post" class="form-horizontal" enctype="multipart/form-data" name="filter">
						<div class="row"><div class="form-group">
						<label class="col-sm-1 control-label">Worker<span style="color:red">*</span></label>
									<div class="col-sm-4">
										<select id="caller_code" name="caller_code" class="form-control" required>

											
													<option value="all">Select Worker</option>

											<?php $sql = "SELECT name,caller_code from  users";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<option <?php if ($caller_code == $result->caller_code) echo "selected='selected'";?> value="<?php echo htmlentities($result->caller_code); ?>"><?php echo htmlentities($cnt); ?>.<?php echo htmlentities($result->name); ?></option>
											<?php $cnt = $cnt + 1;
												}
											} ?>


										</select>

									</div>
									
									<label class="col-sm-1 control-label">Assigned Date</label>
							<div class="col-sm-3">
							<input type="date" name="assigneddate" class="form-control" value="<?php echo $adate;?>">
							<input type="hidden" id="asndate" value="<?php echo $adate?>"/>
							</div>
									
									<button class="btn btn-primary" name="filter" type="submit">Filter</button>
									</div>
									</div>
						<div class="form-group">		
						<label class="col-sm-1 control-label">Work Load</label>
									<div class="col-sm-3">
										<select name="work_load" class="form-control" required>
												<option <?php if ($_POST['work_load'] == "all") echo "selected='selected'";?> value="all">All</option>
												<option <?php if ($_POST['work_load'] == "Assigned") echo "selected='selected'";?> value="Assigned">Assigned Work</option>
												<option <?php if ($_POST['work_load'] == "UN-Assigned") echo "selected='selected'";?> value="UN-Assigned">UN-Assigned Work</option>
										</select>
									</div>			
						
						<label class="col-sm-1 control-label">Import Date</label>
							<div class="col-sm-3">
							<input type="date" name="importdate" class="form-control" value="<?php echo $date;?>">
							</div>
							
							<label class="col-sm-1 control-label">Select</label>
									<div class="col-sm-3">
										<select name="selectoption" class="form-control" required>
												<option <?php if ($_POST['selectoption'] == "nall") echo "selected='selected'";?> value="nall">UN-Select All</option>
												<option <?php if ($_POST['selectoption'] == "all") echo "selected='selected'";?> value="all">Select All</option>
												
										</select>
									</div>
						</div>		
						<div class="form-group">
									<label class="col-sm-1 control-label">Sourced By</label>
									<div class="col-sm-3">
										<select name="sourceby" class="form-control" required>

											
													<option value="all">All</option>

											<?php $sql = "SELECT Sourced_By from  clients GROUP by Sourced_By;";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<option <?php if ($_POST['sourceby'] == $result->Sourced_By&&$_POST['sourceby'] !=null) echo "selected='selected'";?> value="<?php echo htmlentities($result->Sourced_By); ?>"><?php echo htmlentities($cnt); ?>.<?php echo htmlentities($result->Sourced_By); ?></option>
											<?php $cnt = $cnt + 1;
												}
											} ?>


										</select>									
									</div>
									
									<label class="col-sm-1 control-label">Company</label>
									<div class="col-sm-3">
										<select name="Company" class="form-control" required>

											
													<option value="all">All</option>

											<?php $sql = "SELECT Company from  clients GROUP by Company;";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<option <?php if ($_POST['Company'] == $result->Company&&$_POST['Company'] !=Null ) echo "selected='selected'";?> value="<?php echo htmlentities($result->Company); ?>"><?php echo htmlentities($cnt); ?>.<?php echo htmlentities($result->Company); ?></option>
											<?php $cnt = $cnt + 1;
												}
											} ?>


										</select>									
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
											<th>Worker</th>
											
											<th>Action</th>
										</tr>
									</thead>

									<tbody>



										
										<?php
										
										if (isset($caller_code)) {
											
											$sql = "SELECT id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,Caller from  clients ".$work_load.$importdate.$Company.$sourceby." ORDER BY id DESC";
											$query = $dbh->prepare($sql);
											$query->bindParam(':caller_code', $caller_code, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<!--<td><img src="../images/<?php echo htmlentities($result->image); ?>" style="width:50px; border-radius:50%;"/></td> -->
														<td><a href="clientdetail-selected.php?cid=<?php echo $result->id;?>" target="_blank">
														<?php echo htmlentities($result->Insured_Name); ?></a></td>
														
                                            <td><?php echo htmlentities($result->Reference_Tagging);?></td>
                                            <td><?php echo htmlentities($result->Plan);?></td>
											<td><?php $formatexpiry_date = new DateTime($result->Pickup_Date); echo htmlentities($formatexpiry_date->format('d-m-Y'));?></td>
                                            <td><?php echo htmlentities($result->Sourced_By);?></td>
                                            <td><?php echo htmlentities($result->Company);?> </td>
														<td><?php echo htmlentities($result->Caller); ?></td>
														<td><?php echo '<input ' .$checked. ' type="checkbox" id="' . $result->id . '" value="' . $caller_code . '">' ?></td>
													</tr>


										<?php $cnt = $cnt + 1;
												}
											}
										}
										?>

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

			var work = document.getElementById('work');
			work.addEventListener('click', () => {
				//var asndate = $('#asndate');
				var asnDateVal = document.getElementById('asndate').value;
				var callerCodeVal = document.getElementById('callerCodeVal').value;
				var table = document.getElementById('zctb');
				var checkboxes = table.getElementsByTagName('input');
				var cids = "";
				for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i].checked) {
						var id = checkboxes[i].id;
						cids+=id + "+";
					}
				}
				cids = cids.substring(0, cids.length - 1); 
				var data = {
					cids: cids,
					callerCode: callerCodeVal,
					asnDate : asnDateVal
				};

				function sendData(data) {
					console.log('Sending data');

					const XHR = new XMLHttpRequest();

					let urlEncodedData = "",
						urlEncodedDataPairs = [],
						name;

					// Turn the data object into an array of URL-encoded key/value pairs.
					for (name in data) {
						urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]));
					}

					urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

					// Define what happens on successful data submission
					XHR.addEventListener('load', function(event) {
						console.log('Yeah! Data sent and response loaded.');
						console.log(event);
						document.location = 'ViewAssignedWork.php';
					});

					// Define what happens in case of error
					XHR.addEventListener('error', function(event) {
						alert.log('Oops! Something went wrong.');
					});

					XHR.open('POST', 'submitwork.php');

					XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

					XHR.send(urlEncodedData);
				}
				sendData(data);
			});
		</script>

	</body>

	</html>
<?php } ?>