
<script type="text/javascript">

    var id_industry = "<?php echo !empty($industry->id_industry) ? $industry->id_industry : 0 ?>";
        
    $(function() {            
        $("#msg_error").html('');
        $("#msg_error").hide();       
    })
 
    function valid(){
        var cont = 0;
        
        if (id_industry == 0 ) {
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
	$id_industry = isset($id_industry) ? $id_industry : 0;

    $require = "";
    if ($id_industry == 0) {
         $require = " required "; 
    } else {
    	$require = " readonly ";
	}
?>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('industry')?>">Industry</a></li>
  
    <?php if ($id_industry == 0): ?>
        <li class="active">New Industry</li>
    <?php else: ?>
        <li class="active">Edit Industry</li>
    <?php endif; ?>   
</ol>
   
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_industry == 0) ? 'New' : 'Edit' ?> Industry </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('industry/save_industry')?>" id="form_dd" onsubmit="return valid()" />		

			            <div class="form-group">
			                <label for="name_industry" class="col-sm-2 control-label"> Name </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="name_industry" id="name_industry" class="form-control" value="<?php echo !empty($industry->name_industry) ? $industry->name_industry : '' ?> " min="3" required />
			                </div>
			            </div>
			            
			            <div class="form-group">		                    
			                <label for="title_industry" class="col-sm-2 control-label"> Title </label>
			                <div class="col-sm-8">                    
			                    <input type="text" name="title_industry" id="title_industry" value="<?php echo !empty($industry->title_industry) ? $industry->title_industry : '' ?> " class="form-control" required />
			                </div>
		                </div>

			            <div class="form-group">
			                <label for="description_industry" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-10">                    
			                    <input type="text" name="description_industry" id="description_industry" class="form-control" value="<?php echo !empty($industry->description_industry) ? $industry->description_industry : '' ?> " min="3" />
			                </div>
			            </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea  id="note" name="note" class="form-control" rows="5"><?php echo isset($industry->note) ? $industry->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('industry') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_industry" name="id_industry" value="<?= !empty($id_industry) ? $id_industry : 0 ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	