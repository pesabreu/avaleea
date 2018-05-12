<?php

class MY_Controller extends CI_Controller {
    
    public function __construct() {

        parent::__construct();
        
        $controller = $this->uri->segment(1, 0);
		$method = $this->uri->segment(2, 0);
		
		if (trim($controller) == "invitations" && trim($method) == "guest_link_visit") {
			$this->session->set_userdata("logged", '1');
		}

		$var = $this->session->userdata("external_questions");
		$external_questions = isset($var) ? $this->session->userdata("external_questions") : FALSE;

		if ($external_questions) {
			$this->session->set_userdata("logged", '1');
			$this->session->set_userdata("source", 'external_question');
		}

		$logged = $this->session->userdata("logged");		    
        if ($logged != 1) {        				
            redirect(base_url('login'));

        } else {

			$this->session->set_userdata("source", 'editing');
        }
             
	 	error_reporting(FALSE);
    }
    
}