Number.prototype.fixedToTwo = function () {
    return this.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    })
}

function standardDate(date) {
    const dd = String(date.getDate()).padStart(2, '0');
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const yyyy = date.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
}

var autocomplete;
var autocomplete2;

function kangaroo() {
    if (debug) {
        console.log('init');
    }

    function autoCompleteDestinationCallback(predictions, status) {
        if (debug === true) {
            console.log(predictions);
        }
        var destList = '';
        $.each(predictions, function (key, val) {
            destList += '<li class="py-2 border-bottom cursor-pointer" data-destid="' + val.place_id + '"><i class="text-muted la la-map-marker"></i> ' + val.description + '</li>';
        });
        $('#destinationList').html(destList);
        $('#destinationList').slideDown();
        var i = 0;
        var destinationId = '';
        $('#destinationList').off("click");
        $('#destinationList').on('click', 'li', function () {
            destinationId = $(this).data('destid');
            $('#destination').val($(this).text());
            $('#destinationList').slideUp();
            $('#initialDropOffId').val(destinationId);
            if (debug === true)
                console.log(destinationId);
            if ($('input[name="bookingType"]').val() == 'Package') {
                calculateDistance(destinationId);
            } else {
                calculateAndDisplayRoute(destinationId);
            }
        });
    }

    $('#destination').on('keyup', function () {
        if ($('#destination').val().length > 2) {
            autocomplete = new google.maps.places.AutocompleteService();
            var request = {
                input: $('#destination').val(),
                componentRestrictions: { country: 'lk' },
            };
            autocomplete.getPlacePredictions(request, autoCompleteDestinationCallback);
        }
    });

    function autoCompleteOriginCallback(predictions, status) {
        if (debug) {
            console.log(predictions);
        }
        var originList = '';
        $.each(predictions, function (key, val) {
            originList += '<li class="py-2 border-bottom cursor-pointer" data-originid="' + val.place_id + '"><i class="text-muted la la-map-marker"></i> ' + val.description + '</li>';
        });
        $('#originList').html(originList);
        $('#originList').slideDown();
        var i = 0;
        var destinationId = '';
        $('#originList').off("click");
        $('#originList').on('click', 'li', function () {
            originId = $(this).data('originid');
            $('#origin').val($(this).text());
            $('#originList').slideUp();
            $('#pickUpId').val(originId);
            if (debug === true) {
                console.log(originId);
            }
            if ($('input[name="bookingType"]').val() == 'Package') {
                calculateDistance(originId);
            } else {
                calculateAndDisplayRoute(originId);
            }
        });
    }

    $('#origin').on('keyup', function () {
        if ($('#origin').val().length > 2) {
            autocomplete = new google.maps.places.AutocompleteService();
            var request = {
                input: $('#origin').val(),
                componentRestrictions: { country: 'lk' },
            };
            autocomplete.getPlacePredictions(request, autoCompleteOriginCallback);
        }
    });
}

function packages_assign_vals(json, vehicularType) {
    $("input").prop('disabled', false);
    if (json.status !== 'success') {
        //alert('Pickup location is out of bound');
        if (debug) {
            console.log('1st');
        }

        $('#package-fare').html('');
        $('#fares').slideDown();
        $('#fares').html('<div class="text-danger text-small text-center py-3">' + json.message + '</div>');
        $('#fareDetLabel').hide();
        // modalTrigger('No',json.message);
        $("input#submitBtn, input[type='submit']").prop('disabled', true);
    } else {
        if ($('input[name="vehicularType"]').length && vehicularType === undefined) {
            if (debug) {
                console.log('2nd');
            }
            $('#fares').slideDown();
            $("input#submitBtn, input[type='submit']").prop('disabled', true);
            $('#fares').html('<div class="text-info text-small py-3 text-center">Please select a vehicle type</div>');
            $('#fareDetLabel').hide();
        } else {
            if (debug) {
                console.log('3rd: ' + vehicularType);
            }
            var filtered = null;
            var filteredfare = null;
            if (typeof json.message[vehicularType] === 'undefined' || json.message[vehicularType] === null) {
                $('#fares').slideDown();
                $("input#submitBtn, input[type='submit']").prop('disabled', true);
                $('#fares').html('<div class="text-danger text-small py-3 text-center">No packages available for this vehicle type. Please contact the call centre 011 2588 588</div>');
                $('#fareDetLabel').hide();
            } else {
                $("input#submitBtn, input").prop('disabled', false);

                filtered = json.message[vehicularType];
                filteredfare = filtered.fare;
                const realDistance = parseFloat(filtered.realDistance);
                const packageBaseKM = parseFloat(filtered.packageBaseKM);
                const per_km = parseFloat(filtered.per_km);

                let finalfarePickup = parseFloat(filteredfare);
                finalfarePickup = finalfarePickup + (realDistance > packageBaseKM ? ((realDistance - packageBaseKM) * per_km) : 0);
                finalfarePickup = (finalfarePickup).toLocaleString(undefined, {
                    'minimumFractionDigits': 2,
                    'maximumFractionDigits': 2
                });
                $('#fares').slideDown(function () {
                    $('#fares').html('<div class="row justify-content-center">' +
                        '<div class="col-md-6">' +
                        '<div class="h2 text-center text-bold pt-3 mb-0" id="package-fare">LKR ' + finalfarePickup + '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col">' +
                        '<div class="text-center text-small" id="fareEstLabel">FARE ESTIMATE</div>' +
                        '<div class="text-center text-small mb-4" id="fareDetLabel">Base tour distance: ' + filtered.realDistance + ' km | Rate per exceeding km: LKR ' + filtered.per_km + '.00</div>' +
                        '</div>' +
                        '</div>')
                });
                $('input[name="detailedPickUpAddress"]').val(filtered.detailedPickUpAddress);
                $('input[name="pickUpLat"]').val(filtered.pickUpLat);
                $('input[name="pickUpLng"]').val(filtered.pickUpLng);
                $('input[name="initialDropOffLat"]').val(filtered.initialDropOffLat);
                $('input[name="initialDropOffLng"]').val(filtered.initialDropOffLng);
                $('input[name="fare"]').val(finalfarePickup);
            }
        }
    }
}

