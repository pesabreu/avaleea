

<?php
//sleep(1);	
?>

<script type="text/javascript">		
	$('#edit_questionnaire').hide();
	$('view_questionnaire').hide();
	
	function store_questionnaries(parm=0) {
		$('#id_questionnaries').val(0);
		
  		$(document).ready(function(){
  			$('#selectQuestionnaries').change(function(){
  				$('#edit_questionnaire').show();
  				$('view_questionnaire').show();          
				var id = $('#selectQuestionnaries option:selected').val();			
				$('#id_questionnaries').val(id);  
  			});
  		});				
		return true;
	}
</script>


<!--  Select and edit questionnaires   -->

				  <div class="example-modal" id="form_questionnaires">			     
					<div class="modal modal-default" id="formModalQuestionnaires">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center">Questionnaires Update</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
					
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" id="form_dd_Questionnarie" onsubmit="return valid()" />

								  <div class="form-group">
                					<label for="selectQuestionnaries" class="col-sm-2 control-label">Questionnaries</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" size="3" id="selectQuestionnaries" name="selectQuestionnaries" onchange="return store_questionnaries(this);" required>
	                				  <option selected="selected" value="">Select Questionnaries</option>
	                				  	
			                            <?php foreach($questionnaries->result() as $questionnarie): ?>                        
			                                <option value="<?= $questionnarie->id_questionnaries; ?>">
			                                	<?= trim($questionnarie->name_questionnaries); ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
									</div>              	
          						  </div>
              									
								  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button id="new_questionnaire" name="new_questionnaire" type="button" class="btn btn-success pull-right" 
			   		                  			data-backdrop="static" data-toggle="modal" data-target="#formModalQuestionnaires_edit">
			   		                  	New
		   		                  	  </button>
				                	  <button id="view_questionnaire" name="view_questionnaire" type="button" class="btn btn-primary" style="margin-left: 135px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalQuestionnaires_view">
            	  						View
        	  						  </button>
				                	  <button id="edit_questionnaire" name="edit_questionnaire" type="button" class="btn btn-info pull-left" style="margin-left: 90px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalQuestionnaires_edit">
            	  						Edit
        	  						  </button>
								  </div>              	
 
								</form>		                
					          </div>
						      <!-- /.box-body -->
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" id="btn_close_bottom" name="btn_close_bottom" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
			              </div>
	                	  			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        

					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->




