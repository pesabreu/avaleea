
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

		var id_answers = $('#filtro_id_answers').val();
		var id_evaluation = $('#filtro_id_evaluation').val();
		var id_questions = $('#filtro_id_questions').val();
		var answers = $('#filtro_answers').val();
		 
		if ( trim(id_answers) == '' &&
			 trim(id_evaluation) == '' &&
			 trim(id_questions) == '' &&
			 trim(answers) == '' ) {
				return false;
		} 
		return true;						
	}
</script>


<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active"> Answers</li>
</ol>
    
<div class="panel panel-primary"> <!--style="width:  99%; margin: 0 auto;"> -->    
    <div class="panel-heading">
        <h3 class="panel-title">Avaleea - Answers Registration </h3>
    </div>

    <div class="panel-body">
        <script type="text/javascript">            
		    function confirm_delete(id, name) {
		
		        if (!confirm("Do you really want to Delete the Answers:  '" + name + "' ?? ") ) {
		            return false;
		        }	        
		        return true;
		    }                
        </script>
    
        <p>
            <a href="<?php echo base_url('answers/new_answers') ?>" class="btn btn-primary btn-sm">New Answers </a>
        </p>

        <p style="margin-top: 5px;">
           <b> Total Answers: <?php echo $total_consult; ?> </b>
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

        <form method="post" action="<?=base_url('answers/filter')?>" id="form_filter" class="form-horizontal"> 
        	<div class="form-group table-responsive">       
            <table class="table table-hover" id="table_answers">                                
	            <thead>
	                <tr>
	                    <th style="width: 105px;">                                                        
	                        <a href="<?= base_url("answers/order/id_answers/$order") ?>"> Identify &nbsp; <?= ($field == 'id_answers' ? $icon : '') ?> </a> 
	                    </th>                        
	                    <th> <a href="<?= base_url("answers/order/id_evaluation/$order") ?>">&nbsp; Evaluation &nbsp; <?= ($field == 'id_evaluation' ? $icon : '') ?>  </a> </th>                                                              
	                    <th> <a href="<?= base_url("answers/order/id_questions/$order") ?>"> Issue &nbsp; <?= ($field == 'id_questions' ? $icon : '') ?>  </a> </th>
	                    <th> <a href="<?= base_url("answers/order/answers/$order") ?>"> Answers &nbsp; <?= ($field == 'answers' ? $icon : '') ?>  </a> </th>
	                    <th style="text-align: center">Action</th>                                                                                
	                </tr>
	                <tr>
	                    <th> <input type="text" value="<?= isset($id_answers) ? $id_answers : '' ?>" name="filtro_id_answers" id="filtro_id_answers" style="width: 80%;" class="form-control" /></th>                                                                    
	                    <th> <input type="text" value="<?= isset($id_evaluation) ? $id_evaluation : '' ?>" name="filtro_id_evaluation" id="filtro_id_evaluation" style="width: 100%;" class="form-control" /></th>
	                    <th> <input type="text" value="<?= isset($id_questions) ? $id_questions : '' ?>" name="filtro_id_questions" id="filtro_id_questions" style="width: 100%;" class="form-control" /> </th>
	                    <th> <input type="text" value="<?= isset($answers) ? $answers : '' ?>" name="filtro_answers" id="filtro_answers" style="width: 100%;" class="form-control" /> </th>                                                                                                                                                                                                      
	                    <td style="text-align: center"> 
	                    	<button class="btn btn-success btn-xs" style="margin-bottom: 2px;" onclick="return filter_valid();">
	                    		Filter 
                    		</button> 
                    		<br /> 
                    		<a href="<?=base_url('answers') ?>" class="btn btn-default btn-xs" style="margin-bottom: 2px; margin-right: 3px;" />
                    			Clear Filter 
                			</a>
            			</td>                                                                                                    

	                </tr>
	            </thead>
              
	            <tbody>                      
	                <?php foreach($consult->result() as $line): ?>        
	                <tr>
	                    <td> &nbsp; <?php echo str_pad($line->id, 6, "0", STR_PAD_LEFT); ?></td>                                         	                    
	                    <td> &nbsp; <?php echo str_pad($line->id_evaluation, 6, "0", STR_PAD_LEFT); ?></td>
	                    <td> &nbsp; <?php echo $line->name_questions ?></td>
	                    <td> &nbsp; <a href="javascript:;" onclick="data_complete_answers(<?= $line->id_answers ?>)" title="click to see complete data"><?php echo $line->answers; ?> </a></td>	                    	                    
	                                            
	                    <td style="width: 10%;" >
	                    	<table class="table table-responsive"> <tr>
                    		<td style="margin-left: 5px; width: 48%;">
		                        <a href="<?php echo base_url('answers/edit/'.$line->id); ?>" class="btn btn-info btn-xs">
		                        	Edit 
	                        	</a> 
	                        </td>		                        
	                        <td style="padding-left: 5px; width: 48%;">
	                        <a href="<?php echo base_url('answers/delete/'.$line->id); ?>" class="btn btn-danger btn-xs"  
	                        	onclick="return confirm_delete('<?php echo $line->id; ?>','<?php echo $line->name_answers; ?>');">
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


<div class="modal fade" id="windowDataCompleteAnswers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <td><span id="id_answers"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Evaluation </td>
                                    <td><span id="id_evaluation"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> questions </td>
                                    <td><span id="id_questions"></span> </td>                                            
                                </tr>
                                <tr>                                    
                                    <td> Alternative Select </td>
                                    <td><span id="id_alternative_select"></span> </td>                                            
                                </tr>                               
                                <tr>                                    
                                    <td> Answers </td>
                                    <td><span id="answers"></span> </td>                                            
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
            	<div id="link_edit_answers" style ="float: left;"></div>             
                <button type="button" class="btn btn-default" data-dismiss="modal">
                	<span class="glyphicon glyphicon-remove"></span>
                	Close
            	</button>                    
            </div>            
                        
        </div>               
    </div>
</div>

