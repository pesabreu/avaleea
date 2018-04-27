<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class invitations extends MY_controller {

    public function index() {        
        $this->session->userdata("ins_data", '');        
    
        $total_general = $this->m_invitations->total_invitations();
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");
				
		$config = configure_pagination('invitations/index', $total_general, $per_page);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		                                        
        $data['total_consult'] = $total_general;            
        $data['consult'] = $this->m_invitations->return_invitations(0, $reg_initial, $per_page);                                   
		        
        $data['name_view'] = 'v_invitations';
        $this->load->view('v_layout', $data);
    }
    
    public function edit($id_invitations = 0) {

        $data['id_invitations'] = $id_invitations;			
        $data['invitations'] = $this->m_invitations->return_invitations($id_invitations)->row();        

        $data['list_invited'] = $this->m_people->return_categorie(0);		// with invited 
										        
        $data['name_view'] = 'v_form_invitations';
        $this->load->view('v_layout', $data);        
    }
    
    public function new_invitations() {

        $data['list_invited'] = $this->m_people->return_categorie(0);		// with invited 
						        
        $data['name_view'] = 'v_form_invitations';
        $this->load->view('v_layout', $data);        
    }
    
    public function save_invitations() {		

        $id_invitations = $this->input->post("id_invitations");                    

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
                "<a href='". base_url("invitations") ."' class='btn btn-primary'> Invitations </a>",                                                                                    
                "<a href='". base_url('invitations/new_invitations') ."' class='btn btn-primary'> New Invitations </a>" );                

        if ($this->m_invitations->save_invitations()) {
        	if ($id_invitations != 0) {            
            	$message = standard_message( 1, " Invitations Updated Successfully....", $botoes );
			} else {
				$message = standard_message( 1, " Invitations Inserted Successfully....", $botoes );
			}
        
        } else {
        	if ($id_invitations != 0) {
            	$message = standard_message( 4, " Invitations Update Error....", $botoes);
			} else {
				$message = standard_message( 4, " Invitations Insert Error....", $botoes);
			} 
        }
            
        $this->load->view('v_layout', $message);                                    
    }
         
    public function delete($id_invitations){
           
        $ret = $this->m_invitations->delete($id_invitations);

		$botoes = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
            "<a href='". base_url("invitations") ."' class='btn btn-primary'> Invitations </a>",                                                                                    
            "<a href='". base_url('invitations/new_invitations') ."' class='btn btn-primary'> New Invitations </a>" );                
        
        if ($ret == 0) {
            $message = standard_message( 1, " Excluded Successfully Invitations....", $botoes ); 

        } else {
             $message = standard_message( 4, " Error in Deletion, contact support.....", $botoes ); 
        } 

        $this->load->view('v_layout', $message);                      
    }
						
    public function autocomplete() {
        
        $term = $this->input->get("term");        
        $consult = $this->m_invitations->autocomplete($term);
        
        $return = array();
		$return = $consult;
        
        echo json_encode($return);            
    }
 
    public function filter() {
 
        $var_post = $this->input->post();
 
        if (!empty($var_post)) {
            $this->session->set_userdata("id_invitations", $this->input->post("filtro_id_invitations"));
            $this->session->set_userdata("dt_invitations", $this->input->post("filtro_id_invitations"));            
            $this->session->set_userdata("id_people_invitation", $this->input->post("filtro_id_people_invitation"));
			$this->session->set_userdata("id_application", $this->input->post("filtro_id_application"));			
        }

        $dados['id_invitations'] = $this->session->userdata("id_invitations");
        $dados['dt_invitations'] = $this->session->userdata("dt_invitations");
        $dados['id_people_invitation'] = $this->session->userdata("id_people_invitation");
		$dados['id_application'] = $this->session->userdata("id_application");	        
                                                                   
        $total_general = $this->m_invitations-> total_invitations_filtered();
        $reg_initial = $this->uri->segment(3, 0);
		$per_page = $this->session->userdata("itens_per_page");        

		$config = configure_pagination('invitations/filter', $total_general, $per_page);       
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
         
        $data['total_consult'] = $total_general;           
        $data['consult'] = $this->m_invitations->filter_invitations($reg_initial, $per_page);
                    
        $data['name_view'] = 'v_invitations';                                                                                               
        $this->load->view('v_layout', $data);
    }
     
    public function order($field, $order) {
        
        $this->session->set_userdata("field", $field);
        $this->session->set_userdata("order", $order);
        
        redirect(base_url('invitations'));                
    }

    public function window_data_complete_invitations() {
         
        $id_invitations = $this->input->post("id_invitations");
        
        $consult = $this->m_invitations->return_invitations($id_invitations)->result_array();
        //print_r($consult);        
        $data_invitations = $consult[0];
        echo json_encode($data_invitations);
    }

	public function sender_email_invitation($parm=2) {

		$id_application = $this->input->post("id_applicationi");
		$id_candidate = $this->input->post("id_people_invitationi");		
		$link = $this->input->post("inputUrl");
		$name_user = $this->session->userdata("name_user");
		$id_people_admin = $this->input->post("id_people_admini");

		$invited = " Candidate test our ";
		if ($parm == 1) {
			$invited = " Author of our ";
		}
				
		$recipient = explode(";", $id_candidate);		
		$id_recipient = $recipient[0];
		$name_recipient = $recipient[1];
		$email_recipient = $recipient[2];			
		
		$subject = "Invitation to". $invited. "Avaleea platform application questionnaires "; 
		$message = message_invitation($parm, $link, $name_user);
				
		$data = array(
			'name_sender' => $name_user,
			'email_sender' => $this->session->userdata("email_admin"),
			'name_recipient' => $name_recipient,
			'email_recipient' => $email_recipient,
			'subject' => $subject,
			'message' => $message
		);
		
		$ret = $this->send_email_general($data);
		
		if (!$ret) {
			$id_bd = $this->m_invitations->return_application_candidate($id_application, $id_recipient);
				
	    	$id = ($id_bd > 0) ? $id_bd : $this->m_setup->return_next_id('tbinvitations', 'id_invitations');

			$lnk = substr($link, 0, (strlen($link) - 1)) . str_pad($id, 3, "0", STR_PAD_LEFT);
	        $data = array ( 
            	'id_invitations' => $id,         
                'id_application' => $id_application,
                'dt_invitations' => date('Y-m-d H:i:s'),
                'id_people_admin' => $this->session->userdata("id_people_admin"),
                'id_people_invitation' => $id_recipient,
                'link_invitations' => $lnk,
                'note' => ""
        	);
			
			$ret = $this->m_invitations->save_invitations_link($data, $id_bd);
		}

		if ($ret) {
				
			if ($id_bd == 0) {			
				$html = '<div class="alert alert-success"><h3>Email successfully sent !</h3></div>';
			} else {
				$html = '<div class="alert alert-warning"><h3>Successfully resent email !</h3></div>';				
			}
			
		} else {
			$html = '<div class="alert alert-danger"><h3>Error sending email !</h3></div>';
		}

		echo $html;
		//redirect(base_url());		
	}

	public function guest_link_visit($parm) {	
		$people = $this->m_people->return_people($parm)->row();
		
		if ( is_null($people) ) {
			$this->session->set_userdata("logged", '0') ;
			redirect(base_url());
			exit;
			
		} else {
			$var = "";			
			$user = $this->m_users->return_user_per_people($parm);

			if ( is_null($user) ) {				
				$var = explode(" ", $people->name);				
				$login = strtolower($var[0]);

				$id = $this->m_setup->return_next_id('tbusers', 'id_users');
				
		        $data = array (
		        		'id_users' => $id,          
		                'id_people' => $parm,
		                'id_user_level' => 3,
		                'login' => $login,
		                'password' => md5("avaleea"),
		                'logged' => 'x', 
		                'note' => ""                                                
		        );
				$this->m_users->save_user_invitation($data);
				$password = "avaleea";
				
			} else {
				$login = $user->login;
				$password = "";
			}
		}		
		$ret = $this->sender_email_confirmed($people, $login, $password);

		$botoes = array( "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='". base_url() ."' class='btn btn-info'> Home </a>" );                
        
        if ($ret) {
            $message = standard_message( 1, $this->session->userdata('message_email'), $botoes ); 

        } else {
             $message = standard_message( 4, '&nbsp;&nbsp;&nbsp; '. $this->session->userdata('message_email'), $botoes ); 
        } 
		
		$this->session->set_userdata('email_guest','1');		        
		$this->load->view('v_layout', $message);
	}

	public function sender_email_confirmed($people, $login, $pass) {

		$subject = "Registration Confirmation - Avaleea "; 
		$message = message_registration($login, $pass);
		
		$data = array(
			'name_sender' => 'System Administrator',
			'email_sender' => 'admin@avaleea.com',
			'name_recipient' => $people->name,
			'email_recipient' => $people->email_1,
			'subject' => $subject,
			'message' => $message
		);
				
		$ret = $this->send_email_general($data);
		if ($ret) {
			return TRUE;
		} else {
			return FALSE;
		}		
	}
			
	public function send_email_general($data) {		
		$in = $data['name_sender'];
		$in_email = $data['email_sender'];
		$for = $data['name_recipient'];
		$for_email = $data['email_recipient'];
		$subject = $data['subject'];
		$msg = $data['message'];
		
		//$this->load->library('email');
		
		$config['protocol'] = 'mail'; // define o protocolo utilizado
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
		$this->email->initialize($config);
		
		$this->email->from($in_email, $in);
		$this->email->to($for_email);  
		$this->email->subject($subject);
		$this->email->message($msg);
		
		if ($this->email->send()) {
			$this->session->set_userdata('mess_email','Email successfully sent!');
			$this->session->set_userdata('message_email','Email successfully sent!');
			$ret = TRUE;            
		
		} else {
            $this->session->set_userdata('mess_email',$this->email->print_debugger());
			$this->session->set_userdata('message_email','Email Error sent!');
			$ret = FALSE;											
		}
		//echo $this->email->print_debugger();         //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR		
		
		return $ret;								
	}

