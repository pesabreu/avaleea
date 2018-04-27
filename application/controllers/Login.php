<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
            
        public function index() {            
            //echo CI_VERSION;
			
			$this->session->set_userdata("source", 'home');
                                          
			$error = $this->session->userdata("error_logged");
			if ( isset($error) ) {
				if ($error == '1') {					
					redirect(base_url(''));                                                            
				}
			}       
			$this->load->view('v_login');
        }
        
        public function logging() {            
            $this->load->model("m_login", "login");
            $this->session->set_userdata("error_logged", "0");
            
            if ($this->login->logging()) {                                                
                $user = $this->input->post("login");
                
                $consult = $this->login->recovery_user($user); 
                if (empty($consult)) {
                    $this->session->set_userdata("logged", "0");                    
                    $this->session->set_flashdata("message", "Incorrect User, retype ! ");                                       
                    redirect(base_url('login'));                
                
                } else {
                	$this->session->set_userdata("source", 'home');
					
                	$data["title"] = "Create New Password";
                	$data["new_user"] = 0;
					if ($consult->logged == 'x'){
						$data["title"] = "Password Creation for New User";						
			            $data["new_user"] = 1;
						$data["user"] = $user;
            			$this->load->view('v_change_recovered_password', $data);						
						
					} else {	                												                	
	                	$this->session->set_userdata("logged", "1");
	                    $this->session->set_userdata("user", $user);					
	                    $this->session->set_userdata("id_users", $consult->id_users);
						$this->session->set_userdata("category_user", $consult->id_categories);
						
						$this->session->set_userdata("id_people_admin", $consult->id_people_admin);
						$this->session->set_userdata("name_user", $consult->name_admin);
						$this->session->set_userdata("dt_creation", $consult->dt);						           
						$this->session->set_userdata("email_admin", $consult->email_1);
						        
						$this->session->set_userdata("id_level_users", $consult->id_user_level);
						$this->session->set_userdata("origem", '0');
						$this->session->set_userdata("itens_per_page", $this->m_setup->return_setup()->row()->items_per_page);
									
						redirect(base_url());												
					}
                }                
            } else {
                $this->session->set_userdata("logged", "0");
                $this->session->set_userdata("error_logged", "1");				
                //$this->session->set_flashdata("message", "User/Password Incorrect, retype ! ");
				$this->session->set_userdata("mess", "User/Password Incorrect, retype ! ");				
                redirect(base_url('login'));                                                                
            }                                               
        }
        
        public function logout(){            
            $this->session->set_userdata("logged", "0");
			session_destroy();            
            redirect(base_url());                        
            //redirect("http://localhost/avaleea/");
        }
        
        public function forgot_password() {            
            $this->load->view('v_forgot_password');            
        }
        
        public function recovery_password() {            
            $this->load->model("m_login", "login");
            $user = $this->input->post("login") ;

            if  ($this->login->recovery_password()) {
                
                $key = md5(uniqid(rand(), true));
                $id_users = $this->login-> return_password()->row()->id_users;
                     
                 if ($this->login->write_key($key, $id_users, $email)) {
                     
                    $link = "<a href='login/verificacao/" .$key. "'>" .base_url("login/verification/$key"). "</a>";
                
                    $content = "
                        <p>
                        Dear User,
                        <br /><br /><br />
                        A password recovery was requested. To continue, click on the Link below and follow the steps to register a new password.
                        <br /> 
                        <br />
                        $link
                        <br /><br /><br />
                        <hr>
                        If you did not request this password recovery, please disregard this message.
                        </p> 
                        <br /><br /><br /><br />
                        https://avaleea.com
                    ";               
                
                    $this->email->from('admin@avaleea.com');
                    $this->email->to($email);
                    $this->email->subject('Password recovery - avaleea.com');        
                    $this->email->message($content);
                                        
                    if ($this->email->send()) {
                        //echo "Email Enviado com Sucesso...";
                        $this->session->set_flashdata('message', "<div class='alert alert-success' style='width: 450px;'> Follow the instructions sent to your email.</div>");
                        redirect(base_url('login/recovery_password'));
                    }
                    else {
                        $this->session->set_flashdata('message', "<div class='alert alert-danger' style='width: 450px;'> Error sending email with instructions, contact site administrator at email: admin@avaleea.com</div>");                       
                    }                                                  
                 
                 } else {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger' style='width: 450px;'> Error generating password recovery key, contact site administrator in email: admin@avaleea.com</div>");                
                 }
                                                 
            } else {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger' style='width: 450px;'> Login not found on file, Retype.</div>");                
            }
            
            redirect(base_url('login/recovery_password'));    
        }

    public function verification($key = null) {
            
        $this->load->model("m_login", "login");                
        
        if ($this->login->verification_key($key) ) {            //|| 1==1) {
            $data["key"] = $key;
			
            $this->load->view('v_change_recovered_password', $data);
            
        } else {
            $message = standard_message( 4, "Attention ! This Link is no longer Valid, request a new one.", 
                    array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                           "<a href='". base_url('login') ."' class='btn btn-primary'>Come back Login </a>",
                           "<a href='". base_url('login/forgot_password') ."' class='btn btn-primary'>Come back Forgot passowrd </a>" ) );         
            $this->load->view('v_layout', $message);
        }
        
    }
    
    public function save_password_recover() {
        
        $this->load->model("m_login", "login");                
        
        if ($this->login->save_password_recover()) {
            $message = standard_message( 1, "Password recovered / changed successfully....", 
                     array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                            "<a href='". base_url('login/') ."' class='btn btn-primary'>Login </a>" ) );            
        } else {
            $message = standard_message( 4, "Error in Password Recovery, notify administrator on email: admin@avaleea.com.", 
                     array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                            "<a href='". base_url('login/') ."' class='btn btn-primary'>Come back Login </a>",
                            "<a href='". base_url('login/forgot_password') ."' class='btn btn-primary'>Come back Forgot password</a>" ));         
        }
        
        $this->load->view('v_layout', $message);        
    }
 
 	function save_password_new_user() {
        	
        if (! $this->m_login->save_password_new_user()) {
            $message = standard_message( 4, "Error in creating the password, notify the administrator in the email: admin@avaleea.com", 
                     array( "<a href='". base_url() ."' class='btn btn-info'>Home </a>", 
                            "<a href='". base_url('login/') ."' class='btn btn-primary'>Come back Login </a>" 
									   ));                 
        	$this->load->view('v_layout', $message);

 		} else {
 			redirect(base_url('login'));
		}	
	}

}

