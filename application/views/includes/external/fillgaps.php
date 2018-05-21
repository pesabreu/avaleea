

<?php 
	
	//print_r($tests);
	//exit;
	
	$qty = isset($tests[1]['qty']) ? $tests[1]['qty'] : 0;
	
	if (intval($qty) == 1) {
		$last = isset($tests[3]['lst']) ? $tests[3]['lst'] : '';
	}	
	if (intval($qty) == 2) {
		$last = isset($tests[6]['lst']) ? $tests[6]['lst'] : '';
	}	
	if (intval($qty) == 3) {
		$last = isset($tests[8]['lst']) ? $tests[8]['lst'] : '';
	}
?>


			<!-- input fill in the gaps - fg -->
			<div style="display: block;" class="row text-center d-flex justify-content-center align-items-center my-2 py-4 mx-5" name="div-answers-fg" id="div-answers-fg">
	
				<div class="col-3"> </div>
				<div class="col-2" name="num_gaps" id="num_gaps">
					<b>number of gaps:</b>
				</div>
				
				<div class="col-4" name="opt_gaps" id="opt_gaps">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"
					   <?php echo ($qty == 1) ? 'checked' : ''; ?>>
					  <label class="form-check-label" for="inlineRadio1">1</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"
					  <?php echo ($qty == 2) ? 'checked' : ''; ?>>
					  <label class="form-check-label" for="inlineRadio2">2</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"
					  <?php echo ($qty == 3) ? 'checked' : ''; ?>>
					  <label class="form-check-label" for="inlineRadio3">3</label>
					</div>				
				</div>
				<div class="col-3"></div>
			
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="col-10 mt-1 ml-5 pl-5" style="border: 2px ridge #007BFF; display: none;" id="hr-gap1" name="hr-gap1"> </div>  <!-- HR -->			
				
				<div class="col-12 mt-3">
					<div class="col mb-2" style="display: block;" id="div-part-fg1">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px;" id="part-fg1" name="part-fg1" rows="1" onfocus="if (this.value=='  First part ')this.value=''" 
									onblur="if(this.value=='') this.value='  First part '"  ><?= isset($tests[2]['pt1']) ? $tests[2]['pt1'] : "  First part "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-1">
					<div class="col mb-2" style="display: block;" id="div-gap-fg1">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px; background-color: #ffffb0;" id="gap-fg1" name="gap-fg1" rows="1" onfocus="if (this.value=='  First gap ')this.value=''" 
										onblur="if(this.value=='') this.value='  First gap '"  ><?= isset($tests[3]['gp1']) ? $tests[3]['gp1'] : "  First gap "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
								
				<div class="col-12 mt-2">
					<div class="col mb-2" style="display: block;" id="div-part-fg2">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px;" id="part-fg2" name="part-fg2" rows="1" onfocus="if (this.value=='  Second part ')this.value=''" 
										onblur="if(this.value=='') this.value='  Second part '"><?= isset($tests[4]['pt2']) ? $tests[4]['pt2'] : "  Second part "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-1">
					<div class="col mb-2" style="display: block;" id="div-gap-fg2">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px; background-color: #ffffb0;" id="gap-fg2" name="gap-fg2" rows="1" onfocus="if (this.value=='  Second gap ')this.value=''" 
										onblur="if(this.value=='') this.value='  Second gap '"><?= isset($tests[5]['gp2']) ? $tests[5]['gp2'] : "  Second gap "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
								
				<div class="col-12 mt-2">
					<div class="col mb-2" style="display: block;" id="div-part-fg3">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px;" id="part-fg3" name="part-fg3" rows="1" onfocus="if (this.value=='  Third part ')this.value=''" 
										onblur="if(this.value=='') this.value='  Third part '"><?= isset($tests[6]['pt3']) ? $tests[6]['pt3'] : "  Third part "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-1">
					<div class="col mb-2" style="display: block;" id="div-gap-fg3">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px; background-color: #ffffb0;" id="gap-fg3" name="gap-fg3" rows="1" onfocus="if (this.value=='  Third gap ')this.value=''" 
										onblur="if(this.value=='') this.value='  Third gap '"><?= isset($tests[7]['gp3']) ? $tests[7]['gp3'] : "  Third gap "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>
								
				<div class="col-12 mt-1">
					<div class="col mb-2" style="display: block;" id="div-part-fg-last">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10" style="margin-left: -80px;">	
								<textarea style="width:888px;" id="part-fg-last" name="part-fg-last" rows="1" onfocus="if (this.value=='  Last part ')this.value=''" 
										onblur="if(this.value=='') this.value='  Last part '"  ><?= isset($last) ? $last : "  Last part "; ?></textarea>	
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- end input fill in the gaps - fg -->			
			
