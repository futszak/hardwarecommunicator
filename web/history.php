<!doctype html>
  <html>
  <head>
  <meta http-equiv="refresh" content="60">
  <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  <style>
  table, th, td {
  border: 1px solid black;
  }
  </style>
  </head>
  <body>

      <div id="wrapper">
          <div id="page-wrapper">
              <div class="container-fluid">
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-lg-3 text-center">
                          <div class="alert alert-info">
                              <a href="today"><strong>Dzisiejsza</strong> historia auta</a>
                          </div>
                    </div>
                    <div class="col-lg-3 text-center">
                          <div class="alert alert-info">
                              <a href="month"><strong>Cała</strong> historia auta</a>
                          </div>
                    </div>
                    <div class="col-lg-6 text-center">
                          <div class="alert alert-info">
                              <a href="/"><strong>Powrót</strong> do panelu sterowania</a>
                          </div>
                    </div>
                      <!-- /.between components -->
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

  <table style="width:100%">
  <tr>
  <th>Data i godzina</th>
  <th>Wspolrzedne geograficzne</th>
  <th>Stan obwodu</th>
  </tr>

<?php
if (file_exists('config.php')) { include('./config.php'); } else { die("no config file"); }
if (file_exists('config.php')) { include('./state.php'); } else { die("no state.php file"); }
$lz = new state($db_host,$db_user,$db_pass,$db_name);
$prt = ($lz->tblrender());
echo($prt);

 ?>

  </table></body>
