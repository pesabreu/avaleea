

<?php
//sleep(1);	
?>

<script type="text/javascript">	
	$('#edit_questions').hide();
		
	function store_questions(parm=0) {
		$('#id_questions').val(0);
		
  		$(document).ready(function(){
  			$('#selectQuestions').change(function(){
				var sel = $('#selectQuestions option:selected').val();
				if (sel == "" || sel == null || sel == '#') {
					$('#edit_questions').hide();
					$('#id_questions').val(0);
				} else {
					$('#edit_questions').show();
					$('#id_questions').val(sel);
				}				
  			});
  		});				
		return true;
	}
</script>


<!--  Select and edit questions   -->

				  <div class="example-modal" id="form_questions">			     
					<div class="modal modal-default" id="formModalQuestions">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-olive">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center">Questions Select</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
							
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" id="form_dd_questions" name="form_dd_questions" onsubmit="return valid_questions()" />
				
					              <div class="form-group">
			      					<label for="title_questionnaries_q" class="col-sm-2 control-label">Questionnaire</label>
			      					<div class="col-sm-10">
			        				  <input type="text" class="form-control" id="title_questionnaries_q" name="title_questionnaries_q" 
			        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly />
			      					</div>	
			    				  </div>

								  <div class="form-group">
                					<label for="selectQuestions" class="col-sm-2 control-label">Questions</label>
                					<div class="col-sm-10" id="select_question" name="select_question">
									</div>              	
          						  </div>
              									
								  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button id="new_questions" name="new_questions" type="button" class="btn btn-success pull-right" 
			   		                  			data-backdrop="static" data-toggle="modal" data-target="#formModalQuestions_edit">
			   		                  	New
		   		                  	  </button>
				                	  <button id="edit_questions" name="edit_questions" type="button" class="btn btn-info pull-left" style="margin-left: 90px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalQuestions_edit">
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
			                <button type="button" id="btn_close_bottomq" name="btn_close_bottomq" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
			              </div>
	                	  			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        

					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->




