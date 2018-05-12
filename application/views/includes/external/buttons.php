


    	<div class="row wrapper text-center d-flex justify-content-center align-items-start mt-5">
				<div class="row" style="margin-top: 30px;">  <!-- Functions new, view, save, save & new -->
				
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
						<div class="col-3">
						  <div class="btn-group btn-group-md ml-2 mr-1" role="group" aria-label="First group">
							<a href="<?= base_url('home/external_questions')?>" class="btn btn-outline-info" id="btn-new" name="btn-new">
								<i class="ion ion-android-add-circle"></i>
								New question
							</a>
						  </div>
						</div>
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-2 mr-2" role="group" aria-label="Second group">
							<button type="button" class="btn btn-outline-info" id="btn-preview" name="btn-preview">
								<i class="ion ion-ios-eye"></i>
								Preview
							</button>
						  </div>
						</div>
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-4 mr-2" role="group" aria-label="Third group">
							<button type="button" class="btn btn-outline-info" id="btn-save" name="btn-save">
								<i class="ion ion-android-checkbox"></i>
								Save
							</button>
						  </div>
						</div>
						<div class="col-3">
						  <div class="btn-group btn-group-md ml-3 mr-2" role="group" aria-label="Fourth group">
							<button type="button" class="btn btn-outline-info" id="btn-save-new" name="btn-save-new">
								<i class="ion ion-android-checkbox"></i>
								<i class="ion ion-android-add-circle"></i>
								Save & New
							</button>
						  </div>
						</div>
						<div class="col-2">
						  <div class="btn-group btn-group-md ml-3 mr-2" role="group" aria-label="Fifth group">
							<button type="button" class="btn btn-outline-info" id="btn-send" name="btn-send">
								<i class="ion ion-paper-airplane"></i>
								Send
							</button>
						  </div>
						</div>
						
					</div>				
				
				</div>	<!-- end Functions -->										
			</div>	<!-- end Wrapper -->

			
			<div class="row mt-1" style="border: 2px ridge #007BFF;"> </div>  <!-- HR -->			
	
	
			<div class="row text-center d-flex justify-content-center align-items-start my-3">  <!-- select Type Questions -->
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
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
	
