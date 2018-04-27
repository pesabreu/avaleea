
<script type="text/javascript">      
    $(function() {
		var id_user_level = '<?php echo (isset($consult->id_user_level) ? $consult->id_user_level : 0)?>';            
    });        

    function valid() {
        return true;
    }       
</script>

<?php
    $this->session->set_userdata("ins_data", '0');
    $id_user_level = isset($consult->id_user_level) ? $consult->id_user_level : 0;
?>

<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li><a href="<?= base_url('userlevel')?>">User Access Level</a></li>
  
    <?php if ($id_user_level == 0): ?>
        <li class="active">New User Level </li>
    <?php else: ?>
        <li class="active">Edit User Level </li>
    <?php endif; ?>   
</ol>
  
<div id="tab_data_general" name="tab_data_general">	        
    <!-- Tab panes -->
    <div class="tab-content">        
        <div class="tab-pane  fade in active" id="data_general">           
           
            <div class="panel panel-primary " style="width:  99%; margin: 0 auto;" id="painel" name="painel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo ($id_user_level == 0) ? 'New' : 'Edit' ?> User Level </h3>
                </div>

                <div class="panel-body">   
                    <form class="form-horizontal" role="form" method="post" action="<?=base_url('userlevel/save_user_level')?>" id="form_dd" onsubmit="return valid()" />
            
                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label"> Level </label>
                            <div class="col-sm-1">
                                <input type="text"  value="<?php echo isset($consult->level) ? $consult->level : '' ?>" class="form-control" id="level" name="level" placeholder="nível" required />
                            </div>

                            <label for="code" class="col-sm-offset-5 col-sm-2 control-label">Level Code</label>
                            <div class="col-sm-2">
                                <input type="text" maxlength="20" min="4" value="<?php echo isset($consult->code) ? $consult->code : '' ?>" class="form-control" id="code" name="code" placeholder="Level Code" required />
                            </div>
                        </div>
                
                        <div class="form-group" >
                            <label for="description_user_level" class="col-sm-2 control-label">Description </label>
                            <div class="col-sm-10">
                                <input type="text"  value="<?php echo isset($consult->description_user_level) ? $consult->description_user_level : '' ?>" class="form-control" id="description_user_level" name="description_user_level" placeholder="Description User Level" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($consult->note) ? $consult->note : '' ?> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="subdata" name="subdata">Save</button>
                                <span style="float: right;"> <a href="<?= base_url('userlevel') ?>" class="btn btn-primary"> Return </a> </span>              
                            </div>
                        </div>          
                                            
                        <input type="hidden" name="id_user_level" id="id_user_level" value="<?php echo isset($id_user_level) ? $id_user_level : '0'; ?>" />                              
                    </form>      
                </div>                  
            </div>
        </div>
	</div>            
</div>
