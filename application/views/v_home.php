
<?php    
    $var = $this->session->userdata("logged");
    $logged = isset($var) ? $var : 0;

    $var = $this->session->userdata("external_questions");
    $external_questions = isset($var) ? $var : FALSE;

    $var = $this->session->userdata("external_test");
    $external_test = isset($var) ? $var : FALSE;
?>


 <!-- Tela Inicial -->

	<section id="main_page">	
		
		<?php 
			if (! $logged) {
				if ( $external_questions || $external_test ) {
					include "includes/external_page.php";		// show external page
		
				} else {
					include "includes/main_page.php";		// show main page
				}										
			}
	
			if ($logged) {	
				//include "includes/menu.php";			// show administrative menu			
			
				include "v_control_panel.php";			// show administrative menu				
			}
		?>
		
	</section>	

