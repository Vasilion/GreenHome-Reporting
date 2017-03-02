<?php
/*
Template Name: Report Template 1.0

Last edited by Noah Taher from NeSL on 2/4/2017
*/

if ( file_exists( "/wp-load.php" ) ) {
	require( '/wp-load.php' );
}

//get the Form ID from "Generate Report" button witin HTML form
$form_id = $_GET['form_id'];



/*	   NeSL  		*/
/*							*/
/* Photo Upload */
/*							*/
/*							*/

//pull all photo files into array
$photos = array(
	"airleakphoto"        => $_FILES['AirLeakPhoto'],
	"found1photo"         => $_FILES['Found1Photo'],
	"found2photo"         => $_FILES['Found2Photo'],
	"roof1photo"          => $_FILES['Roof1Photo'],
	"roof2photo"          => $_FILES['Roof2Photo'],
	"attic1photo"         => $_FILES['Attic1Photo'],
	"attic2photo"         => $_FILES['Attic2Photo'],
	"wallsphoto1"         => $_FILES['WallsPhoto1'],
	"windowsgenphoto"     => $_FILES['WindowsGenPhoto'],
	"skylightphoto"       => $_FILES['SkylightPhoto'],
	"wallsphoto2"         => $_FILES['WallsPhoto2'],
	"windowsfrontphoto"   => $_FILES['WindowsFrontPhoto'],
	"wallsphoto3"         => $_FILES['WallsPhoto3'],
	"windowsbackphoto"    => $_FILES['WindowsBackPhoto'],
	"wallsphoto4"         => $_FILES['WallsPhoto4'],
	"windowrightphoto"    => $_FILES['WindowsRightPhoto'],
	"windowsleftphoto"    => $_FILES['WindowsLeftPhoto'],
	"heatingsystem1photo" => $_FILES['HeatingSystem1Photo'],
	"heatingsystem2photo" => $_FILES['HeatingSystem2Photo'],
	"coolsys1photo"       => $_FILES['CoolSys1Photo'],
	"coolsys2photo"       => $_FILES['CoolSys2Photo'],
	"ductsys1photo"       => $_FILES['DuctSys1Photo'],
	"ductsys2photo"       => $_FILES['DuctSys2Photo'],
	"ductsysotherphoto"   => $_FILES['DuctSysOtherPhoto'],
	"hotwatsysphoto"      => $_FILES['HotWatSysPhoto'],
	"spotbathphoto"       => $_FILES['SpotBathPhoto'],
	"airqualphoto"        => $_FILES['AirQualPhoto'],
	"wiringphoto"         => $_FILES['WiringPhoto'],
	"hoodrangephoto"      => $_FILES['HoodrangePhoto'],
	"watconsbathphoto"    => $_FILES['WatConsBathPhoto']
);

//cycle through each key and upload the bits
foreach ( $photos as $photoKey => $photoData ) {
	if ( isset( $photoData["tmp_name"] ) ) {
		$upload = wp_upload_bits( $photoData["name"], null, file_get_contents( $photoData["tmp_name"] ) );
		update_post_meta( $form_id, $photoKey, $upload["url"] );
	}
};
?>

<?php



/*	   NeSL  		*/
/*							*/
/*  API Upload  */
/*							*/
/*							*/

$formFlag = false;
if ( isset( $_POST['form_id'] ) && strpos($_POST['audittype'], "Home" ) == FALSE) {
	$formFlag = true;
} else {
	$formFlag = false;
}

//Instantiate the Building ID and Label Data
$building_id = '';
$labelData   = '';

/**
 * Combine status codes for various componenets
 * @param string $one
 * @param string $two
 * @param string $three
 *
 * @return string Concatenated response
 */
function createCode( $one = '', $two = '', $three = '' ) {
	return $one . '' . $two . '' . $three;
}

/**
 * Convert 1 to YES, 2 to NO
 * @param $var
 *
 * @return int
 */
function convToBool( $var ) {
	if ( $var == 'Yes' ) {
		return 1;
	} else if ( $var == 'No' ) {
		return 0;
	}
}

//$building_id = getBuildingID();
$user_key = '651d1eebd0a945c3b5e6f93971827364'; // test api key



/*	   NeSL  		*/
/*							*/
/*  Main  Info  */
/*							*/
/*							*/

$query     = get_post_meta( $form_id );
$qa_number = 'TST-Vortech';
$address   = $query['homeaddress'][0];
$city      = $query['homecity'][0];
$state     = $query['homestate'][0]; //MI
$zip       = $query['homezip'][0];



/*	   NeSL  		*/
/*							*/
/*     All      */
/* 	Variables		*/
/*							*/

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

// GENERAL STATS OF BUiLDING
$auditDate      = $query['auditdate'][0];
$yearBuilt      = $query['homeyear'][0];
$homeBed        = $query['homebed'][0];
$homeStories    = $query['homestories'][0];
$homeAvgCeiling = $query['homeavgceiling'][0];
$homeFloorArea  = $query['homefloorarea'][0];
$townHouse      = convToBool( $query['townhouse'][0] );//BOOLEAN
$homePosUnit    = $query['homeposunit'][0];
$blowerDoorTest = convToBool( $query['blowerdoortest'][0] );//BOOLEAN
$airleakrate    = $query['airleakrate'][0];

$profAirSeal = convToBool( $query['profairseal'][0] );


// FOUNDATION 1
$foundarea1       = $query['foundarea1'][0];
$foundtype1       = $query['foundtype1'][0];
$foundfloorinsul1 = $query['foundfloorinsul1'][0];
$foundwallinsul1  = $query['foundwallinsul1'][0];

$foundfloorRValue1 = substr( $foundfloorinsul1, 4, 2 );


// ROOF 1
$roofconst1    = $query['roofconst1'][0];
$roofextfin1   = $query['roofextfin1'][0];
$roofinsullev1 = $query['roofinsullev1'][0];
$roofcolor1    = $query['roofcolor1'][0];
$roofreflect1  = $query['roofreflect1'][0];
$roofarea1     = $query['roofarea1'][0];

$roof1Code      = createCode( $query['roofconst1'][0], $query['roofinsullev1'][0], $query['roofextfin1'][0] );
$roof2Code      = createCode( $query['roofconst2'][0], $query['roofinsullev2'][0], $query['roofextfin2'][0] );
$wallGenCode    = createCode( $query['wallsconstructgen'][0], $query['wallsinsulgen'][0], $query['wallsextfingen'][0] );
$windowsGenCode = createCode( $query['windowsconstructgen'][0], $query['windowsinsulgen'][0], $query['windowsextfingen'][0] );


// ATTIC 1
$attictype1       = $query['attictype1'][0];
$atticfloorinsul1 = $query['atticfloorinsul1'][0];


// FOUNDATION 2
$foundarea2       = $query['foundarea2'][0];
$foundtype2       = $query['foundtype2'][0];
$foundfloorinsul2 = $query['foundfloorinsul2'][0];
$foundwallinsul2  = $query['foundwallinsul2'][0];

$foundfloorRValue2 = substr( $foundfloorinsul2, 4, 2 );


// ROOF 2
$roofconst2    = $query['roofconst2'][0];
$roofextfin2   = $query['roofextfin2'][0];
$roofinsullev2 = $query['roofinsullev2'][0];
$roofcolor2    = $query['roofcolor2'][0];
$roofreflect2  = $query['roofreflect2'][0];
$roofarea2     = $query['roofarea2'][0];

$attictype2       = $query['attictype2'][0];
$atticfloorinsul2 = $query['atticfloorinsul2'][0];



// WALLS
$wallscharacgen = convToBool( $query['wallscharacgen'][0] );//boolean same wall

$wallsconstructgen = $query['wallsconstructgen'][0];
$wallsextfingen    = $query['wallsextfingen'][0];
$wallsinsulgen     = $query['wallsinsulgen'][0];


// WINDOWS
$windowcharacgen = convToBool( $query['windowscharacgen'][0] );//boolean same window

$windowsareafrontgen = $query['windowsareafrontgen'][0];//number
$windowsareabackgen  = $query['windowsareabackgen'][0];//number
$windowsarearightgen = $query['windowsarearightgen'][0];//number
$windowsarealeftgen  = $query['windowsarealeftgen'][0];//number
$windowspanesgen     = $query['windowspanesgen'][0];
$windowsframegen     = $query['windowsframegen'][0];
$windowsglazegen     = $query['windowsglazegen'][0];
$windowsareagen1     = $query['windowsareagen1'][0];

$windowsufactgen    = $query['windowsufactgen'][0];//number
$windowsshgcgen     = $query['windowsshgcgen'][0];//number
$rimbandjoistdetgen = $query['rimbandjoistdetgen'][0];


// SKYLIGHT
$skylighthave       = convToBool( $query['skylighthave'][0] );//boolean skylighthave?
$skylightarea       = $query['skylightarea'][0];//number
$skylightnumpanels  = $query['skylightnumpanels'][0];//number
$skylightframe      = $query['skylightframe'][0];
$skylightglaze      = $query['skylightglaze'][0];

$skylightufact = $query['skylightufact'][0];
$skylightshgc  = $query['skylightshgc'][0];


// WALLS and WINDOWS FRONT
$wallsconstructfront = $query['wallsconstructfront'][0];
$wallsextfinfront    = $query['wallsextfinfront'][0];
$wallsinsulfront     = $query['wallsinsulfront'][0];

$frontwallcode = createCode( $wallsconstructfront, $wallsinsulfront, $wallsextfinfront );

$windowsareafront     = $query['windowsareafront'][0];
$windowspanesfront    = $query['windowspanesfront'][0];
$windowsframefront    = $query['windowsframefront'][0];
$windowsglazefront    = $query['windowsglazefront'][0];
$windowsfrontcode     = createCode( $windowspanesfront, $windowsglazefront, $windowsframefront );
$windowsufactfront    = $query['windowsufactfront'][0];
$windowsshgcfront     = $query['windowsshgcfront'][0];
$rimbandjoistdetfront = $query['rimbandjoistdetfront'][0];


// WALLS and WINDOWS BACK
$wallsconstructback = $query['wallsconstructback'][0];
$wallsextfinback    = $query['wallsextfinback'][0];
$wallsinsulback     = $query['wallsinsulback'][0];

$backwallcode = createCode( $wallsconstructback, $wallsinsulback, $wallsextfinback );

$windowsareaback  = $query['windowsareaback'][0];
$windowspanesback = $query['windowspanesback'][0];
$windowsframeback = $query['windowsframeback'][0];
$windowsglazeback = $query['windowsglazeback'][0];

$windowsbackcode = createCode( $windowspanesback, $windowsglazeback, $windowsframeback );

$windowsufactback    = $query['windowsufactback'][0];
$windowsshgcback     = $query['windowsshgcback'][0];
$rimbandjoistdetback = $query['rimbandjoistdetback'][0];


// WALLS and WINDOWS RIGHT
$wallsconstructright = $query['wallsconstructright'][0];
$wallsextfinright    = $query['wallsextfinright'][0];
$wallsinsulright     = $query['wallsinsulright'][0];

$rightwallcode = createCode( $wallsconstructright, $wallsinsulright, $wallsextfinright );

$windowsarearight  = $query['windowsarearight'][0];
$windowspanesright = $query['windowspanesright'][0];
$windowsframeright = $query['windowsframeright'][0];
$windowsglazeright = $query['windowsglazeright'][0];

$windowsrightcode = createCode( $windowspanesright, $windowsglazeright, $windowsframeright );

