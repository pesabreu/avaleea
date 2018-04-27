<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class people extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_people->total_people();        
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
				
		$config = configure_pagination('people/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		                                
        $data['total_consult'] = $total_general;            
        $data['consult'] = $this->m_people->return_people(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_people';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_people = 0) {

        $data['id_people'] = $id_people;			
        $data['people'] = $this->m_people->return_people($id_people)->row();        
		
		$data['list_categories'] = $this->m_tabsys->list_tabsys('tbcategories');	
		$data['list_occupation'] = $this->m_tabsys->list_tabsys('tboccupation_area');
						        
        $data['name_view'] = 'v_form_people';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_people() {
    	
		$data['list_categories'] = $this->m_tabsys->list_tabsys('tbcategories');
		$data['list_occupation'] = $this->m_tabsys->list_tabsys('tboccupation_area');
						        
        $data['name_view'] = 'v_form_people';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_people() {		

        $id_people = $this->input->post("id_people");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("people") ."' class='btn btn-primary'> People </a>",                                                                                    
                        "<a href='". base_url('people/new_people') ."' class='btn btn-primary'> New People </a>"  );                

        if ($this->m_people->save_people()) {
        	if ($id_people != 0) {            
            	$message = standard_message( 1, "People Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, "People Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_people != 0) {
            	$message = standard_message( 4, " People Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " People Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_people){
           
        $ret = $this->m_people->delete($id_people);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("people") ."' class='btn btn-primary'> People </a>",                                                                                    
                        "<a href='". base_url('people/new_people') ."' class='btn btn-primary'> New People </a>"  );                
        
        if ($ret == 0) {
            $message = standard_message( 1, "Excluded Successfully People....", $botoes ); 

        } else {
             $message = standard_message( 4, "Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_people->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {
    	
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_people", $this->input->post("filtro_id_people"));
            $this->session->set_userdata("name", $this->input->post("filtro_name"));
            $this->session->set_userdata("physical_identification", $this->input->post("filtro_physical_identification"));
            $this->session->set_userdata("legal_identification", $this->input->post("filtro_legal_identification"));
        }

        $dados['id_people'] = $this->session->userdata("id_people");
        $dados['name'] = $this->session->userdata("name");
        $dados['physical_identification'] = $this->session->userdata("physical_identification");        
        $dados['legal_identification'] = $this->session->userdata("legal_identification");        
                                                                   
        $total_general = $this->m_people-> total_people_filtered();        
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
				
		$config = configure_pagination('people/filter', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		                                
        $data['total_consult'] = $total_general;            
        $data['consult'] = $this->m_people->filter_people($reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_people';
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('people'));                
    }

    public function window_data_complete_people() {
         
        $id_people = $this->input->post("id_people");
        
        $consult = $this->m_people->return_people($id_people)->result_array();
        //print_r($consult);        
        $data_people = $consult[0];
        echo json_encode($data_people);
    }

/**************************************************************************************************
*
*		Method of Addresses
*  
 * **************************************************************************************************/
    
    public function edit_addresses($id_people = 0) {

        $data['id_people'] = $id_people;			
        $data['addresses'] = $this->m_people->return_addresses($id_people)->row();        
			
        $data['name_view'] = 'v_form_addresses';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_addresses() {		

        $id_addresses = $this->input->post("id_addresses");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("people") ."' class='btn btn-primary'> People </a>",                                                                                    
	        "<a href='". base_url('people/edit_addresses/'.$id_addresses) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_people->save_addresses()) {
        	$message = standard_message( 1, " Address Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Address Update Error....", $botoes);
        }
		            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_addresses() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_people->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }


/**************************************************************************************************
*
*		Method of Phones
*  
 * **************************************************************************************************/
    
    public function edit_phones($id_people = 0) {

        $data['id_people'] = $id_people;			
        $data['phones'] = $this->m_people->return_phones($id_people)->row();        
			
        $data['name_view'] = 'v_form_phones';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_phones() {		

        $id_phones = $this->input->post("id_phones");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("people") ."' class='btn btn-primary'> People </a>",                                                                                    
	        "<a href='". base_url('people/edit_phones/'.$id_phones) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_people->save_phones()) {
        	$message = standard_message( 1, " Phones Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Phones Update Error....", $botoes);
        }
		            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_phones() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_people->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }


/**************************************************************************************************
*
*		Method of Web Contact
*  
 * **************************************************************************************************/
    
    public function edit_web_contact($id_people = 0) {

        $data['id_people'] = $id_people;			
        $data['web_contact'] = $this->m_people->return_web_contact($id_people)->row();        
			
        $data['name_view'] = 'v_form_web_contact';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_web_contact() {		

        $id_web_contact = $this->input->post("id_web_contact");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
	        "<a href='". base_url("people") ."' class='btn btn-primary'> People </a>",                                                                                    
	        "<a href='". base_url('people/edit_web_contact/'.$id_web_contact) ."' class='btn btn-primary'> Continue Editing </a>" );                

        if ($this->m_people->save_web_contact()) {
        	$message = standard_message( 1, " Web Contact Updated Successfully....", $botoes );
        	        
        } else {
            $message = standard_message( 4, " Web Contact Update Error....", $botoes);
        }
		            
        $this->load->view('v_layout', $message);                                    
    }
						
    public function autocomplete_web_contact() {
    	        
        $term = $this->input->get("term");        
        $consult = $this->m_people->autocomplete($term);
        
        //$return = array();
		//$return = $consult;
        
        echo json_encode($return);            
    }

}

