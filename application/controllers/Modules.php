<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class modules extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $this->load->library('pagination');

        $total_general = $this->m_modules->total_modules();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('modules/index');
        $config['total_rows'] = $total_general;
        $config['per_page'] = $per_page;
        
        $config['num_links'] = 3;
                    
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'> <span>";
        $config['cur_tag_close'] = '</span> </li>';
                    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
                                
        $data['total_consult'] = $total_general;            
        $data['type'] = '';
        $data['pagination'] = $this->pagination->create_links();
		                    
        $data['consult'] = $this->m_modules->return_modules(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_modules';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_modules = 0) {

        $data['id_modules'] = $id_modules;			
        $data['modules'] = $this->m_modules->return_modules($id_modules)->row();        
		$data['list_industry'] = $this->m_industry->list_industry();
		
		$data['list_academic_area'] = $this->m_tabsys->list_tabsys('tbacademic_area');
		$data['list_disciplines'] = $this->m_tabsys->list_tabsys('tbdisciplines');
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_modules';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_module() {
    	
		$data['list_industry'] = $this->m_industry->list_industry();
		$data['list_academic_area'] = $this->m_tabsys->list_tabsys('tbacademic_area');
		$data['list_disciplines'] = $this->m_tabsys->list_tabsys('tbdisciplines');
		$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
						        
        $data['name_view'] = 'v_form_modules';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_modules() {		

        $id_modules = $this->input->post("id_modules");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("modules") ."' class='btn btn-primary'> Modules </a>",                                                                                    
                        "<a href='". base_url('modules/new_user') ."' class='btn btn-primary'> New Module </a>"  );                

        if ($this->m_modules->save_modules()) {
        	if ($id_modules != 0) {            
            	$message = standard_message( 1, "Modules Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, "Modules Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_modules != 0) {
            	$message = standard_message( 4, " Modules Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Modules Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_modules){
           
        $ret = $this->m_modules->delete($id_modules);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("modules") ."' class='btn btn-primary'> Modules </a>",                                                                                    
                        "<a href='". base_url('modules/new_module') ."' class='btn btn-primary'> New Module </a>"  );                
        
        if ($ret == 0) {
            $message = standard_message( 1, "Excluded Successfully Modules....", $botoes ); 

        } else {
             $message = standard_message( 4, "Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_modules->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_modules", $this->input->post("filtro_id_modules"));
            $this->session->set_userdata("id_industry", $this->input->post("filtro_id_industry"));            
            $this->session->set_userdata("name_modules", $this->input->post("filtro_name_modules"));
            $this->session->set_userdata("subject", $this->input->post("filtro_subject"));			
        }

        $dados['id_modules'] = $this->session->userdata("id_modules");
        $dados['id_industry'] = $this->session->userdata("id_industry");
        $dados['name_modules'] = $this->session->userdata("name_modules");        
        $dados['subject'] = $this->session->userdata("subject");        
                                                                   
        $total_general = $this->m_modules-> total_modules_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('modules/filter');
        $config['total_rows'] = $total_general;
        $config['per_page'] = $per_page;
        
        $config['num_links'] = 3;
                    
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li class='active'> <span>";
        $config['cur_tag_close'] = '</span> </li>';
                    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
 
        $data['total_consult'] = $total_general;           
        $data['type'] = '';
        $data['pagination'] = $this->pagination->create_links();                    
        			
        $data['consult'] = $this->m_modules->filter_modules($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_modules';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('modules'));                
    }

    public function window_data_complete_modules() {
         
        $id_modules = $this->input->post("id_modules");
        
        $consult = $this->m_modules->return_modules($id_modules)->result_array();
        //print_r($consult);        
        $data_modules = $consult[0];
        echo json_encode($data_modules);
    }
}
