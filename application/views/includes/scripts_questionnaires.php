


<script type="text/javascript">
  		
	var base_url = "<?= base_url()?>";
	
	$(document).ready(function(){

		$('#edit_questionnaire').hide();
		$('view_questionnaire').hide();
		
		$('#selectQuestionnaries').change(function(event){		
			event.preventDefault();
			 					
			var sel = $("#selectQuestionnaries option:selected").val();										
			if (sel == "" || sel == null || sel == '#') {
				$('#edit_questionnaire').hide();
				$('view_questionnaire').hide();
				$('#id_questionnaries').val(0);								
			} else {
				$('#edit_questionnaire').show();
				$('view_questionnaire').show();
				$('#id_questionnaries').val(sel);								
			}
        	
        	return false;
		});	
		
		$('#formModalQuestionnaires_edit').on('show.bs.modal', function (e) {
	    	//alert('Vai Carregar Modal => 1 ==> ');        	
        	return false;
		});

		$('#formModalQuestionnaires_edit').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	var sel = $("#selectQuestionnaries option:selected").val();
			if ((sel == null || sel == 0 || sel == '#') && $('#id_questionnaries').val() != 0) {			
				alert("Select a Questionnaires, please !");
				$('#selectQuestionnaries').focus();
				return false;
			}			

			$('#id_questionnaries').val(sel);								
			var text = 'Edit Questionnaires';
			if (sel == null || sel == 0 || sel == '#') {text = 'New Questionnaires';}
				
			$.ajax({             
		       type: "POST",
		       dataType : 'json',
		       data: { id_questionnaries:sel },             
		       url: base_url + "questionnaries/return_questionnarie_client",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){			        	
					load_data_questionnaire(data, sel);
					$('#oper_questionnaries').html(text);
	       		},
			});
        	
        	return false;
		});

		$('#edit_questionnaire').click(function(event){
			event.preventDefault();
			
	    	var sel = $("#selectQuestionnaries option:selected").val();
			//alert('edit => '+ sel);
			if (sel == null || sel == 0 || sel == '#') {			
				alert("Select a questionnaire");
				$('#selectQuestionnaries').focus();
				return false;
			}			

			$('#id_questionnaries').val(sel);
			$('#id_questionnariesq').val(sel);
			$('#id_cfg_questionnaries').val(sel);
        	
        	return false;
		});

		$('#new_questionnaire').click(function(event){
			event.preventDefault();
			
			var sel = "";
			$('#id_questionnaries').val(0);
			$('#id_cfg_questionnaries').val(0);
			
			$("#selectQuestionnaries option:selected").each(function () {
			   $(this).removeAttr('selected'); 
			});			
			
			load_data_questionnaire('', 0);
        	
        	return false;
		});

		$('#view_questionnaire').click(function(event){
			event.preventDefault();
			
			var id = $("#selectQuestionnaries option:selected").val();
			var name = $("#selectQuestionnaries option:selected").text();
			$('#header_view').html('000' + id + ' - ' + name);			
        	
        	return false;
		});		

		$('#formModalQuestionnaires_view').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();
	    	
	    	var sel = $("#selectQuestionnaries option:selected").val();
			$('#id_questionnariesv').val(sel);								
			//alert(sel);
				
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_questionnaries:sel },             
		       url: base_url + "questionnaries/return_questionnarie_view",
		       cache:false,				       
			   async: true,
	           success: 
           		function(data){			        	
					$('#body_content').html(data);
	       		},
			});
        	
        	return false;
		});

