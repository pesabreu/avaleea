<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class answers extends MY_controller {

    public function index($id_evaluation = 0) {        
        $this->session->userdata("ins_data", '');        

        $total_general = $this->m_answers->total_answers($id_evaluation);                
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
		        
		$config = configure_pagination('answers/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();	
		                                
        $data['total_consult'] = $total_general;            		                    
        $data['consult'] = $this->m_answers->return_answers(0, $reg_initial, $per_page, $id_evaluation);                                   
		        
        $data['name_view'] = 'v_answers';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_answers = 0) {

        $data['id_answers'] = $id_answers;			
        $data['answers'] = $this->m_answers->return_answers($id_answers)->row();        

		$data['list_evaluation'] = $this->m_evaluation->list_evaluation();
		$data['list_questions'] = $this->m_questions->list_questions();
										        
        $data['name_view'] = 'v_form_answers';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_answers() {

		$data['list_evaluation'] = $this->m_evaluation->list_evaluation();
		$data['list_questions'] = $this->m_questions->list_questions();
						        
        $data['name_view'] = 'v_form_answers';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_answers() {		

        $id_answers = $this->input->post("id_answers");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("answers") ."' class='btn btn-primary'> Answers </a>",                                                                                    
                "<a href='". base_url('answers/new_answers') ."' class='btn btn-primary'> New Answers </a>" );                

        if ($this->m_answers->save_answers()) {
        	if ($id_answers != 0) {            
            	$message = standard_message( 1, " Answers Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Answers Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_answers != 0) {
            	$message = standard_message( 4, " Answers Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Answers Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_answers){
           
        $ret = $this->m_answers->delete($id_answers);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("answers") ."' class='btn btn-primary'> Answers </a>",                                                                                    
            "<a href='". base_url('answers/new_answers') ."' class='btn btn-primary'> New Answers </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Answers....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_answers->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_answers", $this->input->post("filtro_id_answers"));
            $this->session->set_userdata("id_evaluation", $this->input->post("filtro_id_evaluation"));            
            $this->session->set_userdata("id_questions", $this->input->post("filtro_id_questions"));
			$this->session->set_userdata("answer", $this->input->post("filtro_answer"));			
        }

        $dados['id_answers'] = $this->session->userdata("id_answers");
        $dados['id_evaluation'] = $this->session->userdata("id_evaluation");
        $dados['id_questions'] = $this->session->userdata("id_questions");
		$dados['answer'] = $this->session->userdata("answer");	        
                                                                   
        $total_general = $this->m_answers-> total_answers_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('answers/filter');
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
        			
        $data['consult'] = $this->m_answers->filter_answers($reg_initial, $per_page);
        //echo $this->db->last_query();
                    
        $data['name_view'] = 'v_answers';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('answers'));                
    }

    public function window_data_complete_answers() {
         
        $id_answers = $this->input->post("id_answers");
        
        $consult = $this->m_answers->return_answers($id_answers)->result_array();
        //print_r($consult);        
        $data_answers = $consult[0];
        echo json_encode($data_answers);
    }

}
