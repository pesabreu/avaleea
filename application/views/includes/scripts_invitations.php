


<script type="text/javascript">
  		
	var base_url = "<?= base_url()?>";
	
	$(document).ready(function(){

		$('#start_invitation').hide();
		$('#view_invitation').hide();
		$('#list_questionnaires').hide();
		
		$('#selectInvitation').change(function(event){		
			event.preventDefault();
					 					
			var sel = $("#selectInvitation option:selected").val();										
			if (sel == "" || sel == null || sel == '#') {
				$('#start_invitation').hide();
				$('#view_invitation').hide();
				$('#list_questionnaires').hide();
				$('#id_application_inv').val(0);
				
			} else {
				$('#start_invitation').show();
				$('#view_invitation').show();
				$('#id_application_inv').val(sel);							
				
				//lert(sel);
				
				$.ajax({             
			       type: "POST",
			       dataType : 'html',
			       data: { id_application:sel },             
			       url: base_url + "applicationq/return_application_candidate",
			       cache:false,				       
				   async: true,
		           success: 
	           		function(data){	  
						$('#list_questionnaires').html(data);
						$('#list_questionnaires').show();
		       		},
				});
			}
		});	
		
		$('#btn_close_inv, #btn_close_bottom_inv').click(function(){
			//alert('Click btn_close_app ');
			//location.reload();
		});
		
		$('#start_invitation').click(function(event){
			event.preventDefault();
	    	
	    	var sel = $("#selectInvitation option:selected").val();
	    	var text = $("#selectInvitation option:selected").text();
			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_application_inv').val() != 0) {			
				alert("Select a application, please !");
				$('#selectInvitation').focus();
				return false;
			}			

			$('#id_application_inv').val(sel);								
			//alert( 'click -> '+ sel);				
		});
						
		$('#view_invitation').click(function(event){
			event.preventDefault();
			
			var sel = $("#selectInvitation option:selected").val();
			var name = $("#selectInvitation option:selected").text();
			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_application_inv').val() != 0) {			
				alert("Select a application, please !");
				$('#selectInvitation').focus();
				return false;
			}			

			$('#header_view_inv').html('000' + sel + ' - ' + name);			
		});		

		$('#formModalInvitationApplication_view').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	var sel = $("#selectInvitation option:selected").val();
			$('#id_application_inv').val(sel);								
			//alert(sel);
				
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_application:sel },             
		       url: base_url + "applicationq/return_data_candidate",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){			        	
					$('#body_content_inv').html(data);
	       		},
			});
		});

		$('#formModalAnswersQuestionnaires').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	$('#response_cand').hide();
	    	$('#btn_save_aqea').prop('disabled', false);
	    	
	    	var sel = $("#selectInvitation option:selected").val();
	    	var text = $("#selectInvitation option:selected").text();

			$('#id_application_inv').val(sel);								
			//alert(sel);
				
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_application:sel },             
		       url: base_url + "applicationq/return_questionnaire_candidate",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){	
           			//alert(data);		        	
					$('#form_answers_questionnaires').html(data);
					$('#id_application_cand').val(sel);	
					$('#name_application_cand').val(text);
	       		},
			});						
		});
		
        $('#form_dd_questionnaires_candidate').submit(function(event) {        	
        	event.preventDefault();
 
            var dados = $('#form_dd_questionnaires_candidate').serialize();											
// 			alert('Submit !!');
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'invitations/save_guest_application',
                data: dados,
                dataType: 'html',
		       	cache:false,				       
			   	async: true,				       
				success:
					function(data) {
			    		//alert('Ok save ==> '+ data);			  
						$('#response_cand').html(data);
						$('#response_cand').show();
					}
			});                
        	
        	return false;
        });

		$('#btn_save_aqea').click(function(event){
			event.preventDefault();

			alert('Clicou !!!');			
		});		

	});

</script>


