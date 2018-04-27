

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
		var id_invitations = $('#filtro_id_invitations').val();
		var dt_invitations = $('#filtro_dt_invitations').val();
		var id_people_invitation = $('#filtro_id_people_invitation').val();
		var id_application = $('#filtro_id_application').val(); 
		 
		if ( trim(id_invitations) == '' &&
			 trim(dt_invitations) == '' &&
			 trim(id_people_invitation) == '' &&
			 trim(id_application) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active"> Invitations</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Invitations Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Image:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('invitations/new_invitations') ?>" class="btn btn-primary btn-sm">New Invitations </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total invitations: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('invitations/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_invitations">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("invitations/order/id_invitations/$order") ?>"> Identify &nbsp; <?= ($field == 'id_invitations' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("invitations/order/dt_invitations/$order") ?>"> Date &nbsp; <?= ($field == 'dt_invitations' ? $icon : '') ?>  </a> </th>	                    
	                    <th> <a href="<?= base_url("invitations/order/id_people_invitation/$order") ?>">&nbsp; Invitation &nbsp; <?= ($field == 'id_people_invitation' ? $icon : '') ?>  </a> </th>                                                              
	                    <th> <a href="<?= base_url("invitations/order/id_application/$order") ?>"> Application &nbsp; <?= ($field == 'id_application' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_invitations) ? $id_invitations : '' ?>" name="filtro_id_invitations" id="filtro_id_invitations" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($dt_invitations) ? $dt_invitations : '' ?>" name="filtro_dt_invitations" id="filtro_name_invitations" style="width: 100%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($id_people_invitation) ? $id_people_invitation : '' ?>" name="filtro_id_people_invitation" id="filtro_id_people_invitation" style="width: 100%;" class="form-control" /></th>
						<th> <input type="text" value="<?= isset($id_application) ? $id_application : '' ?>" name="filtro_id_application" id="filtro_id_application" style="width: 100%;" class="form-control" /> </th>
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;"
	                    					 onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('invitations') ?>" class="btn btn-default btn-xs" 
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
	                    <td> &nbsp; <?php echo $line->dt_invitations ?></td>
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_invitations(<?= $line->id ?>)" title="click to see complete data"><?php echo $line->name_invitation; ?> </a></td>	                    	                    
						<td> &nbsp; <?php echo $line->name_application ?></td>
							                                            
	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
	                    		<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('invitations/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
		                        <td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('invitations/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name_invitations; ?>');">
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


<div class="modal fade" id="windowDataCompleteinvitations" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_invitations"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Application </td>
                                    <td><span id="id_application"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Date </td>
                                    <td><span id="dt_invitations"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Invitation </td>
                                    <td><span id="id_people_invitation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Admin </td>
                                    <td><span id="id_people_admin"></span> </td>                                            
                                </tr>                               
                                <tr>                                    
                                    <td> Link </td>
                                    <td><span id="link_invitations"></span> </td>                                            
                                </tr>                               
                                <tr>                                    
                                    <td> Date Visited </td>
                                    <td><span id="dt_visited_link"></span> </td>                                            
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
                        </td>                                            
                    </tr>
                    
                </table>                
            </div>

            <div class="modal-footer">       
            	<div id="link_edit_invitations" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

