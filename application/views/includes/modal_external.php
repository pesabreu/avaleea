

<?php
//sleep(1);	
?>

<script type="text/javascript">	
	//$('#edit_questions').hide();
		
	//function store_questions(parm=0) {
		//$//('#id_questions').val(0);
		
  		$(document).ready(function(){
  			
  			$('#formModalOptions').modal('show')
  			
  			/*$('#selectQuestions').change(function(){
				var sel = $('#selectQuestions option:selected').val();
				if (sel == "" || sel == null || sel == '#') {
					$('#edit_questions').hide();
					$('#id_questions').val(0);
				} else {
					$('#edit_questions').show();
					$('#id_questions').val(sel);
				}				
  			});*/
  		});				
		return true;
	//}
</script>


			<!-- Modal -->
			<div class="modal fade" id="formModalOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <h3>Modal body text goes here.</h3>
        
      	
	                    <form class="form-horizontal" role="form" id="form_options" name="form_options" onsubmit="" />
		
			            	<div class="form-group">
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionMO" value="1"> Multiple Options
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionTF" value="2"> True and False
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionFG" value="3"> Fill in the Gaps
								</label>
								<label class="radio-inline">
							  		<input type="radio" name="selectOptions" id="optionRT" value="4"> Reply Text
								</label>
  						  	</div>
        				</form>
			      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


