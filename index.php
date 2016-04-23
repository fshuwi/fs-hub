<?php
$users_titles = array();
$users_titles["1_alle"] = "Für alle Menschen";
$users_titles["2_students"] = "Für Studierende der Huwi";
$users_titles["3_fachschaft"] = "Für Menschen der Fachschaft Huwi";
$users_titles["4_admin"] = "Adminscheiß";

$csv = array_map('str_getcsv', file("services.csv"));
array_walk($csv, function(&$a) use ($csv) {
  $a = array_combine($csv[0], $a);
});
array_shift($csv); # remove column header

$services = $csv;

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Fachschaft Huwi Hub</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div>
      </div>
    </nav> -->

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
	    <img id="logo" src="kHuWi.svg" style="max-width: 10%;">
        <h1>Hallo, Menschen!</h1>
        <p>Du bist hier auf der Übersichtsseite der Fachschaft Huwi gelandet.</p>
        <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
      </div>
    </div>

    <div class="container">
		
		<?php

		$last_users = "";
		foreach ($services as $service)
		{
		  $status = "status-".$service['Status'];
		  $url = $service['URL'];
		  $users = $service['Zugriff - Gruppe'];
		  $title = $service['Name'];
		  $protocol = $service['https'] == "ja" ? "https://" : "http://";
		  $url = $protocol.$url;

		  if ($last_users != $users)
		  {
			if ($last_users != "")
			{
			?>
			  </ul>
			<?php
			}
			?>
			
			<div class="clear" />
			<h1><?= $users_titles[$users] ?></h1>
			<!-- <ul> -->
			
		  <?php
		  }
		  ?>
		  
		  <!-- <button type="button" class="btn btn-lg btn-default">Default</button> -->
		  <a href="<?=$url?>" class="btn btn-lg btn-default btn-huwi-application" role="button"><?=$title?></a>
		  <?php
		  if ($status != "status-working")
		  {
			  ?>
			  <span class="label label-warning"><?=$status?></span>
			  <?php
		  }
		  ?>
		  <!-- <br><br> -->

		  <!--
		  <li class="<?=$status?>">
		    <a href="<?=$url?>">
			  <?=$title?>
			</a>
		  </li> -->
		  
		  <?php
		  $last_users = $users;
		}
		?>
		
		<!-- </ul> -->
	
      <!-- Example row of columns -->
	  <!--
      <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2015</p>
      </footer>
	  -->
	  
    </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

		<!-- Piwik -->
		<script type="text/javascript">
		  var _paq = _paq || [];
		  _paq.push(['trackPageView']);
		  _paq.push(['enableLinkTracking']);
		  (function() {
			var u="//huwi.rocks/piwik/";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', 2]);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		  })();
		</script>
		<noscript><p><img src="//huwi.rocks/piwik/piwik.php?idsite=2" style="border:0;" alt="" /></p></noscript>
		<!-- End Piwik Code -->
		
    </body>
</html>
