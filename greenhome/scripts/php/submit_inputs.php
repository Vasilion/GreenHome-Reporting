<?php

function getBuildingID() {
	//code to get building id based on the address entered.
	
}

// Basic sample code
$building_id    = getBuildingID();   // building id
$user_key = '';         // api key


$auditDate = $_POST['AuditDate'];
$yearBuilt = $_POST['YearBuilt'];
$homeBed = $_POST['HomeBed'];
$homeStories = $_POST['HomeStories'];
$homeAvgCeiling = $_POST['HomeAvgCeiling'];
$homeFloorArea = $_POST['HomeFloorArea'];
$townHouse = $_POST['TownHouse'];//BOOLEAN
$homePosUnit = $_POST['HomePosUnit'];
$blowerDoorTest = $_POST['BlowerDoorTest'];//BOOLEAN
$airLeakRate = $_POST['AirLeakRate'];
$profAirSeal = $_POST['ProfAirSeal'];

//--------------------
$foundArea1 = $_POST['FoundArea1'];
$foundType1 = $_POST['FoundType1'];
$foundFloorInsul1 = $_POST['FoundFloorInsul1'];
$foundWallInsul1 = $_POST['FoundWallInsul1'];

$roofConst1 = $_POST['RoofConst1'];
$roofExtFin1 = $_POST['RoofExtFin1'];
$roofInsulLev1 = $_POST['RoofInsulLev1'];
$roofColor1 = $_POST['RoofColor1'];
$roofReflect1 = $_POST['RoofReflect1'];

$atticType1 = $_POST['AtticType1'];
$atticFloorInsul1 = $_POST['AtticFloorInsul1'];

///--------------------

$foundArea2 = $_POST['FoundArea2'];
$foundType2 = $_POST['FoundType2'];
$foundFloorInsul2 = $_POST['FoundFloorInsul2'];
$foundWallInsul2 = $_POST['FoundWallInsul2'];

$roofConst2 = $_POST['RoofConst2'];
$roofExtFin2 = $_POST['RoofExtFin2'];
$roofInsulLev2 = $_POST['RoofInsulLev2'];
$roofColor2 = $_POST['RoofColor2'];
$roofReflect2 = $_POST['RoofReflect2'];

$atticType2 = $_POST['AtticType2'];
$atticFloorInsul2 = $_POST['AtticFloorInsul2'];
//---------------------

$wallsCharacGen = $_POST['WallsCharacGen'];//BOOLEAN SAME WALL 

$wallsConstructGen = $_POST['WallsConstructGen'];
$wallsExtFinGen = $_POST['WallsExtFinGen'];
$wallsInsulGen = $_POST['WallsInsulGen'];

$windowCharacGen = $_POST['WindowCharacGen'];//BOOLEAN SAME WINDOW

$windowsAreaFrontGen = $_POST['WindowsAreaFrontGen'];//number
$windowsAreaBackGen = $_POST['WindowsAreaBackGen'];//number
$windowsAreaRightGen = $_POST['WindowsAreaRightGen'];//number
$windowsAreaLeftGen = $_POST['WindowsAreaLeftGen'];//number
$windowsPanesGen = $_POST['WindowsPanesGen'];
$windowsFrameGen = $_POST['WindowsFrameGen'];
$windowsGlazeGen = $_POST['WindowsGlazeGen'];

/// OR ?? 

$windowsUFactGen = $_POST['WindowsUFactGen'];//number
$windowsSHGCGen = $_POST['WindowsSHGCGen'];//number 
$rimBandJoistDetGen = $_POST['RimBandJoistDetGen'];
$skyLightHave = $_POST['SkylightHave?'];//BOOLEAN SkylightHave?
$skyLightArea = $_POST['SkylightArea'];//number
$skyLightNumPanels = $_POST['SkylightNumPanels'];//number
$skyLightFrame = $_POST['SkylightFrame'];
$skyLightGlaze = $_POST['SkylightGlaze'];

// OR ??

$skyLightUFact = $_POST['SkylightUFact'];
$skyLightSHGC = $_POST['SkylightSHGC'];

//Front

$wallsConstructFront = $_POST['WallsConstructFront'];
$wallsExtFinFront = $_POST['WallsExtFinFront'];
$wallsInsulFront = $_POST['WallsInsulFront'];

$windowsAreaFront = $_POST['WindowsAreaFront'];
$windowsPanesFront = $_POST['WindowsPanesFront'];
$windowsFrameFront = $_POST['WindowsFrameFront'];
$windowsGlazeFront = $_POST['WindowsGlazeFront'];