<!-- Questionnaries Forms Client  
			
				<div id="modal_questionnaries" name="modal_questionnaries">
				</div>
				-->
				
				
			<div class="col-md-12">
				<div class="example-modal" id="form_questionnaires_edit">			     
					<div class="modal modal-default" id="formModalQuestionnaires_edit">			          

						  <?php							
							$y = $this->session->userdata("edit_questionnarie");
								
							if ($y == '1') {
								$x = $this->session->userdata("questionnarie");
								$questionnarie = (isset($x)) ? ($x != "" ? $x : '') : '';
								$id = $questionnarie[0]['id_questionnaries'];
								$id_cfg = $questionnarie[0]['id_cfg_questionnaries'];
								$title = $questionnarie[0]['title_questionnaries'];
								
								$this->session->set_userdata("id_questionnaries", $id );
								$this->session->set_userdata("title_questionnaries", $title);						              		
							} else {
								$id = 0;
								$id_cfg = 0;
								$questionnarie = "";
							}
						  ?>

					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
						  				              
						  <div class="modal-header">
			                <button type="button" id="btn_close_x" name="btn_close_x" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center" id="oper_questionnaries" name="oper_questionnaries"></h3>
			              </div>
		              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border"></div>
					
					          <div class="box-body" style="height: auto;">	

							    <form class="form-horizontal" role="form" method="post" id="form_dd" name="form_dd"
							            			action="" onsubmit="return valid()" />
									  
								<div class="col-md-12">
								  <div class="nav-tabs-custom">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#tab_1" id="tab1" name="tab1" data-toggle="tab">Questionnaire</a></li>
						              <li><a href="#tab_2" id="tab2" name="tab2" data-toggle="tab">Setup</a></li>
						              <li><a href="#tab_3" id="tab3" name="tab3" data-toggle="tab">Status</a></li>
						            </ul>
						            <div class="tab-content">
						
						              <div class="tab-pane active" id="tab_1">		<!-- tab 1 - Questionnaire -->            											
				
							              <div class="form-group">
					      					<label for="author" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="author" name="author" 
					        				  				value="<?= $this->session->userdata("name_user") ?>" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">
											<label for="selectType" class="col-sm-2 control-label">Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectType" name="selectType" onchange="" required>
						    				  	<option selected="selected" value="">Select Type questionnaire</option>
						                        <?php foreach($list_questionnaries_type->result() as $type): ?>                        
						                            <option value="<?= $type->id_questionnaries_type; ?>">
						                            	<?= $type->code_questionnaries_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
									  	
										  <div class="form-group">
											<label for="selectModules" class="col-sm-2 control-label">Modules</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectModules" name="selectModules" onchange="" required>
						    				  	<option selected="selected" value="">Select Modules</option>
						                        <?php foreach($list_modules->result() as $module): ?>                        
						                            <option value="<?= $module->id_modules; ?>">
						                            	<?= $module->name_modules; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
									  	
										  <div class="form-group">
											<label for="selectTypeAlternatives" class="col-sm-2 control-label">Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectTypeAlternatives" name="selectTypeAlternatives" onchange="" required>
						    				  	<option selected="selected" value="">Select Type Alternatives</option>
						                        <?php foreach($list_alternatives_type->result() as $alternative): ?>                        
						                            <option value="<?= $alternative->id_alternatives_type; ?>">
						                            	<?= $alternative->code_alternatives_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
						
							              <div class="form-group">
						  					<label for="name_questionnaries" class="col-sm-2 control-label">Name</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="name_questionnaries" name="name_questionnaries" placeholder="Name" 
						    				  			value="<?= $id > 0 ? $questionnarie[0]['name_questionnaries'] : '' ?>" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="title_questionnaries" class="col-sm-2 control-label">Title</label>
						  					<div class="col-sm-6">
						    				  <input type="text" class="form-control" id="title_questionnaries" name="title_questionnaries" placeholder="Title"
									    				  value="<?= $id > 0 ? $questionnarie[0]['title_questionnaries'] : '' ?>" />
						  					</div>	
						  					<label for="order_module_questionnaries" class="col-sm-2 control-label">Order</label>
						  					<div class="col-sm-2">
						    				  <input type="number'" class="form-control" id="order_module_questionnaries" name="order_module_questionnaries" placeholder="Order" 
						    				  			value="<?= $id > 0 ? $questionnarie[0]['order_module_questionnaries'] : 0 ?>" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="description_questionnaries" class="col-sm-2 control-label">Description</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="description_questionnaries" name="description_questionnaries" placeholder="Description"
						    				  			 value="<?= $id > 0 ? $questionnarie[0]['description_questionnaries'] : '' ?>" />
						  					</div>	
										  </div>
					
					                      <div class="form-group">
					                        <label for="instructions_questionnaries" class="col-sm-2 control-label">Instructions</label>
					                        <div class="col-sm-10">
					                            <textarea id="instructions_questionnaries" name="instructions_questionnaries" class="form-control" placeholder="Instructions" rows="5">
					                            	<?= $id > 0 ? $questionnarie[0]['instructions_questionnaries'] : '' ?> 
					                           	</textarea>
					                        </div>
					                      </div>
									  	
										  <div class="form-group">
											<label for="selectLeveltype" class="col-sm-2 control-label">Level</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectLeveltype" name="selectLeveltype" onchange="" required>
						    				  	<option selected="selected" value="">Select Level Type</option>
						                        <?php foreach($list_level_type->result() as $level): ?>                        
						                            <option value="<?= $level->id_level_type; ?>">
						                            	<?= $level->code_level_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
											
											<label for="selectSeriessemester" class="col-sm-2 control-label">Series</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectSeriessemester" name="selectSeriessemester" onchange="">
						    				  	<option selected="selected" value="">Series-Semester</option>
					                            <option value="1a.">1a. série</option>
						                        <option value="2a.">2a. série</option>
						                        <option value="3a.">3a. série</option>
						    				  </select>
											</div>						              	
										  </div>
						
										  <div class="form-group"> 
											<label for="selectSituation" class="col-sm-2 control-label">Situation</label>
											<div class="col-sm-5">
						    				  <select class="form-control" id="selectSituation" name="selectSituation" onchange="" readonly>
						    				  	<option selected="selected" value="#">Select Situation</option>
						                        <?php foreach($list_situation->result() as $situation): ?>                        
						                            <option value="<?= $situation->id_situation; ?>">
						                            	<?= $situation->code_situation; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
					              	
						  					<label for="dt_creation" class="col-sm-2 control-label">Creation</label>
						  					<div class="col-sm-3">
							  				  <input type="text" class="form-control" id="dt_creation" name="dt_creation" readonly 
							  				  			value="<?= $id > 0 ? $questionnarie[0]['dt_creation'] : date('Y-m-d') ?>" />
						  					</div>
										  </div>
										
										  <input type="hidden" id="id_questionnaries" name="id_questionnaries" value="<?= $id ?>" />																																
										
						              </div>
						              <!-- /.tab-pane 1 -->
						             
						              <div class="tab-pane" id="tab_2">		<!-- tab 2 - Setup -->
					
							              <div class="form-group">
					      					<label for="authorcfg" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="authorcfg" name="authorcfg" 
					        				  				value="<?= $this->session->userdata("name_user") ?>" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">												
											<label for="selectWhocustomize" class="col-sm-2 control-label">Customize</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectWhocustomize" name="selectWhocustomize" onchange="">
						    				  	<option selected="selected" value="">Who Customize</option>
					                            <option value="1">Default</option>
						                        <option value="2">Author</option>
						                        <option value="3">Buyer</option>
						                        <option value="4">Other</option>
						    				  </select>
											</div>						              	
										  
											<label for="selectFormmarket" class="col-sm-2 control-label">Market</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectFormmarket" name="selectFormmarket" onchange="">
						    				  	<option selected="selected" value="">Form Market</option>
					                            <option value="1">Public</option>
						                        <option value="2">Private</option>
						                        <option value="3">For Rent</option>
						                        <option value="3">Other</option>
						    				  </select>
											</div>						              	
										  </div>
						
										  <div class="form-group"> 
											<label for="selectPresentationtype" class="col-sm-2 control-label">Presentation</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectPresentationtype" name="selectPresentationtype" onchange="" required>
						    				  	<option selected="selected" value="">Select Type Presentation</option>
						                        <?php foreach($list_presentation_type->result() as $type): ?>                        
						                            <option value="<?= $type->id_presentation_type; ?>">
						                            	<?= $type->code_presentation_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>

										  <div class="form-group">
											<label for="selectAllowsinterrupt" class="col-sm-2 control-label">Interrupt</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectAllowsinterrupt" name="selectAllowsinterrupt" onchange="" required>
						    				  	<option selected="selected" value="">Select Allows Interrupt</option>
						                        <?php foreach($list_allows_interrupt->result() as $allows): ?>                        
						                            <option value="<?= $allows->id_allows_interrupt; ?>">
						                            	<?= $allows->code_allows_interrupt; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
									  	
										  <div class="form-group">
											<label for="selectAllowsnavigate" class="col-sm-2 control-label">Navigate</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectAllowsnavigate" name="selectAllowsnavigate" onchange="" required>
						    				  	<option selected="selected" value="">Select Allows Navigate</option>
						                        <?php foreach($list_allows_navigate->result() as $allows_navigate): ?>                        
						                            <option value="<?= $allows_navigate->id_allows_navigate; ?>">
						                            	<?= $allows_navigate->code_allows_navigate; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>

										  <div class="form-group">
											<label for="selectMandatoryanswers" class="col-sm-2 control-label">Mandatory</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectMandatoryanswers" name="selectMandatoryanswers" onchange="" required>
						    				  	<option selected="selected" value="">Select Mandatory Answers</option>
						                        <?php foreach($list_mandatory_answers->result() as $mandatory_answers): ?>                        
						                            <option value="<?= $mandatory_answers->id_mandatory_answers; ?>">
						                            	<?= $mandatory_answers->code_mandatory_answers; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
										  </div>											 
						
										  <div class="form-group"> 
											<label for="selectFlowissues" class="col-sm-2 control-label">Flow</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectFlowissues" name="selectFlowissues" onchange="" required>
						    				  	<option selected="selected" value="">Select Flow Issues</option>
						                        <?php foreach($list_flow_issues->result() as $flow_issues): ?>                        
						                            <option value="<?= $flow_issues->id_flow_issues; ?>">
						                            	<?= $flow_issues->code_flow_issues; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
					              		  </div>
												  	
										  <div class="form-group"> 
						  					<label for="time_duration" class="col-sm-2 control-label">Duration</label>
						  					<div class="col-sm-3">
						    				  <input type="number'" class="form-control" id="time_duration" name="time_duration" placeholder="minutes"
						    				  			value="<?= $id > 0 ? $questionnarie[0]['time_duration'] : 0 ?>" />
						  					</div>	
					              	
						  					<label for="quantity_issues" class="col-sm-offset-2 col-sm-2 control-label">Quantity</label>
						  					<div class="col-sm-3">
						    				  <input type="number'" class="form-control" id="quantity_issues" name="quantity_issues" placeholder="Quantity" 
						    				  			value="<?= $id > 0 ? $questionnarie[0]['quantity_issues'] : 0 ?>" />
						  					</div>	
					           	      		
					           	      		<input type="hidden" id="id_cfg_questionnaries" name="id_cfg_questionnaries" value="<?= $id_cfg ?>" />		                   	                      				  
										  </div>							

						              </div>
						              <!-- tab-pane 2 -->
						             
						              <div class="tab-pane text-center" id="tab_3" name="tab_3" style="padding: 20px;">		<!-- tab 3 - Alternatives -->						                
						              
						              	<h4 style="color: red;"> Save the Questionnaire to get your status updated</h4>
						              
						              </div>
						              <!-- /.tab-pane 3 -->
									
										<!-- botões do form -->
						              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
						                  <button type="button" id="btn_close" name="btn_close" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
					                	  <button type="submit" id="btn_save" name="btn_save" class="btn btn-success pull-left">Save</button>
									  </div>	
						
						            </div>
						            <!-- /.tab-content -->
						          </div>
						          <!-- /.tab-custom -->
						        </div>		<!-- end col -->								  
							</form>

 					          </div>
						      <!-- /.box-body -->
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
			              </div>
	                	  			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        



					
					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->
			</div>
			<!-- /.col-md-12 -->


		<!-- Questionnaires Views -->
							
			<div class="col-md-12">
				<div class="example-modal" id="form_questionnaires_view">			     
					<div class="modal modal-default" id="formModalQuestionnaires_view">			          

						<div class="modal-dialog">			            
							<div class="modal-content" style="background-color: #BDB76B;">
								<div class="modal-header">
									<button type="button" id="btn_close_x" name="btn_close_x" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">X</span>
									</button>
									<h3 class="modal-title text-center"> Questionnaire View </h3>
								</div>
						  
								<div class="modal-body" style="color: black;">										                
									<div class="box">						        						
										<div class="box-header with-border text-center" id="header_view" name="header_view"
												style="color: #333300; font-weight: 800; font-size: 1.2em;"> Header </div> <!-- /.box-header -->
						
										<div class="box-body" id="body_content" name="body_content" style="height: auto;">
											Content 																				
										</div> <!-- /.box-body -->							
										
									</div>	<!-- /.box -->			                
			           	      		<input type="hidden" id="id_questionnariesv" name="id_questionnariesv" value="" />		                   	                      				  

								</div> <!-- /.modal-body -->
							  
								<div class="modal-footer">
									<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
								</div> <!-- /.modal-footer -->
													
							</div> <!-- /.modal-content -->		          
						</div> <!-- /.modal-dialog -->		        

					</div> <!-- /.modal -->		     
				</div> <!-- /.example-modal -->
			</div> <!-- /.col-md-12 -->


		