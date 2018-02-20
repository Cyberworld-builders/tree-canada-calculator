<div id="treecanada-carbon-calculator-<?php echo $form_number; ?>" class="treecanada-carbon-calculator">
  <h2><?php echo $calc->post_title; ?></h2>
  <p><?php echo get_field('instructions',$calc->ID,false); ?></p>
  <div class="calculator-container">
    <div class="row nav nav-tabs"  id="myTab" role="tablist">
      <div class="col-md-12 col-lg-3 nav-item nav-link calculator-tab active" id="energy-tab" data-toggle="tab" href="#energy" role="tab" aria-controls="energy" aria-selected="true">
        Energy
      </div>
      <div class="col-md-12 col-lg-3 nav-item nav-link calculator-tab"  id="air-transport-tab" data-toggle="tab" href="#air-transport" role="tab" aria-controls="air-transport" aria-selected="false">
        Air Transport
      </div>
      <div class="col-md-12 col-lg-3 nav-item nav-link calculator-tab" id="road-vehicles-tab" data-toggle="tab" href="#road-vehicles" role="tab" aria-controls="road-vehicles" aria-selected="false">
        Road Vehicles
      </div>
      <div class="col-md-12 col-lg-3 nav-item nav-link calculator-tab"  id="other-transport-tab" data-toggle="tab" href="#other-transport" role="tab" aria-controls="other-transport" aria-selected="false">
        Other Transport
      </div>
    </div>
    <div class="tab-content calculator-body row" id="myTabContent">
      <div class="tab-pane fade show active" id="energy" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <div class="col-md-12">
            <form>
              <div class="form-group">
                <div class="col-md-6">
                  <select class="form-control form-control-lg" id="emissions-province" placeholder="Choose Your Province">
                    <option>Select your province.</option>
                    <?php foreach($provinces as $key => $province): ?>
                      <?php if($province != ""): ?>
                      <option value="<?php echo $province->ID; ?>"><?php echo $province->post_title; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" id="emissions-residential" placeholder="Choose Your Province">
                    <option>Residential</option>
                    <option>Commercial</option>
                  </select>
                </div>
              </div>
              <div id="energy-type-0" class="energy-type wrapper">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control energy-type" placeholder="Choose Your Province">
                      <option>Select energy type.</option>
                      <?php foreach($energy_types as $key => $energy_type): ?>
                        <?php if($energy_type != ""):  $unit = get_field('unit',$energy_type->ID); ?>
                        <option value="<?php echo $energy_type->ID; ?>" data-unit="<?php echo $unit; ?>"><?php echo $energy_type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control quantity-input" placeholder="Qty">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control measurement-input" readonly value="kwh">
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="energy-type-template" data-name="energy-type" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div id="energy-type-template" class="energy-type hide">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control energy-type" placeholder="Choose Your Province">
                      <option>Select energy type.</option>
                      <?php foreach($energy_types as $key => $energy_type): ?>
                        <?php if($energy_type != ""):  $unit = get_field('unit',$energy_type->ID); ?>
                        <option value="<?php echo $energy_type->ID; ?>" data-unit="<?php echo $unit; ?>"><?php echo $energy_type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control quantity-input" placeholder="Qty">
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control measurement-input" readonly value="kwh">
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control remove-dynamic"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                </div>
                <input type="hidden" class="sub_tco2" name="sub_tco2" />
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <button id="emissions-energy-submit" type="submit" class="btn btn-block btn-primary mb-2 form-control calculate ">CALCULATE</button>
                </div>
              </div>
              <div class="source_total row">
                <div class="col-md-6 text_total"><h3 class="text_total"><?php echo 'TOTAL (tCO2) ENERGY :';?> </h3></div>
                <div class="col-md-2"><span class="tco2">0</span></div>
        			</div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="air-transport" role="tabpanel" aria-labelledby="air-transport-tab">
        <div class="row">
          <div class="col-md-12">
            <form>
              <div class="flight-distance">
                <h3>To calculate your flight distance, click <span class="hyperlink" data-url="http://www.thetimenow.com/distance-calculator.php">here</span>.</h3>
              </div>
              <div id="air-trip-0" class="air-trip wrapper">
                <div class="form-group">
                  <div class="col-md-5">
                    <input type="number" class="form-control passengers-input" placeholder="# of Passengers">
                  </div>
                  <div class="col-md-7">
                    <select class="form-control class-input" placeholder="Choose Class">
                      <option>Choose your class.</option>
                      <?php foreach($air_classes as $key => $class): ?>
                        <?php if($class != ""): ?>
                        <option value="<?php echo $class->ID; ?>" ><?php echo $class->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <input type="number" class="form-control km-input" placeholder="Distance">
                  </div>
                  <div class="col-md-1">
                    <input id="round-trip-" type="checkbox" class="form-control form-check-input need-id" >
                  </div>
                  <div class="col-md-4">
                    <label id="round-trip-label-" for="round-trip-" class="form-control">Round Trip</label>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="air-trip-template" data-name="air-trip" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div id="air-trip-template" class="air-trip hide">
                <div class="form-group">
                  <div class="col-md-5">
                    <input type="number" class="form-control passengers-input" placeholder="# of Passengers">
                  </div>
                  <div class="col-md-7">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <?php foreach($air_classes as $key => $class): ?>
                        <?php if($class != ""): ?>
                        <option value="<?php echo $class->ID; ?>" ><?php echo $class->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <input type="number" class="form-control quantity-input" placeholder="Distance">
                  </div>
                  <div class="col-md-1">
                    <input id="round-trip-" type="checkbox" class="form-control form-check-input need-id" >
                  </div>
                  <div class="col-md-4">
                    <label id="round-trip-label-" for="round-trip-" class="form-control">Round Trip</label>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control remove-dynamic"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <button id="emissions-air-submit" type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
              </div>
              <div class="source_total row">
                <div class="col-md-6 text_total"><h3 class="text_total"><?php echo 'TOTAL (tCO2) ENERGY :';?> </h3></div>
                <div class="col-md-2"><span class="tco2">0</span></div>
        			</div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="road-vehicles" role="tabpanel" aria-labelledby="road-vehicles-tab">
        <div class="row">
          <div class="col-md-12">
            <form>
              <div class="flight-distance">
                <h3>To calculate your distance, click <span class="hyperlink" data-url="https://www.google.com/maps/">here</span>.</h3>
              </div>
              <div id="road-vehicles-0" class="road-vehicles wrapper">
                <div class="form-group">
                  <div class="col-md-6">
                    <select class="form-control road-class-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach($road_classes as $key => $class): ?>
                        <?php if($class != ""): ?>
                        <option value="<?php echo $class->ID; ?>" ><?php echo $class->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control road-fuel-input" placeholder="Choose Class">
                      <option>Fuel Type.</option>
                      <?php foreach($fuel_types as $key => $type): ?>
                        <?php if($type != ""): ?>
                        <option value="<?php echo $type->ID; ?>" ><?php echo $type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control km-input" placeholder="Distance">
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="road-vehicles-template" data-name="road-vehicles" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div id="road-vehicles-template" class="road-vehicles wrapper hide">
                <div class="form-group">
                  <div class="col-md-6">
                    <select class="form-control road-class-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach($road_classes as $key => $class): ?>
                        <?php if($class != ""): ?>
                        <option value="<?php echo $class->ID; ?>"><?php echo $class->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control road-fuel-input" placeholder="Choose Class">
                      <option>Fuel Type.</option>
                      <?php foreach($fuel_types as $key => $type): ?>
                        <?php if($type != ""): ?>
                        <option value="<?php echo $type->ID; ?>"><?php echo $type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control quantity-input" placeholder="Distance">
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control remove-dynamic"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <button id="emissions-road-submit" type="submit" class="btn btn-block btn-primary mb-2 form-control ">CALCULATE</button>
                </div>
              </div>
              <div class="source_total row">
                <div class="col-md-6 text_total"><h3 class="text_total"><?php echo 'TOTAL (tCO2) ENERGY :';?> </h3></div>
                <div class="col-md-2"><span class="tco2">0</span></div>
        			</div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="other-transport" role="tabpanel" aria-labelledby="other-transport-tab">
        <div class="row">
          <div class="col-md-12">
            <form>
              <div id="other-transport-0" class="other-transport wrapper">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control transport-type-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach($transport_types as $key => $type): ?>
                        <?php if($type != ""): ?>
                        <option  value="<?php echo $type->ID; ?>"><?php echo $type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <input type="number" class="form-control km-input" placeholder="Distance">
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="other-transport-template" data-name="other-transport" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="separator"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div id="other-transport-template" class="other-transport wrapper hide">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control transport-type-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach($transport_types as $key => $type): ?>
                        <?php if($type != ""): ?>
                        <option  value="<?php echo $type->ID; ?>"><?php echo $type->post_title; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-5">
                    <input type="number" class="form-control km-input" placeholder="Distance">
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control remove-dynamic"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                  <input type="hidden" class="sub_tco2" name="sub_tco2" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <button id="emissions-other-submit" type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
              </div>
              <div class="source_total row">
                <div class="col-md-6 text_total"><h3 class="text_total"><?php echo 'TOTAL (tCO2) ENERGY :';?> </h3></div>
                <div class="col-md-2"><span class="tco2">0</span></div>
        			</div>
            </form>
          </div>
        </div>
      </div>

      <div class="total_wrapper row" style="padding: 15px;">
        <div class="col-md-6 text_total"><h1 class="text_total"><?php echo 'TOTAL (tCO2)&nbsp;:';?></h1></div>
        <div class="col-md-6"><span id="total_tco2" style="font-size: 14pt; font-weight: 400;">0</span></div>
      </div>

    </div>

    <form action="<?php echo site_url() . "/carbon-emission-offset";?>" name="shop" method="post">
    	<input type="hidden" name="tco2" value=""  />
    	<input type="hidden" name="quantity" value=""  />
    	<input type="hidden" name="carbon_calculator" value="1">
      <div style="text-align:center;margin-top: 15px;margin-bottom: 15px;">
        <h1>NUMBER OF TREES NEEDED TO OFFSET YOUR EMISSIONS:<br>(BASED ON tCO2 AS FOUND IN STEPS #1 TO 4)</h1>
        <span style="margin-left:auto;margin-right:auto;font-size:24pt;font-weight: 500;" class="total_trees_needed_wrapper"><span class="total_trees_needed" id="total_trees_needed">0</span> <?php echo 'tree(s)';?></span><br>
        <input class="form-control" type="submit" style="color: #fff;font-size: 16pt;height: 55px;" value="I want to offset my emissions!" />
      </div>
    </form>

  </div>
  <?php echo get_field('footer',$calc->ID,false); ?>
</div>