//		$('#btn_close, #btn_close_x').click(function(event){
		$('#formModalQuestionnaires_edit').on('hidden.bs.modal', function (e) {
			event.preventDefault();
			
			var sel = "";
			$('#id_questionnaries').val(0);
			$('#id_cfg_questionnaries').val(0);
			load_data_questionnaire('', 0);
			
	    	var ret = "<h4 style='color: red;'> Save the Questionnaire to get your status updated</h4>";  
	    	$('#tab_3').html(ret);	
	    	$('#tab_3').click();		    													   			
        	
        	return false;
		});
		
		$('#tab3').click(function(){
			//alert('Click tab3 ');
			$("#btn_save").css("display", "none");
			$("#btn_close").css("display", "none");			
        	
        	return false;
		});
				
		$('#tab2').click(function() {
			//alert('Click tab2 ');			
			$("#btn_save").css("display", "block");
			$("#btn_close").css("display", "block");						
        	
        	return false;
		});

		$('#tab1').click(function() {
			//alert('Click tab1 ');			
			$("#btn_save").css("display", "block");
			$("#btn_close").css("display", "block");						
        	
        	return false;
		});

        $('#form_dd').submit(function(event) {        	
        	event.preventDefault();
 
            var dados = $('#form_dd').serialize();								
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'questionnaries/save_questionnaire_author',
                data: dados,
                dataType: 'text',
		       cache:false,				       
			   async: true,				       

			}).done(function(resposta) {
			    //alert('Ok save ==> '+ resposta);			  
			    $('#tab_3').html(resposta);
			    $('#tab3').click();
		
			}).fail(function(jqXHR, textStatus ) {
			    alert("Request failed save: " + textStatus + ' '+ jqXHR);			
			}).always(function(resposta) {
			   // alert("completou save" + resposta);    				                
            });                
        	
        	return false;
        });


//  	Questions        

		//$('#edit_questions').hide();
		
		$('#selectQuestions').change(function(event){		
			event.preventDefault();
			 					
			var sel = $("#selectQuestions option:selected").val();			
//			alert(sel);
													
			if (sel == "" || sel == null || sel == '#') {
				$('#edit_questions').hide();
				$('#id_questions').val(0);
			} else {
				$('#edit_questions').show();
				$('#id_questions').val(sel);
			}
			
			return false;				
		});	

//		$('#open_questions').click(function(event){ 					
		$('#formModalQuestions').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();			
			
			var id = $('#id_questionnaries').val();
			var name = $('#name_questionnaries').val();
			
			if (id == null || id == 0 || id == ' ') {			
				alert("Select a Questionnaires, please !");
				return false;
			}			
			
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_questionnaries:id },             
		       url: base_url + "questions/return_questions_questionnaires",
		       cache:false,				       
			   async: true,
				success: function(data){
					//alert(data);
					$('#select_question').html(data);
					$('#title_questionnaries_q').val(name);
				},
			});	
        	
        	return false;
		});		

		//$('#selectQuestions').change(function(){
		//$('#edit_questions').click(function(event){
			
		$('#formModalQuestions_edit').on('shown.bs.modal', function(event) {	    	
			event.preventDefault();
			 					
			var sel = $("#selectQuestions option:selected").val();			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_questions').val() != 0) {			
				alert("Select a Questions, please !");
				$('#selectQuestions').focus();
				return false;
			}			
		
			$('#id_questions').val(sel);
			$('#id_cfg_questions').val(sel);								
			var text = 'Edit Questions';
			if (sel == null || sel == 0 || sel == '#') {text = 'New Questions';}
//			alert('show que edit');
				
			$.ajax({             
		       type: "POST",
		       dataType : 'json',
		       data: { id_questions:sel },             
		       url: base_url + "questions/return_questions_client",
		       cache:false,				       
			   async: true,
				success: function(data){
					//console.log(data);
					//alert(data.title_questions);					
					load_data_questions(data, sel);
					$('#oper_questions').html(text);
				},
			});														
        	
        	return false;
		});

		$('#new_questions').click(function(event){
			event.preventDefault();
			
			var sel = "";
			$('#id_questions').val(0);
			$('#id_cfg_questions').val(0);			

			load_data_questions('', 0);
        	
        	return false;
		});

		$('#edit_questions').click(function(event){
			event.preventDefault();
			
	    	var sel = $("#selectQuestions option:selected").val();
			//alert('edit => '+ sel);
			if (sel == null || sel == 0 || sel == '#') {						
				alert("Select a questions");
				$('#selectQuestions').focus();
				return false;
			} 			
			$('#id_questions').val(sel);
			$('#id_cfg_questions').val(sel);						
        	
        	return false;
		});
		
