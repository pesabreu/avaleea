
<?php
	$tabsys = $this->session->userdata("tabsys");		
	$table_sys = $this->session->userdata("table_sys");					

	if (isset($tab_sys)) {
		$id = $tab_sys->id;
		$code = $tab_sys->code;
		$desc = $tab_sys->desc;
		$note = $tab_sys->note;			
	} else {
		$id = 0;
	}
	
	$this->session->set_userdata("origem", "1");			
//	echo $code ." - ". "$desc". "<br />";
//	exit();
?>

<script type="text/javascript">
    var id = "<?php echo !empty($id) ? $id : 0 ?>";
</script>
  
<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('tabsys/index/'.$table_sys.'/'.$tabsys.'/m')?>"> <?= ucfirst(title_table($tabsys)) ?> </a></li>
  
    <?php if ($id == 0): ?>
        <li class="active">New <?= ucfirst(title_table($tabsys)) ?> </li>
    <?php else: ?>
        <li class="active">Edit <?= ucfirst(title_table($tabsys)) ?> </li>
    <?php endif; ?>   
</ol>
 
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="panel-data" name="panel-data">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id == 0) ? 'New' : 'Edit' ?> <?= ucfirst(title_table($tabsys)) ?></h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('tabsys/save/'.$table_sys.'/'.$tabsys.'/m')?>" id="form_dd" onsubmit="return valid()" />
			            <div class="form-group">
			                <label for="code" class="col-sm-2 control-label"> Code </label>
			                <div class="col-sm-2">                    
			                    <input type="text" name="code" id="code" class="form-control" value="<?php echo !empty($code) ? $code : '' ?>" maxlength="20" min="4" required />
			                </div>		                
			            </div>
			            
			            <div class="form-group">
			                <label for="description" class="col-sm-2 control-label"> Description </label>
			                <div class="col-sm-8">                    
			                    <input type="text" name="description" id="description" value="<?php echo !empty($desc) ? $desc : '' ?>" class="form-control" required />
			                </div>	                
		                </div>
		                
                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label"> Note </label>
                            <div class="col-sm-10">
                                <textarea  id="note" name="note" class="form-control" rows="5"><?php echo isset($note) ? $note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> 
                                	<a href="<?= base_url('tabsys/index/'.$table_sys.'/'.$tabsys.'/m') ?>" class="btn btn-primary"> Return </a> 
                            	</span>              
							</div>
		                </div>
		                
		                <input type="hidden" id="id_tabsys" name="id_tabsys" value="<?= !empty($id) ? $id : '' ?>" />                                                             
		            </form>
            
            		<div class="alert alert-danger" id="msg_error" name="msg_error"></div>
      
                </div>                  
            </div>
        </div>
	</div>            
</div>   	