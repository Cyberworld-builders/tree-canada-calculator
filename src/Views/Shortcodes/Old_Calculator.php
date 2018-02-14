<div id="carboncalc_wrapper">
	<form name="carbon_calculator">
	<div id="tab-container" class="tab-container">
		<ul class='etabs'>
			<li class='tab'><a href="#tabs1-energy" class="tab-link energy"><?php echo 'Energy';?></a></li>
      <li class='tab'><a href="#tabs1-air" class="tab-link air"><?php echo 'Air Transport';?></a></li>
      <li class='tab'><a href="#tabs1-road" class="tab-link road"><?php echo 'Road Vehicles';?></a></li>
      <li class='tab last'><a href="#tabs1-other" class="tab-link other"><?php echo 'Other Transport';?></a></li>
	  	</ul>

		<!-- START ENERGY -->
		<div id="tabs1-energy" class="tab-content energy_wrapper">

			<select name="emissions_province" class="emissions_province emissions_change width300">
				<option value=""><?php echo 'Select your province';?></option>
        <?php foreach(explode(',',$options['calculator_provinces']) as $key => $province): ?>
          <?php echo '<option value="'.($key + 1).'">'.$province.'</option>'; ?>
        <?php endforeach; ?>
		 	</select>

			<select name="emissions_residential" class="emissions_residential emissions_change width200">
				<option value="1"><?php echo 'Residential';?></option>
				<option value="0"><?php echo 'Commercial';?></option>
			</select>

			<div class="energy_source">
				<select name="emissions_energy_type" class="emissions_energy_type width300" onchange="$(this).closest('div.energy_source').find('span.energy_type_unit').text($(this).children().eq($(this).prop('selectedIndex')).attr('data-unit'));">
					<option value="" data-unit=""><?php echo 'Select your energy type';?></option>
					<?php
					// $energy_sources = $this->controller->getEnergySources($lang);
					// foreach($energy_sources as $energy_source) {
					// 	echo '<option value="'.$energy_source['id'].'" data-unit="'.$energy_source['unit'].'">'.$energy_source['energy_type'].'</option>';
					// }

					?>
          <?php foreach(explode(',',$options['calculator_energytypes']) as $key => $energy_source): ?>
            <?php echo '<option value="'.$energy_source['id'].'" data-unit="'.$energy_source['unit'].'">'.$energy_source['energy_type'].'</option>'; ?>
          <?php endforeach; ?>
				</select>
				<div class="quantity_wrapper">
					<label for="energy_quantity"><?php echo 'Quantity';?>:&nbsp;</label><input type="number" id="energy_quantity" class="energy_quantity" value=""> <span class="energy_type_unit"></span>
					<br>
				</div>
				<input type="hidden" class="sub_tco2" name="sub_tco2">
			</div>

			<div class="calc_add">
				<a href="javascript://" class="add_source add-energy" >+ <?php echo 'Add another source of energy';?></a>
				<input type="button" value="<?php echo 'Calculate';?>" class="bt_calculate calculate-energy">
			</div>

			<div class="source_total">
				<div class="text_total"><?php echo 'TOTAL (tCO2) ENERGY :';?> </div>
				<span class="tco2">0</span>
			</div>
	  	</div>
		<!-- END ENERGY -->

		<!-- START AIR TRANSPORT -->
	  	<div id="tabs1-air" class="tab-content airtransport_wrapper">

			<div class="notes">
				<?php echo 'To calculate your flight distance, follow this link:';?><br>
				<a href="http://www.thetimenow.com/distance-calculator.php" target="_blank">www.thetimenow.com</a>
			</div>


			<div class="airtransport_trip">
				<input type="number" name="airtransport_passengers" placeholder="<?php echo '# of passengers'; ?>" value="" min="1">

				<select name="airtransport_class" class="airtransport_class">
					<option value=""><?php echo 'Class';?></option>
					<?php
					// $air_transport_classes = $this->controller->getAirTransportClasses($lang);
					// foreach($air_transport_classes as $key=>$air_transport_class) {
					// 	echo '<option value="'.$key.'">'.$air_transport_class.'</option>';
					// }
					?>
				</select>

				<span style="white-space:nowrap"><input type="number" name="airtransport_km" placeholder="<?php echo 'Distance (one way)'; ?>" value="" maxlength="8"><span class="air_unit">km</span></span>

				<label><input type="checkbox" name="airtransport_roundtrip" class="round_trip" value="1"><?php echo 'Round Trip';?></label>
				<input type="hidden" class="sub_tco2" name="sub_tco2">
			</div>

			<div class="calc_add">
				<a href="javascript://" class="add_source add-air-transport"  >+ <?php echo 'Add another trip';?></a>
				<input type="button" value="<?php echo 'Calculate'; ?>" class="bt_calculate calculate-air-transport">
			</div>

			<div class="source_total">
				<div class="text_total"><?php echo 'TOTAL (tCO2) AIR TRANSPORT :';?> </div>
				<span class="tco2">0</span>
			</div>
	  	</div>
		<!-- END AIR -->

		<!-- ROAD TRANSPORT -->
		<div id="tabs1-road" class="tab-content roadvehicles_wrapper">

			<div class="notes">
				<?php echo 'To calculate your distance, follow this link:';?><br>
				<a href="http://www.maps.google.com" target="_blank">www.maps.google.com</a>
			</div>

			<div class="roadvehicles_trip">
				<select name="roadvehicles_class" class="roadvehicles_class">
					<option value=""><?php echo 'Vehicles Class';?></option>
					<?php
					// $road_vehicles_classes = $this->controller->getRoadVehiclesClasses($lang);
					// 	foreach($road_vehicles_classes as $key=>$road_vehicles_class) {
					// 		echo '<option value="'.$key.'">'.$road_vehicles_class.'</option>';
					// 	}
					?>
				</select>


				<select name="roadvehicles_fuel" class="roadvehicles_fuel">
					<option value=""><?php echo 'Fuel Type';?></option>
					<?php
					// $road_vehicles_fuels = $this->controller->getRoadVehiclesFuels($lang);
					// 	foreach($road_vehicles_fuels as $key=>$road_vehicles_fuel) {
					// 		echo '<option value="'.$key.'">'.$road_vehicles_fuel.'</option>';
					// 	}
					?>
				</select>
				<span style="white-space:nowrap">
				 	<input type="number" placeholder="Distance" name="roadvehicles_km" value="" maxlength="8"><span class="road_unit">km</span>
				 </span>
				 <input type="hidden" class="sub_tco2" name="sub_tco2">
			</div>

			<div class="calc_add">
				<a href="javascript://" class="add_source add-road-vehicle" >+ <?php echo 'Add another vehicle';?></a>
				<input type="button" value="<?php echo 'Calculate'; ?>" class="bt_calculate calculate-road-vehicle">
			</div>

			<div class="source_total">
				<div class="text_total"><?php echo 'TOTAL (tCO2) ROAD VEHICLES :';?> </div>
				<span class="tco2">0</span>
			</div>

	  	</div>
		<!-- END ROAD -->

		<!-- OTHER TRANSPORT -->
		<div id="tabs1-other" class="tab-content othertransport_wrapper">
			<div class="notes">
				<?php echo 'To calculate your distance, follow this link:';?><br>
				<a href="http://www.maps.google.com" target="_blank">www.maps.google.com</a>
			</div>
			<div class="othertransport_trip">
				<select name="othertransport_type" class="othertransport_type">
					<option value=""><?php echo 'Type of transport';?></option>
					<?php
					// $transport_types = $this->controller->getTransportTypes($lang);
					// 	foreach($transport_types as $key=>$transport_type) {
					// 		echo '<option value="'.$key.'">'.$transport_type.'</option>';
					// 	}
					?>
				</select>
				<input type="number" placeholder="Distance" name="othertransport_km" value="" maxlength="8">&nbsp;<span class="other_unit">km</span>
				<input type="hidden" class="sub_tco2" name="sub_tco2">
			</div>

			<div class="calc_add">
				<a href="javascript://" class="add_source add-other-transport" >+ <?php echo 'Add another vehicle'; ?></a>
				<input type="button" value="<?php echo 'Calculate'; ?>" class="bt_calculate calculate-other-transport">
			</div>

			<div class="source_total">
				<div class="text_total"><?php echo 'TOTAL (tCO2) OTHER TRANSPORT :';?></div>
				<span class="tco2">0</span>
			</div>
	  	</div>
		<!-- END OTHER -->

		<div class="total_wrapper">
			<div class="text_total"><?php echo 'TOTAL (tCO2)&nbsp;:';?></div>
			<span id="total_tco2">0</span>
		</div>

	</div>


	<div class="plantation_wrapper">
		<div class="trees_to_offset">
			<?php echo 'NUMBER OF TREES NEEDED TO OFFSET YOUR EMISSIONS:<br>(BASED ON tCO2 AS FOUND IN STEPS #1 TO 4)';?><br>
			<span class="total_trees_needed_wrapper"><input class="total_trees_needed" id="total_trees_needed" value="0" /> <?php echo 'tree(s)';?></span><br>
			<input type="submit" value="<?php echo 'I want to offset my emissions!';?>" />
		</div>
	</div>

	</form>
</div>

<?php
  if($lang == 'fr') {
  	$url = ('http://arbrescanada.ca/product/compensez-vos-emissions-de-carbone/ "target=_blank"');
  } else {
  	$url = site_url() . '/product/carbon-emission-offset/ "target=_blank"';
  }
?>

<form action="<?php echo $url;?>" name="shop" method="post">
	<input type="hidden" name="tco2" value=""  />
	<input type="hidden" name="province" value=""  />
	<input type="hidden" name="location" value=""  />
	<input type="hidden" name="species" value=""  />
	<input type="hidden" name="quantity" value=""  />
	<input type="hidden" name="carbon_calculator" value="1">
</form>
