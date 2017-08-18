<!DOCTYPE html>
<html lang="en">

<head>
    <title>controlling</title>
    <meta http-equiv="refresh" content="1; url=/">
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">


</head>

<body>
  <div id="wrapper">
      <div id="page-wrapper">
          <div class="container-fluid">
              <!-- /.row -->
              <div class="row">
                  <div class="col-lg-12 text-center">
                            <div class="alert alert-success">
                                <strong>Sukces!</strong> Obwód zostnie podłączony :)
                            </div>
                  </div>
              </div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

<?php
  if (file_exists('config.php')) { include('./config.php'); } else { die("no config file"); }
  if (file_exists('config.php')) { include('./state.php'); } else { die("no state.php file"); }
  $lz = new state($db_host,$db_user,$db_pass,$db_name);
  if (!empty($_GET['action']))
  {
    $a = ($_GET['action']); echo($lz->comm($a)); header("Refresh:2; url=index.php");
  }
?>

</body>

</html>
