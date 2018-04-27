<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class customize extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $this->load->library('pagination');

        $total_general = $this->m_customize->total_customize();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('customize/index');
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
		                    
        $data['consult'] = $this->m_customize->return_customize(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_customize';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_customize = 0) {

        $data['id_customize'] = $id_customize;			
        $data['customize'] = $this->m_customize->return_customize($id_customize)->row();        

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_people'] = $this->m_people->list_people();
										        
        $data['name_view'] = 'v_form_customize';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_customize() {

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_people'] = $this->m_people->list_people();
						        
        $data['name_view'] = 'v_form_customize';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_customize() {		

        $id_customize = $this->input->post("id_customize");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("customize") ."' class='btn btn-primary'> Customize </a>",                                                                                    
                "<a href='". base_url('customize/new_customize') ."' class='btn btn-primary'> New Customize </a>" );                

        if ($this->m_customize->save_customize()) {
        	if ($id_customize != 0) {            
            	$message = standard_message( 1, " Customize Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Customize Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_customize != 0) {
            	$message = standard_message( 4, " Customize Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Customize Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_customize){
           
        $ret = $this->m_customize->delete($id_customize);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("customize") ."' class='btn btn-primary'> Customize </a>",                                                                                    
            "<a href='". base_url('customize/new_customize') ."' class='btn btn-primary'> New Customize </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Customize....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_customize->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_customize", $this->input->post("filtro_id_customize"));
            $this->session->set_userdata("id_questionnaries", $this->input->post("filtro_id_questionnaries"));            
            $this->session->set_userdata("id_people", $this->input->post("filtro_id_people"));
			$this->session->set_userdata("description_customize", $this->input->post("filtro_description_customize"));			
        }

        $dados['id_customize'] = $this->session->userdata("id_customize");
        $dados['id_questionnaries'] = $this->session->userdata("id_questionnaries");
        $dados['id_people'] = $this->session->userdata("id_people");
		$dados['description_customize'] = $this->session->userdata("description_customize");	        
                                                                   
        $total_general = $this->m_customize-> total_customize_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('customize/filter');
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
        			
        $data['consult'] = $this->m_customize->filter_customize($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_customize';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('customize'));                
    }

    public function window_data_complete_customize() {
         
        $id_customize = $this->input->post("id_customize");
        
        $consult = $this->m_customize->return_customize($id_customize)->result_array();
        //print_r($consult);        
        $data_customize = $consult[0];
        echo json_encode($data_customize);
    }

}