$windowsUFactFront = $_POST['WindowsUFactFront'];
$windowsSHGCFront = $_POST['WindowsSHGCFront'];
$rimBandJoistDetFront = $_POST['RimBandJoistDetFront'];

//Back

$wallsConstructBack = $_POST['WallsConstructBack'];
$wallsExtFinBack = $_POST['WallsExtFinBack'];
$wallsInsulBack = $_POST['WallsInsulBack'];

$windowsAreaBack = $_POST['WindowsAreaBack'];
$windowsPanesBack = $_POST['WindowsPanesBack'];
$windowsFrameBack = $_POST['WindowsFrameBack'];
$windowsGlazeBack = $_POST['WindowsGlazeBack'];

$windowsUFactBack = $_POST['WindowsUFactBack'];
$windowsSHGCBack = $_POST['WindowsSHGCBack'];
$rimBandJoistDetBack = $_POST['RimBandJoistDetBack'];

//Right 

$wallsConstructRight = $_POST['WallsConstructRight'];
$wallsExtFinRight = $_POST['WallsExtFinRight'];
$wallsInsulRight = $_POST['WallsInsulRight'];

$windowsAreaRight = $_POST['WindowsAreaRight'];
$windowsPanesRight = $_POST['WindowsPanesRight'];
$windowsFrameRight = $_POST['WindowsFrameRight'];
$windowsGlazeRight = $_POST['WindowsGlazeRight'];

$windowsUFactRight = $_POST['WindowsUFactRight'];
$windowsSHGCRight = $_POST['WindowsSHGCRight'];
$rimBandJoistDetRight = $_POST['RimBandJoistDetRight'];

//Left 

$wallsConstructLeft = $_POST['WallsConstructLeft'];
$wallsExtFinLeft = $_POST['WallsExtFinLeft'];
$wallsInsulLeft = $_POST['WallsInsulLeft'];

$windowsAreaLeft = $_POST['WindowsAreaLeft'];
$windowsPanesLeft = $_POST['WindowsPanesLeft'];
$windowsFrameLeft = $_POST['WindowsFrameLeft'];
$windowsGlazeLeft = $_POST['WindowsGlazeLeft'];

$windowsUFactLeft = $_POST['WindowsUFactLeft'];
$windowsSHGCLeft = $_POST['WindowsSHGCLeft'];
$rimBandJoistDetLeft = $_POST['RimBandJoistDetLeft'];

//Heating (System 1)
$heatSysType1 = $_POST['HeatSysType1'];
$heatSysEffic1 = $_POST['HeatSysEffic?1'];//BOOLEAN HeatSysEffic?1
$heatSysEfficVal1 = $_POST['HeatSysEfficVal1'];
$heatSysYearInst1 = $_POST['HeatSysYearInst1'];

//Heating (System 2)
$heatSysType2 = $_POST['HeatSysType2'];
$heatSysEffic2 = $_POST['HeatSysEffic?2'];//BOOLEAN HeatSysEffic?2
$heatSysEfficVal2 = $_POST['HeatSysEfficVal2'];
$heatSysYearInst2 = $_POST['HeatSysYearInst2'];


//cooling (System 1)
$coolSysType1 = $_POST['CoolSysType1'];
$coolSysEffic1 = $_POST['CoolSysEffic?1'];//BOOLEAN coolSysEffic?1
$coolSysEfficVal1 = $_POST['CoolSysEfficVal1'];
$coolSysYearInst1 = $_POST['CoolSysYearInst1'];


//cooling (System 2)
$coolSysType2 = $_POST['CoolSysType2'];
$coolSysEffic2 = $_POST['CoolSysEffic?2'];//BOOLEAN coolSysEffic?2
$coolSysEfficVal2 = $_POST['CoolSysEfficVal2'];
$coolSysYearInst2 = $_POST['CoolSysYearInst2'];


//Duct (System 1) All underscores (_) are actually periods in the name. 
$ductSysLoc1_1 = $_POST[''];
$ductSysPerc1_1 = $_POST[''];
$ductSysSeal1_1 = $_POST[''];//Boolean
$ductSysInsul1_1 = $_POST[''];//Boolean

$ductSysLoc1_2 = $_POST[''];
$ductSysPerc1_2 = $_POST[''];
$ductSysSeal1_2 = $_POST[''];//Boolean
$ductSysInsul1_2 = $_POST[''];//Boolean

$ductSysLoc1_3 = $_POST[''];
$ductSysPerc1_3 = $_POST[''];
$ductSysSeal1_3 = $_POST[''];//Boolean
$ductSysInsul1_3 = $_POST[''];//Boolean

