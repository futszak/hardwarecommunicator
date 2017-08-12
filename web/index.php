<!DOCTYPE html>
<html lang="pl">

<head>
    <title>controlling</title>
    <meta http-equiv="refresh" content="5; url=/">
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <?php
    if (file_exists('config.php')) { include('./config.php'); } else { die("no config file"); }
    if (file_exists('config.php')) { include('./state.php'); } else { die("no state.php file"); }
    $lz = new state($db_host,$db_user,$db_pass,$db_name);
    if (!empty($_GET['action'])) { $a = ($_GET['action']); echo($lz->comm($a)); sleep(2); header("Refresh:0; url=index.php"); }
    ?>

</head>

<body>
  <div id="wrapper">
      <div id="page-wrapper">
          <div class="container-fluid">
              <!-- /.row 1 -->
              <div class="row">
                  <div class="col-lg-12 text-center">
                            <div class="alert alert-success">
                                <strong>Sukces!</strong> Urządzenie jest połączone :)
                            </div>
                  </div>
              </div>
              <!-- /.row 2 -->
              <div class="row">
                  <div class="col-lg-12 text-center">
                    <?php
                    if ($lz->circuit()) { echo('<div class="alert alert-success"><strong>Sukces!</strong> Obwód jest podłączony :)'); }
                    else { echo('<div class="alert alert-danger"><strong>Sukces!</strong> Obwód jest odłaczony :('); }
                    ?>
                  </div>
                  </div>
              </div>
              <!-- /.row 3 -->
              <div class="row">
                <div class="col-lg-2 text-center">
                      <div class="alert alert-info">
                          <a href="mapa"><strong>Kliknij</strong> aby zobaczyć ostatnią pozycję auta</a>
                      </div>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                      <div class="alert alert-info">
                          <a href="history"><strong>Zobacz historię</strong> położenia auta</a>
                      </div>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="?action=off"><strong>Odłącz obwód</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-success">
                      <a href="?action=on"><strong>Podłącz obwód</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="?action=restart"><strong>Retartuj skrypt</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="?action=reset"><strong>RESETUJ urządzenie !!!</strong></a>
                  </a>
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



</body>

</html>
