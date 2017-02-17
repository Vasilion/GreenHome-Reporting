<?php
$form_id = $_GET['form_id'];
require('../../../../../wp-load.php');
$building_id = '';
$labelData = '';

function createCode($one = '', $two = '', $three = ''){
	return $one . '' . $two . '' . $three;
}
 

//function to convert yes to 1 or no to 0.
function convToBool($var){
	if($var == 'Yes'){
		return 1;
	}else if ($var == 'No'){
		return 0;
	}
}

//$building_id = getBuildingID();

$user_key = '651d1eebd0a945c3b5e6f93971827364'; // api key



 $query = get_post_meta($form_id);
  $qa_number = 'TST-Vortech';
  $address = $query['homeaddress'][0];
  $city = $query['homecity'][0];
  $state = $query['homestate'][0]; //MI
  $zip = $query['homezip'][0];



/*
Blower Door Test - Boolean 
Second Foundation - None?
Roof 2 - None?
Attic 2 - None?
All walls? - Boolean create tags dynamically if Yes
All windows? ^^^^^^^^^^^^^^^^^^^^^^^
Skylight factor? - Boolean

Heating System 2 - None?
Heating efficiency - Boolean needed?
Cooling System 2 - none?
Cooling efficiency - Boolean needed?

Duct System 2 - Boolean 
*/




 $auditDate = $query['auditdate'][0];
 $yearBuilt = $query['homeyear'][0];
 $homeBed = $query['homebed'][0];
 $homeStories = $query['homestories'][0];
 $homeAvgCeiling = $query['homeavgceiling'][0];
 $homeFloorArea = $query['homefloorarea'][0];
 $townHouse = convToBool($query['townhouse'][0]);//BOOLEAN
 $homePosUnit = $query['homeposunit'][0];
 $blowerDoorTest = convToBool($query['blowerdoortest'][0]);//BOOLEAN
 $airleakrate = $query['airleakrate'][0];
 
 
 
 $profAirSeal = convToBool($query['profairseal'][0]);
 
 
 
 
 
// //--------------------
$foundarea1 = $query['foundarea1'][0];
$foundtype1 = $query['foundtype1'][0];
$foundfloorinsul1 = $query['foundfloorinsul1'][0];
$foundwallinsul1 = $query['foundwallinsul1'][0];

$foundfloorRValue1 = substr($foundfloorinsul1,4,2);

$roofconst1 = $query['roofconst1'][0];
$roofextfin1 = $query['roofextfin1'][0];
$roofinsullev1 = $query['roofinsullev1'][0];
$roofcolor1 = $query['roofcolor1'][0];
$roofreflect1 = $query['roofreflect1'][0];
$roofarea1 = $query['roofarea1'][0];


 $roof1Code = createCode($query['roofconst1'][0], $query['roofinsullev1'][0], $query['roofextfin1'][0]);
 $roof2Code = createCode($query['roofconst2'][0], $query['roofinsullev2'][0], $query['roofextfin2'][0]);
 $wallGenCode = createCode($query['wallsconstructgen'][0], $query['wallsinsulgen'][0], $query['wallsextfingen'][0]);
 $windowsGenCode = createCode($query['windowsconstructgen'][0], $query['windowsinsulgen'][0], $query['windowsextfingen'][0]);



$attictype1 = $query['attictype1'][0];
$atticfloorinsul1 = $query['atticfloorinsul1'][0];

///--------------------

$foundarea2 = $query['foundarea2'][0];
$foundtype2 = $query['foundtype2'][0];
$foundfloorinsul2 = $query['foundfloorinsul2'][0];
$foundwallinsul2 = $query['foundwallinsul2'][0];

$foundfloorRValue2 = substr($foundfloorinsul2,4,2);

$roofconst2 = $query['roofconst2'][0];
$roofextfin2 = $query['roofextfin2'][0];
$roofinsullev2 = $query['roofinsullev2'][0];
$roofcolor2 = $query['roofcolor2'][0];
$roofreflect2 = $query['roofreflect2'][0];
$roofarea2 = $query['roofarea2'][0];

