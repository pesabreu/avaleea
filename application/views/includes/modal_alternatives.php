

<?php
//sleep(1);	
?>

<script type="text/javascript">
	$('#edit_alternatives').hide();	

	function store_alternatives(parm=0) {
		$('#id_alternatives').val(0);
		
  		$(document).ready(function(){
  			$('#selectAlternatives').change(function(){
  				$('#edit_alternatives').show();          
				var id = $('#selectAlternatives option:selected').val();			
				$('#id_alternatives').val(id);  
  			});
  		});				
		return true;
	}
</script>


<!--  Select and edit alternatives   -->

				  <div class="example-modal" id="form_alternatives">			     
					<div class="modal modal-default" id="formModalAlternatives">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
			              
						  <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center">Alternatives Update</h3>
			              </div>
			              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border">
					          </div>
							
					          <div class="box-body" style="height: auto;">	
              	
			                    <form class="form-horizontal" role="form" id="form_dd_alternatives" name="form_dd_alternatives" onsubmit="return valid_alternatives()" />
				
					              <div class="form-group">
			      					<label for="title_questionnaries_a" class="col-sm-2 control-label">Questionnaire</label>
			      					<div class="col-sm-10">
			        				  <input type="text" class="form-control" id="title_questionnaries_a" name="title_questionnaries_a" 
			        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly />
			      					</div>	
			    				  </div>
				
					              <div class="form-group">
			      					<label for="title_questions_a" class="col-sm-2 control-label">Question</label>
			      					<div class="col-sm-10">
			        				  <input type="text" class="form-control" id="title_questions_a" name="title_questions_a" 
			        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly />
			      					</div>	
			    				  </div>

								  <div class="form-group">
                					<label for="selectAlternatives" class="col-sm-2 control-label">Alternatives</label>
                					<div class="col-sm-10" id="select_alternative" name="select_alternative">
									</div>              	
          						  </div>
              									
								  <div class="form-group" style="margin-top: 20px; padding: 5px 20px;">
			   		                  <button id="new_alternatives" name="new_alternatives" type="button" class="btn btn-success pull-right" 
			   		                  			data-backdrop="static" data-toggle="modal" data-target="#formModalAlternatives_edit">
			   		                  	New
		   		                  	  </button>
				                	  <button id="edit_alternatives" name="edit_alternatives" type="button" class="btn btn-info pull-left" style="margin-left: 90px;" 
				                	  			data-backdrop="static" data-toggle="modal" data-target="#formModalAlternatives_edit">
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




