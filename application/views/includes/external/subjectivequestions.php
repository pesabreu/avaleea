
<?php 
	//print_r($tests);
	//exit;
?>	
	
			<!-- input subjective question - sq -->
			<div class="row text-center d-flex justify-content-center align-items-center ml-5 pl-4" name="div-answers-sq" id="div-answers-sq"
					style="display: block; margin-top: 	20px; margin-bottom: -50px;">
	
				<div class="col ml-5 mb-5 pb-5" style="" id="div-text-sq" name="div-text-sq" style="margin-top: -10px;"> 
					<textarea style="width:888px; background-color: #ffffd9;" id="text-sq" name="text-sq" rows="4" onfocus="if (this.value=='  Text response ')this.value=''" 
								onblur="if(this.value=='') this.value='  Text response '"><?= isset($tests[1]['sbq']) ? $tests[1]['sbq'] : "  Text response "; ?></textarea>	
				</div>
				
			</div>
			<!-- end input subjective question - sq -->
			
