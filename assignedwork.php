<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['wlogin']) == 0) {
	header('location:index.php');
} else {


	$date = date("Y-m-d");


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

		<title>Fresh Assigned Work</title>

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


							<h4 class="page-title"><i class="fa fa-users"></i> &nbsp;Fresh Assigned Work</h4>



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
												<th>Action</th>
											</tr>
										</thead>

										<tbody>



											<?php
											$_SESSION['redirect_worker_page'] = 'location:assignedwork.php';
											$sql = "select clients.id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,Contact_No1,Contact_No2,Mobile_in_Form from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.wcaction is null AND clients.assigned_date<=(:date) ORDER BY assigned_date ASC";
											$query = $dbh->prepare($sql);
											$query->bindParam(':email', $_SESSION['wlogin'], PDO::PARAM_STR);
											$query->bindParam(':date', $date, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											function hidephoneno($phone)
											{
												$times = strlen(trim(substr($phone, 4, 4)));
												$star = '';
												for ($i = 0; $i < $times; $i++) {
													$star .= '*';
												}
												return str_replace(substr($phone, 4, 4), $star, $phone);
											}
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>

														<td><a href="wcreport.php?cid=<?php echo $result->id; ?>">
																<?php echo htmlentities($result->Insured_Name); ?></a></td>
														<td><?php echo htmlentities($result->Reference_Tagging); ?></td>
														<td><?php echo htmlentities($result->Plan); ?></td>
														<td><?php $formatexpiry_date = new DateTime($result->Pickup_Date);
															echo htmlentities($formatexpiry_date->format('d-m-Y')); ?></td>
														<td><?php echo htmlentities($result->Sourced_By); ?></td>
														<td><?php echo htmlentities($result->Company); ?> </td>
														<td><?php echo htmlentities(hidephoneno($result->Contact_No1)); ?><br><?php echo htmlentities(hidephoneno($result->Contact_No2)); ?><br><?php echo htmlentities(hidephoneno($result->Mobile_in_Form)); ?> </td>
														<td style="display:none;"><?php echo htmlentities($result->Contact_No1); ?><br><?php echo htmlentities($result->Contact_No2); ?><br><?php echo htmlentities($result->Mobile_in_Form); ?> </td>
														<td>
															<a href="msgcmt.php?cid=<?php echo $result->id; ?>&cname=<?php echo $result->Insured_Name; ?>"><i class="fa fa-mail-reply"></i></a>
															<a href="rcvmsgcmt-selected.php?cid=<?php echo $result->id; ?>">&nbsp; <i class="fa fa-envelope"></i></a>
															<a href="wcreport.php?cid=<?php echo $result->id; ?>">&nbsp; <h5 style="color:Tomato;"><b>REPORT</b></h5></a>
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