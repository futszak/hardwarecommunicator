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
    $lz->refresh();
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
<?php
              if ($lz->livestream())
              {
                echo('<div class="alert alert-success"><strong>Sukces!</strong> Urządzenie jest połączone :)</div>');
              }
              else
              {
                echo('<div class="alert alert-danger"><strong>Porażka</strong> Urządzenie nie jest połączone :(</div>');
              }
?>
                  </div>
              </div>
              <!-- /.row 2 -->
              <div class="row">
                  <div class="col-lg-12 text-center">
<?php
                    if ($lz->livestream())
                    {
                      if ($lz->circuit())
                      {
                        echo('<div class="alert alert-success"><strong>Sukces!</strong> Obwód jest podłączony :)');
                      }
                      else
                      {
                        echo('<div class="alert alert-danger"><strong>Sukces!</strong> Obwód jest odłaczony :(');
                      }
                    }
                    else {
                      echo('<div class="alert alert-danger"><strong>Porażka</strong> Bieżący stan obwodu nie jest znany :(');
                    }
?>
                  </div>
                  </div>
              </div>
              <!-- /.row 3 -->
              <div class="row">
                <div class="col-lg-2 text-center">
                      <div class="alert alert-info">
                          <a href="mapajs.html"><strong>Mapa</strong></a>
                      </div>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                      <div class="alert alert-info">
                          <a href="history.php"><strong>Zobacz historię</strong> położenia auta</a>
                      </div>
                </div>
                <!-- /.between components -->
<?php
          if ($lz->livestream())
          {
          echo('<div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="ciroff.php?action=off"><strong>Odłącz obwód</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-success">
                      <a href="ciron.php?action=on"><strong>Podłącz obwód</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="restart.php?action=restart"><strong>Retartuj skrypt</strong></a>
                  </a>
                </div>
                <!-- /.between components -->
                <div class="col-lg-2 text-center">
                  <a class="btn btn-lg btn-danger">
                      <a href="reset.php?action=reset"><strong>RESETUJ urządzenie !!!</strong></a>
                  </a>
                </div>');
            }
              else
            {
            echo('<div class="col-lg-6 text-center">
                    <div class="alert alert-default">
                        <strong>Nie możesz wykonywać operacji na urządzeniu :(</strong>
                    </div>
                  </div>');
            }
?>

            </div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->
<!-- <h2>Console</h2> -->

<?php

  // print_r($_SERVER['REMOTE_ADDR']);
  // echo(time());
  // echo date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
  // print_r($lz->maplink(1503336097));

  // $log = new log();
  // $log->send('tresc logow');



?>
<!-- <iframe src="mapajs.html" width="1020" height="520"></iframe> -->
  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