//		$('#btn_closeq, #btn_close_xq').click(function(event){
		$('#formModalQuestions_edit').on('hidden.bs.modal', function (e) {
			event.preventDefault();
			
			var sel = "";
			$('#id_questions').val(0);
			$('#id_cfg_questions').val(0);

			var idq = $('#id_questionnaries').val();
			$('#id_questionnariesq').val(idq);

		    var ret = "<h4 style='color: red;'> Save the Questions to get your status updated</h4>";  
		    $('#tab_3q').html(ret);			    
        	
        	return false;
		});
		
		$('#tab3q').click(function(){
			//alert('Click tab3 ');
			$("#btn_saveq").css("display", "none");
			$("#btn_closeq").css("display", "none");			
        	
        	return false;
		});
				
		$('#tab2q').click(function() {
			//alert('Click tab2 ');			
			$("#btn_saveq").css("display", "block");
			$("#btn_closeq").css("display", "block");						
        	
        	return false;
		});

		$('#tab1q').click(function() {
			//alert('Click tab1 ');			
			$("#btn_saveq").css("display", "block");
			$("#btn_closeq").css("display", "block");						
        	
        	return false;
		});

        $('#form_dd_question_edit').submit(function(event) {        	
        	event.preventDefault();
 
            var dados = $('#form_dd_question_edit').serialize();
 			//alert(dados);
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'questions/save_questions_author',
                data: dados,
                dataType: 'text',
		       cache:false,				       
			   async: true,				       

			}).done(function(resposta) {
			    //alert('Ok save ==> '+ resposta);			  
			    $('#tab_3q').html(resposta);
			    $('#tab3q').click();
		
			}).fail(function(jqXHR, textStatus ) {
			    alert("Request failed save: " + textStatus + ' '+ jqXHR);			
			}).always(function(resposta) {
			   // alert("completou save" + resposta);    				                
            });                
        	
        	return false;
        });


//  	Alternatives        

		$('#edit_alternatives').hide();

		$('#selectAlternatives').change(function(event){		
			event.preventDefault();
			 					
			var sel = $("#selectAlternatives option:selected").val();										
			if (sel == "" || sel == null || sel == '#') {
				$('#edit_alternatives').hide();
				$('#id_alternatives').val(0);
			} else {
				$('#edit_alternatives').show();
				$('#id_alternatives').val(sel);
			}
        	
        	return false;
		});	

//		$('#open_alternatives').click(function(event){ 					
		$('#formModalAlternatives').on('shown.bs.modal', function(event) {	    	
	    	event.preventDefault();			
			var id = $('#id_questions').val();			
			var name = $('#title_questionnariesq').val();
			var nameq = $('#name_questions').val();
			
			if (id == null || id == 0 || id == ' ') {			
				alert("Select a questions, please !");
				return false;
			}			
			
			$.ajax({             
		       type: "POST",
		       dataType : 'html',
		       data: { id_questions:id },             
		       url: base_url + "alternatives/return_alternatives_questions",
		       cache:false,				       
			   async: true,
				success: function(data){
					//alert(data);
					$('#select_alternative').html(data);
					$('#title_questionnaries_a').val(name);
					$('#title_questions_a').val(nameq);
				},
			});	
        	
        	return false;
		});
			
		$('#formModalAlternatives_edit').on('shown.bs.modal', function(event) {	    	
			event.preventDefault();
			 					
			var sel = $("#selectAlternatives option:selected").val();			
			
			if ((sel == null || sel == 0 || sel == '#') && $('#id_alternatives').val() != 0) {			
				alert("Select a Alternatives, please !");
				$('#selectAlternatives').focus();
				return false;
			}			

			$('#id_alternatives').val(sel);								
			var text = 'Edit Alternatives';
			if (sel == null || sel == 0 || sel == '#') {text = 'New Alternatives';}

			$.ajax({             
		       type: "POST",
		       dataType : 'json',
		       data: { id_alternatives:sel },             
		       url: base_url + "alternatives/return_alternatives_client",
		       cache:false,				       
			   async: true,
				success: function(data){
						console.log(data);
					//alert(data);
					load_data_alternatives(data, sel);
					$('#oper_alternatives').html(text);
				},
			});														
        	
        	return false;
		});

		$('#edit_alternatives').click(function(event){
			event.preventDefault();
			
	    	var sel = $("#selectAlternatives option:selected").val();
			//alert('edit => '+ sel);
			if (sel == null || sel == 0 || sel == '#') {			
				alert("Select a alternative");
				$('#selectAlternatives').focus();
				//return false;
			}			
        	
        	return false;
		});

		$('#new_alternatives').click(function(event){
			event.preventDefault();
			
			var sel = "";
			$('#id_alternatives').val(0);
			
			load_data_alternatives('', 0);
        	
        	return false;
		});

