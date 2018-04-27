
<script type="text/javascript">

    var id_users = "<?php echo !empty($user->id_users) ? $user->id_users : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_user_level').focus();
        var id_user_level = '<?php echo (isset($user->id_user_level) ? $user->id_user_level : '')?>';            
        $('#list_user_level option[value="' + id_user_level + '"]').attr({ selected : "selected" });              

        $('#list_people').focus();
        var id_people = '<?php echo (isset($user->people) ? $user->people : '' )?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              
    })
 
    function valid(){
        var cont = 0;
        
        if (id_users == 0 ) {
            $("#form_user").find("input[type=email], input[type=password], input[type=text]").each( function() {
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
        
        var old_password = $('#old_password').val();        
        var new_password = $('#new_password').val();
        var new_password2 = $('#new_password2').val();
        
        if (old_password != '' ) {
            if ( new_password == '' || new_password2 == '') {
                $('#old_password').focus();            
                return false;
            }
        }        
        
        if (new_password != new_password2) {
            $("#msg_error").show();            
            $("#msg_error").html("Atenção !!!  As novas senhas digitadas estão diferentes....")            
            $('#new_password').val('');
            $('#new_password2').val('');
            $('#new_password').focus();
            
            return false;
        }                
        return true;
    }    
</script>

<?php
	$id_users = isset($user->id_users) ? $user->id_users : 0;

    $require = "";
    if ($id_users == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('users')?>">Users</a></li>
  
    <?php if ($id_users == 0): ?>
        <li class="active">New User</li>
    <?php else: ?>
        <li class="active">Edit User</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_users == 0) ? 'New' : 'Edit' ?> User</h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('users/save_user')?>" id="form_dd" onsubmit="return valid()" />		
		                				
                        <div class="form-group" >
		                    <label for="list_people" class="col-sm-2 control-label"> People </label>
		                    <div class="col-sm-10">
								
							<?php if ($id_users == 0) : ?>
		                        <select  selected="<?php echo isset($user->people) ? $user->people : '' ?>" class="form-control" id="list_people" name="list_people" 
		       									placeholder="Select the People" required >
		                            <option value="">Select the People</option>                        
		                        
		                            <?php foreach($list_people->result() as $people): ?>                        
		                                <option value="<?= $people->id_people; ?>"><?php echo $people->name; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
							<?php endif; ?>
							
							<?php if ($id_users != 0) : ?>									                        
			                    <input type="text" name="list_people" id="list_people" class="form-control" value="<?= $user->name ?>" readonly />		                        
							<?php endif; ?>		                        
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_user_level" class="col-sm-2 control-label">User Level</label>
		                    <div class="col-sm-10">
		                        <select  selected="<?php echo isset($user->id_user_level) ? $user->id_user_level : '' ?>" class="form-control" 
		                        				id="list_user_level" name="list_user_level" placeholder="Select the user level" required >
		                            <option value="">Select the User Level</option>                        
		                        
		                            <?php foreach($list_user_level->result() as $level): ?>                        
		                                <option value="<?= $level->id_user_level; ?>"><?php echo $level->description_user_level; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="login" class="col-sm-2 control-label">Login</label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="login" id="login" class="form-control" value="<?php echo !empty($user->login) ? $user->login : '' ?> " maxlength="8" required />
			                </div>
			                
			                <div class="col-sm-4">
		                	</div>
		                    
				            <?php if (!empty($user->id_users)): ?>
			                    <label for="old_password" class="col-sm-2 control-label">Old Password</label>
			                    <div class="col-sm-2">
			                        <input type="password" name="old_password" id="old_password" class="form-control" required />
			                        
			                        <?php $error = $this->session->flashdata("Error"); ?> 
			                                
			                        <?php if (!empty($error)) : ?>
			                            <?php echo $error ?>
			                        <?php endif; ?>
			                    </div>
				            <?php endif; ?>			            
			            </div>
			            
			            <div class="form-group">
			                <label for="new_password" class="col-sm-2 control-label">New Password </label>
			                <div class="col-sm-2">                    
			                    <input type="password" name="new_password" id="new_password" class="form-control" <?= $require ?> />
			                </div>
			                
			                <div class="col-sm-4">
		                	</div>
		                    
		                    <label for="new_password2" class="col-sm-2 control-label">Retype New Password </label>
		                    <div class="col-sm-2">                    
		                        <input type="password" name="new_password2" id="new_password2" class="form-control" <?= $require ?> />
		                    </div>
		                </div>
		                
                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea  id="note" name="note" class="form-control" rows="5"><?php echo isset($user->note) ? $user->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('users') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_users" name="id_users" value="<?= !empty($user->id_users) ? $user->id_users : '' ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	