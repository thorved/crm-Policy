<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if(isset($_POST['submit']))
	{	
		
		$_SESSION['summaryenddate_admin'] =  $_POST['summaryenddate_admin'];
		$_SESSION['summarystartdate_admin'] = $_POST['summarystartdate_admin'];
		
	}
	
	else{
							
		
			
			$lastWeek = date("Y-m-d", strtotime("-7 days"));

		 if (strlen($_SESSION['summarystartdate_admin']) == 0) {
				$_SESSION['summarystartdate_admin']=$lastWeek;
			}
		 if (strlen($_SESSION['summaryenddate_admin']) == 0) {
				$_SESSION['summaryenddate_admin']=date("Y-m-d");
			}
		 
		 
			
			
		}


        $sql= "SELECT wcaction FROM clients where clients.assigned_date>='$_SESSION[summarystartdate_admin]' AND clients.assigned_date<='$_SESSION[summaryenddate_admin]' GROUP BY wcaction ORDER BY Caller "; 
                                            
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {	
            // output data of each row
            $cnt =0;
            while($row = $result->fetch_assoc()) {
                //$workersummary[$row["Caller"]] = $row["Caller"];
                $workeractionsummary[$cnt] = $row["wcaction"];
                //echo("<script>console.log('PHP: " . $workeractionsummary[$cnt] . "');</script>");
                $cnt++;
            }
        }

        $sql= "SELECT  Caller FROM clients where clients.assigned_date>='$_SESSION[summarystartdate_admin]' AND clients.assigned_date<='$_SESSION[summaryenddate_admin]' GROUP BY Caller ORDER BY Caller "; 
        
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {	
            // output data of each row
            $cnt =0;
            while($row = $result->fetch_assoc()) {
                $workersummary[$cnt] = $row["Caller"];
                echo("<script>console.log('PHP: " . $workersummary[$cnt] . "');</script>");
                $cnt++;
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

		<title>Summary</title>

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


            div.scrollmenu {
  
  overflow: auto;
  white-space: nowrap;
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
							<h4 class="page-title"><i class="fa fa-users"></i> &nbsp;Summary &nbsp;:  <?php $formatpendingworkstartdate = new DateTime($_SESSION['summarystartdate_admin']); echo htmlentities($formatpendingworkstartdate->format('d-m-Y'));?> &nbsp; to &nbsp; <?php $formatpendingworkenddate = new DateTime($_SESSION['summaryenddate_admin']); echo htmlentities($formatpendingworkenddate->format('d-m-Y'));?> &nbsp;</h4>
							<form method="post" class="form-horizontal" enctype="multipart/form-data" name="date">
							
							
							<div class="form-group">
							<label class="col-sm-1 control-label">Start Date</label>
							<div class="col-sm-4">
							<input type="date" name="summarystartdate_admin" class="form-control" value="<?php echo $_SESSION['summarystartdate_admin'];?>">
							</div>
							
							<label class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-4">
							<input type="date" name="summaryenddate_admin" class="form-control" value="<?php echo $_SESSION['summaryenddate_admin'];?>">
							</div>
							</div>
							
							<button class="btn btn-primary" name="submit" type="submit">Show Data</button>
										
							
							<a href="exportWorkerSummary.php?wid=all" class="btn btn-success">Download All</a>
							</form>
							</div>


							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								
								<div class="panel-body">
									<?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
									
									<div class="scrollmenu">
                                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<!--	//<th>Image</th>-->
												<th>Worker's</th>
                                                <?php
													
                                                    for ($cnt = 0; $cnt < count($workeractionsummary); $cnt++) {
                                                        echo "<th>$workeractionsummary[$cnt]</th>";
														
                                                        }
                                                                ?>

                                                
											</tr>
										</thead>

										<tbody>



											<?php
                                                
                                            $sql= "SELECT COUNT(wcaction), wcaction,Caller FROM clients where clients.assigned_date>='$_SESSION[summarystartdate_admin]' AND clients.assigned_date<='$_SESSION[summaryenddate_admin]' GROUP BY wcaction,Caller ORDER BY Caller "; 
                                            
                                            $result = $connect->query($sql);
                                            
                                            if ($result->num_rows > 0) {	
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    $summary[$row["Caller"]][$row["wcaction"]] =  $row["COUNT(wcaction)"];
                                                    //echo("<script>console.log('PHP: " . $summary[0][1] . "');</script>");
                                                }
                                            } else {
                                                echo "0 results";
                                                
                                            }

                                           
                                            

											
											
												for ($cnt = 0; $cnt<= count($workersummary)-1; $cnt++) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														
														<td><a href="exportWorkerSummary.php?wid=<?php echo $workersummary[$cnt];?>" target="_blank">
														<?php echo htmlentities($workersummary[$cnt]); ?></a></td>

                                                        <?php
                                                        for ($x = 0; $x < count($workeractionsummary); $x++) {
                                                         $summarydata = $summary[$workersummary[$cnt]][$workeractionsummary[$x]];
                                                         if($summarydata==null){$summarydata=0;}
                                                          echo "<td>$summarydata</td>";
														  
                                                        }
                                                        ?>
																		 								
													</tr>


											<?php 
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