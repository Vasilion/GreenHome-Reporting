<?php

// Basic sample code
include "\scripts\php\retrieve_inputs.php";

$building_id    = ''; // building id
$user_key = '651d1eebd0a945c3b5e6f93971827364'; // api key

$xml = '<'.'?xml version="1.0" encoding="UTF-8"?'.'>'."\n";
$xml .= <<<xmltext
<pageRequest>
  <validate_inputs>
    <user_key>{$user_key}</user_key>
    <building_id>{$building_id}</building_id>
  </validate_inputs>
</pageRequest>
xmltext;

submit_request($xml);

function submit_request($xml)
{
    try
    {
        $response = array();

        $input = (array)simplexml_load_string($xml);

        require_once('nusoap/nusoap.php');
        $client = new nusoap_client('http://hesapi.labworks.org/st_api/wsdl/',true,false,false,false,false,0,120,''); // use timeout 120 seconds

        $response = $client->call('validate_inputs',$input);

        echo "Response: ";

        if (($err = $client->getError()))
        {
            echo 'Error: <pre>'.$err."\n\n".htmlspecialchars($client->response, ENT_QUOTES).'</pre>';
        }else{
            echo '<pre>'.print_r($response,true).'</pre>';
        }

    }catch(Exception $e){
        echo 'Error: '.$e->getMessage();
    }
}

?>
