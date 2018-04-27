<?php

	$TABLE_REGISTRATION = array('people' => 'People', 'users' => 'Users', 
							'userlevel' => 'User Level', 'setup' => 'Global Setup'
						  );	

	$TABLE_SYSTEM = array('academic_area' => 'Academic Area', 'disciplines' => 'Disciplines', 
							'situation' => 'Situation',	'application_mode' => 'Application Mode', 
							'application_type' => 'Application Type', 'presentation_type' => 'Presentation Type', 
							'questionnaries_type' => 'Questionnaries Type', 'alternatives_type' => 'Alternatives Type', 
							'level_type' => 'Level Type', 'grade_type' => 'Grade Type', 
							'occupation_area' => 'Occupation Area', 'categories' => 'Categories',
							'allows_interrupt' => 'Allows Interrupt', 'allows_navigate' => 'Allows Navigate',
							'mandatory_answers' => 'Mandatory Answers', 'flow_issues' => 'Flow Issues',
							'acquisition_type' => 'Acquisition Type'
						  );	
	

	$TABLE_BUSINESS = array('industry' => 'Industry', 'modules' => 'Modules', 
							'questionnaries' => 'Questionnaries', 'customization' => 'Customization', 
							'images' => 'Images', 'questions' => 'Questions', 
							'alternatives' => 'Alternatives', 'applicationq' => 'Application', 
							'evaluation' => 'Evaluation', 'answers' => 'Answers',
							'invitations' => 'Invitations' 
						  );	

//	$date = date('Y-m-d H:i');

	$id_people_admin = $this->session->userdata("id_people_admin");
	$name_admin = $this->session->userdata("name_user");                   
?>


<script type="text/javascript">

	function store_author(parm=0) {
		var id = document.getElementById("selectAuthors").value;			
		document.getElementById('id_people_invitation').value = id;
		
		var id_admin = <?= $id_people_admin ?>;
		document.getElementById('id_people_admin').value = id_admin;
		return true;
	}

	function store_candidate(parm=0) {
		var id = document.getElementById("selectCandidates").value;			
		document.getElementById('id_people_invitation').value = id;
		
		var id_admin = <?= $id_people_admin ?>;
		document.getElementById('id_people_admin').value = id_admin;
		return true;
	}

	function store_questionnaries(parm=0) {
		var id = document.getElementById("selectQuestionnaries").value;			
		document.getElementById('id_questionnaries').value = id;

		return true;
	}

	function valid() {
			return true;
	}	
</script>


<!--  Window with Registration Tables Menu -->

				  <div class="example-modal" id="menu_tables_registration">			     
					<div class="modal modal-primary" id="menuModalRegistration">			          
					  <div class="modal-dialog">			            
						<div class="modal-content">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">×</span></button>
			                <h4 class="modal-title text-center">Registration Tables</h4>
			              </div>
			              
						  <div class="modal-body">										                
							<div class="box">						        						
							  <div class="box-header with-border">					            					
					            <div class="box-tools pull-right">
					              <button type="button" class="btn btn-box-tool" data-dismiss="modal" data-toggle="tooltip" title="Close">
					                <i class="fa fa-times"></i>
					              </button>
					          	</div>					        
					          </div>
					
					          <div class="box-body">					          
								<?php foreach( TABLE_REGISTRATION as $key => $name ) : ?>
					            	<div class="col-md-3">
						            	<a href="<?= base_url($key) ?>" class="btn btn-app margin"
						            				 style="background-color: #00c0ef; color: #fff;">
				  							<i class="<?= icons_registration($key) ?>"></i> <?= $name ?> 
										</a>
									</div>
								<?php endforeach; ?>					        
					          </div>
						      <!-- /.box-body -->
						      
							  <div class="box-footer">
						      </div>
						      <!-- /.box-footer -->						    
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			              </div>
			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        
					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->



<!--  Window with Business Tables Menu -->

				  <div class="example-modal" id="menu_tables_business">			     
					<div class="modal modal-primary" id="menuModalBusiness">			          
					  <div class="modal-dialog">			            
						<div class="modal-content">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">×</span></button>
			                <h4 class="modal-title text-center">Business Tables</h4>
			              </div>
			              
						  <div class="modal-body">										                
							<div class="box">						        						
							  <div class="box-header with-border">					            					
					            <div class="box-tools pull-right">
					              <button type="button" class="btn btn-box-tool" data-dismiss="modal" data-toggle="tooltip" title="Close">
					                <i class="fa fa-times"></i>
					              </button>
					          	</div>					        
					          </div>
					
					          <div class="box-body">					          
								<?php foreach( TABLE_BUSINESS as $key => $name ) : ?>
					            	<div class="col-md-3">
						            	<a href="<?= base_url($key) ?>" class="btn btn-app margin bg-green"
						            				 style="">
				  							<i class="<?= icons_business($key) ?>"></i> <?= $name ?> 
										</a>
									</div>
								<?php endforeach; ?>					        
					          </div>
						      <!-- /.box-body -->
						      
							  <div class="box-footer">
						      </div>
						      <!-- /.box-footer -->						    
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			              </div>
			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        
					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->



