<?php
 require('../../../../../wp-load.php');

 $name = $_POST['name'];
 $value = $_POST['value'];
 $id = $_POST['id'];
 
 update_post_meta($id, $name, $value);
?>