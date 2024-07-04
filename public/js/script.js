$(document).ready(function(){

var base_url = getBaseURL();
$('#freelancer_div').hide();
// console.log(base_url);
 $('.datepicker').datetimepicker({
            format:'dd-mm-yyyy',
            minView:2,
            inline: true,
            autoclose: true
        });

 $('.timepicker').timepicker({
 	minuteStep: 1,
    showMeridian: false
 });

 $("#location_id").change(function() {

    $("#doctor_id").val(null).trigger("change");
    $("#representative_id").val(null).trigger("change");

 });

 $("#process_type_id").change(function() {

    $("#doctor_id").val(null).trigger("change");

 });

 $(".select2_region_multiple").select2({
    placeholder: "-Click to select work regions-"
 });

 $(".select2_material_multiple").select2({
    placeholder: "-Click to select materials-"
 });

 $(".select2_ptype_multiple").select2({
    placeholder: "-Click to select process types-"
 });

 $(".select2_locations").select2({
 	placeholder: "-Click to search a location-",
 	ajax: {
        url: base_url+"/ajax/location_by_keyword",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            keyword: params.term
          };
        },
        processResults: function (data) {
            return {
                results: $.map(data.items, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
      }
 });

  $(".select2_doctors").select2({
    placeholder: "-Click to search a doctor-",
    ajax: {
        url: base_url+"/ajax/doctor_by_keyword",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            keyword: params.term,
            process_type_id: $('#process_type_id').val(),
            location_id: $('#location_id').val()
          };
        },
        processResults: function (data) {
            return {
                results: $.map(data.items, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
      }
 });

    $(".select2_representatives").select2({
    placeholder: "-Click to search a representative-",
    ajax: {
        url: base_url+"/ajax/representative_by_keyword",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            keyword: params.term,
            location_id: $('#location_id').val()
          };
        },
        processResults: function (data) {
            return {
                results: $.map(data.items, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        }
      }
 });


 function getBaseURL() {
	var getURL = window.location;

	var _return = getURL.protocol + '//' + getURL.hostname + (location.port.length ? ':'+location.port : '');
	var tmp_pathname = getURL.pathname.split('/');

    if ( getURL.pathname.search(/pharmex/i) > -1 ) {
	   _return += '/'+tmp_pathname[1];
    }
	return _return;
    }

$("#choose_from_free").change(function() {

    if($(this).is(':checked')){
        $('#freelancer_div').show();
    }else{
        $('#freelancer_div').hide();
    }
});

	
});