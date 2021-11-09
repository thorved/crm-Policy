<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	




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

		<title>Assigned Work</title>

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

							<h3 class="page-title"><i class="fa fa-users"></i> &nbsp;Client Worker</h3>

							<form method="post" class="form-horizontal" enctype="multipart/form-data" name="selectclientsbyworkers">
								<div class="form-group">

									<label class="col-sm-1 control-label">Worker<span style="color:red">*</span></label>
									<div class="col-sm-5">
										<select name="worker" class="form-control" required>

											<option value="all">All</option>


											<?php $sql = "SELECT name,caller_code from  users";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<option <?php if ($_POST['worker'] == $result->caller_code) echo "selected='selected'";?> value="<?php echo htmlentities($result->caller_code); ?>"><?php echo htmlentities($cnt); ?>.<?php echo htmlentities($result->name); ?></option>
											<?php $cnt = $cnt + 1;
												}
											} ?>





										</select>

									</div>
									<button class="btn btn-primary" name="submit" type="submit">Show</button>
								</div>
							</form>

							<h4 class="page-title">Manage Clients</h4>



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
											
												if ($_POST['worker'] == "all" || $_POST['worker'] == null) {
													$sql = "SELECT id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,Caller from  clients ";
												} else {
													$sql = "SELECT id,Insured_Name,Reference_Tagging,Plan,Pickup_Date,Sourced_By,Company,Caller from  clients WHERE Caller_Code=(:caller_code)";
												}
											

											$query = $dbh->prepare($sql);
											$query->bindParam(':caller_code', $_POST['worker'], PDO::PARAM_STR);
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
                                            <td><?php echo htmlentities($result->Company);?> 
														<td><?php echo htmlentities($result->Caller); ?></td>
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