$windowsufactright    = $query['windowsufactright'][0];
$windowsshgcright     = $query['windowsshgcright'][0];
$rimbandjoistdetright = $query['rimbandjoistdetright'][0];


// WALLS and WINDOWS LEFT
$wallsconstructleft = $query['wallsconstructleft'][0];
$wallsextfinleft    = $query['wallsextfinleft'][0];
$wallsinsulleft     = $query['wallsinsulleft'][0];

$leftwallcode = createCode( $wallsconstructleft, $wallsinsulleft, $wallsextfinleft );

$windowsarealeft  = $query['windowsarealeft'][0];
$windowspanesleft = $query['windowspanesleft'][0];
$windowsframeleft = $query['windowsframeleft'][0];
$windowsglazeleft = $query['windowsglazeleft'][0];

$windowsleftcode = createCode( $windowspanesleft, $windowsglazeleft, $windowsframeleft );

$windowsufactleft    = $query['windowsufactleft'][0];
$windowsshgcleft     = $query['windowsshgcleft'][0];
$rimbandjoistdetleft = $query['rimbandjoistdetleft'][0];


// HEATING (system 1)
$heatsystype1     = $query['heatsystype1'][0];
$heatfueltype1    = explode( ":", $heatsystype1 )[1];
$heatsystype1     = explode( ":", $query['heatsystype1'][0] )[0];
$heatsyseffic1    = convToBool( $query['heatsyseffic?1'][0] );//boolean heatsyseffic?1
$heatsysefficval1 = $query['heatsysefficval1'][0];
$heatsysyearinst1 = $query['heatsysyearinst1'][0];

// HEATING (system 2)
$heatsystype2     = $query['heatsystype2'][0];
$heatfueltype2    = explode( ":", $heatsystype2 )[1];
$heatsystype2     = explode( ":", $query['heatsystype2'][0] )[0];
$heatsyseffic2    = $query['heatsyseffic?2'][0];//boolean heatsyseffic?2
$heatsysefficval2 = $query['heatsysefficval2'][0];
$heatsysyearinst2 = $query['heatsysyearinst2'][0];


// HEATING (system 1)
$coolsystype1     = $query['coolsystype1'][0];
$coolsyseffic1    = $query['coolsyseffic?1'][0];//boolean coolsyseffic?1
$coolsysefficval1 = $query['coolsysefficval1'][0];
$coolsysyearinst1 = $query['coolsysyearinst1'][0];


// HEATING (system 2)
$coolsystype2     = $query['coolsystype2'][0];
$coolsyseffic2    = $query['coolsyseffic?2'][0];//boolean coolsyseffic?2
$coolsysefficval2 = $query['coolsysefficval2'][0];
$coolsysyearinst2 = $query['coolsysyearinst2'][0];

// DUCT (System 1) All underscores (_) are actually periods in the name.
$duct1have = convToBool( $query['duct1have'][0] );

$ductSysLoc1_1   = $query['ductsysloc1_1'][0];
$ductSysPerc1_1  = $query['ductsysperc1_1'][0];
$ductSysSeal1_1  = convToBool( $query['ductsysseal1_1'][0] );//Boolean
$ductSysInsul1_1 = convToBool( $query['ductsysinsul1_1'][0] );//Boolean

$ductSysLoc1_2   = $query['ductsysloc1_2'][0];
$ductSysPerc1_2  = $query['ductsysperc1_2'][0];
$ductSysSeal1_2  = convToBool( $query['ductsysseal1_2'][0] );//Boolean
$ductSysInsul1_2 = convToBool( $query['ductsysinsul1_2'][0] );//Boolean

$ductSysLoc1_3   = $query['ductsysloc1_3'][0];
$ductSysPerc1_3  = $query['ductsysperc1_3'][0];
$ductSysSeal1_3  = convToBool( $query['ductsysseal1_3'][0] );//Boolean
$ductSysInsul1_3 = convToBool( $query['ductsysinsul1_3'][0] );//Boolean

// DUCT (System 2) All underscores (_) are actually periods in the name.
$ductSysLoc2_1   = $query['ductsysloc2_1'][0];
$ductSysPerc2_1  = $query['ductsysperc2_1'][0];
$ductSysSeal2_1  = convToBool( $query['ductsysseal2_1'][0] );//Boolean
$ductSysInsul2_1 = convToBool( $query['ductsysinsul2_1'][0] );//Boolean

$ductSysLoc2_2   = $query['ductsysloc2_2'][0];
$ductSysPerc2_2  = $query['ductsysperc2_2'][0];
$ductSysSeal2_2  = convToBool( $query['ductsysseal2_2'][0] );//Boolean
$ductSysInsul2_2 = convToBool( $query['ductsysinsul2_2'][0] );//Boolean

$ductSysLoc2_3   = $query['ductsysloc2_3'][0];
$ductSysPerc2_3  = $query['ductsysperc2_3'][0];
$ductSysSeal2_3  = convToBool( $query['ductsysseal2_3'][0] );//Boolean
$ductSysInsul2_3 = convToBool( $query['ductsysinsul2_3'][0] );//Boolean

// HEAT
$split             = explode( ":", $query['waterheattype'][0] );
$waterHeatType     = $split[0];
$waterheatenergy_1 = $split[1];
$hotWaterEFactor   = $query['hotwaterefactor'][0];


$building_id = '';

// ABOUT STRING CREATION
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


$roof2    = '';
$skylight = '';
$found1   = '';
$found2   = '';
$hvac1    = '';
$duct1    = '';
$hvac2    = '';
$duct2    = '';


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



/*	   NeSL  		*/
/*							*/
/*     if       */
/* 	Statements  */
/*            	*/
// For making more legible strings out of data from submissions

if ( $formFlag == true ) {
	$building_id = getBuildingID( $xmlToSubmitAddress );
}

if ( $blowerDoorTest == 1 ) {
	//Remove airleak rate from XML.
	$about .=
		"
	<ser:envelope_leakage>{$airleakrate}</ser:envelope_leakage>
";
}

if ( $roofconst1 != "None" ) {
	$ceilingcode1 = 'ecwf19';
	$roof1        = "
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


	if ( $roofconst2 != "None" ) {
		$ceilingcode2 = 'ecwf19';
		$roof2        = "
			<ser:zone_roof>
            <ser:roof_name>roof2</ser:roof_name>
            <ser:roof_area>{$roofarea2}</ser:roof_area>
            <ser:roof_assembly_code>{$roof2Code}</ser:roof_assembly_code>
            <ser:roof_color>{$roofcolor2}</ser:roof_color>
            <ser:roof_type>{$attictype2}</ser:roof_type>
			<ser:ceiling_assembly_code>{$ceilingcode2}</ser:ceiling_assembly_code>
			{$skylight}
			</ser:zone_roof>";
	} else {
		$roof2 = "";
	}
}

if ( $skylighthave == 1 ) {
	$skylight = "
			<ser:zone_skylight>
               <ser:skylight_area>{$skyLightArea}</ser:skylight_area>
               <ser:skylight_method>user</ser:skylight_method>
			<ser:skylight_code>{$skyLightCode1}</ser:skylight_code>
            </ser:zone_skylight>
";
}

if ( $foundtype1 != "None" ) {
	$foundins1 = substr( $foundfloorinsul1, 4, 2 );
	$foundins2 = substr( $foundfloorinsul2, 4, 2 );
	$found1    = "<ser:zone_floor>
            <ser:floor_name>floor1</ser:floor_name>
            <ser:floor_area>{$foundarea1}</ser:floor_area>
            <ser:foundation_type>{$foundtype1}</ser:foundation_type>
            <ser:foundation_insulation_level>00</ser:foundation_insulation_level>
			<ser:floor_assembly_code>{$foundfloorinsul1}</ser:floor_assembly_code>
         </ser:zone_floor>";

	if ( $foundtype2 != "None" ) {
		$found2 = "<ser:zone_floor>
            <ser:floor_name>floor2</ser:floor_name>
            <ser:floor_area>{$foundarea2}</ser:floor_area>
            <ser:foundation_type>{$foundtype2}</ser:foundation_type>
            <ser:foundation_insulation_level>00</ser:foundation_insulation_level>
            <ser:floor_assembly_code>{$foundfloorinsul2}</ser:floor_assembly_code>
         </ser:zone_floor>";
	}

}

if ( $heatsystype2 != "None" ) {
	$heatfraction1 = '.50';
	$heatfraction2 = '.50';
} else {
	$heatfraction1 = '1.00';
}

