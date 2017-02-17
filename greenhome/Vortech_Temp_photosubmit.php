<?php
/*
Template Name: Form Template - Photo
*/
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Targets movile devices to set width to screen size -->
  <title>GreenHome Inspection Form</title>
  <!-- linking to styles -->
  <link rel="stylesheet" type="text/css" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/tvt-styles.css"
  <link rel="stylesheet" type="text/css" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/tvt-bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/tvt-naved-bootstrap.min.css">
  <link rel="stylesheet" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/jquery-ui.min.css">
  <link rel="stylesheet" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/jquery-ui.structure.min.css">
  <link rel="stylesheet" type="text/css" href="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/styles/tvt-print-layout.css">
  <link rel='dns-prefetch' href='//code.jquery.com'/>

  <!--JQuery -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
          integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/scripts/javascript/jquery-ui.min.js"></script>
  <script src="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/scripts/javascript/jquery_soap.js"></script>
  <script src="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/scripts/javascript/soap-test.js"></script>

</head>
<!-- greenhome green = #0b9444 -->
<!-- greenhome blue  = #20419a -->
<body bgcolor="#CCCCCC">

<div>
  <form action="http://cis.gvsu.edu/~vortech/wp-content/themes/twentysixteen/templates/scripts/php/save_photo.php" enctype="multipart/form-data" method="post">
    <input name="airleakphoto" type="file"/>
    <input type="submit" value="Submit"/>
  </form>
</div>

</body>
</html>