<!--
PHP script to have all php calls in one script
-->
<?php
include "\scripts\php\submit_address.php" ;
include "\scripts\php\submit_inputs.php";
include "\scripts\php\submit_hpxml_inputs.php";
include "\scripts\php\validate_inputs.php;

makeWebRequest($result);


 ?>