function calculateDistance(place) { // used in packages
    $("#submitBtn").attr("disabled", true);

    var origin = $('form[name="booking-add-package"] input[name="pickUpAddress"]').val();
    var destination = $('form[name="booking-add-package"] input[name="dropOffAddress"]').val();
    var days = $('select[name="days"] option:selected').val();
    $('#getPackages').prop('disabled', true);
    $(".booking .message").slideUp("slow", function () {
        // Animation complete.
        $(this).html('');
    });
    if (origin && destination && origin !== '' && destination !== '') {
        $('#fares').slideDown(function () {
            $(this).html('<img src="' + site_url + 'resources/images/waiting.gif" class="mx-auto d-block" width="80">');
        });
        $("input#submitBtn, input").prop('disabled', true);
        $.ajax({
            data: {
                pickUpAddress: origin,
                dropOffAddress: destination,
                days: days,
                pickUpId: $('input[name="pickUpId"]').val(),
                initialDropOffId: $('input[name="initialDropOffId"]').val(),
                pickUpLat: $('input[name="pickUpLat"]').val(),
                pickUpLng: $('input[name="pickUpLng"]').val(),
                initialDropOffLat: $('input[name="initialDropOffLat"]').val(),
                initialDropOffLng: $('input[name="initialDropOffLng"]').val()
            },
            type: 'POST',
            url: site_url + 'ajax.php?process=fare_calc_packages_new',
            success: function (response) {
                if (debug) {
                    console.log(response);
                }
                var json = {};
                json = JSON.parse(response);
                if (debug) {
                    console.log(json);
                }

                var vehicularType = $('input[name="vehicularType"]:checked').val();

                packages_assign_vals(json, vehicularType);

                $('body form[name="booking-add-package"]').on('change', 'input[name="vehicularType"], select[name="days"]', function () {
                    vehicularType = $('input[name="vehicularType"]:checked').val();
                    if (debug === true) {
                        console.log(json.message);
                    }
                    packages_assign_vals(json, vehicularType);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX call failed.');
                console.log(textStatus + ': ' + errorThrown);
            },
            complete: function () {
                if (debug === true) {
                    console.log('AJAX call completed');
                }
            }
        });
    }
    return false;
}

$('body form[name="booking-add-package"]').on('change', 'select[name="days"]', function () {
    calculateDistance();
});

function distanceDirect(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2)
        ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180)
}


function calculateAndDisplayRoute(directionsService, place) { //used in airport and quick booking
    var root = $('input[name="root"]').val();
    $("#submitBtn").attr("disabled", true);
    var origin = $('form[name="booking-add-airport"] input[name="pickUpAddress"], form[name="booking-add"] input[name="pickUpAddress"]').val();
    var destination = $('form[name="booking-add-airport"] input[name="dropOffAddress"], form[name="booking-add"] input[name="dropOffAddress"]').val();

    var vtype = $('form[name="booking-add-airport"] input[name="vehicularType"], form[name="booking-add"] input[name="vehicularType"]').val();
    var telephone = $('form[name="booking-add-airport"] input[name="contactNumber"], form[name="booking-add"] input[name="contactNumber"]').val();

    function fareCalc() {
        $('#fares').slideUp();
        $('#fares_wait').show();
        const dataToSent = {
            place: JSON.stringify(place),
            root: root,
            origin: origin,
            destination: destination,
            initialDropOffId: $('#initialDropOffId').val(),
            pickUpId: $('#pickUpId').val(),
            /*pickUpLat: $('input[name="pickUpLat"]').val(),
            pickUpLng: $('input[name="pickUpLng"]').val(),
            initialDropOffLat: $('input[name="initialDropOffLat"]').val(),
            initialDropOffLng: $('input[name="initialDropOffLng"]').val()*/
        };
        //console.log(dataToSent);
        $.ajax({
            data: dataToSent,
            type: 'POST',
            url: site_url + 'ajax.php?process=fare_calc',
            success: function (response) {
                const json = JSON.parse(response);
                if (debug === true) {
                    console.log('fare-calc', json);
                }
                let n = localStorage.length + 1;
                while (n--) {
                    const key = localStorage.key(n);
                    if (/^kc-booking-/.test(key)) {
                        localStorage.removeItem(key);
                    }
                }
                localStorage.setItem('kc-booking-fares', response);
                let vehicularType = $('input[name="vehicularType"]:checked').val();

                function assign_vals(json, vehicularType) {

                    vehicularType = vehicularType.toLowerCase().replace("-", "");

                    let finalfarePickup;

                    if ($('.booking-validate input[name="vehicularType"]').length && vehicularType === undefined) {
                        alert('Please select a vehicle type');
                    } else {
                        const filtered = json[vehicularType];
                        if (debug) {
                            console.log('filtered', filtered);
                        }

                        $('#fares_vehi_type').html(filtered.nameEnglish);
                        $('#fares_vehi_desc').html(filtered.vdesc);
                        $('.fares_vehi_thumb').removeClass('d-none').addClass('d-none');
                        $('#fares_vehi_thumb_' + filtered.vtype.toLowerCase().replace("-", "")).removeClass('d-none');
                        $('#fares_max_passengers').html(filtered.max_pass);

                        finalfarePickup = parseFloat(filtered.fareDisp);

                        if ($('input[name="fares_nb"]').is(':checked')) {
                            if (filtered.hasOwnProperty('rate_card')) {
                                finalfarePickup = parseFloat(filtered.rate_card.guestCarrierRate);
                            } else {
                                finalfarePickup = parseFloat(filtered.fareDisp) + 2000;
                            }
                        }
                        finalfarePickup = finalfarePickup.fixedToTwo();
                        $('#fares_fare').html(finalfarePickup);
                        $('input[name="fare"]').val(finalfarePickup);
                        $('#callupcahrges').html(filtered.callupCharges);
                        $('input[name="callUpCharges"]').val(filtered.callupCharges);
                        $('#fares_rate').html(filtered.per_km);
                        $('#fares_hr').html(filtered.waiting);

                        $('input[name="packageID"]').val(filtered.packageID);
                        $('input[name="customPackageBaseKm"]').val(filtered.packageBaseKM);
                        $('input[name="customPackageBaseTime"]').val(filtered.packageBaseTime);
                        $('input[name="customPackageBaseRate"]').val(filtered.packageBaseRate);
                        $('input[name="pickUpLat"]').val(filtered.pickUpLat);
                        $('input[name="pickUpLng"]').val(filtered.pickUpLng);
                        if (filtered.hasOwnProperty(initialDropOffLat))
                            $('input[name="initialDropOffLat"]').val(filtered.initialDropOffLat);
                        if (filtered.hasOwnProperty(initialDropOffLng))
                            $('input[name="initialDropOffLng"]').val(filtered.initialDropOffLng);
                        $('input[name="detailedPickUpAddress"]').val(filtered.detailedPickUpAddress);

                    }
                }

                if (json.status !== 'danger') {
                    $('#fares').slideDown();
                    $('#fares_wait').hide();
                    assign_vals(json, vehicularType);
                    $("#submitBtn").attr("disabled", false);
                } else {
                    //something went wrong
                    if (debug === true) {
                        console.log(json.message);
                    }
                    modalTrigger('No', json.message);
                }

                $('body #quick-book-panel').on('change', 'input[name="vehicularType"], input[name="fares_nb"]', function () {
                    vehicularType = $('input[name="vehicularType"]:checked').val();
                    assign_vals(json, vehicularType);
                });

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX call failed.');
                console.log(textStatus + ': ' + errorThrown);
            },
            complete: function () {
                if (debug === true) {
                    console.log('AJAX call completed');
                }
            }
        });
    }
    if ((root === 'Pick' || root === 'Drop') && vtype !== '' && telephone !== '') {
        if (origin && destination && vtype && telephone && origin !== '' && destination !== '') {
            if (debug === true)
                console.log(root + ' 1');
            fareCalc();
        }
    } else if ((root !== 'Pick' && root !== 'Drop')) {
        if (origin && destination) {
            if (debug === true)
                console.log(root + ' 2');
            fareCalc();
        }
    } else {
        if (debug === true)
            console.log(root + ' 3');
        modalTrigger('No', 'Please make sure that a vehicle type and a valid mobile number is filled.');
        if (debug === true)
            console.log(root);
        if (root === 'Pick') {
            $('#destination').val('');
        } else if (root === 'Drop') {
            $('#origin').val('');
        }
    }


    /*if(origin && destination && type && telephone && origin !== '' && destination !== '' ){
        if((root === 'Pick' || root === 'Drop') && type !== '' && telephone !== '') {
            fareCalc();
        }else{
            modalTrigger('No', 'Please make sure that a vehicle type and a valid mobile number is filled.');
            console.log(root);
            if(root === 'Pick'){
                $('#destination').val('');
            }else if(root === 'Drop'){
                $('#origin').val('');
            }
        }
    }*/
    return false;
}

