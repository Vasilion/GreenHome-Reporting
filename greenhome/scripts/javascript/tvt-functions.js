//Gloval var to hold the value of the audit type
var formID = '';


//Init Function to add blur events to all inputs
function Init() {

    //pull form ID
    formID = $('#formId').val();

    //Set validation to fire on blur
    //todo: change to validate onChange, save onBlur
    $(':input').each(function (index) {
        if (this.type !== 'file')
            $(this).bind('blur', validate);
    });

    //Sets max value of today's year on fields where min=1970, or heating/cooling system installations
    var d = new Date();
    $(':input[min="1970"]').attr({
        "max": d.getFullYear()
    });

    //Sets max value of today's year on fields where min=1600, or year built
    var b = new Date();
    $(':input[min="1600"]').attr({
        "max": b.getFullYear()
    });


    //Show first tab by default
    $('#Information').css('display', "block");
    $('.tvt-tab li a').first().addClass('active');

    //Set defaults if blank form
    if ($("[name='AssessFName']").val() === '') {

        //Initializes Select Fields
        setSelectField('FoundType1', 'None');
        setSelectField('FoundType2', 'None');
        setSelectField('RoofConst1', 'None');
        setSelectField('RoofConst2', 'None');
        setSelectField('AtticType1', '  None');
        setSelectField('AtticType2', '  None');
        setSelectField('HeatSysType1', 'None');
        setSelectField('HeatSysType2', 'None');
        setSelectField('CoolSysType1', 'None');
        setSelectField('CoolSysType2', 'None');
        setSelectField('HomeTownDup', 'Detached Single Family Home');

        //Initializes Radio Buttons
        setRadioButton('BlowerDoorTest', 'No');
        setRadioButton('WinGenKnownUandSHGC', 'No');
        setRadioButton('WinFrontKnownUandSHGC', 'No');
        setRadioButton('WinBackKnownUandSHGC', 'No');
        setRadioButton('WinRightKnownUandSHGC', 'No');
        setRadioButton('WinLeftKnownUandSHGC', 'No');
        setRadioButton('SkylightKnownUandSHGC', 'No');
        setRadioButton('HeatSysEffic1', 'Yes');
        setRadioButton('HeatSysEffic2', 'Yes');
        setRadioButton('CoolSysEffic1', 'Yes');
        setRadioButton('CoolSysEffic2', 'Yes');
        setRadioButton('Duct2Have', 'No');
    }

    //unbind enter key to prevent accidental saves
    $('form').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.stopPropagation();
                return false;
            }
        }
    );

    removeRequiredFromHiddenFields();

    //Ensure all buttons and drop downs are initiated correctly
    $(':checked').click().blur();
    $(':selected').change().blur();

    //Initializes Duct Percentage fields
    verifyDuctPercentage(1);
    verifyDuctPercentage(2);

}

function submitForm(){
    if(confirm("Are you ready to generate your Audit Report?"))
        $('form').submit();

}

function setSelectField(name, value) {
    var sct = $("select[name='" + name + "']");
    $(sct).val(value);
    $(sct).trigger('change');
}

function setRadioButton(name, targValue) {
    $("input[name='" + name + "'][value='" + targValue + "']").trigger('click');
}

function syncFormToLoadedData(radios, selects, checks) {
    if (Object.keys(radios).length > 0) {
        for (var radioName in radios) {
            setSelected(radioName, radios[radioName], "checked"); //run set checked with the name and value pair
        }
    }

    if (Object.keys(checks).length > 0) {
        for (var chkName in checks) {
            setChecked(chkName, checks[chkName])
        }
    }

    if (Object.keys(selects).length > 0) {
        for (var optName in selects) {
            setSelected(optName, selects[optName], "selected", true);
        }
    }

    //Toggle required once Audit Type data has loaded into form
    toggleRequiredFields(true);

}

/**
 * Validate form fields based on custom attributes
 */
