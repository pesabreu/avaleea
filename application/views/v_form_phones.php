
<script type="text/javascript">

    var id_phones = "<?php echo !empty($phones->id_phones) ? $phones->id_phones : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_people').focus();
        var id_people = '<?php echo (isset($phones->id_people) ? $phones->id_people : '')?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              
    })
 
    function valid(){
        var cont = 0;
        
        if (id_phones == 0 ) {
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
            $('#nome_usuario').focus();
            return false;
        }                                
        return true;
    }    
</script>

<?php
	$id_phones = isset($id_phones) ? $id_phones : 0;
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('people')?>">People</a></li> 
    <li class="active">Edit Phones</li>
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_phones == 0) ? 'New' : 'Edit' ?> Phone </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('people/save_phone')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name" id="name" class="form-control" 
 									value="<?php echo !empty($phones->name) ? $phones->name : '' ?>" readonly />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="area_code_1" class="col-sm-2 control-label"> Area Code 1 </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="area_code_1" id="area_code_1" class="form-control" value="<?php echo !empty(trim($phones->area_code_1)) ? trim($phones->area_code_1) : '' ?> " required />
			                </div>

			                <label for="ddd_1" class="col-sm-2 control-label"> DDD </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="ddd_1" id="ddd_1" class="form-control" value="<?php echo !empty(trim($phones->ddd_1)) ? trim($phones->ddd_1) : '' ?> " />
			                </div>

			                <div class="col-sm-1"> </div>
			                <label for="number_phone_1" class="col-sm-2 control-label"> Number </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="number_phone_1" id="number_phone_1" class="form-control" value="<?php echo !empty(trim($phones->number_phone_1)) ? trim($phones->number_phone_1) : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="area_code_2" class="col-sm-2 control-label"> Area Code 2 </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="area_code_2" id="area_code_2" class="form-control" value="<?php echo !empty(trim($phones->area_code_2)) ? trim($phones->area_code_2) : '' ?> " required />
			                </div>

			                <label for="ddd_2" class="col-sm-2 control-label"> DDD 2 </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="ddd_2" id="ddd_2" class="form-control" value="<?php echo !empty(trim($phones->ddd_2)) ? trim($phones->ddd_2) : '' ?> " />
			                </div>

			                <div class="col-sm-1"> </div>
			                <label for="number_phone_2" class="col-sm-2 control-label"> Number 2 </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="number_phone_2" id="number_phone_2" class="form-control" value="<?php echo !empty(trim($phones->number_phone_2)) ? trim($phones->number_phone_2) : '' ?> " />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="area_code_3" class="col-sm-2 control-label"> Area Code 3 </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="area_code_3" id="area_code_3" class="form-control" value="<?php echo !empty(trim($phones->area_code_3)) ? trim($phones->area_code_3) : '' ?> " required />
			                </div>

			                <label for="ddd_3" class="col-sm-2 control-label"> DDD 3 </label>
			                <div class="col-sm-1">                    
			                    <input type="text" name="ddd_3" id="ddd_3" class="form-control" value="<?php echo !empty(trim($phones->ddd_3)) ? trim($phones->ddd_3) : '' ?> " />
			                </div>

			                <div class="col-sm-1"> </div>
			                <label for="number_phone_3" class="col-sm-2 control-label"> Number 3 </label>
			                <div class="col-sm-3">                    
			                    <input type="text" name="number_phone_3" id="number_phone_3" class="form-control" value="<?php echo !empty(trim($phones->number_phone_3)) ? trim($phones->number_phone_3) : '' ?> " />
			                </div>
			            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('people') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_phones" name="id_phones" value="<?= !empty($id_phones) ? $id_phones : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	