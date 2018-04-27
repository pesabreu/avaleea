

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
		var id_questions = $('#filtro_id_questions').val();
		var id_questionnaries = $('#filtro_id_questionnaries').val();
		var name_questions = $('#filtro_name_questions').val();
		var enunciation = $('#filtro_enunciation').val(); 
		 
		if ( trim(id_questions) == '' &&
			 trim(id_questionnaries) == '' &&
			 trim(name_questions) == '' &&
			 trim(enunciation) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Questions</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Questions Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Questions:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('questions/new_questions') ?>" class="btn btn-primary btn-sm">New Questions </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Questions: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('questions/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_questions">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("questions/order/id_questions/$order") ?>"> Identify &nbsp; <?= ($field == 'id_questions' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("questions/order/id_questionaries/$order") ?>"> Questionaries  <?= ($field == 'id_questionaries' ? $icon : '') ?>  </a> </th>                                                              
	                    <th> <a href="<?= base_url("questions/order/name_questions/$order") ?>"> Name &nbsp; <?= ($field == 'name_questions' ? $icon : '') ?>  </a> </th>
	                    <th> <a href="<?= base_url("questions/order/enunciation/$order") ?>"> Enunciation &nbsp; <?= ($field == 'enunciation' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_questions) ? $id_questions : '' ?>" name="filtro_id_questions" id="filtro_id_questions" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($id_questionaries) ? $id_questionaries : '' ?>" name="filtro_id_questionaries" id="filtro_id_questionaries" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($name_questions) ? $name_questions : '' ?>" name="filtro_name_questions" id="filtro_name_questions" style="width: 100%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($enunciation) ? $enunciation : '' ?>" name="filtro_enunciation" id="filtro_enunciation" style="width: 100%;" class="form-control" /> </th>                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px; onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('questions') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
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
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_questions(<?= $line->id ?>)" title="click to see complete data"><?php echo $line->name_questions; ?> </a></td>
	                    <td> &nbsp; <?php echo $line->enunciation ?></td>	                    
	                                            

	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
	                    		<td style="margin-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('questions/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
			                        	Edit 
		                        	</a> 
		                        </td>		                        
								<td style="padding-left: 5px; width: 48%;">
			                        <a href="<?php echo base_url('questions/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
			                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name_questions; ?>');">
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


<div class="modal fade" id="windowDataCompleteQuestions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_questions"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Questionnaries </td>
                                    <td><span id="id_questionnaries"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Alternatives Type </td>
                                    <td><span id="id_alternatives_type"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Name </td>
                                    <td><span id="name_questions"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Title </td>
                                    <td><span id="title_questions"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Enunciation </td>
                                    <td><span id="enunciation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Order </td>
                                    <td><span id="order_questionnaries"></span> </td>                                            
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
            	<div id="link_edit_questions" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

