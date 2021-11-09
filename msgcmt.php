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
	if(isset($_GET['cname']))
	{
	$cname=$_GET['cname'];
	}
	  	

	if(isset($_POST['submit']))
  {	
	$wid=$_POST['wid'];

	$reciver='Admin';
    $message=$_POST['message'];
	$notitype='Comment';
	$sender=$_SESSION['wlogin'];
	
    $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    $querynoti = $dbh->prepare($sqlnoti);
	$querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
	$querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
    $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
    $querynoti->execute();

	$sql="insert into msgcmt (wid, cid,cname, msg, sender) values (:wid,:cid,:cname,:message,:sender)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':wid', $wid, PDO::PARAM_STR);
	$query-> bindParam(':cid', $cid, PDO::PARAM_STR);
	$query-> bindParam(':cname', $cname, PDO::PARAM_STR);
	$query-> bindParam(':sender', $sender, PDO::PARAM_STR);
	$query-> bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute(); 
	$msg="Comment Send";
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
	
	<title>Edit Profile</title>

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
		$sql = "SELECT id,Insured_Name,Caller,Caller_Code from clients where id=(:cid);";
		$query = $dbh -> prepare($sql);
		$query-> bindParam(':cid', $cid, PDO::PARAM_STR);
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
						<div class="row">
							<div class="col-md-12">
                            <h2>Comment: <?php echo htmlentities($result->Caller); ?></h2>
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($result->Caller); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

	
<div class="form-group">
	<label class="col-sm-2 control-label">Client<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="Insured_Name" class="form-control" readonly required value="<?php echo htmlentities($result->Insured_Name);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Message<span style="color:red">*</span></label>
	<div class="col-sm-6">
	<textarea name="message" class="form-control" cols="30" rows="10"></textarea>
	</div>
</div>

<input type="hidden" name="wid" class="form-control" required value="<?php echo htmlentities($result->Caller_Code);?>">



<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Send Reply</button>
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