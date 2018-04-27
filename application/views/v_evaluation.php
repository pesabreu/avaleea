

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
		var id_evaluation = $('#filtro_id_evaluation').val();
		var id_questionnaries = $('#filtro_id_questionnaries').val();
		var name_evaluation = $('#filtro_name_evaluation').val();
		var id_people = $('#filtro_id_people').val(); 
		 
		if ( trim(id_evaluation) == '' &&
			 trim(id_questionnaries) == '' &&
			 trim(name_evaluation) == '' &&
			 trim(id_people) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Evaluation</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Evaluation Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Evaluation:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('evaluation/new_evaluation') ?>" class="btn btn-primary btn-sm">New Evaluation </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Evaluation: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('evaluation/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_evaluation">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("evaluation/order/id_evaluation/$order") ?>"> Identify &nbsp; <?= ($field == 'id_evaluation' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("evaluation/order/id_questionaries/$order") ?>"> Name Questionaries <?= ($field == 'id_questionaries' ? $icon : '') ?>  </a> </th>                                                              
	                    <th> <a href="<?= base_url("evaluation/order/id_people/$order") ?>"> Name People <?= ($field == 'id_people' ? $icon : '') ?>  </a> </th>
	                    <th> <a href="<?= base_url("evaluation/order/name_evaluation/$order") ?>"> Name Evaluation <?= ($field == 'name_evaluation' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_evaluation) ? $id_evaluation : '' ?>" name="filtro_id_evaluation" id="filtro_id_evaluation" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($id_questionaries) ? $id_questionaries : '' ?>" name="filtro_id_questionaries" id="filtro_id_questionaries" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($id_people) ? $id_people : '' ?>" name="filtro_id_people" id="filtro_id_people" style="width: 100%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($name_evaluation) ? $name_evaluation : '' ?>" name="filtro_name_evaluation" id="filtro_name_evaluation" style="width: 100%;" class="form-control" /> </th>                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('evaluation') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
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
	                    <td> &nbsp; <?php echo $line->name ?></td>	                    
						<td> &nbsp; <a href="javascript:;" onclick="data_complete_evaluation(<?= $line->id_evaluation ?>)" title="click to see complete data"><?php echo $line->name_evaluation; ?> </a></td>	                                            

	                    <td style="width: 10%;">
	                    	<table class="table table-responsive"> <tr>
	                    		<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('evaluation/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
		                        <td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('evaluation/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name_evaluation; ?>');">
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


<div class="modal fade" id="windowDataCompleteEvaluation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_evaluation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Application </td>
                                    <td><span id="id_application"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> People </td>
                                    <td><span id="id_people"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Questionnaries </td>
                                    <td><span id="id_questionnaries"></span> </td>                                            
                                </tr>                               
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name_evaluation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Date </td>
                                    <td><span id="dt_evaluation"></span> </td>                                            
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
            	<div id="link_edit_evaluation" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

