<!DOCTYPE html>
<html lang="pl">

<html>
    <head>
      <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <?php
      $myfile = fopen("jsout2.php", "w");
      fwrite($myfile, '<?ph');
      fwrite($myfile, "p echo json_encode('");
      fwrite($myfile, $_GET['latitude']);
      fwrite($myfile, ',');
      fwrite($myfile, $_GET['longitude']);
      fwrite($myfile, "'); ?");
      fwrite($myfile, ">");
      fclose($myfile);
      ?>

      <style type="text/css">
      /* Set a size for our map container, the Google Map will take up 100% of this container */
      #map {
      align-content: center;
      width: auto;
      height: 500px;
      }

      </style>
        <title>Mapa</title>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgHfR1ex_PHGWaEjGQMm39TlaXt7eOk4I"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script type="text/javascript">

            google.maps.event.addDomListener(window, 'load', init);

            function init() {

                var markers = [];
                var mapOptions = {
                    zoom: 8,
                    center: new google.maps.LatLng(52.2316039,21.0065828), // New York
                    styles: [{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f3f4f4"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"weight":0.9},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#83cead"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType": "transit.line","elementType": "all","stylers": [{"visibility": "on"},{"color": "#ff5733"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7fc8ed"}]}]
                }
                var mapElement = document.getElementById('map');
                var map = new google.maps.Map(mapElement, mapOptions);
                pointmark(map);


            function pointmark(map) {
                // Let's also add a marker while we're at it
                $.getJSON('jsout2.php', function(data) {
                var ss = data.split(",");
                console.log(data);
                console.log(markers);
                var marker = new google.maps.Marker({
                    // position: new google.maps.LatLng(data),
                    position: new google.maps.LatLng(ss[0],ss[1]),
                    map: map,
                    title: 'Ja!'
                });
                markers.push(marker);

              }); }

              function pointdel() {
                  // Let's also add a marker while we're at it
                  $.getJSON('jsout.php', function(data) {
                  var ss = data.split(",");
                  console.log(data);
                  console.log(markers);
                  markers[0].setMap(null);
                  markers = [];
                }); }
            }
        </script>
    </head>
    <body>

      <div id="wrapper">
          <div id="page-wrapper">
              <div class="container-fluid">
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-lg-6 text-center">
                      <div class="alert alert-info">
                        <a href="/"><strong>Powrót</strong> do panelu sterowania</a>
                      </div>
                    </div>
                    <div class="col-lg-6 text-center">
                      <div class="alert alert-info">
                        <a href="history.php"><strong>Historia</strong> położenia auta</a>
                      </div>
                    </div>
              </div>
              <!-- /.container-fluid -->
          </div>
          <!-- /#page-wrapper -->
      </div>

        <div id="map"></div>
    </body>
</html>
