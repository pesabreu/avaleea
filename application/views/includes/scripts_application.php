


<script type="text/javascript">
  		
	var base_url = "<?= base_url()?>";
	
	$(document).ready(function(){

		$('#edit_application').hide();
		$('#view_application').hide();
		
		$('#selectApplication').change(function(event){		
			event.preventDefault();
			 					
			var sel = $("#selectApplication option:selected").val();										
			if (sel == "" || sel == null || sel == '#') {
				$('#edit_application').hide();
				$('#view_application').hide();
				$('#id_application').val(0);
			} else {
				$('#edit_application').show();
				$('#view_application').show();
				$('#id_application').val(sel);
			}				
		});	
		
		$('#btn_close_app, #btn_close_bottom').click(function(){
			//alert('Click btn_close_app ');
			//location.reload();
		});
		
	//	$('#formModalApplication_edit').on('show.bs.modal', function (e) {
	    	//alert('Vai Carregar Modal => 1 ==> ');
	//	});

		$('#formModalApplication_edit').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	var sel = $("#selectApplication option:selected").val();	    										
			//alert('sel => ' + sel);
			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_application').val() != 0) {			
				alert("Select a application, please !");
				$('#selectApplication').focus();
				return false;
			}			

			var text = 'Edit Application';
			if (sel == null || sel == 0 || sel == '#') {text = 'New Application';}
			$('#id_application').val(sel);
				
			$.ajax({             
		       type: "POST",
		       dataType : 'json',
		       data: { id_application:sel },             
		       url: base_url + "applicationq/return_application_client",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){	          			           					        	
					load_data_application(data, sel);
					$('#oper_application').html(text);
	       		},
			});
		});

		$('#edit_application').click(function(event){
			event.preventDefault();
			
	    	var sel = $("#selectApplication option:selected").val();
			//alert('edit => '+ sel);
			if (sel == null || sel == 0 || sel == '#') {			
				alert("Select a application");
				$('#selectApplication').focus();
				return false;
			}			

			$('#id_application').val(sel);
			$('#id_cfg_applicationp').val(sel);
		});

		$('#new_application').click(function(event){
			event.preventDefault();
			
			var sel = "";
			$('#id_application').val(0);
			$('#id_cfg_applicationp').val(0);
			
			 $("#selectApplication option:selected").each(function () {
               $(this).removeAttr('selected'); 
             });			
			
			load_data_application('', 0);
		});

		$('#view_application').click(function(event){
			event.preventDefault();
			
			var id = $("#selectApplication option:selected").val();
			var name = $("#selectApplication option:selected").text();
			$('#header_viewp').html('000' + id + ' - ' + name);			
		});		

		$('#formModalApplication_view').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	var sel = $("#selectApplication option:selected").val();
			$('#id_applicationv').val(sel);								
			//alert(sel);
				
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_application:sel },             
		       url: base_url + "applicationq/return_application_view",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){			        	
					$('#body_content').html(data);
	       		},
			});
		});

//		$('#btn_close, #btn_close_x').click(function(event){
		$('#formModalApplication_edit').on('hidden.bs.modal', function (e) {
			event.preventDefault();

			$('#id_application').val(0);
			$('#id_cfg_applicationp').val(0);
			load_data_application('', 0);

	    	var ret = "<h4 style='color: red;'> Save the Application to get your status updated</h4>";  
	    	$('#tab_3p').html(ret);			    													   			
		});

		$('#tab3p').click(function(){
			//alert('Click tab3 ');
			$("#btn_savep").css("display", "none");
			$("#btn_close").css("display", "none");			
		});
				
		$('#tab2p').click(function() {
			//alert('Click tab2 ');			
			$("#btn_savep").css("display", "block");
			$("#btn_closep").css("display", "block");						
		});

		$('#tab1p').click(function() {
			//alert('Click tab1 ');			
			$("#btn_savep").css("display", "block");
			$("#btn_closep").css("display", "block");						
		});

        $('#form_dd_Application').submit(function(event) {        	
        	event.preventDefault();
 
            var dados = $('#form_dd_Application').serialize();								
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'applicationq/save_application_author',
                data: dados,
                dataType: 'text',
		       	cache:false,				       
			   	async: true,				       
				success:
					function(data) {
			    		//alert('Ok save ==> '+ data);			  
			    		$('#tab_3p').html(data);
			    		$('#tab3p').click();		
					}
			});                
        	
        	return false;
        });


		// Invitations scripts

		$('#selectApplicationsi').change(function(event){		
			event.preventDefault();
			
	    	var sel = $("#selectApplicationsi option:selected").val();
			$('#id_applicationi').val(sel);

        	return false;
        });    	
			
		$('#selectCandidatesi').change(function(event){		
			event.preventDefault();

	    	var sel = $("#selectCandidatesi option:selected").val();
			$('#id_people_invitationi').val(sel);			
        	return false;
        });    	


		$('#formModalInvitationCandidates').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
