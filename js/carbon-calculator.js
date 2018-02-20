jQuery(document).ready(function($){
  $('.nav-item').click(function(e){
    $('.nav-item').removeClass('active');
    $(this).addClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').addClass('hide');
    $('#' + $(this).attr('aria-controls')).addClass('show');
  });
  $('#other-transport-tab').click();
  $('.add-dynamic').click(function(e){
    e.preventDefault();
    var template = $('#' + $(this).data('template'));
    var count = Number($(this).data('count'));
    var name = $(this).data('name');
    var increment = count + 1;
    var id = name + '-' + increment;
    template
      .clone()
      .removeAttr('id')
      .attr('id', id)
      .removeClass('hide')
      .insertBefore('#' + template.attr('id'));
      $('.remove-dynamic').click(function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
      });
    $(this).data('count',increment);
    $('.need-id').each(function(){
      var default_id = $(this).attr('id');
      $(this).attr('id',default_id + increment);
      $(this).removeClass('need-id');
      if($(this).attr('for')){
        var default_for = $(this).attr('for');
        $(this).attr('for',default_for + increment);
      }
    });
  });
  $('.hyperlink').click(function(){ window.open($(this).data('url')); });

  /* SECTION TOTAL TCO2*/
	function calcSectionTCO2(eType) {
		var sub_total_tco2 = 0;
		$('#'+eType+' input.sub_tco2').each(function() {
			if($(this).val() != '' && isNaN(parseFloat($(this).val())) == false) {
				sub_total_tco2 += parseFloat($(this).val());
			}
		});
		sub_total_tco2 = parseFloat(sub_total_tco2, 10);
		sub_total_tco2 = sub_total_tco2.toFixed(4);
		$('#'+eType+' div.source_total .tco2').text(sub_total_tco2);
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
		$('span#total_tco2 ').text(total_tco2);

		// calcTreesNeeded();
		// if(total_tco2 > 0) {
		// 	$('div.plantation_wrapper').css('display', 'block');
		// } else {
		// 	$('div.plantation_wrapper').css('display', 'none');
		// }
	}

  $('#emissions-energy-submit').click(function(e){
    e.preventDefault();
    calculateEnergy();
  });

  function calculateEnergy(){
      var el = $(this);
      var province = $('#emissions-province').val();
      var is_residential = $('#emissions-residential').val();
      $('.energy-type.wrapper').each(function(){
        if($(this).attr('id') != "energy-type-template"){
          var el = $(this);
          var energy_type = $(this).find('select.energy-type').val();
          var energy_qty = $(this).find('input.quantity-input').val();
          if(province != '' && energy_type != '' && parseInt(energy_qty) > 0) {
    				var energy_request = $.ajax({
    					url: site_vars.url + site_vars.rest_base + 'factors/',
    					type: "POST",
    					data: { 'calctype' : 'energy', 'province': province, 'residential': is_residential, 'energy_type': energy_type, 'energy_qty': energy_qty },
    					dataType: "html"
    				});
    				energy_request.done(function( msg ) {
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
        }
      });
  }

  $('#emissions-air-submit').click(function(e){
    e.preventDefault();
    calculateAirTransport();
  });

  /*AIR TRANSPORT */
	function calculateAirTransport() {
		$('.air-trip.wrapper').each(function(){
			var airtransport_passengers = $(this).find('input.passengers-input').val();
			var airtransport_class = $(this).find('select.class-input').val();
			var airtransport_km = $(this).find('input.km-input').val();
			var airtransport_roundtrip = 0;
			if($(this).find('input.form-check-input').is(':checked')) airtransport_roundtrip = 1;
			var el = $(this);
			if(airtransport_passengers != '' && parseInt(airtransport_passengers) > 0 && airtransport_class != '' && parseInt(airtransport_km) > 0) {
				var airtransport_request = $.ajax({
					url: site_vars.url + site_vars.rest_base + 'factors/',
					type: "POST",
					data: { 'calctype' : 'airtransport', 'passengers': airtransport_passengers, 'class': airtransport_class, 'km': airtransport_km, 'roundtrip': airtransport_roundtrip },
					dataType: "html"
				});
				airtransport_request.done(function( msg ) {
          console.log( msg);
					if(msg == 'N/A') {
						el.addClass('error')
					} else {
						el.removeClass('error')
					}
					el.find('input.sub_tco2').val(msg);
					calcSectionTCO2('air-transport');
					calcTotalTCO2();
				});
				airtransport_request.fail(function( jqXHR, textStatus ) {
					el.addClass('error')
					el.find('input.sub_tco2').val('N/A');
					calcSectionTCO2('air-transport');
					calcTotalTCO2();
				});
			} else {
				el.find('input.sub_tco2').val('N/A');
				el.addClass('error')
				calcSectionTCO2('air-transport');
				calcTotalTCO2();
			}
		});
	}

  $('#emissions-road-submit').click(function(e){
    e.preventDefault();
    calculateRoadVehicle();
  });

  /* ROAD VEHICLE */

	function calculateRoadVehicle() {
		$('div.road-vehicles.wrapper').each(function() {
			var vehicle_class = $(this).find('select.road-class-input').val();
			var vehicle_fuel = $(this).find('select.road-fuel-input').val();
			var vehicle_km = $(this).find('input.km-input').val();
			var el = $(this);
			if(vehicle_class != ''  && vehicle_fuel != '' && parseInt(vehicle_km) > 0) {
				var roadvehicle_request = $.ajax({
					url: site_vars.url + site_vars.rest_base + 'factors/',
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
					calcSectionTCO2('road-vehicles');
					calcTotalTCO2();
				});
				roadvehicle_request.fail(function( jqXHR, textStatus ) {
					el.addClass('error')
					el.find('input.sub_tco2').val('N/A');
					calcSectionTCO2('road-vehicles');
					calcTotalTCO2();
				});

			} else {
				el.find('input.sub_tco2').val('N/A');
				el.addClass('error')
				calcSectionTCO2('road-vehicles');
				calcTotalTCO2();
			}
		});
	}

  $('#emissions-other-submit').click(function(e){
    e.preventDefault();
    calculateOtherTransport();
  });

  function calculateOtherTransport() {
		$('div.other-transport.wrapper').each(function() {
			var othertransport_type = $(this).find('select.transport-type-input').val();
			var othertransport_km = $(this).find('input.km-input').val();
			var el = $(this);
			if(othertransport_type != '' && parseInt(othertransport_km) > 0) {
				var othertransport_request = $.ajax({
					url: site_vars.url + site_vars.rest_base + 'factors/',
					type: "POST",
					data: { 'calctype' : 'othertransport', 'type': othertransport_type, 'km': othertransport_km },
					dataType: "html"
				});
				othertransport_request.done(function( msg ) {
          console.log(msg);
					if(msg == 'N/A') {
						el.addClass('error')
					} else {
						el.removeClass('error')
					}
					el.find('input.sub_tco2').val(msg);
					calcSectionTCO2('other-transport');
					calcTotalTCO2();
				});
				othertransport_request.fail(function( jqXHR, textStatus ) {
					el.addClass('error')
					el.find('input.sub_tco2').val('N/A');
					calcSectionTCO2('other-transport');
					calcTotalTCO2();
				});
			} else {
				el.addClass('error')
				el.find('input.sub_tco2').val('N/A');
				calcSectionTCO2('other-transport');
				calcTotalTCO2();
			}
		});
	}
  function calcTreesNeeded() {
		if($('select[name=plantation_province]').val() != '') {
			if(($('select[name=plantation_province_location]').length && $('select[name=plantation_province_location]').val() != '') || $('select[name=plantation_province_location]').length ==0) {
				if($('select[name=plantation_province_specy]').length && $('select[name=plantation_province_specy]').val() != '') {
					var calctrees_request = $.ajax({
						url: "<?php echo $tool_name_shop;?>",
						type: "POST",
						data: { 'method' : 'calc_trees', 'province': $('select[name=plantation_province]').val(), 'location': $('select[name=plantation_province_location]').val(), 'specy': $('select[name=plantation_province_specy]').val(), 'total_tco2': $('#total_tco2').text(), 'lang': '<?php echo $lang;?>' },
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
});
