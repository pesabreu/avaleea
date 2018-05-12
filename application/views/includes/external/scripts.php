
<script type="text/javascript">
  		
	var base_url = "<?= base_url()?>";
	
	$(document).ready(function(){

		type_question();
		disabled_buttons_functions();
		$('#total-questions').hide();
				
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

		$('#inlineRadio1').click(function(event){			
			$('#div-part-fg2').hide();
			$('#div-gap-fg2').hide();
			$('#div-part-fg3').hide();
			$('#div-gap-fg3').hide();
		});
	
		$('#inlineRadio2').click(function(event){			
			$('#div-part-fg2').show();
			$('#div-gap-fg2').show();
			$('#div-part-fg3').hide();
			$('#div-gap-fg3').hide();
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


        $('#form_questions').submit(function(e) {
            e.preventDefault();

            var formulario = $(this); 
            var dados = formulario.serialize();								
 			alert(dados);
 			
            $.ajax({
            	type: 'POST',
                url : base_url + 'questions/save_external/',
                data: dados,
                dataType: 'text',
//		       	cache: false,				       
			   	async:  true
			
			}).done(function(data) {
				alert(data);
				clear_fields();
				
				$('#total-questions').html(data);
				$('#total-questions').show();
				
				$('#btn-add-question').prop('disabled', true);
				$('#text-statement').focus();
				
            }).fail(function(data) {
                alert("Erro na gravação da questão !");
                    
            }).always(function(data) {
                //alert("Always !");
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
			$('#gap-fg12').val('');
			$('#part-fg3').val('');
			$('#gap-fg3').val('');
			$('#part-fg-last').val('');

			$('#text-sq').val('');
			
			$('#text-statement').focus();
		}
				

			
		function type_question() {
			$('#div-answers-mc').hide();
			$('#div-answer1').hide();
			$('#div-answer2').hide();
			$('#div-answer3').hide();
			$('#div-btn-answer3').hide();
			$('#div-answer4').hide();
			$('#div-btn-answer4').hide();
			$('#div-answer5').hide();
			
			$('#div-answers-tf').hide();
			$('#div-tf1').hide();
			$('#div-tf2').hide();
			$('#div-btn-issue3').hide();
			$('#div-tf3').hide();
			$('#div-btn-issue4').hide();
			$('#div-tf4').hide();
			$('#div-btn-issue5').hide();
			$('#div-tf5').hide();
			
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

			$('#div-answers-sq').hide();
			$('#div-text-sq').hide();
			$('#text-sq').hide();
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
			$('#btn-add-question').prop('disabled', true);
		}
	});
		
</script>
