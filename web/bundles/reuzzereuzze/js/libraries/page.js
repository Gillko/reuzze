(function () {
    $('#use_curr_location').click(function () {
        if (navigator.geolocation)
            navigator.geolocation.getCurrentPosition(handleGetCurrentPosition, onError);
    });

    $('#form-Register').submit(function (e) {
        e.preventDefault();
        codeAddress();
    });

    $('.datepicker').datetimepicker({
        showAnim: 'slideDown',
        dateFormat: 'yy/mm/dd',
        changeMonth: true,
        changeYear: true
    });

    /*$('#fileupload').change(function(){
        var ext = $('#fileupload').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $("<p>Invalid extension. Only images allowed!</p>").appendTo('.fileupload_error');
            $('.fileupload_error').show();
        }
    });*/

    $('.addtofavorites').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('id');

        $.ajax({
            url: "../../entity/addtofavorites/" + id,
            type: "POST",
            data: { "entity_id" : id },
            success: function(data) {
                console.log(data);

                location.reload();

                //(success) do something...
                //variable "data" contains data returned by the controller.
            }
        });
    });

    $('.deletefromfavorites').on('click',function(e){

        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "../../entity/removefromfavorites/" + id,
            type: "POST",
            data: { "entity_id" : id },
            success: function(data) {

                location.reload();
                //(success) do something...
                //variable "data" contains data returned by the controller.
            }
        });
    });

    $('#form-Entity').submit(function (e) {
        e.preventDefault();
    });

    var myList = '';
    var i = 0;
    $('#fileupload').fileupload({
        dataType: 'json',
        add: function (e, data) {
            var ext = $('#fileupload').val().split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                $("<p>Invalid extension. Only images allowed!</p>").appendTo('.fileupload_error');
                $('.fileupload_error').show();
            }
            else{
                $("#submitentity").on('click', function () {
                    data.submit();
                });
            }
        },
        done: function (e, data) {
            var filename = data.files[0]['name'];
            var type = data.files[0]['type'];

            myList += filename;
            myList += ',';
            myList += type;
            myList += ',';

            e.preventDefault();
        },
        stop: function(e){
            $("#myFiles").val(myList);
            console.log(myList);
            submitForm();
        }

    });
})();

function submitForm(){
    $('#form-Entity')[0].submit();
}

var latitude, longitude;
var city, street, streetnumber, region, address;
function handleGetCurrentPosition(location){

    latitude = location.coords.latitude;
    longitude = location.coords.longitude;

    var geocoder = new google.maps.Geocoder();
    var latLng = new google.maps.LatLng(latitude, longitude);

    if (geocoder) {
        geocoder.geocode({ 'latLng': latLng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                city = results[0].address_components[2].short_name;
                street = results[0].address_components[1].short_name;
                streetnumber = results[0].address_components[0].short_name;

                region = results[0].address_components[3].long_name;

                $('.city').val(city);
                $('.street').val(street);
                $('.streetnumber').val(streetnumber);

                /*$(".region option").filter(function () {
                    return $(this).text() == region;
                }).prop('selected', true);*/
            }
            else {
                console.log("Geocoding failed: " + status);
            }
        });
    }
}

function onError()
{
    alert("Something went wrong!");
}

function codeAddress() {
    city = $('.city').val();
    street = $('.street').val();
    streetnumber = $('.streetnumber').val();

    address = street + " " + streetnumber + ", " + city + ", Belgie";

    geocoder = new google.maps.Geocoder();

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            latitude = results[0].geometry.location.nb;
            longitude = results[0].geometry.location.ob;

            /*longitude = new String(longitude);
            longitude = longitude.replace(/\./g, ',');

            latitude = new String(latitude);
            latitude = latitude.replace(/\./g, ',');*/

            $('.latitude').val(latitude);
            $('.longitude').val(longitude);

            $("#form-Register")[0].submit();

        } else {
            $('.latitude').val(0);
            $('.longitude').val(0);
            $("#form-Register")[0].submit();
            //alert("Geocode was not successful for the following reason: " + status);
        }
    });
}