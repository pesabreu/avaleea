

<?php
//sleep(1);	
?>

<script type="text/javascript">		
	$('#edit_application').hide();
	$('#view_application').hide();
	
	function store_application(parm=0) {
		$('#id_application').val(0);
		
  		$(document).ready(function(){
  			$('#selectApplication').change(function(){
  				$('#edit_application').show();
  				$('#view_application').show();          
				var id = $('#selectApplication option:selected').val();			
				$('#id_application').val(id);  
  			});
  		});				
		return true;
	}
</script>


<!--  Select and edit applications   -->

				  <div class="example-modal" id="form_application">			     
					<div class="modal modal-default" id="formModalApplications">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
			              
						  <div class="modal-header">
			                <button type="button" class="close" id="btn_close_app" name="btn_close_app" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center">Application Update</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
					
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" id="form_dd_Aplication_select" name="form_dd_Aplication_select" onsubmit="return valid_application()" />

								  <div class="form-group">
                					<label for="selectApplication" class="col-sm-2 control-label">Application</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" size="3" id="selectApplication" name="selectApplication" onchange="return store_application(this);" required>
	                				  <option selected="selected" value="#">Select Application</option>
	                				  	
			                            <?php foreach($applications->result() as $application): ?>                        
			                                <option value="<?= $application->id_application; ?>">
			                                	<?= trim($application->name_application); ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
									</div>              	
          						  </div>
              									
								  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button id="new_application" name="new_application" type="button" class="btn btn-success pull-right" 
			   		                  			data-backdrop="static" data-toggle="modal" data-target="#formModalApplication_edit">
			   		                  	New
		   		                  	  </button>
				                	  <button id="view_application" name="view_application" type="button" class="btn btn-primary" style="margin-left: 135px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalApplication_view">
            	  						View
        	  						  </button>
				                	  <button id="edit_application" name="edit_application" type="button" class="btn btn-info pull-left" style="margin-left: 90px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalApplication_edit">
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




