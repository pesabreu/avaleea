
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_alternatives = "<?php echo !empty($alternatives->id_alternatives) ? $alternatives->id_alternatives : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_alternatives_type').focus();
        var id_questions = '<?php echo (isset($alternatives->id_questions) ? $alternatives->id_questions : '' )?>';            
        $('#list_questions option[value="' + id_questions + '"]').attr({ selected : "selected" });              

        //$('#list_situation').focus();
        var id_situation = '<?php echo (isset($alternatives->id_situation) ? $alternatives->id_situation : '' )?>';            
        $('#list_situation option[value="' + id_situation + '"]').attr({ selected : "selected" });

        //$('#list_alternatives_type').focus();
        var right_wrong = '<?php echo (isset($alternatives->right_wrong) ? $alternatives->right_wrong : '' )?>';            
        $('#list_right_wrong option[value="' + right_wrong + '"]').attr({ selected : "selected" });              

		$('#list_questions').focus();                      
    });
 
    function valid(){
        var cont = 0;
        
        if (id_alternatives == 0 ) {
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
	$id_alternatives = isset($id_alternatives) ? $id_alternatives : 0;

    $require = "";
    if ($id_alternatives == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('alternatives')?>">Alternatives</a></li>
  
    <?php if ($id_alternatives == 0): ?>
        <li class="active">New Alternatives</li>
    <?php else: ?>
        <li class="active">Edit Alternatives</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_alternatives == 0) ? 'New' : 'Edit' ?> Alternatives </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('alternatives/save_alternatives')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_questions" class="col-sm-2 control-label"> questions </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($alternatives->id_questions) ? $alternatives->id_questions : '' ?>" class="form-control" 
		                        				id="list_questions" name="list_questions" placeholder="Select the questions" required >
		                            <option value="">Select the questions </option>                        
		                        
		                            <?php foreach($list_questions->result() as $questions): ?>                        
		                                <option value="<?= $questions->id_questions; ?>"><?php echo $questions->name_questions; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="description_alternatives" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-6">                    
			                    <input type="text" name="description_alternatives" id="description_alternatives" class="form-control" value="<?php echo !empty($alternatives->description_alternatives) ? $alternatives->description_alternatives : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="text_alternatives" class="col-sm-2 control-label"> Text </label>
			                <div class="col-sm-10">                    			                	
			                    <input type="text" name="text_alternatives" id="text_alternatives" value="<?php echo !empty($alternatives->text_alternatives) ? $alternatives->text_alternatives : '' ?> " class="form-control" />
			                </div>
		                </div>

                        <div class="form-group" >
							<label for="id_order_questions" class="col-sm-2 control-label"> Order questions </label>
                            <div class="col-sm-1">
                                <input type="text" value="<?php echo isset($alternatives->id_order_questions) ? $alternatives->id_order_questions : '' ?>" 
                                								class="form-control" id="id_order_questions" name="id_order_questions" placeholder="Order Questions" pattern="[0-9]+$" />
                            </div>
			                
			                <div class="col-sm-1"></div>			                
                                                        
		                    <label for="list_right_wrong" class="col-sm-2 control-label"> Right or Wrong </label>
		                    <div class="col-sm-6">
		                        <select selected="<?php echo isset($alternatives->right_wrong) ? $alternatives->right_wrong : '' ?>" class="form-control" 
		                        				id="list_right_wrong" name="list_right_wrong" placeholder="Select Right or Wrong" required >
		                            <option value="">Select Right or Wrong </option>                        
	                                <option value="0">Wrong</option>
	                                <option value="1">Right</option>
		                        </select>
		                    </div>                                                
                        </div>
								                
                        <div class="form-group">
		                    <label for="list_situation" class="col-sm-2 control-label"> Situation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($alternatives->id_situation) ? $alternatives->id_situation : '' ?>" class="form-control" 
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
                                	<a href="<?= base_url('alternatives') ?>" class="btn btn-primary"> Return </a> 
                            	</span>                            	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_alternatives" name="id_alternatives" value="<?= !empty($id_alternatives) ? $id_alternatives : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	