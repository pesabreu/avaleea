<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class setup extends MY_controller {

	public function index()	{
        
        $data['logo'] = URL_IMG.$this->m_setup->address_logo();
        $data['setup'] = $this->m_setup->return_setup()->row(); 
        
	    $data['name_view'] = 'v_global_setup';
		$this->load->view('v_layout', $data);
	}
    
    public function save(){

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                         "<a href='". base_url('setup') ."' class='btn btn-primary'> Setup </a>" );
		 
        if ($this->m_setup->save()) {
            
            $message = standard_message(1, "Settings Updated Successfully....", $botoes); 
        } else  {                                                                 
            $message = mensagem_padrao( 4, "Error Changing Settings....", $botoes );
        }                                                         
           
        $this->load->view('v_layout', $message);                                                                                             
    }

    public function save_logo() {
        
		$file = $this->input->post("userfile");
		
        $config['upload_path'] = URL_IMG_REAL;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '4096';
        $config['max_width']  = '1000';
        $config['max_height']  = '1000';

        $this->load->library('upload', $config);

        if ( !$this->upload->do_upload() && trim($file) == '') {
            $error = $this->upload->display_errors();			
			
            $message = standard_message(4, $error, 
                array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                       "<a href='". base_url('setup') ."' class='btn btn-primary'> Setup </a>",                                                                                    
                       "<a href='". "javascript:history.back()" ."' class='btn btn-primary'> Return </a>" ));                 
			$this->load->view('v_layout', $message);
            
        } else  {            
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            $address = URL_IMG.$data['file_name'];
            
            $this->m_setup->save_logo($file_name);
            echo $address;            
        }        
    }
}