<!--  Window with System Support Tables Menu -->
			
				  <div class="example-modal" id="menu_tables_system">			     
					<div class="modal modal-primary" id="menuModalSystem">			          
					  <div class="modal-dialog">			            
						<div class="modal-content">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">×</span></button>
			                <h4 class="modal-title text-center">System Support Tables</h4>
			              </div>
			              
						  <div class="modal-body" style="color: #c0c0c0;">										                
							<div class="box" style="color: #c0c0c0;">						        						
							  <div class="box-header with-border">					            					
					            <div class="box-tools pull-right">
					              <button type="button" class="btn btn-box-tool" data-dismiss="modal" data-toggle="tooltip" title="Close">
					                <i class="fa fa-times"></i>
					              </button>
					          	</div>					        
					          </div>
					
					          <div class="box-body">					          
								<?php foreach( TABLE_SYSTEM as $key => $name ) : ?>
					            	<div class="col-md-3">
						            	<a href="<?= base_url('tabsys/index/tb'. $key .'/'.$key.'/m') ?>" class="btn btn-app margin"
						            				 style="background-color: #f39c12; color: #fff;">
				  							<i class="ion ion-clipboard"></i> <?= $name ?>
										</a>
									</div>
								<?php endforeach; ?>					        
					          </div>
						      <!-- /.box-body -->
						      
							  <div class="box-footer">
						      </div>
						      <!-- /.box-footer -->						    
							
						  	</div>
							<!-- /.box -->			                
			              </div>
			              
						  <div class="modal-footer">
			                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			              </div>
			            
						</div>
			            <!-- /.modal-content -->		          
					  </div>
			          <!-- /.modal-dialog -->		        

					</div>
			        <!-- /.modal -->		     
				 </div>
				 <!-- /.example-modal -->




<!-- Email Form Window with Invitation to Authors -->

				  <div class="example-modal" id="form_invitation_email">			     
					<div class="modal modal-default" id="formModalInvitationEmail">			          
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
              	
			                    <form class="form-horizontal" role="form" method="post" id="form_dd"
			                    				action="<?=base_url('invitations/sender_email_invitation/1')?>" onsubmit="return valid()" />

								  <div class="form-group">
                					<label for="selectAuthors" class="col-sm-2 control-label">Author</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" id="selectAuthors" onchange="return store_author(1);" required>
	                				  	<option selected="selected" value="">Select Invitation</option>
			                            <?php foreach($authors->result() as $author): ?>                        
			                                <option value="<?= $author->id.';'.trim($author->name).';'.trim($author->email_1) ; ?>">
			                                	<?= $author->name; ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
	                				  <div class="alert alert-danger" id="msg_invitation" name="msg_invitation" style="display: none;"></div>
									</div>              	
          						  </div>
              	
                				  <div class="form-group">                	
                  					<label for="inputDate" class="col-sm-2 control-label">Send date</label>
                  					<div class="col-sm-4">
					  				  <input type="text" class="form-control" id="inputDate" value="<?= date('Y-m-d H:i') ?>" readonly />
                  					</div>
                				  </div>

					              <div class="form-group">
                  					<label for="inputUrl" class="col-sm-2 control-label">Guest Link</label>
                  					<div class="col-sm-10">
                    				  <input type="url" class="form-control" id="inputUrl" name="inputUrl" placeholder="Guest Link" 
                    				  				value="<?= base_url('invitations/guest_link_visit/1')?>" readonly />
                  					</div>	
                				  </div>

		                   	      <input type="hidden" id="id_people_invitation" name="id_people_invitation" />
		                   	      <input type="hidden" id="id_people_admin" name="id_people_admin" />		                   	                      				  

					              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
				                	  <button type="submit" class="btn btn-success pull-left">Send</button>
								  </div>	

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





<!--  Email Form Window with Invitation to Candidates  -->

				  <div class="example-modal" id="form_invitation_email">			     
					<div class="modal modal-default" id="formModalInvitationCandidate">			          
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
              	
			                    <form class="form-horizontal" role="form" method="post" id="form_dd"
			                    				action="<?=base_url('invitations/sender_email_invitation/2')?>" onsubmit="return valid()" />

								  <div class="form-group">
                					<label for="selectQuestionnaries" class="col-sm-2 control-label">Questionnaries</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" id="selectQuestionnaries" name="selectQuestionnaries" onchange="return store_questionnaries(1);" required>
	                				  	<option selected="selected" value="">Select Questionnaries</option>
			                            <?php foreach($questionnaries->result() as $questionnarie): ?>                        
			                                <option value="<?= $questionnarie->id_questionnaries; ?>">
			                                	<?= trim($questionnarie->name_questionnaries); ?>
			                                </option>
			                            <?php endforeach; ?> 
	                				  </select>
									</div>              	
          						  </div>
              	
								  <div class="form-group">
                					<label for="selectCandidates" class="col-sm-2 control-label">Candidate</label>
                					<div class="col-sm-10">
	                				  <select class="form-control" id="selectCandidates" name="selectCandidates" onchange="return store_candidate(1);" required>
	                				  	<option selected="selected" value="">Select Candidate</option>
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
                    				  				value="<?= base_url('invitations/invitations_link_visit/2')?>" readonly />
                  					</div>	
                				  </div>

		                   	      <input type="hidden" id="id_people_invitation" name="id_people_invitation" />
		                   	      <input type="hidden" id="id_people_admin" name="id_people_admin" />		                   	                      				  
		                   	      <input type="hidden" id="id_questionnaries" name="id_questionnaries" />

					              <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button type="button" class="btn btn-warning pull-right" data-dismiss="modal">Close</button>
				                	  <button type="submit" class="btn btn-success pull-left">Send</button>
								  </div>	

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





