<?php
require('../../../../../../wp-load.php');

/*  $photoData = $_FILES['imageFile'];

  print_r($photoData);

  $upload = wp_upload_bits($photoData["name"],null,file_get_contents($photoData["tmp_name"]));

  update_post_meta(73, 'airleakphoto', $upload["url"]);

  $postMeta = get_post_meta(73);*/
  
  //$formId = $_POST['formId'];
  $formId = 73;


  //pull all photo files into array
  $photos = array(
    "airleakphoto" => $_FILES['airleakphoto']
  );

  //cycle through each key and upload the bits
  foreach ($photos as $photoKey => $photoData){
    if(isset($photoData["tmp_name"])) {
      $upload = wp_upload_bits($photoData["name"], null, file_get_contents($photoData["tmp_name"]));
      update_post_meta($formId, $photoKey, $upload["url"]);
	  //media_handle_upload( $photoData["name"], $formId );
    }
  };


  echo '<img src="' . $postMeta['airleakphoto'][0] . '" >';

?>