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
		$external_questions = isset($var) ? $var : FALSE;

		$var = $this->session->userdata("logged");
		$logged = isset($var) ? $var : "0";
		
		if ($external_questions && $logged != "3") {
			$this->session->set_userdata("logged", '2');
			$this->session->set_userdata("source", 'external_question');
		}

		$logged = $this->session->userdata("logged");		    
        if (intval($logged) < 1 || intval($logged) > 3) {        				
            redirect(base_url('login'));

        } else {

			$this->session->set_userdata("source", 'editing');
        }
             
	 	error_reporting(FALSE);
    }
    
}