/******************************************************************************************************
* 	Guest Application Methods 
*******************************************************************************************************/

	public function invitations_link_candidate($id_invitations) {
		$this->session->set_userdata("candidate_application", '1');
		
		$invitations = $this->m_invitations->return_invitations($id_invitations)->result_array();		
		if ( is_null($invitations) ) {
			$this->session->set_userdata("logged", '0') ;
			redirect(base_url());
			exit;
		}

		$id_application = $invitations[0]['id_application'];
		$application = $this->m_application->return_application($id_application)->result_array();		
		if ( is_null($application) ) {
			$this->session->set_userdata("logged", '0') ;
			redirect(base_url());
			exit;
		}

		$id_people = $invitations[0]['id_people_invitation'];		
		$people = $this->m_people->return_people($id_people)->result_array();		
		if ( is_null($people) ) {
			$this->session->set_userdata("logged", '0') ;
			redirect(base_url());
			exit;
		}

		$var = "";	
		$user = $this->m_users->return_user_per_people($id_people);

		if ( is_null($user) ) {			
			$var = explode(" ", $people->name);				
			$login = strtolower($var[0]);

			$id = $this->m_setup->return_next_id('tbusers', 'id_users');			
	        $data = array (
	        		'id_users' => $id,          
	                'id_people' => $id_people,
	                'id_user_level' => 4,
	                'login' => $login,
	                'password' => md5("avaleea"),
	                'logged' => 'x', 
	                'note' => ""                                                
	        );
			$this->m_users->save_user_invitation($data);
			$password = "avaleea";

			$ret = $this->sender_email_confirmed($people, $login, $password);	
			$botoes = array( "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='". base_url() ."' class='btn btn-info'> Home </a>" );                
	        
	        if ($ret) {
	            $message = standard_message( 1, $this->session->userdata('message_email'), $botoes ); 
	        } else {
	             $message = standard_message( 4, '&nbsp;&nbsp;&nbsp; '. $this->session->userdata('message_email'), $botoes ); 
	        } 		
			
		} else {
        	$this->session->set_userdata("logged", "1");
            $this->session->set_userdata("user", $user->login);					
            $this->session->set_userdata("id_users", $user->id_users);
			
			$this->session->set_userdata("id_people_admin", $people->id_people);
			$this->session->set_userdata("name_user", $people->name);
			$this->session->set_userdata("dt_creation", $people->dt);						           
			$this->session->set_userdata("email_admin", $people->email_1);
			        
			$this->session->set_userdata("id_level_users", $user->id_user_level);
			$this->session->set_userdata("origem", '0');
			$this->session->set_userdata("itens_per_page", $this->m_setup->return_setup()->row()->items_per_page);
			
			$this->session->set_userdata("candidate_application", '0');
			$this->session->set_userdata("id_application", $id_application);			
			redirect(base_url());
		}		
	}
	
	public function save_guest_application() {

		$var = $this->input->post();
		$fields = isset($var) ? $this->input->post() : ""; 

		$id_candidate = $this->session->userdata("id_people_admin");		
		$id_questionnaries = $fields["id_questionnaries_cand"];
		
		$id_application = $fields["id_application_cand"];
		$name_application = $fields["name_application_cand"];
		
		$id_evaluation = $this->m_setup->return_next_id('tbevaluation', 'id_evaluation');
		
		$data_evaluation = array (
			'id_evaluation' => $id_evaluation,
			'id_application' => $id_application,          
	        'id_people' => $id_candidate,
	        'id_questionnaries' => $id_questionnaries,
	        'name_evaluation' => trim($name_application),
	        'dt_evaluation' => date('Y-m-d H:i:s'),
			'id_situation' => 12,
			'note' => ''
		);	
		
		$evaluation = $this->m_evaluation->save_evaluation_candidate($data_evaluation);
		//$evaluation = TRUE;
		
		if ($evaluation) {
			$answers = FALSE;
			$total = 0;
			$right = 0;
			$wrong = 0;
			
			foreach ($_POST as $key => $value) {
				
				if (substr($key, 0, 5) == "check") {

					$id_questions = intval(substr($value, 0, 5));
					$order_alt_sel = intval(substr($value, 5, 2));
					
					$alternatives = $this->m_alternatives->return_alternatives_candidate($id_questions, $order_alt_sel);
					
					$id_answers = $this->m_setup->return_next_id('tbanswers', 'id_answers');			
					
					$data_answers = array (
						'id_answers' => $id_answers,
						'id_evaluation' => $id_evaluation,
						'id_questions' => $id_questions,          
				        'id_alternative_select' => $order_alt_sel,				        
				        'answer' => $alternatives[0]['description_alternatives'],
				        'right_wrong' => $alternatives[0]['right_wrong'],
						'note' => ''
					);	

					$answers = $this->m_answers->save_answers_candidate($data_answers);
					if (! $answers) { break; }
					
					++$total;
					if ($alternatives[0]['right_wrong'] == "0") {
						++$wrong;
					} else {
						++$right;
					}											
				}		
			}
		}		

		if ($answers) {		//return $answers - TRUE;							
			echo " <script> 
						$('#response_cand').addClass('callout-success') 
						$('#btn_save_aqea').prop('disabled', true);
					</script>
					<div class='text-center'>
					<h3 style='font-weight: 700;'> Ok ! </h3> 
					<h4> Total issues: " .str_pad($total, 2, "0", STR_PAD_LEFT). "</h4>
					<h4> Correct questions: " .str_pad($right, 2, "0", STR_PAD_LEFT). "</h4>
					<h4> Wrong questions: " .str_pad($wrong, 2, "0", STR_PAD_LEFT). "</h4> 
				</div> ";
				
		} else {			//return FALSE;
			echo " <script> $('#response_cand').addClass('callout-danger') </script>
					<div class='text-center' style='margin-right: 	20px;'>
					<h3 style='font-weight: 700;'> Wrong ! </h3> </div>	";		
		}
				
	}

}