<!-- Application Forms Client  
			
				<div id="modal_application" name="modal_application">
				</div>
				-->
				
				
			<div class="col-md-12">
				<div class="example-modal" id="form_application_edit">			     
					<div class="modal modal-default" id="formModalApplication_edit">			          

						  <?php							
							$y = $this->session->userdata("edit_application");
								
							if ($y == '1') {
								$x = $this->session->userdata("application");
								$application = (isset($x)) ? ($x != "" ? $x : '') : '';
								$id = $application[0]['id_application'];
								$id_cfg = $application[0]['id_cfg_application'];
								$title = $application[0]['title_application'];
								
								$this->session->set_userdata("id_application", $id );
								$this->session->set_userdata("title_application", $title);						              		
							} else {
								$id = 0;
								$id_cfg = 0;
								$title = "";
								$application = "";
							}
						  ?>

					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
						  				              
						  <div class="modal-header">
			                <button type="button" id="btn_close_x" name="btn_close_x" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
	
			                <h3 class="modal-title text-center" id="oper_application" name="oper_application"></h3>
			              </div>
		              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border"></div>
					
					          <div class="box-body" style="height: auto;">	

							    <form class="form-horizontal" role="form" method="post" id="form_dd_Application" name="form_dd_Application"
							            			action="" onsubmit="return valid_application()" />
									  
								<div class="col-md-12">
								  <div class="nav-tabs-custom">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#tab_1p" id="tab1p" name="tab1" data-toggle="tab">Application</a></li>
						              <li><a href="#tab_2p" id="tab2p" name="tab2p" data-toggle="tab">Setup</a></li>
						              <li><a href="#tab_3p" id="tab3p" name="tab3p" data-toggle="tab">Status</a></li>
						            </ul>
						            <div class="tab-content">
						
						              <div class="tab-pane active" id="tab_1p" name="tab_1p">		<!-- tab 1 - Application -->            											
				
							              <div class="form-group">
					      					<label for="authorp" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="authorp" name="authorp" 
					        				  				value="<?= $this->session->userdata("name_user") ?>" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">
											<label for="selectType" class="col-sm-2 control-label">Type</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectType" name="selectType" onchange="" required>
						    				  	<option selected="selected" value="">Select Type application</option>
						                        <?php foreach($list_application_type->result() as $type): ?>                        
						                            <option value="<?= $type->id_application_type; ?>">
						                            	<?= $type->code_application_type; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>
									  										  	
										  <div class="form-group">
											<label for="selectApplicationmode" class="col-sm-2 control-label">Mode</label>
											<div class="col-sm-10">
						    				  <select class="form-control" id="selectApplicationmode" name="selectApplicationmode" onchange="" required>
						    				  	<option selected="selected" value="">Select Mode application</option>
						                        <?php foreach($list_application_mode->result() as $mode): ?>                        
						                            <option value="<?= $mode->id_application_mode; ?>">
						                            	<?= $mode->code_application_mode; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>              	
										  </div>

										  <div class="form-group">
		                					<label for="selectQuestionnariesp" class="col-sm-2 control-label" style="font-size: 0.9em;">Questionnaires</label>
		                					<div class="col-sm-10">
			                				  <select multiple="multiple" class="form-control" size="3" id="selectQuestionnariesp" name="selectQuestionnariesp[]" required>
			                				  <option value="0">Select Questionnaires</option>
			                				  	
					                            <?php foreach($questionnaries->result() as $questionnarie): ?>                        
					                                <option value="<?= $questionnarie->id_questionnaries; ?>">
					                                	<?= trim($questionnarie->name_questionnaries); ?>
					                                </option>
					                            <?php endforeach; ?> 
			                				  </select>
											</div>              	
		          						  </div>
              													
							              <div class="form-group">
						  					<label for="name_application" class="col-sm-2 control-label">Name</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="name_application" name="name_application" placeholder="Name" 
						    				  			value="" />
						  					</div>	
										  </div>
						
							              <div class="form-group">
						  					<label for="title_application" class="col-sm-2 control-label">Title</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="title_application" name="title_application" placeholder="Title"
									    				  value="" />
						  					</div>	
										  </div>
					
					                      <div class="form-group">
					                        <label for="note" class="col-sm-2 control-label">Text</label>
					                        <div class="col-sm-10">
					                            <textarea id="note" name="note" class="form-control" placeholder="Note" rows="5"> </textarea>
					                        </div>
										  	<input type="hidden" id="id_application" name="id_application" value="<?= $id ?>" />																																
					                      </div>
										
						              </div>
						              <!-- /.tab-pane 1 -->
						             
						              <div class="tab-pane" id="tab_2p" name="tab_2p">		<!-- tab 2 - Setup -->
					
							              <div class="form-group">
					      					<label for="authorpcfg" class="col-sm-2 control-label">Author</label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="authorpcfg" name="authorpcfg" 
					        				  				value="<?= $this->session->userdata("name_user") ?>" readonly />
					      					</div>	
					    				  </div>
									  	
										  <div class="form-group">	
						  					<label for="dt_application" class="col-sm-2 control-label">Creation</label>
						  					<div class="col-sm-3">
							  				  <input type="text" class="form-control" id="dt_application" name="dt_application" readonly 
							  				  			value="" />
						  					</div>
					              	
						  					<label for="dt_finished" class="col-sm-offset-2 col-sm-2 control-label">Finished</label>
						  					<div class="col-sm-3">
							  				  <input type="text" class="form-control" id="dt_finished" name="dt_finished" readonly 
							  				  			value="" />
						  					</div>
										  </div>
												  	
										  <div class="form-group"> 					              	
						  					<label for="quantity_evaluated" class="col-sm-2 control-label">Quantity</label>
						  					<div class="col-sm-2">
						    				  <input type="number'" class="form-control" id="quantity_evaluated" name="quantity_evaluated" placeholder="Quantity" readonly 
						    				  			value="" />
						  					</div>	
										  
											<label for="selectConfirmidpin" class="col-sm-offset-2 col-sm-3 control-label">Confirm PIN</label>
											<div class="col-sm-3">
						    				  <select class="form-control" id="selectConfirmidpin" name="selectConfirmidpin" onchange="">
						    				  	<option selected="selected" value="">Confirm PIN</option>
					                            <option value="0">No</option>
						                        <option value="1">Yes</option>
						    				  </select>
											</div>						              	
										  </div>							
									  	
										  <div class="form-group">												
											<label for="selectIndividualgroup" class="col-sm-2 control-label">Individual-Group</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectIndividualgroup" name="selectIndividualgroup" onchange="">
						    				  	<option selected="selected" value="">Individual-Group</option>
					                            <option value="1">Individual</option>
						                        <option value="2">Group</option>
						    				  </select>
											</div>						              	
										  
											<label for="selectTolerance" class="col-sm-3 control-label">Tolerance</label>
											<div class="col-sm-3">
						    				  <select class="form-control" id="selectTolerance" name="selectTolerance" onchange="">
						    				  	<option selected="selected" value="">Tolerance</option>
					                            <option value="0">No</option>
						                        <option value="1">Yes</option>
						    				  </select>
											</div>						              	
										  	<input type="hidden" id="id_cfg_applicationp" name="id_cfg_applicationp" value="<?= $id_cfg ?>" />																																
										  </div>

						              </div>
						              <!-- tab-pane 2 -->
						             
						              <div class="tab-pane text-center" id="tab_3p" name="tab_3p" style="padding: 20px;">		<!-- tab 3 - Alternatives -->						                
						              
						              	<h4 style="color: red;"> Save the Application to get your status updated</h4>
						              
						              </div>
						              <!-- /.tab-pane 3 -->
									
										<!-- botões do form -->
						              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
						                  <button type="button" id="btn_closep" name="btn_closep" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
					                	  <button type="submit" id="btn_savep" name="btn_savep" class="btn btn-success pull-left">Save</button>
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


		<!-- Application Views -->
							
			<div class="col-md-12">
				<div class="example-modal" id="form_application_view">			     
					<div class="modal modal-default" id="formModalApplication_view">			          

						<div class="modal-dialog">			            
							<div class="modal-content" style="background-color: #BDB76B;">
								<div class="modal-header">
									<button type="button" id="btn_close_x" name="btn_close_x" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">X</span>
									</button>
									<h3 class="modal-title text-center"> Application View </h3>
								</div>
						  
								<div class="modal-body" style="color: black;">										                
									<div class="box">						        						
										<div class="box-header with-border text-center" id="header_viewp" name="header_viewp"
												style="color: #333300; font-weight: 800; font-size: 1.2em;"> Header </div> <!-- /.box-header -->
						
										<div class="box-body" id="body_content" name="body_content" style="height: auto;">
											Content 																				
										</div> <!-- /.box-body -->							
										
									</div>	<!-- /.box -->			                
			           	      		<input type="hidden" id="id_applicationv" name="id_applicationv" value="" />		                   	                      				  

								</div> <!-- /.modal-body -->
							  
								<div class="modal-footer">
									<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
								</div> <!-- /.modal-footer -->
													
							</div> <!-- /.modal-content -->		          
						</div> <!-- /.modal-dialog -->		        

					</div> <!-- /.modal -->		     
				</div> <!-- /.example-modal -->
			</div> <!-- /.col-md-12 -->



