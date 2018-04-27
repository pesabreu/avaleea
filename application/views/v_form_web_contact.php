
<script type="text/javascript">

    var id_web_contact = "<?php echo !empty($web_contact->id_web_contact) ? $web_contact->id_web_contact : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_people').focus();
        var id_people = '<?php echo (isset($web_contact->id_people) ? $web_contact->id_people : '')?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              
    })
 
    function valid(){
        var cont = 0;
        
        if (id_web_contact == 0 ) {
            $("#form_user").find("input[type=email], input[type=text]").each( function() {
              if ($(this).val() == "") {
                  $(this).parent().addClass('has-error');
                  cont++;
              }
            });            
        }   
             
        if (cont > 0) {
            $("#msg_error").show();        
            $("#msg_error").html("Attention ! Please complete all fields before continuing....")
            $('#nome_usuario').focus();
            return false;
        }                                
        return true;
    }    
</script>

<?php
	$id_web_contact = isset($id_web_contact) ? $id_web_contact : 0;
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('people')?>"> People</a></li>
    <li class="active">Edit Web Contact</li>
   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_web_contact == 0) ? 'New' : 'Edit' ?> Web Contact </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('people/save_web_contact')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name" id="name" class="form-control" 
 									value="<?php echo !empty($web_contact->name) ? $web_contact->name : '' ?>" readonly />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="email_1" class="col-sm-2 control-label"> Email 1 </label>
			                <div class="col-sm-10">                    
			                    <input type="email" name="email_1" id="email_1" class="form-control" value="<?php echo !empty($web_contact->email_1) ? $web_contact->email_1 : '' ?> " required />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="email_2" class="col-sm-2 control-label"> Email 2 </label>
			                <div class="col-sm-10">                    
			                    <input type="email" name="email_2" id="email_2" class="form-control" value="<?php echo !empty($web_contact->email_2) ? $web_contact->email_2 : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="email_3" class="col-sm-2 control-label"> Email 3 </label>
			                <div class="col-sm-10">                    
			                    <input type="email" name="email_3" id="email_3" class="form-control" value="<?php echo !empty($web_contact->email_3) ? $web_contact->email_3 : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="website" class="col-sm-2 control-label"> Website </label>
			                <div class="col-sm-10">                    
			                    <input type="url" name="website" id="website" class="form-control" value="<?php echo !empty($web_contact->website) ? $web_contact->website : '' ?> " />
			                </div>
						</div>

			            <div class="form-group">
			                <label for="facebook" class="col-sm-2 control-label"> Facebook </label>
			                <div class="col-sm-4">                    
			                    <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo !empty($web_contact->facebook) ? $web_contact->facebook : '' ?> " />
			                </div>

			                <label for="twitter" class="col-sm-2 control-label"> Twitter </label>
			                <div class="col-sm-4">                    
			                    <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo !empty($web_contact->twitter) ? $web_contact->twitter : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="instagram" class="col-sm-2 control-label"> Instagram </label>
			                <div class="col-sm-4">                    
			                    <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo !empty($web_contact->instagram) ? $web_contact->instagram : '' ?> " />
			                </div>

			                <label for="linkedin" class="col-sm-2 control-label"> Linkedin </label>
			                <div class="col-sm-4">                    
			                    <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?php echo !empty($web_contact->linkedin) ? $web_contact->linkedin : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="other_social_network_1" class="col-sm-2 control-label"> Other Social Network 1 </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="other_social_network_1" id="other_social_network_1" class="form-control" value="<?php echo !empty($web_contact->other_social_network_1) ? $web_contact->other_social_network_1 : '' ?> " />
			                </div>

			                <label for="url_other_sn_1" class="col-sm-2 control-label"> URL 1 </label>
			                <div class="col-sm-6">                    
			                    <input type="url" name="url_other_sn_1" id="url_other_sn_1" class="form-control" value="<?php echo !empty($web_contact->url_other_sn_1) ? $web_contact->url_other_sn_1 : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="other_social_network_2" class="col-sm-2 control-label"> Other Social Network 2 </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="other_social_network_2" id="other_social_network_2" class="form-control" value="<?php echo !empty($web_contact->other_social_network_2) ? $web_contact->other_social_network_2 : '' ?> " />
			                </div>

			                <label for="url_other_sn_2" class="col-sm-2 control-label"> URL 2 </label>
			                <div class="col-sm-6">                    
			                    <input type="url" name="url_other_sn_2" id="url_other_sn_2" class="form-control" value="<?php echo !empty($web_contact->url_other_sn_2) ? $web_contact->url_other_sn_2 : '' ?> " />
			                </div>
			            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('people') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_web_contact" name="id_web_contact" value="<?= !empty($id_web_contact) ? $id_web_contact : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	