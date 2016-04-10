<?php
$host = "http://huwi.rocks";

$users_titles = array();
$users_titles["1_alle"] = "Für alle Menschen";
$users_titles["2_students"] = "Für Studierende der Huwi";
$users_titles["3_fachschaft"] = "Für Menschen der Fachschaft Huwi";
$users_titles["4_admin"] = "Adminscheiß";



#$services = array_map('str_getcsv', file('services.csv'));


$csv = array_map('str_getcsv', file("services.csv"));
array_walk($csv, function(&$a) use ($csv) {
  $a = array_combine($csv[0], $a);
});
array_shift($csv); # remove column header

$services = $csv;

#var_dump($csv);

/*
$services = array();
$services[] = array('title' => 'Liberate PDF',		'url' => "$host:28080/LiberatePDF/uploadPdf.jsp",	'users' => 'all',	'status' => 'working');

$services[] = array('title' => 'LimeSurvey',		'url' => "$host/limesurvey",		'users' => 'huwi',	'status' => 'working');

$services[] = array('title' => 'ownCloud',		'url' => "$host/owncloud",		'users' => 'fachschaft',	'status' => 'working');
$services[] = array('title' => 'Etherpad',		'url' => "$host:9001",			'users' => 'fachschaft',	'status' => 'working');
$services[] = array('title' => 'Etherpad List',		'url' => "$host:9001/list",		'users' => 'fachschaft',	'status' => 'working');
$services[] = array('title' => 'Framadate',		'url' => "$host/framadate",		'users' => 'fachschaft',	'status' => 'working');
$services[] = array('title' => 'Termine',		'url' => "$host/termine",		'users' => 'fachschaft',	'status' => 'todo');
$services[] = array('title' => 'GitLab',		'url' => "$host/gitlab",		'users' => 'fachschaft',	'status' => 'broken');
$services[] = array('title' => 'Roundcube',		'url' => "$host/roundcube",		'users' => 'fachschaft',	'status' => 'working');

$services[] = array('title' => 'phpMyAdmin',		'url' => "$host/phpmyadmin",		'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'phpLDAPadmin',		'url' => "$host/phpldapadmin",		'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'icinga (Nagios)',	'url' => "$host/icingaweb2",		'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'Etherpad Admin',	'url' => "$host:9001/admin",		'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'WildFly Admin',		'url' => "$host:9990",			'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'phpinfo',		'url' => "$host/admininfo/phpinfo.php",	'users' => 'admin',	'status' => 'working');
$services[] = array('title' => 'Tomcat 7 manager',	'url' => "$host:8007/manager/html",	'users' => 'admin',     'status' => 'working');
$services[] = array('title' => 'Tomcat 7 host-manager',	'url' => "$host:8007/host-manager/html",'users' => 'admin',     'status' => 'working');
$services[] = array('title' => 'Tomcat 8 manager',	'url' => "$host:8008/manager/html",	'users' => 'admin',     'status' => 'working');
$services[] = array('title' => 'Tomcat 8 host-manager',	'url' => "$host:8008/host-manager/html",'users' => 'admin',     'status' => 'working');
$services[] = array('title' => 'Piwik',			'url' => "$host/piwik",			'users' => 'admin',     'status' => 'working');
$services[] = array('title' => 'temporary public',	'url' => "$host/temporary-public",	'users' => 'admin',     'status' => 'working');
*/

?>
<html>
  <head>
    <title>Fachschaft Huwi Hub</title>
    <meta content="">
    <style></style>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <img id="logo" src="kHuWi.svg" style="max-width: 10%;">


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
      echo "</ul>";
    }

    echo '<div class="clear" />';
    echo "<h1>$users_titles[$users]</h1>";
    echo "<ul>\n";
  }

  echo "<li class=\"$status\"><a href=\"$url\">$title</a></li>\n";

  $last_users = $users;
}
echo "</ul>\n\n";

?>



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
