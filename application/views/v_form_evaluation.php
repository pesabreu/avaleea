
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_evaluation = "<?php echo !empty($evaluation->id_evaluation) ? $evaluation->id_evaluation : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        if (id_evaluation == 0) {
        	$("#btn-answers").hide();
        } else {
        	$("#btn-answers").show();
        }        

        //$('#list_application').focus();
        var id_application = '<?php echo (isset($evaluation->id_application) ? $evaluation->id_application : '' )?>';            
        $('#list_application option[value="' + id_application + '"]').attr({ selected : "selected" });              

        //$('#list_people').focus();
        var id_people = '<?php echo (isset($evaluation->id_people) ? $evaluation->id_people : '' )?>';            
        $('#list_people[value="' + id_people + '"]').attr({ selected : "selected" });

        //$('#list_evaluation_type').focus();
        var id_questionnaries = '<?php echo (isset($evaluation->id_questionnaries) ? $evaluation->id_questionnaries : '' )?>';            
        $('#list_questionnaries option[value="' + id_questionnaries + '"]').attr({ selected : "selected" });              

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_evaluation').val() == '') {
            $('#dt_evaluation').val(date_today());
        
        } else {
        	$('#dt_evaluation').val(date_normal($('#dt_evaluation').val()));
        }        

		$('#list_application').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_evaluation == 0 ) {
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
	$id_evaluation = isset($id_evaluation) ? $id_evaluation : 0;

    $require = "";
    if ($id_evaluation == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('evaluation')?>">Evaluation</a></li>
  
    <?php if ($id_evaluation == 0): ?>
        <li class="active">New Evaluation</li>
    <?php else: ?>
        <li class="active">Edit Evaluation</li>
    <?php endif; ?>   
</ol> 
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_evaluation == 0) ? 'New' : 'Edit' ?> Evaluation </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('evaluation/save_evaluation')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_application" class="col-sm-2 control-label"> Application </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($evaluation->id_application) ? $evaluation->id_application : '' ?>" class="form-control" 
		                        		id="list_application" name="list_application" placeholder="Select the Application" required >		                            
                    				<option value="">Select the Application </option>                        
		                        
		                            <?php foreach($list_application->result() as $application): ?>                        
		                                <option value="<?= $application->id_application; ?>"><?php echo $application->name_application; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
                        
			            <div class="form-group">                                                        
		                    <label for="list_people" class="col-sm-2 control-label"> People </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($evaluation->id_people) ? $evaluation->id_people : '' ?>" class="form-control" 
		                        				id="list_people" name="list_people" placeholder="Select the people" required >
		                            <option value="">Select the people </option>                        
		                        
		                            <?php foreach($list_people->result() as $people): ?>                        
		                                <option value="<?= $people->id_people; ?>"><?php echo $people->name; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>
	                    </div>                                                

                        <div class="form-group" >
		                    <label for="list_questionnaries" class="col-sm-2 control-label"> Questionnaries </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($evaluation->id_questionnaries) ? $evaluation->id_questionnaries : '' ?>" class="form-control" 
		                        				id="list_questionnaries" name="list_questionnaries" placeholder="Select the Questionnaries" required >
		                            <option value="">Select the Questionnaries </option>                        
		                        
		                            <?php foreach($list_questionnaries->result() as $questionnaries): ?>                        
		                                <option value="<?= $questionnaries->id_questionnaries; ?>"><?php echo $questionnaries->name_questionnaries; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">			                
                            <label for="name_evaluation" class="col-sm-2 control-label"> Name </label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo isset($evaluation->name_evaluation) ? $evaluation->name_evaluation : '' ?>" class="form-control" id="name_evaluation" name="name_evaluation" placeholder="Name Evaluation" />
                            </div>
						</div>

			            <div class="form-group">			                
                            <label for="dt_evaluation" class="col-sm-2 control-label">Date Creation</label>
                            <div class="col-sm-3">
                                <input type="text" value="<?php echo isset($evaluation->dt_evaluation) ? $evaluation->dt_evaluation : '' ?>" class="form-control datepicker" id="dt_evaluation" name="dt_evaluation" placeholder="Date Evaluation" />
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
                                	<a href="<?= base_url('evaluation') ?>" class="btn btn-primary"> Return </a> 
                            	</span>                            	              

                                <span style="margin-left: 300px;"> 
                                	<a href="<?= base_url('answers/index/'.$id_evaluation) ?>" class="btn btn-info"
                                								id="btn-answers" name="btn-answers"> Answers </a> 
                            	</span>                            	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_evaluation" name="id_evaluation" value="<?= !empty($id_evaluation) ? $id_evaluation : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	