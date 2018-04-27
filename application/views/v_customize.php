
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

		var id_customize = $('#filtro_id_customize').val();
		var id_questionnaries = $('#filtro_id_questionnaries').val();
		var description = $('#filtro_description_customize').val();
		var id_people = $('#filtro_id_people').val(); 
		 
		if ( trim(id_customize) == '' &&
			 trim(id_questionnaries) == '' &&
			 trim(description) == '' &&
			 trim(id_people) == '' ) {

				return false;
		} 
		//alert("passou !");
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active"> Customize</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Customize Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Customize:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('customize/new_customize') ?>" class="btn btn-primary btn-sm">New Customize </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Customize: <?php echo $total_consult; ?> </b>
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
		
        <form method="post" action="<?=base_url('customize/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
	            <table class="table table-hover" id="table_customize">                                
		            <thead>
		                <tr>
		                    <th style="width: 105px;">                                                        
		                        <a href="<?= base_url("customize/order/id_customize/$order") ?>"> Identify &nbsp; <?= ($field == 'id_customize' ? $icon : '') ?> </a> 
		                    </th>                        
		                    <th> <a href="<?= base_url("customize/order/id_questionnaries/$order") ?>">&nbsp; Questionnaries &nbsp; <?= ($field == 'id_questionnaries' ? $icon : '') ?>  </a> </th>                                                              
		                    <th> <a href="<?= base_url("customize/order/description_customize/$order") ?>"> Description &nbsp; <?= ($field == 'description_customize' ? $icon : '') ?>  </a> </th>
		                    <th> <a href="<?= base_url("customize/order/id_people/$order") ?>"> People &nbsp; <?= ($field == 'id_people' ? $icon : '') ?>  </a> </th>
		                    <th style="text-align: center">Action</th>                                                                                
		                </tr>
		                <tr>
		                    <th> <input type="text" value="<?= isset($id_customize) ? $id_customize : '' ?>" name="filtro_id_customize" id="filtro_id_customize" style="width: 80%;" class="form-control" /></th>                                                                    
		                    <th> <input type="text" value="<?= isset($id_questionnaries) ? $id_questionnaries : '' ?>" name="filtro_id_questionnaries" id="filtro_id_questionnaries" style="width: 100%;" class="form-control" /></th>
		                    <th> <input type="text" value="<?= isset($description_customize) ? $description_customize : '' ?>" name="filtro_description_customize" id="filtro_description_customize" style="width: 100%;" class="form-control" /> </th>
							<th> <input type="text" value="<?= isset($id_people) ? $id_people : '' ?>" name="filtro_id_people" id="filtro_id_people" style="width: 100%;" class="form-control" /> </th>
		                    <td style="text-align: center"> 
		                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;"
		                    					onclick="return filter_valid();" >
		                    		Filter 
	                    		</button> 
	                    		<br /> 
	                    		<a href="<?=base_url('customize') ?>" class="btn btn-default btn-xs" 
	                    				style="margin-bottom: 2px; margin-right: 3px;" />
	                    			Clear Filter 
	                			</a>
	            			</td>                                                                                                    
	
		                </tr>
		            </thead>
	              
		            <tbody>                      
		                <?php foreach($consult->result() as $line): ?>        
		                <tr>
		                    <td> &nbsp; <?php echo str_pad($line->id, 6, "0", STR_PAD_LEFT); ?></td>                                         	                    
		                    <td> &nbsp; <?php echo $line->name_questionnaries ?></td>
		                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_customize(<?= $line->id_customize ?>)" title="click to see complete data"><?php echo $line->description_customize; ?> </a></td>
		                    <td> &nbsp; <?php echo $line->name ?></td>	                    	                                                               
	
		                    <td style="width: 10%;" >
		                    	<table class="table table-responsive"> <tr>
		                    		<td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('customize/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
				                        	Edit 
			                        	</a> 
			                        </td>		                        
			                        <td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('customize/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
				                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->description_customize; ?>');">
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


<div class="modal fade" id="windowDataCompletecustomize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_customize"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Questionnaries </td>
                                    <td><span id="id_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> People </td>
                                    <td><span id="id_people"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Description </td>
                                    <td><span id="id_alternative_select"></span> </td>                                            
                                </tr>                               
                                <tr>                                    
                                    <td> Date </td>
                                    <td><span id="dt_customize"></span> </td>                                            
                                </tr>
                            </table>                                                        
                        </td>                                            
                    </tr>
                    
                    <tr>                   
                        <td colspan="2">                            
                            <table class="table_internal_1 table"   style="width: 100%;" border="0">                                
                                <tr>                                    
                                    <td  style="width: 21%;">Note</td>
                                     <td> <span id="note"></span> </td>
                                </tr>                                                                
                            </table>                            
                        </td>                        
                    </tr>                                        
                </table>                
            </div>

            <div class="modal-footer">       
            	<div id="link_edit_customize" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

