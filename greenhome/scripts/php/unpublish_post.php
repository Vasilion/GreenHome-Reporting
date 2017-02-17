<?php 

require('../../../../../../wp-load.php');

$postid = $_POST['postId'];
wp_update_post(array(
	'ID'    =>  $postid,
	'post_status'   =>  'draft'
	));

?>