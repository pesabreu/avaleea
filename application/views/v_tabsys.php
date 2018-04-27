
<?php
	$tabsys = $this->session->userdata("tabsys");		
	$table_sys = $this->session->userdata("table_sys");					
	$this->session->set_userdata("origem", "1");
?>

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

		var id = $('#filtro_id').val();
		var code = $('#filtro_code').val();
		var desc = $('#filtro_desc').val(); 
		 
		if ( trim(id) == '' &&
			 trim(code) == '' &&
			 trim(desc) == ''  ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active"><?= ucfirst(title_table($tabsys)) ?></li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, code) {
		
		        if (!confirm("Do you really want to Delete:  '" + code + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('tabsys/new_tabsys/'.$table_sys.'/'.$tabsys.'/m') ?>" class="btn btn-primary" style="width: auto;">
            	New <?= ucfirst(title_table($tabsys)) ?> 
        	</a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total <?= title_table($tabsys) ?>: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('tabsys/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_<?= $tabsys ?>">                                
	            <thead>
	                <tr>
	                    <th style="width: 140px;">                                                        
	                        <a href="<?= base_url("tabsys/order/id/$order") ?>">&nbsp;&nbsp; Identify&nbsp; <?= ($field == 'id_'.$tabsys ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("tabsys/order/code/$order") ?>">&nbsp; Code &nbsp; <?= ($field == 'code_'.$tabsys ? $icon : '') ?>  </a> </th>                    
	                    <th> <a href="<?= base_url("tabsys/order/description/$order") ?>">&nbsp; Description &nbsp; <?= ($field == 'description_'.$tabsys ? $icon : '') ?>  </a> </th>                                          
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id) ? $id : '' ?>" name="filtro_id" id="filtro_id" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($code) ? $code : '' ?>" name="filtro_code" id="filtro_code" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($desc) ? $desc : '' ?>" name="filtro_desc" id="filtro_desc" style="width: 100%;" class="form-control" /> </th>

	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('tabsys') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    
	                </tr>
	            </thead>
              
	            <tbody>                      	            	
	                <?php foreach($consult->result() as $line): ?>        
		                <tr>
		                    <td> &nbsp; <?php echo str_pad($line->id, 6, "0", STR_PAD_LEFT); ?></td>                 
		                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_tabsys(<?= $line->id ?>)" 
		                    		title ="click to see complete data"><?php echo $line->code; ?> </a></td>                        
		                    <td> &nbsp; <?php echo $line->desc; ?></td>                       
		                                                                   
		                    <td style="width: 10%;" >
		                    	<table class="table table-responsive"> <tr>
		                    		<td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('tabsys/edit/'. $line->id.'/'.$table_sys.'/'.$tabsys.'/m') ?>" class="btn btn-info btn-xs">
				                        	Edit 
			                        	</a> 
			                        </td>		                        
			                        <td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('tabsys/delete/'.$line->id.'/'.$table_sys.'/'.$tabsys.'/d'); ?>" class="btn btn-danger btn-xs"  
				                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->code; ?>');">
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


<div class="modal fade" id="windowDataCompleteTabsys" name="windowDataCompleteTabsys" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td style="width: 120px;" > Identification &nbsp; </td>
                                    <td><span id="id"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Code </td>
                                    <td><span id="code"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Description </td>
                                    <td><span id="description"></span> </td>                                            
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
            	<div id="link_edit_tabsys" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

   
