



      <div class="row" style="margin-top: 20px; height: 100%;">

        <div class="col-md-offset-2 col-md-8">
          <div class="box box-solid box-default">
          	
            <div class="box-header with-border bg-teal">
              <h3 class="box-title">Application Questionnaries &nbsp;-&nbsp; <?= ucfirst($this->session->userdata("name_user")); ?> </h3>
            </div>

            <div class="box-body bg-info">		<!-- /.box-header -->
            	<div class="text-center" style="margin-top: -20px;">
            		<h2> <?= ucfirst(trim($questionnaries->name_questionnaries)) ?> </h2>            		
            	</div>
          <form class="form-horizontal" role="form" method="post" action="<?=base_url('invitations/save_guest_application')?>" id="form_dd" onsubmit="return valid()" /> 
           <!--  <form>     -->       	
            	<div>
            		<?php 
            			$questions_old = 0;
						$initial = 1;
						$quest = $questions->result_array(); 
            		?>

            		<?php foreach ($quest as $question) : ?> 
            		
            			<?php             			            		
		            		$break = 0;	
            				if ($questions_old == 0 || $questions_old != $question['id_questions']) {								 
            					$questions_old = $question['id_questions'];
								$break = 1;
								
            					$order = str_pad($question['order_questionnaries'], 2, "0", STR_PAD_LEFT);            					
        				 		$enunciado = ucfirst($question['enunciation']);
  	    					}
        					
        					if ($questions_old == $question['id_questions']) {        						
            					$order_alt = str_pad($question['id_order_questions'], 2, "0", STR_PAD_LEFT);            					
        				 		$enunciado_alt = ucfirst($question['description_alternatives']);			
								$order = str_pad($question['order_questionnaries'], 2, "0", STR_PAD_LEFT);					
        					}
            			?>            			
												
						<?php if ($break == 1) : ?>
							<div class="text-center" style="text-align: justify; margin-left: 50px;">
								<?php if ($initial == 0) : ?>
									</div>
									<div class="form-group">
									<?php $name_option = 'check_'.$questions_old; ?>	
									<br />
									
								<?php else : ?>
									<?php $initial = 0 ?>
									<div class="form-group">
									<?php $name_option = 'check_'.$questions_old; ?>										
								<?php endif ; ?>
								
								<?= $order ?> &nbsp;-&nbsp;<b> <?= $enunciado ?> </b>
								<br />
							</div>
						<?php endif; ?>	
							
						<div class="radio text-center" style="text-align: justify; margin-left: 70px;"
										<?= ($order_alt == 1) ? 'required' : '' ?>>							 
							<input type="radio" name="<?= $name_option ?>" id="check_<?=$questions_old.$order_alt?>" value="<?= $questions_old.$order_alt ?>" <?= $enunciado_alt ?> >							
							&nbsp;&nbsp;(<?= $order_alt ?>) &nbsp; <?= $enunciado_alt ?>
							<br />
						</div>
						            			
        			<?php endforeach; ?>
        			<br />
                    <div class="form-group" style="margin-bottom: 10px; margin-left: -125px;">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" class="btn btn-success" id="subdata" name="subdata" style="margin-left: -20px;">
                            	Save
                        	</button>
                            <span style="margin-left: 350px; margin-right: -20px;"> 
                            	<a href="<?= base_url() ?>" class="btn btn-info"> Return </a> 
                        	</span>              
						</div>
	                </div>

            	</div>
            	
            	</form>
            								        			        	
	        </div>
	            
            <div class="box-footer bg-teal" style="margin-top: 40px;">
            </div>
            
          </div>          <!-- /.box -->
        </div>

      </div>      <!-- /.row -->


	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url() .'assets/'; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url() .'assets/'; ?>bootstrap/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<!--<script src="<?php echo base_url() .'assets/'; ?>plugins/fastclick/fastclick.js"></script>-->
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() .'assets/'; ?>dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!--<script src="<?php echo base_url() .'assets/'; ?>dist/js/demo.js"></script>-->
