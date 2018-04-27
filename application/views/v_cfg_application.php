
<?php
//	var_dump($cfg_application);
//	exit();
?>

<script type="text/javascript">

    var id_cfg_application = "<?php echo !empty($cfg_application->id_cfg_application) ? $cfg_application->id_cfg_application : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_individual_group').focus();
        var individual_group = '<?php echo (isset($cfg_application->individual_group) ? $cfg_application->individual_group : '')?>';            
        $('#list_individual_group option[value="' + individual_group + '"]').attr({ selected : "selected" });              

        //$('#list_confirm_id_pin').focus();
        var confirm_id_pin = '<?php echo (isset($cfg_application->confirm_id_pin) ? $cfg_application->confirm_id_pin : '' )?>';            
        $('#list_confirm_id_pin option[value="' + confirm_id_pin + '"]').attr({ selected : "selected" });              

        //$('#list_tolerance').focus();
        var tolerance = '<?php echo (isset($cfg_application->tolerance) ? $cfg_application->tolerance : '' )?>';            
        $('#list_tolerance option[value="' + tolerance + '"]').attr({ selected : "selected" });              

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_application').val() == '') {
            $('#dt_application').val(date_today());
        
        } else {
        	$('#dt_application').val(date_normal($('#dt_application').val()));
        }

        $('#dt_application').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_application == 0 ) {
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
	$id_cfg_application = isset($id_cfg_application) ? $id_cfg_application : 0;

    $require = "";
    if ($id_cfg_application == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('applicationq')?>">Application</a></li>
  
    <li class="active">Edit Setup Application</li>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"> Edit Setup Application </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('applicationq/save_cfg_application')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name_application" class="col-sm-2 control-label"> application </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name_application" id="name_application" class="form-control" 
 									value="<?php echo !empty($cfg_application->name_application) ? $cfg_application->name_application : '' ?>" readonly />
			                </div>
			            </div>
		                										
			            <div class="form-group">
                            <label for="dt_application" class="col-sm-2 control-label">Date application</label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($cfg_application->dt_application) ? $cfg_application->dt_application : '' ?>" class="form-control datepicker" id="dt_application" name="dt_application" placeholder="Date Application" />
                            </div>
			                
			                <div class="col-sm-4"> </div>

			                <label for="quantity_evaluated" class="col-sm-2 control-label"> Quantity Evaluated </label>
			                <div class="col-sm-2">                    			                	
			                    <input type="text" name="quantity_evaluated" id="quantity_evaluated" value="<?php echo !empty($cfg_application->quantity_evaluated) ? $cfg_application->quantity_evaluated : '' ?> " class="form-control" pattern="[0-9]+$" />
			                </div>
			            </div>
		                				
                        <div class="form-group" >
		                    <label for="list_individual_group" class="col-sm-2 control-label"> Individual Group </label>
		                    <div class="col-sm-2">
		                        <select  selected="<?php echo isset($cfg_application->individual_group) ? $cfg_application->individual_group : '' ?>" class="form-control" id="list_individual_group" name="list_individual_group" 
		       									placeholder=" Individual Group" required >
		                            <option value=""> Individual Group</option>                        		                                                
	                                <option value="0"> Individual </option>
	                                <option value="1"> Group </option>	                                 
		                        </select>
		                    </div>                    
			                
		                    <label for="list_confirm_id_pin" class="col-sm-2 control-label"> Confirm Id PIN </label>
		                    <div class="col-sm-2">
		                        <select  selected="<?php echo isset($cfg_application->confirm_id_pin) ? $cfg_application->confirm_id_pin : '' ?>" class="form-control" id="list_confirm_id_pin" name="list_confirm_id_pin" 
		       									placeholder="Select PIN" required >
		                            <option value="">Select PIN</option>                        		                                                
	                                <option value="0"> No </option>
	                                <option value="1"> Yes </option>	                                 
		                        </select>
		                    </div>                    

		                    <label for="list_tolerance" class="col-sm-2 control-label"> Tolerance </label>
		                    <div class="col-sm-2">
		                        <select  selected="<?php echo isset($cfg_application->tolerance) ? $cfg_application->tolerance : '' ?>" class="form-control" id="list_tolerance" name="list_tolerance" 
		       									placeholder="Select Tolerance" required >
		                            <option value="">Select Tolerance</option>                        		                                                
	                                <option value="0"> No </option>
	                                <option value="1"> Yes </option>	                                 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('applicationq') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_cfg_application" name="id_cfg_application" value="<?= !empty($id_cfg_application) ? $id_cfg_application : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>
   	