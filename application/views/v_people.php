
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

		var id_people = $('#filtro_id_people').val();
		var name = $('#filtro_name').val();
		var legal = $('#filtro_legal_identification').val();
		var physical = $('#filtro_physical_identification').val(); 
		 
		if ( trim(id_people) == '' &&
			 trim(name) == '' &&
			 trim(legal) == '' &&
			 trim(physical) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">People</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - People Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the People:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('people/new_people') ?>" class="btn btn-primary">New People </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total people: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('people/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_people">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("people/order/id_people/$order") ?>">Identify &nbsp; <?= ($field == 'id_people' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("people/order/name/$order") ?>">&nbsp; Name &nbsp; <?= ($field == 'name' ? $icon : '') ?>  </a> </th>                    
	                    <th> <a href="<?= base_url("people/order/legal_identification/$order") ?>">Id. Personal &nbsp; <?= ($field == 'legal_identification' ? $icon : '') ?>  </a> </th>                                          
	                    <th> <a href="<?= base_url("people/order/physical_identification/$order") ?>">Id. Legal &nbsp; <?= ($field == 'physical_identification' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_people) ? $id_people : '' ?>" name="filtro_id_people" id="filtro_id_people" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($name) ? $name : '' ?>" name="filtro_name" id="filtro_name" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($legal_identification) ? $legal_identification : '' ?>" name="filtro_legal_identification" id="filtro_legal_identification" style="width: 80%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($physical_identification) ? $physical_identification : '' ?>" name="filtro_physical_identification" id="filtro_physical_identification" style="width: 80%;" class="form-control" /> </th>
                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" 
	                    					onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('people') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    
	                </tr>
	            </thead>
              
	            <tbody>                      
	                <?php foreach($consult->result() as $line): ?>        
	                <tr>
	                    <td> &nbsp; <?php echo str_pad($line->id, 6, "0", STR_PAD_LEFT); ?></td>                 
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_people(<?= $line->id ?>)" title="click to see complete data"><?php echo $line->name; ?> </a></td>                        
	                    <td> &nbsp; <?php echo $line->physical_identification ?></td>
	                    <td> &nbsp; <?php echo $line->legal_identification ?></td>                        

	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
	                    		<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('people/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
		                        <td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('people/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name; ?>');">
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


<div class="modal fade" id="windowDataCompletePeople" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_people"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Type </td>
                                    <td><span id="type_people"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Categories </td>
                                    <td><span id="id_categories"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Occupation Area </td>
                                    <td><span id="id_occupation_area"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Fantasy Name </td>
                                    <td><span id="name_fantasy"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Id. Personal </td>
                                    <td><span id="legal_identification"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Id. Legal </td>
                                    <td><span id="physical_identification"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Birthday </td>
                                    <td><span id="dt_birthday"></span> </td>                                            
                                </tr>

                                <tr>                                    
                                    <td> City </td>
                                    <td><span id="city"></span> </td>                                            
                                </tr>                                                                                                                                                                                                                                
                                <tr>                                    
                                    <td> State </td>
                                    <td><span id="state"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Country </td>
                                    <td><span id="country"></span> </td>                                            
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
            	<div id="link_edit_people" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

   