$attictype2 = $query['attictype2'][0];
$atticfloorinsul2 = $query['atticfloorinsul2'][0];
//---------------------

$wallscharacgen = convToBool($query['wallscharacgen'][0]);//boolean same wall 

$wallsconstructgen = $query['wallsconstructgen'][0];
$wallsextfingen = $query['wallsextfingen'][0];
$wallsinsulgen = $query['wallsinsulgen'][0];

$windowcharacgen = convToBool($query['windowscharacgen'][0]);//boolean same window

$windowsareafrontgen = $query['windowsareafrontgen'][0];//number
$windowsareabackgen = $query['windowsareabackgen'][0];//number
$windowsarearightgen = $query['windowsarearightgen'][0];//number
$windowsarealeftgen = $query['windowsarealeftgen'][0];//number
$windowspanesgen = $query['windowspanesgen'][0];
$windowsframegen = $query['windowsframegen'][0];
$windowsglazegen = $query['windowsglazegen'][0];
$windowsareagen1 = $query['windowsareagen1'][0];

/// or ?? 

$windowsufactgen = $query['windowsufactgen'][0];//number
$windowsshgcgen = $query['windowsshgcgen'][0];//number 
$rimbandjoistdetgen = $query['rimbandjoistdetgen'][0];
$skylighthave = convToBool($query['skylighthave'][0]);//boolean skylighthave?
$skylightarea = $query['skylightarea'][0];//number
$skylightnumpanels = $query['skylightnumpanels'][0];//number
$skylightframe = $query['skylightframe'][0];
$skylightglaze = $query['skylightglaze'][0];

// or ??

$skylightufact = $query['skylightufact'][0];
$skylightshgc = $query['skylightshgc'][0];

//front

$wallsconstructfront = $query['wallsconstructfront'][0];
$wallsextfinfront = $query['wallsextfinfront'][0];
$wallsinsulfront = $query['wallsinsulfront'][0];

$frontwallcode = createCode($wallsconstructfront, $wallsinsulfront, $wallsextfinfront);

$windowsareafront = $query['windowsareafront'][0];
$windowspanesfront = $query['windowspanesfront'][0];
$windowsframefront = $query['windowsframefront'][0];
$windowsglazefront = $query['windowsglazefront'][0];
$windowsfrontcode = createCode($windowspanesfront, $windowsglazefront,  $windowsframefront);
$windowsufactfront = $query['windowsufactfront'][0];
$windowsshgcfront = $query['windowsshgcfront'][0];
$rimbandjoistdetfront = $query['rimbandjoistdetfront'][0];


//back

$wallsconstructback = $query['wallsconstructback'][0];
$wallsextfinback = $query['wallsextfinback'][0];
$wallsinsulback = $query['wallsinsulback'][0];

$backwallcode = createCode($wallsconstructback, $wallsinsulback, $wallsextfinback);

$windowsareaback = $query['windowsareaback'][0];
$windowspanesback = $query['windowspanesback'][0];
$windowsframeback = $query['windowsframeback'][0];
$windowsglazeback = $query['windowsglazeback'][0];

$windowsbackcode = createCode($windowspanesback, $windowsglazeback, $windowsframeback);


$windowsufactback = $query['windowsufactback'][0];
$windowsshgcback = $query['windowsshgcback'][0];
$rimbandjoistdetback = $query['rimbandjoistdetback'][0];

//right 


$wallsconstructright = $query['wallsconstructright'][0];
$wallsextfinright = $query['wallsextfinright'][0];
$wallsinsulright = $query['wallsinsulright'][0];

$rightwallcode = createCode($wallsconstructright, $wallsinsulright, $wallsextfinright);

$windowsarearight = $query['windowsarearight'][0];
$windowspanesright = $query['windowspanesright'][0];
$windowsframeright = $query['windowsframeright'][0];
$windowsglazeright = $query['windowsglazeright'][0];

$windowsrightcode = createCode($windowspanesright, $windowsglazeright, $windowsframeright);

