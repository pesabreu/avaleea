<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	           		
    public function __construct() {

        parent::__construct();                        

	    $var = $this->session->userdata("external_questions");
    	$external_questions = isset($var) ? $var : FALSE;
		if ($external_questions) { $this->session->set_userdata("logged", '0'); }

		$this->session->set_userdata("external_questions", FALSE);
        $this->session->set_userdata("external_test", FALSE);
    }

	public function index() {
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
		$this->session->set_userdata("external_questions", FALSE);
        $this->session->set_userdata("external_test", FALSE);
		
		$this->session->set_userdata("source", 'home');
		
	    $var = $this->session->userdata("logged");
    	$logged = isset($var) ? $var : 0;
    
		$var = $this->session->userdata("category_user");
		$category_user = isset($var) ? $var : 0;
	 
    	$var = $this->session->userdata("id_people_admin");
    	$id_people_admin = isset($var) ? $var : 0;	
		
		if ($logged == '1') {
			
		        $data['authors'] = $this->m_people->return_categorie(0);		// with invited authors
				$data['candidates'] = $this->m_people->return_categorie(0);	// with invited candidate
				
				$var = $this->session->userdata("candidate_questionnaries");
				$candidate_questionnaries = isset($var) ? $var : "0"; 			
				if ($candidate_questionnaries == "1") {						//  <====================			
					$var = $this->session->userdata("id_questionnaries");
					$id_questionnaries = isset($var) ? $var : 0;
					
						$id_questionnaries = 1;										//  <====================
	
					$data['questionnaries'] = $this->m_questionnaries->return_questionnaries($id_questionnaries)->row();																
					$data['questions'] = $this->m_questions->return_questions_completed($id_questionnaries);	// with invited candidate							
					$this->session->set_userdata("candidate_questionnaries", "0");				
													
				} else {
					$data['questionnaries'] = $this->m_questionnaries->return_questionnaries_people($id_people_admin);	// without invited candidate
					$data['applications'] = $this->m_application->return_applications_people($id_people_admin);	// without invited candidate
									
					if ($category_user == 3) {
		//				print_r($data['questionnaries']);
						//exit;
						$data['list_modules'] = $this->m_modules->list_modules();						
						$data['list_questionnaries_type'] = $this->m_tabsys->list_tabsys('tbquestionnaries_type');						
						$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
						$data['list_level_type'] = $this->m_tabsys->list_tabsys('tblevel_type');		
						$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						
						$data['list_presentation_type'] = $this->m_tabsys->list_tabsys('tbpresentation_type');
						$data['list_allows_interrupt'] = $this->m_tabsys->list_tabsys('tballows_interrupt');
						$data['list_allows_navigate'] = $this->m_tabsys->list_tabsys('tballows_navigate');
						$data['list_mandatory_answers'] = $this->m_tabsys->list_tabsys('tbmandatory_answers');
						$data['list_flow_issues'] = $this->m_tabsys->list_tabsys('tbflow_issues');						

						$data['list_application_type'] = $this->m_tabsys->list_tabsys('tbapplication_type');						
						$data['list_application_mode'] = $this->m_tabsys->list_tabsys('tbapplication_mode');						
						$data['people'] = $this->m_people->return_people();	// without invited candidate	
					}			// $category_user != 3
					
					if ($category_user == 4) {
						$data['invitations'] = $this->m_invitations->return_application_candidate(0, $id_people_admin);						
					}		
			}
											
		} else {			// Not Logged
			
		}
								
        $data['name_view'] = 'v_home';
        $this->load->view('v_layout', $data);
	}
    
	public function external_questions() {
		
		$this->session->set_userdata("source", 'external_question');	
		$this->session->set_userdata("external_questions", TRUE);
		$this->session->set_userdata("save_questions_external", 0);
								
        $data['name_view'] = 'v_home';
        $this->load->view('v_layout', $data);
	}
    
	public function external_test() {
		
		$this->session->set_userdata("source", 'external_test');	
		$this->session->set_userdata("external_test", TRUE);
		echo "<br /> <br /> External Test <br />";	
	}
	
    public function ajuda() {

        $data['name_view'] = 'v_ajuda';
        $this->load->view('v_layout', $data);        
    }
}