/* booking-confirm */
(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);


$('#quick-book-panel, .booking').on('click', '#submitBtn', function (e) {
    // console.log('hi');
    /* when the button in the form, display the entered values in the modal */
    $('#conf-origin').text($('#origin').val());
    $('#conf-destination').text($('#destination').val());
    if ($('input[name="bookingType"]').val() == 'Package') {
        $('#conf-return-div').show();
        $('#conf-return').text($('#origin').val());
    }
    $('#conf-name').text($('#customerFirstName').val() + ' ' + $('#customerLastName').val());
    $('#conf-datetime').text($('#datepicker, #datepickerPackage').val() + ' ' + $('#timepicker, #timepickerPackage').val());
    $('#conf-email').text($('#email').val());
    $('#conf-vtype').text($('input[name="vehicularType"]:checked').val());
    $('#conf-telephone').text('+' + $('#countrycode').val() + $('#telephone').val().replace(/^0+/, ''));
    if ($('#landmarks').val() !== '') {
        $('#conf-landmarks').text($('#landmarks').val());
    } else {
        $('#conf-landmarks').text('Not provided');
    }


    var confPaginBoard = $('#pagingBoard').val() !== '' ? $('#pagingBoard').val() : 'Not Requested';
    $('#conf-nameBoard').text(confPaginBoard);

    var confFlightNumber = $('#flightNumber').val() !== '' ? $('#flightNumber').val() : 'Not Provided';
    $('#conf-flightNumber').text(confFlightNumber);


    var thisForm = $(e.target).parents('form');
    if ($('input[name="root"]:checked').val() === 'Pick' && !$('input[name="fares_nb"]').prop('checked')) {
        //console.log('pickup-info');
        $('.pickup-info').show();
    } else {
        $('.pickup-info').hide();
    }

    if ($('input[name="root"]:checked').val() === 'Pick') {
        $('.pickup-info-more').show();
    } else {
        $('.pickup-info-more').hide();
    }

    var validated = validate(thisForm);
    if (validated.return !== "false") {
        $('#errorModal').modal('hide');
        $('#confirm-submit').modal('toggle');
    } else {
        e.preventDefault();
        $(thisForm).next('.message').html('');
        $('#errorModal .modal-body').html(validated.message);
        $('#errorModal').modal('toggle');
    }
});