<!-- Alternatives Forms Client  -->
			
				<div class="col-md-12">

				  <div class="example-modal" id="form_alternatives_edit">			     
					<div class="modal modal-default" id="formModalAlternatives_edit">			          
					  <div class="modal-dialog">			            
						<div class="modal-content bg-teal">
							<?php	
								//$alternatives = $this->session->userdata("alternatives");
								$id_alternatives = $this->session->userdata("id_alternatives");
								$id_questions = $this->session->userdata("id_questions");
							?>	
										  				              
						  <div class="modal-header">
			                <button type="button" id="btn_close_xq" name="btn_close_xq" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">X</span></button>
			                <h3 class="modal-title text-center" id="oper_alternatives" name="oper_alternatives"></h3>
			              </div>
		              
						  <div class="modal-body" style="color: black;">										                
							<div class="box">						        						
							  <div class="box-header with-border"></div>
					
					          <div class="box-body" style="height: auto;">	

							    <form class="form-horizontal" role="form" method="post" id="form_dd_alternative" name="form_dd_alternative"
							            onsubmit="return valid_alternatives();" />
									  
								<div class="col-md-12">
								  <div class="nav-tabs-custom">
						            <ul class="nav nav-tabs">
						              <li class="active"><a href="#tab_1a" id="tab1a" name="tab1a" data-toggle="tab">Alternatives</a></li>
						         <!--     <li><a href="#tab_2a" id="tab2a" name="tab2a" data-toggle="tab">Setup</a></li>  -->
						              <li><a href="#tab_3a" id="tab3a" name="tab3a" data-toggle="tab">Status</a></li>
						            </ul>
						            <div class="tab-content">
						
						              <div class="tab-pane active" id="tab_1a" name="tab_1a">		<!-- tab 1 - Question -->            											
				
							              <div class="form-group">
					      					<label for="title_questionnariesa" class="col-sm-2 control-label"> Questionnaire </label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="title_questionnariesa" name="title_questionnariesa" 
					        				  				value="<?= $this->session->userdata("title_questionnaries") ?>" readonly style="margin-right: 5px;" />
					      					</div>	
					    				  </div>
				
							              <div class="form-group">
					      					<label for="title_questionsa" class="col-sm-2 control-label"> Question </label>
					      					<div class="col-sm-10">
					        				  <input type="text" class="form-control" id="title_questionsa" name="title_questionsa" 
					        				  		value="<?php echo str_pad($this->session->userdata('id_questions'), 5, '0', STR_PAD_LEFT) .' - '.
					        				  						$this->session->userdata('title_questions') ?>" readonly style="margin-right: 5px;" />
					      					</div>	
					    				  </div>

							              <div class="form-group">
						  					<label for="id_order_questions" class="col-sm-2 control-label">Order in Question</label>
						  					<div class="col-sm-2">
						    				  <input type="number'" class="form-control" id="id_order_questions" name="id_order_questions" placeholder="Order" 
						    				  			value="" />
						  					</div>	
										  </div>

										  <div class="form-group">												
											<label for="selectRightwrong" class="col-sm-2 control-label">Right Wrong</label>
											<div class="col-sm-4">
						    				  <select class="form-control" id="selectRightwrong" name="selectRightwrong" onchange="">
						    				  	<option selected="selected" value="">Right Wrong</option>
					                            <option value="0">Wrong</option>
					                            <option value="1">Right</option>						                        
						    				  </select>
											</div>						              	
										  </div>
										  
							              <div class="form-group">
						  					<label for="description_alternatives" class="col-sm-2 control-label">Description</label>
						  					<div class="col-sm-10">
						    				  <input type="text" class="form-control" id="description_alternatives" name="description_alternatives" placeholder="Description" 
						    				  			value="" />
						  					</div>	
										  </div>
					
					                      <div class="form-group">
					                        <label for="text_alternatives" class="col-sm-2 control-label">Text</label>
					                        <div class="col-sm-10">
					                            <textarea id="text_alternatives" name="text_alternatives" class="form-control" placeholder="Text" rows="5">					                            	 
					                           	</textarea>
					                        </div>
					                      </div>
						
										<div class="form-group"> 
											<label for="selectSituationa" class="col-sm-2 control-label">Situation</label>
											<div class="col-sm-5">
						    				  <select class="form-control" id="selectSituationa" name="selectSituationa" onchange="" readonly>
						    				  	<option value="">Select Situation</option>
						                        <?php foreach($list_situation->result() as $situation): ?>                        
						                            <option value="<?= $situation->id_situation; ?>" <?= ($situation->id_situation == 2) ? 'selected="selected"' : '' ?>>
						                            	<?= $situation->code_situation; ?>
						                            </option>
						                        <?php endforeach; ?> 
						    				  </select>
											</div>
										
										  	<input type="hidden" id="id_alternatives" name="id_alternatives" value="<?= $id_alternatives?>" />																																
										  	<input type="hidden" id="id_questionsa" name="id_questionsa" value="<?= $id_questions?>" />																																
										
						              	</div>
						              	<!-- /.tab-pane 1 -->
						             
						              </div>	
						             
						<!--              <div class="tab-pane" id="tab_2a" name="tab_2a">		<!-- tab 2 - Setup -->
						 <!--        </div>  -->
						              <!-- tab-pane 2 -->
						             
						              <div class="tab-pane text-center" id="tab_3a" name="tab_3a" style="padding: 20px;">		<!-- tab 3 - Alternatives -->						                
						              	<h4 style="color: red;"> Save the Alternative to get your status updated</h4>
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

