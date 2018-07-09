<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarCrawler</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <!-- AIzaSyCBPWM21XoXtodJFdDLALgxieohvqyIH7E -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        #map-container {
            flex: 1 1 auto;
            background-color: #CCC;
        }
        .addButton {
            background-color: #366e51;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="#" style="color: #366e51; font-weight: bold; font-size: 24px;">BarCrawler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="user.php" style="color: #366e51; font-size: 15px; font-weight: 500; padding-top: 10px;">My Account<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../login/logout.php" style="color: #366e51; font-size: 15px; font-weight: 500; padding-top: 10px;">Sign Out<span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0" id="google-form">
          <input class="form-control mr-sm-2" type="search" placeholder="3650 McClintock Avenue, Los Angeles, CA 90089" aria-label="Search" id="address">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9" id="map-container" style="height: calc(100vh - 60px);">col-8</div>
        <div class="col-md-3" style="background-color: #366f52; color: #bae6d0; position: absolute; right: 0; text-align: center; z-index: 2; border: 2px solid #367052; padding: 5px;">
          <h3 style="font-size: 25px;">Results</h3>
        </div>
        <div class="col-md-3" id="searchResults" style="padding-left: 0; padding-right: 0; text-align: center; height: calc(100vh - 60px) ;overflow:  scroll; padding-top: 45px; border: 2px solid #367052; background: #b7e4ce;">



        </div>
      </div>
    </div> <!-- #map-container -->
    <script src="../javascript/googleApi.js"></script>
    <script>
    </script>
    <script src="YOUR GOOGLE API KEY"></script>
</body>
</html>
