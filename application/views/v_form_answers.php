
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_answers = "<?php echo !empty($answers->id_answers) ? $answers->id_answers : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_evaluation').focus();
        var id_evaluation = '<?php echo (isset($answers->id_evaluation) ? $answers->id_evaluation : '' )?>';            
        $('#list_evaluation option[value="' + id_evaluation + '"]').attr({ selected : "selected" });              

        //$('#list_questions').focus();
        var id_questions = '<?php echo (isset($answers->id_questions) ? $answers->id_questions : '' )?>';            
        $('#list_questions option[value="' + id_questions + '"]').attr({ selected : "selected" });              

		$('#list_evaluation').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_answers == 0 ) {
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
	$id_answers = isset($id_answers) ? $id_answers : 0;

    $require = "";
    if ($id_answers == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('answers')?>"> Answers</a></li>
  
    <?php if ($id_answers == 0): ?>
        <li class="active">New Answers</li>
    <?php else: ?>
        <li class="active">Edit Answers</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_answers == 0) ? 'New' : 'Edit' ?> Answers </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('answers/save_answers')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_evaluation" class="col-sm-2 control-label"> Evaluation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($answers->id_evaluation) ? $answers->id_evaluation : '' ?>" class="form-control" 
		                        				id="list_evaluation" name="list_evaluation" placeholder="Select the Evaluation" required >
		                            <option value="">Select the Evaluation </option>                        
		                        
		                            <?php foreach($list_evaluation->result() as $evaluation): ?>                        
		                                <option value="<?= $evaluation->id_evaluation; ?>"><?php echo $evaluation->name_evaluation; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_questions" class="col-sm-2 control-label"> Questions </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($answers->id_questions) ? $answers->id_questions : '' ?>" class="form-control" 
		                        		id="list_questions" name="list_questions" placeholder="Select the Questions" required >		                            
                    				<option value="">Select the Questions </option>                        
		                        
		                            <?php foreach($list_questions->result() as $questions): ?>                        
		                                <option value="<?= $questions->id_questions; ?>"><?php echo $questions->name_questions; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
							<label for="id_alternative_select" class="col-sm-2 control-label"> Alternative Select </label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($answers->id_alternative_select) ? $answers->id_alternative_select : '' ?>" class="form-control" id="id_alternative_select" name="id_alternative_select" placeholder="Alternative Select" pattern="[0-9]+$" maxlenght="2"  required />
                            </div>
                        </div>

			            <div class="form-group">
			                <label for="answers" class="col-sm-2 control-label"> Answers </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="answers" id="answers" class="form-control" value="<?php echo !empty($answers->answers) ? $answers->answers : '' ?>" placeholder="Answers" />
			                </div>
			            </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($answers->note) ? $answers->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('answers') ?>" class="btn btn-primary"> Return </a> 
                            	</span>                            	                                          	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_answers" name="id_answers" value="<?= !empty($id_answers) ? $id_answers : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	