$windowsufactright = $query['windowsufactright'][0];
$windowsshgcright = $query['windowsshgcright'][0];
$rimbandjoistdetright = $query['rimbandjoistdetright'][0];

//left 

$wallsconstructleft = $query['wallsconstructleft'][0];
$wallsextfinleft = $query['wallsextfinleft'][0];
$wallsinsulleft = $query['wallsinsulleft'][0];

$leftwallcode = createCode($wallsconstructleft, $wallsinsulleft, $wallsextfinleft);

$windowsarealeft = $query['windowsarealeft'][0];
$windowspanesleft = $query['windowspanesleft'][0];
$windowsframeleft = $query['windowsframeleft'][0];
$windowsglazeleft = $query['windowsglazeleft'][0];

$windowsleftcode = createCode($windowspanesleft,$windowsglazeleft ,$windowsframeleft);

$windowsufactleft = $query['windowsufactleft'][0];
$windowsshgcleft = $query['windowsshgcleft'][0];
$rimbandjoistdetleft = $query['rimbandjoistdetleft'][0];

//heating (system 1)
$heatsystype1 = $query['heatsystype1'][0];
$heatfueltype1 = explode(":", $heatsystype1)[1];
$heatsystype1 = explode(":", $query['heatsystype1'][0])[0];
$heatsyseffic1 = convToBool($query['heatsyseffic?1'][0]);//boolean heatsyseffic?1
$heatsysefficval1 = $query['heatsysefficval1'][0];
$heatsysyearinst1 = $query['heatsysyearinst1'][0];

//heating (system 2)
$heatsystype2 = $query['heatsystype2'][0];
$heatfueltype2 = explode(":", $heatsystype2)[1];
$heatsystype2 = explode(":", $query['heatsystype2'][0])[0];
$heatsyseffic2 = $query['heatsyseffic?2'][0];//boolean heatsyseffic?2
$heatsysefficval2 = $query['heatsysefficval2'][0];
$heatsysyearinst2 = $query['heatsysyearinst2'][0];


//cooling (system 1)
$coolsystype1 = $query['coolsystype1'][0];
$coolsyseffic1 = $query['coolsyseffic?1'][0];//boolean coolsyseffic?1
$coolsysefficval1 = $query['coolsysefficval1'][0];
$coolsysyearinst1 = $query['coolsysyearinst1'][0];


//cooling (system 2)
$coolsystype2 = $query['coolsystype2'][0];
$coolsyseffic2 = $query['coolsyseffic?2'][0];//boolean coolsyseffic?2
$coolsysefficval2 = $query['coolsysefficval2'][0];
$coolsysyearinst2 = $query['coolsysyearinst2'][0];


//Duct (System 1) All underscores (_) are actually periods in the name. 


$duct1have = convToBool($query['duct1have'][0] );

$ductSysLoc1_1 = $query['ductsysloc1_1'][0];
$ductSysPerc1_1 = $query['ductsysperc1_1'][0];
$ductSysSeal1_1 = convToBool($query['ductsysseal1_1'][0]);//Boolean
$ductSysInsul1_1 = convToBool($query['ductsysinsul1_1'][0]);//Boolean

$ductSysLoc1_2 = $query['ductsysloc1_2'][0];
$ductSysPerc1_2 = $query['ductsysperc1_2'][0];
$ductSysSeal1_2 = convToBool($query['ductsysseal1_2'][0]);//Boolean
$ductSysInsul1_2 = convToBool($query['ductsysinsul1_2'][0]);//Boolean

$ductSysLoc1_3 = $query['ductsysloc1_3'][0];
$ductSysPerc1_3 = $query['ductsysperc1_3'][0];
$ductSysSeal1_3 = convToBool($query['ductsysseal1_3'][0]);//Boolean
$ductSysInsul1_3 = convToBool($query['ductsysinsul1_3'][0]);//Boolean

//Duct (System 2) All underscores (_) are actually periods in the name. 
$ductSysLoc2_1 = $query['ductsysloc2_1'][0];
$ductSysPerc2_1 = $query['ductsysperc2_1'][0];
$ductSysSeal2_1 = convToBool($query['ductsysseal2_1'][0]);//Boolean
$ductSysInsul2_1 = convToBool($query['ductsysinsul2_1'][0]);//Boolean

