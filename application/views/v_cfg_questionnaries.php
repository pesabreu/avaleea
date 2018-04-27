
<?php
//	var_dump($cfg_questionnaries);
//	exit();
?>

<script type="text/javascript">

    var id_cfg_questionnaries = "<?php echo !empty($cfg_questionnaries->id_cfg_questionnaries) ? $cfg_questionnaries->id_cfg_questionnaries : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_who_customize').focus();
        var who_customize = '<?php echo (isset($cfg_questionnaries->who_customize) ? $cfg_questionnaries->who_customize : '' )?>';            
        $('#list_who_customize option[value="' + who_customize + '"]').attr({ selected : "selected" });              

        //$('#list_presentation_type').focus();
        var id_presentation_type = '<?php echo (isset($cfg_questionnaries->id_presentation_type) ? $cfg_questionnaries->id_presentation_type : '')?>';            
        $('#list_presentation_type option[value="' + id_presentation_type + '"]').attr({ selected : "selected" });              

        //$('#list_allows_interrupt').focus();
        var id_allows_interrupt = '<?php echo (isset($cfg_questionnaries->id_allows_interrupt) ? $cfg_questionnaries->id_allows_interrupt : '' )?>';            
        $('#list_allows_interrupt option[value="' + id_allows_interrupt + '"]').attr({ selected : "selected" });              

        //$('#list_allows_navigate').focus();
        var id_allows_navigate = '<?php echo (isset($cfg_questionnaries->id_allows_navigate) ? $cfg_questionnaries->id_allows_navigate : '' )?>';            
        $('#list_allows_navigate option[value="' + id_allows_navigate + '"]').attr({ selected : "selected" });              

        //$('#list_mandatory_answers').focus();
        var id_mandatory_answers = '<?php echo (isset($cfg_questionnaries->id_mandatory_answers) ? $cfg_questionnaries->id_mandatory_answers : '' )?>';            
        $('#list_mandatory_answers option[value="' + id_mandatory_answers + '"]').attr({ selected : "selected" });              

        //$('#list_flow_issues').focus();
        var id_flow_issues = '<?php echo (isset($cfg_questionnaries->id_flow_issues) ? $cfg_questionnaries->id_flow_issues : '' )?>';            
        $('#list_flow_issues option[value="' + id_flow_issues + '"]').attr({ selected : "selected" });              

        $('#list_who_customize').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_questionnaries == 0 ) {
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
	$id_cfg_questionnaries = isset($id_cfg_questionnaries) ? $id_cfg_questionnaries : 0;

    $require = "";
    if ($id_cfg_questionnaries == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('questionnaries')?>">Questionnaries</a></li>
  
    <li class="active">Edit Setup Questionnaries</li>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"> Edit Setup Questionnaries </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('questionnaries/save_cfg_questionnaries')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name_questionnaries" class="col-sm-2 control-label"> Questionnaries </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name_questionnaries" id="name_questionnaries" class="form-control" 
 									value="<?php echo !empty($cfg_questionnaries->name_questionnaries) ? $cfg_questionnaries->name_questionnaries : '' ?>" readonly />
			                </div>
			            </div>

                        <div class="form-group" >
		                    <label for="list_who_customize" class="col-sm-2 control-label"> Who Customize </label>
		                    <div class="col-sm-8">
		                        <select selected="<?php echo isset($cfg_questionnaries->who_customize) ? $cfg_questionnaries->who_customize : '' ?>" class="form-control" id="list_who_customize" name="list_who_customize" 
		       									placeholder="Select the Who Customize" required >
		                            <option value="">Select the Who Customize</option>                        		                                                
	                                <option value="01"> Default </option>
	                                <option value="02"> Author </option>
	                                <option value="03"> Cliente </option>	                                 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_presentation_type" class="col-sm-2 control-label"> Type Presentation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questionnaries->id_presentation_type) ? $cfg_questionnaries->id_presentation_type : '' ?>" class="form-control" 
		                        				id="list_presentation_type" name="list_presentation_type" placeholder="Select the Presentation Type" required >
		                            <option value="">Select the Presentation Type </option>                        
		                        
		                            <?php foreach($list_presentation_type->result() as $presentation): ?>                        
		                                <option value="<?= $presentation->id_presentation_type; ?>"><?= $presentation->code_presentation_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_allows_interrupt" class="col-sm-2 control-label"> Allows Interrupt </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questionnaries->id_allows_interrupt) ? $cfg_questionnaries->id_allows_interrupt : '' ?>" class="form-control" id="list_allows_interrupt" name="list_allows_interrupt" 
		       									placeholder="Select the Allows Interrupt" required >
		                            <option value="">Select the Allows Interrupt</option>                        		                                                
		                        
		                            <?php foreach($list_allows_interrupt->result() as $interrupt): ?>                        
		                                <option value="<?= $interrupt->id_allows_interrupt; ?>"><?= $interrupt->code_allows_interrupt; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_allows_navigate" class="col-sm-2 control-label"> Allows Navigate </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questionnaries->id_allows_navigate) ? $cfg_questionnaries->id_allows_navigate : '' ?>" class="form-control" 
		                        		id="list_alternatives_type" name="list_allows_navigate" placeholder="Select the Allows Navigate" required >		                            
                    				<option value="">Select the Allows Navigate </option>                        
		                        
		                            <?php foreach($list_allows_navigate->result() as $navigate): ?>                        
		                                <option value="<?= $navigate->id_allows_navigate; ?>"><?= $navigate->code_allows_navigate; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_mandatory_answers" class="col-sm-2 control-label"> Mandatory Answers </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questionnaries->id_mandatory_answers) ? $cfg_questionnaries->id_mandatory_answers : '' ?>" class="form-control" 
		                        				id="list_mandatory_answers" name="list_mandatory_answers" placeholder="Select the Mandatory Answers" required >
		                            <option value="">Select the Mandatory Answers </option>                        
		                        
		                            <?php foreach($list_mandatory_answers->result() as $mandatory): ?>                        
		                                <option value="<?= $mandatory->id_mandatory_answers; ?>"><?= $mandatory->code_mandatory_answers; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_flow_issues" class="col-sm-2 control-label"> Flow Issues </label>
		                    <div class="col-sm-6">
		                        <select selected="<?php echo isset($cfg_questionnaries->id_flow_issues) ? $cfg_questionnaries->id_flow_issues : '' ?>" class="form-control" 
		                        				id="list_flow_issues" name="list_flow_issues" placeholder="Select the Flow Issues" required >
		                            <option value="">Select the Flow Issues </option>                        
		                        
		                            <?php foreach($list_flow_issues->result() as $issues): ?>                        
		                                <option value="<?= $issues->id_flow_issues ?>"><?= $issues->code_flow_issues ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
						</div>
						
			            <div class="form-group">
			                <label for="time_duration" class="col-sm-2 control-label"> Time Duration </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="time_duration" id="time_duration" class="form-control" 
									value="<?php echo !empty($cfg_questionnaries->time_duration) ? $cfg_questionnaries->time_duration : '' ?>" pattern="[0-9]+$" />
			                </div>

			                <label for="quantity_issues" class="col-sm-2 control-label"> Quantity Issues </label>
			                <div class="col-sm-2">                    			                	
			                    <input type="text" name="quantity_issues" id="quantity_issues" value="<?php echo !empty($cfg_questionnaries->quantity_issues) ? $cfg_questionnaries->quantity_issues : '' ?> " class="form-control" pattern="[0-9]+$" />
			                </div>

			                <label for="form_market" class="col-sm-2 control-label"> Form Market </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="form_market" id="form_market" class="form-control" value="<?php echo !empty($cfg_questionnaries->form_market) ? $cfg_questionnaries->form_market : '' ?> " />
			                </div>
			            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('questionnaries') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_cfg_questionnaries" name="id_cfg_questionnaries" value="<?= !empty($id_cfg_questionnaries) ? $id_cfg_questionnaries : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>
   	