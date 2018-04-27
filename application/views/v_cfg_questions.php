
<?php
//	var_dump($cfg_questions);
//	exit();
?>

<script type="text/javascript">

    var id_cfg_questions = "<?php echo !empty($cfg_questions->id_cfg_questions) ? $cfg_questions->id_cfg_questions : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_presentation_type').focus();
        var id_presentation_type = '<?php echo (isset($cfg_questions->id_presentation_type) ? $cfg_questions->id_presentation_type : '')?>';            
        $('#list_presentation_type option[value="' + id_presentation_type + '"]').attr({ selected : "selected" });              

        //$('#list_mandatory_answers').focus();
        var id_mandatory_answers = '<?php echo (isset($cfg_questions->id_mandatory_answers) ? $cfg_questions->id_mandatory_answers : '' )?>';            
        $('#list_mandatory_answers option[value="' + id_mandatory_answers + '"]').attr({ selected : "selected" });              

        $('#list_presentation_type').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_questions == 0 ) {
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
	$id_cfg_questions = isset($id_cfg_questions) ? $id_cfg_questions : 0;

    $require = "";
    if ($id_cfg_questions == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('questions')?>">Questions</a></li>
  
    <li class="active">Edit Setup Questions</li>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"> Edit Setup Questions </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('questions/save_cfg_questions')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name_questions" class="col-sm-2 control-label"> questions </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name_questions" id="name_questions" class="form-control" 
 									value="<?php echo !empty($cfg_questions->name_questions) ? $cfg_questions->name_questions : '' ?>" readonly />
			                </div>
			            </div>

                        <div class="form-group" >
		                    <label for="list_presentation_type" class="col-sm-2 control-label"> Type Presentation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questions->id_presentation_type) ? $cfg_questions->id_presentation_type : '' ?>" class="form-control" 
		                        				id="list_presentation_type" name="list_presentation_type" placeholder="Select the Presentation Type" required >
		                            <option value="">Select the Presentation Type </option>                        
		                        
		                            <?php foreach($list_presentation_type->result() as $presentation): ?>                        
		                                <option value="<?= $presentation->id_presentation_type; ?>"><?= $presentation->code_presentation_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
		                				
                        <div class="form-group" >
		                    <label for="list_mandatory_answers" class="col-sm-2 control-label"> Mandatory Answers </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($cfg_questions->id_mandatory_answers) ? $cfg_questions->id_mandatory_answers : '' ?>" class="form-control" 
		                        				id="list_mandatory_answers" name="list_mandatory_answers" placeholder="Select the Mandatory Answers" required >
		                            <option value="">Select the Mandatory Answers </option>                        
		                        
		                            <?php foreach($list_mandatory_answers->result() as $mandatory): ?>                        
		                                <option value="<?= $mandatory->id_mandatory_answers; ?>"><?= $mandatory->code_mandatory_answers; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
						
			            <div class="form-group">
			                <label for="time_duration" class="col-sm-2 control-label"> Time Duration </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="time_duration" id="time_duration" class="form-control" 
									value="<?php echo !empty($cfg_questions->time_duration) ? $cfg_questions->time_duration : '' ?>" pattern="[0-9]+$" />
			                </div>

			                <label for="quantity_alternatives" class="col-sm-2 control-label"> Quantity Alternatives </label>
			                <div class="col-sm-2">                    			                	
			                    <input type="text" name="quantity_alternatives" id="quantity_alternatives" value="<?php echo !empty($cfg_questions->quantity_alternatives) ? $cfg_questions->quantity_alternatives : '' ?> " class="form-control" pattern="[0-9]+$" />
			                </div>

			                <label for="weight" class="col-sm-2 control-label"> Question Weight </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="weight" id="weight" class="form-control" value="<?php echo !empty($cfg_questions->weight) ? $cfg_questions->weight : '' ?>" pattern="[0-9]+$" />
			                </div>
			            </div>
		                				
                        <div class="form-group" >
		                    <label for="list_allows_modify_response" class="col-sm-2 control-label"> Allows Modify Response </label>
		                    <div class="col-sm-3">
		                        <select  selected="<?php echo isset($cfg_questions->allows_modify_response) ? $cfg_questions->allows_modify_response : '' ?>" class="form-control" id="list_allows_modify_response" name="list_allows_modify_response" 
		       									placeholder="Select Allows Modify Response" required >
		                            <option value="">Select Allows Modify Response</option>                        		                                                
	                                <option value="0"> No </option>
	                                <option value="1"> Yes </option>	                                 
		                        </select>
		                    </div>                    

			                <div class="col-sm-3"></div>
			                
		                    <label for="list_editable" class="col-sm-2 control-label"> Editable </label>
		                    <div class="col-sm-2">
		                        <select  selected="<?php echo isset($cfg_questions->editable) ? $cfg_questions->editable : '' ?>" class="form-control" id="list_editable" name="list_editable" 
		       									placeholder="Select Editable" required >
		                            <option value="">Select Editable</option>                        		                                                
	                                <option value="0"> No </option>
	                                <option value="1"> Yes </option>	                                 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('questions') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_cfg_questions" name="id_cfg_questions" value="<?= !empty($id_cfg_questions) ? $id_cfg_questions : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>
   	