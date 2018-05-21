
<script type="text/javascript">
  		
	var base_url = "<?= base_url()?>";
	
	$(document).ready(function(){

		type_question();
		disabled_buttons_functions();
		//$('#total-questions').hide();

//		$('#wrong_signup').hide();		
//		$('#div_form_questions').hide();
//		$('#div_type_questions').hide();
//		$('#btn_type_questions').hide();
//		$('#div_toolbar').hide();		
//		$('#hr-btn-functions').hide();
		
		$('#div_list_tests').show();

  		$('.action-test').on('click',function(){
			//alert("action-test => " + $(this).attr('id'));
			
			var ident = $(this).attr('id');
			var tam = ident.length;
			//alert(ident.substring(3,tam));
			
			var id = ident.substring(3,tam);
			
			$('#id_test').val(id);
			
			//var t = $('#id_test').val();
			//alert("id => " + t);
		});
				
		$('#lbl-mc').click(function(event){			
			type_question();
			$('#btn-add-question').prop('disabled', true);
			
			$('#div-answers-mc').show();
			$('#div-answer1').show();
			$('#div-answer2').show();
			$('#div-btn-answer3').show();
			$('#chosen_option').val('mc');
		});	
		
		$('#lbl-tf').click(function(event){
			type_question();
			$('#btn-add-question').prop('disabled', true);
			
			$('#div-answers-tf').show();
			$('#div-tf1').show();
			$('#div-tf2').show();
			$('#div-btn-issue3').show();
			$('#chosen_option').val('tf');
		});				
		
		$('#lbl-fg').click(function(event){
			type_question();
			$('#btn-add-question').prop('disabled', true);
			
			$('#div-answers-fg').show();
			$('#num_gaps').show();
			$('#opt_gaps').show();
			$('#hr-gap1').show();
			$('#div-part-fg1').show();
			$('#div-gap-fg1').show();
			$('#div-part-fg-last').show();
			$('#chosen_option').val('fg');
		});	
		
		$('#lbl-sq').click(function(event){
			type_question();
			$('#btn-add-question').prop('disabled', true);
			
			$('#div-answers-sq').show();
			$('#div-text-sq').show();
			$('#text-sq').show();
			$('#chosen_option').val('sq');
		});
		
		var img = '../includes/img/right.png';
		
		$('#right-wrong1').click(function(event){
			right_wrong();
			$('#span-rw1').html('<img class="img-fluid" src="'+ img +'" height="25px" style="margin-top: -4px;">');
		});				
		$('#right-wrong2').click(function(event){
			right_wrong();
			$('#span-rw2').html('<img class="img-fluid" src="'+ img +'" height="25px" style="margin-top: -4px;">');
		});				
		$('#right-wrong3').click(function(event){
			right_wrong();
			$('#span-rw3').html('<img class="img-fluid" src="'+ img +'" height="25px" style="margin-top: -4px;">');
		});				
		$('#right-wrong4').click(function(event){
			right_wrong();
			$('#span-rw4').html('<img class="img-fluid" src="'+ img +'" height="25px" style="margin-top: -4px;">');
		});
		$('#right-wrong5').click(function(event){
			right_wrong();
			$('#span-rw5').html('<img class="img-fluid" src="'+ img +'" height="25px" style="margin-top: -4px;">');
		});
		
		$('#btn-answer3').click(function(event){
			event.preventDefault();
		
			var sel = $("textarea[name='answer1']").val();
			var sel1 = $("textarea[name='answer2']").val();
			
			if (sel == '' || sel == '  Option 1 ') {
				$("#answer1").focus();				
			}else {
				
				if (sel1 == '' || sel1 == '  Option 2 ') {
					$("#answer2").focus();
				} else {
					$('#div-btn-answer3').hide();
					$('#div-answer3').show();
					$('#div-btn-answer4').show();
				}	
			}
		});
		
		$('#btn-answer4').click(function(event){
			event.preventDefault();
		
			var sel = $("textarea[name='answer3']").val();
			
			if (sel == '' || sel == '  Option 3 ') {
				$("#answer3").focus();
				//alert(sel);
				
			} else {			
				$('#div-btn-answer4').hide();
				$('#div-answer4').show();
				$('#div-btn-answer5').show();
			}	
		});
		
		$('#btn-answer5').click(function(event){
			event.preventDefault();
		
			var sel = $("textarea[name='answer4']").val();
			
			if (sel == '' || sel == '  Option 4 ') {
				$("#answer4").focus();
				//alert(sel);
				
			} else {						
				$('#div-btn-answer5').hide();
				$('#div-answer5').show();
			}
		});
		
		$('#div-btn-issue3').click(function(event){
			event.preventDefault();
		
			var sel1 = $("textarea[name='issue-tf1']").val();
			var sel10 = $("textarea[name='issue1']").val();
			var sel2 = $("textarea[name='issue-tf2']").val();
			var sel20 = $("textarea[name='issue2']").val();
			
			//alert(sel);
			
			if (sel1 == '' || sel1 == '  Issue 1 ' || sel10 == '' || sel10 == ' '){
				$("#issue-tf1").focus();				
			}else {
				
				if (sel2 == '' || sel2 == '  Issue 2 ' || sel20 == '' || sel20 == ' ') {
					$("#issue-tf2").focus();
				} else {
					$('#div-btn-issue3').hide();
					$('#div-tf3').show();
					$('#div-btn-issue4').show();
				}	
			}
		});
		
		$('#div-btn-issue4').click(function(event){
			event.preventDefault();
		
			var sel = $("textarea[name='issue-tf3']").val();
			var sel1 = $("textarea[name='issue3']").val();
			
			if (sel == '' || sel == '  Issue 3 ' || sel1 == '' || sel1 == ' ') {
				$("#issue-tf3").focus();
				
			} else {			
				$('#div-btn-issue4').hide();
				$('#div-tf4').show();
				$('#div-btn-issue5').show();
			}	
		});
		
		$('#div-btn-issue5').click(function(event){
			event.preventDefault();
		
			var sel = $("textarea[name='issue-tf4']").val();
			var sel1 = $("textarea[name='issue4']").val();
			
			if (sel == '' || sel == '  Issue 4 ' || sel1 == '' || sel1 == ' ') {
				$("#issue-tf4").focus();
				
			} else {						
				$('#div-btn-issue5').hide();
				$('#div-tf5').show();
			}
		});

		var tipo = "<?=	isset($type_edit) ? $type_edit : ''; ?>";

		$('#inlineRadio1').click(function(event){			
			
			if (tipo != 'fg') {
				$('#div-part-fg2').hide();
				$('#div-gap-fg2').hide();
				$('#div-part-fg3').hide();
				$('#div-gap-fg3').hide();
			}
		});
	
		$('#inlineRadio2').click(function(event){			

			$('#div-part-fg2').show();
			$('#div-gap-fg2').show();
			
			if (tipo != 'fg') {
				$('#div-part-fg3').hide();
				$('#div-gap-fg3').hide();
			}
		});
		
		$('#inlineRadio3').click(function(event){
			$('#div-part-fg2').show();
			$('#div-gap-fg2').show();			
			$('#div-part-fg3').show();
			$('#div-gap-fg3').show();
		});

		$('#div-answer2').change(function() {			
			var ret = true;
			
			if ($('#text-statement').val() == '') {
				alert( "inform the question !" );
				disabled_buttons_functions();
				$('#text-statement').focus();
				ret = false;
			}
			
			if ( $('#div-answer1').text() == '' ) {
				alert( "enter at least 2 options " );
				disabled_buttons_functions();
				$('#div-answer1').focus();
				ret = false;				
			} else {
				if ( $('#div-answer2').text() == '' ) {
					alert( "enter at least 2 options !" );
					disabled_buttons_functions();
					$('#div-answer2').focus();
					ret = false;				
				} else {					
					enable_buttons_functions();
				}
			}
			return ret;
		});

		$('#div-tf2').change(function() {			
			var ret = true;
			
			if ($('#text-statement').val() == '') {
				alert( "inform the question !" );
				disabled_buttons_functions();
				$('#text-statement').focus();
				ret = false;
			}

			if ( $('#div-tf1').text() == '' ) {
				alert( "enter at least 2 options !!" );
				disabled_buttons_functions();
				$('#div-tf1').focus();
				ret = false;
			
			} else {
				if ( $('#div-tf2').text() == '' ) {
					alert( "enter at least 2 options !!!" );
					disabled_buttons_functions();
					$('#div-tf2').focus();
					ret = false;
			
				} else {					
					enable_buttons_functions();
				}
			}
			return ret;
		});

		$('#div-part-fg-last').change(function() {			
			var ret = true;
			
			if ($('#text-statement').val() == '') {
				alert( "inform the question !" );
				disabled_buttons_functions();
				$('#text-statement').focus();
				ret = false;
			}

			if ( $('#div-part-fg1').html() == '' || $('#div-part-fg1').html() == '  First part ' ) {
				alert( "enter at least 2 parts and 1 gap !" );
				disabled_buttons_functions();
				$('#div-part-fg1').focus();
				ret = false;
			
			} else {
				if ( $('#div-gap-fg1').html() == '' || $('#div-gap-fg1').html() == '  First gap ' ) {
					alert( "enter at least 2 parts and 1 gap !" );
					disabled_buttons_functions();
					$('#div-gap-fg1').focus();
					ret = false;
			
				} else {					
					if ( $('#div-part-fg-last').html() == '' || $('#div-part-fg-last').html() == '  Last part ' ) {
						alert( "enter at least 2 parts and 1 gap !" );
						disabled_buttons_functions();
						$('#div-part-fg-last').focus();
						ret = false;
				
					} else {					
						enable_buttons_functions();
					}
				}
			}
			return ret;
		});

		$('#text-sq').change(function() {			
			var ret = true;
			
			if ($('#text-statement').val() == '') {
				alert( "inform the question !" );
				disabled_buttons_functions();
				$('#text-statement').focus();
				ret = false;
			}

			if ( $('#text-sq').val() == '' ) {
				alert( "report the answer !" );
				disabled_buttons_functions();
				$('#text-sq').focus();
				ret = false;
		
			} else {					
				enable_buttons_functions();
			}
			return ret;
		});			

		$('#btn-img-statement').change(function(e){		
            e.preventDefault();
            
            $('#img-statement').toggle();
            
            //alert('btn-img-statement');
		});

        $('#form_questions').submit(function(e) {
            e.preventDefault();

			if ( $('#text-statement').val() == "  Type your Question " || $('#text-statement').val() == "") {
				alert("Enter statement field !");
				$('#text-statement').focus();
				return false;
			}

            var formulario = $(this); 
            var dados = formulario.serialize();								
 			//alert(dados);
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'questions/save_external/',
                data: dados,
                dataType: 'text',
//		       	cache: false,				       
			   	async:  true
			
			}).done(function(data) {
				//alert(data);
				
				var logged = "<?= $this->session->userdata('logged') ?>";
				if (logged == 2) {
					clear_fields();
				}
				
				$('#total-questions').html(data);
				//$('#total-questions').show();
				
				$('#btn-add-question').prop('disabled', true);
				$('#text-statement').focus();
				
            }).fail(function(data) {
                alert("Erro na gravação da questão !");
                    
            }).always(function(data) {
                //alert("Always !");
            });
		});

		$('#modal_signup').on('shown.bs.modal', function(e) {	    	
	    	e.preventDefault();
			//alert('Carregou signup');
			
			$('#first_name').val('');
			$('#last_name').val('');
			$('#email').val('');
			$('#password').val('');
			$('#password_confirmation').val('');

			$('#wrong_signup').html('');
			$('#wrong_signup').hide();
		});

        $('#form_signin').submit(function(e) {
            e.preventDefault();

			var em = $('#email_login').val();
			var email = em.replace(" ","");

			var pass = $('#password_login').val();
			var password = pass.replace(" ","");

			if (email==null || email=="" || password==null || password=="") {
				alert("Enter the Email and password fields");
				$('#email_login').focus();
				return false;
			}
			
            var formulario = $(this); 
            var dados = formulario.serialize();								
 			//alert(dados);
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'users/login_external/',
                data: dados,
                dataType: 'text',
//		       	cache: false,				       
			   	async:  true
			
			}).done(function(data) {
				//alert(data);
				
				$('#username').html(data);
				var url = base_url + "home/external_questions";
				location.href = url;
				
            }).fail(function(data) {
                alert("Erro na gravação do usuário, fail !");                    
            });           
		});

        $('#form_signup').submit(function(e) {
            e.preventDefault();

			var pass = $('#password').val();
			var pass_conf = $('#password_confirmation').val();
			if (pass !== pass_conf) {
				alert("Attention, different passwords, Retype !")
				$('#password').focus();
				return false;
			}
			
			var nm = $('#first_name').val();
			var name = nm.replace(" ","");
			if (name==null || name=="") {
				alert("Enter the Name fields");
				$('#first_name').focus();
				return false;
			}
			
            var formulario = $(this); 
            var dados = formulario.serialize();								
 			//alert(dados);
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'users/save_external/',
                data: dados,
                dataType: 'text',
//		       	cache: false,				       
			   	async:  true
			
			}).done(function(data) {
				//alert(data);
				var url = base_url + "home/external_questions";
				location.href = url;
				
            }).fail(function(data) {
                alert("Erro na gravação do usuário, fail !");                    
            });           
		});

		$('#email').change(function(e){		
            e.preventDefault();
            
            //alert('focus ');
			$('#wrong_signup').html('');
			$('#wrong_signup').hide();
		});
	
		$('#email').on("blur", function(e){		
            e.preventDefault();
			
			var email = $('#email').val();
			//alert("email => " + email);
			if(email == 'undefined') {
				alert('email empty !');
				return false;
			}
			
            $.ajax({
            	type: 'GET',
                url : base_url + 'users/search_email/',
                data: "email=" + email,
                dataType: 'text',				       
			   	async:  true
			
			}).done(function(data) {
				//alert('ok => ' + data);
				
				var str = data.replace(" ","");
				
				if (str.indexOf("Ok") != -1) {
					//alert("Não existe js");
					$('#wrong_signup').html('');
					$('#wrong_signup').hide();

				} else {
					$('#wrong_signup').html('Attention, email is already registered !');
					$('#wrong_signup').show();				
					//$('#email').focus();					
				}				
				return true;				
            });           						
		});
				
		$('#btn-edit').click(function(e){
			e.preventDefault();
			
			var el = $("input[name=radio-test]:checked").attr('id');			
			var id = el.substr(7);
			var type = el.substr(5, 2);			
			var id_test = $('#id_test_question').val();
			
			//alert("id test => " + id_test);			
			//alert(" id - tp => " + id + " - "+ type);
										
            $.ajax({
            	type: 'GET',
                url : base_url + 'questions/edit_questions_file/',
                data: {id:id, type:type, id_test:id_test},
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert(data);							
				$(location).attr('href', base_url + 'home/external_questions/edit_questions');				
				 
            }).fail(function(data) {
                alert("Erro na gravação das questões, fail !");                    
			});
		});
		
		$('#btn-edit-test').click(function(e){
			e.preventDefault();
						
			var el = $("input[name=radio-test]:checked").attr('id');			
			var id = el.substr(5);
										
            $.ajax({
            	type: 'GET',
                url : base_url + 'questions/edit_questions_db/',
                data: "id=" + id,
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert(data);							
				$(location).attr('href', base_url + 'home/external_questions/test_questions');				
				 
            }).fail(function(data) {
                alert("Erro na edição do teste-questões, fail !");                    
			});
		});
		
		$('#btn-delete').click(function(e){
			e.preventDefault();
			
			var el = $("input[name=radio-test]:checked").attr('id');			
			var elemento = '#tr' + el.substr(7);
			
            $.ajax({
            	type: 'GET',
                url : base_url + 'questions/delete_questions_file/',
                data: "id=" + el.substr(7),
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert('ok => ' + data);			
				$(elemento).fadeOut();		//$(elemento).remove(); // funciona também
				
            }).fail(function(data) {
                alert("Erro na gravação do usuário, fail !");                    
			});
		});

		$('#btn-preview-test').click(function(e){
			e.preventDefault();
			
			var el = $("input[name=radio-test]:checked").attr('id');			
			//var elemento = '#tr' + el.substr(7);			
			//alert("ele => "+ el.substr(5));
			
            $.ajax({
            	type: 'GET',
                url : base_url + 'questionnaries/prepare_preview_test/',
                data: "id=" + el.substr(5),
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert('ok => ' + data);	
				$('#preview-question').html(data);		
				$('#div-preview-question').modal('show');
				
            }).fail(function(data) {
                alert("Err in Preview, fail !");                    
			});
		});
		
		$('#btn-preview').click(function(e){				// Questions
			e.preventDefault();
			
			var el = $("input[name=radio-test]:checked").attr('id');			
			//var elemento = '#tr' + el.substr(7);			
			//alert("ele => "+ el.substr(7));
			
            $.ajax({
            	type: 'GET',
                url : base_url + 'questions/prepare_preview_questions/',
                data: "id=" + el.substr(7),
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert('ok => ' + data);	
				$('#preview-question').html(data);		
				$('#div-preview-question').modal('show');
				
            }).fail(function(data) {
                alert("Err in Preview, fail !");                    
			});
		});
				
		$('#btn-save-name').click(function(e){
			//e.preventDefault();
			
			var el = $("input[name=radio-test]:checked").attr('id');			
			var id = el.substr(7);
			//var type = el.substr(5, 2);			

			var name = $('#name-question-save').val();			
			if (name == "") {
				name = "Test " + id;
			}			
			$('#name-test').val(name);
			alert("Name => " + name);
						
            $.ajax({
            	type: 'GET',
                url : base_url + 'questionnaries/save_file_db/',
                data: "name=" + name,
                dataType: 'text',
			   	async:  true
			
			}).done(function(data) {
				//alert('ok => ' + data);	
				$('#preview-question').html(data);		
				$('#div-preview-question').modal('show');
				
            }).fail(function(data) {
                alert("Err in Preview, fail !");                    
			});
		});

        $('#form_signin_save').submit(function(e) {
            e.preventDefault();

			var em = $('#email_signin_save').val();
			var email = em.replace(" ","");

			var pass = $('#password_signin_save').val();
			var password = pass.replace(" ","");

			if (email==null || email=="" || password==null || password=="") {
				alert("Enter the Email and password fields");
				$('#email_signin_save').focus();
				return false;
			}

			var el = $("input[name=radio-test]:checked").attr('id');			
			var id = el.substr(7);

			var name = $('#name_signin_save').val();			
			if (name == "") {
				name = "Test " + id;
				//$('#name_signin_save').val(name);
			}			
			$('#name-test').val(name);
			alert("Name => " + name);
			
            var formulario = $(this); 
            var dados = formulario.serialize();								
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'questionnaries/save_file_db/',
                data: dados,
                dataType: 'text',
//		       	cache: false,				       
			   	async:  true
			
			}).done(function(data) {
				//alert(data);
				
				$('#username').html(data);
				//var url = base_url + "home/external_questions";
				//location.href = url;
				
            }).fail(function(data) {
                alert("Erro na gravação do usuário, fail !");                    
            });           
		});
				
		function clear_fields() {			
			$('#text-statement').val('');
			
			$('#answer1').val('');
			$('#answer2').val('');
			$('#answer3').val('');
			$('#answer4').val('');
			$('#answer5').val('');
			
			$('#issue1').val('');
			$('#issue-tf1').val('');
			$('#issue2').val('');
			$('#issue-tf2').val('');
			$('#issue3').val('');
			$('#issue-tf3').val('');
			$('#issue4').val('');
			$('#issue-tf4').val('');
			$('#issue5').val('');
			$('#issue-tf5').val('');
			
			$('#part-fg1').val('');
			$('#gap-fg1').val('');
			$('#part-fg2').val('');
			$('#gap-fg2').val('');
			$('#part-fg3').val('');
			$('#gap-fg3').val('');
			$('#part-fg-last').val('');

			$('#text-sq').val('');

			// Form SignUp			
			$('#first_name').val('');
			$('#last_name').val('');
			$('#email').val('');
			$('#password').val('');
			$('#password_confirmation').val('');

			$('#wrong_signup').html('');
			$('#wrong_signup').hide();
			
			$('#text-statement').focus();
		}
			
		function type_question() {
			var tipo = "<?=	isset($type_edit) ? $type_edit : ''; ?>";
			var qty = "<?= $this->session->userdata("qty") ?>";
			
			if (tipo != "mc" && tipo != "mu" && tipo != "1" && tipo != 1 || tipo == "" || tipo == null) {
				$('#div-answers-mc').hide();
				$('#div-answer1').hide();
				$('#div-answer2').hide();
				$('#div-answer3').hide();
				$('#div-btn-answer3').hide();
				$('#div-answer4').hide();
				$('#div-btn-answer4').hide();
				$('#div-answer5').hide();			
			}

			if (tipo != "tf" && tipo != "tr" && tipo != "2" && tipo != 2 || tipo == "" || tipo == null) {						
				$('#div-answers-tf').hide();
				$('#div-tf1').hide();
				$('#div-tf2').hide();
				$('#div-btn-issue3').hide();
				$('#div-tf3').hide();
				$('#div-btn-issue4').hide();
				$('#div-tf4').hide();
				$('#div-btn-issue5').hide();
				$('#div-tf5').hide();
			} else {
				if (tipo == "tf" || tipo == "tr" || tipo == "2" || tipo == 2) {						
					$('#div-answers-tf').show();
					$('#div-tf1').show();
					$('#div-tf2').show();
					//$('#div-btn-issue3').show();
					$('#div-tf3').show();
					//$('#div-btn-issue4').show();
					$('#div-tf4').show();
					//$('#div-btn-issue5').show();
					$('#div-tf5').show();
					$('#btn-add-question').prop('disabled', false);
				}				
			}
						
			if (tipo != "fg" && tipo != "fi" && tipo != "3" && tipo != 3 || tipo == "" || tipo == null) {						
				$('#div-answers-fg').hide();
				$('#num_gaps').hide();
				$('#opt_gaps').hide();
				$('#hr-gap1').hide();
				$('#div-part-fg1').hide();
				$('#div-gap-fg1').hide();
				$('#div-part-fg2').hide();
				$('#div-gap-fg2').hide();
				$('#div-part-fg3').hide();
				$('#div-gap-fg3').hide();
				$('#div-part-fg-last').hide();
			} else {
				if (qty == 1) {
					$('#div-part-fg2').hide();
					$('#div-gap-fg2').hide();
					$('#div-part-fg3').hide();
					$('#div-gap-fg3').hide();
				}								
				if (qty == 2 ) {
					$('#div-part-fg3').hide();
					$('#div-gap-fg3').hide();
				}
			}
			
			if (tipo != "sq" && tipo != "su" && tipo != "4" && tipo != 4 || tipo == "" || tipo == null) {									
				$('#div-answers-sq').hide();
				$('#div-text-sq').hide();
				$('#text-sq').hide();
			}
			
			// Form SignUp			
			$('#first_name').val('');
			$('#last_name').val('');
			$('#email').val('');
			$('#password').val('');
			$('#password_confirmation').val('');

			$('#wrong_signup').html('');
			$('#wrong_signup').hide();
		}
		
		function right_wrong() {						
			var imagem = '../includes/img/wrong.png';			
			var img = '<img class="img-fluid" src="'+ imagem +'" height="30px" style="margin-top: -4px;">';
		
			$('#span-rw1').html(img);
			$('#span-rw2').html(img);
			$('#span-rw3').html(img);
			$('#span-rw4').html(img);
			$('#span-rw5').html(img);
		}

		function enable_buttons_functions() {			
			//$('.inputDisabled').prop("disabled", false); // Element(s) are now enabled.
			
			$('#btn-preview').prop("disabled", false);
			$('#btn-save').prop("disabled", false);
			$('#btn-save-new').prop("disabled", false);
			$('#btn-send').prop("disabled", false);
			$('#btn-add-question').prop('disabled', false);
		}


		function disabled_buttons_functions() {			
			$('#btn-preview').attr('disabled', 'disabled');
			$('#btn-save').attr('disabled', 'disabled');
			$('#btn-save-new').attr('disabled', 'disabled');
			$('#btn-send').attr('disabled', 'disabled');
			$('#btn-add-question').prop('disabled', false);
		}
	});
		
</script>
