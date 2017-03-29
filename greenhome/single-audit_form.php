<script>
	<?php
	/*
	Template Name: Form Template - Omni Hide
	*/
	?>
</script>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Targets mobile devices to set width to screen size -->
    <title>GreenHome Inspection Form</title>
    <!-- linking to styles -->
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-styles.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-naved-bootstrap.min.css">
		<link rel="icon" href="https://greenhomeinstitute.org/wp-content/uploads/2015/03/favicon.png" type="image/png">
    <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/jquery-ui.min.css">
    <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-print-layout.css">
    <link rel='dns-prefetch' href='//code.jquery.com'/>

    <!--JQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../wp-content/themes/greenhome/scripts/javascript/jquery-ui.min.js"></script>
		<script>
			window.onbeforeunload = "Test: Warning! if you did not click generate report your information may not save";
		</script>


</head>
<!-- greenhome green = #0b9444 -->
<!-- greenhome blue  = #20419a -->
<body bgcolor="#CCCCCC" >


<script><?php
	if ( isset( $_GET['form_id'] ) ) {
		$formId = $_GET['form_id'];
	} else {
		global $post;
		$formId = $post->ID;
	}
	$formData = get_post_meta( $formId );

	?></script>

<!-- Div Containing the Entire Form Page -->
<div>

    <!-- Div Containing Page Tabs -->
    <div>
        <ul class="nav nav-pills nav-justified" id="nav_bar">
            <!-- active tab dictates initial tab -->
            <li><a href="#" class="tvt-tablinks active" onClick="openTab(event, 'Information')"><span class="glyphicon glyphicon-user"></span> Information</a>
            </li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'Structure')"><span class="glyphicon glyphicon-home"></span> Structure</a></li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'System')"><span class="glyphicon glyphicon-scale"></span> Systems</a></li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'Safety')"><span class="glyphicon glyphicon-warning-sign"></span> Safety and Health</a>
            </li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'SpotVentilation')"><span class="glyphicon glyphicon-cog"></span> Spot Ventilation</a>
            </li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'WaterConservation')"><span class="glyphicon glyphicon-tint"></span> Water Conservation</a>
            </li>
            <li><a href="#" class="tvt-tablinks" onClick="openTab(event, 'Electric')"><span class="glyphicon glyphicon-flash"></span> Electric</a></li>
        </ul>
    </div> <!-- Closing Div Tag for Page Tabs -->

    <!-- Form Element Containing Entire Form -->
    <form id="form1" name="form1" method="post" action="../Audit-+Report?form_id=<?php echo $formId ?>" class="tvt" enctype="multipart/form-data">
        <input id="formId" name="form_id" type="text" value="<?php echo $formId ?>" hidden/>
        <div style="text-align:center;">
            <div id="legend">
                <span onclick="$('#legend').hide();" class="close">x</span>
                <h3>Legend</h3>
                <hr/>
                <div class="colorblind-validation">
                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="ColorBlindMode"
                               id="ColorBlindMode" onChange="colorBlindMode()"/> Use Colorblind Mode
                    </label>
                </div>
                <div class="form-validation">
                    <label><span style="color:red">*</span><b> Denotes required field</b> </label>
                    <label><span class="error-lbl">This color</span> represents invalid</label>
                    <label><span class="saving-lbl">This color</span> represents fields that are saving</label>
                    <label><span class="saved-lbl">This color</span> represents valid and saved</label>
                </div>

                <!-- Div Containing Colorblind Mode -->
                <!--                <div class="" id="colorblind-div"></div>
								-->            </div>
        </div> <!-- Closing Div Tag for Colorblind Mode -->

        <!-- Div Containing Information TAB SECTION -->
        <div id="Information" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing Personal SECTION -->
            <div class="tvt-section-group">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-user"></span> Personal</h2>
                </div>

                <!-- Div Containing Assessor Information -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Assessor Information</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">First Name</label>

                        <input title="Tooltip" alt="Tooltip" class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AssessFName" type="text"
                               value="<?php echo $formData['assessfname'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Last Name</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AssessLName" type="text"
                               value="<?php echo $formData['assesslname'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Email</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AssessEmail" type="email"
                               value="<?php echo $formData['assessemail'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Confirm Email</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" tvt-match-name="AssessEmail" name="AssessConfEmail"
                               value="<?php echo $formData['assessemail'][0]; ?>"
                               type="email"/>
                    </div>

                </div> <!-- Closing Div Tag for Assessor Information -->

                <!-- Div Containing Homeowner Information -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Homeowner Information</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">First Name</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeOwnFName" type="text"
                               value="<?php echo $formData['homeownfname'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Last Name</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeOwnLName" type="text"
                               value="<?php echo $formData['homeownlname'][0]; ?>"/>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Phone Number</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeOwnPNumber" type="tel" placeholder="000-000-0000"
                               value="<?php echo $formData['homeownpnumber'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Homeowner Information -->

                <!-- Div Containing Assessment Information -->
                <div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Assessment Information</h3>
                    </div>

										<div class="col-sm-12 col-md-6 col-lg-4">
										<label class="tvt-field-label">Assessment Type</label>
										<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AssessmentType" id="AssessmentType"
														onChange="toggleRequiredFields(true)">
												<option disabled selected value> -- select an option --</option>
												<option value="Home Energy Score">Initial</option>
												<option value="Holland">Final</option>
												<option value="Home Inspection">QA</option>
												<option value="Home Energy Score">Alternative EEM</option>
												<option value="Holland">Test</option>
												<option value="Home Inspection">Corrected</option>
												<option value="Home Energy Score">Mentor</option>
									  </select>
								  	</div>

                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <label class="tvt-field-label">Date of Audit</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="date" name="AuditDate"
                               value="<?php echo $formData['auditdate'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <label class="tvt-field-label">Audit Type</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AuditType" id="AuditType"
                                onChange="toggleRequiredFields(true)">
                            <option disabled selected value> -- select an option --</option>
                            <option value="Home Energy Score">Home Energy Score</option>
                            <option value="Holland">Holland Home Energy Score</option>
                            <option value="Home Inspection">General Home Inspection</option>
                        </select>
                    </div>

										<div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Expressed Concerns of the Homeowner</label>
                        <input class="tvt-field-input" type="text" value="<?php echo $formData['homeownconcerns'][0] ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Assessment Information -->

            </div> <!-- Closing Div Tag for Personal SECTION -->

            <!-- Div Containing Location SECTION -->
            <div class="tvt-section-group">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-globe"></span> Location</h2>
                </div>

                <!-- Div Containing Address Information -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Address Information</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <label class="tvt-field-label">Address</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeAddress" type="text"
                               value="<?php echo $formData['homeaddress'][0]; ?>"/>

                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <label class="tvt-field-label">Address 2</label>

                        <input class="tvt-field-input" name="HomeAddress2" type="text" value="<?php echo $formData['homeaddress2'][0]; ?>"/>

                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-4">

                        <label class="tvt-field-label">City</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeCity" type="text"
                               value="<?php echo $formData['homecity'][0]; ?>"/>

                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="tvt-field-label">State</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeState">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI" selected>Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
													  <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
														<option value="PR">Puerto Rico</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="tvt-field-label">Zip</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" maxlength="5" name="HomeZip" type="number"
                               value="<?php echo $formData['homezip'][0]; ?>"/>
                    </div>


                </div> <!-- Closing Div Tag for Address Information -->

                <!-- Div Containing Home Details -->
                <div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Home Details</h3>
                    </div>





                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Year Built</label>
                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeYear" type="number" maxlength="4" min="1600"
                               value="<?php echo $formData['homeyear'][0]; ?>"/>
                    </div>

                    <!-- Number of bedrooms 1-10 -->
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Number of Bedrooms</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="NumOfBedrooms" id="NumOfBedrooms"
																onChange="toggleRequiredFields(true)">
														<option disabled selected value> -- select an option --</option>
														<option value="Home Energy Score">1</option>
														<option value="Holland">2</option>
														<option value="Home Inspection">3</option>
														<option value="Home Energy Score">4</option>
														<option value="Holland">5</option>
														<option value="Home Inspection">6</option>
														<option value="Home Energy Score">7</option>
														<option value="Holland">8</option>
														<option value="Home Inspection">9</option>
														<option value="Home Energy Score">10</option>
											  </select>
										  	</div>




                    <!-- Number of Floors 1-4 -->
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <label class="tvt-field-label">Stories Above Ground Level</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="Stories" id="Stories"
																onChange="toggleRequiredFields(true)">
														<option disabled selected value> -- select an option --</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
												 </select>
                    </div>

                    <!-- Avg Ceiling 6-12 -->
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <label class="tvt-field-label">Average Ceiling Height (ft)</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AvgCHeight" id="AvgCHeight"
																onChange="toggleRequiredFields(true)">
														<option disabled selected value> -- select an option --</option>
														<option value="6">6 feet</option>
														<option value="7">7 feet</option>
														<option value="8">8 feet</option>
														<option value="9">9 feet</option>
														<option value="10">10 feet</option>
														<option value="11">11 feet</option>
														<option value="12">12 feet</option>
												</select>
                    </div>

                    <!-- Floor Area 250-25000 -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Conditioned Floor Area (sq ft)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeFloorArea" type="number" step="1" min="250"
                               value="<?php echo $formData['homefloorarea'][0]; ?>"/>
                    </div>

                    <!-- Values need to be changed -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">What Kind of Home is This?</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" id="HomeTownDup" name="HomeTownDup"
                                onchange="omniHide(this, 'Detached Single Family Home', 'PositionInfo')">
                            <option selected value="Detached Single Family Home">Detached Single Family Home</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Duplex">Duplex</option>
                        </select>

                    </div>

                    <div class="PositionInfo">

                        <div class="col-sm-6 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Position of Unit</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomePosUnit">
                                <option disabled selected value> -- select an option --</option>
                                <option value="Right">Right</option>
                                <option value="Middle">Middle</option>
                                <option value="Left">Left</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Direction Faced by Front of House</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HomeFrontDirection">
                            <option disabled selected value> -- select an option --</option>
                            <option value="N">N</option>
                            <option value="NE">NE</option>
                            <option value="E">E</option>
                            <option value="SE">SE</option>
                            <option value="S">S</option>
                            <option value="SW">SW</option>
                            <option value="W">W</option>
                            <option value="NW">NW</option>
                        </select>
                    </div>
                </div> <!-- Closing Div Tag for Home Details -->

            </div> <!-- Closing Div Tag for Location SECTION -->

        </div> <!-- Closing Div Tag for Information TAB SECTION -->

        <!-- Tab Containing Structure TAB SECTION -->
        <div id="Structure" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing Structure SECTION -->
            <div class="tvt-section-group">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-home"></span> Structure</h2>
                </div>

                <!-- Div Containing Air Tightness -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Air Tightness</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Was a Blower Door test conducted on this house?</label>
                        <p>
                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="BlowerDoorTest"
                                       value="Yes" id="BlowerDoorTest_0" onclick="omniHide(this, 'No', 'AirLeakageRate', undefined, true)"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="BlowerDoorTest"
                                       value="No" id="BlowerDoorTest_1" onclick="omniHide(this, 'No', 'AirLeakageRate', undefined, true)" checked  />
                                No/Don't Know</label>
                        </p>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 AirLeakageRate">
                        <label class="tvt-field-label">Air Leakage Rate (cfm50)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AirLeakRate" type="number" step="1" min="0"
                               value="<?php echo $formData['airleakrate'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Has the house been professionally air sealed?</label>

                        <p>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="ProfAirSeal"
                                       value="Yes" id="ProfAirSeal_0"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-input-option" type="radio" name="ProfAirSeal"
                                       value="No" id="ProfAirSeal_1"/>
                                No</label>
                        </p>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="AirLeakPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="AirPhotoTitle" type="text" value="<?php echo $formData['airphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="AirTightRecom" type="text" value="<?php echo $formData['airtightrecom'][0]; ?>"/>
                    </div>


                </div> <!-- Closing Div Tag for Air Tightness -->

                <!-- Div Containing Foundation 1 -->
                <div class="Found1">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Foundation 1</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Type</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundType1"
                                onchange="omniHide(this, 'None', 'found1otherfields'); omniHide(this, 'None', 'Found2HideDiv')" name="FoundType1"
																value="<?php echo $formData['foundtype1'][0]; ?>">
                            <!--<option disabled selected value> -- select an option --</option>-->
                            <option selected value="None">None</option>
                            <option value="slab_on_grade">Slab-on-Grade</option>
                            <option value="uncond_basement">Unconditioned Basement</option>
                            <option value="cond_basement">Conditioned Basement</option>
                            <option value="unvented_crawl">Unvented Crawlspace</option>
                            <option value="vented_crawl">Vented Crawlspace</option>

                        </select>
                    </div>

                    <div class="found1otherfields">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Foundation Area (sq ft)</label>
                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundArea1" type="number" min="0" max="25000"
                                   value="<?php echo $formData['foundarea1'][0]; ?>"/>
                            &nbsp; <!-- Fixes mysterious blank space -->
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Floor Insulation over Basement or Crawlspace</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundFloorInsul1">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="efwf00ca">R-0</option>
                                <option value="efwf11ca">R-11</option>
                                <option value="efwf13ca">R-13</option>
                                <option value="efwf15ca">R-15</option>
                                <option value="efwf19ca">R-19</option>
                                <option value="efwf21ca">R-21</option>
                                <option value="efwf25ca">R-25</option>
                                <option value="efwf30ca">R-30</option>
                                <option value="efwf38ca">R-38</option>

                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Foundation Wall Insulation</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundWallInsul1">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="0">R-0</option>
                                <option value="5">R-5 (slab only)</option>
                                <option value="11">R-11 (bsmt/crawl wall)</option>
                                <option value="19">R-19 (bsmt/crawl wall)</option>

                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Rim Band Joist Detail</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RimBandJoistFound1">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="Insulated and Air Sealed">Insulated and Air Sealed</option>
                                <option value="Insulated Only">Insulated Only</option>
                                <option value="Air Sealed Only">Air Sealed Only</option>
                                <option value="Not Insulated or Air Sealed">Not Insulated or Air Sealed</option>
                                <option value="No Rimband Present">No Rimband Present</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="Found1Photo" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="Found1PhotoTitle" type="text" value="<?php echo $formData['found1phototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="Found1Recom" type="text" value="<?php echo $formData['found1recom'][0]; ?>"/>
                        </div>
                    </div>

                </div> <!-- Closing Div Tag for Foundation 1 -->

                <!-- Div Containing Foundation 2 -->
                <div id="Found2" class="Found2HideDiv">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Foundation 2</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Type</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundType2" id="FoundType2"
                                onchange="toggleRequiredByInput(this, 'Foundation2Content'); omniHide(this, 'None', 'Foundation2Content')">
                            <option value="None">None</option>
                            <option value="slab_on_grade">Slab-on-Grade</option>
                            <option value="uncond_basement">Unconditioned Basement</option>
                            <option value="cond_basement">Conditioned Basement</option>
                            <option value="unvented_crawl">Unvented Crawlspace</option>
                            <option value="vented_crawl">Vented Crawlspace</option>
                        </select>
                    </div>

                    <div class="Foundation2Content">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Foundation Area (sq ft)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundArea2" type="number" min="0" step="1"
                                   value="<?php echo $formData['foundarea2'][0]; ?>"/>
                            &nbsp; <!-- Fixes mysterious blank space -->
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Floor Insulation over Basement or Crawlspace</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="FoundFloorInsul2">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="efwf00ca">R-0</option>
                                <option value="efwf11ca">R-11</option>
                                <option value="efwf13ca">R-13</option>
                                <option value="efwf15ca">R-15</option>
                                <option value="efwf19ca">R-19</option>
                                <option value="efwf21ca">R-21</option>
                                <option value="efwf25ca">R-25</option>
                                <option value="efwf30ca">R-30</option>
                                <option value="efwf38ca">R-38</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Foundation Wall Insulation</label>

                            <select class="tvt-field-input" name="FoundWallInsul2">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="0">R-0</option>
                                <option value="5">R-5 (slab only)</option>
                                <option value="11">R-11 (bsmt/crawl wall)</option>
                                <option value="19">R-19 (bsmt/crawl wall)</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Rim Band Joist Detail</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RimBandJoistFound2">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="Insulated and Air Sealed">Insulated and Air Sealed</option>
                                <option value="Insulated Only">Insulated Only</option>
                                <option value="Air Sealed Only">Air Sealed Only</option>
                                <option value="Not Insulated or Air Sealed">Not Insulated or Air Sealed</option>
                                <option value="No Rimband Present">No Rimband Present</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="Found2Photo" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="Found2PhotoTitle" type="text" value="<?php echo $formData['found2phototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="Found2Recom" type="text" value="<?php echo $formData['found2recom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Foundation 2 -->

                <!-- Div Containing Roof 1 -->

                <div id="Roof1">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Roof and Attic 1</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Roof Construction</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofConst1" id="RoofOne1"
                                onChange="toggleRequiredByInput(this,'Roof1Content'); checkValidationForRoof(true, 'RoofOne1', 'RoofOne2', 'RoofOne3');
                            omniHide(this, 'None', 'Roof2HideDiv'); omniHide(this, 'None', 'Roof1Content')"
														value="<?php echo $formData['roofconst1'][0]; ?>">
                            <option disabled selected value> -- select an option --</option>
                            <option value="None">None</option>
                            <option value="rfwf">Standard Roof</option>
                            <option value="rfrb">Roof With Radiant Barrier</option>
                            <option value="rfps">Roof With Rigid Foam Sheathing</option>
                        </select>
                    </div>

                    <div class="Roof1Content">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Exterior Finish</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofExtFin1" id="RoofOne3"
                                    onChange="checkValidationForRoof(false, 'RoofOne1', 'RoofOne2', 'RoofOne3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="co">Composition Shingles or Metal</option>
                                <option value="wo">Wood Shakes</option>
                                <option value="rc">Clay Tile</option>
                                <option value="lc">Concrete Tile</option>
                                <option value="tg">Tar & Gravel</option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <label class="tvt-field-label">Insulation Level</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofInsulLev1" id="RoofOne2"
                                    onChange="checkValidationForRoof(false, 'RoofOne1', 'RoofOne2', 'RoofOne3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="00">R-0</option>
                                <option value="11">R-11</option>
                                <option value="13">R-13</option>
                                <option value="15">R-15</option>
                                <option value="19">R-19</option>
                                <option value="21">R-21</option>
                                <option value="27">R-27</option>
                                <option value="30">R-30</option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <label class="tvt-field-label">Roof Color</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofColor1">
                                <option disabled selected value> -- select an option --</option>
                                <option value="white">White</option>
                                <option value="light">Light</option>
                                <option value="medium">Medium</option>
                                <option value="medium_dark">Medium Dark</option>
                                <option value="dark">Dark</option>
                                <option value="cool_color">Cool Color</option>
                            </select>
                        </div>

						<div class="col-sm-12 col-md-4 col-lg-4">
							<label class="tvt-field-label">Roof Area (sq ft)</label>
							<input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofArea1" type="number" value="<?php echo $formData['roofarea1'][0]; ?>"/>
						</div>


						<div class="col-sm-12 col-md-6 col-lg-6">

								<label class="tvt-field-label">Attic or Ceiling Type</label>

								<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AtticType1" onChange="toggleRequiredByInput(this,'Attic1Content');
						omniHide(this, '  None', 'Attic2Full'); omniHide(this, '  None', 'Attic1Content')">
										<option disabled selected value> -- select an option --</option>
										<option value="  None">None</option>
										<option value="cond_attic">Unconditioned Attic</option>
										<option value="vented_attic">Conditioned Attic</option>
										<option value="cath_ceiling">Cathedral Ceiling</option>
								</select>
						</div>

						<div class="Attic1Content">

							<div class="col-sm-12 col-md-12 col-lg-12">
							<label class="tvt-field-label">Attic Area</label>

							<input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AtticArea" type="text"
										 value="<?php echo $formData['atticarea'][0]; ?>"/>
							</div>

								<div class="col-sm-12 col-md-6 col-lg-6">

										<label class="tvt-field-label">Attic Floor Insulation</label>

										<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AtticFloorInsul1">
												<option disabled selected value> -- select an option --</option>
												<option value="  None">None</option>
												<option value="ecwf00">R-0</option>
												<option value="ecwf03">R-3</option>
												<option value="ecwf06">R-6</option>
												<option value="ecwf09">R-9</option>
												<option value="ecwf11">R-11</option>
												<option value="ecwf19">R-19</option>
												<option value="ecwf21">R-21</option>
												<option value="ecwf25">R-25</option>
												<option value="ecwf30">R-30</option>
												<option value="ecwf38">R-38</option>
												<option value="ecwf44">R-44</option>
												<option value="ecwf49">R-49</option>
												<option value="ecwf60">R-60</option>
										</select>

								</div>

                        <div>
                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="Roof1Photo" type="file" accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="Roof1PhotoTitle" type="text" value="<?php echo $formData['roof1phototitle'][0]; ?>"/>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="Roof1Recom" type="text" value="<?php echo $formData['roof1recom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Roof 1 -->

                <!-- Div Containing Roof 2 -->
                <div id="Roof2" class="Roof2HideDiv">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Roof and Attic 2</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">

                        <label class="tvt-field-label">Roof Construction</label>

                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofConst2" id="RoofConst2"
                                onChange="toggleRequiredByInput(this,'Roof2Content');
								checkValidationForRoof(true, 'RoofConst2', 'RoofTwo2', 'RoofTwo3');
								omniHide(this, 'None', 'Roof2Content')">
                            <option value="None" selected>None</option>
														<option value="rfwf">Standard Roof</option>
                            <option value="rfrb">Roof With Radiant Barrier</option>
                            <option value="rfps">Roof With Rigid Foam Sheathing</option>
                        </select>

                    </div>

                    <div class="Roof2Content">
                        <div class="col-sm-12 col-md-6 col-lg-6">

                            <label class="tvt-field-label">Exterior Finish</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofExtFin2" id="RoofTwo3"
                                    onChange="checkValidationForRoof(false, 'RoofConst2', 'RoofTwo2', 'RoofTwo3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="co">Composition Shingles or Metal</option>
                                <option value="wo">Wood Shakes</option>
                                <option value="rc">Clay Tile</option>
                                <option value="lc">Concrete Tile</option>
                                <option value="tg">Tar & Gravel</option>
                            </select>

                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-4">

                            <label class="tvt-field-label">Insulation Level</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofInsulLev2" id="RoofTwo2"
                                    onChange="checkValidationForRoof(false, 'RoofConst2', 'RoofTwo2', 'RoofTwo3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="00">R-0</option>
                                <option value="11">R-11</option>
                                <option value="13">R-13</option>
                                <option value="15">R-15</option>
                                <option value="19">R-19</option>
                                <option value="21">R-21</option>
                                <option value="27">R-27</option>
                                <option value="30">R-30</option>
                            </select>

                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-4">

                            <label class="tvt-field-label">Roof Color</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="RoofColor2">
                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="white">White</option>
                                <option value="light">Light</option>
                                <option value="medium">Medium</option>
                                <option value="medium_dark">Medium Dark</option>
                                <option value="dark">Dark</option>
                                <option value="cool_color">Cool Color</option>
                            </select>

                        </div>

						<div class="col-sm-12 col-md-4 col-lg-4">
							<label class="tvt-field-label">Roof Area (sq ft)</label>
							<input class="tvt-field-input" name="RoofArea2" type="number" value="<?php echo $formData['roofarea2'][0]; ?>"/>
						</div>


						<div class="col-sm-12 col-md-6 col-lg-6">

								<label class="tvt-field-label">Attic or Ceiling Type</label>

								<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AtticType2" id="AtticType2"
												onChange="toggleRequiredByInput(this,'Attic2Content');
												omniHide(this, 'None', 'Attic2Content')">
										<option value="None" selected>None</option>
										<option value="cond_attic">Unconditioned Attic</option>
										<option value="vented_attic">Conditioned Attic</option>
										<option value="cath_ceiling">Cathedral Ceiling</option>
								</select>

						</div>

						<div class="Attic2Content">

							<div class="col-sm-12 col-md-12 col-lg-12">
							<label class="tvt-field-label">Attic Area</label>

							<input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="Attic2Area" type="text"
										 value="<?php echo $formData['attic2area'][0]; ?>"/>
							</div>

								<div class="col-sm-12 col-md-6 col-lg-6">

										<label class="tvt-field-label">Attic Floor Insulation</label>

										<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="AtticFloorInsul2">
												<option disabled selected value> -- select an option --</option>
												<option value="  None">None</option>
												<option value="ecwf00">R-0</option>
												<option value="ecwf03">R-3</option>
												<option value="ecwf06">R-6</option>
												<option value="ecwf09">R-9</option>
												<option value="ecwf11">R-11</option>
												<option value="ecwf19">R-19</option>
												<option value="ecwf21">R-21</option>
												<option value="ecwf25">R-25</option>
												<option value="ecwf30">R-30</option>
												<option value="ecwf38">R-38</option>
												<option value="ecwf44">R-44</option>
												<option value="ecwf49">R-49</option>
												<option value="ecwf60">R-60</option>
										</select>
								</div>



                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>
                            <input class="tvt-field-input" name="Roof2Photo" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="Roof2PhotoTitle" type="text" value="<?php echo $formData['roof2phototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="Roof2Recom" type="text" value="<?php echo $formData['roof2recom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Roof 2 -->

                <!--Div Containing Attic 1 -->
                <!--div id="attic1">
           <!-- Closing Div Tag for Attic 2 -->

                <!-- Walls and windows (General) are meant to be filled out if all four sides of the home are the same -->

                <!-- Div Containing Walls (General) -->
                <div id="WallsGen">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Walls</h3>
                    </div>




										<div class="col-sm-12 col-md-6 col-lg-4">
												<label class="tvt-field-label">Townhouse Position</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
																onChange="checkValidationForAPI(true, 'WallsGen1', 'WallsGen2', 'WallsGen3');
																 omniHide(this, 'RightUnit', 'leftth');
																 omniHide(this, 'LeftUnit', 'rightth');
																 omniHide(this, 'CenterUnit', 'leftc'); omniHide(this, 'CenterUnit', 'rightc');">

														<option selected value="None">None/Not a townhouse</option>
														<option value="RightUnit">Right Unit</option>
														<option value="LeftUnit">Left Unit</option>
														<option value="CenterUnit">Center Unit</option>
														</select>
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Is the exterior wall construction the same on all sides?</label>
                        <p>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WallsCharacGen2"
                                       value="Yes" checked ="checked" id="WallsCharacGen_2"
                                       onclick="omniHide(this, 'Yes', 'unequalwalls'); omniHide(this, 'No', 'samewalls');"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WallsCharacGen2"
                                       value="No" id="WallsCharacGen_3"
                                       onclick="omniHide(this, 'Yes', 'unequalwalls'); omniHide(this, 'No', 'samewalls');"/>
                                No</label>
                        </p>
                    </div>

                    <div class="GeneralWallContent">

											<div class ="samewalls">

	                        <div class="col-sm-12 col-md-6 col-lg-4">
	                            <label class="tvt-field-label">Construction</label>

	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
	                                    >

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="  None">None</option>
	                                <option value="ewwf">Wood Frame</option>
	                                <option value="ewps">Wood Frame With Rigid Foam Sheathing</option>
	                                <option value="ewov">Wood Frame With Optimum Value Engineering (OVE)</option>
	                                <option value="ewbr">Structual Brick</option>
	                                <option value="ewcb">Concrete Block or Stone</option>
	                                <option value="ewsb">Straw Bale</option>
	                            </select>
	                        </div>



	                        <div class="col-sm-12 col-md-6 col-lg-4">
	                            <label class="tvt-field-label">Exterior Finish</label>


	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsExtFinGen" id="WallsGen3"
	                                    >

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="wo">Wood Siding</option>
	                                <option value="st">Stucco</option>
	                                <option value="vi">Vinyl Siding</option>
	                                <option value="al">Aluminum Siding</option>
	                                <option value="br">Brick Veneer</option>
	                                <option value="nn">None</option>
	                            </select>
	                        </div>

	                        <div class="col-sm-12 col-md-12 col-lg-4">
	                            <label class="tvt-field-label">Wall Insulation</label>

	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsInsulGen" id="WallsGenn">

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="00">R-0</option>
	                                <option value="03">R-3</option>
	                                <option value="07">R-7</option>
	                                <option value="11">R-11</option>
	                                <option value="13">R-13</option>
	                                <option value="15">R-15</option>
	                                <option value="19">R-19</option>
	                                <option value="21">R-21</option>
	                                <option value="27">R-27</option>
	                                <option value="33">R-33</option>
	                                <option value="38">R-38</option>
	                            </select>
	                        </div>
											</div>

											<div class="unequalwalls">
												<div class="front">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Construction Front</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
                                    onChange="checkValidationForAPI(true, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

                                <option disabled selected value> -- select an option --</option>
                                <option value="  None">None</option>
                                <option value="ewwf">Wood Frame</option>
                                <option value="ewps">Wood Frame With Rigid Foam Sheathing</option>
                                <option value="ewov">Wood Frame With Optimum Value Engineering (OVE)</option>
                                <option value="ewbr">Structual Brick</option>
                                <option value="ewcb">Concrete Block or Stone</option>
                                <option value="ewsb">Straw Bale</option>
                            </select>
                        </div>



                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Exterior Finish</label>


                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsExtFinGen" id="WallsGen3"
                                    onChange="checkValidationForAPI(false, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

                                <option disabled selected value> -- select an option --</option>
                                <option value="wo">Wood Siding</option>
                                <option value="st">Stucco</option>
                                <option value="vi">Vinyl Siding</option>
                                <option value="al">Aluminum Siding</option>
                                <option value="br">Brick Veneer</option>
                                <option value="nn">None</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label class="tvt-field-label">Wall Insulation</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsInsulGen" id="WallsGen2" >                              <option disabled selected value> -- select an option --</option>
                                <option value="00">R-0</option>
                                <option value="03">R-3</option>
                                <option value="07">R-7</option>
                                <option value="11">R-11</option>
                                <option value="13">R-13</option>
                                <option value="15">R-15</option>
                                <option value="19">R-19</option>
                                <option value="21">R-21</option>
                                <option value="27">R-27</option>
                                <option value="33">R-33</option>
                                <option value="38">R-38</option>
                            </select>
                        </div>
											</div>

													<div class="back">
	                        <div class="col-sm-12 col-md-6 col-lg-4">
	                            <label class="tvt-field-label">Construction Back</label>

	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
	                                    onChange="checkValidationForAPI(true, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="  None">None</option>
	                                <option value="ewwf">Wood Frame</option>
	                                <option value="ewps">Wood Frame With Rigid Foam Sheathing</option>
	                                <option value="ewov">Wood Frame With Optimum Value Engineering (OVE)</option>
	                                <option value="ewbr">Structual Brick</option>
	                                <option value="ewcb">Concrete Block or Stone</option>
	                                <option value="ewsb">Straw Bale</option>
	                            </select>
	                        </div>



	                        <div class="col-sm-12 col-md-6 col-lg-4">
	                            <label class="tvt-field-label">Exterior Finish</label>


	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsExtFinGen" id="WallsGen3"
	                                    onChange="checkValidationForAPI(false, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="wo">Wood Siding</option>
	                                <option value="st">Stucco</option>
	                                <option value="vi">Vinyl Siding</option>
	                                <option value="al">Aluminum Siding</option>
	                                <option value="br">Brick Veneer</option>
	                                <option value="nn">None</option>
	                            </select>
	                        </div>

	                        <div class="col-sm-12 col-md-12 col-lg-4">
	                            <label class="tvt-field-label">Wall Insulation</label>

	                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsInsulGen" id="WallsGen2"	                                    >

	                                <option disabled selected value> -- select an option --</option>
	                                <option value="00">R-0</option>
	                                <option value="03">R-3</option>
	                                <option value="07">R-7</option>
	                                <option value="11">R-11</option>
	                                <option value="13">R-13</option>
	                                <option value="15">R-15</option>
	                                <option value="19">R-19</option>
	                                <option value="21">R-21</option>
	                                <option value="27">R-27</option>
	                                <option value="33">R-33</option>
	                                <option value="38">R-38</option>
	                            </select>
	                        </div>
												</div>

														<div class="leftc">
														<div class="leftth" name="leftth">
														<div class="col-sm-12 col-md-6 col-lg-4">
																<label class="tvt-field-label">Construction Left</label>

																<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
																				onChange="checkValidationForAPI(true, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

																		<option disabled selected value> -- select an option --</option>
																		<option value="  None">None</option>
																		<option value="ewwf">Wood Frame</option>
																		<option value="ewps">Wood Frame With Rigid Foam Sheathing</option>
																		<option value="ewov">Wood Frame With Optimum Value Engineering (OVE)</option>
																		<option value="ewbr">Structual Brick</option>
																		<option value="ewcb">Concrete Block or Stone</option>
																		<option value="ewsb">Straw Bale</option>
																</select>
														</div>



														<div class="col-sm-12 col-md-6 col-lg-4">
																<label class="tvt-field-label">Exterior Finish</label>


																<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsExtFinGen" id="WallsGen3"
																				onChange="checkValidationForAPI(false, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

																		<option disabled selected value> -- select an option --</option>
																		<option value="wo">Wood Siding</option>
																		<option value="st">Stucco</option>
																		<option value="vi">Vinyl Siding</option>
																		<option value="al">Aluminum Siding</option>
																		<option value="br">Brick Veneer</option>
																		<option value="nn">None</option>
																</select>
														</div>

														<div class="col-sm-12 col-md-12 col-lg-4">
																<label class="tvt-field-label">Wall Insulation</label>

																<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsInsulGen" id="WallsGen2"
																				>

																		<option disabled selected value> -- select an option --</option>
																		<option value="00">R-0</option>
																		<option value="03">R-3</option>
																		<option value="07">R-7</option>
																		<option value="11">R-11</option>
																		<option value="13">R-13</option>
																		<option value="15">R-15</option>
																		<option value="19">R-19</option>
																		<option value="21">R-21</option>
																		<option value="27">R-27</option>
																		<option value="33">R-33</option>
																		<option value="38">R-38</option>
																</select>
														</div>
													</div>
												</div>

															<div class="rightc">
															<div class="rightth" name="rightth">
															<div class="col-sm-12 col-md-6 col-lg-4">
																	<label class="tvt-field-label">Construction Right</label>

																	<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsConstructGen" id="WallsGen1"
																					onChange="checkValidationForAPI(true, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

																			<option disabled selected value> -- select an option --</option>
																			<option value="  None">None</option>
																			<option value="ewwf">Wood Frame</option>
																			<option value="ewps">Wood Frame With Rigid Foam Sheathing</option>
																			<option value="ewov">Wood Frame With Optimum Value Engineering (OVE)</option>
																			<option value="ewbr">Structual Brick</option>
																			<option value="ewcb">Concrete Block or Stone</option>
																			<option value="ewsb">Straw Bale</option>
																	</select>
															</div>



															<div class="col-sm-12 col-md-6 col-lg-4">
																	<label class="tvt-field-label">Exterior Finish</label>


																	<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsExtFinGen" id="WallsGen3"
																					onChange="checkValidationForAPI(false, 'WallsGen1', 'WallsGen2', 'WallsGen3')">

																			<option disabled selected value> -- select an option --</option>
																			<option value="wo">Wood Siding</option>
																			<option value="st">Stucco</option>
																			<option value="vi">Vinyl Siding</option>
																			<option value="al">Aluminum Siding</option>
																			<option value="br">Brick Veneer</option>
																			<option value="nn">None</option>
																	</select>
															</div>

															<div class="col-sm-12 col-md-12 col-lg-4">
																	<label class="tvt-field-label">Wall Insulation</label>

																	<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WallsInsulGen" id="WallsGen2"
																					>

																			<option disabled selected value> -- select an option --</option>
																			<option value="00">R-0</option>
																			<option value="03">R-3</option>
																			<option value="07">R-7</option>
																			<option value="11">R-11</option>
																			<option value="13">R-13</option>
																			<option value="15">R-15</option>
																			<option value="19">R-19</option>
																			<option value="21">R-21</option>
																			<option value="27">R-27</option>
																			<option value="33">R-33</option>
																			<option value="38">R-38</option>
																	</select>
															</div>
														</div>
													</div>
												</div>


												<div class="wallphotos">
												<div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="WallsPhoto1" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="WallsPhoto1Title" type="text" value="<?php echo $formData['wallsgenphototitle'][0]; ?>"/>
                        </div>
											</div>

												<div class="row">
												<div class="col-sm-12 col-md-6 col-lg-6 photo_and_title2">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="WallsPhoto2" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title2">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="WallsPhoto2Title" type="text" value="<?php echo $formData['wallsgenphototitle'][1]; ?>"/>
                        </div>
											</div>

												<div class="row">
												<div class="col-sm-12 col-md-6 col-lg-6 photo_and_title3">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="WallsPhoto3" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title3">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="WallsPhoto3Title" type="text" value="<?php echo $formData['wallsgenphototitle'][2]; ?>"/>
                        </div>
											</div>

												<div class="row">
												<div class="col-sm-12 col-md-6 col-lg-6 photo_and_title4">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="WallsPhoto4" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title4">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="WallsPhoto4Title" type="text" value="<?php echo $formData['wallsgenphototitle'][3]; ?>"/>
                        </div>
											</div>
										</div>


                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="WallsGenRecom" type="text" value="<?php echo $formData['wallsgenrecom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Walls (General) -->

								<!-- Div Containing Skylights -->
                <div id="Skylight">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Skylights</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Does the home have a skylight?</label>

                        <p>
                            <label class="tvt-input-option HomeEnergyScoreReq HollandReq">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="SkylightHave" value="Yes"
                                       id="SkylightHave_0" onClick="omniHide(this, 'No', 'Skylight')"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="SkylightHave" value="No"
                                       id="SkylightHave_1" onClick="omniHide(this, 'No', 'Skylight')" checked  />
                                No</label>
                        </p>

                    </div>

                    <div class="Skylight">

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label"> Total Skylight Area (sq ft)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="SkylightArea" type="number"
                                   value="<?php echo $formData['skylightarea'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Number of Panels</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="SkylightNumPanels" type="number"
                                   value="<?php echo $formData['skylightnumpanels'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                            <p>
                                <label class="tvt-input-option">

                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="SkylightKnownUandSHGC"
                                           value="Yes" id="SkylightKnownUandSHGC_0"
                                           onClick="omniHide(this, 'Yes', 'SkylightGeneralInfo'); omniHide(this, 'No', 'SkylightSpecificInfo')"/>
                                    Yes</label>

                                <label class="tvt-input-option">
                                    <input class="tvt-field-input" type="radio" name="SkylightKnownUandSHGC"
                                           value="No" id="SkylightKnownUandSHGC_1"
                                           onClick="omniHide(this, 'Yes', 'SkylightGeneralInfo'); omniHide(this, 'No', 'SkylightSpecificInfo')" checked  />
                                    No</label>
                            </p>
                        </div>

                        <div class="SkylightGeneralInfo">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label class="tvt-field-label">Pane Type</label>
                                <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="SkylightPanes" id="skylight1"
                                        onChange="checkValidationForWindows(true, false, 'skylight1', 'skylight3', 'skylight2')">
                                    <option disabled selected value> -- select an option --</option>
<<<<<<< HEAD
                                    <!--option value="  None">None</option-->
=======
>>>>>>> refs/remotes/origin/Sezay
                                    <option value="s">Single-pane</option>
                                    <option value="d">Double-pane</option>
                                    <option value="thmabw">Triple-pane</option>
                                </select>
                            </div>

														<div class="col-sm-12 col-md-6 col-lg-4">
															<label class="tvt-field-label">Glazing Type</label>
															<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="SkylightGlaze" id="skylight2"
																			onChange="checkValidationForWindows(false, true, 'skylight1', 'skylight2', 'skylight3')">
																	<option disabled selected value> -- select an option --</option>
																	<option value="c">Clear</option>
																	<option value="t">Tinted</option>
																	<option value="se">Solar-control Low-E</option>
																	<option value="sea">Solar-control Low-E, Argon Gas Fill</option>
																	<option value="pe">Insulating Low-E</option>
																	<option value="pea">Insulating Low-E, Argon Gas Fill</option>
															</select>
													</div>

													<div class="col-sm-12 col-md-12 col-lg-4">
															<label class="tvt-field-label">Frame Type</label>

															<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="SkylightFrame" id="skylight3"
																			onChange="checkValidationForWindows(false, false, 'skylight1', 'skylight2', 'skylight3')">
																	<option disabled selected value> -- select an option --</option>
																	<option value="aa">Aluminium</option>
																	<option value="ab">Aluminium With Thermal Break</option>
																	<option value="aw">Wood or Vinyl</option>
															</select>
													</div>



                        </div>

                        <div class="SkylightSpecificInfo">
                            <div class="col-sm-12 col-md-6 col-lg-6">

                                <label class="tvt-field-label">U-Factor (from 0.01-5)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="SkylightUFact" type="number"
                                       value="<?php echo $formData['skylightufact'][0]; ?>"
                                       step=".01" min="0" max="5"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label class="tvt-field-label">SHGC (from 0-1)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="SkylightSHGC" type="number"
                                       value="<?php echo $formData['skylightshgc'][0]; ?>"
                                       step=".01" min="0" max="1"/>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="SkylightPhoto" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="SkylightPhotoTitle" type="text" value="<?php echo $formData['skylightphototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="SkylightRecom" type="text" value="<?php echo $formData['skylightrecom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Skylights -->

                <!-- Div Containing Windows (General) -->
                <div id="WindowsGen">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Windows (General)</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Do these characteristics apply to all windows?</label>

                        <p>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WindowsCharacGen" value="Yes"
                                       id="WindowCharacGen_0" onClick="omniHide(this, 'Yes', 'Windows'); omniHide(this,'No', 'GeneralWindowContent')"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WindowsCharacGen" value="No"
                                       id="WindowCharacGen_1" onClick="omniHide(this, 'Yes', 'Windows'); omniHide(this, 'No', 'GeneralWindowContent')"/>
                                No</label>
                        </p>
                    </div>

                    <div class="GeneralWindowContent">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-sub-group">Window Area (sq ft)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsAreaGen1" type="number"max="340" min="1"
                                   value="<?php echo $formData['windowsareagen1'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                            <p>

                                <label class="tvt-input-option">

                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WinGenKnownUandSHGC"
                                           value="Yes" id="WinGenKnownUandSHGC_0"
                                           onClick="omniHide(this, 'Yes', 'GenWindowsGeneralInfo'); omniHide(this,'No', 'GenWindowsSpecificInfo')"/>
                                    Yes</label>
                                <label class="tvt-input-option">
                                    <input class="tvt-field-input" type="radio" name="WinGenKnownUandSHGC"
                                           value="No" id="WinGenKnownUandSHGC_1"
                                           onClick="omniHide(this, 'Yes', 'GenWindowsGeneralInfo'); omniHide(this,'No', 'GenWindowsSpecificInfo')" checked  />
                                    No</label>
                            </p>
                        </div>

                        <div class="GenWindowsGeneralInfo">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label class="tvt-field-label">Pane Type</label>

                                <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsPanesGen" id="WinGen1"
                                        onChange="checkValidationForWindows(true, false, 'WinGen1', 'WinGen2', 'WinGen3')">
                                    <option disabled selected value> -- select an option --</option>
<<<<<<< HEAD
                                    <!--option value="  None">None</option-->
=======
>>>>>>> refs/remotes/origin/Sezay
                                    <option value="s">Single-pane</option>
                                    <option value="d">Double-pane</option>
                                    <option value="thmabw">Triple-pane</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label class="tvt-field-label">Glazing Type</label>

                                <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsGlazeGen" id="WinGen2"
                                        onChange="checkValidationForWindows(false, true, 'WinGen1', 'WinGen2', 'WinGen3')">
                                    <option disabled selected value> -- select an option --</option>
                                    <option value="c">Clear</option>
                                    <option value="t">Tinted</option>
                                    <option value="se">Solar-control Low-E</option>
                                    <option value="sea">Solar-control Low-E, Argon Gas Fill</option>
                                    <option value="pe">Insulating Low-E</option>
                                    <option value="pea">Insulating Low-E, Argon Gas Fill</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-4">
                                <label class="tvt-field-label">Frame Type</label>

                                <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsFrameGen" id="WinGen3"
                                        onChange="checkValidationForWindows(false, false, 'WinGen1', 'WinGen2', 'WinGen3')">
                                    <option disabled selected value> -- select an option --</option>
                                    <option value="aa">Aluminium</option>
                                    <option value="ab">Aluminium With Thermal Break</option>
                                    <option value="aw">Wood or Vinyl</option>
                                </select>
                            </div>

                        </div>

                        <div class="GenWindowsSpecificInfo">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label class="tvt-field-label">U-Factor (from 0.01-5)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="WindowsUFactGen" type="number"
                                       value="<?php echo $formData['windowsufactgen'][0]; ?>"
                                       step=".01" min="0" max="5"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label class="tvt-field-label">SHGC (from 0-1)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="WindowsSHGCGen" type="number"
                                       value="<?php echo $formData['windowsshgcgen'][0]; ?>"
                                       step=".01" min="0" max="1"/>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="WindowsGenPhoto" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="WindowsGenPhotoTitle" type="text" value="<?php echo $formData['windowsgenphototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="WindowsGenRecom" type="text" value="<?php echo $formData['windowsgenrecom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Windows (General) -->



                <!-- These divs contain fields for windows and walls that are meant to be filled out if each side of the home are different -->




                <!-- Div containing Windows (Front) -->
                <div class="Windows" name="FrontWindow">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Windows (Front)</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Window Area (sq ft)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsAreaFront" type="number" max="340" min="1"
                               value="<?php echo $formData['windowsareafront'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                        <p>
                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WinFrontKnownUandSHGC"
                                       value="Yes" id="WinFrontKnownUandSHGC_0"
                                       onClick="omniHide(this, 'Yes', 'FrontWindowsGeneralInfo'); omniHide(this, 'No', 'FrontWindowsSpecificInfo')"/>
                                Yes</label>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WinFrontKnownUandSHGC"
                                       value="No" id="WinFrontKnownUandSHGC_1"
                                       onClick="omniHide(this, 'Yes', 'FrontWindowsGeneralInfo'); omniHide(this, 'No', 'FrontWindowsSpecificInfo')"
                                       checked />
                                No</label>
                        </p>
                    </div>

                    <div class="FrontWindowsGeneralInfo">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Pane Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsPanesFront" id="WinFront1"
                                    onChange="checkValidationForWindows(true, false, 'WinFront1', 'WinFront2', 'WinFront3')">
                                <option disabled selected value> -- select an option --</option>
																<!---
                                <option value="  None">None</option>
															-->
                                <option value="s">Single-pane</option>
                                <option value="d">Double-pane</option>
                                <option value="thmabw">Triple-pane</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Glazing Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsGlazeFront" id="WinFront2"
                                    onChange="checkValidationForWindows(false, true, 'WinFront1', 'WinFront2', 'WinFront3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="c">Clear</option>
                                <option value="t">Tinted</option>
                                <option value="se">Solar-control Low-E</option>
                                <option value="sea">Solar-control Low-E, Argon Gas Fill</option>
                                <option value="pe">Insulating Low-E</option>
                                <option value="pea">Insulating Low-E, Argon Gas Fill</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label class="tvt-field-label">Frame Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsFrameFront" id="WinFront3"
                                    onChange="checkValidationForWindows(false, false, 'WinFront1', 'WinFront2', 'WinFront3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="aa">Aluminium</option>
                                <option value="ab">Aluminium With Thermal Break</option>
                                <option value="aw">Wood or Vinyl</option>
                            </select>
                        </div>

                    </div>

                    <div class="FrontWindowsSpecificInfo">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">U-Factor (from 0.01-5)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="WindowsUFactFront" type="number"
                                   value="<?php echo $formData['windowsufactfront'][0]; ?>"
                                   step=".01" min="0" max="5"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">SHGC (from 0-1)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="WindowsSHGCFront" type="number"
                                   value="<?php echo $formData['windowsshgcfront'][0]; ?>"
                                   step=".01" min="0" max="1"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WindowsFrontPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WindowsFrontPhotoTitle" type="text" value="<?php echo $formData['windowsfrontphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WindowsFrontRecom" type="text" value="<?php echo $formData['windowsfrontrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Windows (Front) -->



                <!-- Div containing Windows (Back) -->
                <div class="Windows" name="BackWindow">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Windows (Back)</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Window Area (sq ft)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsAreaBack" type="number"max="340" min="1"
                               value="<?php echo $formData['windowsareaback'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                        <p>
                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WinBackKnownUandSHGC"
                                       value="Yes" id="WinBackKnownUandSHGC_0"
                                       onClick="omniHide(this, 'Yes', 'BackWindowsGeneralInfo'); omniHide(this,'No', 'BackWindowsSpecificInfo')"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WinBackKnownUandSHGC"
                                       value="No" id="WinBackKnownUandSHGC_1"
                                       onClick="omniHide(this, 'Yes', 'BackWindowsGeneralInfo'); omniHide(this,'No', 'BackWindowsSpecificInfo')" checked />
                                No</label>
                        </p>
                    </div>

                    <div class="BackWindowsGeneralInfo">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Pane Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsPanesBack" id="WinBack1"
                                    onChange="checkValidationForWindows(true, false, 'WinBack1', 'WinBack2', 'WinBack3')">
                                <option disabled selected value> -- select an option --</option>
																<!-- Sezay test Commit
                                <option value="  None">None</option>
															-->
                                <option value="s">Single-pane</option>
                                <option value="d">Double-pane</option>
                                <option value="thmabw">Triple-pane</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label class="tvt-field-label">Glazing Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsGlazeBack" id="WinBack2"
                                    onChange="checkValidationForWindows(false, true, 'WinBack1', 'WinBack2', 'WinBack3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="c">Clear</option>
                                <option value="t">Tinted</option>
                                <option value="se">Solar-control Low-E</option>
                                <option value="sea">Solar-control Low-E, Argon Gas Fill</option>
                                <option value="pe">Insulating Low-E</option>
                                <option value="pea">Insulating Low-E, Argon Gas Fill</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Frame Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsFrameBack" id="WinBack3"
                                    onChange="checkValidationForWindows(false, false, 'WinBack1', 'WinBack2', 'WinBack3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="aa">Aluminium</option>
                                <option value="ab">Aluminium With Thermal Break</option>
                                <option value="aw">Wood or Vinyl</option>
                            </select>
                        </div>

                    </div>

                    <div class="BackWindowsSpecificInfo">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">U-Factor (from 0.01-5)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="WindowsUFactBack" type="number"
                                   value="<?php echo $formData['windowsufactback'][0]; ?>"
                                   step=".01" min="0" max="5"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">SHGC (from 0-1)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="WindowsSHGCBack" type="number"
                                   value="<?php echo $formData['windowsshgcback'][0]; ?>"
                                   step=".01" min="0" max="1"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WindowsBackPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WindowsBackPhotoTitle" type="text" value="<?php echo $formData['windowsbackphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WindowsBackRecom" type="text" value="<?php echo $formData['windowsbackrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Windows (Back) -->



                <!-- Div containing Windows (Right) -->
                <div class="Windows" name="RightWindow"> <!-- Closing Div Tag for Walls (Right) -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Windows (Right)</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Window Area (sq ft)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsAreaRight" type="number" max="340" min="1"
                               value="<?php echo $formData['windowsarearight'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                        <p>
                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WinRightKnownUandSHGC"
                                       value="Yes" id="WinRightKnownUandSHGC_0"
                                       onClick="omniHide(this, 'Yes', 'RightWindowsGeneralInfo'); omniHide(this,'No', 'RightWindowsSpecificInfo')"/>
                                Yes</label>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WinRightKnownUandSHGC"
                                       value="No" id="WinRightKnownUandSHGC_1"
                                       onClick="omniHide(this, 'Yes', 'RightWindowsGeneralInfo'); omniHide(this,'No', 'RightWindowsSpecificInfo')"
                                       checked />
                                No</label>
                        </p>
                    </div>

                    <div class="RightWindowsGeneralInfo">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Pane Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsPanesRight" id="WinRight1"
                                    onChange="checkValidationForWindows(true, false, 'WinRight1', 'WinRight2', 'WinRight3')">
                                <option disabled selected value> -- select an option --</option>
																<!--
                                <option value="  None">None</option>
															-->
                                <option value="s">Single-pane</option>
                                <option value="d">Double-pane</option>
                                <option value="thmabw">Triple-pane</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Glazing Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsGlazeRight" id="WinRight2"
                                    onChange="checkValidationForWindows(false, true, 'WinRight1', 'WinRight2', 'WinRight3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="c">Clear</option>
                                <option value="t">Tinted</option>
                                <option value="se">Solar-control Low-E</option>
                                <option value="sea">Solar-control Low-E, Argon Gas Fill</option>
                                <option value="pe">Insulating Low-E</option>
                                <option value="pea">Insulating Low-E, Argon Gas Fill</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label class="tvt-field-label">Frame Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsFrameRight" id="WinRight3"
                                    onChange="checkValidationForWindows(false, false, 'WinRight1', 'WinRight2', 'WinRight3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="aa">Aluminium</option>
                                <option value="ab">Aluminium With Thermal Break</option>
                                <option value="aw">Wood or Vinyl</option>
                            </select>
                        </div>

                    </div>

                    <div class="RightWindowsSpecificInfo">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">U-Factor (from 0.01-5)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="WindowsUFactRight" type="number"
                                   value="<?php echo $formData['windowsufactright'][0]; ?>"
                                   step=".01" min="0" max="5"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">SHGC (from 0-1)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="WindowsSHGCRight" type="number"
                                   value="<?php echo $formData['windowsshgcright'][0]; ?>"
                                   step=".01" min="0" max="1"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WindowsRightPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WindowsRightPhotoTitle" type="text" value="<?php echo $formData['windowsrightphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WindowsRightRecom" type="text" value="<?php echo $formData['windowsrightrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Windows (Right) -->



                <!-- Div containing Windows (Left) -->
                <div class="Windows" name="LeftWindow">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Windows (Left)</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Window Area (sq ft)</label>

                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsAreaLeft" type="number" max="340" min="1"
                               value="<?php echo $formData['windowsarealeft'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Is the U-Factor and SHGC known?</label>
                        <p>
                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WinLeftKnownUandSHGC"
                                       value="Yes" id="WinLeftKnownUandSHGC_0"
                                       onClick="omniHide(this, 'Yes', 'LeftWindowsGeneralInfo'); omniHide(this, 'No', 'LeftWindowsSpecificInfo')"/>
                                Yes</label>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="WinLeftKnownUandSHGC"
                                       value="No" id="WinLeftKnownUandSHGC_1"
                                       onClick="omniHide(this, 'Yes', 'LeftWindowsGeneralInfo'); omniHide(this, 'No', 'LeftWindowsSpecificInfo')" checked />
                                No</label>
                        </p>
                    </div>

                    <div class="LeftWindowsGeneralInfo">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Pane Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsPanesLeft" id="WinLeft1"
                                    onChange="checkValidationForWindows(true, false, 'WinLeft1', 'WinLeft2', 'WinLeft3')">
                                <option disabled selected value> -- select an option --</option>
																<!--
                                <option value="  None">None</option>
															-->
                                <option value="s">Single-pane</option>
                                <option value="d">Double-pane</option>
                                <option value="thmabw">Triple-pane</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label class="tvt-field-label">Glazing Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsGlazeLeft" id="WinLeft2"
                                    onChange="checkValidationForWindows(false, true, 'WinLeft1', 'WinLeft2', 'WinLeft3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="c">Clear</option>
                                <option value="t">Tinted</option>
                                <option value="se">Solar-control Low-E</option>
                                <option value="sea">Solar-control Low-E, Argon Gas Fill</option>
                                <option value="pe">Insulating Low-E</option>
                                <option value="pea">Insulating Low-E, Argon Gas Fill</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label class="tvt-field-label">Frame Type</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WindowsFrameLeft" id="WinLeft3"
                                    onChange="checkValidationForWindows(false, false, 'WinLeft1', 'WinLeft2', 'WinLeft3')">
                                <option disabled selected value> -- select an option --</option>
                                <option value="aa">Aluminium</option>
                                <option value="ab">Aluminium With Thermal Break</option>
                                <option value="aw">Wood or Vinyl</option>
                            </select>
                        </div>

                    </div>

                    <div class="LeftWindowsSpecificInfo">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">U-Factor (from 0.01-5):</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="UFactor" name="WindowsUFactLeft" type="number"
                                   value="<?php echo $formData['windowsufactleft'][0]; ?>"
                                   step=".01" min="0" max="5"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">SHGC (from 0-1)</label>

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="SHGC" name="WindowsSHGCLeft" type="number"
                                   value="<?php echo $formData['windowsshgcleft'][0]; ?>"
                                   step=".01" min="0" max="1"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WindowsLeftPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WindowsLeftPhotoTitle" type="text" value="<?php echo $formData['windowsleftphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WindowsLeftRecom" type="text" value="<?php echo $formData['windowsleftrecom'][0]; ?>"/>
                    </div>
                </div> <!-- Closing Div Tag for Windows (Left) -->

            </div> <!-- Closing Div Tag for Structure SECTION -->

        </div> <!-- Closing Div Tag for Structure TAB SECTION -->

        <!-- Div Containing System TAB SECTION -->
        <div id="System" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing System SECTION -->
            <div>

                <!-- Div Containing Heating Systems SECTION -->
                <div class="tvt-section-group">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h2 class="tvt-section-title"><span class="glyphicon glyphicon-fire"></span> Heating</h2>
                    </div>

                    <!-- Div Containing Heating (System 1) -->
                    <div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Heating (System 1)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Type of Heating System</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysType1" id="heatType1"
                                    onchange="omniHide(this, 'None', 'Heating1'); omniHide(this, 'None', 'Heating2Div'); ">
                                <option value="None">None</option>
                                <option value="central_furnace:natural_gas">Central Gas Furnace</option>
                                <option value="wall_furnace:natural_gas">Room (Through-the-wall) Gas Furnace</option>
                                <option value="central_furnace:lpg">Propane (LPG) Furnace</option>
                                <option value="central_furnace:fuel_oil">Oil Furnace</option>
                                <option value="central_furnace:electric">Electric Furnace</option>
                                <option value="heat_pump:electric">Electric Heat Pump</option>
																<option value="heat_pump:Minisplitductless">Minisplit (ductless) Heat Pump</option>
                                <option value="baseboard:electric">Electric Baseboard Heater</option>
                                <option value="boiler:natural_gas">Gas Boiler</option>
                                <option value="boiler:fuel_oil">Oil Boiler</option>
                                <option value="boiler:lpg">Propane (LPG) Boiler</option>
                                <option value="gchp">Ground Coupled Heat Pump</option>
                                <option value="wood_stove">Wood Stove</option>
                                <option value="wood_stove:pellet_wood">Pellet Stove</option>
                            </select>
                        </div>

                        <div class="Heating1">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Do you know the heating system's
                                    AFUE?</label><!--todo: make this hide the effic value input below if no. COPY what is done for Cooling System 2-->

                                <p>
                                    <label class="tvt-input-option">

                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="HeatSysEffic1"
                                               value="Yes" id="HeatSysEffic1_0" checked="checked" onClick="omniHide(this, 'No', 'Heat1EfficencyVal');
                                                 omniHide(this, 'Yes', 'Heat1YearInstalled')"/>
                                        Yes</label>

                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input" type="radio" name="HeatSysEffic1"
                                               value="No" id="HeatSysEffic1_1" onClick="omniHide(this, 'No', 'Heat1EfficencyVal');
                                                 omniHide(this, 'Yes', 'Heat1YearInstalled')" checked />
                                        No</label>
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Heat1EfficencyVal">
                                <label class="tvt-field-label">Efficiency Value (AFUE)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysEfficVal1" type="number" step=".01" min=".1"
                                       max=".967"
                                       value="<?php echo $formData['heatsysefficval1'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Heat1YearInstalled">
                                <label class="tvt-field-label">Year Installed</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysYearInst1" type="number" min="1970"
                                       value="<?php echo $formData['heatsysyearinst1'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="HeatingSystem1Photo" type="file"
                                       accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="HeatSys1PhotoTitle" type="text" value="<?php echo $formData['heatsys1phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="HeatingSystem1Recom" type="text"
                                       value="<?php echo $formData['heatingsystem1recom'][0]; ?>"/>
                            </div>

                        </div>

                    </div> <!-- Closing Div Tag for Heating (System 1) -->

                    <!-- Div Containing Heating (System 2) -->
                    <div class="Heating2Div">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Heating (System 2)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <label class="tvt-field-label">Type of Heating System</label>

														<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysType1" id="heatType1"
	                                    onchange="omniHide(this, 'None', 'Heating1'); omniHide(this, 'None', 'Heating2'); ">
	                                <option selected value="None">None</option>
	                                <option value="central_furnace:natural_gas">Central Gas Furnace</option>
	                                <option value="wall_furnace:natural_gas">Room (Through-the-wall) Gas Furnace</option>
	                                <option value="central_furnace:lpg">Propane (LPG) Furnace</option>
	                                <option value="central_furnace:fuel_oil">Oil Furnace</option>
	                                <option value="central_furnace:electric">Electric Furnace</option>
	                                <option value="heat_pump:electric">Electric Heat Pump</option>
																	<option value="heat_pump:Minisplitductless">Minisplit (ductless) Heat Pump</option>
	                                <option value="baseboard:electric">Electric Baseboard Heater</option>
	                                <option value="boiler:natural_gas">Gas Boiler</option>
	                                <option value="boiler:fuel_oil">Oil Boiler</option>
	                                <option value="boiler:lpg">Propane (LPG) Boiler</option>
	                                <option value="gchp">Ground Coupled Heat Pump</option>
	                                <option value="wood_stove">Wood Stove</option>
	                                <option value="wood_stove:pellet_wood">Pellet Stove</option>
	                            </select>

                        </div>

                        <div class="Heating2">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Do you know the heating system's
                                    AFUE?</label>

                                <p>
                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="HeatSysEffic2"
                                               value="Yes" id="HeatSysEffic2_0" checked="checked" onClick="omniHide(this, 'No', 'Heat2EfficencyVal');
                                                 omniHide(this, 'Yes', 'Heat2YearInstalled')"/>
                                        Yes</label>

                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input" type="radio" name="HeatSysEffic2"
                                               value="No" id="HeatSysEffic2_1" onClick="omniHide(this, 'No', 'Heat2EfficencyVal');
                                                 omniHide(this, 'Yes', 'Heat2YearInstalled')" checked />
                                        No</label>
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Heat2EfficencyVal">
                                <label class="tvt-field-label">Efficiency Value (AFUE)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysEfficVal2" type="number" step=".01" min=".1"
                                       max=".967"
                                       value="<?php echo $formData['heatsysefficval2'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Heat2YearInstalled">
                                <label class="tvt-field-label">Year Installed</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HeatSysYearInst2" type="number" min="1970"
                                       value="<?php echo $formData['heatsysyearinst2'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>
                                <input class="tvt-field-input" name="HeatingSystem2Photo" type="file"
                                       accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="HeatSys2PhotoTitle" type="text" value="<?php echo $formData['heatsys2phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="HeatingSystem2Recom" type="text"
                                       value="<?php echo $formData['heatingsystem2recom'][0]; ?>"/>
                            </div>

                        </div>

                    </div> <!-- Closing Div Tag for Heating (System 2) -->

                </div> <!-- Closing Div Tag for Heating Systems Section -->

                <!-- Div Containing Cooling Systems SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h2 class="tvt-section-title"><span class="glyphicon glyphicon-ice-lolly-tasted"></span> Cooling</h2>
                    </div>

                    <!-- Div Containing Cooling (System 1) -->
                    <div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Cooling (System 1)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Type of Cooling System</label>


                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysType1" id="coolType1"
                                    onchange="omniHide(this, 'None', 'Cooling1'); omniHide(this, 'None', 'Cooling2Div')" ;>
                                <option value="None">None</option>
                                <option value="packaged_dx">Central Air Conditioner</option>
                                <option value="split_dx">Room Air Conditioner</option>
                                <option value="heat_pump">Electric Heat Pump</option>
																<option value="heat_pump:CoolingMinisplitductless">Minisplit (ductless) Heat Pump</option>
																<option value="ghcp">Ground Coupled Heat Pump</option>
																<option value="dev_cool">Direct Evaporative Cooling</option>
                            </select>
                        </div>

                        <div class="Cooling1">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Do you know the cooling system's
                                    SEER?</label>

                                <p>
                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="CoolSysEffic1"
                                               value="Yes" id="CoolSysEffic1_0" checked="checked" onClick="omniHide(this, 'No', 'Cooling1EfficencyVal');
                                                 omniHide(this, 'Yes', 'Cooling1YearInstalled')"/>
                                        Yes</label>

                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input" type="radio" name="CoolSysEffic1"
                                               value="No" id="CoolSysEffic1_1" onClick="omniHide(this, 'No', 'Cooling1EfficencyVal');
                                                 omniHide(this, 'Yes', 'Cooling1YearInstalled')" checked />
                                        No</label>
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Cooling1EfficencyVal">
                                <label class="tvt-field-label">Efficiency Value (SEER)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysEfficVal1" type="number" step="1" min="1" max="30"
                                       value="<?php echo $formData['coolsysefficval1'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Cooling1YearInstalled">
                                <label class="tvt-field-label">Year Installed</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysYearInst1" type="number" min="1970"
                                       value="<?php echo $formData['coolsysyearinst1'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="CoolSys1Photo" type="file" accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="CoolSys1PhotoTitle" type="text" value="<?php echo $formData['coolsys1phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="CoolSys1Recom" type="text" value="<?php echo $formData['coolsys1recom'][0]; ?>"/>
                            </div>

                        </div>
                    </div> <!-- Closing Div Tag for Cooling (System 1) -->

                    <!-- Div containing Cooling (System 2) -->
                    <div class="Cooling2Div">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Cooling (System 2)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Type of Cooling System</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysType2" id="coolType2"
                                    onChange="omniHide(this, 'None', 'Cooling2')">
                                <option value="None">None</option>
                                <option value="packaged_dx">Central Air Conditioner</option>
                                <option value="split_dx">Room Air Conditioner</option>
                                <option value="heat_pump">Electric Heat Pump</option>
                                <option value="ghcp">Ground Coupled Heat Pump</option>
                            </select>
                        </div>

                        <div class="Cooling2">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Do you know the cooling system's
                                    SEER?</label>

                                <p>
                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="CoolSysEffic2"
                                               value="Yes" id="CoolSysEffic2_0" checked="checked" onClick="omniHide(this, 'No', 'Cooling2EfficencyVal');
                                               omniHide(this, 'Yes', 'Cooling2YearInstalled')"/>
                                        Yes</label>

                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input" type="radio" name="CoolSysEffic2"
                                               value="No" id="CoolSysEffic2_1" onClick="omniHide(this, 'No', 'Cooling2EfficencyVal');
                                               omniHide(this, 'Yes', 'Cooling2YearInstalled')" checked />
                                        No</label>
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Cooling2EfficencyVal">
                                <label class="tvt-field-label">Efficiency Value (SEER)</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysEfficVal2" type="number" step="1" min="1" max="30"
                                       value="<?php echo $formData['coolsysefficval2'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 Cooling2YearInstalled">
                                <label class="tvt-field-label">Year Installed</label>

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="CoolSysYearInst2" type="number" min="1970"
                                       value="<?php echo $formData['coolsysyearinst2'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="CoolSys2Photo" type="file" accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="CoolSys2PhotoTitle" type="text" value="<?php echo $formData['coolsys2phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="CoolSys2Recom" type="text" value="<?php echo $formData['coolsys2recom'][0]; ?>"/>
                            </div>

                        </div>
                    </div> <!-- Closing Div Tag for Cooling (System 2) -->

                </div> <!-- Closing Div Tag for Cooling Systems SECTION -->

                <!-- Div Containing Duct Systems SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h2 class="tvt-section-title"><span class="glyphicon glyphicon-tree-deciduous"></span> Duct</h2>
                    </div>

                    <!-- Div Containing Duct (System 1) -->
                    <div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Duct (System 1)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label HomeEnergyScoreReq HollandReq">Does the home have a duct system?</label>

                            <p>
                                <label class="tvt-input-option">
                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="Duct1Have" value="Yes"
                                           id="Duct1Have_0" onClick="omniHide(this, 'No', 'Duct1Content')" checked />
                                    Yes</label>

                                <label class="tvt-input-option">
                                    <input class="tvt-field-input" type="radio" name="Duct1Have" value="No"
                                           id="Duct1Have_1" onClick="omniHide(this, 'No', 'Duct1Content')"/>
                                    No</label>
                            </p>

                        </div>

                        <div class="Duct1Content">
                            <div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label class="tvt-field-label">Duct Location 1</label>

                                    <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc1_1">
                                        <option disabled selected value> -- select an option --</option>
                                        <option value="cond_space">Conditioned Space</option>
                                        <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                        <option value="vented_crawl">Vented Crawlspace</option>
                                        <option value="uncond_attic">Unconditioned Attic</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label class="tvt-field-label">Percentage of Duct in this location</label>

                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="ductSysPerc1.1" tvt-percent="1" name="DuctSysPerc1_1"
                                           type="number"
                                           min="0" max="100"
                                           value="<?php echo $formData['ductsysperc1_1'][0]; ?>" onchange="verifyDuctPercentage(1)"/>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="tvt-field-label">Are ducts sealed?</label>

                                    <p>
                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysSeal1_1"
                                                   value="Yes" id="DuctSysSeal1.1_0"/>
                                            Yes</label>

                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input" type="radio" name="DuctSysSeal1_1" value="No"
                                                   id="DuctSysSeal1.1_1"/>
                                            No</label>
                                    </p>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="tvt-field-label">Are ducts insulated?</label>

                                    <p>
                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul1_1"
                                                   value="Yes" id="DuctSysInsul1.1_0"/>
                                            Yes</label>

                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input" type="radio" name="DuctSysInsul1_1" value="No"
                                                   id="DuctSysInsul1.1_1"/>
                                            No</label>
                                    </p>
                                </div>

                                <!-- Parent Parent of Duct 2 Percent -->
                                <div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label class="tvt-field-label">Duct Location 2</label>

                                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc1_2">

                                            <option disabled selected value> -- select an option --</option>
                                            <option value="cond_space">Conditioned Space</option>
                                            <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                            <option value="vented_crawl">Vented Crawlspace</option>
                                            <option value="uncond_attic">Unconditioned Attic</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6" id="DuctSys1PercInput2">
                                        <label class="tvt-field-label">Percentage of Duct in this location</label>

                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="ductSysPerc1.2" name="DuctSysPerc1_2" tvt-percent="1"
                                               type="number" min="0" max="100"
                                               value="<?php echo $formData['ductsysperc1_2'][0]; ?>"
                                               onChange="verifyDuctPercentage(1)"/>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="tvt-field-label">Are ducts sealed?</label>

                                        <p>
                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysSeal1_2" value="Yes"
                                                       id="DuctSysSeal1.2_0"/>
                                                Yes</label>

                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input" type="radio" name="DuctSysSeal1_2" value="No"
                                                       id="DuctSysSeal1.2_1"/>
                                                No</label>

                                        </p>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="tvt-field-label">Are ducts insulated?</label>

                                        <p>
                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul1_2" value="Yes"
                                                       id="DuctSysInsul1.2_0"/>
                                                Yes</label>

                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input" type="radio" name="DuctSysInsul1_2" value="No"
                                                       id="DuctSysInsul1.2_1"/>
                                                No</label>
                                        </p>
                                    </div>

                                    <div>
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <label class="tvt-field-label">Duct Location 3</label>

                                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc1_3">
                                                <option disabled selected value> -- select an option --</option>
                                                <option value="cond_space">Conditioned Space</option>
                                                <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                                <option value="vented_crawl">Vented Crawlspace</option>
                                                <option value="uncond_attic">Unconditioned Attic</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6" id="DuctSys1PercInput3">
                                            <label class="tvt-field-label">Percentage of Duct in this location</label>
                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="ductSysPerc1.3" onChange="verifyDuctPercentage(1)"
                                                   tvt-percent="1" name="DuctSysPerc1_3"
                                                   type="number"
                                                   min="0" max="100"
                                                   value="<?php echo $formData['ductsysperc1_3'][0]; ?>"/>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label class="tvt-field-label">Are ducts sealed?</label>

                                            <p>
                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysSeal1_3" value="Yes"
                                                           id="DuctSysSeal1.3_0"/>
                                                    Yes</label>

                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input" type="radio" name="DuctSysSeal1_3" value="No"
                                                           id="DuctSysSeal1.3_1"/>
                                                    No</label>
                                            </p>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label class="tvt-field-label">Are ducts insulated?</label>

                                            <p>
                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul1_3" value="Yes"
                                                           id="DuctSysInsul1.3_0"/>
                                                    Yes</label>

                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input" type="radio" name="DuctSysInsul1_3" value="No"
                                                           id="DuctSysInsul1.3_1"/>
                                                    No</label>
                                            </p>
                                        </div> <!-- div structure needed for hiding to work properly -->
                                    </div> <!-- div structure needed for hiding to work properly -->
                                </div> <!-- div structure needed for hiding to work properly -->
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="DuctSys1Photo" type="file" accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>
                                <input class="tvt-field-input" name="DuctSys1PhotoTitle" type="text" value="<?php echo $formData['ductsys1phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="DuctSys1Recom" type="text" value="<?php echo $formData['ductsys1recom'][0]; ?>"/>
                            </div>
                        </div>
                    </div> <!-- Closing Div Tag for Duct (System 1) -->

                    <!-- Div Containing Duct (System 2) -->
                    <div class="Duct1Content">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Duct (System 2)</h3>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Does the home have a second duct system?</label>

                            <p>
                                <label class="tvt-input-option">
                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="Duct2Have" value="Yes"
                                           id="Duct2Have_0" onClick="omniHide(this, 'No', 'Duct2Content')"/>
                                    Yes</label>

                                <label class="tvt-input-option">
                                    <input class="tvt-field-input" type="radio" name="Duct2Have" value="No"
                                           id="Duct2Have_1" onClick="omniHide(this, 'No', 'Duct2Content')" checked />
                                    No</label>
                            </p>

                        </div>

                        <div class="Duct2Content">
                            <div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label class="tvt-field-label">Duct Location 1</label>

                                    <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc2_1">
                                        <option disabled selected value> -- select an option --</option>
                                        <option value="cond_space">Conditioned Space</option>
                                        <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                        <option value="vented_crawl">Vented Crawlspace</option>
                                        <option value="uncond_attic">Unconditioned Attic</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label class="tvt-field-label">Percentage of Duct in this location</label>

                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysPerc2_1" onChange="verifyDuctPercentage(2)"
                                           type="number"
                                           min="0" max="100"
                                           value="<?php echo $formData['ductsysperc2_1'][0]; ?>"/>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="tvt-field-label">Are ducts sealed?</label>

                                    <p>
                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysSeal2_1" value="Yes"
                                                   id="DuctSysSeal2.1_0"/>
                                            Yes</label>

                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input" type="radio" name="DuctSysSeal2_1" value="No"
                                                   id="DuctSysSeal2.1_1"/>
                                            No</label>
                                    </p>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="tvt-field-label">Are ducts insulated?</label>

                                    <p>
                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul2_1" value="Yes"
                                                   id="DuctSysInsul2.1_0"/>
                                            Yes</label>

                                        <label class="tvt-input-option">
                                            <input class="tvt-field-input" type="radio" name="DuctSysInsul2_1" value="No"
                                                   id="DuctSysInsul2.1_1"/>
                                            No</label>
                                    </p>
                                </div>

                                <div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label class="tvt-field-label">Duct Location 2</label>

                                        <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc2_2">
                                            <option disabled selected value> -- select an option --</option>
                                            <option value="cond_space">Conditioned Space</option>
                                            <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                            <option value="vented_crawl">Vented Crawlspace</option>
                                            <option value="uncond_attic">Unconditioned Attic</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 DuctSys2PercInput">
                                        <label class="tvt-field-label">Percentage of Duct in this location</label>

                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysPerc2_2" type="number" min="0" max="100"
                                               onChange="verifyDuctPercentage(2)"
                                               value="<?php echo $formData['ductsysperc2_2'][0]; ?>"/>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="tvt-field-label">Are ducts sealed?</label>

                                        <p>
                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysSeal2_2" value="Yes"
                                                       id="DuctSysSeal2.2_0"/>
                                                Yes</label>

                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input" type="radio" name="DuctSysSeal2_2" value="No"
                                                       id="DuctSysSeal2.2_1"/>
                                                No</label>
                                        </p>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label class="tvt-field-label">Are ducts insulated?</label>

                                        <p>
                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul2_2" value="Yes"
                                                       id="DuctSysInsul2.2_0"/>
                                                Yes</label>

                                            <label class="tvt-input-option">
                                                <input class="tvt-field-input" type="radio" name="DuctSysInsul2_2" value="No"
                                                       id="DuctSysInsul2.2_1"/>
                                                No</label>
                                        </p>
                                    </div>

                                    <div>

                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <label class="tvt-field-label">Duct Location 3</label>

                                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="DuctSysLoc2_3">
                                                <option disabled selected value> -- select an option --</option>
                                                <option value="cond_space">Conditioned Space</option>
                                                <option value="uncond_basement">Unconditioned Basement or Unvented Crawlspace</option>
                                                <option value="vented_crawl">Vented Crawlspace</option>
                                                <option value="uncond_attic">Unconditioned Attic</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 DuctSys2PercInput">
                                            <label class="tvt-field-label">Percentage of Duct in this location</label>

                                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="DuctSysPerc2.3" name="DuctSysPerc2_3" type="number"
                                                   min="0"
                                                   max="100"
                                                   onChange="verifyDuctPercentage(2)"
                                                   value="<?php echo $formData['ductsysperc2_3'][0]; ?>"/>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label class="tvt-field-label">Are ducts sealed?</label>

                                            <p>
                                                <label class="tvt-input-option HomeEnergyScoreReq HollandReq">
                                                    <input class="tvt-field-input" type="radio" name="DuctSysSeal2_3" value="Yes"
                                                           id="DuctSysSeal2.3_0"/>
                                                    Yes</label>

                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input" type="radio" name="DuctSysSeal2_3" value="No"
                                                           id="DuctSysSeal2.3_1"/>
                                                    No</label>
                                            </p>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label class="tvt-field-label">Are ducts insulated?</label>

                                            <p>
                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DuctSysInsul2_3" value="Yes"
                                                           id="DuctSysInsul2.3_0"/>
                                                    Yes</label>

                                                <label class="tvt-input-option">
                                                    <input class="tvt-field-input" type="radio" name="DuctSysInsul2_3" value="No"
                                                           id="DuctSysInsul2.3_1"/>
                                                    No</label>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo</label>

                                <input class="tvt-field-input" name="DuctSys2Photo" type="file" accept="image/*"/>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                                <label class="tvt-field-label">Photo Title</label>

                                <input class="tvt-field-input" name="DuctSys2PhotoTitle" type="text" value="<?php echo $formData['ductsys2phototitle'][0]; ?>"/>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="tvt-field-label">Assessor's Recommendation</label>

                                <input class="tvt-field-input" name="DuctSys2Recom" type="text" value="<?php echo $formData['ductsys2recom'][0]; ?>"/>
                            </div>
                        </div>
                    </div> <!-- Closing Div Tag for Duct (System 2) -->

                    <!-- Div containing Duct System Other -->
                    <div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="tvt-group-title">Duct System Other</h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Dryer Vented</label>
                            <p>
                                <label class="tvt-input-option">
                                    <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="DryerVented_1" value="Yes"
                                           id="DryerVented_1" onClick="defaultUpgradeValues('DryerVented_1')"/>
                                    Yes</label>

                                <label class="tvt-input-option">
                                    <input class="tvt-field-input" type="radio" name="DryerVented_1" value="No"
                                           id="DryerVented.1_1" onClick="defaultUpgradeValues('DryerVented_1')"/>
                                    No</label>
                            </p>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="DuctSysOtherPhoto" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="DuctSysOtherPhotoTitle" type="text"
                                   value="<?php echo $formData['ductsysotherphototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="DuctSysOtherRecom" id="DuctSysOtherRecom" type="text"
                                   value="<?php echo $formData['ductsysotherrecom'][0]; ?>"/>
                        </div>

                    </div> <!-- Closing Div Tag for Duct System Other -->

                </div> <!-- Closing Div Tag for Duct Systems SECTION -->

                <!-- Div Containing Hot Water SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Hot Water</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label>Water Heater Type</label>

                        <select class="HomeEnergyScoreReq HollandReq" name="WaterHeatType" onChange="omniHide(this, 'None','HotWaterContent')">
                            <option disabled selected value> -- select an option --</option>
                            <option value="None">None</option>
                            <option value="storage:electric">Electric Storage</option>
                            <option value="storage:natural_gas">Natural Gas Storage</option>
                            <option value="storage:lpg">LPG Storage</option>
                            <option value="storage:fuel_oil">Oil Storage</option>
                            <option value="heat_pump:electric">Electric Heat Pump</option>
                        </select>
                    </div>
                    <div class="HotWaterContent">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label> Do you know the actual water heater energy factor?</label>

                            <label class="tvt-input-option">

                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WaterHeaterEnergy_1"
                                       value="Yes" id="waterheaterenergyfactor.1_0" onClick="omniHide(this, 'No', 'HotWaterEnergyFactor');
                                   omniHide(this, 'Yes', 'HotWaterYearInstalled')"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WaterHeaterEnergy_1" value="No"
                                       id="waterheaterenergyfactor.1_1" onClick="omniHide(this, 'No', 'HotWaterEnergyFactor');
                                   omniHide(this, 'Yes', 'HotWaterYearInstalled')" checked />
                                No</label>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 HotWaterEnergyFactor">
                            <label>Energy Factor (between 0-1)</label>
                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" id="EFactor" name="HotWaterEFactor" type="number" step=".01" min="0"
                                   value="<?php echo $formData['hotwaterefactor'][0]; ?>"
                                   max="1"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 HotWaterYearInstalled">
                            <label>Year Installed</label>
                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" name="HotWaterYearIns" type="number" min="1970"
                                   value="<?php echo $formData['hotwateryearins'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Hot Water Pipes Wrapped</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="hotwaterwrapped_1" value="Yes"
                                       id="hotwaterwrapped.1_0"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="hotwaterwrapped_1" value="No"
                                       id="hotwaterwrapped.1_1"/>
                                No</label>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Water Pressure</label>

                            <select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="WaterPressureTest">
                                <option disabled selected value> -- select an option --</option>
                                <option value="Less 55">Less than 55 PSI</option>
                                <option value="55-65">55 to 65 PSI</option>
                                <option value="Greater 65">Greater than 65 PSI</option>
                                <option value="NA">Not Tested</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Water Leaks Found</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WaterLeaksFound_1" value="Yes"
                                       id="WaterLeaksFound.1_0"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="WaterLeaksFound_1" value="No"
                                       id="WaterLeaksFound.1_1"/>
                                No</label>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo</label>

                            <input class="tvt-field-input" name="HotWatSysPhoto" type="file" accept="image/*"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                            <label class="tvt-field-label">Photo Title</label>

                            <input class="tvt-field-input" name="HotWatSysPhotoTitle" type="text" value="<?php echo $formData['hotwatsysphototitle'][0]; ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label class="tvt-field-label">Assessor's Recommendation</label>

                            <input class="tvt-field-input" name="HotWatSysRecom" type="text" value="<?php echo $formData['hotwatsysrecom'][0]; ?>"/>
                        </div>
                    </div>
                </div> <!-- Closing Div Tag for Hot Water SECTION -->

								<!-- Closing Div Tag for PV System SECTION -->
								<div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="tvt-group-title">Solar PV System or Potential</h3>
                </div>
								<div class="PVALL">
										<div class="col-sm-12 col-md-12 col-lg-12">
												<label>Enter Photovoltaic (PV) System </label>



														<label class="tvt-input-option">
                                        <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="PV_1"
                                               value="Yes" id="PV.1_1" checked="checked" onClick="omniHide(this, 'Yes', 'PVcontent');
                                                 omniHide(this, 'No', 'PVcontent')"/>
                                        Yes</label>

                                    <label class="tvt-input-option">
                                        <input class="tvt-field-input" type="radio" name="PV_1"
                                               value="No" id="PV.1_1" onClick="omniHide(this, 'Yes', 'PVcontent');
                                                 omniHide(this, 'No', 'PVcontent')" checked />
                                        No</label>

										</div>
										<br />
										<div class="PVcontent">
										<div class="col-sm-12 col-md-12 col-lg-12">
                        <p>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="Home appears to be shaded greatly"
                                       id="SolarPV.1_0"/>
                                Home appears to be shaded greatly</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="Home may be shaded lightly"
                                       id="SolarPV.1_1"/>
                                Home may be shaded lightly</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="No shading on the roof"
                                       id="SolarPV.1_2"/>
                                No shading on the roof</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="Older roof - needs replacement"
                                       id="SolarPV.1_3"/>
                                Older roof - needs replacement</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="Adequate spacing facing East, West or South"
                                       id="SolarPV.1_4"/>
                                Adequate spacing facing East, West or South</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="checkbox" name="SolarPV_1" value="N/A"
                                       id="SolarPV.1_5"/>
                                N/A</label>
                        </p>
                    </div>

										<div class="col-sm-12 col-md-12 col-lg-12">
												<label class="tvt-field-label">Year Installed</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="PVYear">
														<option disabled selected value> -- select an option --</option>
														<option value="2000">2000</option>
														<option value="2001">2001</option>
														<option value="2002">2002</option>
														<option value="2003">2003</option>
														<option value="2004">2004</option>
														<option value="2005">2005</option>
														<option value="2006">2006</option>
														<option value="2007">2007</option>
														<option value="2008">2008</option>
														<option value="2009">2009</option>
														<option value="2010">2010</option>
														<option value="2011">2011</option>
														<option value="2012">2012</option>
														<option value="2013">2013</option>
														<option value="2014">2014</option>
														<option value="2015">2015</option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>

												</select>
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12">
												<label class="tvt-field-label">Direction Panels Face</label>

												<select class="tvt-field-input HomeEnergyScoreReq HollandReq" name="PVDirection">
														<option disabled selected value> -- select an option --</option>
														<option value="North">North</option>
														<option value="NorthEast">NorthEast</option>
														<option value="East">East</option>
														<option value="SouthEast">SouthEast</option>
														<option value="South">South</option>
														<option value="SouthWest">SouthWest</option>
														<option value="West">West</option>
														<option value="NorthWest">NorthWest</option>


												</select>
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12">
												<label>Do you know the systems capacity?</label>

												<label class="tvt-input-option">

														<input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="PV_2"
																	 value="Yes" id="PV.2_0" onClick="omniHide(this, 'No', 'HotWaterEnergyFactor');
															 omniHide(this, 'Yes', 'HotWaterYearInstalled')"/>
														Yes</label>

												<label class="tvt-input-option">
														<input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="PV_2" value="No"
																	 id="PV.2_1" onClick="omniHide(this, 'No', 'HotWaterEnergyFactor');
															 omniHide(this, 'Yes', 'HotWaterYearInstalled')" checked />
														No</label>
										</div>

									</div><!--Closing PVcontent-->
								</div> <!-- Closing Div for PV -->


            </div> <!-- Closing Div Tag for System SECTION -->

        </div> <!-- Closing Div Tag for System TAB SECTION -->

        <!-- Div Containing Spot Ventilation TAB SECTION -->
        <div id="SpotVentilation" class="tvt-tabcontent pagebreakhere">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="tvt-section-title"><span class="glyphicon glyphicon-cog"></span> Spot Ventilation</h2>
            </div>

            <!-- Div Containing Spot Ventilation Bathroom -->
            <div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3 class="tvt-group-title">Bathroom</h3>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="tvt-field-label">Bathroom Fan Details</label>

                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="BathroomFanDetails_1" value="All bath fans vent to exterior"
                               id="BathroomFanDetails.1_0"/>
                        All bath fans vent to exterior</label>

                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="BathroomFanDetails_1"
                               value="All bath fan ducts are insulated in unconditioned attic"
                               id="BathroomFanDetails.1_1"/>
                        All bath fan ducts are insulated in unconditioned attic</label>

                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="BathroomFanDetails_1" value="All bath fans vent to attic"
                               id="BathroomFanDetails.1_2"/>
                        All bath fans vent to attic</label>

                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="BathroomFanDetails_1" value="All bath fans are energy efficient"
                               id="BathroomFanDetails.1_3"/>
                        All bath fans are energy efficient</label>

                    <label class="tvt-input-option">
                        <input class="tvt-field-input" type="checkbox" name="BathroomFanDetails_1" value="Other"
                               id="BathroomFanDetails.1_4"/>
                        Other</label>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="tvt-field-label">Bath fan CFM Rate</label>

                    <input class="tvt-field-input" name="BathFanCFMRate" type="number" step="1" min="0"
                           value="<?php echo $formData['bathfancfmrate'][0]; ?>"/>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                    <label class="tvt-field-label">Photo</label>

                    <input class="tvt-field-input" name="SpotBathPhoto" type="file" accept="image/*"/>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                    <label class="tvt-field-label">Photo Title</label>

                    <input class="tvt-field-input" name="SpotBathPhotoTitle" type="text" value="<?php echo $formData['spotbathphototitle'][0]; ?>"/>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label class="tvt-field-label">Assessor's Recommendation</label>

                    <input class="tvt-field-input" name="SpotBathRecom" type="text" value="<?php echo $formData['spotbathrecom'][0]; ?>"/>
                </div>
            </div> <!-- Closing Div Tag for Spot Ventilation Bathroom -->

        </div> <!-- Closing Div Tag for Spot Ventilation TAB SECTION -->

        <!-- Div Containing Safety and Health TAB SECTION -->
        <div id="Safety" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing Safety and Health SECTION -->
            <div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-warning-sign"></span> Safety and Health</h2>
                </div>

                <!-- Div Containing Air Quality SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Air Quality</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Asbestos</label>

                        <label class="tvt-input-option">

                            <input class="tvt-field-input HomeEnergyScoreReq HollandReq" type="radio" name="Asbestos_1" value="Found. Unsafe to test"

                                   id="Asbestos.1_0"/>
                            Found. Unsafe to test</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="radio" name="Asbestos_1" value="Safe to test"
                                   id="Asbestos.1_1"/>
                            Found. Safe to test</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="radio" name="Asbestos_1" value="Not Found"
                                   id="Asbestos.1_2"/>
                            Not Found</label>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Ambient Carbon Monoxide (PPM)</label>
                        <input class="tvt-field-input HomeEnergyScoreReq" name="AmbientPPM" type="number" step="1" min="0"
                               value="<?php echo $formData['ambientppm'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Gas Stove/Oven Carbon Monoxide (PPM)</label>
                        <input class="tvt-field-input HomeEnergyScoreReq" name="StoveOvenPPM" type="number" step="1" min="0"
                               value="<?php echo $formData['stoveovenppm'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Merv Filtration Rating</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="MervFiltrationRating"
                                id="MervFiltrationRating.1_0">
                            <option disabled selected value> -- select an option --</option>
                            <option value="LessThan8">Less than 8</option>
                            <option value="8">8</option>
                            <option value="GreaterThan8">Greater than 8</option>
                            <option value="NA">N/A</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Mold</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="radio" name="Mold_1" id="Mold.1_0" value="<?php echo $formData['mold_1'][0]; ?>"/>
                            Yes</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="radio" name="Mold_1" id="Mold.1_1" value="<?php echo $formData['mold_1'][0]; ?>"/>
                            No</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="radio" name="Mold_1" id="Mold.1_2" value="<?php echo $formData['mold_1'][0]; ?>"/>
                            Not Tested</label>

                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Radon</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="RadonTest"
                                id="MervFiltrationRating.1_0">
                            <option disabled selected value> -- select an option --</option>
                            <option value="Installed">Radon system installed</option>
                            <option value="Activated">Test activated at home</option>
                            <option value="LessThan8">Test left with homeowner</option>
                            <option value="NA">Not tested</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Other Air Quality Notes</label>

                        <input type="text" name="OtherAirQualityNotes" value="<?php echo $formData['otherairqualitynotes'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="AirQualPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="AirQualPhotoTitle" type="text" value="<?php echo $formData['airqualphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="AirQualRecom" type="text" value="<?php echo $formData['airqualrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Air Quality SECTION -->

                <!-- Div Containing Wiring SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Wiring</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Smoke & CO Detectors</label>
                        <select class="tvt-field-input" name="SmokeAndCO"
                                id="SmokeandCO" onChange="hideSmokeAndCORec()">
                            <option disabled selected value> -- select an option --</option>
                            <option value="Smoke Detectors and CO detectors are within 10 feet of each bedroom and in the mechanical room.">Smoke Detectors & CO
                                detectors
                                are within 10 feet of each bedroom and in the mechanical room
                            </option>
                            <option
                                    value="Smoke Detectors are within 10 feet of each bedroom and in the mechanical room but there are no CO detectors or an insufficient amount.">
                                Smoke Detectors are within 10 feet of each bedroom and in the mechanical room but there are no CO detectors or an insufficient
                                amount
                            </option>
                            <option value="No smoke or CO detectors are present or there is not 1 within 10 feet of each room.">No smoke or CO detectors are
                                present or
                                there is not 1 within 10 feet of each room
                            </option>
                            <option value="Not Measured/Recorded.">Not Measured/Recorded</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 SmokeAndCORec">
                        <label class="tvt-field-label">Smoke & CO Recommendation</label>
                        <input class="tvt-field-input" type="text" name="SmokeAndCORec" value="<?php echo $formData['smokeandcorec'][0]; ?>"/>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Knob & Tube Wiring</label>
                        <p>
                            <label class="tvt-input-option">
                                <input class="tvt-field-input HomeEnergyScoreReq" type="radio" name="KnobTubeWiring"
                                       value="Yes" id="KnobTubeWiring.1_0"/>
                                Yes</label>

                            <label class="tvt-input-option">
                                <input class="tvt-field-input" type="radio" name="KnobTubeWiring" value="No"
                                       id="KnobTubeWiring.1_1"/>
                                No</label>
                        </p>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Wiring Upgrade</label>

                        <input class="tvt-field-input" name="WiringUpgrade" type="text" value="<?php echo $formData['wiringupgrade'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WiringPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WiringPhotoTitle" type="text" value="<?php echo $formData['wiringphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WiringRecom" type="text" value="<?php echo $formData['wiringrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Wiring SECTION -->

                <!-- Div containing Hoodrange SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Hoodrange</h3>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <label class="tvt-field-label">Hoodrange Details</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="HoodrangeDetails">
                            <option disabled selected value> -- select an option --</option>
                            <option value="Recirculating">Recirculating or there is no hoodrange</option>
                            <option value="VentedInsulated">Vented out the attic and insulated</option>
                            <option value="VentedAttic">Vented to attic</option>
                            <option value="VentedOutdoors">Vented to outdoors</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <label class="tvt-field-label">Hoodrange CFM Rate</label>

                        <input class="tvt-field-input HomeEnergyScoreReq" name="HoodrangeCFMRate" type="number" step="1" min="0"
                               value="<?php echo $formData['hoodrangecfmrate'][0]; ?>"/>
                        &nbsp; <!-- Fixes mysterious blank space -->
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="HoodrangePhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="HoodrangePhotoTitle" type="text" value="<?php echo $formData['hoodrangephototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="HoodrangeRecom" type="text" value="<?php echo $formData['hoodrangerecom'][0]; ?>"/>
                    </div>
                </div> <!-- Closing Div Tag for Hoodrange SECTION -->

            </div> <!-- Closing Div Tag for Safety and Health SECTION -->

        </div> <!-- Closing Div Tag for Safety and Health TAB SECTION -->

        <!-- Div Containing Water Conservation TAB SECTION -->
        <div id="WaterConservation" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing Water Conservation SECTION -->
            <div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-tint"></span>Water Conservation</h2>
                </div>

                <!-- Div Water Conservation Bathroom SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Bathroom</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Shower Flow Rate (GPM) </label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="ShowerFlowRate" id="ShowerFlowRate"
                                onChange="defaultUpgradeValues('shower')">
                            <option disabled selected value> -- select an option --</option>
                            <option value="1 or less">1 or less</option>
                            <option value="1.5">1.5</option>
                            <option value="2">2</option>
                            <option value="2.5">2.5</option>
                            <option value="Greater than 2.5">Greater than 2.5</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Shower Head Upgrade</label>
                        <input class="tvt-field-input" name="ShowerHeadUpgrade" id="ShowerHeadUpgrade" type="text"
                               value="<?php echo $formData['showerheadupgrade'][0]; ?>"/>
                        &nbsp; <!-- Fixes mysterious blank space -->

                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Toilet Flush (GPF)</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="ToiletFlushGPF" id="ToiletFlushGPF"
                                onChange="defaultUpgradeValues('toilet')">
                            <option disabled selected value> -- select an option --</option>
                            <option value="0.8">0.8</option>
                            <option value="1.1">1.1</option>
                            <option value="1.3">1.3</option>
                            <option value="1.6">1.6</option>
                            <option value="Greater than 1.6">Greater than 1.6</option>
                            <option value="Dual flush or other">Dual flush or other</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Toilet Upgrade</label>

                        <input class="tvt-field-input" name="ToiletUpgrade" id="ToiletUpgrade" type="text"
                               value="<?php echo $formData['toiletupgrade'][0]; ?>"/>

                        &nbsp; <!-- Fixes mysterious blank space -->

                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Faucet Flow Rate (GPM)</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="FaucetFlowRate" id="FaucetFlowRate"
                                onChange="defaultUpgradeValues('faucet')">
                            <option disabled selected value> -- select an option --</option>
                            <option value="0.5 or less">0.5 or less</option>
                            <option value="1">1</option>
                            <option value="1.5">1.5</option>
                            <option value="2">2</option>
                            <option value="2.5">2.5</option>
                            <option value="Greater 2.5">Greater than 2.5</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Faucet Aerator Upgrade</label>


                        <input class="tvt-field-input" name="FaucetUpgrade" id="FaucetUpgrade" type="text"
                               value="<?php echo $formData['faucetupgrade'][0]; ?>"/>
                        &nbsp; <!-- Fixes mysterious blank space -->

                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo</label>

                        <input class="tvt-field-input" name="WatConsBathPhoto" type="file" accept="image/*"/>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 photo_and_title">
                        <label class="tvt-field-label">Photo Title</label>

                        <input class="tvt-field-input" name="WatConsBathPhotoTitle" type="text" value="<?php echo $formData['watconsbathphototitle'][0]; ?>"/>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Assessor's Recommendation</label>

                        <input class="tvt-field-input" name="WatConsBathRecom" type="text" value="<?php echo $formData['watconsbathrecom'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Water Conservation Bathroom SECTION -->

            </div> <!-- Closing Div Tag for Water Conservation SECTION -->

        </div> <!-- Closing Div Tag for Water Conservation TAB SECTION -->

        <!-- Div Containing Electric TAB SECTION -->
        <div id="Electric" class="tvt-tabcontent pagebreakhere">

            <!-- Div Containing Electric SECTION -->
            <div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 class="tvt-section-title"><span class="glyphicon glyphicon-flash"></span>Electric</h2>
                </div>

                <!-- Div Containing Lights SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Lights</h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Lighting Type in High Traffic Areas</label>

                        <select class="tvt-field-input HomeEnergyScoreReq" name="LightingType" id="LightingType" onChange="defaultUpgradeValues('lighting')">
                            <option disabled selected value> -- select an option --</option>
                            <option value="CFL">CLF</option>
                            <option value="LED">LED</option>
                            <option value="Incandescent or HID">Incandescent</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label class="tvt-field-label">Lighting Upgrade</label>

                        <input class="tvt-field-input" name="LightingUpgrade" id="LightingUpgrade" type="text"
                               value="<?php echo $formData['lightingupgrade'][0]; ?>"/>
                    </div>

                </div> <!-- Closing Div Tag for Lights SECTION -->

                <!-- Div Containing Appliances SECTION -->
                <div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3 class="tvt-group-title">Appliances</h3>
                    </div>

                    <div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Fridge Serial #</label>
                            <input class="tvt-field-input" name="FridgeSerial" type="text" value="<?php echo $formData['fridgeserial'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Fridge Model</label>
                            <input class="tvt-field-input" name="FridgeModel" type="text" value="<?php echo $formData['fridgemodel'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Freezer Serial #</label>
                            <input class="tvt-field-input" name="FreezerSerial" type="text" value="<?php echo $formData['freezerserial'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Freezer Model</label>
                            <input class="tvt-field-input" name="FreezerModel" type="text" value="<?php echo $formData['freezermodel'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Dishwasher Serial #</label>
                            <input class="tvt-field-input" name="DishwasherSerial" type="text" value="<?php echo $formData['dishwasherserial'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Dishwasher Model</label>
                            <input class="tvt-field-input" name="DishwasherModel" type="text" value="<?php echo $formData['dishwashermodel'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Laundry Machine Serial #</label>
                            <input class="tvt-field-input" name="LaundrySerial" type="text" value="<?php echo $formData['laundryserial'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Laundry Machine Model</label>
                            <input class="tvt-field-input" name="LaundryModel" type="text" value="<?php echo $formData['laundrymodel'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Dryer Serial #</label>
                            <input class="tvt-field-input" name="DryerSerial" type="text" value="<?php echo $formData['dryerserial'][0] ?>"/>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label class="tvt-field-label">Dryer Model</label>
                            <input class="tvt-field-input" name="DryerModel" type="text" value="<?php echo $formData['dryermodel'][0] ?>"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="tvt-field-label">Select All That Apply</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Upgrade to Wi-Fi-enabled programmable thermostat"
                                   id="Appliances.1_0"/>
                            Upgrade to Wi-Fi-enabled programmable thermostat</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Air sealing your attic penetrations
					and floor with caulk, great stuff, ecoseal or open cell spray foam" id="Appliances.1_1"/>
                            Air sealing your attic penetrations and floor with caulk, great stuff, ecoseal or
                            open cell spray foam</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1"
                                   value="Insulating your attic to R49 with blown in cellulose or open cell spray foam"
                                   id="Appliances.1_2"/>
                            Insulating your attic to R49 with blown in cellulose or open cell spray foam</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Switch to energy star front loading washer when updating"
                                   id="Appliances.1_3"/>
                            Switch to energy star front loading washer when updating</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Switch to energy star dryer when updating"
                                   id="Appliances.1_4"/>
                            Switch to energy star dryer when updating</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1"
                                   value="Switch to energy star up / down non side by side fridge when updating"
                                   id="Appliances.1_5"/>
                            Switch to energy star up / down non side by side fridge when updating</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Switch to energy star dishwasher when updating"
                                   id="Appliances.1_6"/>
                            Switch to energy star dishwasher when updating</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1"
                                   value="Upgrade furnace to 95% + efficient energy star certified unit"
                                   id="Appliances.1_7"/>
                            Upgrade furnace to 95% + efficient energy star certified unit</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="Upgrade whole house A/C unit to 13 SEER or higher"
                                   id="Appliances.1_8"/>
                            Upgrade whole house A/C unit to 13 SEER or higher</label>

                        <label class="tvt-input-option">
                            <input class="tvt-field-input" type="checkbox" name="Appliances_1" value="When changing water heater consider on-demand tankless or energy star closed
              combustion unit"
                                   id="Appliances.1_9"/>
                            When changing water heater consider on-demand tankless or energy star closed
                            combustion unit</label>
                    </div>

                </div> <!-- Closing Div Tag for Lights SECTION -->



            </div> <!-- Closing Div Tag for Electric SECTION -->

        </div> <!-- Closing Div Tag for Electric TAB SECTION -->

        <!-- Div Containing Form Submit Button -->
        <div class="row" id="button_row">
            <button id="submit-btn" class="btn btn-success pull-right" onClick="submitForm();">Save & Submit</button>
        </div>

    </form> <!-- Closing Form Element Containing Entire Form -->
</div> <!-- Closing Div Tag for Entire Form Page -->


<!-- Let body load before loading scripts -->

<script src="../wp-content/themes/greenhome/scripts/javascript/tvt-functions.js"></script>

<!--<script src ="./scripts/javascript/tvt-functions.js"></script>-->

<script>
	<?php
	echo 'var radioGroups = {';
	if ( isset( $formData['blowerdoortest'][0] ) ) {
		echo 'BlowerDoorTest : \'' . $formData['blowerdoortest'][0] . '\',';
	}
	if ( isset( $formData['profairseal'][0] ) ) {
		echo 'ProfAirSeal : \'' . $formData['profairseal'][0] . '\',';
	}
	if ( isset( $formData['wallscharacgen'][0] ) ) {
		echo 'WallsCharacGen : \'' . $formData['wallscharacgen'][0] . '\',';
	}
	if ( isset( $formData['skylighthave'][0] ) ) {
		echo 'SkylightHave : \'' . $formData['skylighthave'][0] . '\',';
	}
	if ( isset( $formData['skylightknowuandshgc'][0] ) ) {
		echo 'SkylightKnownUandSHGC : \'' . $formData['skylightknownuandshgc'][0] . '\',';
	}
	if ( isset( $formData['winfrontknownuandshgc'][0] ) ) {
		echo 'WinFrontKnownUandSHGC : \'' . $formData['winfrontknownuandshgc'][0] . '\',';
	}
	if ( isset( $formData['winleftknownuandshgc'][0] ) ) {
		echo 'WinLeftKnownUandSHGC : \'' . $formData['winLeftknownuandshgc'][0] . '\',';
	}
	if ( isset( $formData['heatsyseffic1'][0] ) ) {
		echo 'HeatSysEffic1 : \'' . $formData['heatsyseffic1'][0] . '\',';
	}
	if ( isset( $formData['heatsyseffic2'][0] ) ) {
		echo 'HeatSysEffic2 : \'' . $formData['heatsyseffic2'][0] . '\',';
	}
	if ( isset( $formData['duct1have'][0] ) ) {
		echo 'Duct1Have : \'' . $formData['duct1have'][0] . '\',';
	}
	if ( isset( $formData['duct2have'][0] ) ) {
		echo 'Duct2Have : \'' . $formData['duct2have'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal2_1'][0] ) ) {
		echo 'DuctSysSeal2_1 : \'' . $formData['ductsysseal2_1'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal1_1'][0] ) ) {
		echo 'DuctSysSeal1_1 : \'' . $formData['ductsysseal1_1'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul1_1'][0] ) ) {
		echo 'DuctSysInsul1_1 : \'' . $formData['ductsysinsul1_1'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul2_1'][0] ) ) {
		echo 'DuctSysInsul2_1 : \'' . $formData['ductsysinsul2_1'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal2_2'][0] ) ) {
		echo 'DuctSysSeal2_2 :  \'' . $formData['ductsysseal2_2'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal1_2'][0] ) ) {
		echo 'DuctSysSeal1_2 :  \'' . $formData['ductsysseal1_2'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul1_2'][0] ) ) {
		echo 'DuctSysInsul1_2 : \'' . $formData['ductsysinsul1_2'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul2_2'][0] ) ) {
		echo 'DuctSysInsul2_2 : \'' . $formData['ductsysinsul2_2'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal2_3'][0] ) ) {
		echo 'DuctSysSeal2_3 : \'' . $formData['ductsysseal2_3'][0] . '\',';
	}
	if ( isset( $formData['ductsysseal1_3'][0] ) ) {
		echo 'DuctSysSeal1_3 : \'' . $formData['ductsysseal1_3'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul2_3'][0] ) ) {
		echo 'DuctSysInsul2_3 : \'' . $formData['ductsysseal2_3'][0] . '\',';
	}
	if ( isset( $formData['ductsysinsul1_3'][0] ) ) {
		echo 'DuctSysInsul1_3 : \'' . $formData['ductsysseal1_3'][0] . '\',';
	}
	if ( isset( $formData['dryervented_1'][0] ) ) {
		echo 'DryerVented_1 : \'' . $formData['dryervented_1'][0] . '\',';
	}
	if ( isset( $formData['waterleaksfound_1'][0] ) ) {
		echo 'WaterLeaksFound_1 : \'' . $formData['waterleaksfound_1'][0] . '\',';
	}
	if ( isset( $formData['asbestos_1'][0] ) ) {
		echo 'Asbestos_1 : \'' . $formData['asbestos_1'][0] . '\',';
	}
	if ( isset( $formData['mold_1'][0] ) ) {
		echo 'Mold_1 : \'' . $formData['mold_1'][0] . '\',';
	}
	if ( isset( $formData['knobtubewiring'][0] ) ) {
		echo 'KnobTubeWiring : \'' . $formData['knobtubewiring'][0] . '\',';
	}
	if ( isset( $formData['windowscharacgen'][0] ) ) {
		echo 'WindowsCharacGen : \'' . $formData['windowscharacgen'][0] . '\',';
	}
	if ( isset( $formData['waterheaterenergy_1'][0] ) ) {
		echo 'WaterHeaterEnergy_1 : \'' . $formData['waterheaterenergy_1'][0] . '\',';
	}
	if ( isset( $formData['coolsyseffic1'][0] ) ) {
		echo 'CoolSysEffic1 : \'' . $formData['coolsyseffic1'][0] . '\',';
	}
	if ( isset( $formData['coolsyseffic2'][0] ) ) {
		echo 'CoolSysEffic2 : \'' . $formData['coolsyseffic2'][0] . '\',';
	}
	if ( isset( $formData['hotwaterwrapped_1'][0] ) ) {
		echo 'hotwaterwrapped_1 : \'' . $formData['hotwaterwrapped_1'][0] . '\',';
	}
	echo '};';
	?>

  /*	if (Object.keys(radioGroups).length > 0) {
   for (radioName in radioGroups) {
   setSelected(radioName, radioGroups[radioName], "checked"); //run set checked with the name and value pair
   }
   }*/

	<?php
	echo 'var selectGroups = {';

	if ( isset( $formData['audittype'][0] ) ) {
		echo 'AuditType :' . '"' . $formData['audittype'][0] . '"';
	}
	if ( isset( $formData['homestate'][0] ) ) {
		echo ',';
		echo 'HomeState:' . '"' . $formData['homestate'][0] . '"';
	}
	if ( isset( $formData['homeposunit'][0] ) ) {
		echo ',';
		echo 'HomePosUnit :' . '"' . $formData['homeposunit'][0] . '"';
	}
	if ( isset( $formData['foundtype1'][0] ) ) {
		echo ',';
		echo 'FoundType1 :' . '"' . $formData['foundtype1'][0] . '"';
	}
	if ( isset( $formData['foundfloorinsul1'][0] ) ) {
		echo ',';
		echo 'FoundFloorInsul1 :' . '"' . $formData['foundfloorinsul1'][0] . '"';
	}
	if ( isset( $formData['foundwallinsul1'][0] ) ) {
		echo ',';
		echo 'FoundWallInsul1 :' . '"' . $formData['foundwallinsul1'][0] . '"';
	}
	if ( isset( $formData['rimbandjoistfound1'][0] ) ) {
		echo ',';
		echo 'RimBandJoistFound1 :' . '"' . $formData['rimbandjoistfound1'][0] . '"';
	}
	if ( isset( $formData['foundtype2'][0] ) ) {
		echo ',';
		echo 'FoundType2 :' . '"' . $formData['foundtype2'][0] . '"';
	}
	if ( isset( $formData['foundfloorinsul2'][0] ) ) {
		echo ',';
		echo 'FoundFloorInsul2 :' . '"' . $formData['foundfloorinsul2'][0] . '"';
	}
	if ( isset( $formData['foundwallinsul2'][0] ) ) {
		echo ',';
		echo 'FoundWallInsul2 :' . '"' . $formData['foundwallinsul2'][0] . '"';
	}
	if ( isset( $formData['rimbandjoistfound2'][0] ) ) {
		echo ',';
		echo 'RimBandJoistFound2 :' . '"' . $formData['rimbandjoistfound2'][0] . '"';
	}
	if ( isset( $formData['roofconst1'][0] ) ) {
		echo ',';
		echo 'RoofConst1 :' . '"' . $formData['roofconst1'][0] . '"';
	}
	if ( isset( $formData['roofextfin1'][0] ) ) {
		echo ',';
		echo 'RoofExtFin1 :' . '"' . $formData['roofextfin1'][0] . '"';
	}
	if ( isset( $formData['roofinsullev1'][0] ) ) {
		echo ',';
		echo 'RoofInsulLev1 :' . '"' . $formData['roofinsullev1'][0] . '"';
	}
	if ( isset( $formData['roofcolor1'][0] ) ) {
		echo ',';
		echo 'RoofColor1 :' . '"' . $formData['roofcolor1'][0] . '"';
	}
	if ( isset( $formData['roofconst2'][0] ) ) {
		echo ',';
		echo 'RoofConst2 :' . '"' . $formData['roofconst2'][0] . '"';
	}
	if ( isset( $formData['roofextfin2'][0] ) ) {
		echo ',';
		echo 'RoofExtFin2 :' . '"' . $formData['roofextfin2'][0] . '"';
	}
	if ( isset( $formData['roofinsullev2'][0] ) ) {
		echo ',';
		echo 'RoofInsulLev2 :' . '"' . $formData['roofinsullev2'][0] . '"';
	}
	if ( isset( $formData['atticfloorinsul2'][0] ) ) {
		echo ',';
		echo 'AtticFloorInsul2 :' . '"' . $formData['atticfloorinsul2'][0] . '"';
	}
	if ( isset( $formData['attictype2'][0] ) ) {
		echo ',';
		echo 'AtticType2 :' . '"' . $formData['attictype2'][0] . '"';
	}
	if ( isset( $formData['attictype1'][0] ) ) {
		echo ',';
		echo 'AtticType1 :' . '"' . $formData['attictype1'][0] . '"';
	}
	if ( isset( $formData['atticfloorinsul1'][0] ) ) {
		echo ',';
		echo 'AtticFloorInsul1 :' . '"' . $formData['atticfloorinsul1'][0] . '"';
	}
	if ( isset( $formData['smokeandco'][0] ) ) {
		echo ',';
		echo 'SmokeAndCO :' . '"' . $formData['smokeandco'][0] . '"';
	}
	if ( isset( $formData['wallsconstructgen'][0] ) ) {
		echo ',';
		echo 'WallsConstructGen :' . '"' . $formData['wallsconstructgen'][0] . '"';
	}
	if ( isset( $formData['roofcolor2'][0] ) ) {
		echo ',';
		echo 'RoofColor2 :' . '"' . $formData['roofcolor2'][0] . '"';
	}
	if ( isset( $formData['wallsextfingen'][0] ) ) {
		echo ',';
		echo ' WallsExtFinGen:' . '"' . $formData['wallsextfingen'][0] . '"';
	}
	if ( isset( $formData['wallsinsulgen'][0] ) ) {
		echo ',';
		echo ' WallsInsulGen:' . '"' . $formData['wallsinsulgen'][0] . '"';
	}
	if ( isset( $formData['windowspanesgen'][0] ) ) {
		echo ',';
		echo ' WindowsPanesGen:' . '"' . $formData['windowspanesgen'][0] . '"';
	}
	if ( isset( $formData['windowsglazegen'][0] ) ) {
		echo ',';
		echo ' WindowsGlazeGen:' . '"' . $formData['windowsglazegen'][0] . '"';
	}
	if ( isset( $formData['windowsframegen'][0] ) ) {
		echo ',';
		echo ' WindowsFrameGen:' . '"' . $formData['windowsframegen'][0] . '"';
	}
	if ( isset( $formData['skylightpanes'][0] ) ) {
		echo ',';
		echo 'SkylightPanes :' . '"' . $formData['skylightpanes'][0] . '"';
	}
	if ( isset( $formData['skylightglaze'][0] ) ) {
		echo ',';
		echo 'SkylightGlaze :' . '"' . $formData['skylightglaze'][0] . '"';
	}
	if ( isset( $formData['skylightframe'][0] ) ) {
		echo ',';
		echo 'SkylightFrame :' . '"' . $formData['skylightframe'][0] . '"';
	}
	if ( isset( $formData['wallsconstructfront'][0] ) ) {
		echo ',';
		echo 'WallsConstructFront :' . '"' . $formData['wallsconstructfront'][0] . '"';
	}
	if ( isset( $formData['wallsextfinfront'][0] ) ) {
		echo ',';
		echo 'WallsExtFinFront :' . '"' . $formData['wallsextfinfront'][0] . '"';
	}
	if ( isset( $formData['wallsinsulfront'][0] ) ) {
		echo ',';
		echo 'WallsInsulFront :' . '"' . $formData['wallsinsulfront'][0] . '"';
	}
	if ( isset( $formData['windowspanesfront'][0] ) ) {
		echo ',';
		echo ' WindowsPanesFront:' . '"' . $formData['windowspanesfront'][0] . '"';
	}
	if ( isset( $formData['windowsglazefront'][0] ) ) {
		echo ',';
		echo 'WindowsGlazeFront :' . '"' . $formData['windowsglazefront'][0] . '"';
	}
	if ( isset( $formData['windowsframefront'][0] ) ) {
		echo ',';
		echo 'WindowsFrameFront :' . '"' . $formData['windowsframefront'][0] . '"';
	}
	if ( isset( $formData['wallsinsulleft'][0] ) ) {
		echo ',';
		echo ' WallsInsulLeft:' . '"' . $formData['wallsinsulleft'][0] . '"';
	}
	if ( isset( $formData['wallsconstructback'][0] ) ) {
		echo ',';
		echo 'WallsConstructBack :' . '"' . $formData['wallsconstructback'][0] . '"';
	}
	if ( isset( $formData['windowspanesleft'][0] ) ) {
		echo ',';
		echo 'WindowsPanesLeft :' . '"' . $formData['windowspanesleft'][0] . '"';
	}
	if ( isset( $formData['wallsinsulback'][0] ) ) {
		echo ',';
		echo 'WallsInsulBack :' . '"' . $formData['wallsinsulback'][0] . '"';
	}
	if ( isset( $formData['windowspanesright'][0] ) ) {
		echo ',';
		echo 'WindowsPanesRight :' . '"' . $formData['windowspanesright'][0] . '"';
	}
	if ( isset( $formData['windowsglazeleft'][0] ) ) {
		echo ',';
		echo 'WindowsGlazeLeft :' . '"' . $formData['windowsglazeleft'][0] . '"';
	}
	if ( isset( $formData['wallsextfinleft'][0] ) ) {
		echo ',';
		echo ' WallsExtFinLeft:' . '"' . $formData['wallsextfinleft'][0] . '"';
	}
	if ( isset( $formData['windowspanesback'][0] ) ) {
		echo ',';
		echo 'WindowsPanesBack :' . '"' . $formData['windowspanesback'][0] . '"';
	}
	if ( isset( $formData['windowsframeleft'][0] ) ) {
		echo ',';
		echo 'WindowsFrameLeft :' . '"' . $formData['windowsframeleft'][0] . '"';
	}
	if ( isset( $formData['wallsextfinback'][0] ) ) {
		echo ',';
		echo ' WallsExtFinBack:' . '"' . $formData['wallsextfinback'][0] . '"';
	}
	if ( isset( $formData['heatsystype1'][0] ) ) {
		echo ',';
		echo 'HeatSysType1 :' . '"' . $formData['heatsystype1'][0] . '"';
	}
	if ( isset( $formData['wallsinsulright'][0] ) ) {
		echo ',';
		echo 'WallsInsulRight :' . '"' . $formData['wallsinsulright'][0] . '"';
	}
	if ( isset( $formData['wallsextfinright'][0] ) ) {
		echo ',';
		echo 'WallsExtFinRight :' . '"' . $formData['wallsextfinright'][0] . '"';
	}
	if ( isset( $formData['heatsystype2'][0] ) ) {
		echo ',';
		echo 'HeatSysType2 :' . '"' . $formData['heatsystype2'][0] . '"';
	}
	if ( isset( $formData['windowsglazeback'][0] ) ) {
		echo ',';
		echo 'WindowsGlazeBack :' . '"' . $formData['windowsglazeback'][0] . '"';
	}
	if ( isset( $formData['windowsglazeright'][0] ) ) {
		echo ',';
		echo 'WindowsGlazeRight :' . '"' . $formData['windowsglazeright'][0] . '"';
	}
	if ( isset( $formData['coolsystype1'][0] ) ) {
		echo ',';
		echo ' CoolSysType1:' . '"' . $formData['coolsystype1'][0] . '"';
	}
	if ( isset( $formData['wallsconstructright'][0] ) ) {
		echo ',';
		echo 'WallsConstructRight :' . '"' . $formData['wallsconstructright'][0] . '"';
	}
	if ( isset( $formData['windowsframeright'][0] ) ) {
		echo ',';
		echo ' WindowsFrameRight:' . '"' . $formData['windowsframeright'][0] . '"';
	}
	if ( isset( $formData['coolsystype2'][0] ) ) {
		echo ',';
		echo ' CoolSysType2:' . '"' . $formData['coolsystype2'][0] . '"';
	}
	if ( isset( $formData['wallsconstructleft'][0] ) ) {
		echo ',';
		echo ' WallsConstructLeft:' . '"' . $formData['wallsconstructleft'][0] . '"';
	}
	if ( isset( $formData['windowsframeback'][0] ) ) {
		echo ',';
		echo 'WindowsFrameBack :' . '"' . $formData['windowsframeback'][0] . '"';
	}
	if ( isset( $formData['ductsysloc1_2'][0] ) ) {
		echo ',';
		echo 'DuctSysLoc1_2 :' . '"' . $formData['ductsysloc1_2'][0] . '"';
	}
	if ( isset( $formData['ductsysloc1_1'][0] ) ) {
		echo ',';
		echo 'DuctSysLoc1_1 :' . '"' . $formData['ductsysloc1_1'][0] . '"';
	}
	if ( isset( $formData['ductsysloc1_3'][0] ) ) {
		echo ',';
		echo 'DuctSysLoc1_3 :' . '"' . $formData['ductsysloc1_3'][0] . '"';
	}
	if ( isset( $formData['ductsysloc2_2'][0] ) ) {
		echo ',';
		echo 'DuctSysLoc2_2 :' . '"' . $formData['ductsysloc2_2'][0] . '"';
	}
	if ( isset( $formData['ductsysloc2_1'][0] ) ) {
		echo ',';
		echo ' DuctSysLoc2_1:' . '"' . $formData['ductsysloc2_1'][0] . '"';
	}
	if ( isset( $formData['ductsysloc2_3'][0] ) ) {
		echo ',';
		echo ' DuctSysLoc2_3:' . '"' . $formData['ductsysloc2_3'][0] . '"';
	}
	if ( isset( $formData['waterheattype'][0] ) ) {
		echo ',';
		echo 'WaterHeatType :' . '"' . $formData['waterheattype'][0] . '"';
	}
	if ( isset( $formData['waterpressuretest'][0] ) ) {
		echo ',';
		echo 'WaterPressureTest :' . '"' . $formData['waterpressuretest'][0] . '"';
	}
	if ( isset( $formData['mervfiltrationrating'][0] ) ) {
		echo ',';
		echo ' MervFiltrationRating:' . '"' . $formData['mervfiltrationrating'][0] . '"';
	}
	if ( isset( $formData['radontest'][0] ) ) {
		echo ',';
		echo ' RadonTest:' . '"' . $formData['radontest'][0] . '"';
	}
	if ( isset( $formData['hoodrangedetails'][0] ) ) {
		echo ',';
		echo ' HoodrangeDetails:' . '"' . $formData['hoodrangedetails'][0] . '"';
	}
	if ( isset( $formData['showerflowrate'][0] ) ) {
		echo ',';
		echo 'ShowerFlowRate :' . '"' . $formData['showerflowrate'][0] . '"';
	}
	if ( isset( $formData['toiletflushgpf'][0] ) ) {
		echo ',';
		echo 'ToiletFlushGPF:' . '"' . $formData['toiletflushgpf'][0] . '"';
	}
	if ( isset( $formData['faucetflowrate'][0] ) ) {
		echo ',';
		echo ' FaucetFlowRate:' . '"' . $formData['faucetflowrate'][0] . '"';
	}
	if ( isset( $formData['lightingtype'][0] ) ) {
		echo ',';
		echo 'LightingType :' . '"' . $formData['lightingtype'][0] . '"';
	}
	if ( isset( $formData['hometowndup'][0] ) ) {
		echo ',';
		echo 'HomeTownDup :' . '"' . $formData['hometowndup'][0] . '"';
	}
	if ( isset( $formData['homefrontdirection'][0] ) ) {
		echo ',';
		echo 'HomeFrontDirection :' . '"' . $formData['homefrontdirection'][0] . '"';
	}
	echo '};';
	?>
  /*	if (Object.keys(selectGroups).length > 0) {
   for (optName in selectGroups) {
   setSelected(optName, selectGroups[optName], "selected", true);
   }
   }*/

	<?php
	echo 'var checkGroups = {';
	if ( isset( $formData['bathroomfandetails_1'][0] ) ) {
		echo 'BathroomFanDetails_1 : \'' . $formData['bathroomfandetails_1'][0] . '\',';
	}

	if ( isset( $formData['appliances_1'][0] ) ) {
		echo 'Appliances_1 : \'' . $formData['appliances_1'][0] . '\',';
	}

	if ( isset( $formData['solarpv_1'][0] ) ) {
		echo 'SolarPV_1 : \'' . $formData['solarpv_1'][0] . '\'';
	}
	echo '};'
	?>
  /*	if (Object.keys(checkGroups).length > 0) {
   for (chkName in checkGroups) {
   setChecked(chkName, checkGroups[chkName])
   }
   }*/

  //Call show/hide f(x) on page load if necessary
	<?php

	if ( $formData['wallscharacgen'][0] == 'Yes' ) {
		echo '$(".Walls").show();';
		echo '$(".Walls").css("visibility","visible");';
	}
	if ( $formData['windowscharacgen'][0] == 'Yes' ) {
		echo '$(".Windows").show();';
		echo '$(".Windows").css("visibility","visible");';
	}

	if ( $formData['foundtype2'][0] != 'None' ) {
		echo '$(".Foundation2Content").show();';
		echo '$(".Foundation2Content").css("visibility","visible");';
	}
	if ( $formData['roofconst2'][0] != 'None' ) {
		echo '$(".Roof2Content").show();';
		echo '$(".Roof2Content").css("visibility","visible");';
	}
	if ( $formData['attictype2'][0] != 'None' ) {
		echo '$(".Attic2Content").show();';
		echo '$(".Attic2Content").css("visibility","visible");';
	}
	if ( $formData['heatsystype1'][0] != 'None' ) {
		echo '$(".Heating1").show();';
		echo '$(".Heating1").css("visibility","visible");';
	}
	if ( $formData['heatsystype2'][0] != 'None' ) {
		echo '$(".Heating2").show();';
		echo '$(".Heating2").css("visibility","visible");';
	}
	if ( $formData['coolsystype1'][0] != 'None' ) {
		echo '$(".Cooling1").show();';
		echo '$(".Cooling1").css("visibility","visible");';
	}
	if ( $formData['coolsystype1'][0] != 'None' ) {
		echo '$(".Cooling2").show();';
		echo '$(".Cooling2").css("visibility","visible");';
	}
	?>



  // Sync data on objects built by PHP on page load
  syncFormToLoadedData(radioGroups, selectGroups, checkGroups);

</script>



</body>
</html>