function validate() {
    var error = false;
    //Required
    if ($(this).prop('required') && $(this).val() === '') {
        error = true;
    }

    //Numeric
    if ($(this).attr('numeric') != undefined && isNaN($(this).val())) {
        error = true;
    }

    //Match
    if ($(this).attr('tvt-match-name') != undefined) {
        var name = $(this).attr('tvt-match-name');
        if ($(this).val() != $("[name='" + name + "']").val() || $(this).val() == "") {
            error = true;
        }
    }

    //Duct Percentage
    if ($(this).attr('tvt-percent') != undefined) {
        var systemNumber = $(this).attr('tvt-percent');
        var locOne = $(" [name='DuctSysPerc" + systemNumber + "_1" + "']")[0];
        var locTwo = $(" [name='DuctSysPerc" + systemNumber + "_2" + "']")[0];
        var locThree = $(" [name='DuctSysPerc" + systemNumber + "_3" + "']")[0];
        var numOne = locOne.value === '' ? 0 : parseInt(locOne.value);
        var numTwo = locTwo.value === '' ? 0 : parseInt(locTwo.value);
        var numThree = locThree.value === '' ? 0 : parseInt(locThree.value);

        var locTotal = numOne + numTwo + numThree;

        if (locTotal != 100) {
            error = true;
        }
    }

    if (!this.validity.valid) {
        error = true;
    }

    var colorblind = document.getElementById('ColorBlindMode').checked;

    if (error) {
        if (colorblind) {
            $(this).addClass('errorColorBlind');
        } else {
            $(this).addClass('error');
        }
        $(this).prop({'tvt-invalid': true}).removeClass('saved').removeClass('saving');
    } else {
        $(this).removeClass('errorColorBlind').removeClass('error').removeAttr('tvt-invalid');
        saveField(this);
    }

}
/*
 function validateSubmit() {
 removeRequiredFromHiddenFields();

 var tabNames = ['#Information', '#Structure', '#System', '#Safety', '#SpotVentilation', '#WaterConservation', '#Electric'];
 var selectAttr = ' .error';
 for (var i = 0; i < tabNames.length; i++) {
 if ($(tabNames[i] + ' [required]').filter(selectAttr).length > 0) {
 var colorblind = document.getElementById('ColorBlindMode').checked;
 if(colorblind){
 $($('.tvt-tablinks span')[i]).removeClass('tab-complete-cb').addClass('tab-invalid-cb').parent().removeClass('tab-bar-complete-cb').addClass('tab-bar-invalid-cb');
 } else {
 $($('.tvt-tablinks span')[i]).removeClass('tab-complete').addClass('tab-invalid').parent().removeClass('tab-bar-complete').addClass('tab-bar-invalid');
 }
 } else {
 var colorblind = document.getElementById('ColorBlindMode').checked;
 if(colorblind){
 $($('.tvt-tablinks span')[i]).addClass('tab-complete-cb').removeClass('tab-invalid-cb').parent().addClass('tab-bar-complete-cb').removeClass('tab-bar-invalid-cb');
 } else {
 $($('.tvt-tablinks span')[i]).addClass('tab-complete').removeClass('tab-invalid').parent().addClass('tab-bar-complete').removeClass('tab-bar-invalid');
 }
 }
 var colorblind = document.getElementById('ColorBlindMode').checked;
 if(colorblind){
 $('#submit-btn').removeAttr('disabled').removeClass('btn-error-cb').addClass('btn-valid-cb');
 } else {
 $('#submit-btn').removeAttr('disabled').removeClass('btn-error').addClass('btn-valid');
 }
 if(colorblind){
 $('#submit-btn').prop('disabled', true).removeClass('btn-valid-cb').addClass('btn-invalid-cb');
 } else {
 $('#submit-btn').prop('disabled', true).removeClass('btn-valid').addClass('btn-invalid');
 }
 }
 }*/

/**
 * Finds all instances of a class and replaces it with another. The new class can be an empty string to remove it.
 * param original: is the class to be replaced
 * param newClass: is the class to take its place
 */
function replaceClass(original, newClass) {
    //Query selector all for a non living DomCollection. Allows for incremental for looping
    var oldClassElements = document.querySelectorAll('.' + original);

    for (var i = 0; i < oldClassElements.length; i++) {
        oldClassElements[i].className = oldClassElements[i].className.replace(new RegExp('(?:^|\\s)' + original + '(?:\\s|$)'), ' ' + newClass);
    }
}