$ductSysLoc2_2 = $query['ductsysloc2_2'][0];
$ductSysPerc2_2 = $query['ductsysperc2_2'][0];
$ductSysSeal2_2 = convToBool($query['ductsysseal2_2'][0]);//Boolean
$ductSysInsul2_2 = convToBool($query['ductsysinsul2_2'][0]);//Boolean

$ductSysLoc2_3 = $query['ductsysloc2_3'][0];
$ductSysPerc2_3 = $query['ductsysperc2_3'][0];
$ductSysSeal2_3 = convToBool($query['ductsysseal2_3'][0]);//Boolean
$ductSysInsul2_3 = convToBool($query['ductsysinsul2_3'][0]);//Boolean


$split  = explode(":", $query['waterheattype'][0] );
$waterHeatType = $split[0];
$waterheatenergy_1 = $split[1];
$hotWaterEFactor = $query['hotwaterefactor'][0];


$building_id    = '';



$about = "
		 <ser:assessment_date>{$auditDate}</ser:assessment_date>
         <ser:comments>test</ser:comments>
         <ser:shape>rectangle</ser:shape>
         <ser:year_built>{$yearBuilt}</ser:year_built>
         <ser:number_bedrooms>{$homeBed}</ser:number_bedrooms>
         <ser:num_floor_above_grade>{$homeStories}</ser:num_floor_above_grade>
         <ser:floor_to_ceiling_height>{$homeAvgCeiling}</ser:floor_to_ceiling_height>
         <ser:conditioned_floor_area>{$homeFloorArea}</ser:conditioned_floor_area>
         <ser:orientation>north</ser:orientation>
         <ser:blower_door_test>{$blowerDoorTest}</ser:blower_door_test>
         <ser:air_sealing_present>{$profAirSeal}</ser:air_sealing_present> 
";
		 
		 
$roof2 = '';
$skylight ='';
$found1 = '';
$found2 = '';
$hvac1 = '';
$duct1 = '';
$hvac2 = '';
$duct2 = '';




$xmlToSubmitAddress =
    <<<xmltext
  <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:submit_addressRequest>
         <ser:building_address>
            <ser:user_key>{$user_key}</ser:user_key>
            <ser:qualified_assessor_id>{$qa_number}</ser:qualified_assessor_id>
            <ser:address>{$address}</ser:address>
            <ser:city>{$city}</ser:city>
            <ser:state>{$state}</ser:state>
            <ser:zip_code>{$zip}</ser:zip_code>
            <ser:assessment_type>initial</ser:assessment_type>
         </ser:building_address>
      </ser:submit_addressRequest>
   </soapenv:Body>
</soapenv:Envelope>
xmltext;



$building_id = getBuildingID($xmlToSubmitAddress);


if($blowerDoorTest == 1) {
	//Remove airleak rate from XML.
	$about .= 
"
	<ser:envelope_leakage>{$airleakrate}</ser:envelope_leakage>
";
}

if($roofconst1 != "None"){
	$ceilingcode1 = 'ecwf19';
		$roof1 ="
			<ser:zone_roof>
            <ser:roof_name>roof1</ser:roof_name>
            <ser:roof_area>{$roofarea1}</ser:roof_area>
            <ser:roof_assembly_code>{$roof1Code}</ser:roof_assembly_code>
			<ser:roof_color>{$roofcolor1}</ser:roof_color>
            <ser:roof_type>{$attictype1}</ser:roof_type>
			<ser:ceiling_assembly_code>{$ceilingcode1}</ser:ceiling_assembly_code>
				{$skylight}
         </ser:zone_roof>
";
	
	


		 if($roofconst2 != "None"){
	$ceilingcode2 = 'ecwf19';
	$roof2 = "
			<ser:zone_roof>
            <ser:roof_name>roof2</ser:roof_name>
            <ser:roof_area>{$roofarea2}</ser:roof_area>
            <ser:roof_assembly_code>{$roof2Code}</ser:roof_assembly_code>
            <ser:roof_color>{$roofcolor2}</ser:roof_color>
            <ser:roof_type>{$attictype2}</ser:roof_type>
			<ser:ceiling_assembly_code>{$ceilingcode2}</ser:ceiling_assembly_code>
			{$skylight}
			</ser:zone_roof>";
		 }else {
			 $roof2 = "";
		 }
}

