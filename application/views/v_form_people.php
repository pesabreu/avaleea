
<script type="text/javascript">

    var id_people = "<?php echo !empty($people->id) ? $people->id : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_categories').focus();
        var id_categories = '<?php echo (isset($people->id_categories) ? $people->id_categories : '')?>';            
        $('#list_categories option[value="' + id_categories + '"]').attr({ selected : "selected" });              

        $('#list_occupation').focus();
        var id_occupation_area = '<?php echo (isset($people->id_occupation_area) ? $people->id_occupation_area : '' )?>';            
        $('#list_occupation option[value="' + id_occupation_area + '"]').attr({ selected : "selected" });              

        $('#list_type_people').focus();
        var type_people = '<?php echo (isset($people->type_people) ? $people->type_people : '' )?>';            
        $('#list_type_people option[value="' + type_people + '"]').attr({ selected : "selected" });              

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });        

        if ($('#dt_birthday').val() == '') {
            $('#dt_birthday').val(date_today());
        
        } else {
        	$('#dt_birthday').val(date_normal($('#dt_birthday').val()));
        }
        
        $('#list_type_people').focus();                
    })
 
    function valid(){
        var cont = 0;
        
        if (id_people == 0 ) {
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
	$id_people = isset($id_people) ? $id_people : 0;

    $require = "";
    if ($id_people == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('people')?>">People</a></li>
  
    <?php if ($id_people == 0): ?>
        <li class="active">New People</li>
    <?php else: ?>
        <li class="active">Edit People</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_people == 0) ? 'New' : 'Edit' ?> People </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('people/save_people')?>" id="form_dd" onsubmit="return valid()" />		
		                				
                        <div class="form-group" >
		                    <label for="list_type_people" class="col-sm-2 control-label"> Type People </label>
		                    <div class="col-sm-8">
		                        <select  selected="<?php echo isset($people->type_people) ? $people->type_people : '' ?>" class="form-control" id="list_type_people" name="list_type_people" 
		       									placeholder="Select the Type People" required >
		                            <option value="">Select the Type People</option>                        		                                                
	                                <option value="F"> Physical Person </option>
	                                <option value="J">Legal Person</option>	                                 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_categories" class="col-sm-2 control-label"> Categories </label>
		                    <div class="col-sm-10">
		                        <select  selected="<?php echo isset($people->id_categories) ? $people->id_categories : '' ?>" class="form-control" 
		                        				id="list_categories" name="list_categories" placeholder="Select the Categories" required >
		                            <option value="">Select the Categories </option>                        
		                        
		                            <?php foreach($list_categories->result() as $categorie): ?>                        
		                                <option value="<?= $categorie->id_categories; ?>"><?php echo $categorie->code_categories; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

                        <div class="form-group" >
		                    <label for="list_occupation" class="col-sm-2 control-label"> Occupation Area </label>
		                    <div class="col-sm-10">
		                        <select  selected="<?php echo isset($people->id_occupation_area) ? $people->id_occupation_area : '' ?>" class="form-control" 
		                        				id="list_occupation" name="list_occupation" placeholder="Select the Occupation Area" required >
		                            <option value="">Select the Occupation Area </option>                        
		                        
		                            <?php foreach($list_occupation->result() as $area): ?>                        
		                                <option value="<?= $area->id_occupation_area; ?>"><?php echo $area->code_occupation_area; ?></option>
		                            <?php endforeach; ?> 
		                        </select>
		                    </div>                    
                        </div>

			            <div class="form-group">
			                <label for="name" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="name" id="name" class="form-control" value="<?php echo !empty($people->name) ? $people->name : '' ?> " min="3" required />
			                </div>
			                
			                <div class="col-sm-2"> </div>

			                <label for="name_fantasy" class="col-sm-2 control-label"> Name Fantasy </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="name_fantasy" id="name_fantasy" class="form-control" value="<?php echo !empty($people->name_fantasy) ? $people->name_fantasy : '' ?> " min="3" />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="physical_identification" class="col-sm-2 control-label"> Physical Identification</label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="physical_identification" id="physical_identification" value="<?php echo !empty($people->physical_identification) ? $people->physical_identification : '' ?> " class="form-control" />
			                </div>
			                
			                <div class="col-sm-2"> </div>

			                <label for="legal_identification" class="col-sm-2 control-label"> Legal Identification</label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="legal_identification" id="legal_identification" value="<?php echo !empty($people->legal_identification) ? $people->legal_identification : '' ?> " class="form-control" />
			                </div>			                
		                </div>

                        <div class="form-group" >
                            <label for="dt_birthday" class="col-sm-2 control-label">Date Birthday</label>
                            <div class="col-sm-2">
                                <input type="text" value="<?php echo isset($people->dt_birthday) ? $people->dt_birthday : '' ?>" class="form-control datepicker" id="dt_birthday" name="dt_birthday" placeholder="Date Birthday" />
                            </div>
                        </div>

			            <div class="form-group">
			                <label for="city" class="col-sm-2 control-label"> City </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="city" id="city" class="form-control" value="<?php echo !empty($people->city) ? $people->city : '' ?> " min="3" />
			                </div>
			                
			                <div class="col-sm-2"> </div>

			                <label for="state" class="col-sm-2 control-label"> State </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="state" id="state" class="form-control" value="<?php echo !empty($people->state) ? $people->state : '' ?> " min="3" />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="country" class="col-sm-2 control-label"> Country </label>
			                <div class="col-sm-5">                    
			                    <input type="text" name="country" id="country" class="form-control" value="<?php echo !empty($people->country) ? $people->country : '' ?> " min="3" />
			                </div>
			            </div>
		                
                        <div class="form-group">
                            <label for="notes" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea  id="notes" name="notes" class="form-control" rows="5"><?php echo isset($people->note) ? $people->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>

                                <span style="float: right;"> 
                                	<a href="<?= base_url('people') ?>" class="btn btn-primary"> Return </a> 
                            	</span>

                                <span style="margin-left: 150px;"> 
                                	<a href="<?= base_url('people/edit_addresses/'.$id_people) ?>" class="btn btn-info"> Addresses </a> 
                            	</span>
                                <span style="margin-left: 50px;"> 
                                	<a href="<?= base_url('people/edit_phones/'.$id_people) ?>" class="btn btn-info"> Phones </a> 
                            	</span>
                                <span style="margin-left: 50px;"> 
                                	<a href="<?= base_url('people/edit_web_contact/'.$id_people) ?>" class="btn btn-info"> Web Contact </a> 
                            	</span>
							</div>
		                </div>
		                
		                <input type="hidden" id="id_people" name="id_people" value="<?= !empty($id_people) ? $id_people : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	