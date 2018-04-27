
<?php
	//var_dump($list_modules);
	//exit();
?>

<script type="text/javascript">

    var id_questions = "<?php echo !empty($questions->id_questions) ? $questions->id_questions : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        if (id_questions == 0) {
        	$("#btn-alternatives").hide();
        } else {
        	$("#btn-alternatives").show();
        }        
        //$('#list_questions_type').focus();
        var id_questionnaries = '<?php echo (isset($questions->id_questionnaries) ? $questions->id_questionnaries : '' )?>';            
        $('#list_questionnaries option[value="' + id_questionnaries + '"]').attr({ selected : "selected" });              

        //$('#list_alternatives_type').focus();
        var id_alternatives_type = '<?php echo (isset($questions->id_alternatives_type) ? $questions->id_alternatives_type : '' )?>';            
        $('#list_alternatives_type option[value="' + id_alternatives_type + '"]').attr({ selected : "selected" });              

        //$('#list_situation').focus();
        var id_situation = '<?php echo (isset($questions->id_situation) ? $questions->id_situation : '' )?>';            
        $('#list_situation option[value="' + id_situation + '"]').attr({ selected : "selected" });

		$('#list_questionnaries').focus();                      
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
	$id_questions = isset($id_questions) ? $id_questions : 0;

    $require = "";
    if ($id_questions == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('questions')?>">Questions</a></li>
  
    <?php if ($id_questions == 0): ?>
        <li class="active">New Questions</li>
    <?php else: ?>
        <li class="active">Edit Questions</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_questions == 0) ? 'New' : 'Edit' ?> questions </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('questions/save_questions')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_questionnaries" class="col-sm-2 control-label"> Questionnaries </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questions->id_questionnaries) ? $questions->id_questionnaries : '' ?>" class="form-control" 
		                        				id="list_questionnaries" name="list_questionnaries" placeholder="Select the Questionnaries" required >
		                            <option value="">Select the Questionnaries </option>                        
		                        
		                            <?php foreach($list_questionnaries->result() as $questionnaries): ?>                        
		                                <option value="<?= $questionnaries->id_questionnaries; ?>"><?php echo $questionnaries->name_questionnaries; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_alternatives_type" class="col-sm-2 control-label"> Alternatives Type </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($questions->id_alternatives_type) ? $questions->id_alternatives_type : '' ?>" class="form-control" 
		                        		id="list_alternatives_type" name="list_alternatives_type" placeholder="Select the Alternatives Type" required >		                            
                    				<option value="">Select the Alternatives Type </option>                        
		                        
		                            <?php foreach($list_alternatives_type->result() as $alternative): ?>                        
		                                <option value="<?= $alternative->id_alternatives_type; ?>"><?php echo $alternative->code_alternatives_type; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="name_questions" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-6">                    
			                    <input type="text" name="name_questions" id="name_questions" class="form-control" value="<?php echo !empty($questions->name_questions) ? $questions->name_questions : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="title_questions" class="col-sm-2 control-label"> Title </label>
			                <div class="col-sm-10">                    			                	
			                    <input type="text" name="title_questions" id="title_questions" value="<?php echo !empty($questions->title_questions) ? $questions->title_questions : '' ?> " class="form-control" min="4" required />
			                </div>
		                </div>
								                
                        <div class="form-group">
			                <label for="enunciation" class="col-sm-2 control-label"> Enunciation </label>
                            <div class="col-sm-10">
                                <textarea id="enunciation" name="enunciation" class="form-control" rows="5"><?php echo isset($questions->enunciation) ? $questions->enunciation : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group" >
							<label for="order_questionnaries" class="col-sm-2 control-label"> Order Questionnaries </label>
                            <div class="col-sm-1">
                                <input type="text" value="<?php echo isset($questions->order_questionnaries) ? $questions->order_questionnaries : '' ?>" 
                                						class="form-control" id="order_questionnaries" name="order_questionnaries" placeholder="Order Questionnaries" pattern="[0-9]+$" />
                            </div>
			                
			                <div class="col-sm-1"></div>			                
                                                        
		                    <label for="list_situation" class="col-sm-2 control-label"> Situation </label>
		                    <div class="col-sm-6">
		                        <select selected="<?php echo isset($questions->id_situation) ? $questions->id_situation : '' ?>" class="form-control" 
		                        				id="list_situation" name="list_situation" placeholder="Select the Situation" required >
		                            <option value="">Select the Situation </option>                        
		                        
		                            <?php foreach($list_situation->result() as $situation): ?>                        
		                                <option value="<?= $situation->id_situation; ?>"><?php echo $situation->code_situation; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                                                
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('questions') ?>" class="btn btn-primary"> Return </a> 
                            	</span>

                                <span style="margin-left: 250px;"> 
                                	<a href="<?= base_url('questions/edit_cfg_questions/'.$id_questions) ?>" class="btn btn-success"> Setup </a> 
                            	</span>

                                <span style="margin-left: 150px;"> 
                                	<a href="<?= base_url('alternatives/index/'.$id_questions) ?>" class="btn btn-info"
                                								id="btn-alternatives" name="btn-alternatives"> Alternatives </a> 
                            	</span>
                            	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_questions" name="id_questions" value="<?= !empty($id_questions) ? $id_questions : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	