
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_questionnaries = "<?php echo !empty($questionnaries->id_questionnaries) ? $questionnaries->id_questionnaries : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();
        
        if (id_questionnaries == 0) {
        	$("#btn-questions").hide();
        } else {
        	$("#btn-questions").show();
        }        

        //$('#list_modules').focus();
        var id_modules = '<?php echo (isset($questionnaries->id_modules) ? $questionnaries->id_modules : '')?>';            
        $('#list_modules option[value="' + id_modules + '"]').attr({ selected : "selected" });              

        //$('#list_questionnaries_type').focus();
        var id_questionnaries_type = '<?php echo (isset($questionnaries->id_questionnaries_type) ? $questionnaries->id_questionnaries_type : '' )?>';            
        $('#list_questionnaries_type option[value="' + id_questionnaries_type + '"]').attr({ selected : "selected" });              

        //$('#list_alternatives_type').focus();
        var id_alternatives_type = '<?php echo (isset($questionnaries->id_alternatives_type) ? $questionnaries->id_alternatives_type : '' )?>';            
        $('#list_alternatives_type option[value="' + id_alternatives_type + '"]').attr({ selected : "selected" });              

        //$('#list_level_type').focus();
        var id_level_type = '<?php echo (isset($questionnaries->id_level_type) ? $questionnaries->id_level_type : '' )?>';            
        $('#list_level_type option[value="' + id_level_type + '"]').attr({ selected : "selected" });              

        //$('#list_people').focus();
        var id_people = '<?php echo (isset($questionnaries->id_people) ? $questionnaries->id_people : '' )?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              

        //$('#list_situation').focus();
        var id_situation = '<?php echo (isset($questionnaries->id_situation) ? $questionnaries->id_situation : '' )?>';            
        $('#list_situation option[value="' + id_situation + '"]').attr({ selected : "selected" });

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_creation').val() == '') {
            $('#dt_creation').val(date_today());
        
        } else {
        	$('#dt_creation').val(date_normal($('#dt_creation').val()));
        }        

		$('#list_questionnaries_type').focus();                      
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
	$id_questionnaries = isset($id_questionnaries) ? $id_questionnaries : 0;

    $require = "";
    if ($id_questionnaries == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('questionnaries')?>">Questionnaries</a></li>
  
    <?php if ($id_questionnaries == 0): ?>
        <li class="active">New Questionnaries</li>
    <?php else: ?>
        <li class="active">Edit Questionnaries</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_questionnaries == 0) ? 'New' : 'Edit' ?> Questionnaries </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('questionnaries/save_questionnaries')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_questionnaries_type" class="col-sm-2 control-label"> Type </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questionnaries->id_questionnaries_type) ? $questionnaries->id_questionnaries_type : '' ?>" class="form-control" 
		                        				id="list_questionnaries_type" name="list_questionnaries_type" placeholder="Select the Questionnaries Type" required >
		                            <option value="">Select the Questionnaries Type </option>                        
		                        
		                            <?php foreach($list_questionnaries_type->result() as $academic): ?>                        
		                                <option value="<?= $academic->id_questionnaries_type; ?>"><?php echo $academic->code_questionnaries_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_modules" class="col-sm-2 control-label"> Modules </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questionnaries->id_modules) ? $questionnaries->id_modules : '' ?>" class="form-control" id="list_modules" name="list_modules" 
		       									placeholder="Select the modules" required >
		                            <option value="">Select the Modules</option>                        		                                                
		                        
		                            <?php foreach($list_modules->result() as $modules): ?>                        
		                                <option value="<?= $modules->id_modules; ?>"><?php echo $modules->name_modules; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_alternatives_type" class="col-sm-2 control-label"> Alternatives Type </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questionnaries->id_alternatives_type) ? $questionnaries->id_alternatives_type : '' ?>" class="form-control" 
		                        		id="list_alternatives_type" name="list_alternatives_type" placeholder="Select the Alternatives Type" required >		                            
                    				<option value="">Select the Alternatives Type </option>                        
		                        
		                            <?php foreach($list_alternatives_type->result() as $alternative): ?>                        
		                                <option value="<?= $alternative->id_alternatives_type; ?>"><?php echo $alternative->code_alternatives_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_people" class="col-sm-2 control-label"> Author </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questionnaries->id_people) ? $questionnaries->id_people : '' ?>" class="form-control" 
		                        				id="list_people" name="list_people" placeholder="Select the people" required >
		                            <option value="">Select the People </option>                        
		                        
		                            <?php foreach($list_people->result() as $people): ?>                        
		                                <option value="<?= $people->id_people; ?>"><?php echo $people->name; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="name_questionnaries" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-6">                    
			                    <input type="text" name="name_questionnaries" id="name_questionnaries" class="form-control" value="<?php echo !empty($questionnaries->name_questionnaries) ? $questionnaries->name_questionnaries : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="title_questionnaries" class="col-sm-2 control-label"> Title </label>
			                <div class="col-sm-10">                    			                	
			                    <input type="text" name="title_questionnaries" id="title_questionnaries" value="<?php echo !empty($questionnaries->title_questionnaries) ? $questionnaries->title_questionnaries : '' ?> " class="form-control" min="4" required />
			                </div>
		                </div>

			            <div class="form-group">
			                <label for="description_questionnaries" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="description_questionnaries" id="description_questionnaries" class="form-control" value="<?php echo !empty($questionnaries->description_questionnaries) ? $questionnaries->description_questionnaries : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="order_module_questionnaries" class="col-sm-2 control-label"> Order </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="order_module_questionnaries" id="order_module_questionnaries" class="form-control" value="<?php echo !empty($questionnaries->order_module_questionnaries) ? $questionnaries->order_module_questionnaries : '' ?> " />
			                </div>

			                <div class="col-sm-5"></div>			                
			                
                            <label for="dt_creation" class="col-sm-2 control-label">Date Creation</label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($questionnaries->dt_creation) ? $questionnaries->dt_creation : '' ?>" class="form-control datepicker" id="dt_creation" name="dt_creation" placeholder="Date Creation" />
                            </div>
						</div>
		                				
                        <div class="form-group" >
		                    <label for="list_level_type" class="col-sm-2 control-label"> Level Type </label>
		                    <div class="col-sm-6">
		                        <select selected="<?php echo isset($questionnaries->id_level_type) ? $questionnaries->id_level_type : '' ?>" class="form-control" 
		                        				id="list_level_type" name="list_level_type" placeholder="Select the Level Type" required >
		                            <option value="">Select the Level Type </option>                        
		                        
		                            <?php foreach($list_level_type->result() as $level): ?>                        
		                                <option value="<?= $level->id_level_type; ?>"><?php echo $level->code_level_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    

			                <label for="series_semester" class="col-sm-2 control-label"> Series Semester </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="series_semester" id="series_semester" class="form-control" value="<?php echo !empty($questionnaries->series_semester) ? $questionnaries->series_semester : '' ?> " />
			                </div>
                        </div>

                        <div class="form-group" >
		                    <label for="list_situation" class="col-sm-2 control-label"> Situation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questionnaries->id_situation) ? $questionnaries->id_situation : '' ?>" class="form-control" 
		                        				id="list_situation" name="list_situation" placeholder="Select the Situation" required >
		                            <option value="">Select the Situation </option>                        
		                        
		                            <?php foreach($list_situation->result() as $situation): ?>                        
		                                <option value="<?= $situation->id_situation; ?>"><?php echo $situation->code_situation; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
								                
                        <div class="form-group">
			                <label for="instructions_questionnaries" class="col-sm-2 control-label"> Instructions </label>
                            <div class="col-sm-10">
                                <textarea id="instructions_questionnaries" name="instructions_questionnaries" class="form-control" rows="5"><?php echo isset($questionnaries->instructions_questionnaries) ? $questionnaries->instructions_questionnaries : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('questionnaries') ?>" class="btn btn-primary"> Return </a> 
                            	</span>

                                <span style="margin-left: 250px;"> 
                                	<a href="<?= base_url('questionnaries/edit_cfg_questionnaries/'.$id_questionnaries) ?>" class="btn btn-success"> Setup </a> 
                            	</span>                            	              

                                <span style="margin-left: 150px;"> 
                                	<a href="<?= base_url('questions/index/'.$id_questionnaries) ?>" class="btn btn-info" 
                                						id="btn-questions" name="btn-questions"> Questions </a> 
                            	</span>
							</div>
		                </div>
		                
		                <input type="hidden" id="id_questionnaries" name="id_questionnaries" value="<?= !empty($id_questionnaries) ? $id_questionnaries : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	