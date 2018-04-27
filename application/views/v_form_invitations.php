
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_invitations = "<?php echo !empty($invitations->id_invitations) ? $invitations->id_invitations : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_people_invited').focus();
        var id_people_invitation = '<?php echo (isset($invitations->id_people_invitation) ? $invitations->id_people_invitation : '' )?>';            
        $('#list_people_invited option[value="' + id_people_invitation + '"]').attr({ selected : "selected" });              

        //$('#list_application').focus();
        var id_application = '<?php echo (isset($invitations->id_application) ? $invitations->id_application : '' )?>';            
        $('#list_application option[value="' + id_application + '"]').attr({ selected : "selected" });              

        if ($('#dt_invitations').val() == '') {
            $('#dt_invitations').val(date_today());
        
        } else {
        	$('#dt_invitations').val(date_normal($('#dt_invitations').val()));
        }

        if ($('#dt_visited_link').val() == '') {
            $('#dt_visited_link').val(date_today());
        
        } else {
        	$('#dt_visited_link').val(date_normal($('#dt_visited_link').val()));
        }

		$('#list_application').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_invitations == 0 ) {
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
            return false;
        }                                
        return true;
    }    
</script>

<?php
	$id_invitations = isset($id_invitations) ? $id_invitations : 0;

    $require = "";
    if ($id_invitations == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('invitations')?>"> Invitations</a></li>
  
    <?php if ($id_invitations == 0): ?>
        <li class="active">New Invitation</li>
    <?php else: ?>
        <li class="active">Edit Invitation</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_invitations == 0) ? 'New' : 'Edit' ?> Invitations </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('invitations/save_invitations')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_application" class="col-sm-2 control-label"> Application </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($invitations->id_application) ? $invitations->id_application : '' ?>" class="form-control" 
		                        				id="list_application" name="list_application" placeholder="Select Application" required >
		                            <option value="">Select Invitation </option>                        
		                        
		                            <?php foreach($list_application->result() as $application): ?>                        
		                                <option value="<?= $application->id_application ; ?>">
		                                	<?php echo $application->name_application; ?>
                            			</option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_people_invited" class="col-sm-2 control-label"> People Invited </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($invitations->id_people_invitation) ? $invitations->id_people_invitation : '' ?>" class="form-control" 
		                        				id="list_people_invited" name="list_people_invited" placeholder="Select Invitation" required >
		                            <option value="">Select Invitation </option>                        
		                        
		                            <?php foreach($list_invited->result() as $invited): ?>                        
		                                <option value="<?= $invited->id_people ; ?>">
		                                	<?php echo $invited->name; ?>
                            			</option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group">
                            <label for="dt_invitations" class="col-sm-2 control-label">Date Invitations</label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($invitations->dt_invitations) ? $invitations->dt_invitations : '' ?>" class="form-control datepicker text-center" id="dt_invitations" name="dt_invitations" placeholder="Date Invitations" />
                            </div>

                            <label for="dt_visited_link" class="col-sm-offset-4 col-sm-2 control-label">Date Visited Link</label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($invitations->dt_visited_link) ? $people->dt_visited_link : '' ?>" class="form-control datepicker text-center" id="dt_visited_link" name="dt_visited_link" placeholder="Visited Link" />
                            </div>
                        </div>

                        <div class="form-group" >
							<label for="link_invitations" class="col-sm-2 control-label"> Link invitations </label>
                            <div class="col-sm-10">
                                <input type="url" value="<?php echo isset($invitations->link_invitations) ? $invitations->link_invitations : '' ?>" class="form-control" id="link_invitations" name="link_invitations" placeholder="Link invitations" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($invitations->note) ? $invitations->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('invitations') ?>" class="btn btn-primary"> Return </a> 
                            	</span>                            	                                          	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_invitations" name="id_invitations" value="<?= !empty($id_invitations) ? $id_invitations : 0 ?>" />                                                             
		                <input type="hidden" id="id_people_admin" name="id_people_admin" value="<?= !empty($invitations->id_people_admin) ? $invitations->id_people_admin : 0 ?>" />
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	