if($skylighthave == 1){
	$skylight = "
			<ser:zone_skylight>
               <ser:skylight_area>{$skyLightArea}</ser:skylight_area>
               <ser:skylight_method>user</ser:skylight_method>
			<ser:skylight_code>{$skyLightCode1}</ser:skylight_code>
            </ser:zone_skylight>
";
}


if($foundtype1 != "None"){
	$foundins1 = substr($foundfloorinsul1, 4,2);
		$foundins2 = substr($foundfloorinsul2, 4,2);
$found1 = "<ser:zone_floor>
            <ser:floor_name>floor1</ser:floor_name>
            <ser:floor_area>{$foundarea1}</ser:floor_area>
            <ser:foundation_type>{$foundtype1}</ser:foundation_type>
            <ser:foundation_insulation_level>00</ser:foundation_insulation_level>
			<ser:floor_assembly_code>{$foundfloorinsul1}</ser:floor_assembly_code>
         </ser:zone_floor>";
		 
		 if($foundtype2 != "None"){
			 $found2 = "<ser:zone_floor>
            <ser:floor_name>floor2</ser:floor_name>
            <ser:floor_area>{$foundarea2}</ser:floor_area>
            <ser:foundation_type>{$foundtype2}</ser:foundation_type>
            <ser:foundation_insulation_level>00</ser:foundation_insulation_level>
            <ser:floor_assembly_code>{$foundfloorinsul2}</ser:floor_assembly_code>
         </ser:zone_floor>";
		 }
		 
}

if($heatsystype2 != "None"){
	$heatfraction1 = '.50';
	$heatfraction2 = '.50';
}else {
	$heatfraction1 = '1.00';
}



if($heatsystype1 != "None"){		

 
		 if($coolsystype1 != "None"){
			 $cooltype1 = "<ser:cooling>
               <ser:type>{$coolsystype1}</ser:type>
               <ser:efficiency_method>user</ser:efficiency_method>
               <ser:efficiency>{$coolsysefficval1}</ser:efficiency>
			   <ser:year>1985</ser:year>
            </ser:cooling>";
		 }
		 
		 if($duct1have != "None"){
			 $duct1 = "<ser:hvac_distribution>
               <ser:name>duct1</ser:name>
               <ser:location>{$ductSysLoc1_1}</ser:location>
               <ser:fraction>{$ductSysPerc1_1}</ser:fraction>
               <ser:insulated>{$ductSysInsul1_1}</ser:insulated>
               <ser:sealed>{$ductSysSeal1_1}</ser:sealed>
            </ser:hvac_distribution>
            <ser:hvac_distribution>
               <ser:name>duct2</ser:name>
               <ser:location>{$ductSysLoc1_2}</ser:location>
               <ser:fraction>{$ductSysPerc1_2}</ser:fraction>
               <ser:insulated>{$ductSysInsul1_2}</ser:insulated>
               <ser:sealed>{$ductSysSeal1_2}</ser:sealed>
            </ser:hvac_distribution>
			<ser:hvac_distribution>
               <ser:name>duct3</ser:name>
               <ser:location>{$ductSysLoc1_3}</ser:location>
               <ser:fraction>{$ductSysPerc1_3}</ser:fraction>
               <ser:insulated>{$ductSysInsul1_3}</ser:insulated>
               <ser:sealed>{$ductSysSeal1_3}</ser:sealed>
            </ser:hvac_distribution>";
		 }

		 	$hvac1 = "<ser:hvac>
            <ser:hvac_name>hvac1</ser:hvac_name>
            <ser:hvac_fraction>{$heatfraction1}</ser:hvac_fraction>
            <ser:heating>
               <ser:type>{$heatsystype1}</ser:type>
               <ser:fuel_primary>{$heatfueltype1}</ser:fuel_primary>
               <ser:efficiency_method>user</ser:efficiency_method>
               <ser:efficiency>{$heatsysefficval1}</ser:efficiency>
            </ser:heating>
			{$cooltype1}
				{$duct1}
         </ser:hvac>";	 
}