/**
 * Set colorblind colors to active
 */
function colorBlindMode() {

    if (document.getElementById('ColorBlindMode').checked) {

        replaceClass("saved", "savedColorBlind");
        replaceClass("saving", "savingColorBlind");
        replaceClass("error", "errorColorBlind");
        replaceClass("tab-complete", "tab-complete-cb");
        replaceClass("tab-bar-invalid", "tab-bar-invalid-cb");
        replaceClass("tab-invalid", "tab-invalid-cb");
        replaceClass("error-lbl", "error-lbl-cb");
        replaceClass("saving-lbl", "saving-lbl-cb");
        replaceClass("saved-lbl", "saved-lbl-cb");
        replaceClass("btn-valid", "btn-valid-cb");
        replaceClass("btn-invalid", "btn-invalid-cb");

    } else {

        replaceClass("savedColorBlind", "saved");
        replaceClass("savingColorBlind", "saving");
        replaceClass("errorColorBlind", "error");
        replaceClass("tab-complete-cb", "tab-complete");
        replaceClass("tab-bar-invalid-cb", "tab-bar-invalid");
        replaceClass("tab-invalid-cb", "tab-invalid");
        replaceClass("error-lbl-cb", "error-lbl");
        replaceClass("saving-lbl-cb", "saving-lbl");
        replaceClass("saved-lbl-cb", "saved-lbl");
        replaceClass("btn-valid-cb", "btn-valid");
        replaceClass("btn-invalid-cb", "btn-invalid");
    }

} //end of function

/**
 * Adds default upgrade recommendations within the water conservation tab
 */
function defaultUpgradeValues(field) {
    if (field == "shower") {
        var f = document.getElementById("ShowerFlowRate").value;
        if (f == "2" || f == "2.5" || f == "Greater than 2.5") {
            $('#ShowerHeadUpgrade').val("Consider upgrading shower head(s) to 1.5 gallons per minute (GPM) - Saving water also saves energy for water heating").trigger('blur');
        } else {
            $('#ShowerHeadUpgrade').val("").trigger('blur');
        }
    } else if (field == "toilet") {
        var f = document.getElementById("ToiletFlushGPF").value;
        if (f == "1.6" || f == "Greater than 1.6") {
            $('#ToiletUpgrade').val("Toilets use the most water in a home. Consider 1.1 or .8 toilets to reduce usage").trigger('blur');
        } else {
            $('#ToiletUpgrade').val("").trigger('blur');
        }

    } else if (field == "faucet") {
        var f = document.getElementById("FaucetFlowRate").value;
        if (f == "1.5" || f == "2" || f == "2.5" || f == "Greater 2.5") {
            $('#FaucetUpgrade').val("Consider upgrading faucet(s) aerator's to 1 or .5 gallons per minute (GPM) - Saving water also saves energy for water heating").trigger('blur');
        } else {
            $('#FaucetUpgrade').val("").trigger('blur');
        }
    } else if (field == "lighting") {
        var f = document.getElementById("LightingType").value;
        if (f == "CFL" || f == "Incandescent") {
            $('#LightingUpgrade').val("Upgrade to all LEDs as soon as possible to get an immediate energy and cost savings​. LED's qualify​ for a rebate from your utility").trigger('blur');
        } else {
            $("#LightingUpgrade").val("").trigger('blur');
        }
    } else if (field == "DryerVented_1") {
        var f = document.getElementById("DryerVented_1").checked;
        if (!f) {
            $('#DuctSysOtherRecom').val("Make sure your dryer is properly vented with no leaks and that the vent is fully connected and exhausting outdoors. Consider purchasing a condensing dryer which is more efficient and allows you plug the hole used to vent the dryer which can save you energy").trigger('blur');
        } else {
            $('#DuctSysOtherRecom').val("").trigger('blur');
        }
    }
}

/**
 * Toggle required markup for required class
 * @param hardReset
 */

