<?php

function makeWebRequest()
{
  // Basic sample code
  $qa_number = 'TST-Vortech';
  //$qa_number      = getQualifiedAssessor($_POST['AssessFName'], $_POST['AssessLName']); // qualified assesor id
  $user_key = '651d1eebd0a945c3b5e6f93971827364'; // api key
  $address = $_POST['HomeAddress'];
  $city = $_POST['HomeCity'];
  $state = $_POST['HomeState']; //MI?
  $zip = $_POST['HomeZip'];


  //URL where to send the data via POST
  $url = 'https://sandbox.hesapi.labworks.org/st_api/serve';

  //the actual data
  $xml =
    <<<xmltext
  <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:submit_addressRequest>
         <ser:building_address>
            <ser:user_key>{$user_key}</ser:user_key>
            <ser:qualified_assessor_id>{$qa_number}</ser:qualified_assessor_id>
            <ser:address>{}$address</ser:address>
            <ser:city>{$city}</ser:city>
            <ser:state>{$state}</ser:state>
            <ser:zip_code>{$zip}</ser:zip_code>
            <ser:assessment_type>initial</ser:assessment_type>
         </ser:building_address>
      </ser:submit_addressRequest>
   </soapenv:Body>
</soapenv:Envelope>
xmltext;

  //prepare the HTTP Headers
  $content_type = 'application/xml';
  // use key 'http' even if you send the request to https://...
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type: ' . addslashes($content_type) . '\r\n'
        . 'Content-Length: ' . strlen($xml) . '\r\n',
      'content' => $xml,
    ),
  );
  $context = stream_context_create($options);

  //send the data using a cURL-less method
  $result = file_get_contents($url, false, $context);
  echo 'file_get_contents<br/>';
  var_dump($result);
}

function savePhotos()
{
  require('../../../../../../wp-load.php');
  $formId = $_POST['formId'];
  //$formid = 73;


  //pull all photo files into array
  $photos = array(
    "airleakphoto" => $_FILES['airleakphoto'],
    "found1photo" => $_FILES['found1photo'],
    "found2photo" => $_FILES['found2photo'],
    "roof1photo" => $_FILES['roof1photo'],
    "roof2photo" => $_FILES['roof2photo'],
    "attic1photo" => $_FILES['attic1photo'],
    "attic2photo" => $_FILES['attic2photo'],
    "wallsgenphoto" => $_FILES['wallsgenphoto'],
    "skylightphoto" => $_FILES['skylightphoto'],
    "wallsfrontphoto" => $_FILES['wallsfrontphoto'],
    "windowsfrontphoto" => $_FILES['windowsfrontphoto'],
    "wallsbackphoto" => $_FILES['wallsbackphoto'],
    "windowsbackphoto" => $_FILES['windowsbackphoto'],
    "wallsrightphoto" => $_FILES['wallsrightphoto'],
    "windowrightphoto" => $_FILES['windowrightphoto'],
    "heatingsystem1photo" => $_FILES['heatingsystem1photo'],
    "heatingsystem2photo" => $_FILES['heatingsystem2photo'],
    "coolsys1photo" => $_FILES['coolsys1photo'],
    "coolsys2photo" => $_FILES['coolsys2photo'],
    "ductsys1photo" => $_FILES['ductsys1photo'],
    "ductsys2photo" => $_FILES['ductsys2photo'],
    "ductsysotherphoto" => $_FILES['ductsysotherphoto'],
    "hotwatsysphoto" => $_FILES['hotwatsysphoto'],
    "spotbathphoto" => $_FILES['spotbathphoto'],
    "airqualphoto" => $_FILES['airqualphoto'],
    "wiringphoto" => $_FILES['wiringphoto'],
    "hoodrangephoto" => $_FILES['hoodrangephoto'],
    "watconsbathphoto" => $_FILES['watconsbathphoto']
  );

    //cycle through each key and upload the bits
  foreach ($photos as $photoKey => $photoData){
    if(isset($photoData["tmp_name"])) {
      $upload = wp_upload_bits($photoData["name"], null, file_get_contents($photoData["tmp_name"]));
      update_post_meta($formId, $photoKey, $upload["url"]);
    }
  };
}

//save photos
savePhotos();

//submit to API
makeWebRequest();

?>