if($heatsystype2 != "None") {

	
	if($coolsystype2 != "None"){
		$cooltype2 = "<ser:cooling>
               <ser:type>{$coolsystype2}</ser:type>
               <ser:efficiency_method>shipment_weighted</ser:efficiency_method>
			   <ser:efficiency>{$coolsysefficval2}</ser:efficiency>
               <ser:year>1985</ser:year>
            </ser:cooling>";
	}
	if($duct2have != "None") {
		$duct2 = "<ser:hvac_distribution>
               <ser:name>duct1</ser:name>
               <ser:location>{$ductSysLoc2_1}</ser:location>
               <ser:fraction>{$ductSysPerc2_1}</ser:fraction>
               <ser:insulated>{$ductSysInsul2_1}</ser:insulated>
               <ser:sealed>{$ductSysSeal2_1}</ser:sealed>
            </ser:hvac_distribution>
            <ser:hvac_distribution>
               <ser:name>duct2</ser:name>
               <ser:location>{$ductSysLoc2_2}</ser:location>
               <ser:fraction>{$ductSysPerc2_2}</ser:fraction>
               <ser:insulated>{$ductSysInsul2_2}</ser:insulated>
               <ser:sealed>{$ductSysSeal2_2}</ser:sealed>
            </ser:hvac_distribution>
            <ser:hvac_distribution>
               <ser:name>duct3</ser:name>
               <ser:location>{$ductSysLoc2_3}</ser:location>
               <ser:fraction>{$ductSysPerc2_3}</ser:fraction>
               <ser:insulated>{$ductSysInsul2_3}</ser:insulated>
               <ser:sealed>{$ductSysSeal2_3}</ser:sealed>
            </ser:hvac_distribution>";
		
		
	}
	
	
	$hvac2 = "<ser:hvac>
            <ser:hvac_name>hvac2</ser:hvac_name>
            <ser:hvac_fraction>{$heatfraction2}</ser:hvac_fraction>
            <ser:heating>
               <ser:type>{$heatsystype2}</ser:type>
               <ser:fuel_primary>{$heatfueltype2}</ser:fuel_primary>
               <ser:efficiency_method>user</ser:efficiency_method>
               <ser:efficiency>{$heatsysefficval2}</ser:efficiency>
            </ser:heating>
			{$cooltype2}
				{$duct2}
         </ser:hvac>";		
}




/* 

	  */
	  
	  /*Ending 

	  */
	 
	 if($windowcharacgen == 1 ){
		 /*
		 $windowspanesgen = $query['windowspanesgen'][0];
$windowsframegen = $query['windowsframegen'][0];
$windowsglazegen = $query['windowsglazegen'][0];
$windowsareagen1 = $query['windowsareagen1][0];
$windowsleftcode = createCode($windowspanesleft,$windowsglazeleft ,$windowsframeleft);
*/


$windowgencode = createCode($windowspanesgen, $windowsglazegen, $windowsframegen);


		$windowsareafront = $windowsareagen1;
		$windowsareaback = $windowsareagen1;
		$windowsarealeft = $windowsareagen1;
		$windowsarearight = $windowsareagen1;
		
		$windowsfrontcode = $windowgencode;
	    $windowsbackcode = $windowgencode;
		$windowsleftcode = $windowgencode;
		$windowsrightcode = $windowgencode;
	 }
	 
	 if($wallscharacgen == 1 ){
		 $wallgencode = createCode($query['wallsconstructgen'][0], $query['wallsinsulgen'][0], $query['wallsextfingen'][0]);
		 
		 $frontwallcode = $wallgencode;
		 $backwallcode = $wallgencode;
		 $leftwallcode = $wallgencode;
		 $rightwallcode = $wallgencode;
		 
		 
		 
	 }
	 
	 