function toggleRequiredFields(hardReset, targetInput) {
    //Pull selected Text from Audit Type
    var auditName = $('#AuditType').val();

    var targetClass = '';
    if (auditName) {
        if (auditName.indexOf("Energy") != -1) {
            targetClass = "HomeEnergyScoreReq"
        } else if (auditName.indexOf("Home") != -1) {
            targetClass = "HomeInspectionReq";
        } else if (auditName.indexOf("Holland") != -1) {
            targetClass = "HollandReq"
        }
    } else {
        targetClass = "HomeInspectionReq";
    }

    if (targetInput) {
        $(targetInput).prop('required', true);
    } else {
        //remove all association with previously selected audit type
        //only used on change for audit type field.
        if (hardReset) {
            removeRequiredMarkup();
        }

        addRequiredMarkup(targetClass, hardReset); //Ignore :visible selector if hard reset is true
    }
}//end of function

/**
 * Add asterisk and bold to required fields
 * @param targetClass
 */
function addRequiredMarkup(targetClass, includeHidden) {
    var selectorText = '.' + targetClass;
    //selectorText += (includeHidden) ? '' : ":visible";

    $(selectorText).each(function () {
        //add attributes to input
        $(this).prop('required', true);

        //pull associated label
        if ($(this).parent().parent().parent().children().first().hasClass('tvt-field-label')) {
            $(this).parent().parent().parent().children().first().addClass('tvt-field-required');
        } else {
            $.each($(this).parent()[0].children, function () {
                if ($(this).is('label') && !$(this).hasClass("tvt-field-required")) {
                    //set class
                    $(this).addClass('tvt-field-required').prop('required', true).prop('tvt-invalid', true);
                }
            });
        }
    });
}

/**
 * remove all required styling and asterisk from form
 */
function removeRequiredMarkup() {
    $('.tvt-field-required').removeClass('tvt-field-required');
}

/**
 * Special case for smoke and CO
 * Show hide based on selected index
 */
function hideSmokeAndCORec() {
    var temp = $('#SmokeandCO').find(":selected").index();
    if (temp == 1 || temp == 4 || temp == 0) {
        $('.SmokeAndCORec').hide();
    } else {
        $('.SmokeAndCORec').show();
    }
}

/**
 * Change tabs between pages of the form
 * @param evt
 * @param tabName
 */
function openTab(evt, tabName) {

    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tvt-tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tvt-tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";

    if (evt) {
        evt.currentTarget.className += " active";
    } else {
        $($('.tvt-tablinks')[0]).addClass('active');
    }


	removeRequiredFromHiddenFields();
}

/**
 * Build assembly codes for API
 * @param name
 * @param one
 * @param two
 * @param three
 * @returns {*}
 */
function genericAssemblyCode(name, one, two, three) {
    //one = s, two = c, three = aa
    if (name == "Window" || name == "Skylight") {
        if (one == 's') {
            if (three == 'aa') {
                three = 'na';
            } else if (three == 'aw') {
                three = nw;
            }
            return one + two + three;
        } else if (one == 'thmabw') {
            return one;
        }
    }
    return one + two + three;
}

/**
 * Generage Duct Percentage for given systemNumber
 * @param systemNumber
 */
function verifyDuctPercentage(systemNumber) {

    //set System Class
    var systemClass = ".Duct" + systemNumber + "Content";

    //Pull input values
    var locOne = $(systemClass + " [name='DuctSysPerc" + systemNumber + "_1" + "']")[0];
    var locTwo = $(systemClass + " [name='DuctSysPerc" + systemNumber + "_2" + "']")[0];
    var locThree = $(systemClass + " [name='DuctSysPerc" + systemNumber + "_3" + "']")[0];

    //parse Values to int
    var numOne = locOne.value === '' ? 0 : parseInt(locOne.value);
    var numTwo = locTwo.value === '' ? 0 : parseInt(locTwo.value);
    var numThree = locThree.value === '' ? 0 : parseInt(locThree.value);

    var locOnePlusTwo = numOne + numTwo;
    var locTotal = numOne + numTwo + numThree;

    //Check Validation
    if (locTotal === 100 || locOnePlusTwo === 100 || locOne.value == '') {
        //Remove error classes
        $(locOne).removeClass("error");
        $(locThree).removeClass("error");
        $(locTwo).removeClass("error");
    } else {
        $(locOne).addClass("error");
        $(locThree).addClass("error");
        $(locTwo).addClass("error");
    }

    //Set Show/Hide
    if (locOne.value < 100) {
        if (locOne.value != '') {
            $(locTwo).parent().parent().show();
        } else {
            $(locTwo).parent().parent().hide();
            $(locTwo).val('');
        }
        if (locTwo.value != '' && locOnePlusTwo < 100) {
            $(locThree).parent().parent().show();
        } else {
            $(locThree).parent().parent().hide();
            $(locThree).val('');
        }

    } else {
        $(locTwo).parent().parent().hide();
        $(locTwo).val('');
        $(locThree).parent().parent().hide();
        $(locThree).val('');
    }

}

