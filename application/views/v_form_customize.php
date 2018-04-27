

<?php
	//var_dump($list_modules);
	//exit();
?>

<script type="text/javascript">

    var id_customize = "<?php echo !empty($customize->id_customize) ? $customize->id_customize : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_questionnaries').focus();
        var id_questionnaries = '<?php echo (isset($customize->id_questionnaries) ? $customize->id_questionnaries : '' )?>';            
        $('#list_questionnaries option[value="' + id_questionnaries + '"]').attr({ selected : "selected" });              

        //$('#list_people').focus();
        var id_people = '<?php echo (isset($customize->id_people) ? $customize->id_people : '' )?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_customize').val() == '') {
            $('#dt_customize').val(date_today());
        
        } else {
        	$('#dt_customize').val(date_normal($('#dt_customize').val()));
        }

		$('#list_questionnaries').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_customize == 0 ) {
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
	$id_customize = isset($id_customize) ? $id_customize : 0;

    $require = "";
    if ($id_customize == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('customize')?>"> Customize</a></li>
  
    <?php if ($id_customize == 0): ?>
        <li class="active">New Customize</li>
    <?php else: ?>
        <li class="active">Edit Customize</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general" class="form-group">	        
           
    <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo ($id_customize == 0) ? 'New' : 'Edit' ?> Customization </h3>
        </div>

        <div class="panel-body">   
            <form class="form-horizontal" role="form" method="post" action="<?=base_url('customize/save_customize')?>" id="form_dd" onsubmit="return valid()" />		

                <div class="form-group" >
                    <label for="list_questionnaries" class="col-sm-2 control-label"> questionnaries </label>
                    <div class="col-sm-10">
                        <select selected="<?php echo isset($customize->id_questionnaries) ? $customize->id_questionnaries : '' ?>" class="form-control" 
                        				id="list_questionnaries" name="list_questionnaries" placeholder="Select the questionnaries" required >
                            <option value="">Select the questionnaries </option>                        
                        
                            <?php foreach($list_questionnaries->result() as $questionnaries): ?>                        
                                <option value="<?= $questionnaries->id_questionnaries; ?>"><?php echo $questionnaries->name_questionnaries; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>                    
                </div>

                <div class="form-group" >
                    <label for="list_people" class="col-sm-2 control-label"> people </label>
                    <div class="col-sm-10">
                        <select selected="<?php echo isset($customize->id_people) ? $customize->id_people : '' ?>" class="form-control" 
                        		id="list_people" name="list_people" placeholder="Select the people" required >		                            
            				<option value="">Select the people </option>                        
                        
                            <?php foreach($list_people->result() as $people): ?>                        
                                <option value="<?= $people->id_people; ?>"><?php echo $people->name; ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>                    
                </div>

                <div class="form-group" >
					<label for="description_customize" class="col-sm-2 control-label"> Description </label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo isset($customize->description_customize) ? $customize->description_customize : '' ?>" class="form-control" id="description_customize" name="description_customize" placeholder="Description" min="3" required />
                    </div>
                </div>

                <div class="form-group" >
                    <label for="dt_customize" class="col-sm-2 control-label">Date Customize</label>
                    <div class="col-sm-2">
                        <input type="text" value="<?php echo isset($people->dt_customize) ? $people->dt_customize : '' ?>" class="form-control datepicker" id="dt_customize" name="dt_customize" placeholder="Date Customize" />
                    </div>
	            </div>

                <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Note</label>
                    <div class="col-sm-10">
                        <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($customize->note) ? $customize->note : '' ?> </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                        <span style="float: right;"> 
                        	<a href="<?= base_url('customize') ?>" class="btn btn-primary"> Return </a> 
                    	</span>                            	                                          	              
					</div>
                </div>
                
                <input type="hidden" id="id_customize" name="id_customize" value="<?= !empty($id_customize) ? $id_customize : 0 ?>" />                                                             
           	</form>
    
	  		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
  
		</div>                  
    </div>
    
</div>   

	