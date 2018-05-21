

<style>
	.centered-form{
		margin-top: 60px;
	}
	
	.centered-form .panel{
		background: rgba(255, 255, 255, 0.8);
		box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
	}	
</style>

			
			<!-- Modal Sign up information -->
			<div class="modal fade" id="modal_signin_save" name="modal_signin_save" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
						style="margin-top: -200px;">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Sign in & Save</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	<span style="color: #002BFF; font-weight: 600;">
			        To save the questions like Test or Questionnaire it is necessary to have a registered 
			        user, click on the Login button and inform user and password, if you do not have 
			        registration click on the Registration button, just enter a valid email and create a 
			        password.
			        </span>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_signin">Sign in</button>
			        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_signup">Sign up</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			

			
			<!-- Modal Login information -->
			<div class="modal fade" id="modal_signin" name="modal_signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
							style="margin-top: -100px;">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header bg-primary">
			        <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 800;">Avaleea Test Maker</span></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">

					<div class="card">
						<article class="card-body">
							<h4 class="card-title text-center mb-4 mt-1">
								<span style="font-weight: 800;">Login</span>
							</h4>
							<hr>
							<p id="error_login" name="error_login" class="text-danger text-center"></p>
							
							<form role="form" id="form_signin" name="form_signin">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
								    		<span class="input-group-text"> 
								    			<i class="fa fa-at" style="font-weight: 600; font-size: 1.5em;"></i> 
							    			</span>
								 		</div>
										<input id="email_login" name="email_login" class="form-control" placeholder="Email" type="email">
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
							
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
								    		<span class="input-group-text"> 
								    			<i class="fa fa-lock" style="font-weight: 600; font-size: 1.5em;"></i> 
							    			</span>
								 		</div>
							    		<input id="password_login" name="password_login" class="form-control" placeholder="******" type="password">
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
							
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block"> 
										Login  
									</button>
								</div> <!-- form-group// -->
								<p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
							</form>
						</article>
					</div> <!-- card.// -->


			      </div>
			    </div>
			  </div>
			</div>
	

			
			<!-- Modal Sign up Registration -->
			<div class="modal fade" id="modal_signup" name="modal_signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
						style="margin-top: -200px;">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Sign Up</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

	    		  <form role="form" id="form_signup" name="form_signup">

			      	  <div class="modal-body" style="background-color: #B0E2FF;">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" required>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="" required>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required>
			    					</div>
			    				</div>
			    			</div>
			    			<p class="text-center" id="wrong_signup" name="wrong_signup" style="display: none; color: red; font-weight: bolder;"></p>			    			
			    			<!-- <input type="submit" value="Register" class="btn btn-primary btn-block"> -->
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-primary" id="save_signup" name="save_signup">Sign up</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				      </div>
			    		
  	    		  </form>
			    </div>
			  </div>
			</div>
			


			<!-- Modal Actions Tests -->
			<div class="modal fade in" id="actions-tests" name="actions-tests" tabindex="-1" role="dialog" aria-labelledby="title_test_actions" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="title_test_actions">Test actions</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	
			      	<div class="row my-3 px-3">
			      		<div class="col-12 px-3 text-center">
					        <button type="button" class="btn btn-info">Preview</button>
					        <button type="button" class="btn btn-primary">Edit</button>
					        <button type="button" class="btn btn-danger">Delete</button>
			      		</div>
			      	</div>
					<hr />		
			      	<div class="row my-3 px-5">		      					      		
			      		<div class="col-12 px-3 text-center">
					        <button type="button" class="btn btn-info btn-sm">Send by Email</button>
					        <button type="button" class="btn btn-info btn-sm">Download File</button>
					        <button type="button" class="btn btn-primary btn-sm">Sigin & Save tests</button>			      			
			      		</div>			      					      		
			      	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			






			<div class="modal fade in" id="formModalOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <h3>Modal body text goes here.</h3>
        
      	
	                    <form class="form-horizontal" role="form" id="form_options" name="form_options" onsubmit="" />
		
			            	<div class="form-group">
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionMO" value="1"> Multiple Options
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionTF" value="2"> True and False
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionFG" value="3"> Fill in the Gaps
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionRT" value="4"> Reply Text
								</label>
  						  	</div>
        				</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary">Save changes</button>
			      </div>
			    </div>
			  </div>
			</div>


			
			<!-- Modal Preview  -->
			<div class="modal fade bd-example-modal-lg" id="div-preview-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body bg-info" id="preview-question" name="preview-question">			        
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>


			
			<!-- Modal Login and Save -->
			<div class="modal fade" id="modal_signin_save_name" name="modal_signin_save_name" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
							style="margin-top: 1px;">
			  <div class="modal-dialog modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header bg-primary">
			        <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-weight: 800;">Avaleea Test Maker</span></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">

					<div class="card">
						<article class="card-body">
							<h4 class="card-title text-center mb-4 mt-1">
								<span style="font-weight: 800;">Login & Save Data</span>
							</h4>
							<hr>
							<p id="error_login_save" name="error_login_save" class="text-danger text-center"></p>
							
							<form role="form" id="form_signin_save" name="form_signin_save">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
								    		<span class="input-group-text"> 
								    			<i class="fa fa-at" style="font-weight: 600; font-size: 1.5em;"></i> 
							    			</span>
								 		</div>
										<input id="email_signin_save" name="email_signin_save" class="form-control" placeholder="Email" type="email">
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
							
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
								    		<span class="input-group-text"> 
								    			<i class="fa fa-lock" style="font-weight: 600; font-size: 1.5em;"></i> 
							    			</span>
								 		</div>
							    		<input id="password_signin_save" name="password_signin_save" class="form-control" placeholder="******" type="password">
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->
							
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
								    		<span class="input-group-text"> 
								    			<i class="fa fa-info" style="font-weight: 600; font-size: 1.6em;"></i>
							    			</span>
								 		</div>
			      							<input type="text" id="name_signin_save" name="name_signin_save" class="form-control" placeholder="Name Test" value="" />
									</div> <!-- input-group.// -->
								</div> <!-- form-group// -->

								<div class="form-group mt-4">
									<button type="submit" class="btn btn-primary btn-block"> 
										Login & Save 
									</button>
								</div> <!-- form-group// -->
								<p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
							</form>
						</article>
					</div> <!-- card.// -->
			      </div>
			    </div>
			  </div>
			</div>
	

			
			<!-- Modal Name Test -->
			<div class="modal fade bd-example-modal-lg" id="div-name-test" name="div-name-test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Input Name Test</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body bg-info col" id="name-test" name="name-test">
			      	Name:&nbsp;<input type="text" id="name-questions-save" name="name-questions-save" style="width: 90%" value=""	/>
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-secondary" id="btn-save-name" name="btn-save-name">Save</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
