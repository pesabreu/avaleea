	
	
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
			var id_user_level = $('#filtro_id_user_level').val();
			var code = $('#filtro_code').val();
			var level = $('#filtro_level').val(); 
			var description_user_level = $('#filtro_description_user_level').val();
			 
			if ( trim(id_user_level) == '' &&
				 trim(code) == '' &&
				 trim(level) == '' &&
				 trim(description_user_level) == '' ) {
					return false;
			} 
			return true;						
		}
	</script>
	
	
	<ol class="breadcrumb">
	    <li><a href="<?= base_url()?>">Home</a></li>
	    <li class="active">User Access Level </li>
	</ol>
	    
	<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->
	    <div class="panel-heading">
	        <h3 class="panel-title">Avaleea - User Level Registration</h3>
	    </div>
	
	    <div class="panel-body">
	        <script type="text/javascript">            
	            function confirm_delete(id_user_level, code) {
	
	                if (!confirm("Do you really want to Exclude this User Level:  '" + code + "'  ?") ) {
	                    return false;
	                }                
	                return true;
	            }            
	        </script>
	    
	        <p>
	            <a href="<?php echo base_url('userlevel/new_user_level') ?>" class="btn btn-primary">New User Level </a>
	        </p>
	
	        <p >
	           <b> Level Total: <?php echo $total_consult; ?> </b>
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
	
	        <form method="post" action="<?=base_url('userlevel/filter')?>" id="form_filter" class="form-horizontal">        
	        	<div class="form-group table-responsive">
		            <table class="table table-hover" id="table_user_level">                
		                <thead>
		                    <tr>
		                        <th style="width: 105px;">                                                        
		                            <a href="<?= base_url("user_level/order/id_user_level/$order") ?>">Identify &nbsp; <?= ($field == 'id_user_level' ? $icon : '') ?> </a> 
		                        </th>                        
		                        <th> <a href="<?= base_url("user_level/order/level/$order") ?>"> Level &nbsp; <?= ($field == 'code' ? $icon : '') ?>  </a> </th>                    
		                        <th> <a href="<?= base_url("user_level/order/code/$order") ?>"> Code &nbsp; <?= ($field == 'level' ? $icon : '') ?>  </a> </th>                        
		                        <th> <a href="<?= base_url("user_level/order/description_user_level/$order") ?>"> Description &nbsp; <?= ($field == 'description_user_level' ? $icon : '') ?>  </a> </th>                      
		                        <th style="text-align: center">Action</th>                                                                                
		                    </tr>
		                    <tr>
		                        <th> <input type="text" value="<?= isset($id_user_level) ? $id_user_level: '' ?>" name="filter_id_user_level" id="filter_id_user_level" style="width: 80%;" class="form-control" /></th>                                                                    
		                        <th> <input type="text" value="<?= isset($level) ? $level : '' ?>" name="filter_level" id="filter_level"  style="width: 100%;" class="form-control" /></th>
		                        <th> <input type="text" value="<?= isset($code) ? $code : '' ?>" name="filter_code" id="filter_code"  style="width: 20%;" class="form-control" /></th>
		                        <th> <input type="text" value="<?= isset($description_user_level) ? $description_user_level : '' ?>" name="filter_description_user_level" id="filter_description_user_level"  style="width: 100%;" class="form-control" /> </th>
		                                                                                                   
			                    <td style="text-align: center"> 
			                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();">
			                    		Filter 
		                    		</button> 
		                    		<br /> 
		                    		<a href="<?=base_url('userlevel') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
		                    			Clear Filter 
		                			</a>
		            			</td>                                                                                                    
		                    </tr>
		                </thead>
		                
		                <tbody>      
		                    
		                    <?php foreach($consult->result() as $line): ?>        
		                    <tr>
		                        <td> &nbsp; <?php echo str_pad( $line->id_user_level, 6, "0", STR_PAD_LEFT ); ?></td>                 
		                        <td> &nbsp; <?php echo str_pad( $line->code, 2, "0", STR_PAD_LEFT ); ?> </a></td>                        
		                        <td> &nbsp; &nbsp; <a href="javascript:;" onclick="data_complete_user_level(<?=$line->id_user_level ?>)" title ="click to see complete data"><?php echo str_pad( $line->level, 2, "0", STR_PAD_LEFT ); ?> </a></td>
		                        <td> &nbsp; <?php echo $line->description_user_level; ?></td>                        
		
			                    <td style="width: 10%; height: 30%;" >
			                    	<table class="table table-responsive"> <tr>
		                    		<td style="margin-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('userlevel/edit_user_level/'. $line->id_user_level) ?>" class="btn btn-info btn-xs">
				                        	Edit 
			                        	</a> 
			                        </td>		                        
			                        <td style="padding-left: 5px; width: 48%;">
				                        <a href="<?php echo base_url('userlevel/delete_user_level/'.$line->id_user_level); ?>" class="btn btn-danger btn-xs"  
				                        	onclick="return confirm_delete('<?php echo $line->id_user_level; ?>','<?php echo $line->code; ?>');">
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
	                <?php 
	                    if (isset($pagination)) {                    
	                        echo $pagination;
	                    }
	                ?>            
	        </div>    
	    
	    </div>
	</div>
	
	<div class="modal fade" id="windowDataCompleteUser_Level" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            
	            <div class="modal-header">                
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
	                <h4 class="modal-title" id="myModalLabel">Complete Data</h4>                
	            </div>
	                
	            <div class="modal-body" id="content_data_complete">             
	                <table class="tabela-principal" style="width: 100%;">                    
	                    <tr>
	                        
	                        <td style="width: 50%;" valign="top">                            
	                            <table class="table_internal_1 table" style="width: 100%;" cellpadding="5" cellspacing="3" border="0">                                
	                                <tr>                                    
	                                    <td style="width: 120px;" > Identifier &nbsp; </td>
	                                    <td><span id="id_user_level"></span> </td>                                            
	                                </tr>
	                                <tr>                                    
	                                    <td> Level </td>
	                                    <td><span id="level"></span> </td>                                            
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
	            	<div id="link_edit_user_level" style ="float: left;"></div>            	                    
	                <button type="button" class="btn btn-default" data-dismiss="modal">
	                	<span class="glyphicon glyphicon-remove"></span>
	                	Close
	            	</button>                    
	            </div>            
	                        
	        </div>               
	    </div>
	</div>
	
	       