<!-- Questions Forms Client  -->
			
				<div class="col-md-12">

				  <div class="example-modal" id="form_questions_edit">			     
					<div class="modal modal-default" id="formModalQuestions_edit">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
							<?php	
								//$questions = $this->session->userdata("questions");
								$id_questions = $this->session->userdata("id_questions");								
								$id_questionnaries = $this->session->userdata("id_questionnaries");
								$id_cfg_questions = $this->session->userdata("id_cfg_questions");
							?>	
										  				              
						  <div class="modal-header">
			                <button type="button" id="btn_close_xq" name="btn_close_xq" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center" id="oper_questions" name="oper_questions"></h3>
			              </div>
		              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border"></div>
					
					          <div class="box-body" style="height: auto;">	

							    <form class="form-horizontal" role="form" method="post" id="form_dd_question_edit" name="form_dd_question_edit"
							            onsubmit="return valid_questions();" />
									  
								<div class="col-md-12">
								  <div class="nav-tabs-custom">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#tab_1q" id="tab1q" name="tab1q" data-toggle="tab">Questions</a></li>
						              <li><a href="#tab_2q" id="tab2q" name="tab2q" data-toggle="tab">Setup</a></li>
						              <li><a href="#tab_3q" id="tab3q" name="tab3q" data-toggle="tab">Status</a></li>
						            </ul>
						            <div class="tab-content">
						
						              <div class="tab-pane active" id="tab_1q" name="tab_1q">		<!-- tab 1 - Question -->            											
				
							              <div class="form-group">
					      					<label for="title_questionnariesq" class="col-sm-2 control-label"> Questionnaire </label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="title_questionnariesq" name="title_questionnariesq" 
					        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly style="margin-right: 5px;" />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">
											<label for="selectAlternativestype" class="col-sm-2 control-label">Alternatives Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectAlternativestype" name="selectAlternativestype" onchange="" required>
						    				  	<option selected="selected" value="">Select Type Alternatives</option>
						                        <?php foreach($list_alternatives_type->result() as $alternatives): ?>                        
						                            <option value="<?= $alternatives->id_alternatives_type; ?>">
						                            	<?= $alternatives->code_alternatives_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
									  			
							              <div class="form-group">
						  					<label for="name_questions" class="col-sm-2 control-label">Name</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="name_questions" name="name_questions" placeholder="Name" 
						    				  			value="" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="title_questions" class="col-sm-2 control-label">Title</label>
						  					<div class="col-sm-6">
						    				  <input type="text" class="form-control" id="title_questions" name="title_questions" placeholder="Title"
									    				  value="" />
						  					</div>	
						  					<label for="order_questionnaries" class="col-sm-2 control-label">Order</label>
						  					<div class="col-sm-2">
						    				  <input type="number'" class="form-control" id="order_questionnaries" name="order_questionnaries" placeholder="Order" 
						    				  			value="" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="enunciation" class="col-sm-2 control-label">Enunciation</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="enunciation" name="enunciation" placeholder="Enunciation"
						    				  			 value="" />
						  					</div>	
										  </div>
						
										<div class="form-group"> 
											<label for="selectSituationq" class="col-sm-2 control-label">Situation</label>
											<div class="col-sm-5">
						    				  <select class="form-control" id="selectSituationq" name="selectSituationq" onchange="" readonly>
						    				  	<option selected="selected" value="">Select Situation</option>
						                        <?php foreach($list_situation->result() as $situation): ?>                        
						                            <option value="<?= $situation->id_situation; ?>">
						                            	<?= $situation->code_situation; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
										
										  	<input type="hidden" id="id_questions" name="id_questions" value="" />																																
										  	<input type="hidden" id="id_questionnariesq" name="id_questionnariesq" value="<?= $id_questionnaries?>" />																																
										
						              	</div>
						              	<!-- /.tab-pane 1 -->
						             
						              </div>	
						             
						              <div class="tab-pane" id="tab_2q" name="tab_2q">		<!-- tab 2 - Setup -->

							              <div class="form-group">
					      					<label for="title_questionnariescfg" class="col-sm-2 control-label">Questionnaire</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="title_questionnariescfg" name="title_questionnariescfg" 
					        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">												
											<label for="selectWeight" class="col-sm-3 control-label">Weight Question</label>
											<div class="col-sm-3">
						    				  <select class="form-control" id="selectWeight" name="selectWeight" onchange="">
						    				  	<option selected="selected" value="">Weight</option>
					                            <option value="1">1</option>
						                        <option value="2">2</option>
						                        <option value="3">3</option>
						                        <option value="4">4</option>
						                        <option value="5">5</option>
						                        <option value="6">6</option>						                        
						                        <option value="7">7</option>
						                        <option value="8">8</option>
						                        <option value="9">9</option>
						                        <option value="10">10</option>
						    				  </select>
											</div>						              	
										  
											<label for="quantity_alternatives" class="col-sm-offset-1 col-sm-3 control-label">Quantity Alternatives</label>
											<div class="col-sm-2">
						    				  <input type="number" class="form-control" id="quantity_alternatives" name="quantity_alternatives" 
						    				  			min="1" max="20" step="1" />
											</div>						              	
										  </div>
									  	
										  <div class="form-group">										  
											<label for="time_durationq" class="col-sm-3 control-label">Duration Time </label>
											<div class="col-sm-3">				    				  
												<input type="number" class="form-control" id="time_durationq" name="time_durationq"
						    				  			min="1" max="300" step="1" /> 						    				  			
											</div>
											<div class="col-sm-1" style="margin-top: 5px; margin-left: -10px; font-weight: 800;">
												minutes
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
											<label for="selectMandatoryanswers" class="col-sm-2 control-label">Mandatory Answers</label>
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
											<label for="selectAllowsmodifyresponse" class="col-sm-2 control-label">Modify Response</label>
											<div class="col-sm-3">
						    				  <select class="form-control" id="selectAllowsmodifyresponse" name="selectAllowsmodifyresponse" onchange="">
						    				  	<option selected="selected" value="">Allows Modify</option>
					                            <option value="0">No</option>
						                        <option value="1">Yes</option>
						    				  </select>
											</div>						              	
					              	
											<label for="selectEditable" class="col-sm-offset-2 col-sm-2 control-label">Editable</label>
											<div class="col-sm-3">
						    				  <select class="form-control" id="selectEditable" name="selectEditable" onchange="">
						    				  	<option selected="selected" value="">Editable</option>
					                            <option value="0">No</option>
						                        <option value="1">Yes</option>
						    				  </select>
											</div>						              	
					           	      		
					           	      		<input type="hidden" id="id_cfg_questions" name="id_cfg_questions" value="<?= $id_cfg_questions ?>" />		                   	                      				  
										  </div>							

						              </div>
						              <!-- tab-pane 2 -->
						             
						              <div class="tab-pane text-center" id="tab_3q" name="tab_3q" style="padding: 20px;">		<!-- tab 3 - Alternatives -->						                
						              
						              	<h4 style="color: red;"> Save the Questions to get your status updated</h4>
						              </div>
						              <!-- /.tab-pane 3 -->
									
										<!-- botões do form -->
						              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
						                  <button type="button" id="btn_closeq" name="btn_closeq" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
					                	  <button type="submit" id="btn_saveq" name="btn_saveq" class="btn btn-success pull-left">Save</button>
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

