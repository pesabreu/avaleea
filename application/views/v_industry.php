
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
		var id_industry = $('#filtro_id_industry').val();
		var name_industry = $('#filtro_name_industry').val();
		var title_industry = $('#filtro_title_industry').val();
		 
		if ( trim(id_industry) == '' &&
			 trim(name_industry) == '' &&
			 trim(title_industry) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Industry</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Industry Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Industry:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('industry/new_industry') ?>" class="btn btn-primary">New Industry </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Industry: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('industry/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_industry">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("industry/order/id_industry/$order") ?>"> Identify &nbsp; <?= ($field == 'id_industry' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("industry/order/name_industry/$order") ?>">&nbsp; Name &nbsp; <?= ($field == 'name_industry' ? $icon : '') ?>  </a> </th>                    
	                    <th> <a href="<?= base_url("industry/order/title_industry/$order") ?>"> Title &nbsp; <?= ($field == 'title_industry' ? $icon : '') ?>  </a> </th>                                          
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_industry) ? $id_industry : '' ?>" name="filtro_id_industry" id="filtro_id_industry" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($name_industry) ? $name_industry : '' ?>" name="filtro_name_industry" id="filtro_name_industry" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($title_industry) ? $title_industry : '' ?>" name="filtro_title_industry" id="filtro_title_industry" style="width: 100%;" class="form-control" /> </th>
                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px; onclick="return filter_valid();"">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('industry') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    
	                </tr>
	            </thead>
              
	            <tbody>                      
	                <?php foreach($consult->result() as $line): ?>        
	                <tr>
	                    <td> &nbsp; <?php echo str_pad($line->id_industry, 6, "0", STR_PAD_LEFT); ?></td>                 
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_industry(<?= $line->id_industry ?>)" title="click to see complete data"><?php echo $line->name_industry; ?> </a></td>                        
	                    <td> &nbsp; <?php echo $line->title_industry ?></td>                        

	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
								<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('industry/edit/'.$line->id_industry); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
								<td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('industry/delete/'.$line->id_industry); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id_industry; ?>','<?php echo $line->name_industry; ?>');">
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


<div class="modal fade" id="windowDataCompleteIndustry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_industry"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name_industry"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Title </td>
                                    <td><span id="title_industry"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Description </td>
                                    <td><span id="description_industry"></span> </td>                                            
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
            	<div id="link_edit_industry" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

