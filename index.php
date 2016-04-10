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
