<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['sid']) && isset($_GET['lid'])) {
        //header('location:deleteimportclients.php');
        $sql = "delete from clients Where id>='$_GET[sid]' AND id<='$_GET[lid]'";
        $query = $dbh->prepare($sql);

        $sql2 = "delete from importlog Where sid='$_GET[sid]' AND lid='$_GET[lid]'";
        $query2 = $dbh->prepare($sql2);

        if ($query->execute() && $query2->execute()) {
            $msg = "Clients deleted successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }

        //header('location:index.php');
    }
    if (isset($_POST['submit'])) {

        $_SESSION['deleteimportclientsenddate_admin'] =  $_POST['deleteimportclientsenddate_admin'];
        $_SESSION['deleteimportclientsstartdate_admin'] = $_POST['deleteimportclientsstartdate_admin'];
    }



    $lastWeek = date("Y-m-d", strtotime("-7 days"));

    if (strlen($_SESSION['deleteimportclientsstartdate_admin']) == 0) {
        $_SESSION['deleteimportclientsstartdate_admin'] = $lastWeek;
    }
    if (strlen($_SESSION['deleteimportclientsenddate_admin']) == 0) {
        $_SESSION['deleteimportclientsenddate_admin'] = date("Y-m-d");
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

        <title>Delete Import Clients</title>

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
                                <h4 class="page-title"><i class="fa fa-upload"></i> &nbsp;Import Date &nbsp;: <?php $formatpendingworkstartdate = new DateTime($_SESSION['deleteimportclientsstartdate_admin']);
                                                                                                                echo htmlentities($formatpendingworkstartdate->format('d-m-Y')); ?> &nbsp; to &nbsp; <?php $formatpendingworkenddate = new DateTime($_SESSION['deleteimportclientsenddate_admin']);
                                                                                                                                                                                                        echo htmlentities($formatpendingworkenddate->format('d-m-Y')); ?> &nbsp;</h4>
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" name="date">


                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Start Date</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="deleteimportclientsstartdate_admin" class="form-control" value="<?php echo $_SESSION['deleteimportclientsstartdate_admin']; ?>">
                                        </div>

                                        <label class="col-sm-2 control-label">End Date</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="deleteimportclientsenddate_admin" class="form-control" value="<?php echo $_SESSION['deleteimportclientsenddate_admin']; ?>">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" name="submit" type="submit">Show Data</button>



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

                                                    <th>Import Date Time</th>
                                                    <th>Import Date</th>
                                                    <th>Start {id}</th>
                                                    <th>Last {id}</th>
                                                    <th>Action</th>



                                                </tr>
                                            </thead>

                                            <tbody>



                                                <?php $sql = "SELECT * FROM importlog Where idate>='$_SESSION[deleteimportclientsstartdate_admin]' AND idate<='$_SESSION[deleteimportclientsenddate_admin]'";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {                ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>

                                                            <td><?php echo date("d-m-Y h:i A", strtotime($result->idatetime)) ?></td>
                                                            <td><?php echo date("d-m-Y", strtotime($result->idate)) ?></td>
                                                            <td><?php echo htmlentities($result->sid); ?></td>
                                                            <td><?php echo htmlentities($result->lid); ?></td>



                                                            <td>
                                                                <a href="deleteimportclients.php?sid=<?php echo $result->sid; ?>&lid=<?php echo $result->lid; ?>" onclick="return confirm('Do you want to Delete');" class="btn btn-danger">Delete</a>

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