/**
 * Ensure all the API fields are validated
 * @param isConstruct
 * @param idOne
 * @param idTwo
 * @param idThree
 */
function checkValidationForAPI(isConstruct, idOne, idTwo, idThree) {
    var construct = document.getElementById(idOne);
    var insType = document.getElementById(idTwo);
    var extFinish = document.getElementById(idThree);

    insType.disabled = false;
    extFinish.disabled = false;


    if (construct.value == "ewbr") {

        for (var i = 0; i < extFinish.length; i++) {
            if (extFinish[i].value != 'nn') {
                extFinish[i].disabled = true;
                $(extFinish[i]).hide();
            } else {
                extFinish[i].disabled = false;
                $(extFinish[i]).show();
            }
        }

        for (var j = 0; j < insType.length; j++) {
            if (!(insType[j].value == '00' || insType[j].value == '05' || insType[j].value == '10')) {
                insType[j].disabled = true;
                $(insType[j]).hide();
            } else {
                insType[j].disabled = false;
                $(insType[j]).show();
            }
        }

    } else if (construct.value == "ewcb") {

        for (var i = 0; i < extFinish.length; i++) {

            if (!(extFinish[i].value == 'st' || extFinish[i].value == 'br' || extFinish[i].value == 'nn')) {
                extFinish[i].disabled = true;
                $(extFinish[i]).hide();
            } else {
                extFinish[i].disabled = false;
                $(extFinish[i]).show();
            }
        }

        for (var j = 0; j < insType.length; j++) {

            if (!(insType[j].value == '00' || insType[j].value == '03' || insType[j].value == '06')) {
                insType[j].disabled = true;
                $(insType[j]).hide();
            } else {
                insType[j].disabled = false;
                $(insType[j]).show();
            }
        }

    } else if (construct.value == "ewsb") {

        for (var i = 0; i < extFinish.length; i++) {
            if (extFinish[i].value != 'st') {
                extFinish[i].disabled = true;
                $(extFinish[i]).hide();
            } else {
                extFinish[i].disabled = false;
                $(extFinish[i]).show();
            }
        }
        for (var j = 0; j < insType.length; j++) {
            if (!(insType[j].value == '00')) {
                insType[j].disabled = true;
                $(insType[j]).hide();
            } else {
                insType[j].disabled = false;
                $(insType[j]).show();
            }
        }
    } else if (construct.value == '') {
        insType.disabled = true;
        extFinish.disabled = true;

    } else {
        for (var i = 0; i < extFinish.length; i++) {
            if (extFinish[i].value == 'nn') {
                extFinish[i].disabled = true;
                $(extFinish[i]).hide();
            } else {
                extFinish[i].disabled = false;
                $(extFinish[i]).show();
            }
        }

        if (construct.value == 'ewwf' || construct.value == 'ewps') {
            for (var j = 0; j < insType.length; j++) {
                if (insType[j].value == '05' || insType[j].value == '06' || insType[j].value == '10' || insType[j].value == '27' || insType[j].value == '33' || insType[j].value == '38') {
                    insType[j].disabled = true;
                    $(insType[j]).hide();
                } else {
                    insType[j].disabled = false;
                    $(insType[j]).show();
                }
            }
        } else {
            for (var j = 0; j < insType.length; j++) {
                if (!(insType[j].value == '19' || insType[j].value == '21' || insType[j].value == '27' || insType[j].value == '33' || insType[j].value == '38')) {
                    insType[j].disabled = true;
                    $(insType[j]).hide();
                } else {
                    insType[j].disabled = false;
                    $(insType[j]).show();
                }
            }
        }
    }
    if (isConstruct) {
        insType.selectedIndex = 0;
        extFinish.selectedIndex = 0;
    }
}

