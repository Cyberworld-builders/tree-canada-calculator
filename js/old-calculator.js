(function($){

  $(document).ready(function() {

    $('.add-energy').click(function(){
      addEnergy();
    });

    $('.calculate-energy').click(function(){
      calculateEnergy();
    });

    $('.add-air-transport').click(function(){
      addAirTransport();
    });

    $('.calculate-air-transport').click(function(){
      calculateAirTransport();
    });

    $('.add-road-vehicle').click(function(){
      addRoadVehicle();
    });

    $('.calculate-road-vehicle').click(function(){
      calculateRoadVehicle();
    });

    $('.add-other-transport').click(function(){
      addOtherTransport();
    });

    $('.calculate-other-transport').click(function(){
      calculateOtherTransport();
    });




    $('#tab-container').easytabs({
      'animate': false
    });

    // Energy exceptions
    var exceptEnergy = '|3-0-2|5-0-2|7-0-2|9-0-2|1-1-4|1-1-5|2-1-4|2-1-5|3-1-4|3-1-5|4-1-4|4-1-5|5-1-4|5-1-5|6-1-4|6-1-5|7-1-4|7-1-5|8-1-4|8-1-5|9-1-4|9-1-5|10-1-4|10-1-5|11-1-4|11-1-5|12-1-4|12-1-5|'; // |province-residential-energy_type|

    $('div.energy_wrapper').on('change', 'select.emissions_change',function() {
      var ep = $('select[name=emissions_province]').val();
      var er  = $('select[name=emissions_residential]').val();
      if(ep!= '' && er != '') {
        $('option', $('div.energy_wrapper').find('select.emissions_energy_type')).each(function() {
          if($(this).val() != '') {
            if(exceptEnergy.indexOf('|'+ep+'-'+er+'-'+$(this).val()+'|') > -1)	 {
            $(this).attr('disabled', 'disabled');
            } else {
              $(this).removeAttr('disabled');
            }
          }

        })
      }
    });

    // Road Vehicles exceptions
    var exceptRV = '|1-2|2-2|3-2|5-2|6-2|7-2|9-2|10-2|11-2|'; // |vehicle_class-fuel_type|

    $('div.roadvehicles_wrapper').on('change', 'select.roadvehicles_class',function() {
      var vc = $(this).val();
      $('option', $(this).parent('div.roadvehicles_trip').find('select.roadvehicles_fuel')).each(function() {
        if($(this).attr('value') != '') {
          if(exceptRV.indexOf('|'+vc+'-'+$(this).attr('value')+'|') > -1)	 {
            $(this).attr('disabled', 'disabled');
          } else {
            $(this).removeAttr('disabled');
          }
        }
      })
    });

  });

  jQuery.fn.outerHTML = function(s) {
  return (s)
    ? this.before(s).remove()
    : jQuery("<p>").append(this.eq(0).clone()).html();
  }


  /* ENERGY */
  function calculateEnergy() {
    var province = $('div.energy_wrapper select.emissions_province').val();
    var is_residential = $('div.energy_wrapper select.emissions_residential').val();

    $('div.energy_wrapper div.energy_source').each(function() {
      var energy_type = $(this).find('select.emissions_energy_type').val();
      var energy_qty = $(this).find('input.energy_quantity').val();
      var el = $(this);

      if(true || (province != '' && energy_type != '' && parseInt(energy_qty) > 0) ) {
        var energy_request = $.ajax({
          url: site_vars.url + site_vars.rest_base + "factors",
          type: "POST",
          data: { 'calctype' : 'energy', 'province': province, 'residential': is_residential, 'energy_type': energy_type, 'energy_qty': energy_qty },
          dataType: "html"
        });
        energy_request.done(function( msg ) {
          console.log(msg + "balls");
          if(msg == 'N/A') {
            el.addClass('error')
          } else {
            el.removeClass('error')
          }
          el.find('input.sub_tco2').val(msg);
          calcSectionTCO2('energy');
          calcTotalTCO2();
        });
        energy_request.fail(function( jqXHR, textStatus ) {
          el.addClass('error')
          el.find('input.sub_tco2').val('N/A');
          calcSectionTCO2('energy');
          calcTotalTCO2();
        });

      } else {
        el.addClass('error')
        $(this).find('input.sub_tco2').val('N/A');
        calcSectionTCO2('energy');
        calcTotalTCO2();
      }
    });
  }

  function addEnergy() {
    $('div.energy_wrapper div.energy_source').last().after($('div.energy_wrapper div.energy_source').last().outerHTML());
    $('div.energy_wrapper div.energy_source').last().find('span.energy_type_unit').text('');
    $('div.energy_wrapper div.energy_source').last().find('span.tco2').text('');
  }

  /*AIR TRANSPORT */
  function calculateAirTransport() {
    $('div.airtransport_wrapper div.airtransport_trip').each(function() {
      var airtransport_passengers = $(this).find('input[name=airtransport_passengers]').val();
      var airtransport_class = $(this).find('select[name=airtransport_class]').val();
      var airtransport_km = $(this).find('input[name=airtransport_km]').val();
      var airtransport_roundtrip = 0;
      if($(this).find('input[name=airtransport_roundtrip]').is(':checked')) airtransport_roundtrip = 1;
      var el = $(this);

      if(airtransport_passengers != '' && parseInt(airtransport_passengers) > 0 && airtransport_class != '' && parseInt(airtransport_km) > 0) {
        var airtransport_request = $.ajax({
          url: site_vars.url + site_vars.rest_base + "factors",
          type: "POST",
          data: { 'calctype' : 'airtransport', 'passengers': airtransport_passengers, 'class': airtransport_class, 'km': airtransport_km, 'roundtrip': airtransport_roundtrip },
          dataType: "html"
        });
        airtransport_request.done(function( msg ) {
          if(msg == 'N/A') {
            el.addClass('error')
          } else {
            el.removeClass('error')
          }
          el.find('input.sub_tco2').val(msg);
          calcSectionTCO2('air');
          calcTotalTCO2();
        });
        airtransport_request.fail(function( jqXHR, textStatus ) {
          el.addClass('error')
          el.find('input.sub_tco2').val('N/A');
          calcSectionTCO2('air');
          calcTotalTCO2();
        });

      } else {
        el.find('input.sub_tco2').val('N/A');
        el.addClass('error')
        calcSectionTCO2('air');
        calcTotalTCO2();
      }
    });
  }


  function addAirTransport() {
    $('div.airtransport_wrapper div.airtransport_trip').last().after($('div.airtransport_wrapper div.airtransport_trip').last().outerHTML());
    $('div.airtransport_wrapper div.airtransport_trip').last().find('span.tco2').text('');
  }

  /* ROAD VEHICLE */

  function calculateRoadVehicle() {
    $('div.roadvehicles_wrapper div.roadvehicles_trip').each(function() {
      var vehicle_class = $(this).find('select[name=roadvehicles_class]').val();
      var vehicle_fuel = $(this).find('select[name=roadvehicles_fuel]').val();
      var vehicle_km = $(this).find('input[name=roadvehicles_km]').val();

      var el = $(this);

      if(vehicle_class != ''  && vehicle_fuel != '' && parseInt(vehicle_km) > 0) {
        var roadvehicle_request = $.ajax({
          url: site_vars.url + site_vars.rest_base + "factors",
          type: "POST",
          data: { 'calctype' : 'roadvehicle', 'class': vehicle_class, 'km': vehicle_km, 'fuel': vehicle_fuel },
          dataType: "html"
        });
        roadvehicle_request.done(function( msg ) {
          if(msg == 'N/A') {
            el.addClass('error')
          } else {
            el.removeClass('error')
          }
          el.find('input.sub_tco2').val(msg);
          calcSectionTCO2('road');
          calcTotalTCO2();
        });
        roadvehicle_request.fail(function( jqXHR, textStatus ) {
          el.addClass('error')
          el.find('input.sub_tco2').val('N/A');
          calcSectionTCO2('road');
          calcTotalTCO2();
        });

      } else {
        el.find('input.sub_tco2').val('N/A');
        el.addClass('error')
        calcSectionTCO2('road');
        calcTotalTCO2();
      }
    });
  }


  function addRoadVehicle() {
    $('div.roadvehicles_wrapper div.roadvehicles_trip').last().after($('div.roadvehicles_wrapper div.roadvehicles_trip').last().outerHTML());
    $('div.roadvehicles_wrapper div.roadvehicles_trip').last().find('span.tco2').text('');

    $('option', $('div.roadvehicles_wrapper div.roadvehicles_trip').last().find('select.roadvehicles_fuel')).each(function() {
      $(this).removeAttr('disabled');
    });

  }


  /* OTHER TRANSPORT */

  function calculateOtherTransport() {
    $('div.othertransport_wrapper div.othertransport_trip').each(function() {
      var othertransport_type = $(this).find('select[name=othertransport_type]').val();
      var othertransport_km = $(this).find('input[name=othertransport_km]').val();

      var el = $(this);

      if(othertransport_type != '' && parseInt(othertransport_km) > 0) {
        var othertransport_request = $.ajax({
          url: site_vars.url + site_vars.rest_base + "factors",
          type: "POST",
          data: { 'calctype' : 'othertransport', 'type': othertransport_type, 'km': othertransport_km },
          dataType: "html"
        });
        othertransport_request.done(function( msg ) {
          if(msg == 'N/A') {
            el.addClass('error')
          } else {
            el.removeClass('error')
          }
          el.find('input.sub_tco2').val(msg);
          calcSectionTCO2('other');
          calcTotalTCO2();
        });
        othertransport_request.fail(function( jqXHR, textStatus ) {
          el.addClass('error')
          el.find('input.sub_tco2').val('N/A');
          calcSectionTCO2('other');
          calcTotalTCO2();
        });

      } else {
        el.addClass('error')
        el.find('input.sub_tco2').val('N/A');
        calcSectionTCO2('other');
        calcTotalTCO2();
      }
    });
  }


  function addOtherTransport() {
    $('div.othertransport_wrapper div.othertransport_trip').last().after($('div.othertransport_wrapper div.othertransport_trip').last().outerHTML());
    $('div.othertransport_wrapper div.othertransport_trip').last().find('span.tco2').text('');
  }


  /* SECTION TOTAL TCO2*/
  function calcSectionTCO2(eType) {
    var sub_total_tco2 = 0;
    $('#tabs1-'+eType+' input.sub_tco2').each(function() {
      if($(this).val() != '' && isNaN(parseFloat($(this).val())) == false) {
        sub_total_tco2 += parseFloat($(this).val());
      }
    });
    sub_total_tco2 = parseFloat(sub_total_tco2, 10);
    sub_total_tco2 = sub_total_tco2.toFixed(4);
    $('#tabs1-'+eType+' div.source_total .tco2').text(sub_total_tco2);
  }

  /* TOTAL TCO2 */
  function calcTotalTCO2() {
    var total_tco2 = 0;
    $('input.sub_tco2').each(function() {
      if($(this).val() != '' && isNaN(parseFloat($(this).val())) == false) {
        total_tco2 += parseFloat($(this).val());
      }
    });

    total_tco2 = parseFloat(total_tco2, 10);
    total_tco2 = total_tco2.toFixed(4);
    $('#total_tco2').text(total_tco2);
    calcTreesNeeded();
    if(total_tco2 > 0) {
      $('div.plantation_wrapper').css('display', 'block');
    } else {
      $('div.plantation_wrapper').css('display', 'none');
    }
  }


  /* PLANTATION */
  $(document).ready(function() {
    $("form")[0].reset();
    $("form[name=carbon_calculator]").submit(function( event ) {
      event.preventDefault();
      var province = $('select.plantation_province option:selected').text();
      var tco2 = $('#total_tco2').text();
      var location = $('select.plantation_province_location option:selected').text();
      var species = $('select.plantation_province_specy option:selected').text();
      var quantity = $('#total_trees_needed').text();
      if(province!='' && tco2 != '' && location != '' && species != '' && parseInt(quantity) > 0) {
        $('form[name=shop] input[name=province]').val(province);
        $('form[name=shop] input[name=tco2]').val(tco2);
        $('form[name=shop] input[name=location]').val(location);
        $('form[name=shop] input[name=species]').val(species);
        $('form[name=shop] input[name=quantity]').val(quantity);
        $('form[name=shop]').submit();
      }
    });
  })

  function calcTreesNeeded() {

    if($('select[name=plantation_province]').val() != '') {
      if(($('select[name=plantation_province_location]').length && $('select[name=plantation_province_location]').val() != '') || $('select[name=plantation_province_location]').length ==0) {
        if($('select[name=plantation_province_specy]').length && $('select[name=plantation_province_specy]').val() != '') {
          var calctrees_request = $.ajax({
            url: site_vars.url + site_vars.rest_base + "controls",
            type: "POST",
            data: { 'method' : 'calc_trees', 'province': $('select[name=plantation_province]').val(), 'location': $('select[name=plantation_province_location]').val(), 'specy': $('select[name=plantation_province_specy]').val(), 'total_tco2': $('#total_tco2').text(), 'lang': lang },
            dataType: "html"
          });
          calctrees_request.done(function( msg ) {

            $('#total_trees_needed').text(msg);
            if(parseInt(msg) > 0) {
              $('div.plantation_wrapper div.trees_to_offset').css('display','block');
            } else {
              $('div.plantation_wrapper div.trees_to_offset').css('display','none');
            }
          });
          calctrees_request.fail(function( jqXHR, textStatus ) {
            // Error Management
          });
        }
      }
    }
  }
})(jQuery);
