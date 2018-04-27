
<?php
	//var_dump($list_industry);
	//exit();
 
?>

<script type="text/javascript">

    var id_modules = "<?php echo !empty($modules->id_modules) ? $modules->id_modules : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        //$('#list_industry').focus();
        var id_industry = '<?php echo (isset($modules->id_industry) ? $modules->id_industry : '')?>';            
        $('#list_industry option[value="' + id_industry + '"]').attr({ selected : "selected" });              

        //$('#list_academic_area').focus();
        var id_academic_area = '<?php echo (isset($modules->id_academic_area) ? $modules->id_academic_area : '' )?>';            
        $('#list_academic_area option[value="' + id_academic_area + '"]').attr({ selected : "selected" });              

        //$('#list_disciplines').focus();
        var id_disciplines = '<?php echo (isset($modules->id_disciplines) ? $modules->id_disciplines : '' )?>';            
        $('#list_disciplines option[value="' + id_disciplines + '"]').attr({ selected : "selected" });              

        //$('#list_situation').focus();
        var id_situation = '<?php echo (isset($modules->id_situation) ? $modules->id_situation : '' )?>';            
        $('#list_situation option[value="' + id_situation + '"]').attr({ selected : "selected" });

		$('#list_industry').focus();                      
    })
 
    function valid(){
        var cont = 0;
        
        if (id_modules == 0 ) {
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
	$id_modules = isset($id_modules) ? $id_modules : 0;

    $require = "";
    if ($id_modules == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('modules')?>">Modules</a></li>
  
    <?php if ($id_modules == 0): ?>
        <li class="active">New Module</li>
    <?php else: ?>
        <li class="active">Edit Modules</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_modules == 0) ? 'New' : 'Edit' ?> Modules </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('modules/save_modules')?>" id="form_dd" onsubmit="return valid()" />		
		                				
                        <div class="form-group" >
		                    <label for="list_industry" class="col-sm-2 control-label"> Industry </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($modules->id_industry) ? $modules->id_industry : '' ?>" class="form-control" id="list_industry" name="list_industry" 
		       									placeholder="Select the Industry" required >
		                            <option value="">Select the Industry</option>                        		                                                
		                        
		                            <?php foreach($list_industry->result() as $industry): ?>                        
		                                <option value="<?= $industry->id_industry; ?>"><?php echo $industry->name_industry; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_academic_area" class="col-sm-2 control-label"> Academic Area </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($modules->id_academic_area) ? $modules->id_academic_area : '' ?>" class="form-control" 
		                        				id="list_academic_area" name="list_academic_area" placeholder="Select the Academic Area" required >
		                            <option value="">Select the Academic Area </option>                        
		                        
		                            <?php foreach($list_academic_area->result() as $academic): ?>                        
		                                <option value="<?= $academic->id_academic_area; ?>"><?php echo $academic->code_academic_area; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_disciplines" class="col-sm-2 control-label"> Disciplines </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($modules->id_disciplines) ? $modules->id_disciplines : '' ?>" class="form-control" 
		                        				id="list_disciplines" name="list_disciplines" placeholder="Select the Disciplines" required >
		                            <option value="">Select the Disciplines </option>                        
		                        
		                            <?php foreach($list_disciplines->result() as $discipline): ?>                        
		                                <option value="<?= $discipline->id_disciplines; ?>"><?php echo $discipline->code_disciplines; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="name_modules" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-6">                    
			                    <input type="text" name="name_modules" id="name_modules" class="form-control" value="<?php echo !empty($modules->name_modules) ? $modules->name_modules : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="title_modules" class="col-sm-2 control-label"> Title </label>
			                <div class="col-sm-6">                    			                	
			                    <input type="text" name="title_modules" id="title_modules" value="<?php echo !empty($modules->title_modules) ? $modules->title_modules : '' ?> " class="form-control" min="4" required />
			                </div>

			                <label for="time_modules" class="col-sm-2 control-label">Response Time</label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="time_modules" id="time_modules" 
				                    value="<?php echo !empty($modules->time_modules) ? intval(trim($modules->time_modules)) : 0 ?> " 
				                    class="form-control" pattern="[0-9]+$" />			                    
			                </div>
			                
			                <div class="col-sm-1" style="margin-top: 5px; margin-left: -5px;">minutes</div>			                			                			                			               
		                </div>

			            <div class="form-group">
			                <label for="description_modules" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="description_modules" id="description_modules" class="form-control" value="<?php echo !empty($modules->description_modules) ? $modules->description_modules : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="subject" class="col-sm-2 control-label"> Subject </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="subject" id="subject" class="form-control" value="<?php echo !empty($modules->subject) ? $modules->subject : '' ?> " min="3" />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="theme" class="col-sm-2 control-label"> Theme </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="theme" id="theme" class="form-control" value="<?php echo !empty($modules->theme) ? $modules->theme : '' ?> " />
			                </div>
						</div>

			            <div class="form-group">
			                <label for="scope" class="col-sm-2 control-label"> Scope </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="scope" id="scope" class="form-control" value="<?php echo !empty($modules->scope) ? $modules->scope : '' ?> " />
			                </div>
			            </div>

                        <div class="form-group" >
		                    <label for="list_situation" class="col-sm-2 control-label"> Situation </label>
		                    <div class="col-sm-10">
		                        <select selected="<?php echo isset($modules->id_situation) ? $modules->id_situation : '' ?>" class="form-control" 
		                        				id="list_situation" name="list_situation" placeholder="Select the Situation" required >
		                            <option value="">Select the Situation </option>                        
		                        
		                            <?php foreach($list_situation->result() as $situation): ?>                        
		                                <option value="<?= $situation->id_situation; ?>"><?php echo $situation->code_situation; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>
								                
                        <div class="form-group">
                            <label for="text_modules" class="col-sm-2 control-label"> Notes </label>
                            <div class="col-sm-10">
                                <textarea id="text_modules" name="text_modules" class="form-control" rows="5"><?php echo isset($modules->text_modules) ? $modules->text_modules : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('modules') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_modules" name="id_modules" value="<?= !empty($id_modules) ? $id_modules : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	