/**
 * Check window validation
 * @param isPane
 * @param isGlaze
 * @param idOne
 * @param idTwo
 * @param idThree
 */
function checkValidationForWindows(isPane, isGlaze, idOne, idTwo, idThree) {
    var paneType = document.getElementById(idOne);
    var glazeType = document.getElementById(idTwo);
    var frameType = document.getElementById(idThree);

    glazeType.disabled = false;
    frameType.disabled = false;

    if (paneType.value == 's') {
        frameType[1].value = 'na';
        frameType[3].value = 'nw';
    } else {
        frameType[1].value = 'aa';
        frameType[3].value = 'aw';
    }

    if (paneType.value == 's') {

        for (var i = 0; i < glazeType.length; i++) {
            if (!(glazeType[i].value == 'c' || glazeType[i].value == 't')) {
                glazeType[i].disabled = true;
                $(glazeType[i]).hide();
            } else {
                glazeType[i].disabled = false;
                $(glazeType[i]).show();
            }
        }
        for (var j = 0; j < frameType.length; j++) {
            if (frameType[j].value == 'ab') {
                frameType[j].disabled = true;
                $(frameType[j]).hide();
            } else {
                frameType[j].disabled = false;
                $(frameType[j]).show();
            }
        }
    } else if (paneType.value == 'd') {
        for (var i = 0; i < glazeType.length; i++) {
            glazeType[i].disabled = false;
            $(glazeType[i]).show();
        }
        if (glazeType.value == 'pe' || glazeType.value == 'sea') {
            for (var i = 0; i < frameType.length; i++) {
                if (!(frameType[i].value == 'aw')) {
                    frameType[i].disabled = true;
                    $(frameType[i]).hide();
                } else {
                    frameType[i].disabled = false;
                    $(frameType[i]).show();
                }
            }
        } else if (glazeType.value == 'pea') {
            for (var i = 0; i < frameType.length; i++) {
                if (frameType[i].value == 'aa') {
                    frameType[i].disabled = true;
                    $(frameType[i]).hide();
                } else {
                    frameType[i].disabled = false;
                    $(frameType[i]).show();
                }
            }
        } else {
            for (var i = 0; i < frameType.length; i++) {
                frameType[i].disabled = false;
                $(frameType[i]).show();
            }
        }
    } else if (paneType.value == '') {
        glazeType.disabled = true;
        frameType.disabled = true;

    } else {
        for (var i = 0; i < glazeType.length; i++) {
            if (!(glazeType[i].value == 'pea')) {
                glazeType[i].disabled = true;
                $(glazeType[i]).hide();
            } else {
                glazeType[i].disabled = false;
                $(glazeType[i]).show();
            }
        }
        for (var i = 0; i < frameType.length; i++) {
            if (!(frameType[i].value == 'aw')) {
                frameType[i].disabled = true;
                $(frameType[i]).hide();
            } else {
                frameType[i].disabled = false;
                $(frameType[i]).show();
            }
        }
    }
    if (isPane) {
        glazeType.selectedIndex = 0;
        frameType.selectedIndex = 0;
    }
    if (isGlaze) {
        frameType.selectedIndex = 0;
    }
}

/**
 * Check roof validation
 * @param isConstruct
 * @param idOne
 * @param idTwo
 * @param idThree
 */
