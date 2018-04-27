
<script type="text/javascript">
    $(function(){
        $("#form_logo").ajaxForm({
            
            beforeSubmit: function() {                
                if ($('#userfile').val() === '') {                    
                    alert("Choose the image file before sending !");
                    return false;
                }                
            },
            success: function(data) {            
                $('#image').html("<img src='"+ data +"'>");            
            }             
        });
    });    
</script>

<ol class="breadcrumb">
    <li><a href="<?= base_url()?>">Home</a></li>
    <li class="active">Global Setup</li>
</ol>

<div>
  <!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#items_per_page" aria-controls="items_per_page" role="tab" data-toggle="tab">Pagination</a></li>
		<li role="presentation"><a href="#logo" aria-controls="logo" role="tab" data-toggle="tab">Logo</a></li>    
	</ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane  fade in active" id="items_per_page_setup">
        
            <div class="col-md-10" style="padding-top: 15px;">                    
                <form role="form" method="post" action="<?= base_url('setup/save')?>" id="form_items">
                    
                    <div class="form-group">
                        <label for="items_per_page"> Items per page (Pagination) </label>
                        <input type="text" name="items_per_page" id="items_per_page" class="form-control" value="<?php echo !empty($setup->items_per_page) ? $setup->items_per_page  : 5 ?>" style="width: 50px;" />                            
                    </div>

                    <div class="form-group">
                        <label for="folder_of_images"> Folder Images </label>
                        <input type="text" name="folder_of_images" id="folder_of_images" class="form-control" value="<?php echo !empty($setup->folder_of_images) ? $setup->folder_of_images : '' ?> "/>
                    </div>

                    <div class="form-group">
                        <label for="note" control-label> Note </label>
                        <textarea id="note" name="note" class="form-control" rows="5"><?php echo isset($setup->note) ? $setup->note : '' ?> </textarea>
                    </div>
   		                
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>                                               
	                <input type="hidden" id="id_setup" name="id_setup" value="<?= !empty($setup->id_setup) ? $setup->id_setup : 0 ?>" />                                                             

                </form>                    
            </div>

        </div>
        
        <div class="tab-pane fade" id="logo">        
            <div class="col-md-4" style="padding-top: 15px;">     
                <br />               
                <form role="form" method="post" action="<?= base_url('setup/save_logo')?>" id="form_logo" name="form_logo" enctype="multipart/form-data">                    
                    <?php echo isset($error) ? $error : '' ?>
                    <div class="form-group">
                        <label for="userfile"> Send Logo </label>
                        <input type="file" name="userfile" id="userfile" size="30" />
                    </div>
                    
                    <div id="image"> <img src="<?= $logo ?>" /> </div>
                    <br />
                    
                    <div class="form-group">
                        <input type="submit" value="Send File" class="btn btn-primary" class="form-control" />
                    </div>                                                                   
                </form>                    
            </div>
        </div>
                
    </div>

</div>