/*
			$(':input','#form_dd_invitation')
			  .not(':button, :submit, :reset, :hidden')	  
			  .removeAttr('selected');
*/														
	       // $('#selectApplications option[value="0"]').attr({ selected : 'selected' });              			
//	        $('#selectApplications option[value=""]').attr({ selected : 'selected' });              

        	$('#message_invitation').html('');
        	return false;
        });    	

		$('#formModalInvitationCandidates').on('hidden.bs.modal', function (e) {
	    	event.preventDefault();
/*
			$(':input','#form_dd_invitation')
			  .not(':button, :submit, :reset, :hidden')
			  .removeAttr('selected');															
*/

//			alert('passou');
//	        $('#selectApplications option[value="0"]').attr({ selected : 'selected' });              			

        	$('#message_invitation').html('');
        	return false;
        });    	

        $('#form_dd_invitation').submit(function(event) {        	
        	event.preventDefault();
  	    	
	    	var sel = $("#selectApplicationsi option:selected").val();			
			//alert('app => '+sel);
			$('#id_applicationi').val(sel);			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_applicationi').val() != 0) {			
				alert('Select Application');
				return false;
			}
			
	    	var sel = $("#selectCandidatesi option:selected").val();
	    	$('#id_people_invitationi').val(sel);
			if ((sel == null || sel == 0 || sel == '#') && $('#id_people_invitationi').val() != 0) {			
				alert('Select Candidate');
				return false;
			}		
 
            var dados = $('#form_dd_invitation').serialize();								
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'invitations/sender_email_invitation/',
                data: dados,
                dataType: 'text',
		       	cache:false,				       
			   	async: true,				       
				success:
					function(data) {
			    		//alert('Ok invitation ==> '+ data);
			    		$('#message_invitation').html(data);			  
					}
			});                
        	
        	return false;
        });

	});
</script>

<script type="text/javascript">  		
	function valid_application() {
			
		var selectIndividualgroup = $('#selectIndividualgroup option:selected').val();
		var selectConfirmidpin = $('#selectConfirmidpin option:selected').val();
		var selectTolerance = $('#selectTolerance option:selected').val();
		var ret = 0;

		if (selectIndividualgroup == '') {
			ret = 1;
		} else if (selectConfirmidpin == '') {
			ret = 2;
		} else if (selectTolerance == '') {
			ret = 3;
		}

		if (ret > 0) {
			alert('There is missing setup information !');
			$('#tab2p').click();		
			return false;

		} else {		
			 return true;			 
		}
	}	  		
			
	function load_data_application(data, id) {		
//       	alert(' ==> load_data_application(data) <== ');
		var id_q = $('#id_application').val();
		
		if (id_q != null && id_q > 0 && id != '') {
			//  Application fields			
			$("#selectQuestionnariesp option:selected").each(function () {
			   $(this).removeAttr('selected'); 
			});			
			
			$.each(data.questionnaries, function(idx, val) {
				$.each(val, function(fields, value) {
					if (fields == "id_questionnaires") {
						//alert('id_questionnaries => ' + value);
			        	$('#selectQuestionnariesp option[value="' + parseInt(value) + '"]').attr({selected : 'selected'});              		
					}
				});
			});
	        $('#selectType option[value="' + data.id_application_type + '"]').attr({selected : 'selected'});              	
	        $('#selectApplicationmode option[value="' + data.id_application_mode + '"]').attr({selected : 'selected'});              
			
			$('#id_application').val(data.id);					
			$('#name_application').val(data.name_application);
			$('#title_application').val(data.title_application);
			$('#note').val(data.note);
					
			//  Setup Application fields
	        $('#selectIndividualgroup option[value="' + data.individual_group + '"]').attr({ selected : 'selected' });              
	        $('#selectConfirmidpin option[value="' + data.confirm_id_pin + '"]').attr({ selected : 'selected' });              
	        $('#selectTolerance option[value="' + data.tolerance + '"]').attr({ selected : 'selected' });              
	
			$('#dt_application').val(data.dt_application);
			$('#dt_finished').val(data.dt_finished);
			$('#quantity_evaluated').val(data.quantity_evaluated);
			$('#id_cfg_applicationp').val(data.id_cfg_application);
	
		} else {
			//alert('id_q =>' + id_q + ' - ' + id);
			var author = $('#authorp').val();
					
			$(':input','#form_dd_Aplication_select')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');															
						
			$(':input','#form_dd_Application')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');
			  
			$('#authorp').val(author);  						
			$('#authorpcfg').val(author);  						
			
			var data = new Date();
			var mes = data.getMonth()+1;
			if (mes < 10) {mes = '0' + mes};
			var dt = data.getFullYear() + '-' + mes + '-' + data.getDate()
			
			$('#dt_application').val(dt);
			$('#id_application').val(0);
			$('#id_cfg_applicationp').val(0);			
		}
	}
	
</script>


