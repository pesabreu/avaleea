
<?php
	//var_dump($list_modules);
	//exit();
 
?>

<script type="text/javascript">

    var id_images = "<?php echo !empty($images->id_images) ? $images->id_images : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_questionnaries').focus();
        var id_questionnaries = '<?php echo (isset($images->id_questionnaries) ? $images->id_questionnaries : '' )?>';            
        $('#list_questionnaries option[value="' + id_questionnaries + '"]').attr({ selected : "selected" });              

        //$('#list_questions').focus();
        var id_questions = '<?php echo (isset($images->id_questions) ? $images->id_questions : '' )?>';            
        $('#list_questions option[value="' + id_questions + '"]').attr({ selected : "selected" });              

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_images').val() == '') {
            $('#dt_images').val(date_today());
        
        } else {
        	$('#dt_images').val(date_normal($('#dt_images').val()));
        }

		$('#list_questionnaries').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_images == 0 ) {
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
	$id_images = isset($id_images) ? $id_images : 0;

    $require = "";
    if ($id_images == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('imagesq')?>"> Images</a></li>
  
    <?php if ($id_images == 0): ?>
        <li class="active">New Images</li>
    <?php else: ?>
        <li class="active">Edit Images</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_images == 0) ? 'New' : 'Edit' ?> Image </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('imagesq/save_images')?>" id="form_dd" onsubmit="return valid()" />		

                        <div class="form-group" >
		                    <label for="list_questionnaries" class="col-sm-2 control-label"> Questionnaries </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($images->id_questionnaries) ? $images->id_questionnaries : '' ?>" class="form-control" 
		                        				id="list_questionnaries" name="list_questionnaries" placeholder="Select the questionnaries" required >
		                            <option value="">Select the questionnaries </option>                        
		                        
		                            <?php foreach($list_questionnaries->result() as $questionnaries): ?>                        
		                                <option value="<?= $questionnaries->id_questionnaries; ?>"><?php echo $questionnaries->name_questionnaries; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_questions" class="col-sm-2 control-label"> Questions </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($images->id_questions) ? $images->id_questions : '' ?>" class="form-control" 
		                        		id="list_questions" name="list_questions" placeholder="Select the questions" >		                            
                    				<option value="">Select the questions </option>                        
		                        
		                            <?php foreach($list_questions->result() as $questions): ?>                        
		                                <option value="<?= $questions->id_questions; ?>"><?php echo $questions->name; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
							<label for="name_images" class="col-sm-2 control-label"> Name </label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo isset($images->name_images) ? $images->name_images : '' ?>" class="form-control" id="name_images" name="name_images" placeholder="Name" min="3" required />
                            </div>
                        </div>

                        <div class="form-group" >
							<label for="title_images" class="col-sm-2 control-label"> Title </label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo isset($images->title_images) ? $images->title_images : '' ?>" class="form-control" id="title_images" name="title_images" placeholder="Title" />
                            </div>
                        </div>

                        <div class="form-group" >
							<label for="description_images" class="col-sm-2 control-label"> Description </label>
                            <div class="col-sm-10">
                                <textarea id="description_images" name="description_images" class="form-control" rows="5"><?php echo isset($images->description_images) ? $images->description_images : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group" >
							<label for="url_images" class="col-sm-2 control-label"> URL </label>
                            <div class="col-sm-10">
                                <input type="url" value="<?php echo isset($images->url_images) ? $images->url_images : '' ?>" class="form-control" id="url_images" name="url_images" placeholder="Url" min="3" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('imagesq') ?>" class="btn btn-primary"> Return </a> 
                            	</span>                            	                                          	              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_images" name="id_images" value="<?= !empty($id_images) ? $id_images : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	