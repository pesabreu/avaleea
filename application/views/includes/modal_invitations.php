

<?php
//sleep(1);	
?>

<script type="text/javascript">		
	$('#start_invitation').hide();
	$('#view_invitation').hide();
	
	function store_application(parm=0) {
		$('#id_application').val(0);
		
  		$(document).ready(function(){
  			$('#selectInvitation').change(function(){
  				$('#start_invitation').show();
  				$('#view_invitation').show();          
				var id = $('#selectInvitation option:selected').val();			
				$('#id_application').val(id);  
  			});
  		});				
		return true;
	}
</script>


<!--  Select and start applications   -->

				  <div class="example-modal" id="form_invitations_select">			     
					<div class="modal modal-default" id="formModalInvitationReceived">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
			              
						  <div class="modal-header">
			                <button type="button" class="close" id="btn_close_inv" name="btn_close_inv" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center">Invitation Select</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
					
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" id="form_dd_Invitation_select" name="form_dd_Invitation_select" onsubmit="return true;" />

								  <div class="form-group">
                					<label for="selectInvitation" class="col-sm-2 control-label">Application</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" size="3" id="selectInvitation" name="selectInvitation" onchange="return true;" required>
	                				  <option selected="selected" value="#">Select Application</option>
	                				  	
			                            <?php foreach($invitations->result() as $invitation): ?>                        
			                                <option value="<?= $invitation->id_application; ?>">
			                                	<?= trim($invitation->name_application); ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
									</div>              	
          						  </div>
								
								  <div class="form-group text-center" id="list_questionnaires" name="list_questionnaires" style="">
                				  </div>
              									
								  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
				                	  <button id="view_invitation" name="view_invitation" type="button" class="btn btn-primary pull-right" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalInvitationApplication_view">
            	  						View
        	  						  </button>
				                	  <button id="start_invitation" name="start_invitation" type="button" class="btn btn-success pull-left" style="margin-left: 90px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalAnswersQuestionnaires">
            	  						Start
        	  						  </button>
								  </div>              	
								  <input type="hidden" id="id_application_inv" name="id_application_inv" />																																
 
								</form>		                
					          </div>
						      <!-- /.box-body -->
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" id="btn_close_bottom_inv" name="btn_close_bottom_inv" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
			              </div>
	                	  			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        

					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->



<!-- Application Forms Candidate

		<!-- Application Views -->
							
			<div class="col-md-12">
				<div class="example-modal" id="form_invitation_application_view">			     
					<div class="modal modal-default" id="formModalInvitationApplication_view">			          

						<div class="modal-dialog">			            
							<div class="modal-content" style="background-color: #BDB76B;">
								<div class="modal-header">
									<button type="button" id="btn_close_invapp" name="btn_close_invapp" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">X</span>
									</button>
									<h3 class="modal-title text-center"> Application View </h3>
								</div>
						  
								<div class="modal-body" style="color: black;">										                
									<div class="box">						        						
										<div class="box-header with-border text-center" id="header_view_inv" name="header_view_inv"
												style="color: #333300; font-weight: 800; font-size: 1.2em;"> Header </div> <!-- /.box-header -->
						
										<div class="box-body" id="body_content_inv" name="body_content_inv" style="height: auto;">																							
										</div> <!-- /.box-body -->							
										
									</div>	<!-- /.box -->			                
			           	      		<input type="hidden" id="id_application_inv" name="id_application_inv" value="" />		                   	                      				  

								</div> <!-- /.modal-body -->
							  
								<div class="modal-footer">
									<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
								</div> <!-- /.modal-footer -->
													
							</div> <!-- /.modal-content -->		          
						</div> <!-- /.modal-dialog -->		        

					</div> <!-- /.modal -->		     
				</div> <!-- /.example-modal -->
			</div> <!-- /.col-md-12 -->



<!-- 		formModalAnswersQuestionnaires  -->			
				
		<div class="col-md-12">
			<div class="example-modal text-center" id="form_answersquestionnaires">			     
				<div class="modal modal-default" id="formModalAnswersQuestionnaires">			          							
					
					<div class="modal-dialog">

						<div class="modal-content bg-teal">			  				              
						  <div class="modal-header">
		                	<span class="modal-title text-center" style="color: #000; font-size: 1.4em; font-weight: 600;">
								Answering Questionnaire
							</span>				  	
						  	
			                <button type="button" id="btn_close_aq" name="btn_close_aq" class="close pull-right" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span>
			                </button>
			              </div>          
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
					          <div class="box-body" style="height: auto;">	
			
						    	<form class="form-horizontal" role="form" method="post" 
						          				action="" id="form_dd_questionnaires_candidate" name="form_dd_questionnaires_candidate" /> 
						           	<div class="text-center" id="form_answers_questionnaires" name="form_answers_questionnaires">	</div>			            	
					          	</form>
		
		          		  	  </div>
			      		  	  <!-- /.box-body -->		
		  				    </div>
						    <!-- /.box -->			                
		      		      </div>
		      		      <!-- modal-body -->
		      		  
					  	  <div class="modal-footer">
				            <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
				      	  </div>
			  			            
						</div>
		    		<!-- /.modal-content --> 

		  		  	</div>
		  		  	<!-- /.modal-dialog --> ';
				</div>
				<!-- /.modal -->		     
			</div>
			<!-- /.example-modal -->
		</div>
		<!-- /.col-md-12 -->



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








		