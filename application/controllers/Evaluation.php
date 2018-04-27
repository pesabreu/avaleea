<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class evaluation extends MY_controller {

    public function index($id_application = 0) {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_evaluation->total_evaluation($id_application);      
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");

		$config = configure_pagination('evaluation/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();	
                                
        $data['total_consult'] = $total_general;            		                    
        $data['consult'] = $this->m_evaluation->return_evaluation(0, $reg_initial, $per_page, $id_application);                                   
		        
        $data['name_view'] = 'v_evaluation';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_evaluation = 0) {

        $data['id_evaluation'] = $id_evaluation;			
        $data['evaluation'] = $this->m_evaluation->return_evaluation($id_evaluation)->row();        

		$data['list_application'] = $this->m_application->list_application();
		$data['list_people'] = $this->m_people->list_people();
		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
										        
        $data['name_view'] = 'v_form_evaluation';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_evaluation() {

		$data['list_application'] = $this->m_application->list_application();
		$data['list_people'] = $this->m_people->list_people();
		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
						        
        $data['name_view'] = 'v_form_evaluation';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_evaluation() {		

        $id_evaluation = $this->input->post("id_evaluation");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("evaluation") ."' class='btn btn-primary'> Evaluation </a>",                                                                                    
                "<a href='". base_url('evaluation/new_evaluation') ."' class='btn btn-primary'> New Evaluation </a>" );                

        if ($this->m_evaluation->save_evaluation()) {
        	if ($id_evaluation != 0) {            
            	$message = standard_message( 1, " Evaluation Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Evaluation Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_evaluation != 0) {
            	$message = standard_message( 4, " Evaluation Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Evaluation Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_evaluation){
           
        $ret = $this->m_evaluation->delete($id_evaluation);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("evaluation") ."' class='btn btn-primary'> Evaluation </a>",                                                                                    
            "<a href='". base_url('evaluation/new_evaluation') ."' class='btn btn-primary'> New Evaluation </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Evaluation....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_evaluation->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_evaluation", $this->input->post("filtro_id_evaluation"));
            $this->session->set_userdata("id_application", $this->input->post("filtro_id_application"));            
            $this->session->set_userdata("id_people", $this->input->post("filtro_id_people"));
			$this->session->set_userdata("dt_evaluation", $this->input->post("filtro_dt_evaluation"));			
        }

        $dados['id_evaluation'] = $this->session->userdata("id_evaluation");
        $dados['id_application'] = $this->session->userdata("id_application");
        $dados['id_people'] = $this->session->userdata("id_people");
		$dados['dt_evaluation'] = $this->session->userdata("dt_evaluation");		        
                                                                   
        $total_general = $this->m_evaluation-> total_evaluation_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('evaluation/filter');
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
        			
        $data['consult'] = $this->m_evaluation->filter_evaluation($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_evaluation';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('evaluation'));                
    }

    public function window_data_complete_evaluation() {
         
        $id_evaluation = $this->input->post("id_evaluation");
        
        $consult = $this->m_evaluation->return_evaluation($id_evaluation)->result_array();
        //print_r($consult);        
        $data_evaluation = $consult[0];
        echo json_encode($data_evaluation);
    }

}
