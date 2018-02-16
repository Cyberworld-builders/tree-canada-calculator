<div id="treecanada-carbon-calculator-<?php echo $form_number; ?>" class="treecanada-carbon-calculator">
  <h2><?php echo $options['calculator_title']; ?></h2>
  <p><?php echo $options['description']; ?></p>
  <div class="calculator-container">
    <div class="row nav nav-tabs"  id="myTab" role="tablist">
      <div class="col-md-3 nav-item nav-link calculator-tab active" id="energy-tab" data-toggle="tab" href="#energy" role="tab" aria-controls="energy" aria-selected="true">
        Energy
      </div>
      <div class="col-md-3 nav-item nav-link calculator-tab"  id="air-transport-tab" data-toggle="tab" href="#air-transport" role="tab" aria-controls="air-transport" aria-selected="false">
        Air Transport
      </div>
      <div class="col-md-3 nav-item nav-link calculator-tab" id="road-vehicles-tab" data-toggle="tab" href="#road-vehicles" role="tab" aria-controls="road-vehicles" aria-selected="false">
        Road Vehicles
      </div>
      <div class="col-md-3 nav-item nav-link calculator-tab"  id="other-transport-tab" data-toggle="tab" href="#other-transport" role="tab" aria-controls="other-transport" aria-selected="false">
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
                    <?php foreach(explode(',',$options['calculator_provinces']) as $province): ?>
                      <option><?php echo $province; ?></option>
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

              <div id="energy-type-0" class="energy-type">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control" class="province-input" placeholder="Choose Your Province">
                      <option>Select energy type.</option>
                      <?php foreach(explode(',',$options['calculator_energytypes']) as $province): ?>
                        <option><?php echo $province; ?></option>
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
                </div>
              </div>

              <div id="energy-type-template" class="energy-type hide">
                <div class="form-group">
                  <div class="col-md-5">
                    <select class="form-control" class="province-input" placeholder="Choose Your Province">
                      <option>Select energy type.</option>
                      <?php foreach(explode(',',$options['calculator_energytypes']) as $province): ?>
                        <option><?php echo $province; ?></option>
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
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
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


              <div id="air-trip-0" class="air-trip">
                <div class="form-group">
                  <div class="col-md-5">
                    <input type="number" class="form-control quantity-input" placeholder="# of Passengers">
                  </div>
                  <div class="col-md-7">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Choose your class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
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
                    <button class="btn btn-secondary form-control add-dynamic" data-template="air-trip-template" data-name="air-trip" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                </div>
              </div>

              <div id="air-trip-template" class="air-trip hide">
                <div class="form-group">
                  <div class="col-md-5">
                    <input type="number" class="form-control quantity-input" placeholder="# of Passengers">
                  </div>
                  <div class="col-md-7">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Choose your class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
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
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
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


              <div id="road-vehicles-0" class="road-vehicles">
                <div class="form-group">

                  <div class="col-md-6">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Fuel Type.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <input type="number" class="form-control quantity-input" placeholder="Distance">
                  </div>

                  <div class="col-md-4"></div>

                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="road-vehicles-template" data-name="road-vehicles" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>
                  <div class="col-md-12"><hr class="featurette-divider"></div>
                </div>
              </div>

              <div id="road-vehicles-template" class="road-vehicles hide">
                <div class="form-group">

                  <div class="col-md-6">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Fuel Type.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
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
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
              </div>
            </form>
          </div>


        </div>


      </div>


      <div class="tab-pane fade" id="other-transport" role="tabpanel" aria-labelledby="other-transport-tab">


        <div class="row">
          <div class="col-md-12">
            <form>

              <div id="other-transport-0" class="other-transport">
                <div class="form-group">

                  <div class="col-md-5">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>


                  <div class="col-md-5">
                    <input type="number" class="form-control quantity-input" placeholder="Distance">
                  </div>


                  <div class="col-md-2">
                    <button class="btn btn-secondary form-control add-dynamic" data-template="other-transport-template" data-name="other-transport" data-count="0"><i class="fa fa-plus"></i></button>
                  </div>

                  <div class="col-md-12"><hr class="separator"></div>


                </div>
              </div>

              <div id="other-transport-template" class="other-transport hide">

                <div class="form-group">

                  <div class="col-md-5">
                    <select class="form-control" class="province-input" placeholder="Choose Class">
                      <option>Vehicle class.</option>
                      <?php foreach(explode(',',$options['calculator_airclasses']) as $air_class): ?>
                        <option><?php echo $air_class; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>


                  <div class="col-md-5">
                    <input type="number" class="form-control quantity-input" placeholder="Distance">
                  </div>


                  <div class="col-md-2">

                    <button class="btn btn-secondary form-control remove-dynamic"><i class="fa fa-minus"></i></button>
                  </div>

                  <div class="col-md-12"><hr class="featurette-divider"></div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-block btn-primary mb-2 form-control">CALCULATE</button>
                </div>
              </div>
            </form>
          </div>


        </div>


      </div>


    </div>
  </div>
  <p><span>Tree Canada’s carbon calculator is based on Natural Resources Canada’s Carbon Budget Model of the Canadian Forest Sector (CBM-CFS3)<sup>1</sup> and on emission factors from the Government of Canada and the UK Government. <sup>2, 3, 4, 5</sup>  </span></p>
  <p><span>Please note that if Tree Canada is unable to plant the selected tree species in the coming spring, Tree Canada will substitute one that will sequester a similar amount of carbon over 100 years.</span></p>
  <p><span> </span></p>
  <p><strong><span>References</span></strong></p>
  <p><span>1    Kull, S.J., Rampley, G.J., Morken, S., Metsaranta, J., Neilson, E.T., and Kurz, W.A. (2011). <em>Operational-scale carbon budget model of the Canadian forest sector (CBM-CFS3) - Version 1.2: User’s Guide.</em> Northern Forestry Centre.</span></p>
  <p><span>2    Department of Environment, Food &amp; Rural Affairs. (2012). <em>2012 greenhouse gas conversion factors for company reporting.</em> Retrieved online from <a href="https://www.gov.uk/government/uploads/system/uploads/attachment_data/file/69554/pb13773-ghg-conversion-factors-2012.pdf" target="_blank">https://www.gov.uk/government/uploads/system/uploads/attachment_data/file/69554/pb13773-ghg-conversion-factors-2012.pdf</a></span></p>
  <p><span>3    Environment Canada. (2013). <em>National Inventory Report 1990-2011: Greenhouse gas sources and sinks in Canada</em>. Retrieved online from <a href="http://publications.gc.ca/collections/collection_2013/ec/En81-4-2011-2-eng.pdf" target="_blank">http://publications.gc.ca/collections/collection_2013/ec/En81-4-2011-2-eng.pdf</a></span></p>
  <p><span>4    Natural Resources Canada. (2014). <em>Fuel consumption ratings search tool. </em>Retrieved online from <a href="http://oee.nrcan.gc.ca/fcr-rcf/public/index-e.cfm?attr=0" target="_blank">http://oee.nrcan.gc.ca/fcr-rcf/public/index-e.cfm?attr=0</a></span></p>
  <p><span>5    Natural Resources Canada. (2014). <em>Carbon Budget Model. </em>Retrieved online from <a href="http://www.nrcan.gc.ca/forests/climate-change/13107" target="_blank">http://www.nrcan.gc.ca/forests/climate-change/13107</a></span></p>
</div>
