
<?php	
/*
	print_r($tests);
	exit;
*/
?>

            <!-- input answers Multiple Choice - mc -->
            <div class="row text-center d-flex justify-content-center align-items-center my-1 mx-5" name="div-answers-mc" id="div-answers-mc">

				<div class="col mb-2" id="div-answer1">
					<div class="row">
						<div class="col-2">
							<i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
						</div>
						<div class="col-8" style="margin-left: -80px;">	
							<textarea style="width:788px;" id="answer1" name="answer1" rows="1" onfocus="if (this.value=='  Option 1 ')this.value='  '" 
									onblur="if(this.value=='  ') this.value='  Option 1 '"><?= isset($tests[1]['asw1']) ? $tests[1]['asw1'] : "  Option 1 "; ?></textarea>	
						</div>
						<div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="right-wrong" id="right-wrong1" value="right-wrong1" 						
								<?= isset($tests[1]['right']) ? ($tests[1]['right'] == 'r' ? ' checked ' : '') : ''; ?>>
								
								<span id="span-rw1"> <img class="img-fluid" 
									src="<?php echo ($tests[1]['right'] == 'w') ? base_url('includes/img/wrong.png') : base_url('includes/img/right.png'); ?>"
									height="10px" style="margin-top: -4px;"> </span>
							</div>
						</div>
					</div>
				</div>				
				<div class="col mb-2" id="div-answer2">
					<div class="row">
						<div class="col-2">
							<i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
						</div>
						<div class="col-8" style="margin-left: -80px;">	
							<textarea style="width:788px;" id="answer2" name="answer2" rows="1" onfocus="if (this.value=='  Option 2 ')this.value='  '" 
									onblur="if(this.value=='  ') this.value='  Option 2 '"><?= isset($tests[2]['asw2']) ? $tests[2]['asw2'] : "  Option 2 "; ?></textarea>	
						</div>
						<div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="right-wrong" id="right-wrong2" value="right-wrong2"
								<?= isset($tests[2]['right']) ? ($tests[2]['right'] == 'r' ? ' checked ' : '') : ""; ?>>
								<span id="span-rw2"> <img class="img-fluid" 
									src="<?php echo ($tests[2]['right'] == 'w') ? base_url('includes/img/wrong.png') : base_url('includes/img/right.png'); ?>" 
									height="30px" style="margin-top: -4px;"> </span>
							</div>
						</div>						
					</div>
				</div>
				
				<div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer3">
					<div class="row">
						<div class="col-2">
							<button type="button" class="btn btn-primary btn-sm" id="btn-answer3"> 
								<i class="ion ion-plus"></i>
								Answer					
							</button>
						</div>
						<div class="col-10" style="margin-left: -50px;">	
						</div>
					</div>
				</div>
				<div class="col mb-2" style="display: none;" id="div-answer3">
					<div class="row">
						<div class="col-2">
							<i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
						</div>
						<div class="col-8" style="margin-left: -80px;">	
							<textarea style="width:788px;" id="answer3" name="answer3" rows="1" onfocus="if (this.value=='  Option 3 ')this.value='  '" 
									onblur="if(this.value=='  ') this.value='  Option 3 '"><?= isset($tests[3]['asw3']) ? $tests[3]['asw3'] : "  Option 3 "; ?></textarea>	
						</div>
						<div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="right-wrong" id="right-wrong3" value="right-wrong3"
								<?= isset($tests[3]['right']) ? ($tests[3]['right'] == 'r' ? ' checked ' : '') : ""; ?>>
								<span id="span-rw3"> <img class="img-fluid" 
									src="<?php echo ($tests[3]['right'] == 'w') ? base_url('includes/img/wrong.png') : base_url('includes/img/right.png'); ?>" 
									height="20px" style="margin-top: -4px;"> </span>
							</div>
						</div>												
					</div>
				</div>				
				
				<div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer4" style="display: none;">
					<div class="row">
						<div class="col-2">
							<button type="button" class="btn btn-primary btn-sm" id="btn-answer4"> 
								<i class="ion ion-plus"></i>
								Answer					
							</button>
						</div>
						<div class="col-10" style="margin-left: -50px;">	
						</div>
					</div>
				</div>
				<div class="col mb-2" style="display: none;" id="div-answer4">
					<div class="row">
						<div class="col-2">
							<i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
						</div>
						<div class="col-8" style="margin-left: -80px;">	
							<textarea style="width:788px;" id="answer4" name="answer4" rows="1" onfocus="if (this.value=='  Option 4 ')this.value='  '" 
									onblur="if(this.value=='  ') this.value='  Option 4 '"><?= isset($tests[4]['asw4']) ? $tests[4]['asw4'] : "  Option 4 "; ?></textarea>	
						</div>
						<div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="right-wrong" id="right-wrong4" value="right-wrong4"
								<?= isset($tests[4]['right']) ? ($tests[4]['right'] == 'r' ? ' checked ' : '') : ""; ?>>
								<span id="span-rw4"> <img class="img-fluid" 
									src="<?php echo ($tests[4]['right'] == 'w') ? base_url('includes/img/wrong.png') : base_url('includes/img/right.png'); ?>"
									height="20px" style="margin-top: -4px;"> </span>
							</div>
						</div>												
					</div>
				</div>				
				
				<div class="col-12 ml-5 pl-5 mb-2" id="div-btn-answer5" style="display: none;">
					<div class="row">
						<div class="col-2">
							<button type="button" class="btn btn-primary btn-sm" id="btn-answer5"> 
								<i class="ion ion-plus"></i>
								Answer					
							</button>
						</div>
						<div class="col-10" style="margin-left: -50px;">	
						</div>
					</div>
				</div>
				<div class="col mb-2" style="display: none;" id="div-answer5">
					<div class="row">
						<div class="col-2">
							<i class="ion ion-ios-circle-outline mt-1 mr-2" style="font-size: 1.5em;"></i>
						</div>
						<div class="col-8" style="margin-left: -80px;">	
							<textarea style="width:788px;" id="answer5" name="answer5" rows="1" onfocus="if (this.value=='  Option 5 ')this.value='  '" 
									onblur="if(this.value=='  ') this.value='  Option 5 '"><?= isset($tests[5]['asw5']) ? $tests[5]['asw5'] : "  Option 5 "; ?></textarea>	
						</div>
						<div class="col-1 bg-info" style="margin-left: 130px; height: 30px; padding-top: 2px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="right-wrong" id="right-wrong5" value="right-wrong5"
								<?= isset($tests[5]['right']) ? ($tests[5]['right'] == 'r' ? ' checked ' : '') : ""; ?>>
								<span id="span-rw5"> <img class="img-fluid" 
									src="<?php echo ($tests[5]['right'] == 'w') ? base_url('includes/img/wrong.png') : base_url('includes/img/right.png'); ?>" 
									height="20px" style="margin-top: -4px;"> </span>
							</div>
						</div>
					</div>
				</div>

            </div>	   
            <!-- end input answers Multiple Choice - mc -->

