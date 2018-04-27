

<script type="text/javascript">

    var id_addresses = "<?php echo !empty($addresses->id_addresses) ? $addresses->id_addresses : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();        

        $('#list_people').focus();
        var id_people = '<?php echo (isset($addresses->id_people) ? $addresses->id_people : '')?>';            
        $('#list_people option[value="' + id_people + '"]').attr({ selected : "selected" });              
    })
 
    function valid(){
        var cont = 0;
        
        if (id_addresses == 0 ) {
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
	$id_addresses = isset($id_addresses) ? $id_addresses : 0;
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('people')?>">People</a></li>
    <li class="active">Edit Address</li>
   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_addresses == 0) ? 'New' : 'Edit' ?> addresses </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('people/save_address')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name" id="name" class="form-control" 
 									value="<?php echo !empty($addresses->name) ? $addresses->name : '' ?>" readonly />
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="public_place" class="col-sm-2 control-label"> Public Place </label>
			                <div class="col-sm-6">                    
			                    <input type="text" name="public_place" id="public_place" class="form-control" value="<?php echo !empty($addresses->public_place) ? $addresses->public_place : '' ?> " min="3" required />
			                </div>
			                
			                <div class="col-sm-1"> </div>

			                <label for="number" class="col-sm-2 control-label"> Number </label>
			                <div class="col-sm-1">                    
			                    <input type="number" name="number" id="number" class="form-control" value="<?php echo !empty($addresses->number) ? $addresses->number : '' ?> " maxlenght="8" />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="neighborhood" class="col-sm-2 control-label"> Neighborhood </label>
			                <div class="col-sm-5">                    
			                    <input type="text" name="neighborhood" id="neighborhood" value="<?php echo !empty($addresses->neighborhood) ? $addresses->neighborhood : '' ?> " class="form-control" />
			                </div>
			                
			                <div class="col-sm-1"> </div>

			                <label for="zipcode" class="col-sm-2 control-label"> ZipCode </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="zipcode" id="zipcode" value="<?php echo !empty($addresses->zipcode) ? $addresses->zipcode : '' ?> " class="form-control" />
			                </div>			                
		                </div>

			            <div class="form-group">
			                <label for="complement_1" class="col-sm-2 control-label"> 1o. Complement </label>
			                <div class="col-sm-8">                    
			                    <input type="text" name="complement_1" id="complement_1" class="form-control" value="<?php echo !empty($addresses->complement_1) ? $addresses->complement_1 : '' ?> " />
			                </div>			                
			            </div>

			            <div class="form-group">
			                <label for="complement_2" class="col-sm-2 control-label"> 2o. Complement </label>
			                <div class="col-sm-8">                    
			                    <input type="text" name="complement_2" id="complement_2" class="form-control" value="<?php echo !empty($addresses->complement_2) ? $addresses->complement_2 : '' ?> " />
			                </div>			                
			            </div>

			            <div class="form-group">
			                <label for="complement_3" class="col-sm-2 control-label"> 3o. Complement </label>
			                <div class="col-sm-8">                    
			                    <input type="text" name="complement_3" id="complement_3" class="form-control" value="<?php echo !empty($addresses->complement_3) ? $addresses->complement_3 : '' ?> " />
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
		                	                
		                <input type="hidden" id="id_addresses" name="id_addresses" value="<?= !empty($id_addresses) ? $id_addresses : 0 ?>" />                                                             
		                <input type="hidden" id="id_people" name="id_people" value="<?= !empty($addresses->id_people) ? $addresses->id_people : 0 ?>" />
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	