//		$('#btn_closea, #btn_close_xa').click(function(event){
		$('#formModalAlternatives_edit').on('hidden.bs.modal', function (e) {
			event.preventDefault();
			
			var sel = "";
			$('#id_alternatives').val(0);
			
		    var ret = "<h4 style='color: red;'> Save the Alternatives to get your status updated</h4>";  
		    $('#tab_3a').html(ret);			    
        	
        	return false;
		});
		
		$('#tab3a').click(function(){
			//alert('Click tab3 ');
			$("#btn_savea").css("display", "none");
			$("#btn_closea").css("display", "none");			
        	
        	return false;
		});
/*				
		$('#tab2a').click(function() {
			//alert('Click tab2 ');			
			$("#btn_savea").css("display", "block");
			$("#btn_closea").css("display", "block");						
		});
*/
		$('#tab1a').click(function() {
			//alert('Click tab1 ');			
			$("#btn_savea").css("display", "block");
			$("#btn_closea").css("display", "block");						
        	
        	return false;
		});

        $('#form_dd_alternative').submit(function(event) {        	
        	event.preventDefault();
 
            var dados = $('#form_dd_alternative').serialize();
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'alternatives/save_alternatives_author',
                data: dados,
                dataType: 'text',
		       cache:false,				       
			   async: true,				       

			}).done(function(resposta) {
			    //alert('Ok save ==> '+ resposta);			  
			    $('#tab_3a').html(resposta);
			    $('#tab3a').click();
		
			}).fail(function(jqXHR, textStatus ) {
			    alert("Request failed save: " + textStatus + ' '+ jqXHR);			
			}).always(function(resposta) {
			   // alert("completou save" + resposta);    				                
            });                
        	
        	return false;
        });

	});
</script>

