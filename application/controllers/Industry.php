<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class industry extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $this->load->library('pagination');

        $total_general = $this->m_industry->total_industry();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('industry/index');
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
		                    
        $data['consult'] = $this->m_industry->return_industry(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_industry';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_industry = 0) {
        				
        $data['industry'] = $this->m_industry->return_industry($id_industry)->row();        
		$data['id_industry'] = $id_industry;

        $data['name_view'] = 'v_form_industry';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_industry(){

        $data['name_view'] = 'v_form_industry';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_industry() {
		
        $id_industry = $this->input->post("id_industry");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("industry") ."' class='btn btn-primary'> Industry </a>",                                                                                    
                        "<a href='". base_url('industry/new_industry') ."' class='btn btn-primary'> New Industry </a>"  );                
                
        if ($this->m_industry->save_industry()) {            
        	if ($id_industry != 0) {            
            	$message = standard_message( 1, "Industry Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, "Industry Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_industry != 0) {
            	$message = standard_message( 4, " Industry Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Industry Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);
    }
         
    public function delete($id_industry){

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                        "<a href='". base_url("industry") ."' class='btn btn-primary'> Industry </a>",                                                                                    
                        "<a href='". base_url('industry/new_industry') ."' class='btn btn-primary'> New Industry </a>" );                           	
           
        $ret = $this->m_industry->delete($id_industry);
        
        if ($ret == 0) {
            $message = standard_message( 1, "Excluded Successfully industry....", $botoes ); 
        } else {
            $message = standard_message( 4, "Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");
        
        $consult = $this->m_industry->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_industry", $this->input->post("filtro_id_industry"));
            $this->session->set_userdata("name_industry", $this->input->post("filtro_name_industry"));
            $this->session->set_userdata("description_industry", $this->input->post("filtro_description_industry"));
        }

        $dados['id_industry'] = $this->session->userdata("id_industry");
        $dados['name_industry'] = $this->session->userdata("name_industry");
        $dados['description_industry'] = $this->session->userdata("description_industry");        
                                                                   
        $total_general = $this->m_industry-> total_industry_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('industry/filter');
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
        			
        $data['consult'] = $this->m_industry->filter_industry($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_industry';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('industry'));                
    }

    public function window_data_complete_industry() {
         
        $id_industry = $this->input->post("id_industry");
        
        $consult = $this->m_industry->return_industry($id_industry)->result_array();
        //print_r($consult);        
        $data_industry = $consult[0];
        echo json_encode($data_industry);
    }
}
