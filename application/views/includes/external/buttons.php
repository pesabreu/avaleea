

<?php

	$var = $this->session->userdata("logged");
	$logged = isset($var) ? ($var == 2 ? FALSE : TRUE) : FALSE;

?>
		<!-- Buttons -->
    	<div class="row wrapper text-center d-flex justify-content-center align-items-start mt-2">
				<div class="row" style="margin-top: 10px;">  <!-- Functions new, view, save, save & new -->
				
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" id="div_toolbar" name="div_toolbar">
						<div class="col-2"></div>	
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-5 pl-2 mr-5 pr-5" role="group" aria-label="First group">
							<a href="<?= base_url('home/external_questions/new')?>" class="btn btn-outline-info" id="btn-new" name="btn-new">
								<i class="ion ion-android-add-circle"></i>
								New question
							</a>
						  </div>
						</div>
						
						<div class="col-1"></div>
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-5 pl-4 mr-5 pr-5" role="group" aria-label="First group">
							<a href="<?= base_url('home/external_questions/dashboard')?>" class="btn btn-outline-info" id="btn-new" name="btn-new">
								<i class="ion ion-android-desktop"></i>
								Dashboard
							</a>
						  </div>
						</div>

						<div class="col-1"></div>
						<?php if (!$logged) : ?> 
							<div class="col-2">
							  <div class="btn-group btn-group-md ml-5 pl-4 mr-5" role="group" aria-label="Third group">							
									<button type="button" class="btn btn-outline-info" id="btn-sigin" name="btn-sigin" data-toggle="modal" data-target="#modal_signin">
										<i class="ion ion-log-in"></i>
										Sign in
									</button>							
	
							  </div>
							</div>
						<?php endif ; ?> 								
<!--						
						<div class="col-1">
						  <div class="btn-group btn-group-md ml-5 pl-3 mr-5 pr-5" role="group" aria-label="Second group">
							<button type="button" class="btn btn-outline-info" id="btn-preview" name="btn-preview">
								<i class="ion ion-eye"></i>
								Preview
							</button>
						  </div>
						</div>

						<div class="col-3">
						  <div class="btn-group btn-group-md ml-5 pl-5 mr-5 pr-5" role="group" aria-label="Third group">
							
							<?php if ($logged) : ?> 
								<button type="button" class="btn btn-outline-info" id="btn-save" name="btn-save">
									<i class="ion ion-android-checkbox"></i>
									Save Test
								</button>
							
							<?php else : ?> 
								<button type="button" class="btn btn-outline-info" id="btn-save" name="btn-save"
												 data-toggle="modal" data-target="#modal_signin_save">
									<i class="ion ion-log-in"></i>
									<i class="ion ion-android-checkbox"></i>
									Sign in & Save Test
								</button>
							
							<?php endif ; ?> 								
						  </div>
						</div>
-->
<!--
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-5 mr-5" role="group" aria-label="Fourth group">
							<button type="button" class="btn btn-outline-info" id="btn-save-new" name="btn-save-new">
								<i class="ion ion-android-checkbox"></i>
								<i class="ion ion-android-add-circle"></i>
								Save & New
							</button>
						  </div>
						</div>
					
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-5 pl-5" role="group" aria-label="Fifth group">
							<button type="button" class="btn btn-outline-info" id="btn-send" name="btn-send">
								<i class="ion ion-paper-airplane"></i>
								Send
							</button>
						  </div>
						</div>
-->							
					</div>	<!-- end .btn-toolbar -->			
				
				</div>	<!-- end Functions -->										
			</div>	<!-- end Wrapper -->

			
			<div class="row mt-1" id="hr-btn-functions" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			
		
			<div class="row text-center d-flex justify-content-center align-items-start my-3" id="div_type_questions" name="div_type_questions">  <!-- select Type Questions -->
				<div class="btn-group btn-group-toggle" data-toggle="buttons" id="btn_type_questions" name="btn_type_questions">
				  <label class="btn btn-primary active mx-2" name="lbl-mc" id="lbl-mc">
					<input type="radio" name="options" id="optionMC" autocomplete="off">
					<i class="ion ion-ios-list-outline"></i>
					multiple choice
				  </label>
				  <label class="btn btn-primary mx-2" name="lbl-tf" id="lbl-tf">
					<input type="radio" name="options" id="optionTF" autocomplete="off"> 
					<i class="ion ion-compose"></i>
					true and false
				  </label>
				  <label class="btn btn-primary mx-2" name="lbl-fg" id="lbl-fg">
					<input type="radio" name="options" id="optionFG" autocomplete="off"> 
					<i class="ion ion-ios-settings-strong"></i>
					fill in the gaps
				  </label>
				  <label class="btn btn-primary mx-2" name="lbl-sq" id="lbl-sq">
					<input type="radio" name="options" id="optionSQ" autocomplete="off"> 
					<i class="ion ion-edit"></i>
					subjective question
				  </label>
				</div>			
			</div>		  <!-- end select Type Questions -->
	