<!--  Email Form Window with Invitation to Candidates  -->

				  <div class="example-modal" id="form_invitation_email">			     
					<div class="modal modal-default" id="formModalInvitationCandidates">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">×</span></button>
			                <h3 class="modal-title text-center">Invitation email</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
					
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" method="post" id="form_dd_invitation" action="" onsubmit="" />

								  <div class="form-group">
                					<label for="selectApplicationsi" class="col-sm-2 control-label">Applications</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" id="selectApplicationsi" name="selectApplicationsi" onchange="return true;" required>
	                				  	<option selected="selected" value="0">Select Application</option>
			                            <?php foreach($applications->result() as $application): ?>                        
			                                <option value="<?= $application->id_application; ?>">
			                                	<?= trim($application->name_application); ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
									</div>              	
          						  </div>
              	
								  <div class="form-group">
                					<label for="selectCandidatesi" class="col-sm-2 control-label">Candidate</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" id="selectCandidatesi" name="selectCandidatesi" onchange="return true;" required>
	                				  	<option selected="selected" value="0">Select Candidate</option>
			                            <?php foreach($candidates->result() as $candidate): ?>                        
			                                <option value="<?= $candidate->id.';'.trim($candidate->name).';'.trim($candidate->email_1) ; ?>">
			                                	<?= $candidate->name; ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
	                				  <div class="alert alert-danger" id="msg_invitation_candidate" name="msg_invitation_candidate" style="display: none;"></div>
									</div>              	
          						  </div>
              	
                				  <div class="form-group">                	
                  					<label for="inputDate" class="col-sm-2 control-label">Send date</label>
                  					<div class="col-sm-4">
					  				  <input type="text" class="form-control" id="inputDate" value="<?= date('Y-m-d H:i') ?>" readonly />
                  					</div>
                				  </div>

					              <div class="form-group">
                  					<label for="inputUrl" class="col-sm-2 control-label">Candidate Link</label>
                  					<div class="col-sm-10">
                    				  <input type="url" class="form-control" id="inputUrl" name="inputUrl" placeholder="Guest Link" 
                    				  				value="<?= base_url('invitations/invitations_link_candidate/2')?>" readonly />
                  					</div>	
                				  </div>

		                   	      <input type="hidden" id="id_people_invitationi" name="id_people_invitationi" />
		                   	      <input type="hidden" id="id_people_admini" name="id_people_admini" />		                   	                      				  
		                   	      <input type="hidden" id="id_applicationi" name="id_applicationi" />

					              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button type="button" id="btn_close_invitation" name="btn_close_invitation" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
				                	  <button type="submit" id="btn_submit_invitation" name="btn_submit_invitation" class="btn btn-success pull-left">Send</button>
								  </div>	

								  <div class="text-center" id="message_invitation" name="message_invitation"></div>
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








		