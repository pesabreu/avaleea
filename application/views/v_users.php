
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
		var id_users = $('#filtro_id_users').val();
		var id_people = $('#filtro_id_people').val();
		var login = $('#filtro_login').val();
		var id_user_level = $('#filtro_id_user_level').val(); 
		 
		if ( trim(id_users) == '' &&
			 trim(id_people) == '' &&
			 trim(login) == '' &&
			 trim(id_user_level) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Users</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - User Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the User:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('users/new_user') ?>" class="btn btn-primary">New User </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Users: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('users/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_users">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("users/order/id_users/$order") ?>">&nbsp;&nbsp; Id &nbsp; <?= ($field == 'id_users' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("users/order/id_people/$order") ?>">&nbsp; Name &nbsp; <?= ($field == 'id_people' ? $icon : '') ?>  </a> </th>                    
	                    <th> <a href="<?= base_url("users/order/login/$order") ?>">&nbsp; Login &nbsp; <?= ($field == 'login' ? $icon : '') ?>  </a> </th>                                          
	                    <th> <a href="<?= base_url("users/order/id_user_level/$order") ?>">&nbsp; Level &nbsp; <?= ($field == 'id_user_level' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_users) ? $id_users : '' ?>" name="filtro_id_users" id="filtro_id_users" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($name) ? $name : '' ?>" name="filtro_id_people" id="filtro_id_people"  style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($login) ? $login : '' ?>" name="filtro_login" id="filtro_login"  style="width: 80%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($level) ? $level : '' ?>" name="filtro_id_user_level" id="filtro_id_user_level"  style="width: 100%;" class="form-control" /> </th>
                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('users') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    

	                </tr>
	            </thead>
              
	            <tbody>                      
	                <?php foreach($consult->result() as $line): ?>        
	                <tr>
	                    <td> &nbsp; <?php echo str_pad($line->id_users, 6, "0", STR_PAD_LEFT); ?></td>                 
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_user(<?=$line->id_users ?>)" title ="click to see complete data"><?php echo $line->name_people; ?> </a></td>                        
	                    <td> &nbsp; <?php echo $line->login; ?></td>
	                    <td> &nbsp; <?php echo $line->code_level ?></td>                        

	                    <td style="width: 10%;">
	                    	<table class="table table-responsive"> <tr>
                    		<td style="margin-left: 5px; width: 48%;">
		                        <a href="<?php echo base_url('users/edit/'.$line->id_users); ?>" class="btn btn-info btn-xs">
		                        	Edit 
	                        	</a> 
	                        </td>		                        
	                        <td style="padding-left: 5px; width: 48%;">
	                        <a href="<?php echo base_url('users/delete/'.$line->id_users); ?>" class="btn btn-danger btn-xs"  
	                        	onclick="return confirm_delete('<?php echo $line->id_users; ?>','<?php echo $line->name; ?>');">
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


<div class="modal fade" id="windowDataCompleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_users"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Login </td>
                                    <td><span id="logi"></span> </td>                                            
                                </tr>

                                <tr>                                    
                                    <td> User Level </td>
                                    <td><span id="id_user_level"></span> </td>                                            
                                </tr>                                                                                                                                                                                                                                
                                <tr>                                    
                                    <td> Logged </td>
                                    <td><span id="logged"></span> </td>                                            
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
            	<div id="link_edit_user" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

   