function checkValidationForRoof(isConstruct, idOne, idTwo, idThree) {
    var construct = document.getElementById(idOne);
    var extFinish = document.getElementById(idThree);
    var insLevel = document.getElementById(idTwo);

    insLevel.disabled = false;
    extFinish.disabled = false;

    if (construct.value == 'rfrb') {
        for (var i = 0; i < insLevel.length; i++) {
            if (!(insLevel[i].value == '00')) {
                insLevel[i].disabled = true;
                $(insLevel[i]).hide();
            } else {
                insLevel[i].disabled = false;
                $(insLevel[i]).show();
            }
        }
    } else if (construct.value == 'rfps') {
        for (var i = 0; i < insLevel.length; i++) {
            if (insLevel[i].value == '27' || insLevel[i].value == '30') {
                insLevel[i].disabled = true;
                $(insLevel[i]).hide();
            } else {
                insLevel[i].disabled = false;
                $(insLevel[i]).show();
            }
        }
    } else if (construct.value == '') {
        insLevel.disabled = true;
        extFinish.disabled = true;

    } else {
        for (var i = 0; i < insLevel.length; i++) {
            insLevel[i].disabled = false;
            $(insLevel[i]).show();
        }
    }
    if (isConstruct) {
        extFinish.selectedIndex = 0;
        insLevel.selectedIndex = 0;
    }

}

/**
 * Set selected on page load based on params
 * @param name: name of the select to target
 * @param value: value to be selected
 * @param property: "selected" or "checked"
 * @param isSelect: denotes select, default is radio button
 */
function setSelected(name, value, property, isSelect) {
    if (value != '') {
        if (isSelect) {
            var sct = $("select[name='" + name + "']")[0];

            for (sctOpt in sct.children) {
                if (sct.children[sctOpt].value == value) {
                    $(sct.children[sctOpt]).prop(property, true);
                    $(sct.children[sctOpt]).trigger('change');
                    break;
                }
            }
        } else {
            $("input[name='" + name + "'][value='" + value + "']").trigger('click');
        }
    }
}

/**
 * Spilt checkbox inputs on page load
 * select the appropriate controls
 * @param name: input name to target
 * @param value: list of values to match up
 */
function setChecked(name, value) {
    var chkd = $("[name='" + name + "']");
    var valueList = value.split('|');

    for (var i = 0; i < valueList.length; i++) {
        for (var j = 0; j < chkd.length; j++) {
            if (valueList[i] == chkd[j].value) {
                $(chkd[j]).click();
                break;
            }
        }
    }

}

/**
 * POST element data to PHP script
 * @param elem
 */
function saveField(elem) {

    var colorblind = document.getElementById('ColorBlindMode').checked;


    //check for checkbox control
    if (elem.type == 'checkbox') {
        //pull all checked inputs with same name, concatenate values, save
        var valueString = '';
        $("[name='" + elem.name + "']:checked").each(
            function () {
                valueString += this.value + '|';
            }
        );

        valueString = valueString.substr(0, valueString.length - 1);
        var dataString = "name=" + elem.name.toLowerCase() + "&value=" + valueString + "&id=" + formID;
    } else {
        $(elem).removeClass('saved');
        $(elem).removeClass('savedColorBlind');
        if (colorblind) {
            $(elem).addClass('savingColorBlind');
        } else {
            $(elem).addClass('saving');
        }

        var dataString = "name=" + elem.name.toLowerCase() + "&value=" + elem.value + "&id=" + formID;
    }

    $.ajax({
        type: "POST",
        url: "../wp-content/themes/greenhome/scripts/php/save_field.php",
        data: dataString
    }).done(
        function () {
            $(elem).removeClass('saving');
            $(elem).removeClass('savingColorBlind');

            colorblind = document.getElementById('ColorBlindMode').checked;
            if (colorblind) {
                $(elem).addClass('savedColorBlind');
            } else {
                $(elem).addClass('saved');
            }
        }
    );
}

/**
 * Toggle required based on "None" selection
 * @param input
 * @param targetDivClass
 */
function toggleRequiredByInput(input, targetDivClass, hideValue) {
    //pull value
    var inputValue = input.value;

    //check for predefined hide values
    if (inputValue == hideValue) {
        $('.' + targetDivClass + " :input").removeAttr('tvt-invalid').removeAttr('required').removeClass('error');
        $('.' + targetDivClass + " label").removeClass("tvt-field-required").parent().hide();
        $('.' + targetDivClass + " .tvt-red-text").remove();
    } else {
        $('.' + targetDivClass + " :input").show();
        $('.' + targetDivClass + " label").show();
        $('.' + targetDivClass + " div").show();
        $(this).show();

        //fire off show/hide from any radio buttons
        $('input [type="radio"]:selected').click();
    }

    //re-display the initial input
    //$(input).parent().show();

    //toggle required fields based on what is shown in the targetDivClass
    toggleRequiredFields(false);
}