if ( $heatsystype1 != "None" ) {


	if ( $coolsystype1 != "None" ) {
		$cooltype1 = "<ser:cooling>
               <ser:type>{$coolsystype1}</ser:type>
               <ser:efficiency_method>user</ser:efficiency_method>
               <ser:efficiency>{$coolsysefficval1}</ser:efficiency>
			   <ser:year>1985</ser:year>
            </ser:cooling>";
	}

	if ( $duct1have != "None" ) {
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

if ( $heatsystype2 != "None" ) {


	if ( $coolsystype2 != "None" ) {
		$cooltype2 = "<ser:cooling>
               <ser:type>{$coolsystype2}</ser:type>
               <ser:efficiency_method>shipment_weighted</ser:efficiency_method>
			   <ser:efficiency>{$coolsysefficval2}</ser:efficiency>
               <ser:year>1985</ser:year>
            </ser:cooling>";
	}
	if ( $duct2have != "None" ) {
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

if ( $windowcharacgen == 1 ) {
	/*
$windowspanesgen = $query['windowspanesgen'][0];
$windowsframegen = $query['windowsframegen'][0];
$windowsglazegen = $query['windowsglazegen'][0];
$windowsareagen1 = $query['windowsareagen1][0];
$windowsleftcode = createCode($windowspanesleft,$windowsglazeleft ,$windowsframeleft);
*/


	$windowgencode = createCode( $windowspanesgen, $windowsglazegen, $windowsframegen );


	$windowsareafront = $windowsareagen1;
	$windowsareaback  = $windowsareagen1;
	$windowsarealeft  = $windowsareagen1;
	$windowsarearight = $windowsareagen1;

	$windowsfrontcode = $windowgencode;
	$windowsbackcode  = $windowgencode;
	$windowsleftcode  = $windowgencode;
	$windowsrightcode = $windowgencode;
}

if ( $wallscharacgen == 1 ) {
	$wallgencode = createCode( $query['wallsconstructgen'][0], $query['wallsinsulgen'][0], $query['wallsextfingen'][0] );

	$frontwallcode = $wallgencode;
	$backwallcode  = $wallgencode;
	$leftwallcode  = $wallgencode;
	$rightwallcode = $wallgencode;


}


/*	   NeSL  		*/
/*							*/
/*     XML      */
/* 	Variables		*/
/*							*/


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



/*	   NeSL  		*/
/*							*/
/*     All      */
/* 	Functions		*/
/*							*/
// creating bad
if ( $formFlag == true ) {

	onSubmitClick( $xml, $xmlToCalcBaseBuilding, $xmlToCommitResults, $xmlToCalcBasePackage, $xmlToGenerateLabel, $labelData );
}

function getLinks( $res ) {

	$se = explode( '<ns1:url>', $res );
	$arr = array();

// url generation for output
	foreach ( $se as $s ) {
		$url = strip_tags( $s );
		if ( strpos( $url, '-1.pngpng' ) != false ) {
			$arr["PNG"] = $url;
			update_post_meta( $form_id, 'reportpng', str_replace( '.pngpng', '.png', $arr["PNG"] ) );
		}
		if ( strpos( $url, '.pdfpng' ) != false ) {
			$arr["PDF"] = $url;
			update_post_meta( $form_id, 'reportpdf', str_replace( '.pdfpng', '.pdf', $arr["PDF"] ) );
		}
	}
	return $arr;
}

function onSubmitClick( $submit_inputs, $calcBB, $commit, $calcBP, $genLabel, $labelData ) {
	$response = submit_request( $submit_inputs );
	$response = submit_request( $calcBB );
	$response = submit_request( $commit );
	$response = submit_request( $calcBP );
	$response = submit_request( $genLabel, true );

	$res = getLinks( $response );
	//$response now contains both the PNG and PDF.
}

function getBuildingID( $address ) {
	//code to get building id based on the address entered.

	if ( isset( $building_id ) ) {
		return $building_id;
	} else {

		$xmlForSubmit = submit_request( $address );
		explode( '<ns1:message>', $xmlForSubmit );

		$arr         = explode( " ", $xmlForSubmit );
		$building_id = explode( "<ns1:building_id>", $xmlForSubmit );
		$building_id = substr( $building_id[1], 0, 6 );

		return $building_id;

	}
}

function submit_request( $xml, $isLabel = false ) {
	//$url = 'http://requestb.in/1mvc2wt1';
	$url = 'https://sandbox.hesapi.labworks.org/st_api/serve';
	//$xml = (array)simplexml_load_string($xml);
	$content_type = 'application/xml';
	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'header'  => 'Content-type: ' . addslashes( $content_type ) . '\r\n'
			             . 'Content-Length: ' . strlen( $xml ) . '\r\n',
			'content' => $xml,
		),
	);
	$context = stream_context_create( $options );

	//send the data using a cURL-less method
	$result = file_get_contents( $url, false, $context );

	return $result;
}


?>

<?PHP
$arrayName = get_post_meta( $_GET['form_id'] );
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>GreenHome Institute Report</title>

    <!-- linking to styles -->
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/ReportStyles/tvt-styles.css"
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/ReportStyles/tvt-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/ReportStyles/tvt-naved-bootstrap.min.css">
    <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/ReportStyles/jquery-ui.min.css">
    <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/ReportStyles/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-print-layout.css">
    <link rel='dns-prefetch' href='//code.jquery.com'/>
    <style type="text/css">
        body {
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>
<!-- Div Containing Entire Page -->
<div id="RepBod" class="tvt">

    <!-- Div Containing GreenHome Logo -->
    <div width="auto">
        <img src="http://cis.gvsu.edu/~vortech/wp-content/uploads/2016/11/GHI_LOGO.png" alt="GreenHome Institute Logo" class="img-responsive"/>
    </div>

    <!-- Div Containing Assessment Information SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Assessment Information</h2>

        <!-- Div Containing Home Owner Information -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Location</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">

                <label class="tvt-field-label">Address</label>
                <label class="tvt-field-result"> <?php echo $arrayName['homeaddress'][0] ?></label>
							<?php if ( $arrayName['homeaddress2'][0] && $arrayName['homeaddress2'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Address 2</label>
                  <label class="tvt-field-result"> <?php echo $arrayName['homeaddress2'][0] ?></label>
							<?php } ?>

                <label class="tvt-field-label">City</label>
                <label class="tvt-field-result"> <?php echo $arrayName['homecity'][0] ?></label>

                <label class="tvt-field-label">State</label>
                <label class="tvt-field-result"> <?php echo $arrayName['homestate'][0] ?></label>

                <label class="tvt-field-label">Zip</label>
                <label class="tvt-field-result"> <?php echo $arrayName['homezip'][0] ?></label>

            </div>
        </div> <!-- Closing Div Tag for Home Owner Information -->

        <!-- Div Containing Assessment Information -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Assessment Information</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Assessment Date</label>
                <label class="tvt-field-result"> <?php echo $arrayName['auditdate'][0] ?></label>

                <label class="tvt-field-label">Assessor Name</label>
                <label class="tvt-field-result"> <?php echo $arrayName['assessfname'][0] ?><?php echo $arrayName['assesslname'][0] ?></label>

                <label class="tvt-field-label">Assessor Email</label>
                <label class="tvt-field-result">
									<?php
									if ( $arrayName['assessemail'][0] && $arrayName['assessemail'][0] != "None" ) {
										echo $arrayName['assessemail'][0];
									} else {
										echo "No email recorded";
									}
									?>
                </label>
            </div>
        </div> <!-- Closing Div Tag for Assessment Information -->

			<?php if ( $arrayName['reportingpng'][0] ) { ?>
          <div class="col-sm-12 col-md-12 col-lg-12">
              <h3 class="tvt-group-title">DOE Home Energy Score</h3>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12">
              <img class="report-snapshot" src="<?php echo $arrayName['reportpng'][0] ?>"/>
              <label class="tvt-field-label">
                  <a href="<?php echo $arrayName['reportpdf'][0] ?>">Click</a> to see the rest of the report.
              </label>
          </div>
			<?php } ?>
        <!-- Div Containing Home Details -->
        <div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Home Details</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Year Built</label>
                <label class="tvt-field-result"> <?php echo $arrayName['homeyear'][0] ?></label>
                <label class="tvt-field-label">Number of Bedrooms</label>
                <label class="tvt-field-result"><?php echo $arrayName['homebed'][0] ?></label>
                <label class="tvt-field-label">Stories above grade</label>
                <label class="tvt-field-result"><?php echo $arrayName['homestories'][0], ' stories' ?></label>
                <label class="tvt-field-label">Average Ceiling Height</label>
                <label class="tvt-field-result"><?php echo $arrayName['homeavgceiling'][0], ' feet' ?></label>
                <label class="tvt-field-label">Conditioned Floor Area</label>
                <label class="tvt-field-result"><?php echo $arrayName['homefloorarea'][0], ' Square feet' ?></label>
                <!-- note: skipped townhouse/duplex as well as position of unit cause what? -->
            </div>
        </div> <!-- Closing Div Tag for Home Details -->

    </div> <!-- Closing Div Tag for Assessment Information SECTION -->

    <!-- Div Containing Safety and Health Information SECTION-->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Safety and Health Information</h2>

        <!-- Div Containing Air Quality -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Air Quality</h3>
            </div>
					<?php if ( $arrayName['airqualphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['airqualphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['airqualphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Asbestos</label>
                <label class="tvt-field-result"><?php echo $arrayName['asbestos_1'][0] ?></label>
                <label class="tvt-field-label">Ambient Carbon monoxide</label>
                <label class="tvt-field-result"><?php echo $arrayName['ambientppm'][0], " parts per million" ?></label>
                <label class="tvt-field-label">Gas Stove Carbon Monxide</label>
                <label class="tvt-field-result"><?php echo $arrayName['stoveovenppm'][0], " parts per million" ?></label>
                <label class="tvt-field-label"> MERV Filter Rating</label>
                <label class="tvt-field-result"><?php echo $arrayName['mervfiltrationrating'][0] ?></label>
                <label class="tvt-field-label">Mold</label>
							<?php if ( $arrayName['mold_1'][0] == "Yes" ) { ?>
                  <label class="tvt-field-result urgent"> Mold was found in this house</label>
							<?php } else if ( ! $arrayName['mold_1'][0] ) { ?>
                  <label class="tvt-field-result">Mold not tested for</label>
							<?php } else { ?>
                  <label class="tvt-field-result"><?php echo $arrayName['mold1.1'][0] ?> </label>
							<?php } ?>
                <label class="tvt-field-label">Radon</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['radontest'][0] == "Installed" ) {
										echo "Radon system installed";
									} else if ( $arrayName['radontest'][0] == "Activated" ) {
										echo "Test Activated at Home";
									} else if ( $arrayName['radontest'][0] == "LessThan8" ) {
										echo "Test Left with Homeowner";
									} else {
										echo "Not Tested by inspector";
									}
									?>
                </label>
                <label class="tvt-field-label">Other Air Quality Notes</label>
                <label class="tvt-field-result"><?php echo $arrayName['otherairqualitynotes'][0] ?></label>
							<?php if ( $arrayName['airqualrecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['airqualrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Air Quality -->

        <!-- Div Containing Wiring -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Wiring</h3>
            </div>
					<?php if ( $arrayName['wiringphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['wiringphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['wiringphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Smoke and CO Detectors</label>
                <label class="tvt-field-result"><?php echo $arrayName['smokeandco'][0] ?></label>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label"> Knob and tube Wiring</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['knobtubewiring'][0] == "Yes" ) {
										echo "This house had knob and tube wiring";
									} else {
										echo "This had did not have knob and tube wiring";
									} ?>
                </label>

                <label class="tvt-field-label">Wiring Upgrade</label>
                <label class="tvt-field-result"><?php echo $arrayName['wiringupgrade'][0] ?></label>
							<?php if ( $arrayName['wiringrecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['wiringrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Wiring -->

        <!-- Div Containing Kitchen -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Kitchen</h3>
            </div>
					<?php if ( $arrayName['hoodrangephoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['hoodrangephototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['hoodrangephoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Hoodrange Details</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['hoodrangedetails'][0] == "Recirculating" ) {
										echo "Recirculating or there is no hoodrange";
									} else if ( $arrayName['hoodrangedetails'][0] == "ventedInsulated" ) {
										echo "Vented out the attic and insulated";
									} else if ( $arrayName['hoodrangedetails'][0] == "VentedAttic" ) {
										echo "Vented to attic";
									} else if ( $arrayName['hoodrangedetails'][0] == "VentedOutdoors" ) {
										echo "Vented to ourdoors";
									} else {
										echo "Hoodrange venting not recorded by auditor";
									}
									?>
                </label>
                <label class="tvt-field-label">Hoodrange CFM Rate</label>
                <label class="tvt-field-result"><?php echo $arrayName['hoodrangecfmrate'][0] ?></label>
							<?php if ( $arrayName['hoodrangerecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendations</label>
                  <label class="tvt-field-result"><?php echo $arrayName['hoodrangerecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Kitchen -->

    </div> <!-- Closing Div Tag for Safety and Health Information SECTION -->

    <!-- Div Containing Electric SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Electric</h2>

        <!-- Div Containing Lights -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Lights</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Lighting type in high traffic areas</label>
                <label class="tvt-field-result"><?php echo $arrayName['lightingtype'][0] ?></label>
                <label class="tvt-field-label">Lighting Upgrade</label>
                <label class="tvt-field-result"><?php echo $arrayName['lightingupgrade'][0] ?></label>
            </div>
        </div> <!-- Closing Div Tag for Lights -->

        <!-- Div Containing Appliances -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Appliances</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['appliances_1'][0] ) { ?>
                  <label class="tvt-field-label">The following are recommended appliance upgrades</label>
								<?php
								$variable2 = $arrayName['appliances_1'][0];
								$var2      = explode( '|', $variable2 );
								foreach ( $var2 as $row2 ) { ?>
                    <label class="tvt-field-result tvt-field-result-item"> <?php echo $row2 ?> </label>
								<?php } ?>
							<?php } else { ?>
                  <label class="tvt-field-label">Appliance attributes</label>
                  <label class="tvt-field-result">No appliance upgrades recommended</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Appliances -->

        <!-- Div Containing Solar PV Potential -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Solar PV Potential</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['solarpv_1'][0] ) { ?>
                  <label class="tvt-field-label">The following are attributes of the homes solar potential</label>
								<?php
								$variable3 = $arrayName['solarpv_1'][0];
								$var3      = explode( '|', $variable3 );
								foreach ( $var3 as $row3 ) { ?>
                    <label class="tvt-field-result tvt-field-result-item"> <?php echo $row3 ?> </label>
								<?php } ?>
							<?php } else { ?>
                  <label class="tvt-field-result">Solar potential not measured/recorded</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Solar PV Potential -->

    </div> <!-- Closing Div Tag for Electric SECTION -->

    <!-- Div Containing Water Conservation SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Water Conservation</h2>

        <!-- Div containing Bathroom -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Bathroom</h3>
            </div>
					<?php if ( $arrayName['watconsbathphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['watconsbathphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['watconsbathphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Shower Flow Rate</label>
                <label class="tvt-field-result">
									<?php echo $arrayName['showerflowrate'][0], " GPM" ?>
                </label>
                <label class="tvt-field-label">Shower Head Upgrade</label>
                <label class="tvt-field-result"><?php echo $arrayName['showerheadupgrade'][0] ?></label>
                <label class="tvt-field-label">Toilet Flush</label>
                <!-- noted from memory variable name -->
                <label class="tvt-field-result"><?php echo $arrayName['toiletflushgpf'][0], " GPF"; ?></label>
                <label class="tvt-field-label">Toilet Upgrade</label>
                <label class="tvt-field-result"><?php echo $arrayName['toiletupgrade'][0] ?></label>
                <label class="tvt-field-label">Faucet Flow Rate</label>
                <label class="tvt-field-result"><?php echo $arrayName['faucetflowrate'][0], " GPM"; ?></label>
                <label class="tvt-field-label">Faucet Aerator Upgrade</label>
                <label class="tvt-field-result"><?php echo $arrayName['faucetupgrade'][0] ?></label>
							<?php if ( $arrayName['watconsbathrecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['watconsbathrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Bathroom -->

    </div> <!-- Closing Div Tag for Water Conservation SECTION -->

    <!-- Div Containing Structure SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Structure</h2>

        <!-- Div Containing Air Tightness -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Air Tightness</h3>
            </div>
					<?php if ( $arrayName['airleakphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['airphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['airleakphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['blowerdoortest'][0] == "Yes" ) { ?>
                  <label class="tvt-field-label">Air Leakage Rate(cfm50)</label>
                  <label class="tvt-field-result"><?php echo $arrayName['airleakrate'][0] ?></label>
							<?php } else { ?>
                  <label class="tvt-field-label">Was a blower door test conducted?</label>
                  <label class="tvt-field-result">No blower door test was conducted</label>
							<?php } ?>
                <label class="tvt-field-label">Has this house been professional sealed?</label>
                <label class="tvt-field-result"><?php echo $arrayName['profairseal'][0] ?></label>
							<?php if ( $arrayName['airtightrecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['airtightrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Air Tightness -->

        <!-- Div Containing Foundation 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Foundation <?php if ( $arrayName['foundType2'][0] && $arrayName['foundType2'][0] != "None" ) {
										echo '1';
									} ?></h3>
            </div>
					<?php if ( $arrayName['found1photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['found1phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['found1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- always show at least foundation 1. But can mention not measured if is none -->
							<?php if ( $arrayName['foundtype1'][0] && $arrayName['foundtype1'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Foundation Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundtype1'][0] == "None" ) {
											echo "Foundation Not measured";
										} else if ( $arrayName['foundtype1'][0] == "slab_on_grade" ) {
											echo "Slab on Grade";
										} else if ( $arrayName['foundtype1'][0] == "uncond_basement" ) {
											echo "Unconditioned Basement";
										} else if ( $arrayName['foundtype1'][0] == "cond_basement" ) {
											echo "Conditioned Basement";
										} else if ( $arrayName['foundtype1'][0] == "unvented_crawl" ) {
											echo "Unvented Crawlspace";
										} else if ( $arrayName['foundtype1'][0] == "vented_crawl" ) {
											echo "Vented Crawlspace";
										} ?>
                  </label>


									<label class="tvt-field-label">Floor Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundfloorinsul1'][0] == "efwf00ca" ) {
											echo "R-0";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf11ca" ) {
											echo "R-11";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf13ca" ) {
											echo "R-13";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf15ca" ) {
											echo "R-15";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf19ca" ) {
											echo "R-19";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf21ca" ) {
											echo "R-21";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf25ca" ) {
											echo "R-25";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf30ca" ) {
											echo "R-30";
										} else if ( $arrayName['foundfloorinsul1'][0] == "efwf38ca" ) {
											echo "R-38";
										}
										?>
                  </label>

                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName ['foundarea1'][0] ?></label>


                  <label class="tvt-field-label">Wall Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundwallinsul1'][0] == "0" ) {
											echo "R-00";
										} else if ( $arrayName['foundwallinsul1'][0] == "5" ) {
											echo "R-05";
										} else if ( $arrayName['foundwallinsul1'][0] == "11" ) {
											echo "R-11";
										} else if ( $arrayName['foundwallinsul1'][0] == "19" ) {
											echo "R-19";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Rim Band Joist Detail</label>
                  <label class="tvt-field-result"><?php echo $arrayName['rimbandjoistfound1'][0] ?></label>
								<?php if ( $arrayName['found1recom'][0] ) { ?>
                      <label class="tvt-field-label">Assessor's Recommendation</label>
                      <label class="tvt-field-result"><?php echo $arrayName['found1recom'][0] ?></label>
								<?php } ?>
							<?php } else { ?>
                  <label class="tvt-field-result">Foundation not measured/recorded</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Foundation 1 -->

        <!-- Foundation 2 is optional to display -->
			<?php if ( $arrayName['foundType2'][0] && $arrayName['foundType2'][0] != "None" ) { ?>

          <!-- Div Containing Foundation 2 -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Foundation 2</h3>
              </div>
						<?php if ( $arrayName['found2photo'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['found2phototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['found2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Foundation Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundtype2'][0] == "None" ) {
											echo "Foundation Not measured";
										} else if ( $arrayName['foundtype2'][0] == "slab_on_grade" ) {
											echo "Slab on Grade";
										} else if ( $arrayName['foundtype2'][0] == "uncond_basement" ) {
											echo "Unconditioned Basement";
										} else if ( $arrayName['foundtype2'][0] == "cond_basement" ) {
											echo "Conditioned Basement";
										} else if ( $arrayName['foundtype2'][0] == "unvented_crawl" ) {
											echo "Unvented Crawlspace";
										} else if ( $arrayName['foundtype2'][0] == "vented_crawl" ) {
											echo "Vented Crawlspace";
										} ?>
                  </label>
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName( $foundarea2 ) ?></label>
                  <label class="tvt-field-label">Floor Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundfloorinsul2'][0] == "efw00ca" ) {
											echo "R-00";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw11ca" ) {
											echo "R-11";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw13ca" ) {
											echo "R-13";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw15ca" ) {
											echo "R-15";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw19ca" ) {
											echo "R-19";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw21ca" ) {
											echo "R-21";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw25ca" ) {
											echo "R-25";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw30ca" ) {
											echo "R-30";
										} else if ( $arrayName['foundfloorinsul2'][0] == "efw38ca" ) {
											echo "R-38";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Wall Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['foundwallinsul2'][0] == "0" ) {
											echo "R-00";
										} else if ( $arrayName['foundwallinsul2'][0] == "5" ) {
											echo "R-05";
										} else if ( $arrayName['foundwallinsul2'][0] == "11" ) {
											echo "R-11";
										} else if ( $arrayName['foundwallinsul2'][0] == "19" ) {
											echo "R-19";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Rim Band Joist Detail</label>
                  <label class="tvt-field-result"><?php echo $arrayName['rimbandjoistfound2'][0] ?></label>
								<?php if ( $arrayName['found2recom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['found2recom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Foundation 2 -->

			<?php } ?>

        <!-- Div Containing Roof 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Roof <?php if ( $arrayName['roofconst2'][0] && $arrayName['roofconst2'][0] != "None" ) {
										echo "1";
									} ?></h3>
            </div>


            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['roofconst1'][0] && $arrayName['roofconst1'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofconst1'][0] == "rfwf" ) {
											echo "Standard Roof";
										} else if ( $arrayName['roofconst1'][0] == "rfrb" ) {
											echo "Roof with Radiant Barrier";
										} else if ( $arrayName['roofconst1'][0] == "rfps" ) {
											echo "Roof with Rigid Foam Sheathing";
										}
										?>
                  </label>

									<label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['roofarea1'][0] ?></label>

                  <label class="tvt-field-label">Exterior Finish</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofextfin1'][0] == "co" ) {
											echo "Composition Shingles or Metal";
										} else if ( $arrayName['roofextfin1'][0] == "wo" ) {
											echo "Wooden Shingles";
										} else if ( $arrayName['roofextfin1'][0] == "rc" ) {
											echo "Clay Tile";
										} else if ( $arrayName['roofextfin1'][0] == "lc" ) {
											echo "Concrete Tile";
										} else if ( $arrayName['roofextfin1'][0] == "tg" ) {
											echo "Tar and Gravel";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Insulation Level</label>
                  <label class="tvt-field-result"><?php echo "R-", $arrayName['roofinsullev1'][0] ?></label>
                  <label class="tvt-field-label">Color</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofcolor1'][0] == "white" ) {
											echo "White";
										} else if ( $arrayName['roofcolor1'][0] == "light" ) {
											echo "Light";
										} else if ( $arrayName['roofcolor1'][0] == "medium" ) {
											echo "Medium";
										} else if ( $arrayName['roofcolor1'][0] == "medium_dark" ) {
											echo "Medium Dark";
										} else if ( $arrayName['roofcolor1'][0] == "dark" ) {
											echo "Dark";
										} else if ( $arrayName['roofcolor1'][0] == "cool_color" ) {
											echo "Cool Color";
										}
										?>
                  </label>


								<?php if ( $arrayName['roof1recom'][0] ) { ?>
                      <label class="tvt-field-label">Assessor's Recommendation</label>
                      <label class="tvt-field-result"><?php echo $arrayName['roof1recom'][0] ?></label>
								<?php } ?>
							<?php } else { ?>
                  <label class="tvt-field-result">Roof not measured/recorded</label>
							<?php } ?>

							<?php if ( $arrayName['roof1photo'][0] ) { ?>
		              <div class="col-sm-12 col-md-12 col-lg-12 centered">
		                  <label class="tvt-field-label photo-title"><?php echo $arrayName['roof1phototitle'][0] ?></label>
		                  <img src="<?php echo $arrayName['roof1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
		              </div>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Roof 1 -->

        <!-- Roof 2 is optional to display -->
			<?php if ( $arrayName['roofconst2'][0] && $arrayName['roofconst2'][0] != "None" ) { ?>

          <!-- Div Containing Roof 2 -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Roof 2</h3>
              </div>
						<?php if ( $arrayName['roof2photo'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['roof2phototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['roof2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofconst2'][0] == "rfwf" ) {
											echo "Wood Frame";
										} else if ( $arrayName['roofconst2'][0] == "rfrb" ) {
											echo "Wood Frame with Radiant Barrier";
										} else if ( $arrayName['roofconst2'][0] == "rfps" ) {
											echo "Wood Frame with Rigid Foam Sheathing";
										}
										?></label>

										<label class="tvt-field-label">Area</label>
										<label class="tvt-field-result"><?php echo $arrayName['roofarea2'][0] ?></label>

                  <label class="tvt-field-label">Exterior Finish</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofextfin2'][0] == "co" ) {
											echo "Composition Shingles or Metal";
										} else if ( $arrayName['roofextfin2'][0] == "wo" ) {
											echo "Wooden Shingles";
										} else if ( $arrayName['roofextfin2'][0] == "rc" ) {
											echo "Clay Tile";
										} else if ( $arrayName['roofextfin2'][0] == "lc" ) {
											echo "Concrete Tile";
										} else if ( $arrayName['roofextfin2'][0] == "tg" ) {
											echo "Tar and Gravel";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Insulation Level</label>
                  <label class="tvt-field-result"><?php echo "R-", $arrayName['roofinsullev2'][0] ?></label>
                  <label class="tvt-field-label">Color</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['roofcolor2'][0] == "white" ) {
											echo "White";
										} else if ( $arrayName['roofcolor2'][0] == "light" ) {
											echo "Light";
										} else if ( $arrayName['roofcolor2'][0] == "medium" ) {
											echo "Medium";
										} else if ( $arrayName['roofcolor2'][0] == "medium_dark" ) {
											echo "Medium Dark";
										} else if ( $arrayName['roofcolor2'][0] == "dark" ) {
											echo "Dark";
										} else if ( $arrayName['roofcolor2'][0] == "cool_color" ) {
											echo "Cool Color";
										}
										?>
                  </label>

								<?php if ( $arrayName['roof2recom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['roof2recom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Roof 2 -->

			<?php } ?>

        <!-- Div Containing Attic 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Attic <?php if ( $arrayName['attictype2'][0] && $arrayName['attictype2'][0] != "None" ) {
										echo "1";
									} ?></h3>
            </div>
					<?php if ( $arrayName['attic1photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['attic1phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['attic1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['attictype1'][0] && $arrayName['attictype1'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['attictype1'][0] == "cond_attic" ) {
											echo "Conditioned Attic";
										} else if ( $arrayName['attictype1'][0] == "vented_attic" ) {
											echo "Vented Attic";
										} else if ( $arrayName['attictype1'][0] == "cath_ceiling" ) {
											echo "Cathedral Ceiling";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Floor Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['atticfloorinsul1'][0] == "ecwf00" ) {
											echo "R-00";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf03" ) {
											echo "R-03";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf06" ) {
											echo "R-06";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf09" ) {
											echo "R-09";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf11" ) {
											echo "R-11";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf19" ) {
											echo "R-19";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf21" ) {
											echo "R-21";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf25" ) {
											echo "R-25";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf30" ) {
											echo "R-30";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf38" ) {
											echo "R-38";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf44" ) {
											echo "R-44";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf49" ) {
											echo "R-49";
										} else if ( $arrayName['atticfloorinsul1'][0] == "ecwf60" ) {
											echo "R-60";
										}
										?>
                  </label>
								<?php if ( $arrayName['attic1recom'][0] ) { ?>
                      <label class="tvt-field-label">Assessor's Recommendation</label>
                      <label class="tvt-field-result"><?php echo $arrayName['attic1recom'][0] ?></label>
								<?php } ?>
							<?php } else { ?>
                  <label class="tvt-field-result">Attic not measured/recorded</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Attic 1 -->

        <!-- Attic 2 is optional to display -->
			<?php if ( $arrayName['attictype2'][0] && $arrayName['attictype2'][0] != "None" ) { ?>

          <!-- Div Containing Attic 2 -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Attic 2</h3>
              </div>
						<?php if ( $arrayName['attic2photo'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['attic2phototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['attic2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['attictype2'][0] == "cond_attic" ) {
											echo "Conditioned Attic";
										} else if ( $arrayName['attictype2'][0] == "vented_attic" ) {
											echo "Vented Attic";
										} else if ( $arrayName['attictype2'][0] == "cath_ceiling" ) {
											echo "Cathedral Ceiling";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Floor Insulation</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['atticfloorinsul2'][0] == "ecwf00" ) {
											echo "R-00";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf03" ) {
											echo "R-03";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf06" ) {
											echo "R-06";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf09" ) {
											echo "R-09";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf11" ) {
											echo "R-11";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf19" ) {
											echo "R-19";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf21" ) {
											echo "R-21";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf25" ) {
											echo "R-25";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf30" ) {
											echo "R-30";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf38" ) {
											echo "R-38";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf44" ) {
											echo "R-44";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf49" ) {
											echo "R-49";
										} else if ( $arrayName['atticfloorinsul2'][0] == "ecwf60" ) {
											echo "R-60";
										}
										?>
                  </label>
								<?php if ( $arrayName['attic2recom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['attic2recom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Attic 2 -->





          <!-- Div Containing Walls -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Walls</h3>
              </div>

              <div class="col-sm-12 col-md-12 col-lg-12">
								<?php if ( $arrayName['wallsconstructgen'][0] && $arrayName['wallsconstructgen'][0] != "None" ) { ?>
                    <label class="tvt-field-label">Construction</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['wallsconstructgen'][0] == "ewwf" ) {
												echo "Wood Frame";
											} else if ( $arrayName['wallsconstructgen'][0] == "ewps" ) {
												echo "Wood Frame with Rigid Foam Sheathing";
											} else if ( $arrayName['wallsconstructgen'][0] == "ewov" ) {
												echo "Wood frame with Optimum Value Engineering";
											} else if ( $arrayName['wallsconstructgen'][0] == "ewbr" ) {
												echo "Structural Brick";
											} else if ( $arrayName['wallsconstructgen'][0] == "ewcb" ) {
												echo "Concrete Block or Stone";
											} else if ( $arrayName['wallsconstructgen'][0] == "ewsb" ) {
												echo "Straw Bale";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Exterior Finish</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['wallsextfinfront'][0] == "wo" ) {
												echo "Wood Siding";
											} else if ( $arrayName['wallsextfinfront'][0] == "st" ) {
												echo "Stucco";
											} else if ( $arrayName['wallsextfinfront'][0] == "vi" ) {
												echo "Vinyl Siding";
											} else if ( $arrayName['wallsextfinfront'][0] == "al" ) {
												echo "Aluminum Siding";
											} else if ( $arrayName['wallsextfinfront'][0] == "br" ) {
												echo "Brick Veneer";
											} else if ( $arrayName['wallsextfinfront'][0] == "nn" ) {
												echo "No finish";
											} else {
												echo "Exterior Finish not measured/recorded";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Insulation</label>
                    <label class="tvt-field-result"><?php echo "R", $arrayName['wallsinsulfront'][0] ?></label>
									<?php if ( $arrayName['wallsfrontrecom'][0] ) { ?>
                        <label class="tvt-field-label">Assessor's Recommendation</label>
                        <label class="tvt-field-result"><?php echo $arrayName['wallsfrontrecom'][0] ?></label>
									<?php } ?>
								<?php } else { ?>
                    <!-- if generic walls are constructed = "None" || null -->
                    <label class="tvt-field-result">Front Wall not measured/recorded</label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Walls  -->





			<?php } ?>

        <!-- If windows are generic for all sections -->
			<?php if ( $arrayName['windowscharacgen'][0] == 'Yes' ) { ?>

          <!-- Div Containing Windows (General) -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Windows</h3>
              </div>

              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h4 class="tvt-group-subtitle">These apply to all windows in home</h4>


                  <!-- NOTE: windows are not optional, a "Windows not measured/recorded" case not applicable -->
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['windowsareagen1'][0] ?></label>
								<?php if ( $arrayName['wingenknownuandshgc'][0] ) { ?>
                    <label class="tvt-field-label">Panes</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowspanesgen'][0] == "s" ) {
												echo "Single-pane";
											} else if ( $arrayName['windowspanesgen'][0] == "d" ) {
												echo "Double-pane";
											} else if ( $arrayName['windowspanesgen'][0] == "thmabw" ) {
												echo "Triple-pane";
											} else {
												echo "Window Pane type not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Frame</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsframegen'][0] == "aa" ) {
												echo "Aluminium";
											} else if ( $arrayName['windowsframegen'][0] == "ab" ) {
												echo "Aluminium with Thermal Break";
											} else if ( $arrayName['windowsframegen'][0] == "aw" ) {
												echo "Wood or Vinyl";
											} else {
												echo "Window frame not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Glaze</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsglazegen'][0] == "c" ) {
												echo "Clear";
											} else if ( $arrayName['windowsglazegen'][0] == "t" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazegen'][0] == "se" ) {
												echo "Solar-control Low-E";
											} else if ( $arrayName['windowsglazegen'][0] == "sea" ) {
												echo "Solar-Control Low-E, ";
											} else if ( $arrayName['windowsglazegen'][0] == "pe" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazegen'][0] == "pea" ) {
												echo "Tinted";
											} else {
												echo "Window glaze note recorded/measured";
											}
											?>
                    </label>
								<?php } else { ?>
                    <label class="tvt-field-label">U-Factor</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsufactgen'][0] ?></label>
                    <label class="tvt-field-label">SHGC</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsshgcgen'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['windowsgenrecom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsgenrecom'][0] ?></label>
								<?php } ?>

								<?php if ( $arrayName['windowsgenphoto'][0] ) { ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 centered">
                        <label class="tvt-field-label photo-title"><?php echo $arrayName['windowsgenphototitle'][0] ?></label>
                        <img src="<?php echo $arrayName['windowsgenphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
                    </div>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Windows (General) -->

          <!-- If windows are not generic -->
			<?php } else { ?>

          <!-- Div Containing Windows (Front) -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Windows (Front)</h3>
              </div>
						<?php if ( $arrayName['windowsfrontphoto'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['windowsfrontphototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['windowsfrontphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['windowsareafront'][0] ?></label>
								<?php if ( $arrayName['winfrontknownuandshgc'][0] ) { ?>
                    <label class="tvt-field-label">Panes</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowspanesfront'][0] == "s" ) {
												echo "Single-pane";
											} else if ( $arrayName['windowspanesfront'][0] == "d" ) {
												echo "Double-pane";
											} else if ( $arrayName['windowspanesfront'][0] == "thmabw" ) {
												echo "Triple-pane";
											} else {
												echo "Window Pane type not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Frame</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsframefront'][0] == "aa" ) {
												echo "Aluminium";
											} else if ( $arrayName['windowsframefront'][0] == "ab" ) {
												echo "Aluminium with Thermal Break";
											} else if ( $arrayName['windowsframefront'][0] == "aw" ) {
												echo "Wood or Vinyl";
											} else {
												echo "Window frame not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Glaze</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsglazefront'][0] == "c" ) {
												echo "Clear";
											} else if ( $arrayName['windowsglazefront'][0] == "t" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazefront'][0] == "se" ) {
												echo "Solar-control Low-E";
											} else if ( $arrayName['windowsglazefront'][0] == "sea" ) {
												echo "Solar-Control Low-E, ";
											} else if ( $arrayName['windowsglazefront'][0] == "pe" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazefront'][0] == "pea" ) {
												echo "Tinted";
											} else {
												echo "Window glaze note recorded/measured";
											}
											?>
                    </label>
								<?php } else { ?>
                    <label class="tvt-field-label">U-Factor</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsufactfront'][0] ?></label>
                    <label class="tvt-field-label">SHGC</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsshgcfront'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['windowsfrontrecom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsfrontrecom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Windows (Front) -->

                 <!-- Div Containing Windows (Back) -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Windows (Back)</h3>
              </div>
						<?php if ( $arrayName['windowsbackphoto'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['windowsbackphototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['windowsbackphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['windowsareaback'][0] ?></label>
								<?php if ( $arrayName['winbackknownuandshgc'][0] ) { ?>
                    <label class="tvt-field-label">Panes</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowspanesback'][0] == "s" ) {
												echo "Single-pane";
											} else if ( $arrayName['windowspanesback'][0] == "d" ) {
												echo "Double-pane";
											} else if ( $arrayName['windowspanesback'][0] == "thmabw" ) {
												echo "Triple-pane";
											} else {
												echo "Window Pane type not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Frame</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsframeback'][0] == "aa" ) {
												echo "Aluminium";
											} else if ( $arrayName['windowsframeback'][0] == "ab" ) {
												echo "Aluminium with Thermal Break";
											} else if ( $arrayName['windowsframeback'][0] == "aw" ) {
												echo "Wood or Vinyl";
											} else {
												echo "Window frame not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Glaze</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsglazeback'][0] == "c" ) {
												echo "Clear";
											} else if ( $arrayName['windowsglazeback'][0] == "t" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeback'][0] == "se" ) {
												echo "Solar-control Low-E";
											} else if ( $arrayName['windowsglazeback'][0] == "sea" ) {
												echo "Solar-Control Low-E, ";
											} else if ( $arrayName['windowsglazeback'][0] == "pe" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeback'][0] == "pea" ) {
												echo "Tinted";
											} else {
												echo "Window glaze note recorded/measured";
											}
											?>
                    </label>
								<?php } else { ?>
                    <label class="tvt-field-label">U-Factor</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsufactback'][0] ?></label>
                    <label class="tvt-field-label">SHGC</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsshgcback'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['windowsbackrecom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsbackrecom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Windows (Back) -->

                 <!-- Div Containing Windows (Right) -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Windows (Right)</h3>
              </div>
						<?php if ( $arrayName['windowsrightphoto'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['windowsrightphototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['windowsrightphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['windowsarearight'][0] ?></label>
								<?php if ( $arrayName['winrightknownuandshgc'][0] ) { ?>
                    <label class="tvt-field-label">Panes</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowspanesright'][0] == "s" ) {
												echo "Single-pane";
											} else if ( $arrayName['windowspanesright'][0] == "d" ) {
												echo "Double-pane";
											} else if ( $arrayName['windowspanesright'][0] == "thmabw" ) {
												echo "Triple-pane";
											} else {
												echo "Window Pane type not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Frame</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsframeright'][0] == "aa" ) {
												echo "Aluminium";
											} else if ( $arrayName['windowsframeright'][0] == "ab" ) {
												echo "Aluminium with Thermal Break";
											} else if ( $arrayName['windowsframeright'][0] == "aw" ) {
												echo "Wood or Vinyl";
											} else {
												echo "Window frame not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Glaze</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsglazeright'][0] == "c" ) {
												echo "Clear";
											} else if ( $arrayName['windowsglazeright'][0] == "t" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeright'][0] == "se" ) {
												echo "Solar-control Low-E";
											} else if ( $arrayName['windowsglazeright'][0] == "sea" ) {
												echo "Solar-Control Low-E, ";
											} else if ( $arrayName['windowsglazeright'][0] == "pe" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeright'][0] == "pea" ) {
												echo "Tinted";
											} else {
												echo "Window glaze note recorded/measured";
											}
											?>
                    </label>
								<?php } else { ?>
                    <label class="tvt-field-label">U-Factor</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsufactright'][0] ?></label>
                    <label class="tvt-field-label">SHGC</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsshgcright'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['windowsrightrecom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsrightrecom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Windows (Right) -->

                 <!-- Div Containing Windows (Left) -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Windows (Left)</h3>
              </div>
						<?php if ( $arrayName['windowsleftphoto'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['windowsleftphototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['windowsleftphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['windowsarealeft'][0] ?></label>
								<?php if ( $arrayName['winleftknownuandshgc'][0] ) { ?>
                    <label class="tvt-field-label">Panes</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowspanesleft'][0] == "s" ) {
												echo "Single-pane";
											} else if ( $arrayName['windowspanesleft'][0] == "d" ) {
												echo "Double-pane";
											} else if ( $arrayName['windowspanesleft'][0] == "thmabw" ) {
												echo "Triple-pane";
											} else {
												echo "Window Pane type not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Frame</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsframeleft'][0] == "aa" ) {
												echo "Aluminium";
											} else if ( $arrayName['windowsframeleft'][0] == "ab" ) {
												echo "Aluminium with Thermal Break";
											} else if ( $arrayName['windowsframeleft'][0] == "aw" ) {
												echo "Wood or Vinyl";
											} else {
												echo "Window frame not recorded/measured";
											}
											?>
                    </label>
                    <label class="tvt-field-label">Glaze</label>
                    <label class="tvt-field-result">
											<?php if ( $arrayName['windowsglazeleft'][0] == "c" ) {
												echo "Clear";
											} else if ( $arrayName['windowsglazeleft'][0] == "t" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeleft'][0] == "se" ) {
												echo "Solar-control Low-E";
											} else if ( $arrayName['windowsglazeleft'][0] == "sea" ) {
												echo "Solar-Control Low-E, ";
											} else if ( $arrayName['windowsglazeleft'][0] == "pe" ) {
												echo "Tinted";
											} else if ( $arrayName['windowsglazeleft'][0] == "pea" ) {
												echo "Tinted";
											} else {
												echo "Window glaze note recorded/measured";
											}
											?>
                    </label>
								<?php } else { ?>
                    <label class="tvt-field-label">U-Factor</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsufactleft'][0] ?></label>
                    <label class="tvt-field-label">SHGC</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsshgcleft'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['windowsleftrecom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['windowsleftrecom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Windows (Left) -->

			<?php } ?>

        <!-- Div Containing Skylight -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Skylight</h3>
            </div>
					<?php if ( $arrayName['skylightphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['skylightphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['skylightphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if ( $arrayName['skylighthave'][0] == "Yes" ) { ?>
                  <label class="tvt-field-label">Total Area</label>
                  <label class="tvt-field-result"><?php echo $arrayName['skylightarea'][0], " square feet" ?></label>
                  <label class="tvt-field-label">Number of Panels</label>
                  <label class="tvt-field-result"><?php echo $arrayName['skylightnumpanels'][0], " panels" ?></label>
								<?php if ( $arrayName['skylightknownuandshgc'][0] == "No" ) { ?>
                      <label class="tvt-field-label">Pane Type</label>
                      <label class="tvt-field-result">
												<?php if ( $arrayName['skylightpanes'][0] == "s" ) {
													echo "Single-pane";
												} else if ( $arrayName['skylightpanes'][0] == "d" ) {
													echo "Double-pane";
												} else if ( $arrayName['skylightpanes'][0] == "thmabw" ) {
													echo "Triple-pane";
												} else {
													echo "Pane type not recorded/measured";
												}
												?>
                      </label>
                      <label class="tvt-field-label">Frame</label>
                      <label class="tvt-field-result">
												<?php if ( $arrayName['skylightframe'][0] == "aa" ) {
													echo "Aluminium";
												} else if ( $arrayName['skylightframe'][0] == "ab" ) {
													echo "Aluminium with Thermal Break";
												} else if ( $arrayName['skylightframe'][0] == "aw" ) {
													echo "Wood or Vinyl";
												} else {
													echo "Skylight frame not recorded/measured";
												}
												?>
                      </label>
                      <label class="tvt-field-label">Glaze</label>
                      <label class="tvt-field-result">
												<?php if ( $arrayName['skylightglaze'][0] == "c" ) {
													echo "Clear";
												} else if ( $arrayName['skylightglaze'][0] == "t" ) {
													echo "Tinted";
												} else if ( $arrayName['skylightglaze'][0] == "se" ) {
													echo "Solar-control Low-E";
												} else if ( $arrayName['skylightglaze'][0] == "sea" ) {
													echo "Solar-Control Low-E, ";
												} else if ( $arrayName['skylightglaze'][0] == "pe" ) {
													echo "Tinted";
												} else if ( $arrayName['skylightglaze'][0] == "pea" ) {
													echo "Tinted";
												} else {
													echo "Skylight glaze note recorded/measured";
												}
												?>
                      </label>
								<?php } else { ?>
                      <label class="tvt-field-label">U-Factor</label>
                      <label class="tvt-field-result"><?php echo $arrayName['skylightufact'][0] ?></label>
                      <label class="tvt-field-label">SHGC</label>
                      <label class="tvt-field-result"><?php echo $arrayName['skylightshgc'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['skylightrecom'][0] ) { ?>
                      <label class="tvt-field-label">Assessor's Recommendation</label>
                      <label class="tvt-field-result"><?php echo $arrayName['skylightrecom'][0] ?></label>
								<?php } ?>

							<?php } else { ?>
                  <label class="tvt-field-result">Home did not have a skylight</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Skylight -->
    </div> <!-- Closing Div Tag for Structure SECTION -->

    <!-- Div Containing System SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">System</h2>

        <!-- Div Containing Heating 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Heating <?php if ( $arrayName['heatsystype2'][0] && $arrayName['heatsystype2'][0] != "None" ) {
										echo " 1";
									} ?></h3>
            </div>
					<?php if ( $arrayName['heatingsystem1photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['heatingsys1phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['heatingsystem1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Type</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['heatsystype1'][0] == "central_furnance:natural_gas" ) {
										echo "Central Gas Furnance";
									} else if ( $arrayName['heatsystype1'][0] == "None" ) {
										echo "No Heating systems";
									} else if ( $arrayName['heatsystype1'][0] == "wall_furnance:natural_gas" ) {
										echo "Room (Through-the-wall) Gas Furnance";
									} else if ( $arrayName['heatsystype1'][0] == "central_furnance:lpg" ) {
										echo "Propane (LPG) Furnance";
									} else if ( $arrayName['heatsystype1'][0] == "central_furnance:fuel_oil" ) {
										echo "Oil Furnance";
									} else if ( $arrayName['heatsystype1'][0] == "central_furnance:electric" ) {
										echo "Electric Furnance";
									} else if ( $arrayName['heatsystype1'][0] == "heat_pump:electric" ) {
										echo "Electric Heat Pump";
									} else if ( $arrayName['heatsystype1'][0] == "baseboard:electric" ) {
										echo "Electric Baseboard Heater";
									} else if ( $arrayName['heatsystype1'][0] == "boiler:natural_gas" ) {
										echo "Gas Boiler";
									} else if ( $arrayName['heatsystype1'][0] == "boiler:fuel_oil" ) {
										echo "Oil Boiler";
									} else if ( $arrayName['heatsystype1'][0] == "boiler:lpg" ) {
										echo "Propane (LPG) Boiler";
									} else if ( $arrayName['heatsystype1'][0] == "gchp" ) {
										echo "Ground Coupled Heat Pump";
									} else if ( $arrayName['heatsystype1'][0] == "wood_stove" ) {
										echo "Wood Stove";
									} else if ( $arrayName['heatsystype1'][0] == "wood_stove:pellet_wood" ) {
										echo "Pellet Stove";
									} else {
										echo "Heat type not found";
									}
									?>
                </label>
							<?php if ( $arrayName['heatsyseffic1'][0] == 'Yes' ) { ?>
                  <label class="tvt-field-label">Efficiency Value</label>
                  <label class="tvt-field-result"><?php echo $arrayName['heatsysefficval1'][0] ?></label>
							<?php } else { ?>
                  <label class="tvt-field-label">Year Installed</label>
                  <label class="tvt-field-result"><?php echo $arrayName['heatsysyearinst1'][0] ?></label>
							<?php } ?>
							<?php if ( $arrayName['heatingsystem1recom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['heatingsystem1recom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Heating 1 -->

        <!-- Heating 2 is optional to display -->
			<?php if ( $arrayName['heatsystype2'][0] && $arrayName['heatsystype2'][0] != "None" ) { ?>

          <!-- Div Containing Heating 2 -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Heating 2</h3>
              </div>
						<?php if ( $arrayName['heatingsystem2photo'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['heatingsys2phototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['heatingsystem2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['heatsystype2'][0] == "central_furnance:natural_gas" ) {
											echo "Central Gas Furnance";
										} else if ( $arrayName['heatsystype2'][0] == "None" ) {
											echo "No Heating systems";
										} else if ( $arrayName['heatsystype2'][0] == "wall_furnance:natural_gas" ) {
											echo "Room (Through-the-wall) Gas Furnance";
										} else if ( $arrayName['heatsystype2'][0] == "central_furnance:lpg" ) {
											echo "Propane (LPG) Furnance";
										} else if ( $arrayName['heatsystype2'][0] == "central_furnance:fuel_oil" ) {
											echo "Oil Furnance";
										} else if ( $arrayName['heatsystype2'][0] == "central_furnance:electric" ) {
											echo "Electric Furnance";
										} else if ( $arrayName['heatsystype2'][0] == "heat_pump:electric" ) {
											echo "Electric Heat Pump";
										} else if ( $arrayName['heatsystype2'][0] == "baseboard:electric" ) {
											echo "Electric Baseboard Heater";
										} else if ( $arrayName['heatsystype2'][0] == "boiler:natural_gas" ) {
											echo "Gas Boiler";
										} else if ( $arrayName['heatsystype2'][0] == "boiler:fuel_oil" ) {
											echo "Oil Boiler";
										} else if ( $arrayName['heatsystype2'][0] == "boiler:lpg" ) {
											echo "Propane (LPG) Boiler";
										} else if ( $arrayName['heatsystype2'][0] == "gchp" ) {
											echo "Ground Coupled Heat Pump";
										} else if ( $arrayName['heatsystype2'][0] == "wood_stove" ) {
											echo "Wood Stove";
										} else if ( $arrayName['heatsystype2'][0] == "wood_stove:pellet_wood" ) {
											echo "Pellet Stove";
										} else {
											echo "Heat type not found";
										}
										?>
                  </label>
								<?php if ( $arrayName['heatsyseffic2'][0] == 'Yes' ) { ?>
                    <label class="tvt-field-label">Efficiency Value</label>
                    <label class="tvt-field-result"><?php echo $arrayName['heatsysefficval2'][0] ?></label>
								<?php } else { ?>
                    <label class="tvt-field-label">Year Installed</label>
                    <label class="tvt-field-result"><?php echo $arrayName['heatsysyearinst2'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['heatingsystem2recom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['heatingsystem2recom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Heating 2 -->

			<?php } ?>

        <!-- Div Containing Cooling 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Cooling <?php if ( $arrayName['coolsystype2'][0] && $arrayName['coolsystype2'][0] != "None" ) {
										echo " 1";
									} ?></h3>
            </div>
					<?php if ( $arrayName['coolingsys1photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['coolingsys1phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['coolingsys1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Type</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['coolsystype1'][0] == "None" ) {
										echo "No Cooling systems";
									} else if ( $arrayName['coolsystype1'][0] == "packaged_dx" ) {
										echo "Central Air Conditioner";
									} else if ( $arrayName['coolsystype1'][0] == "split_dx" ) {
										echo "Room Air Conditioner";
									} else if ( $arrayName['coolsystype1'][0] == "heat_pump" ) {
										echo "Electric Heat Pump";
									} else if ( $arrayName['coolsystype1'][0] == "ghcp" ) {
										echo "Ground Coupled Heat Pump";
									} else {
										echo "No Cooling systems";
									}
									?>
                </label>
							<?php if ( $arrayName['coolsyseffic1'][0] && $arrayName['coolsyseffic1'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Efficiency Value</label>
                  <label class="tvt-field-result"> <?php echo $arrayName['coolsysefficval1'][0] ?></label>
							<?php } else { ?>
                  <label class="tvt-field-label">Year Installed</label>
                  <label class="tvt-field-result"><?php echo $arrayName['coolsysyearinst1'][0] ?></label>
							<?php } ?>
							<?php if ( $arrayName['coolsys1recom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['coolsys1recom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Cooling 1 -->

        <!-- Cooling 2 is optional to display -->
			<?php if ( $arrayName['coolSysType2'][0] && $arrayName['coolSysType2'][0] != "None" ) { ?>

          <!-- Div Containing Cooling 2 -->
          <div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h3 class="tvt-group-title">Cooling 2</h3>
              </div>
						<?php if ( $arrayName['coolingsys2photo'][0] ) { ?>
                <div class="col-sm-12 col-md-12 col-lg-12 centered">
                    <label class="tvt-field-label photo-title"><?php echo $arrayName['coolingsys2phototitle'][0] ?></label>
                    <img src="<?php echo $arrayName['coolingsys2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
                </div>
						<?php } ?>
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="tvt-field-label">Type</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['coolsystype2'][0] == "None" ) {
											echo "No Cooling systems";
										} else if ( $arrayName['coolsystype2'][0] == "packaged_dx" ) {
											echo "Central Air Conditioner";
										} else if ( $arrayName['coolsystype2'][0] == "split_dx" ) {
											echo "Room Air Conditioner";
										} else if ( $arrayName['coolsystype2'][0] == "heat_pump" ) {
											echo "Electric Heat Pump";
										} else if ( $arrayName['coolsystype2'][0] == "ghcp" ) {
											echo "Ground Coupled Heat Pump";
										} else {
											echo "No Cooling systems";
										}
										?>
                  </label>
								<?php if ( $arrayName['coolsyseffic2'][0] && $arrayName['coolsyseffic2'][0] != "None" ) { ?>
                    <label class="tvt-field-label">Efficiency Value</label>
                    <label class="tvt-field-result"> <?php echo $arrayName['coolsysefficval2'][0] ?></label>
								<?php } else { ?>
                    <label class="tvt-field-label">Year Installed</label>
                    <label class="tvt-field-result"><?php echo $arrayName['coolsysyearinst2'][0] ?></label>
								<?php } ?>
								<?php if ( $arrayName['coolsys2recom'][0] ) { ?>
                    <label class="tvt-field-label">Assessor's Recommendation</label>
                    <label class="tvt-field-result"><?php echo $arrayName['coolsys2recom'][0] ?></label>
								<?php } ?>
              </div>
          </div> <!-- Closing Div Tag for Cooling 2 -->

			<?php } ?>

        <!-- Div containing Duct 1 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Duct <?php if ( $arrayName['duct1have'][0] == "Yes" && $arrayName['duct2have'][0] == "Yes" ) {
										echo " 1";
									} ?></h3>
            </div>
					<?php if ( $arrayName['ductsys1photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['ductsys1phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['ductsys1photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- duct 1 location 1 -->
							<?php if ( $arrayName['duct1have'][0] ) { ?>
                  <label class="tvt-field-label">Location</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['ductsysloc1_1'][0] == "cond_space" ) {
											echo "Conditioned Space";
										} else if ( $arrayName['ductsysloc1_1'][0] == "uncond_basement" ) {
											echo "Unconditioned Basementor Unvented Crawlspace";
										} else if ( $arrayName['ductsysloc1_1'][0] == "vented_crawl" ) {
											echo "Vented Crawlspace";
										} else if ( $arrayName['ductsysloc1_1'][0] == "uncond_attic" ) {
											echo "Unconditioned Attic";
										} else {
											echo "No duct location recorded/measured";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Percentage in this location</label>
                  <label class="tvt-field-result"> <?php echo $arrayName['ductsysperc1_1'][0] ?></label>

                  <label class="tvt-field-label">Was this location properly sealed?</label>
								<?php if ( $arrayName['ductsysseal1_1'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly sealed</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly sealed</label>
								<?php } ?>
                  <label class="tvt-field-label">Was this location properly insulated?</label>
								<?php if ( $arrayName['ductsysinsul1_1'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly insulated</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly insulated</label>
								<?php } ?>

                  <!-- duct 1 location 2 -->
								<?php if ( $arrayName['ductsysloc1_2'][0] && $arrayName['ductsysloc1_2'][0] != "None" ) { ?>
                      <label class="tvt-field-label">Location</label>
                      <label class="tvt-field-result">
												<?php if ( $arrayName['ductsysloc1_2'][0] == "cond_space" ) {
													echo "Conditioned Space";
												} else if ( $arrayName['ductsysloc1_2'][0] == "uncond_basement" ) {
													echo "Unconditioned Basementor Unvented Crawlspace";
												} else if ( $arrayName['ductsysloc1_2'][0] == "vented_crawl" ) {
													echo "Vented Crawlspace";
												} else if ( $arrayName['ductsysloc1_2'][0] == "uncond_attic" ) {
													echo "Unconditioned Attic";
												} else {
													echo "No duct location recorded/measured";
												}
												?>
                      </label>
                      <label class="tvt-field-label">Percentage in this location</label>
                      <label class="tvt-field-result"> <?php echo $arrayName['ductsysperc1_2'][0] ?></label>
                      <label class="tvt-field-label">Was this location properly sealed?</label>
									<?php if ( $arrayName['ductsysseal1_2'][0] == "Yes" ) { ?>
                          <label class="tvt-field-result">This location is properly sealed</label>
									<?php } else { ?>
                          <label class="tvt-field-result">This location is NOT properly sealed</label>
									<?php } ?>
                      <label class="tvt-field-label">Was this location properly insulated?</label>
									<?php if ( $arrayName['ductsysinsul1_2'][0] == "Yes" ) { ?>
                          <label class="tvt-field-result">This location is properly insulated</label>
									<?php } else { ?>
                          <label class="tvt-field-result">This location is NOT properly insulated</label>
									<?php } ?>
								<?php } ?>

                  <!-- duct 1 location 3 -->
								<?php if ( $arrayName['ductSysLoc1_3'][0] && $arrayName['ductSysLoc1_3'][0] != "None" ) { ?>
                      <label class="tvt-field-label">Location</label>
                      <label class="tvt-field-result">
												<?php if ( $arrayName['ductsysloc1_3'][0] == "cond_space" ) {
													echo "Conditioned Space";
												} else if ( $arrayName['ductsysloc1_3'][0] == "uncond_basement" ) {
													echo "Unconditioned Basementor Unvented Crawlspace";
												} else if ( $arrayName['ductsysloc1_3'][0] == "vented_crawl" ) {
													echo "Vented Crawlspace";
												} else if ( $arrayName['ductsysloc1_3'][0] == "uncond_attic" ) {
													echo "Unconditioned Attic";
												} else {
													echo "No duct location recorded/measured";
												}
												?>
                      </label>
                      <label class="tvt-field-label">Percentage in this location</label>
                      <label class="tvt-field-result"> <?php echo $arrayName['ductSysPerc1_3'][0] ?></label>
                      <label class="tvt-field-label">Was this location properly sealed?</label>
									<?php if ( $arrayName['ductSysSeal1_3'][0] == "Yes" ) { ?>
                          <label class="tvt-field-result">This location is properly sealed</label>
									<?php } else { ?>
                          <label class="tvt-field-result">This location is NOT properly sealed</label>
									<?php } ?>
                      <label class="tvt-field-label">Was this location properly insulated?</label>
									<?php if ( $arrayName['ductSysInsul1_3'][0] == "Yes" ) { ?>
                          <label class="tvt-field-result">This location is properly insulated</label>
									<?php } else { ?>
                          <label class="tvt-field-result">This location is NOT properly insulated</label>
									<?php } ?>
								<?php } ?>

								<?php if ( $arrayName['ductsys1recom'][0] ) { ?>
                      <label class="tvt-field-label">Assessor's Recommendation</label>
                      <label class="report-field-report"><?php echo $arrayName['ductsys1recom'][0] ?></label>
								<?php } ?>

							<?php } else { ?>
                  <label class="tvt-field-result">No Duct System</label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Duct 1 -->

        <!-- Duct 2 is optional to display -->
			<?php if ( $arrayName['duct2have'][0] && $arrayName['duct2have'][0] != "None" ){ ?>

        <!-- Div Containing Duct 2 -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Duct 2</h3>
            </div>
					<?php if ( $arrayName['ductsys2photo'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['ductsys2phototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['ductsys2photo'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- duct 2 location 1 -->
							<?php if ( $arrayName['duct2have'][0] ) { ?>
                <label class="tvt-field-label">Location</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['ductsysloc2_1'][0] == "cond_space" ) {
										echo "Conditioned Space";
									} else if ( $arrayName['ductsysloc2_1'][0] == "uncond_basement" ) {
										echo "Unconditioned Basementor Unvented Crawlspace";
									} else if ( $arrayName['ductsysloc2_1'][0] == "vented_crawl" ) {
										echo "Vented Crawlspace";
									} else if ( $arrayName['ductsysloc2_1'][0] == "uncond_attic" ) {
										echo "Unconditioned Attic";
									} else {
										echo "No duct location recorded/measured";
									}
									?>
                </label>
                <label class="tvt-field-label">Percentage in this location</label>
                <label class="tvt-field-result"> <?php echo $arrayName['ductsysperc2_1'][0] ?></label>
                <label class="tvt-field-label">Was this location properly sealed?</label>
							<?php if ( $arrayName['ductsysseal2_1'][0] == "Yes" ) { ?>
                  <label class="tvt-field-result">This location is properly sealed</label>
							<?php } else { ?>
                  <label class="tvt-field-result">This location is NOT properly sealed</label>
							<?php } ?>
                <label class="tvt-field-label">Was this location properly insulated?</label>
							<?php if ( $arrayName['ductsysinsul2_1'][0] == "Yes" ) { ?>
                  <label class="tvt-field-result">This location is properly insulated</label>
							<?php } else { ?>
                  <label class="tvt-field-result">This location is NOT properly insulated</label>
							<?php } ?>

                <!-- duct 1 location 2 -->
							<?php if ( $arrayName['ductsysloc2_2'][0] && $arrayName['ductsysloc2_2'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Location</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['ductsysloc2_2'][0] == "cond_space" ) {
											echo "Conditioned Space";
										} else if ( $arrayName['ductsysloc2_2'][0] == "uncond_basement" ) {
											echo "Unconditioned Basementor Unvented Crawlspace";
										} else if ( $arrayName['ductsysloc2_2'][0] == "vented_crawl" ) {
											echo "Vented Crawlspace";
										} else if ( $arrayName['ductsysloc2_2'][0] == "uncond_attic" ) {
											echo "Unconditioned Attic";
										} else {
											echo "No duct location recorded/measured";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Percentage in this location</label>
                  <label class="tvt-field-result"> <?php echo $arrayName['ductsysperc2_2'][0] ?></label>
                  <label class="tvt-field-label">Was this location properly sealed?</label>
								<?php if ( $arrayName['ductsysseal2_2'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly sealed</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly sealed</label>
								<?php } ?>
                  <label class="tvt-field-label">Was this location properly insulated?</label>
								<?php if ( $arrayName['ductsysinsul2_2'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly insulated</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly insulated</label>
								<?php } ?>
							<?php } ?>

                <!-- duct 1 location 3 -->
							<?php if ( $arrayName['ductSysLoc2_3'][0] && $arrayName['ductSysLoc2_3'][0] != "None" ) { ?>
                  <label class="tvt-field-label">Location</label>
                  <label class="tvt-field-result">
										<?php if ( $arrayName['ductsysloc2_3'][0] == "cond_space" ) {
											echo "Conditioned Space";
										} else if ( $arrayName['ductsysloc2_3'][0] == "uncond_basement" ) {
											echo "Unconditioned Basementor Unvented Crawlspace";
										} else if ( $arrayName['ductsysloc2_3'][0] == "vented_crawl" ) {
											echo "Vented Crawlspace";
										} else if ( $arrayName['ductsysloc2_3'][0] == "uncond_attic" ) {
											echo "Unconditioned Attic";
										} else {
											echo "No duct location recorded/measured";
										}
										?>
                  </label>
                  <label class="tvt-field-label">Percentage in this location</label>
                  <label class="tvt-field-result"> <?php echo $arrayName['ductSysPerc1_3'][0] ?></label>
                  <label class="tvt-field-label">Was this location properly sealed?</label>
								<?php if ( $arrayName['ductSysSeal2_3'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly sealed</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly sealed</label>
								<?php } ?>
                  <label class="tvt-field-label">Was this location properly insulated?</label>
								<?php if ( $arrayName['ductSysInsul2_3'][0] == "Yes" ) { ?>
                      <label class="tvt-field-result">This location is properly insulated</label>
								<?php } else { ?>
                      <label class="tvt-field-result">This location is NOT properly insulated</label>
								<?php } ?>
							<?php } ?>

							<?php if ( $arrayName['ductsys2recom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['ductsys2recom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Duct 2 -->

		<?php } ?>

        <!-- Div Containing Duct Other -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Duct Other</h3>
            </div>
					<?php if ( $arrayName['ductsysotherphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['ductsysotherphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['ductsysotherphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Dryer Vented</label>
							<?php if ( $arrayName['dryervented_1'][0] == "Yes" ) { ?>
                  <label class="tvt-field-result">Dryer is properly vented</label>
							<?php } else { ?>
                  <label class="tvt-field-result">Dryer is NOT properly vented</label>
							<?php } ?>
							<?php if ( $arrayName['ductsysotherrecom'][0] ) {
							} ?>
                <label class="tvt-field-label">Assessor's Recommendation</label>
                <label class="tvt-field-result"><?php echo $arrayName['ductsysotherrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Duct Other -->

        <!-- Div Containing Hot Water -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Hot Water</h3>
            </div>
					<?php if ( $arrayName['hotwatsysphoto'][0] ) { ?>
              <div class="col-sm-12 col-md-12 col-lg-12 centered">
                  <label class="tvt-field-label photo-title"><?php echo $arrayName['hotwatsysphototitle'][0] ?></label>
                  <img src="<?php echo $arrayName['hotwatsysphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
              </div>
					<?php } ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <label class="tvt-field-label">Water Heater Type</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['waterheattype'][0] == "storage:electric" ) {
										echo "Electric Storage";
									} else if ( $arrayName['waterheattype'][0] == "storage:natural_gas" ) {
										echo "Natural Gas Storage";
									} else if ( $arrayName['waterheattype'][0] == "storage:lpg" ) {
										echo "LPG Storage";
									} else if ( $arrayName['waterheattype'][0] == "storage:fuel_oil" ) {
										echo "Oil Storage";
									} else if ( $arrayName['waterheattype'][0] == "heat_pump:electric" ) {
										echo "Electric Heat Pump";
									}
									?>
                </label>
							<?php if ( $arrayName['waterheaterenergy_1'][0] == "Yes" ) { ?>
                  <label class="tvt-field-label">Eneregy Factor</label>
                  <label class="tvt-field-result"><?php echo $arrayName['hotwaterefactor'][0] ?></label>
							<?php } else { ?>
                  <label class="tvt-field-label">Year Installed</label>
                  <label class="tvt-field-result"><?php echo $arrayName['hotwateryearins'][0] ?></label>
							<?php } ?>
                <label class="tvt-field-label">Hot Water Pipes Wrapped</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['hotwaterwrapped_1'][0] == "Yes" ) {
										echo "Pipes are properly wrapped";
									} else {
										echo "Pipes are not wrapped";
									}
									?>
                </label>
                <label class="tvt-field-label">Water Pressure</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['waterpressuretest'][0] == "Less 55" ) {
										echo "Less than 55 PSI";
									} else if ( $arrayName['waterpressuretest'][0] == "55 to 65 PSI" ) {
										echo "55 to 65 PSI";
									} else if ( $arrayName['waterpressuretest'][0] == "Greater 65" ) {
										echo "Greater than 65 PSI";
									} else if ( $arrayName['waterpressuretest'][0] == "NA" ) {
										echo "Not tested";
									} else {
										echo "Water pressure not measured/recorded";
									}
									?>
                </label>
                <label class="tvt-field-label">Leaks found</label>
                <label class="tvt-field-result">
									<?php if ( $arrayName['waterleaksfound_1'][0] == "Yes" ) {
										echo "Water leaks were found within home";
									} else {
										echo "No leaks were found within home";
									} ?>
                </label>
							<?php if ( $arrayName['hotwatsysrecom'][0] ) { ?>
                  <label class="tvt-field-label">Assessor's Recommendation</label>
                  <label class="tvt-field-result"><?php echo $arrayName['hotwatsysrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Hot Water -->

    </div> <!-- Closing Div Tag for System SECTION -->

    <!-- Div Containing Spot Ventilation SECTION -->
    <div class="tvt-section-group pagebreakhere">
        <h2 class="tvt-section-title">Spot Ventilation</h2>

			<?php if ( $arrayName['spotbathphoto'][0] ) { ?>
          <div class="col-sm-12 col-md-12 col-lg-12 centered">
              <label class="tvt-field-label photo-title"><?php echo $arrayName['spotbathphototitle'][0] ?></label>
              <img src="<?php echo $arrayName['spotbathphoto'][0]; ?>" alt="Photo of Air Leak Test"/>
          </div>
			<?php } ?>

        <!-- Div Containing Bathroom -->
        <div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h3 class="tvt-group-title">Bathroom</h3>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
							<?php if($arrayName['bathroomfandetails_1'][0]) { ?>
                <label class="tvt-field-label">The following is true of the bathroom fan</label>
                <!--php logic inc -->
							<?php
							$variable = $arrayName['bathroomfandetails_1'][0];
							$var = explode( '|', $variable );
							foreach($var as $row) { ?>
                <label class="tvt-field-result tvt-field-result-item"> <?php echo $row ?> </label>
							<?php } ?>
							<?php } else { ?>
                <label class='tvt-field-label">Bathroom fan attributes</label>
                        <label class="tvt-field-result">Bathroom fan attributes not measured/recorded</label>
                        <?php } ?>
                                <label class="tvt-field-label">Bath Fan CFM Rate</label>
                                <label class="tvt-field-result"><?php echo $arrayName['bathfancfmrate'][0] ?></label>
                                <?php if ( $arrayName['spotbathrecom'][0] ){ ?>
                                    <label class="tvt-field-label">Assessor' s Recommendation</label>
                <label class="tvt-field-result"> <?php echo $arrayName['spotbathrecom'][0] ?></label>
							<?php } ?>
            </div>
        </div> <!-- Closing Div Tag for Bathroom -->

    </div> <!-- Closing Div Tag for Spot Ventilation SECTION -->

</div> <!-- Closing Div Tag for Entire Page -->

</body>
