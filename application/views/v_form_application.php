
<?php
	//var_dump($list_modules);
	//exit();

	$cor = ' style="background-color: #F0F0F0;"';
	$size = (count($list_questionnaries)) < 4 ? ' size = "'. (count($list_questionnaries)+1) .'" ' : " ";
	
?>

<script type="text/javascript">

    var id_application = "<?php echo !empty($application->id_application) ? $application->id_application : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        if (id_application == 0) {
        	$("#btn-evaluation").hide();
        } else {
        	$("#btn-evaluation").show();
        }        
        //$('#list_application_type').focus();
        var id_questionnaries = '<?php echo (isset($application->id_questionnaries) ? $application->id_questionnaries : '' )?>';            
        $('#list_questionnaries option[value="' + id_questionnaries + '"]').attr({ selected : "selected" });              

        //$('#list_people').focus();
        var id_people = '<?php echo (isset($application->id_people) ? $application->id_people : '' )?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });

        //$('#list_application_type').focus();
        var id_application_type = '<?php echo (isset($application->id_application_type) ? $application->id_application_type : '' )?>';            
        $('#list_application_type option[value="' + id_application_type + '"]').attr({ selected : "selected" });              

        //$('#list_application_mode').focus();
        var id_application_mode = '<?php echo (isset($application->id_application_mode) ? $application->id_application_mode : '' )?>';            
        $('#list_application_mode option[value="' + id_application_mode + '"]').attr({ selected : "selected" });              

		$('#list_questionnaries').focus();                      
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
	$id_application = isset($id_application) ? $id_application : 0;

    $require = "";
    if ($id_application == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('applicationq')?>">Application</a></li>
  
    <?php if ($id_application == 0): ?>
        <li class="active">New Application</li>
    <?php else: ?>
        <li class="active">Edit Application</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_application == 0) ? 'New' : 'Edit' ?> Application </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('applicationq/save_application')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >                                                        
		                    <label for="selectQuestionnaries" class="col-sm-2 control-label"> Questionnaries </label>
		                    <div class="col-sm-10">

								<select multiple class="form-control" id="selectQuestionnaries" name="selectQuestionnaries" <?= $size ?> style="color: black;" required>
								  <option value="#" style="font-weight: 800; margin-bottom: 5px;">Selecione todos os questionários da Aplicação</option>
								  <?php foreach($list_questionnaries->result() as $questionnarie) : ?>	

									<option value="<?= $questionnarie->id_questionnaries; ?>" <?= $cor ?>><?= trim($questionnarie->name_questionnaries); ?></option>
									<?php $cor = ($cor == ' style="background-color: white;"' ? ' style="background-color: #F0F0F0;"' : ' style="background-color: white;"'); ?>
									
								  <?php endforeach ; ?>	

								</select>
							</div>
						</div>

                        <div class="form-group" >                                                        
		                    <label for="list_people" class="col-sm-2 control-label"> People </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($application->id_people) ? $application->id_people : '' ?>" class="form-control" 
		                        				id="list_people" name="list_people" placeholder="Select the people" required >
		                            <option value="">Select the people </option>                        
		                        
		                            <?php foreach($list_people->result() as $people): ?>                        
		                                <option value="<?= $people->id_people; ?>"><?php echo $people->name; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                                                
                        </div>

                        <div class="form-group" >
		                    <label for="list_application_type" class="col-sm-2 control-label"> Application Type </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($application->id_application_type) ? $application->id_application_type : '' ?>" class="form-control" 
		                        		id="list_application_type" name="list_application_type" placeholder="Select the Application Type" required >		                            
                    				<option value="">Select the Application Type </option>                        
		                        
		                            <?php foreach($list_application_type->result() as $type): ?>                        
		                                <option value="<?= $type->id_application_type; ?>"><?php echo $type->code_application_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_application_mode" class="col-sm-2 control-label"> Application Mode </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($application->id_application_mode) ? $application->id_application_mode : '' ?>" class="form-control" 
		                        		id="list_application_mode" name="list_application_mode" placeholder="Select the Application Mode" required >		                            
                    				<option value="">Select the Application Mode </option>                        
		                        
		                            <?php foreach($list_application_mode->result() as $mode): ?>                        
		                                <option value="<?= $mode->id_application_mode; ?>"><?php echo $mode->code_application_mode; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="name_application" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name_application" id="name_application" class="form-control" value="<?php echo !empty($application->name_application) ? $application->name_application : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="title_application" class="col-sm-2 control-label"> Title </label>
			                <div class="col-sm-10">                    			                	
			                    <input type="text" name="title_application" id="title_application" value="<?php echo !empty($application->title_application) ? $application->title_application : '' ?> " class="form-control" min="4" required />
			                </div>
		                </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($application->note) ? $application->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('applicationq') ?>" class="btn btn-primary"> Return </a> 
                            	</span>

                                <span style="margin-left: 250px;"> 
                                	<a href="<?= base_url('applicationq/edit_cfg_application/'.$id_application) ?>" class="btn btn-success"> Setup </a> 
                            	</span>

                                <span style="margin-left: 150px;"> 
                                	<a href="<?= base_url('evaluation/index/'.$id_application) ?>" class="btn btn-info"
                                								id="btn-evaluation" name="btn-evaluation"> Evaluation </a> 
                            	</span>                            	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_application" name="id_application" value="<?= !empty($id_application) ? $id_application : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	