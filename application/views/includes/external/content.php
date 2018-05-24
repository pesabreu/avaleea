
	<div class="container mt-5 pl-5" id="content-external">

        <?php
			$logged = $this->session->userdata("logged");
			if ($logged == "0") {
				$cookie = unserialize($_COOKIE['avaleea']);
				$logged = $cookie["logged"];
			}
    		                          
        	if ( (count($tests) > 0 && trim($action) == "") 
        	 || ( trim($action) == "dashboard" ) 
        	 || ( trim($action) == "test_questions" ) ) {
								
				if ($logged == '2') {							
					$questions = filter_questions($tests);								
					include_once "list_questions.php";
				
				} else {
					if ($logged == '3') {
						
						if ( trim($action) == "test_questions" ) {								
							$questions = $tests;
							include_once "list_questions.php";
							
						} else {
							include_once "list_tests.php";
						}
					
					} else {
						redirect(base_url());	
					}										
				}						
			
			} else {	  
						
				if ( trim($action) == "edit_questions" ) {								
					$questions = $tests;
				}
				
		    	switch (trim($action)) {
					case '':
					case 'new':
			            include_once "buttons.php";	
			            include_once "statement.php";
			            include_once "multiplechoice.php";
			            include_once "trueorfalse.php";
			            include_once "fillgaps.php";
			            include_once "subjectivequestions.php";
			            include_once "setupquestions.php";									
						break;
				
					case 'edit_questions':
			            include_once "buttons.php";	
			            include_once "statement.php";
																
						switch (strtolower($type_edit)) {
							case 'mc':
							case 'mu':	
					            include_once "multiplechoice.php";								
								break;
							
							case 'tf':
							case 'tr':
								include_once "trueorfalse.php";
								break;
							
							case 'fg':
							case 'fi':	
								include_once "fillgaps.php";
								break;
							
							case 'sq':
							case 'su':
								include_once "statement.php";	
								include_once "subjectivequestions.php";
								break;
						}						
			            include_once "setupquestions.php";																					
						break;
				}
			}
        ?>

    </div>		<!-- End .container -->
    

	<?php        
		
		function filter_questions($tests) {
			
			$array = array();
					
	   		for ($i=0; $i < count($tests); $i++) { 
			
				if ( substr($tests[$i], 2, 5) == "start" ) {
					
					$type = substr($tests[$i], 10, 2);
					
					switch ($type) {
						case 'mc':
							$sigla = "asw";	
							break;
						case 'tf':
							$sigla = "iss";	
							break;
						case 'fg':
							$sigla = "fgp";	
							break;
						case 'sq':
							$sigla = "sbq";	
							break;
					}					

					$qt = 0;

					if ($type == "mc" || $type == "tf") {					
						$j = $i + 3 ;
						for ( $j; $j < 100; $j++) {						
							if (substr($tests[$j], 0, 3) == $sigla)	{
								$qt++;						
							} else {
								if (substr($tests[$j], 2, 3) == "end") {
									$j = 101;
								}
							}												
						}
					}
					if ($type == "fg") {					
						$j = $i + 3 ;
						if (substr($tests[$j], 0, 3) == 'qty' || substr($tests[$j+1], 0, 3) == 'qty')	{
							$qt = substr($tests[$j], 12, 1);
							
							if ($qt == "0" || trim($qt) == "") {
								$qt = substr($tests[$j+1], 12, 1);		
							}													
						}	
																	
					}					
					if ($type == "sq") {
						$qt = 1;
					}
					$data = array(
						"identify" => substr($tests[$i], 15, 3),
						"statement" => substr($tests[$i+1], 6),
						"type" => $type,
						"quantity" => $qt						
					);
					
					array_push($array, $data);
				}	   
			}
/*
			echo "<br /><br /><br />";
			print_r($array);
			exit;
*/			
			return $array;
		}
   
		
		function filter_questionnaires($tests) {			
			$array = array();
					
	   		for ($i=0; $i < count($tests); $i++) { 
			
				if ( substr($tests[$i], 2, 5) == "start" ) {
					
					$type = substr($tests[$i], 10, 2);
					
					switch ($type) {
						case 'mc':
							$sigla = "asw";	
							break;
						case 'tf':
							$sigla = "iss";	
							break;
						case 'fg':
							$sigla = "fgp";	
							break;
						case 'sq':
							$sigla = "sbq";	
							break;
					}					

					$qt = 0;

					if ($type == "mc" || $type == "tf") {					
						$j = $i + 3 ;
						for ( $j; $j < 100; $j++) {						
							if (substr($tests[$j], 0, 3) == $sigla)	{
								$qt++;						
							} else {
								if (substr($tests[$j], 2, 3) == "end") {
									$j = 101;
								}
							}												
						}
					}
					if ($type == "fg") {					
						$j = $i + 3 ;
						if (substr($tests[$j], 0, 3) == 'qty' || substr($tests[$j+1], 0, 3) == 'qty')	{
							$qt = substr($tests[$j], 12, 1);
							
							if ($qt == "0" || trim($qt) == "") {
								$qt = substr($tests[$j+1], 12, 1);		
							}													
						}																		
					}					
					if ($type == "sq") {
						$qt = 1;
					}
					$data = array(
						"identify" => substr($tests[$i], 15, 3),
						"statement" => substr($tests[$i+1], 6),
						"type" => $type,
						"quantity" => $qt						
					);
					
					array_push($array, $data);
				}	   
			}
/*
			echo "<br /><br /><br />";
			print_r($array);
			exit;
*/			
			return $array;
		}

   	?>        
   