<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{



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
	
	<title>Manage Workers</title>

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

						<h2 class="page-title"><i class="fa fa-tasks"></i>&nbsp;Workers Load</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List Users</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Image</th>
                                                <th>Name</th>
												<th>Code.</th>
												<th>Pending Work</th>
												<th>Fresh Work</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Designation</th>
                                              
										</tr>
									</thead>
									
									<tbody>

<?php $sql = "SELECT * from  users ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>


<!-- Pending Work per user  -->
<?php 
$sql1 ="select users.id from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.nextdate<=(:date) and clients.wcaction!='Wrong number' and clients.wcaction!='Lead Closed' and clients.wcaction!='Not interested'";
$query1 = $dbh -> prepare($sql1);;
$query1->bindParam(':email', $result->email, PDO::PARAM_STR);
$query1->bindParam(':date',date("Y-m-d"), PDO::PARAM_STR);	
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$queryresult1=$query1->rowCount();
?>
<!-- Total Fresh Work per user  -->
<?php 
$sql2 ="select clients.id from users,clients where clients.Caller_Code=users.caller_code AND users.email=(:email) AND clients.wcaction is null";
$query2 = $dbh -> prepare($sql2);;
$query2->bindParam(':email', $result->email, PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$queryresult2=$query2->rowCount();
?>




	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><img src="../images/<?php echo htmlentities($result->image);?>" style="width:50px; border-radius:50%;"/></td>
                                            <td><?php echo htmlentities($result->name);?></td>
											<td><?php echo htmlentities($result->caller_code);?></td>
											<td><?php echo htmlentities($queryresult1);?></td>
											<td><?php echo htmlentities($queryresult2);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
                                            <td><?php echo htmlentities($result->gender);?></td>
                                            <td><?php echo htmlentities($result->mobile);?></td>
                                            <td><?php echo htmlentities($result->designation);?> 
                                            
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
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
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
		
</body>
</html>
<?php } ?>
