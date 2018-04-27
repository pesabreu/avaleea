
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

<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Modules</li>
</ol>

<script type="text/javascript">
	function filter_valid() {
		var id_modules = $('#filtro_id_modules').val();
		var id_industry = $('#filtro_id_industry').val();
		var name_modules = $('#filtro_name_modules').val();
		var subject = $('#filtro_subject').val(); 
		 
		if ( trim(id_modules) == '' &&
			 trim(id_industry) == '' &&
			 trim(name_modules) == '' &&
			 trim(subject) == '' ) {
				return false;
		} 
		return true;						
	}
</script>

    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Modules Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the modules:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('modules/new_module') ?>" class="btn btn-primary">New Module </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Modules: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('modules/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
	            <table class="table table-hover" id="table_modules">                                
		            <thead>
		                <tr>
		                    <th style="width: 105px;">                                                        
		                        <a href="<?= base_url("modules/order/id_modules/$order") ?>"> Identify &nbsp; <?= ($field == 'id_modules' ? $icon : '') ?> </a> 
		                    </th>                        
		                    <th> <a href="<?= base_url("modules/order/id_industry/$order") ?>">&nbsp; Industry &nbsp; <?= ($field == 'id_industry' ? $icon : '') ?>  </a> </th>                    
		                    <th> <a href="<?= base_url("modules/order/name_modules/$order") ?>"> Name &nbsp; <?= ($field == 'name_modules' ? $icon : '') ?>  </a> </th>                                          
		                    <th> <a href="<?= base_url("modules/order/subject/$order") ?>"> Subject &nbsp; <?= ($field == 'subject' ? $icon : '') ?>  </a> </th>
		                    <th style="text-align: center">Action</th>                                                                                
		                </tr>
		                <tr>
		                    <th> <input type="text" value="<?= isset($id_modules) ? $id_modules : '' ?>" name="filtro_id_modules" id="filtro_id_modules" style="width: 80%;" class="form-control" /></th>                                                                    
		                    <th> <input type="text" value="<?= isset($id_industry) ? $id_industry : '' ?>" name="filtro_id_industry" id="filtro_id_industry" style="width: 100%;" class="form-control" /></th>
		                    <th> <input type="text" value="<?= isset($name_modules) ? $name_modules : '' ?>" name="filtro_name_modules" id="filtro_name_modules" style="width: 100%;" class="form-control" /> </th>
		                    <th> <input type="text" value="<?= isset($subject) ? $subject : '' ?>" name="filtro_subject" id="filtro_subject" style="width: 100%;" class="form-control" /> </th>
	                                                                                                                                                                                                      
		                    <td style="text-align: center"> 
		                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();" >
		                    		Filter 
	                    		</button> 
	                    		<br /> 
	                    		<a href="<?=base_url('modules') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
	                    			Clear Filter 
	                			</a>
	            			</td>                                                                                                    
	
		                </tr>
		            </thead>
	              
		            <tbody>                      
		                <?php foreach($consult->result() as $line): ?>        
		                <tr>
		                    <td> &nbsp; <?php echo str_pad($line->id, 6, "0", STR_PAD_LEFT); ?></td>                                         
		                    <td> &nbsp; <?php echo $line->name_industry ?></td>
		                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_modules(<?= $line->id ?>)" title="click to see complete data"><?php echo $line->name_modules; ?> </a></td>	                    
		                    <td> &nbsp; <?php echo $line->subject ?></td>                        
	
		                    <td style="width: 10%;" >
		                    	<table class="table table-responsive"> <tr>
		                    		<td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('modules/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
				                        	Edit 
			                        	</a> 
			                        </td>		                        
			                        <td style="padding-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('modules/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
				                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name_modules; ?>');">
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


<div class="modal fade" id="windowDataCompleteModules" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_modules"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Industry </td>
                                    <td><span id="id_industry"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Academic Area </td>
                                    <td><span id="id_academic_area"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Disciplines </td>
                                    <td><span id="id_disciplines"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Situation </td>
                                    <td><span id="id_situation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name_modules"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Title </td>
                                    <td><span id="title_modules"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Description </td>
                                    <td><span id="description_modules"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Texto </td>
                                    <td><span id="text_modules"></span> </td>                                            
                                </tr>

                                <tr>                                    
                                    <td> Time </td>
                                    <td><span id="time_modules"></span> </td>                                            
                                </tr>                                                                                                                                                                                                                                
                                <tr>                                    
                                    <td> Subject </td>
                                    <td><span id="subject"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Theme </td>
                                    <td><span id="theme"></span> </td>                                            
                                </tr>                                                                                                
                                <tr>                                    
                                    <td> Scope </td>
                                    <td><span id="scope"></span> </td>                                            
                                </tr>                                                                                                
                            </table>                                                        
                        </td>                                            
                    </tr>

                </table>                
            </div>

            <div class="modal-footer">       
            	<div id="link_edit_modules" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

   




