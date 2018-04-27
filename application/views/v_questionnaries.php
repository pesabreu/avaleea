
<style>
    #table_ie th {
        padding-bottom: 21px !important;        
    }
	.table_internal_1 td {
	    font-weight: bold;
	}	
	.table_internal_1 td span {
	    font-weight: normal;
	}
</style>


<script type="text/javascript">

	function filter_valid() {
		var id_questionnaries = $('#filtro_id_questionnaries').val();
		var questionnaries_type = $('#filtro_id_questionnaries_type').val();
		var id_modules = $('#filtro_id_modules').val();
		var name_questionnaries = $('#filtro_name_questionnaries').val(); 
		 
		if ( trim(id_questionnaries) == '' &&
			 trim(questionnaries_type) == '' &&
			 trim(id_modules) == '' &&
			 trim(name_questionnaries) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Questionnaries</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Questionnaries Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Questionnaries:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('questionnaries/new_questionnaries') ?>" class="btn btn-primary btn-sm">New questionnaries </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Questionnaries: <?php echo $total_consult; ?> </b>
        </p>

        <?php

            $field =  $this->session->userdata("field");        
            $order =  $this->session->userdata("order");
                        
            if ($order == 'desc') {
                $order = 'asc';
                $icon = '<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>';
            }
            else {
                $order = 'desc';
                $icon = '<span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>';                                                                        
            }                            
        ?>

        <form method="post" action="<?=base_url('questionnaries/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_questionnaries">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("questionnaries/order/id_questionnaries/$order") ?>"> Identify &nbsp; <?= ($field == 'id_questionnaries' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("questionnaries/order/id_questionnaries_type/$order") ?>">&nbsp; Type &nbsp; <?= ($field == 'id_questionnaries_type' ? $icon : '') ?>  </a> </th>                                                              
	                    <th> <a href="<?= base_url("questionnaries/order/id_modules/$order") ?>"> Modules &nbsp; <?= ($field == 'id_modules' ? $icon : '') ?>  </a> </th>
	                    <th> <a href="<?= base_url("questionnaries/order/name_questionnaries/$order") ?>"> Name &nbsp; <?= ($field == 'name_questionnaries' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_questionnaries) ? $id_questionnaries : '' ?>" name="filtro_id_questionnaries" id="filtro_id_questionnaries" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($id_questionnaries_type) ? $id_questionnaries_type : '' ?>" name="filtro_id_questionnaries_type" id="filtro_id_questionnaries_type" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($id_modules) ? $id_modules : '' ?>" name="filtro_id_modules" id="filtro_id_modules" style="width: 100%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($name_questionnaries) ? $name_questionnaries : '' ?>" name="filtro_name_questionnaries" id="filtro_name_questionnaries" style="width: 100%;" class="form-control" /> </th>                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px; onclick="return filter_valid();"">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('questionnaries') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    

	                </tr>
	            </thead>
              
	            <tbody>                      
	                <?php foreach($consult->result() as $line): ?>        
	                <tr>
	                    <td> &nbsp; <?php echo str_pad($line->id_questionnaries, 6, "0", STR_PAD_LEFT); ?></td>                                         	                    
	                    <td> &nbsp; <?php echo $line->code_questionnaries_type ?></td>
	                    <td> &nbsp; <?php echo $line->name_modules ?></td>	                    
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_questionnaries(<?= $line->id_questionnaries ?>)" title="click to see complete data"><?php echo $line->name_questionnaries; ?> </a></td>	                                            

	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
	                    		<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('questionnaries/edit/'.$line->id_questionnaries); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
								<td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('questionnaries/delete/'.$line->id_questionnaries); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id_questionnaries; ?>','<?php echo $line->name_questionnaries; ?>');">
			                        	Delete 
			                    	</a>
		                    	</td>
	                    	</tr> </table>		                    	
	                    </td>
	                </tr>
	                <?php endforeach; ?> 
	                    
	            </tbody>            
        	</table>
        	</div> 
    	</form>                        
        <div class="text-center">
        	<?php if(isset($pagination)) {echo $pagination;} ?>            
        </div>    
   
	</div>    
</div>


<div class="modal fade" id="windowDataCompleteQuestionnaries" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
                <h4 class="modal-title" id="myModalLabel">Complete Data</h4>                
            </div>
                
            <div class="modal-body" id="content_data_complete">             
                <table class="table-principal" style="width: 100%;">                    
                    <tr>                         
                        <td style="width: 50%;" valign="top">                            
                            <table class="table_internal_1 table" style="width: 100%;" cellpadding="5" cellspacing="3" border="0">                                
                                <tr>                                    
                                    <td style="width: 120px;" > Identify &nbsp; </td>
                                    <td><span id="id_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Type </td>
                                    <td><span id="id_questionnaries_type"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Module </td>
                                    <td><span id="id_modules"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Type Alternative </td>
                                    <td><span id="id_alternatives_type"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Title </td>
                                    <td><span id="title_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Description </td>
                                    <td><span id="description_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Instructions </td>
                                    <td><span id="instructions_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Owner </td>
                                    <td><span id="id_people"></span> </td>                                            
                                </tr>

                                <tr>                                    
                                    <td> Order </td>
                                    <td><span id="order_module_questionnaries"></span> </td>                                            
                                </tr>                                                                                                                                                                                                                                
                                <tr>                                    
                                    <td> Date Creation </td>
                                    <td><span id="dt_creation"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Level Type </td>
                                    <td><span id="id_level_type"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Series Semester	 </td>
                                    <td><span id="series_semester"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Situation </td>
                                    <td><span id="id_situation"></span> </td>                                            
                                </tr>                                                                                                
                            </table>                                                        
                        </td>                                            
                    </tr>

                </table>                
            </div>

            <div class="modal-footer">       
            	<div id="link_edit_questionnaries" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

