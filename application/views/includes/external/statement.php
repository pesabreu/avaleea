
<?php
	$total = $this->session->userdata("save_questions_external");
	$total_questions = str_pad($total, 3, "0", STR_PAD_LEFT); 
?>
			
		<form id="form_questions" style="width: 100%;">
			
			<div class="row text-center d-flex justify-content-start align-items-start my-2 ml-5 pl-5" id="div-total-questions" name="div-total-questions">
				<span class="border-0 border-primary" id="total-questions" name="total-questions" style="color: #007BFF; padding: 2px; display: none;">
					Total saved questions:&nbsp; <?= $total_questions ?>
				</span>
			</div>


			<!-- input enunciation question -->
			<div class="row text-center d-flex justify-content-center align-items-start my-4">
				<div class="col-offset-1 col-2" style="border: 0 solid #c0c0c0; width: 40px; height: 80px; margin-right: -60px; margin-top: 5px;">
					<img src="<?= URL_IMG.'imagem.png' ?>" class="img-thumbnail" width="80" height="80">
				</div>
				<div class="col-1" style="width: 5px;"> </div>
				<div class="col-8 text-left" style="border: 2px solid #c0c0c0; width: 100%; height: 80px; margin-left: -60px;">
					<textarea id="text-statement" name="text-statement" rows="3"  style="width: 104%; background-color: #ffffd9; margin-top: -1px; margin-left: -15px;" 
						onfocus="if (this.value=='  Type your Question ')this.value=''"	onblur="if(this.value=='') this.value='  Type your Question '">  Type your Question </textarea>	
				</div>	
			</div>   
			<!-- end input enunciation question -->

