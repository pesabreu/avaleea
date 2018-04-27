<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class imagesq extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $this->load->library('pagination');

        $total_general = $this->m_images->total_images();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('imagesq/index');
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
        $data['pagination'] = $this->pagination->create_links();
		
        $data['total_consult'] = $total_general;            
 
        $data['consult'] = $this->m_images->return_images(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_images';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_images = 0) {

        $data['id_images'] = $id_images;			
        $data['images'] = $this->m_images->return_images($id_images)->row();        

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_questions'] = $this->m_questions->list_questions();
										        
        $data['name_view'] = 'v_form_images';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_images() {

		$data['list_questionnaries'] = $this->m_questionnaries->list_questionnaries();
		$data['list_questions'] = $this->m_questions->list_questions();
						        
        $data['name_view'] = 'v_form_images';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_images() {		

        $id_images = $this->input->post("id_images");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("imagesq") ."' class='btn btn-primary'> Images </a>",                                                                                    
                "<a href='". base_url('imagesq/new_images') ."' class='btn btn-primary'> New Images </a>" );                

        if ($this->m_images->save_images()) {
        	if ($id_images != 0) {            
            	$message = standard_message( 1, " Images Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Images Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_images != 0) {
            	$message = standard_message( 4, " Images Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Images Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_images){
           
        $ret = $this->m_images->delete($id_images);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("imagesq") ."' class='btn btn-primary'> Images </a>",                                                                                    
            "<a href='". base_url('imagesq/new_images') ."' class='btn btn-primary'> New Images </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Images....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_images->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {

        $this->load->library('pagination');                                               
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_images", $this->input->post("filtro_id_images"));
            $this->session->set_userdata("id_questionnaries", $this->input->post("filtro_id_questionnaries"));            
            $this->session->set_userdata("id_questions", $this->input->post("filtro_id_questions"));
			$this->session->set_userdata("description_images", $this->input->post("filtro_description_images"));			
        }

        $dados['id_images'] = $this->session->userdata("id_images");
        $dados['id_questionnaries'] = $this->session->userdata("id_questionnaries");
        $dados['id_questions'] = $this->session->userdata("id_questions");
		$dados['description_images'] = $this->session->userdata("description_images");	        
                                                                   
        $total_general = $this->m_images-> total_images_filtered();
        $per_page = $this->m_setup->return_setup()->row()->items_per_page;;
        
        $reg_initial = $this->uri->segment(3, 0);
        
        $config['base_url'] = base_url('imagesq/filter');
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
        $data['pagination'] = $this->pagination->create_links();                    
		
        $data['total_consult'] = $total_general; 
        $data['consult'] = $this->m_images->filter_images($reg_initial, $per_page);
                    
        $data['name_view'] = 'v_images';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('imagesq'));                
    }

    public function window_data_complete_images() {
         
        $id_images = $this->input->post("id_images");
        
        $consult = $this->m_images->return_images($id_images)->result_array();
        //print_r($consult);        
        $data_images = $consult[0];
        echo json_encode($data_images);
    }

}
