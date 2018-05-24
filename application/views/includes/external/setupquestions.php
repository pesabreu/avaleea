

<?php 	
	$id = isset($id_edit) ? $id_edit : 0;
	$id_test = isset($id_test) ? $id_test : 0;
	
	$type_edit = $this->session->userdata("type_edit");
	$qty = $this->session->userdata("qty");
	
	if (trim($type_edit) == "" ) {
		$cookie = unserialize($_COOKIE['avaleea']);
		$type_edit = $cookie["type_edit"];
		$qty = $cookie["quantity"];
	}
?> 

			<!-- button add questions -->
			<div class="row text-center d-flex justify-content-center align-items-start float-none mt-5 pt-5" 
								style="margin-top: 20px; margin-bottom: 20px; margin-left: 200px;">
				
				<div class="col-12 ml-5 pl-5 mb-2" id="div-btn-add-question" style="display: block;">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-2">
							<button type="submit" class="btn btn-outline-info btn-sm" id="btn-add-question">
								<i class="ion ion-plus" style="background: #0AF; color: #FFF; border-radius: 20px;"></i>
								Save & add Question					
							</button>
						</div>
						<div class="col-8" style="margin-left: -50px;">	
						</div>
					</div>
				</div>

			</div>

			<input type="hidden" id="chosen_option" name="chosen_option" value="">
 			<input type="hidden" id="id_edit" name="id_edit" value="<?= $id ?>">
 			<input type="hidden" id="id_test" name="id_test" value="<?= $id_test ?>"> 		
 			<input type="hidden" id="name_test" name="name_test" value="">
 			 		
		</form>			
		
		
		<!-- setup questions -->
		<div class="row text-center d-flex justify-content-center align-items-center my-4">

			<div class="col-2">
				<div class="input-group">
				  <div class="input-group-prepend">
						<div class="input-group-text">
					  	<input type="checkbox" aria-label="Checkbox for following text input">
						</div>
				  </div>
				  <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with checkbox" value="Required">
				</div>
			</div>

			<div class="col-1"> </div>
			<div class="col-2">
				<div class="input-group">
				  <div class="input-group-prepend">
					<div class="input-group-text">
				  		<input type="checkbox" id="btn-img-statement" name="btn-img-statement" aria-label="Checkbox for following text input">
					</div>
				  </div>
				  <input type="text" class="form-control bg-primary" aria-label="Text input with checkbox" value="Image" style="font-weight: 800; color: #fff;">
				</div>
			</div>
			
			<div class="col-1"> </div>
				<div class="col-2">				
					<div class="input-group">
				  	<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Radio button for following text input">
							</div>
				 	 	</div>
				  <input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with radio button" value="Numbering">
				</div>			
			</div>	

			<div class="col-1"> </div>				
				<div class="col-2">				
					<div class="input-group">
				  	<div class="input-group-prepend"> 
							<div class="input-group-text">
								<input type="checkbox" aria-label="Radio button for following text input">
							</div>
				  	</div>
				  	<input style="font-weight: 800; color: #fff;" type="text" class="form-control bg-primary" aria-label="Text input with radio button" value="Points">
					</div>			
				</div>
			</div>
						
		</div>
		<!-- end setup questions -->		
		
	</div>	<!-- end div form questions (start in statement.php) -->	


<script type="text/javascript">

	var tipo = "<?=	$type_edit ?>";
	var qty = "<?= $qty ?>";	
	
	//alert("type => "+ tipo + " - "+ qty);	
	
	if (tipo == "mc" || tipo == "mu" || tipo == "1") {
		var elemento = document.getElementById("chosen_option");
		elemento.value = 'mc';															

		var elemento = document.getElementById("div-answers-mc");
		elemento.style.display="block";
											
		var elemento = document.getElementById("div-answer1");
		elemento.style.display="block";
		
		var elemento = document.getElementById("div-answer2");
		elemento.style.display="block";
		
		var elemento = document.getElementById("div-btn-answer3");
		elemento.style.display="none";
		
		var elemento = document.getElementById("div-answer3");
		elemento.style.display="block";

		var elemento = document.getElementById("div-answer4");
		elemento.style.display="block";

		var elemento = document.getElementById("div-answer5");
		elemento.style.display="block";
	}

	if (tipo === "tf" || tipo === "tr" || tipo == "2") {
		var elemento = document.getElementById("chosen_option");
		elemento.value = 'tf';								

		var elemento = document.getElementById("div-answers-tf");
		elemento.style.display="block";

		var elemento = document.getElementById("div-tf1");
		elemento.style.display="block";

		var elemento = document.getElementById("div-tf2");
		elemento.style.display="block";

		var elemento = document.getElementById("div-tf3");
		elemento.style.display="block";

		var elemento = document.getElementById("div-tf4");
		elemento.style.display="block";

		var elemento = document.getElementById("div-tf5");
		elemento.style.display="block";

		var elemento = document.getElementById("div-btn-issue3");
		elemento.style.display="none";

		var elemento = document.getElementById("div-btn-issue4");
		elemento.style.display="none";

		var elemento = document.getElementById("div-btn-issue5");
		elemento.style.display="none";							
	}
	
	if (tipo === "fg" || tipo === "fi" || tipo == "3") {
		var elemento = document.getElementById("chosen_option");
		elemento.value = 'fg';								

		var elemento = document.getElementById("div-answers-fg");
		elemento.style.display="block";

		var elemento = document.getElementById("num_gaps");
		elemento.style.display="block";

		var elemento = document.getElementById("opt_gap");
		elemento.style.display="block";

		var elemento = document.getElementById("hr-gap1");
		elemento.style.display="block";

		var elemento = document.getElementById("div-part-fg1");
		elemento.style.display="block";

		var elemento = document.getElementById("div-gap-fg1");
		elemento.style.display="block";

		var elemento = document.getElementById("div-part-fg2");
		elemento.style.display="block";

		var elemento = document.getElementById("div-gap-fg2");
		elemento.style.display="block";

		var elemento = document.getElementById("div-part-fg3");
		elemento.style.display="block";

		var elemento = document.getElementById("div-gap-fg3");
		elemento.style.display="block";

		var elemento = document.getElementById("div-part-fg-last");
		elemento.style.display="block";
	}
	
	if (tipo === "sq" || tipo === "su" || tipo == "4") {
		var elemento = document.getElementById("chosen_option");
		elemento.value = 'sq';								

		var elemento = document.getElementById("div-answers-sq");
		elemento.style.display="block";

		var elemento = document.getElementById("div-text-sq");
		elemento.style.display="block";

		var elemento = document.getElementById("text-sq");
		elemento.style.display="block";
	}
	
</script>

<script type="text/javascript">
	
	var id = "<?= intval($id) ?>";
	
	if (id > 0) {
		//$('#btn-add-question').prop('disabled', false);
		document.getElementById('btn-add-question').disabled=false;
		
	} else {
		//$('#btn-add-question').prop('disabled', true);
		document.getElementById('btn-add-question').disabled=true;
	}
	
</script>