$xml .= <<<xmltext
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
   <soapenv:Header/>
   <soapenv:Body>
<ser:submit_inputsRequest>
   <ser:building>
      <ser:user_key>{$user_key}</ser:user_key>
      <ser:building_id>{$building_id}</ser:building_id>
      <ser:about>
	  {$about}
      </ser:about>
      <ser:zone>
         <ser:wall_construction_same>{$wallscharacgen}</ser:wall_construction_same>
         <ser:window_construction_same>{$windowcharacgen}</ser:window_construction_same>
			 {$roof1}
		 {$roof2}
			 {$found1}
				 {$found2}
         <ser:zone_wall>
            <ser:side>front</ser:side>
            <ser:wall_assembly_code>{$frontwallcode}</ser:wall_assembly_code>
            <ser:zone_window>
               <ser:window_area>{$windowsareafront}</ser:window_area>
               <ser:window_method>code</ser:window_method>
               <ser:window_code>{$windowsfrontcode}</ser:window_code>
            </ser:zone_window>
         </ser:zone_wall>
         <ser:zone_wall>
            <ser:side>back</ser:side>
            <ser:wall_assembly_code>{$backwallcode}</ser:wall_assembly_code>
            <ser:zone_window>
               <ser:window_area>{$windowsareaback}</ser:window_area>
               <ser:window_method>custom</ser:window_method>
               <ser:window_u_value>{$windowsufactback}</ser:window_u_value>
               <ser:window_shgc>{$windowsshgcback}</ser:window_shgc>
            </ser:zone_window>
         </ser:zone_wall>
         <ser:zone_wall>
            <ser:side>right</ser:side>
            <ser:wall_assembly_code>{$rightwallcode}</ser:wall_assembly_code>
            <ser:zone_window>
               <ser:window_area>{$windowsarearight}</ser:window_area>
               <ser:window_method>code</ser:window_method>
               <ser:window_code>{$windowsrightcode}</ser:window_code>
            </ser:zone_window>
         </ser:zone_wall>
         <ser:zone_wall>
            <ser:side>left</ser:side>
            <ser:wall_assembly_code>{$leftwallcode}</ser:wall_assembly_code>
            <ser:zone_window>
               <ser:window_area>{$windowsarealeft}</ser:window_area>
               <ser:window_method>code</ser:window_method>
               <ser:window_code>{$windowsleftcode}</ser:window_code>
            </ser:zone_window>
         </ser:zone_wall>
      </ser:zone>
      <ser:systems>
	  {$hvac1}
		  {$hvac2}
         <ser:domestic_hot_water>
            <ser:category>unit</ser:category>
            <ser:type>{$waterHeatType}</ser:type>
            <ser:fuel_primary>{$waterheatenergy_1}</ser:fuel_primary>
            <ser:efficiency_method>user</ser:efficiency_method>
            <ser:energy_factor>{$hotWaterEFactor}</ser:energy_factor>
         </ser:domestic_hot_water>
      </ser:systems>
   </ser:building>
   
   	  </ser:submit_inputsRequest>
   </soapenv:Body>
</soapenv:Envelope>
   
   
xmltext;


$xmlToCalcBaseBuilding = 
<<<xmltext
<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
    <x:Header/>
    <x:Body>
        <ser:calculate_base_buildingRequest>
            <ser:building_info>
                <ser:user_key>{$user_key}</ser:user_key>
                <ser:building_id>{$building_id}</ser:building_id>
                <ser:validate_inputs>false</ser:validate_inputs>
                <ser:is_polling>false</ser:is_polling>
            </ser:building_info>
        </ser:calculate_base_buildingRequest>
    </x:Body>
</x:Envelope>
xmltext;
//submit_request($xmlToCalcBaseBuilding);

//Commit results XML that will get us everything we need to generate report. (Does not include the PDF that we may or may not use).

