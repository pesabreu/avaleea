
<?php
	//print_r(TABLE_SYSTEM);
	$this->session->set_userdata("origem", "0");
?>
    
<!-- Menu -->
		<section id="first_line" class="" style="margin-top: 0px;">
			

			<div class="row" style="margin-top: 10px;">				
				<div class="col-xs-12 col-md-12">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							<h3 class="panel-title">
								<span class="glyphicon glyphicon-folder-open"> &nbsp; </span>
								Business Tables								
							</h3>
						</div>
						<div class="panel-body">
							<div class="row linha-btn">
								<div class="col-xs-12 col-md-12">
									
								  <a href="<?= base_url('industry') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
									<span class="glyphicon glyphicon-home"></span> 
									<p> Industry </p>
									<div class="simbolo">
										<span> I </span>
									</div>
								  </a>

								  <a href="<?= base_url('modules') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
									<span class="glyphicon glyphicon-user"></span> 
									<p style="margin-left: -4px;"> Modules </p>
									<div class="simbolo">
										<span> M </span>
									</div>
								  </a>
								  
								  <a href="<?= base_url('questionnaries') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-modal-window"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.75em;">
										Questionnaries 
									</p>
									<div class="simbolo">
										<span> Q </span>
									</div>
								  </a>

								  <a href="<?= base_url('customize') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-modal-window"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.75em;">
										Customization 
									</p>
									<div class="simbolo">
										<span> Z </span>
									</div>
								  </a>

								  <a href="<?= base_url('imagesq') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-modal-window"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.75em;">
										Images
									</p>
									<div class="simbolo">
										<span> G </span>
									</div>
								  </a>
		
								  <a href="<?= base_url('questions') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-film"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.8em;">
										Questions 
									</p>
									<div class="simbolo">
										<span> U </span>
									</div>
								  </a>

								  <a href="<?= base_url('alternatives') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-film"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.8em;">
										Alternatives
									</p>
									<div class="simbolo">
										<span> A </span>
									</div>
								  </a>

								  <a href="<?= base_url('applicationq') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-film"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.8em;">
										Application 
									</p>
									<div class="simbolo">
										<span> P </span>
									</div>
								  </a>

								  <a href="<?= base_url('evaluation') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-film"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.8em;">
										Evaluation 
									</p>
									<div class="simbolo">
										<span> E </span>
									</div>
								  </a>

								  <a href="<?= base_url('answers') ?>" class="btn btn-success btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
								  	<span class="glyphicon glyphicon-film"></span> 
									<p style="margin-top: 3px; margin-left: -8px; margin-bottom: 15px; font-size: 0.8em;">
										Answers 
									</p>
									<div class="simbolo">
										<span> W </span>
									</div>
								  </a>

								</div>
							</div>
						</div>
					</div>

				</div>				
			</div>


			<div class="row">				
				<div class="col-xs-12 col-md-12">

					<div class="panel panel-default text-center">
						<div class="panel-heading">
							<h3 class="panel-title" id="icon_people" name="icon_people">
								<span class="glyphicon glyphicon-picture"> &nbsp; </span>
								Registration Tables							
							</h3>
						</div>
						<div class="panel-body">
							<div class="row linha-btn">
								<div class="col-xs-12 col-md-12">
								  
								  <a href="<?= base_url('people') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="People table">
									<span class="glyphicon glyphicon-user"></span> 
									<p> People </p>
									<div class="simbolo">
										<span> P </span>
									</div>
								  </a>
<!--								  
								  <a href="<?= base_url('web_contact') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="People table">
									<span class="glyphicon glyphicon-user"></span> 
									<p> Web Contact </p>
									<div class="simbolo">
										<span> W </span>
									</div>
								  </a>
								  
								  <a href="<?= base_url('addresses') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="People table">
									<span class="glyphicon glyphicon-user"></span> 
									<p> Addresses </p>
									<div class="simbolo">
										<span> A </span>
									</div>
								  </a>
								  
								  <a href="<?= base_url('phones') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="People table">
									<span class="glyphicon glyphicon-user"></span> 
									<p> Phones </p>
									<div class="simbolo">
										<span> F </span>
									</div>
								  </a>
-->								  
								  <a href="<?= base_url('users') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="Users table">
									<span class="glyphicon glyphicon-user"></span> 
									<p> Users </p>
									<div class="simbolo">
										<span> U </span>
									</div>
								  </a>
							  
								  <a href="<?= base_url('userlevel') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="User Level table">
								  	<span class="glyphicon glyphicon-align-center"></span> 
									<p> User Level </p>
									<div class="simbolo">
										<span> L </span>
									</div>
								  </a>
								  
								  <a href="<?= base_url('setup') ?>" class="btn btn-info btn-lg btn-alto" role="button" data-toggle="tooltip" data-placement="right" title="">
									<span class="glyphicon glyphicon-globe"></span> 
									<p style="margin-left: -5px;">Global Setup</p>
									<div class="simbolo">
										<span> G </span>
									</div>
								  </a>
								</div>
							</div>
						</div>
					</div>

				</div>				
			</div>
			<div class="row" style="margin-top: 10px;">				
				<div class="col-xs-12 col-md-12">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							<h3 class="panel-title">
								<span class="glyphicon glyphicon-blackboard"> &nbsp; </span>
								System Support Tables							
							</h3>
						</div>
						<div class="panel-body">
							<div class="row linha-btn">
								
								<div class="col-xs-12 col-md-12">
									<?php foreach( TABLE_SYSTEM as $key => $name ) : ?>
									  <a href="<?= base_url('Tabsys/index/tb'. $key .'/'.$key.'/m') ?>" 
									  			class="btn btn-warning btn-lg btn-alto linha-system" 
									  			role="button" data-toggle="tooltip" data-placement="right" >
									  	<span class="glyphicon glyphicon-calendar"></span> 
										<p> <?= $name ?> </p>
										<div class="simbolo">
											<span> <?= table_letter($key) ?> </span>
										</div>
									  </a>
									<?php endforeach; ?>
								</div>
				
							</div>
						</div>
					</div>
				</div>				
			</div>

		</section>
		
		<script type="text/javascript">        
		    $(function() {   
		    	$('#icon_people').focus();
		    });
		</script>
    