<script type="text/javascript">  		
	function valid() {
			
		var selectWhocustomize = $('#selectWhocustomize option:selected').val();
		var selectFormmarket = $('#selectFormmarket option:selected').val();
		var selectPresentationtype = $('#selectPresentationtype option:selected').val();
		var selectAllowsinterrupt = $('#selectAllowsinterrupt option:selected').val();
		var selectAllowsnavigate = $('#selectAllowsnavigate option:selected').val();
		var selectMandatoryanswers = $('#selectMandatoryanswers option:selected').val();		
		var selectFlowissues = $('#selectFlowissues option:selected').val();
		var ret = 0;

		if (selectWhocustomize == '') {
			ret = 1;
		} else if (selectFormmarket == '') {
			ret = 2;
		} else if (selectPresentationtype == '') {
			ret = 3;
		} else if (selectAllowsinterrupt == '') {
			ret = 4;
		} else if (selectAllowsnavigate == '') {
			ret = 5;
		} else if (selectMandatoryanswers == '') {
			ret = 6;
		} else if (selectFlowissues == '') {
			ret = 7;
		}

		if (ret > 0) {
			alert('There is missing setup information !');
			$('#tab2').click();		
			return false;

		} else {		
			 return true;			 
		}
	}	  		

	function valid_questions() {
			
		var selectAlternativestype = $('#selectAlternativestype option:selected').val();
		var selectSituation = $('#selectSituation option:selected').val();
		var selectPresentationtype = $('#selectPresentationtype option:selected').val();
		var selectAllowsmodifyresponse = $('#selectAllowsmodifyresponse option:selected').val();
		var selectWeight = $('#selectWeight option:selected').val();
		var selectMandatoryanswers = $('#selectMandatoryanswers option:selected').val();		
		var selectEditable = $('#selectEditable option:selected').val();
		var ret = 0;

		if (selectAlternativestype == '') {
			ret = 1;
		} else if (selectSituation == '') {
			ret = 2;
		} else if (selectPresentationtype == '') {
			ret = 3;
		} else if (selectAllowsmodifyresponse == '') {
			ret = 4;
		} else if (selectWeight == '') {
			ret = 5;
		} else if (selectMandatoryanswers == '') {
			ret = 6;
		} else if (selectEditable == '') {
			ret = 7;
		}

		if (ret > 0) {
			alert('There is missing setup information !');
			$('#tab2q').click();		
			return false;

		} else {		
			 return true;			 
		}
	}  		

	function valid_alternatives() {
		return true;		
	}
			
	function load_data_questionnaire(data, id) {		
//       	alert(' ==> load_data_questionnaire(data) <== ');
			//alert('id =>' + id);
		var id_q = $('#id_questionnaries').val();
		
		if (id_q != null && id_q > 0) {
			//  Questionnaires fields
	        $('#selectType option[value="' + data.id_questionnaries_type + '"]').attr({ selected : 'selected' });              	
	        $('#selectModules option[value="' + data.id_modules + '"]').attr({ selected : 'selected' });              
	        $('#selectTypeAlternatives option[value="' + data.id_alternatives_type + '"]').attr({ selected : 'selected' });              
	        $('#selectLeveltype option[value="' + data.id_level_type + '"]').attr({ selected : 'selected' });              
	        $('#selectSeriessemester option[value="' + data.series_semester + '"]').attr({ selected : 'selected' });              
	        $('#selectSituation option[value="' + data.id_situation + '"]').attr({ selected : 'selected' });              
			
			$('#name_questionnaries').val(data.name_questionnaries);
			$('#title_questionnaries').val(data.title_questionnaries);
			$('#description_questionnaries').val(data.description_questionnaries);
			$('#instructions_questionnaries').val(data.instructions_questionnaries);
			$('#order_module_questionnaries').val(data.order_module_questionnaries);
			$('#dt_creation').val(data.dt_creation);
	
			//  Setup Questionnaires fields
	        $('#selectWhocustomize option[value="' + data.who_customize + '"]').attr({ selected : 'selected' });              
	        $('#selectFormmarket option[value="' + data.form_market + '"]').attr({ selected : 'selected' });              
	        $('#selectPresentationtype option[value="' + data.id_presentation_type + '"]').attr({ selected : 'selected' });              
	        $('#selectAllowsinterrupt option[value="' + data.id_allows_interrupt + '"]').attr({ selected : 'selected' });              
	        $('#selectAllowsnavigate option[value="' + data.id_allows_navigate + '"]').attr({ selected : 'selected' });              
	        $('#selectMandatoryanswers option[value="' + data.id_mandatory_answers + '"]').attr({ selected : 'selected' });              
	        $('#selectFlowissues option[value="' + data.id_flow_issues + '"]').attr({ selected : 'selected' });              
	        $('#selectLeveltype option[value="' + data.id_level_type + '"]').attr({ selected : 'selected' });              		
	
			$('#time_duration').val(data.time_duration);
			$('#quantity_issues').val(data.quantity_issues);
			$('#id_cfg_questionnaries').val(data.id_cfg_questionnaries);
	
		} else {
					//alert('id_q =>' + id_q);
			var author = $('#author').val();
					
			$(':input','#form_dd_Questionnarie')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');										
					
						
			$(':input','#form_dd')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');
			  
			$('#author').val(author);  						
			$('#authorcfg').val(author);  						

	        $('#selectSituation option[value="2"]').attr({ selected : 'selected' });              
			
			var data = new Date();
			var mes = data.getMonth()+1;
			if (mes < 10) {mes = '0' + mes};
			var dt = data.getFullYear() + '-' + mes + '-' + data.getDate()
			
			$('#dt_creation').val(dt);
		}
	}
	
	function load_data_questions(data, id) {		
//       	alert(' ==> load_data_questions(data) <== ');
		var id_q = $('#id_questions').val();
		
		if (id_q != null && id_q > 0) {

			//  Questions fields
	        $('#selectAlternativestype option[value="' + data.id_alternatives_type + '"]').attr({ selected : 'selected' });              
	        $('#selectSituationq option[value="' + data.id_situation + '"]').attr({ selected : 'selected' });              
	
			$('#name_questions').val(data.name_questions);
			$('#title_questions').val(data.title_questions);
			$('#enunciation').val(data.enunciation);
			$('#order_questionnaries').val(data.order_questionnaries);
	
			// Setup questions fields
			$('#time_durationq').val(parseInt(data.time_duration));
			$('#quantity_alternatives').val(data.quantity_alternatives);	
	
	        $('#selectPresentationtype option[value="' + data.id_presentation_type + '"]').attr({ selected : 'selected' });              
	        $('#selectAllowsmodifyresponse option[value="' + data.allows_modify_response + '"]').attr({ selected : 'selected' });              
	        $('#selectWeight option[value="' + parseInt(data.weight) + '"]').attr({ selected : 'selected' });              
	        $('#selectMandatoryanswers option[value="' + data.id_mandatory_answers + '"]').attr({ selected : 'selected' });              
	        $('#selectEditable option[value="' + data.editable + '"]').attr({ selected : 'selected' });              

			var idq = $('#id_questionnaries').val();
			$('#id_questionnariesq').val(idq);
			$('#id_questions').val(data.id_questions);
			$('#id_cfg_questions').val(data.id_cfg_questions);
			
			var questionnarie = $('#title_questionnaries').val();
			$('#title_questionnariesq').val(questionnarie);
			$('#title_questionnariescfg').val(questionnarie);

		} else {
					//alert('id_q =>' + id_q);
			var title_questionnaries = $('#title_questionnaries').val();
			var id_questionnaries = $('#id_questionnaries').val();
					
			$(':input','#form_dd_questions')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');										
						
			$(':input','#form_dd_question_edit')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');
			  
			$('#title_questionnariesq').val(title_questionnaries);  						
			$('#title_questionnariescfg').val(title_questionnaries);  						
			$('#id_questionnariesq').val(id_questionnaries);  						

	        $('#selectSituationq option[value="2"]').attr({ selected : 'selected' });              			
		}
	}	
		
	function load_data_alternatives(data, id) {		
//       	alert(' ==> load_data_questions(data) <== ');
		var id_q = $('#id_alternatives').val();
		
		if (id_q != null && id_q > 0) {

			//  Questions fields
	        $('#selectRightwrong option[value="' + data.right_wrong + '"]').attr({ selected : 'selected' });              
	        $('#selectSituationa option[value="' + data.id_situation + '"]').attr({ selected : 'selected' });              
	
			$('#id_order_questions').val(data.id_order_questions);
			$('#description_alternatives').val(data.description_alternatives);
			$('#text_alternatives').val(data.text_alternatives);

			var idq = $('#id_questions').val();
			$('#id_questionsa').val(idq);
			
			var questionnarie = $('#title_questionnariesq').val();
			$('#title_questionnariesa').val(questionnarie);
			
			var question = $('#title_questions').val();
			$('#title_questionsa').val(question);			

		} else {
					//alert('id_q =>' + id_q);
			var title_questions = $('#title_questions').val();
			var id_questions = $('#id_questions').val();
					
			$(':input','#form_dd_alternatives')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');										
					
						
			$(':input','#form_dd_alternative')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');
			  
			$('#title_questions').val(title_questions);  						
			$('#id_questionsa').val(id_questions);  						
			
			var questionnarie = $('#title_questionnariesq').val();
			$('#title_questionnariesa').val(questionnarie);
			
			var question = $('#title_questions').val();
			$('#title_questionsa').val(question);			

	        $('#selectSituationa option[value="2"]').attr({ selected : 'selected' });              			
		}


	}	
	
</script>