$xmlToCommitResults = 
<<<xmltext
<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
    <x:Header/>
    <x:Body>
        <ser:commit_resultsRequest>
            <ser:building_info>
                <ser:user_key>{$user_key}</ser:user_key>
                <ser:building_id>{$building_id}</ser:building_id>
                <ser:validate_inputs>false</ser:validate_inputs>
                <ser:is_polling>false</ser:is_polling>
            </ser:building_info>
        </ser:commit_resultsRequest>
    </x:Body>
</x:Envelope>
xmltext;

$xmlToCalcBasePackage = 
<<<xmltext
<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
    <x:Header/>
    <x:Body>
        <ser:calculate_package_buildingRequest>
            <ser:building_info>
                <ser:user_key>{$user_key}</ser:user_key>
                <ser:building_id>{$building_id}</ser:building_id>
                <ser:validate_inputs>false</ser:validate_inputs>
                <ser:is_polling>false</ser:is_polling>
            </ser:building_info>
        </ser:calculate_package_buildingRequest>
    </x:Body>
</x:Envelope>
xmltext;

$xmlToGenerateLabel =
<<<xmltext
<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://hesapi.labworks.org/st_api/serve">
    <x:Header/>
    <x:Body>
        <ser:generate_labelRequest>
            <ser:building_label>
                <ser:user_key>{$user_key}</ser:user_key>
                <ser:building_id>{$building_id}</ser:building_id>
                <ser:is_final>false</ser:is_final>
                <ser:is_polling>false</ser:is_polling>
            </ser:building_label>
        </ser:generate_labelRequest>
    </x:Body>
</x:Envelope>
xmltext;






onSubmitClick($xml, $xmlToCalcBaseBuilding, $xmlToCommitResults, $xmlToCalcBasePackage, $xmlToGenerateLabel, $labelData);

	
	function getLinks($res) {

	$se = explode('<ns1:url>', $res);

	$arr = array();
	
	foreach($se as $s ){
		$url = strip_tags($s);
		if(strpos($url, '-1.pngpng') != false ){
			$arr["PNG"] = $url;
			update_post_meta($form_id, 'reportpng', str_replace('.pngpng', '.png', $arr["PNG"]));
		}
		if(strpos($url, '.pdfpng') != false){
						$arr["PDF"] = $url;
						update_post_meta($form_id, 'reportpdf', str_replace('.pdfpng', '.pdf', $arr["PDF"]) );
		}
	}
	return $arr;
	}


function SubmitButton() {
	
function onSubmitClick( $submit_inputs, $calcBB, $commit, $calcBP, $genLabel, $labelData) {
	$response = submit_request($submit_inputs);
	$response = submit_request($calcBB);
	$response = submit_request($commit);
	$response = submit_request($calcBP);
	$response = submit_request($genLabel,true); 
	
	$res = getLinks($response);
	//$response now contains both the PNG and PDF.
}	
	
	
}

function getBuildingID($address) {
	//code to get building id based on the address entered.
	
if(isset($building_id)) {
	return $building_id;
}else {
	
	$xmlForSubmit = submit_request($address);
explode('<ns1:message>', $xmlForSubmit) ;

$arr = explode(" ", $xmlForSubmit);
$building_id = explode("<ns1:building_id>", $xmlForSubmit);
$building_id = substr($building_id[1], 0 ,6);

return $building_id;

}
}	

	
	
function submit_request($xml, $isLabel = false)
{
	//$url = 'http://requestb.in/1mvc2wt1';
	  $url = 'https://sandbox.hesapi.labworks.org/st_api/serve';
        //$xml = (array)simplexml_load_string($xml);
  $content_type = 'application/xml';
  // use key 'http' even if you send the request to https://...
  $options = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => 'Content-type: ' . addslashes($content_type) .'\r\n'
        . 'Content-Length: ' . strlen($xml) . '\r\n',
      'content' => $xml,
    ),
  );
  $context  = stream_context_create($options);

  //send the data using a cURL-less method
  $result = file_get_contents($url, false, $context);

	return $result;
}





?>