$('#quick-book-panel, .booking').on('click', '#submit', function (e) {
    /* when the submit button in the modal is clicked, submit the form */
    if (debug) {
        console.log('submitting');
    }
    let root = $('input[name="root"]').val();
    let callUpChargesVal = $('input[name="callUpCharges"]').val();

    if ((root === 'Pick' || root === 'Guest' || (root === 'Drop' && callUpChargesVal > 0))) {
        
        /* Get advance payment for booking */
        const bookingForm = $('form[name="booking-add-airport"], form[name="booking-add"], form[name="booking-add-package"]');
        const serialised = bookingForm.serialize() + '&organization=kangarooweb';
        const serialisedFormJSON = bookingForm.serializeFormJSON();
        serialisedFormJSON.organization = 'kangarooweb';
    
        localStorage.setItem('kc-booking-details', JSON.stringify(serialisedFormJSON));
        localStorage.setItem('kc-booking-send', serialised);
        window.location.href = site_url + "payment";

    } else if (root == 'Quick'){
        $("#wait_quick_show_btn").hide();
        $("#wait_quick_precheck_loading").show();
        $.ajax({
            data: {
                type: $('input[name="root"]').val(),
                vehicularType: $('input[name="vehicularType"]').val(),
                pickUpLat: $('input[name="pickUpLat"]').val(),
                pickUpLng: $('input[name="pickUpLng"]').val(),
                initialDropOffLat: $('input[name="initialDropOffLat"]').val(),
                initialDropOffLng: $('input[name="initialDropOffLng"]').val(),
                initialDropOffId: $('input[name="initialDropOffId"]').val(),
            },
            type: 'post',
            url: site_url + 'ajax.php?process=booking-check-calluparea-process',
            success: function (response) {
                $("#wait_quick_show_btn").show();
                $("#wait_quick_precheck_loading").hide();
                // console.log('hi');
                var res = JSON.parse(response);
                if (res.status === 'success') {
                   /* for callup charge booking get payment */
                    if(root === 'Quick' && callUpChargesVal > 0){
                        
                        /* Get advance payment for booking */
                        const bookingForm = $('form[name="booking-add-airport"], form[name="booking-add"], form[name="booking-add-package"]');
                        const serialised = bookingForm.serialize() + '&organization=kangarooweb';
                        const serialisedFormJSON = bookingForm.serializeFormJSON();
                        serialisedFormJSON.organization = 'kangarooweb';
                    
                        localStorage.setItem('kc-booking-details', JSON.stringify(serialisedFormJSON));
                        localStorage.setItem('kc-booking-send', serialised);
                        window.location.href = site_url + "payment";

                    } else {

                        $('form[name="booking-add-airport"], form[name="booking-add"], form[name="booking-add-package"]').submit();
                        
                    }
                } else if (res.status === 'unavailable') {
                    $('#quick-booking-outofcolombo-submit').modal('toggle');
                } else {
                    modalTrigger('danger', 'Error while placing the booking. Please try again.')
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#wait_quick_show_btn").show();
                $("#wait_quick_precheck_loading").hide();
                //console.log('AJAX call failed.');
                //console.log(textStatus + ': ' + errorThrown);
            },
            complete: function () {
                //console.log('AJAX call completed');
            }
        });
    } else {
        $('form[name="booking-add-airport"], form[name="booking-add"], form[name="booking-add-package"]').submit();
        /* Get advance payment for booking */
        // const bookingForm = $('form[name="booking-add-airport"], form[name="booking-add"], form[name="booking-add-package"]');
        // const serialised = bookingForm.serialize() + '&organization=kangarooweb';
        // const serialisedFormJSON = bookingForm.serializeFormJSON();
        // serialisedFormJSON.organization = 'kangarooweb';
    
        // localStorage.setItem('kc-booking-details', JSON.stringify(serialisedFormJSON));
        // localStorage.setItem('kc-booking-send', serialised);
        // window.location.href = site_url + "payment";
    }

    $('#confirm-submit').modal('hide');
});

/* Manage / Cancel booking popup */
$('#manage-booking .message').on('click', 'button#cancel-booking', function (e) {
    var thisForm = $(e.target).parents('form');
});


/* Validate form */
function validate(thisForm) {
    var error = new Object();
    var customerFirstName = thisForm.find("#customerFirstName");
    var customerLastName = thisForm.find("#customerLastName");
    var telInput = thisForm.find("#telephone");
    var vtInput = thisForm.find('input[name="vehicularType"]');
    var packageID = thisForm.find('input[name="packageIDx"]');
    var timeInput = thisForm.find("#timepicker, #timepickerPackage");
    var dateInput = thisForm.find("#datepicker, #datepickerPackage");
    var origin = thisForm.find("#origin");
    var customerEmail = thisForm.find("#email");
    var dest = thisForm.find("#destination");
    var flightNo = thisForm.find('#flightNumber');
    var rootInput = $('.airport-booking-form').find('input[name="root"]');

    if ($.trim(origin.val()) || $("#origin").length) {
        if ($("#origin").val() !== '' && $('input[name="pickUpId"]').val() !== '') {
            //console.log($.trim(origin.val()));
        } else {
            error = { 'type': 'origin', 'message': 'Please select a pickup location from the location search picker.', 'return': 'false' };
        }
    }

    if ($.trim(dest.val()) || $("#destination").length) {
        if ($("#destination").val() !== "" && $('input[name="initialDropOffId"]').val() !== '') {
            //console.log($.trim(dest.val()));
        } else {
            error = { 'type': 'origin', 'message': 'Please select a drop location from the location search picker.', 'return': 'false' };
        }
    }

    if ($.trim(customerFirstName.val()) || $("#customerFirstName").length) {
        if ($('input[name="customerFirstName"]').val() !== '' && $('input[name="customerFirstName"]').val() !== '') {
            //console.log($.trim(customerFirstName.val()));
        } else {
            error = { 'type': 'origin', 'message': 'Please enter your first name.', 'return': 'false' };
        }
    }

    if ($.trim(customerLastName.val()) || $("#customerLastName").length) {
        if ($('input[name="customerLastName"]').val() !== '' && $('input[name="customerLastName"]').val() !== '') {
            //console.log($.trim(customerLastName.val()));
        } else {
            error = { 'type': 'origin', 'message': 'Please enter your last name.', 'return': 'false' };
        }
    }

    if ($("#telephone").length) {
        if (telInput.intlTelInput("isValidNumber")) {
            ////console.log('validated');
            //returnVal = true;
            var telephoneformat = '^[0-9]*$';
            if ($('#telephone').val().match(telephoneformat)) {
                $('#telephone').val($('#telephone').val().replace(/^0+/, ''));
            } else {
                error = { 'type': 'vehicle-type', 'message': 'Telephone number only can contain numbers. Please remove spaces or any other symbols.', 'return': 'false' };
            }
        } else {
            //console.log('Not valid');
            if (debug) {
                console.log(telInput.intlTelInput("getValidationError"));
            }
            error = { 'type': 'telephone', 'message': 'Phone number not valid, please check again.', 'return': 'false' };
        }
    }

    if ($.trim(customerEmail.val()) || customerEmail.length) {
        ////console.log(customerEmail.val());
        if (customerEmail.val() !== '') {
            //var mailformat = '^[a-z0-9_]+[a-z0-9._%+-]+@[a-z0-9._-]+\.[a-z]{2,4}$';
            var mailformat = '^[a-z0-9_!#$%&\'*+/=?`{|}~^-]+(?:\.[a-z0-9_!#$%&\'*+/=?`{|}~^-]+)*@[a-z0-9.-]+\.[a-z]{2,4}$';
            //var mailformat = '/^.+@.+\\..+$/';

            if ($('#email').val().toLowerCase().match(mailformat)) {
                ////console.log($.trim(vtInput.val()));
            } else {
                error = { 'type': 'origin', 'message': 'Please enter email in correct format.', 'return': 'false' };
            }
        } else {
            error = { 'type': 'origin', 'message': 'Please enter your email address.', 'return': 'false' };
        }
    } else {
        ////console.log('Here; '+customerEmail.val());
    }

    if ($('#fares_nb').prop("checked") == true) {
        ////console.log(customerEmail.val());
        if (flightNo.val() == '' && ($.trim(flightNo.val()) || flightNo.length)) {
            error = { 'type': 'origin', 'message': 'Please enter your flight number.', 'return': 'false' };
        }
        if ($('#pagingBoard').val().trim() === '') {
            error = { 'type': 'origin', 'message': 'Please fill the name board.', 'return': 'false' };
        }
    }

    if ($.trim(vtInput.val())) {
        if ($('input[name="vehicularType"]').is(':checked')) {
            ////console.log($.trim(vtInput.val()));

        } else {
            error = { 'type': 'vehicle-type', 'message': 'Please select a vehicle type.', 'return': 'false' };
        }
    }

    if ($.trim(packageID.val()) && packageID.length) {
        if (packageID.is(':checked')) {
            //console.log($.trim(vtInput.val()));

        } else {
            error = { 'type': 'vehicle-type', 'message': 'Please select a package.', 'return': 'false' };
        }
    }

    if ($.trim(rootInput.val())) {
        if ($('input[name="root"]').val() !== '' && ($.trim($('input[name="root"]').val()) || $('input[name="root"]').length)) {
            //if($('input[name="root"]').is(':checked')){
            ////console.log($.trim(rootInput.val()));
        } else {
            error = { 'type': 'vehicle-type', 'message': 'Please select a booking type.', 'return': 'false' };
        }
    }

    if (($.trim(timeInput.val()) && $.trim(dateInput.val())) || dateInput.length || timeInput.length) {
        if (($.trim(timeInput.val()) !== '' || $.trim(timeInput.val()) !== null) && $.trim(dateInput.val()) !== '') {
            var time = $.trim(timeInput.val());
            var date = $.trim(dateInput.val());
            var validatefor = timeInput.data('validatefor');
            time = time.replace(" ", "");
            time = time.replace(" ", "");
            var datetime = new Date(date + 'T' + time + ':00');
            var dt = new Date();

            if (debug === true) {
                console.log(validatefor);
            }

            var localoffset = dt.getTimezoneOffset();
            if (validatefor === 'advancedBooking') {
                dt.setTime(dt.getTime() + localoffset * 60000 + 330 * 60000 + 2 * 60 * 60000);
            } else {
                dt.setTime(dt.getTime() + localoffset * 60000 + 330 * 60000);
            }

            if (datetime.getTime() > dt.getTime()) {
                //returnVal = true;
            } else {
                var err = '';
                if (typeof datetime.getMinutes().toString().padStart === "function") {
                    err = 'Pickup time should be greater than ' + dt.getHours().toString().padStart(2, '0') + ':' + dt.getMinutes().toString().padStart(2, '0') + ', please check again.';
                } else {
                    err = 'Pickup time should be greater than ' + dt.getHours() + ':' + dt.getMinutes().toString() + ', please check again.';
                }
                error = {
                    'type': 'time',
                    'message': err,
                    'return': 'false'
                };
            }
        } else {
            error = {
                'type': 'datetime',
                'message': 'Please enter Pickup date and time.',
                'return': 'false'
            };
        }
    }
    ////console.log('validating');
    return error;
}

/* Tour Packages */
$('li.package').hide();
$('body').on('change', '#package-select input[name="vehicularType"]', function () {
    var vtypePackage = $('#package-select input[name="vehicularType"]:checked').val();
    $('li.package').hide();
    $('li.' + vtypePackage).show();
});

/* Tour Packages: Get package fare */
$('body').on('change', 'input[name="packageIDx"]', function () {
    var farePackage = $('input[name="packageIDx"]:checked').data('fare');
    $('form[name="booking-add-package"] input[name="fare"]').val(farePackage);
});

/* Tour Packages: Hide on type */
$('body').on('keyup', 'input[name="origin"], input[name="destination"]', function () {
    //console.log('hi');
    $('#distance').val('');
    $(this).parent('.input-group').find('input[name="pickUpLat"]').val('');
    $(this).parent('.input-group').find('input[name="pickUpLng"]').val('');
    $(this).parent('.input-group').find('input[name="initialDropOffLat"]').val('');
    $(this).parent('.input-group').find('input[name="initialDropOffLng"]').val('');
    $(".booking .message").slideUp("slow", function () {
        // Animation complete.
        $(this).html('');
    });
});

/* Display booked count on booking panel */
function bookedCount(minutes) {
    var now = new Date(),
        then = new Date(
            now.getFullYear(),
            now.getMonth(),
            now.getDate(),
            0, 0, 0),
        diff = now.getTime() - then.getTime();

    var count = Math.ceil(10 + (diff / 1000 / 60 / minutes) * 1);
    //if(debug === true)
    //console.log('Count: '+(count));
    $('#bookedCount').html(count);
}

$(document).ready(function () {
    /* Booked count */

    bookedCount(13);
    setInterval(function () {
        bookedCount(13);
    }, 13 * 60 * 1000 / 2); //13*60*1000/2
});

/* =========================================== */
let dyn_functions = [];
let validate_func = [];

$('body').on('submit', 'form#payment', function (e) {
    e.preventDefault();
    ajaxDirect('payment-advanced', $(this).serialize());
    $('#payment').html('<h2 class="text-center">Please wait</h2><div class="text-center">You are being redirected to the payment gateway. Please don\'t close the tab until the process is over...</div> <img src="' + site_url + 'resources/images/waiting.gif" class="mx-auto d-block" width="80">');
    window.scrollTo(0, 0);
});

dyn_functions['payment-advanced'] = function (json, form = $('#payment')) {
    console.log('payment-advanced', json)
    if (json.hasOwnProperty('err') && json.err !== '') {
        modalTrigger('danger', json.err)
    } else if (json.status === 200) {
        const url = json.results.url;
        const data = json.results.data;
        let form = '<form name="cybersource" action="' + url + '" method="post">';
        for (const prop in data) {
            form += '<input type="hidden" name="' + prop + '" value="' + data[prop] + '" />'
        }
        form += '<input type="submit" />'
        form += '</form>';
        const theForm = $(form);
        $('body').append(theForm);
        theForm.submit();
    } else {
        modalTrigger('danger', 'Payment failed. Reason: ' + json.message);
    }
};

dyn_functions['booking-add'] = function (json, form = '') {
    $('#bookingSuccessModal .modal-body').html(json.message);
    $('.modal').modal('hide');
    $('#bookingSuccessModal').modal('toggle');

    if (json.status === 'success') {
        $('#payment').append('<span class="ml-3">Booking success. Ref ID: ' + json.refID + '</span>');
        const bookingSend = localStorage.getItem('kc-booking-send');
        const bookingref = bookingSend + "&refID=" + json.refID + "&fare=" + json.fare + "&fareDisp=" + json.fareDisp;
        ajaxDirect('booking-success-email', bookingref);
    } else {
        $('#payment').append('<span class="ml-4">Booking failed. Please go back and re-try.</span>');
    }
};

/*dyn_functions['payment-advanced'] = function (json) {
    //TODO: Add filter to check if the payment is a success
    ajaxDirect('booking-add-airport',json);
}*/

dyn_functions['booking-add-airport'] = function (json, form = '') {
    $('#bookingSuccessModal .modal-body').html(json.message);
    $('.modal').modal('hide');
    $('#bookingSuccessModal').modal('toggle');

    if (json.status === 'success') {
        $('#payment').append('<span class="ml-3">Booking success. Ref ID: ' + json.refID + '</span>');
        const bookingSend = localStorage.getItem('kc-booking-send');
        const bookingref = bookingSend + "&refID=" + json.refID + "&fare=" + json.fare + "&fare=" + json.fare;
        ajaxDirect('booking-success-email', bookingref);
    } else {
        $('#payment').append('<span class="ml-4">Booking failed. Please go back and re-try.</span>');
    }
};

dyn_functions['booking-success-email'] = function (json, form = '') {
    /*if(json.status === 'success'){
        if(debug) {
            console.log('mail sent');
        }
    }else{*/
    $('#bookingSuccessModal .modal-body').html('<span class="text-' + json.status + '">' + json.message + '</span>');
    if (!($("#bookingSuccessModal").data('bs.modal') || {})._isShown) {
        $('#bookingSuccessModal').modal('toggle');
    }
    //}
};

/*===== MILES ======*/

$('body').on('submit', 'form.ajax', function (e) {
    e.preventDefault();
    const form = $(this);
    const func = form.attr('name');
    const data = form.serialize();
    const formname = form.attr('name');
    const silent = form.data('silent');
    const method = form.attr('method');
    const validation = form.data('validation');

    if (typeof validation !== 'undefined' && validation === 'yes') {
        var validated = validate_func[func](form);
        if (debug === true) {
            console.log(validated);
        }
        if (validated.status == true) {
            ajaxDirect(func, data, formname, silent, method, func + '-process');
        } else {
            modalTrigger('No', validated.message);
        }
    } else {
        ajaxDirect(func, data, formname, silent, method, func + '-process');
    }

});

validate_func['miles-buy'] = function () {
    let valid = { status: true, message: "Valid" };
    if ($('#card-month').val() == 'MM' || $('#card-month').val() == 'YYYY') {
        valid = { status: false, message: "Please check card expiry month and year" };

    }

    return valid;
}

dyn_functions['miles-buy'] = function (json) {
    let miles;
    try {
        miles = JSON.parse(json.message);
    } catch (e) {
        miles.message = json.message;
    }
    const form = $('#miles-buy')
    if (json.status == 'success' && miles.success === true) {
        $('form.ajax')[0].reset();
        //form.find('.message').html('Payment success. Successfully added miles to your account.');
        form.hide();
        form.after('<div id="miles-bought" class="p-3 bg-success text-white"><i class="la la-check-circle"></i> Successfully added miles to your account. <u id="miles-buy-more" class="cursor-pointer">Do you want to buy more miles?</u> or <a href="' + site_url + 'profile/" class="bg-white text-success py-1 px-2 rounded">Check balance</a></div>');
        window.scrollTo(0, 0);
        $('#miles-buy-more').on('click', function () {
            form.show();
            $('#miles-bought').remove();
        })
    } else if (json.errors == 'jwt expired') {
        //window.location.replace(site_url+'?miles=login');
        $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
        $('#loginModal').modal('show');
    } else {
        modalTrigger('danger', miles.message);
    }
}

dyn_functions['miles-payment'] = function (json, form = $('#miles-buy')) {
    if (json.status === 'AUTHORIZED') {
        modalTrigger('success', 'Payment is successful<br>Transaction ID: ' + json.id + '<br>Amount: ' + json.currency + ' ' + json.authorizedAmount);
        form[0].reset();
        $('.message').html('<i class="la la-check-circle text-success"></i>');
        $('.message').append('<span class="ml-3">Payment success. [' + json.currency + ' ' + json.authorizedAmount + '] Payment ID: ' + json.id + '</span>');
        /*ajaxDirect('miles-buy', {
            paymentMethod: 'credit-card',
            paymentAmount: form.find('#amount').val(),
            customerID: form.find('#customerID').val(),
            actionDevice: 'Website',
            paymentSuccess: json.status,
            paymentID: json.id,
            authorizedAmount: json.authorizedAmount,
            submitTimeUtc: json.submitTimeUtc
        });*/
    } else if (json.errors == 'jwt expired') {
        //window.location.replace(site_url+'?miles=login');
        $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
        $('#loginModal').modal('show');
    } else {
        modalTrigger('danger', 'Payment failed. Reason: ' + json.reason);
        $('.message').html('<a class="text-center btn btn-dark w-auto" href="' + site_url + '"><i class="fas fa-arrow-left"></i> Back</a>');
        $('.message').append('<span class="ml-3">Payment failed. Reason: ' + json.reason + '</span>');
    }
};

dyn_functions['miles-send'] = function (json) {
    const response = JSON.parse(json.message);
    if (response.success === true) {
        window.location.replace(site_url + "profile/miles-send-confirm/");
    } else if (response.errors === 'jwt expired') {
        //window.location.replace(site_url+'?miles=login');
        $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
        $('#loginModal').modal('show');
    } else if (response.errors !== '') {
        if (debug === true) {
            console.log(response.errors);
        }
        modalTrigger('danger', response.errors);
    }
}
dyn_functions['miles-send-confirm'] = function (json) {
    const response = JSON.parse(json.message);
    if (debug === true) {
        console.log(response.errors);
    }
    if (response.success == true) {
        //window.location.replace(site_url+"profile/miles-send-confirm/");
        modalTrigger('success', 'Miles sent successfully');
        $('.ajax')[0].reset();
        setTimeout(function () {
            window.location.replace(site_url + 'profile/miles-send');
        }, 3000);

    } else if (response.errors == 'jwt expired') {
        //window.location.replace(site_url+'?miles=login');
        $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
        $('#loginModal').modal('show');
    } else {
        modalTrigger('danger', response.errors);
    }
}

validate_func['miles-login'] = function () {
    if (debug == true) {
        console.log('validating');
    }

    let number = parseInt($('#miles-login #login-tel').val(), 10);
    $('#miles-login #login-tel').val(number);

    let valid = { status: true, message: "Valid" };
    return valid;
}

dyn_functions['miles-login'] = function (json) {
    $('form#miles-login')[0].reset();
    if (json.status === 'success') {
        //const login = JSON.parse(json.message);
        $('.ajax')[0].reset();
        if (json.message === 'E99') {
            window.location.replace(site_url + "verify/");
        } else {
            window.location.replace(site_url + "profile/");
        }
    } else {
        modalTrigger('danger', json.error);
    }
}

dyn_functions['miles-logout'] = function (json) {
    if (json.status === 'success') {
        //const login = JSON.parse(json.message);
        //$('.ajax')[0].reset();
        window.location.replace(site_url);
    }
}

dyn_functions['miles-forgot-password'] = function (json) {
    if (json.status === 'success') {
        const pw = JSON.parse(json.message);
        if (pw.success == true) {
            $('form').hide();
            $('.message').addClass('text-success').html('Password reset email has successfully sent to your email. Please check your inbox including the spam folder.');
        }
    } else {
        modalTrigger('danger', 'Communication error');
    }
}

dyn_functions['miles-reset-password'] = function (json) {
    if (json.status === 'success') {
        const pw = JSON.parse(json.message);
        if (pw.success == true) {
            $('form#miles-reset-password').hide();
            $('.message').addClass('text-success').html('Password reset successful.');
            $('#login-info').addClass('text-success').html('Password reset successful.');
            $('#loginModal').modal('show');
        }
    } else {
        modalTrigger('danger', 'Communication error');
    }
}

dyn_functions['miles-summary'] = function (json) {
    if (json.status == 'success') {
        const miles_summary = JSON.parse(json.message);
        if (miles_summary.success == true) {
            $('#miles-balance').html(miles_summary.data.balance);
            $('#miles-payments').html(miles_summary.data.totalPaid.fixedToTwo());
            $('#miles-earned').html(miles_summary.data.totalEarned);
            $('#miles-sent').html(miles_summary.data.totalSent);
            $('#miles-received').html(miles_summary.data.totalReceived);
            $('#miles-purchased').html(miles_summary.data.totalPurchased);
            $('#miles-gifted').html(miles_summary.data.totalGifted);
        } else if (miles_summary.errors == 'jwt expired') {
            //window.location.replace(site_url+'?miles=login');
            $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
            $('#loginModal').modal('show');
        }
    }
}

function getYYYYMMDD(d0) {
    const d = new Date(d0)
    return new Date(d.getTime() - d.getTimezoneOffset() * 60 * 1000).toISOString().split('T')[0]
}

dyn_functions['miles-statement'] = function (json) {
    if (json.status == 'success') {
        const miles_statement = JSON.parse(json.message);
        if (miles_statement.success == true) {
            $('#miles-balance').html(miles_statement.data.balance);
            let str = '';
            $.each(miles_statement.data.history, function (key, val) {
                let type = '';
                switch (val.type) {
                    case 'send-miles':
                        type = (val.action == 'withdrawal' ? 'Sent miles' : 'Received miles');
                        break;
                    case 'buy-miles':
                        type = 'Bought miles';
                        break;
                    case 'gift-miles':
                        type = 'Gifted miles';
                        break;
                    default:
                        type = '';
                }
                str += '<tr>';
                str += '<td>' + getYYYYMMDD(val.date) + '</td>';
                str += '<td>' + type + '</td>';
                str += '<td class="text-center">' + (val.action === 'withdrawal' ? '<i class="la la-minus-circle text-danger" title="Withdrawal"></i>' : '<i class="la la-plus-circle text-success" title="Deposit"></i>') + '</td>';
                str += '<td class="text-right">' + val.milesAmount + '</td>';
                str += '<td class="text-right">' + parseFloat(val.paymentAmount).fixedToTwo() + '</td>';
                str += '</tr>';
            });
            $('#miles-statement tbody').html(str);
        } else if (miles_summary.errors == 'jwt expired') {
            //window.location.replace(site_url+'?miles=login');
            $('#login-info').addClass('text-danger').html('Session expired. Please login to continue.');
            $('#loginModal').modal('show');
        } else if (response.errors !== '') {
            if (debug === true) {
                console.log(response.errors);
            }
            modalTrigger('danger', response.errors);
        }
    }
}

validate_func['miles-register'] = function (form) {
    let valid = { status: true, message: "Valid" };
    const pass = $(form).find('#password').val();
    const pass2 = $(form).find('#password2').val();

    if (pass !== pass2) {
        valid = { status: false, message: "Passwords are not matching" };
    }

    if (!$(form).find('#telephone').intlTelInput("isValidNumber")) {
        valid = { status: false, message: "Please enter a valid phone number" };
    }
    const iti = $(form).find('#telephone').intlTelInput('getNumberType');
    if (iti !== intlTelInputUtils.numberType.MOBILE) {
        // is a mobile number
        valid = { status: false, message: "Please enter a mobile number" };
    }

    return valid;
}

dyn_functions['miles-register'] = function (json) {
    if (json.status === 'success' && json.hasOwnProperty('customerId') && json.customerId !== '') {
        window.location.replace(site_url + "miles-register-confirm/");
    } else if (json.hasOwnProperty('error') && json.error !== '') {
        modalTrigger('danger', json.error)
    }
}

dyn_functions['miles-register-confirm'] = function (json) {
    const response = JSON.parse(json.message);
    if (json.status === 'success' && json.code === 200) {
        $('#login-info').addClass('text-success').html('Congratulations! Welcome to the Kangaroo Miles.<br/> Please login to your verified account.');
        $('#loginModal').modal('show');
    } else {
        modalTrigger('danger', response.errors);
    }
}

/* ===
 * VIP
 * === */

dyn_functions['vip-registration'] = function (json) {
    if (json.success) {
        ajaxDirect('vip-email-verification-request', {});
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-email-verification-request'] = function (json) {
    if (json.success) {
        window.location.replace(site_url + "vip/vip-email-verification");
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-email-verification'] = function (json) {
    if (json.success) {
        window.location.replace(site_url + "vip/vip-add-vehicle");
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-login'] = function (json) {
    if (json.status === 'success') {
        sessionStorage.removeItem('vip-profile');
        location.reload();
    } else {
        modalTrigger('danger', json.message);
    }
}

dyn_functions['vip-logout'] = function (json) {
    if (json.status === 'success') {
        sessionStorage.removeItem('vip-profile');
        location.reload();
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-profile-user-get'] = function (json) {
    let vip_profile_json;
    if (json.success) {
        sessionStorage.setItem('vip-profile', JSON.stringify(json.data));
        vip_profile_json = json.data;
        $('.vip-user-name').html('Welcome, ' + vip_profile_json.firstName + ' ' + vip_profile_json.lastName);
        $('.vip-user-name-profile').html(vip_profile_json.firstName + ' ' + vip_profile_json.lastName);
        $('.vip-user-address').text(vip_profile_json.address);
        $('.vip-user-email').text(vip_profile_json.email);
        $('.vip-user-nic').text(vip_profile_json.nicNumber);
    } else if (json.error === 'same-user') {
        vip_profile_json = JSON.parse(sessionStorage.getItem('vip-profile'));
        $('.vip-user-name').html('Welcome, ' + vip_profile_json.firstName + ' ' + vip_profile_json.lastName);
        $('.vip-user-name-profile').html(vip_profile_json.firstName + ' ' + vip_profile_json.lastName);
        $('.vip-user-address').text(vip_profile_json.address);
        $('.vip-user-email').text(vip_profile_json.email);
        $('.vip-user-nic').text(vip_profile_json.nicNumber);
    } else {
        console.log('Profile hasn\'t retrieved');
    }
}

dyn_functions['vip-img-upload'] = function (json) {
    if (json.success === true) {
        $('#' + json.field + '-file').val(json.data[0]);
        $('#' + json.field + '-box .upload').removeClass('text-dark').addClass('text-success').find('i').attr('class', 'la la-check');
        $('#' + json.field + '-box .upload span').html('Successfully uploaded');
    } else {
        $('#' + json.field + '-box .upload').removeClass('text-dark').addClass('text-danger').find('i').attr('class', 'la la-times');
        $('#' + json.field + '-box .upload span').html(json.errors);
    }
}

let progress = [];

progress['vip-img-upload'] = function (progress) {
    $('#' + json.field + '-box .upload span').html('Uploading: ' + progress + '%');
}

dyn_functions['vip-get-car-manufactures'] = function (json) {
    let datalist = '<option value="0">Please select the vehicle make</option>';
    if (parseInt(json.Count) > 0) {
        $.each(json.Results, function (key, make) {
            datalist += '<option data-makeid="' + make.MakeId + '" value="' + make.MakeName + '">' + make.MakeName + '</option>';
        });
    } else {
        datalist = '<option>Loading error. Please refresh.</option>';
    }
    $('select#vehicle-maker').html(datalist);
}

dyn_functions['vip-get-car-models'] = function (json) {
    let datalist = '<option value="0">Please select the vehicle model</option>';
    if (parseInt(json.Count) > 0) {
        $.each(json.Results, function (key, model) {
            datalist += '<option data-modelid="' + model.Model_ID + '" value="' + model.Model_Name + '">' + model.Model_Name + '</option>';
        });
    } else {
        datalist = '<option>Loading error. Please refresh.</option>';
    }
    $('select#vehicle-model').html(datalist);
}

validate_func['vip-add-vehicle'] = function (form) {
    let valid = { status: true, message: "Valid" };
    const brand = $('#vehicle-maker').val();
    const model = $('#vehicle-model').val();

    if (model == 0) {
        valid = { status: false, message: "Please select the model of your vehicle" };
    }
    if (brand == 0) {
        valid = { status: false, message: "Please select the make of your vehicle" };
    }
    return valid;
}

dyn_functions['vip-add-vehicle'] = function (json) {
    if (json.success) {
        $('form')[0].reset();
        $('img.vip-upload-img').removeAttr('src');
        $('.upload').html('').find('span, i').removeClass('text-success text-danger la la-check la-times la-sync la-spin');
        modalTrigger('success', 'Vehicle successfully added');
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-get-all-user-cars'] = function (json) {
    if (json.success) {
        let select = '<option value="0">Please select a plate number</option>'
        $.each(json.data, function (key, car) {
            select += '<option value="' + car.id + '">' + car.plateNumber + '</option>';
        });
        $('select#vehicle').html(select);
        $('#refresh-vehicles').removeClass('d-inline-block').addClass('d-none');
    } else {
        $('#refresh-vehicles').removeClass('d-none').addClass('d-inline-block');
        modalTrigger('danger', 'Couldn\'t load the vehicles list. You may have not ');
    }
}

dyn_functions['vip-schedule-by-car-get'] = function (json) {
    if (json.success) {
        if (json.data !== null) {
            assignVipScheduleDates(json.data);
        }
    }
}

dyn_functions['vip-schedule-add-date'] = function (json) {
    if (json.success) {
        const selectedDates = JSON.parse(sessionStorage.getItem('vip-scheduled-dates'));
        displaySelectedDates(selectedDates);
    } else {
        modalTrigger('danger', json.data);
    }
}

dyn_functions['vip-schedule-remove-date'] = function (json) {
    if (json.success) {
        const selectedDates = JSON.parse(sessionStorage.getItem('vip-scheduled-dates'));
        displaySelectedDates(selectedDates);
    } else {
        modalTrigger('danger', json.message);
    }
}