/**
 * One hide function to rule them all.
 * @param value
 * @param hideValue
 * @param targetClass
 * @param callback
 */
function omniHide(elem, hideValue, targetClass, isQuestionDiv) {
    var hideDiv = (elem.value === hideValue);


    toggleEnabledMarkupByParent(targetClass, hideDiv, hideValue, isQuestionDiv);
    removeRequiredFromHiddenFields(elem);
}

/**
 * Add/remove enabled markup including styles and attributes
 * to any element that matches the audit type
 * @param targetClass
 * @param hideDiv
 */
function toggleEnabledMarkupByParent(targetClass, hideDiv, hideValue, isQDiv) {

    if (isQDiv) {
        if ($('.' + targetClass).has(':input')) {
            $('.' + targetClass + ' input').each(function () {
                toggleRequiredByInput(this, targetClass, hideValue);
            });
        }
    }

    //Pull child divs
    $('.' + targetClass + " div").each(function () {

        //Analyze type of input (radio, checkbox, input, select)
        if ($(this).has('p').length) {
            //we have radio
            $(this).find('p').each(function () {
                toggleRequiredClassByElement($(this).first(), hideDiv);
            });
        }

        if ($(this).has('label').length > 1) {
            //we have chk
            if ($(this).find('label').has("input").length) {
                toggleRequiredClassByElement($(this).find("label").first(), hideDiv);
            }
        }

        if ($(this).has(':input').length) {
            //we have inputs
            toggleRequiredClassByElement($(this).find(":input")[0], hideDiv);
        }

        if (hideDiv) {
            // zero is always the first label
            // remove the asterisk and style
            $(this).first().children().first().removeClass('tvt-field-required');
        } else {
            if ($(this).first().children().last().hasClass(getTargetClassFromAuditType())) {
                $(this).first().children().first().addClass('tvt-field-required');
            }
        }
    });

    if (hideDiv) {
        $('.' + targetClass).hide();
    } else {
        $('.' + targetClass).show();

        //fire off show/hide from any radio buttons
        $('.' + targetClass + ' input [type="radio"]:selected').click();
    }
}

/**
 * Toggle required from the element
 * @param elem
 * @param toRemove
 * @returns {*}
 */
function toggleRequiredClassByElement(elem, toRemove) {
    if (toRemove) {
        $(elem).prop('required', false);
    } else {
        var auditClass = getTargetClassFromAuditType();

        if ($(elem).hasClass(auditClass)) {
            $(elem).prop('required', true);
        }
    }

    return toRemove;
}

/**
 * Return the class associated with the audit type
 * @returns {*}
 */
function getTargetClassFromAuditType() {
    //Pull selected Text from Audit Type
    var auditName = $('#AuditType').val();

    if (auditName) {
        if (auditName.indexOf("Energy") != -1) {
            return "HomeEnergyScoreReq"
        } else if (auditName.indexOf("Home") != -1) {
            return "HomeInspectionReq";
        } else if (auditName.indexOf("Holland") != -1) {
            return "HollandReq";
        }
    } else {
        return "HomeInspectionReq";
    }
}

function removeRequiredFromHiddenFields(elem) {
    var auditClass = '.' + getTargetClassFromAuditType();

    $('form').find(':input').find(auditClass).filter(":hidden").filter(function () {
        return this.value;
    }).removeAttr('required').parent().first().removeClass('tvt-field-required');
}

/*function isSubmitValid(){
 return $('form').find(':input').filter("." + getTargetClassFromAuditType()).filter(":hidden").filter(function(){return this.value;}).length === 0;
 }*/
/*
 function evaluateFieldsOnTabChange() {
 var auditClass = getTargetClassFromAuditType();
 $().find('.' + auditClass).find(":input").each(
 function(){
 validate();
 }
 )

 }*/

//Call Init Function
Init();