//Duct (System 2) All underscores (_) are actually periods in the name. 
$ductSysLoc2_1 = $_POST[''];
$ductSysPerc2_1 = $_POST[''];
$ductSysSeal2_1 = $_POST[''];//Boolean
$ductSysInsul2_1 = $_POST[''];//Boolean

$ductSysLoc2_2 = $_POST[''];
$ductSysPerc2_2 = $_POST[''];
$ductSysSeal2_2 = $_POST[''];//Boolean
$ductSysInsul2_2 = $_POST[''];//Boolean

$ductSysLoc2_3 = $_POST[''];
$ductSysPerc2_3 = $_POST[''];
$ductSysSeal2_3 = $_POST[''];//Boolean
$ductSysInsul2_3 = $_POST[''];//Boolean


$solarPVPot = $_POST[''];//number 1-5 

$xml = '<'.'?xml version="1.0" encoding="UTF-8"?'.'>'."\n";
$xml .= <<<xmltext
<!-- ST v2016 Test Input with PV 2016-02-04 LIR -->
<submit_inputsRequest>
   <building>
      <user_key>{$user_key}</user_key>
      <building_id>{$building_id}</building_id>
      <about>
         <assessment_date>{$auditDate}</assessment_date>
         <comments>ST v2016 Full Label Test</comments>
         <shape>rectangle</shape>
         <year_built>{$yearBuilt}</year_built>
         <number_bedrooms>{$homeBed}</number_bedrooms>
         <num_floor_above_grade>{$homeStories}</num_floor_above_grade>
         <floor_to_ceiling_height>{$homeAvgCeiling}</floor_to_ceiling_height>
         <conditioned_floor_area>{$homeFloorArea}</conditioned_floor_area>
         <orientation>{$homePosUnit}</orientation>
         <blower_door_test>{$blowerDoorTest}</blower_door_test>
         <air_sealing_present>{$profAirSeal}</air_sealing_present>
      </about>
      <zone>
         <wall_construction_same>{$wallsCharacGen}</wall_construction_same>
         <window_construction_same>{$windowCharacGen}</window_construction_same>
         <zone_roof>
            <roof_name>roof1</roof_name>
            <roof_area></roof_area>
            <roof_assembly_code>rfwf00co</roof_assembly_code>
            <roof_color>{$roofColor1}</roof_color>
            <roof_type>{$atticType1}</roof_type>
            <ceiling_assembly_code>ecwf19</ceiling_assembly_code>
            <zone_skylight>
               <skylight_area>{$skyLightArea}</skylight_area>
               <skylight_method></skylight_method>
               <skylight_code>scna</skylight_code>
            </zone_skylight>
         </zone_roof>
         <zone_roof>
            <roof_name>roof2</roof_name>
            <roof_area>400</roof_area>
            <roof_assembly_code>rfps19co</roof_assembly_code>
            <roof_color>{$roofColor2}</roof_color>
            <roof_absorptance>0.3</roof_absorptance>
            <roof_type>{$atticType2}</roof_type>
            <zone_skylight>
               <skylight_area>100</skylight_area>
               <skylight_method>custom</skylight_method>
               <skylight_u_value>0.2</skylight_u_value>
               <skylight_shgc>0.5</skylight_shgc>
            </zone_skylight>
         </zone_roof>
         <zone_floor>
            <floor_name>floor1</floor_name>
            <floor_area>200</floor_area>
            <foundation_type>slab_on_grade</foundation_type>
            <foundation_insulation_level>0</foundation_insulation_level>
         </zone_floor>
         <zone_floor>
            <floor_name>floor2</floor_name>
            <floor_area>800</floor_area>
            <foundation_type>uncond_basement</foundation_type>
            <foundation_insulation_level>11</foundation_insulation_level>
            <floor_assembly_code>efwf11ca</floor_assembly_code>
         </zone_floor>
         <zone_wall>
            <side>front</side>
            <wall_assembly_code>ewbr00nn</wall_assembly_code>
            <zone_window>
               <window_area>{$windowsAreaFront}</window_area>
               <window_method>code</window_method>
               <window_code>scna</window_code>
            </zone_window>
         </zone_wall>
         <zone_wall>
            <side>back</side>
            <wall_assembly_code>ewwf03st</wall_assembly_code>
            <zone_window>
               <window_area>{$windowsAreaBack}</window_area>
               <window_method>custom</window_method>
               <window_u_value>{$windowsUFactBack}</window_u_value>
               <window_shgc>{$windowsSHGCBack}</window_shgc>
            </zone_window>
         </zone_wall>
         <zone_wall>
            <side>right</side>
            <wall_assembly_code>ewwf07vi</wall_assembly_code>
            <zone_window>
               <window_area>{$windowsAreaRight}</window_area>
               <window_method>code</window_method>
               <window_code>dcaa</window_code>
            </zone_window>
         </zone_wall>
         <zone_wall>
            <side>left</side>
            <wall_assembly_code>ewwf00wo</wall_assembly_code>
            <zone_window>
               <window_area>{$windowsAreaLeft}</window_area>
               <window_method>code</window_method>
               <window_code>dseaaw</window_code>
            </zone_window>
         </zone_wall>
      </zone>
      <systems>
         <hvac>
            <hvac_name>hvac1</hvac_name>
            <hvac_fraction>0.75</hvac_fraction>
            <heating>
               <type>{$heatSysType1}</type>
               <fuel_primary>natural_gas</fuel_primary>
               <efficiency_method>user</efficiency_method>
               <efficiency>{$heatSysEfficVal1}</efficiency>
            </heating>
            <cooling>
               <type>split_dx</type>
               <efficiency_method>user</efficiency_method>
               <efficiency>{$coolSysEfficVal1}</efficiency>
            </cooling>
            <hvac_distribution>
               <name>duct1</name>
               <location>{$ductSysLoc1_1}</location>
               <fraction>{$ductSysPerc1_1}</fraction>
               <insulated>{$ductSysInsul1_1}</insulated>
               <sealed>{$ductSysSeal1_1}</sealed>
            </hvac_distribution>
            <hvac_distribution>
               <name>duct2</name>
               <location>{$ductSysLoc1_2}</location>
               <fraction>{$ductSysPerc1_2}</fraction>
               <insulated>{$ductSysInsul1_2}</insulated>
               <sealed>{$ductSysSeal1_2}</sealed>
            </hvac_distribution>
			<hvac_distribution>
               <name>duct3</name>
               <location>{$ductSysLoc1_3}</location>
               <fraction>{$ductSysPerc1_3}</fraction>
               <insulated>{$ductSysInsul1_3}</insulated>
               <sealed>{$ductSysSeal1_3}</sealed>
            </hvac_distribution>
         </hvac>
         <hvac>
            <hvac_name>hvac2</hvac_name>
            <hvac_fraction>0.25</hvac_fraction>
            <heating>
               <type>{$heatSysType2}</type>
               <fuel_primary>natural_gas</fuel_primary>
               <efficiency_method>{$heatSysEffic2}</efficiency_method>
               <efficiency>{$heatSysEfficVal2}</efficiency>
            </heating>
            <cooling>
               <type>packaged_dx</type>
               <efficiency_method>shipment_weighted</efficiency_method>
               <year>{$heatSysYearInst2}</year>
            </cooling>
            <hvac_distribution>
               <name>duct1</name>
               <location>{$ductSysLoc2_1}</location>
               <fraction>{$ductSysPerc2_1}</fraction>
               <insulated>{$ductSysInsul2_1}</insulated>
               <sealed>{$ductSysSeal2_1}</sealed>
            </hvac_distribution>
            <hvac_distribution>
               <name>duct2</name>
               <location>{$ductSysLoc2_2}</location>
               <fraction>{$ductSysPerc2_2}</fraction>
               <insulated>{$ductSysInsul2_2}</insulated>
               <sealed>{$ductSysSeal2_2}</sealed>
            </hvac_distribution>
            <hvac_distribution>
               <name>duct3</name>
               <location>{$ductSysLoc2_3}</location>
               <fraction>{$ductSysPerc2_3}</fraction>
               <insulated>{$ductSysInsul2_3}</insulated>
               <sealed>{$ductSysSeal2_3}</sealed>
            </hvac_distribution>
         </hvac>
         <domestic_hot_water>
            <category>unit</category>
            <type>storage</type>
            <fuel_primary>natural_gas</fuel_primary>
            <efficiency_method>user</efficiency_method>
            <energy_factor>0.7</energy_factor>
         </domestic_hot_water>
         <generation>
       	    <solar_electric>
       	        <capacity_known>1</capacity_known>
	        <system_capacity>6</system_capacity>
	        <year>2005</year>
	        <array_azimuth>south</array_azimuth>
       	    </solar_electric>
         </generation>
      </systems>
   </building>
</submit_inputsRequest>

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

        $response = $client->call('submit_inputs',$input);

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