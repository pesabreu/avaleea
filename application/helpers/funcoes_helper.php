
<?php
	define("URL_IMG", "http://localhost/avaleea/includes/img/");
	define("URL_UPL", "http://localhost/avaleea/uploads/");
	
	define("URL_IMG_REAL", "C:\\wamp64\\www\\avaleea\\includes\\img\\");	
	define("URL_UPL_REAL", "C:\\wamp64\\www\\avaleea\\uploads\\");
	define("URL_UPL_QUESTIONS", "C:\\wamp64\\www\\avaleea\\uploads\\temp_questions\\");
	
	
	function __logged() {
		//$this->load->library('session');

		$CI =& get_instance();			
		        
        $logged = $CI->session->userdata("logged");        
		$ret = TRUE;
		
        if ($logged != 1) {
            $ret = FALSE;	
            redirect(base_url('login'));
        }
		return $ret;		
	}


	function isDate($dat, $form=0) {	// parm1 = date,  parm2 = format of date 0=dd/mm/aaaa  1=aaaa/mm/aa
	
		if (strlen(trim($dat)) < 10 or ($dat == '0000-00-00')) {
			return FALSE;
		}

		$barr = '-';
   		$var = strpos($dat, $barr);
   		if ( $var === FALSE ) {
			$data = explode("/","$dat"); // slice string $dat into pieces, using / as a reference
   		}
   		else {
			$data = explode("-","$dat"); // fatia a string $dat em pedados, usando - como referência
   		}

   		$m = $data[1];
   		if ($form == 0) {
			$d = $data[0];
			$y = $data[2];		
		} else {
			$y = $data[0];
			$d = $data[2];		
		}
		

		// verifica se a data é válida!
		// 1 = true (válida)
		// 0 = false (inválida)
		$res = checkdate($m,$d,$y);
		if ($res == 1){
		   //echo ",br />data ok!";
			$ret = TRUE;
		} else {
		   //echo "<br />data inválida!";
			$ret = FALSE;
		}
	
		return $ret;
	}

	function data_br($dt='00/00/0000') {				// recebe: aaaa/mm/dd   -   retorna: dd/mm/aaaa
	
	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)

		//echo $dt;
	
		$a =  substr($dt, 0, 4);	
		$m =  substr($dt, 5, 2);	
		$d =  substr($dt, 8, 2);	
		
		$dt_br = "Data Inválida";
		if (trim($dt) == '') { return ''; }
		
		if (checkdate($m,$d,$a) == 1) {
			$dt_br = ($d ."/". $m ."/". $a);
		}
		
		return $dt_br;			
	}


	function data_mysql($dt='00/00/0000') {				// recebe: dd/mm/aaaa   -   retorna: aaaa/mm/dd
	
	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)

		$d =  substr($dt, 0, 2);	
		$m =  substr($dt, 3, 2);	
		$a =  substr($dt, 6, 4);	

		$dt_form = "0000/00/00";
		if (strtoupper(substr($dt, 0, 4)) != 'DATA') {
			
			if (checkdate($m,$d,$a) == 1) {
				$dt_form = ($a ."-". $m ."-". $d);
			}
		}		
		return $dt_form;			
	}

	function formata_cnpj($cnpj) {
		if (empty($cnpj)) {return "CNPJ não informado !";}
	
		$cnpj = str_pad($cnpj, 14, "0", STR_PAD_LEFT);
		$ret = substr($cnpj, 0, 2) .".". 
				substr($cnpj, 2, 3) .".". 
				substr($cnpj, 5, 3) ."/".
				substr($cnpj, 8, 4) ."-".
				substr($cnpj, 12, 2);
				
		return $ret;
	}
	
	
	function name_of_month($month) {
	
		switch ($month) {
			case 1:
				$name = "January";				
				break;
			case 2:
				$name = "February";				
				break;
			case 3:
				$nome = "March";				
				break;
			case 4:
				$name = "April";				
				break;
			case 5:
				$name = "May";				
				break;
			case 6:
				$name = "June";				
				break;
			case 7:
				$name = "July";				
				break;
			case 8:
				$name = "August";				
				break;
			case 9:
				$name = "September";				
				break;
			case 10:
				$name = "October";				
				break;
			case 11:
				$name = "November";				
				break;
			case 12:
				$name = "December";				
				break;
							
			default:
				$name = "Wrong Month";				
				break;
		}
		
		return $nome; 
	}
	

							//Exemplo de uso dia semana("1985-03-30")
	function day_of_Week($data) {	
		$year =  substr($data, 0, 4);	
		$month =  substr($data, 5, -3);	
		$day =  substr($data, 8, 9);	
		$dayweek = date("w", mktime(0,0,0,$month,$day,$year) );	
		
		switch($dayweek) {		
			case"0": 
				$dayweek = "Sunday";	   
				break;		
			case"1": 
				$dayweek = "Monday"; 
				break;		
			case"2": 
				$dayweek = "Tuesday";   
				break;		
			case"3": 
				$dayweek = "Wednesday";  
				break;		
			case"4": 
				$dayweek = "Thursday";  
				break;		
			case"5": 
				$dayweek = "Friday";   
				break;		
			case"6": 
				$dayweek = "Saturday";		
				break;	
		}	
		
		echo "$dayweek";
	}
       	  
	
	function name_inst() {	
		return "Avaleea";		
	}


    function standard_message($type_message, $message, $links = array()) {
        
        $data['name_view'] = 'v_standard_message';
        
        switch ($type_message) {
            case 1:
                $value = "alert-success";                                       
                break;
            case 2:
                $value = "alert-info";                                       
                break;
            case 3:
                $value = "alert-warning";                                       
                break;
            case 4:
                $value = "alert-danger";                                       
                break;
        }
        
        $data['type_message'] = $value;
        $data['message'] = $message;
        $data['links'] = $links;       
        
        return $data;                    
    }

    //Essa função gera um valor de String aleatório do tamanho recebido por parametro($size)
    function randString($size){
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_';

        $return= "";

        for($count= 0; $size > $count; $count++){
            //Gera um caracter aleatorio
            $return .= $basic[rand(0, strlen($basic) - 1)];
        }

        return $return;

    	//Imprime uma String randônica com 20 caracteres
		//echo randString(20);
    }
	
	
	
	function escolaridade($id) {
		
		$id_escol = intval($id); 

		$escolaridade = array("", "Ensino Fundmental Incompleto", "Ensino Fundmental Completo", "Ensino Médio Incompleto", 
								"Ensino Médio Completo", "Ensino Médio Técnico", "Superior Incompleto", 
								"Superior Completo", "Pós Graduação", "Mestrado", 
								"Doutorado", "Pós Doutorado", "Outros");				
		return  $escolaridade[$id_escol];
	}


	function UF($uf='') {
			
		$estadosBrasileiros = array( 'AC'=>'Acre', 'AL'=>'Alagoas', 'AP'=>'Amapá', 'AM'=>'Amazonas',
									 'BA'=>'Bahia', 'CE'=>'Ceará', 'DF'=>'Distrito Federal', 
									 'ES'=>'Espírito Santo', 'GO'=>'Goiás', 'MA'=>'Maranhão', 
									 'MT'=>'Mato Grosso', 'MS'=>'Mato Grosso do Sul', 'MG'=>'Minas Gerais',
									 'PA'=>'Pará', 'PB'=>'Paraíba', 'PR'=>'Paraná', 'PE'=>'Pernambuco',
									 'PI'=>'Piauí', 'RJ'=>'Rio de Janeiro', 'RN'=>'Rio Grande do Norte',
									 'RS'=>'Rio Grande do Sul', 'RO'=>'Rondônia', 'RR'=>'Roraima', 
									 'SC'=>'Santa Catarina', 'SP'=>'São Paulo', 'SE'=>'Sergipe', 
									 'TO'=>'Tocantins', '' => 'Erro UF não Informada'
									);		
		return $estadosBrasileiros[$uf];
	}
	
	function estado_civil($ec=0) {
						
		$estado_civil = array("", "Solteiro(a)", "Casado(a)", "União Estável",
								"Divorciado(a)", "Viuvo(a)" ); 		
		return $estado_civil[$ec];	
	}
	
	function arrOp($id=0) {						// Função auxiliar do Controller Ouvidoria
		$ret = "";
		
		$CI =& get_instance();			
		//$logado = $CI->session->userdata("logado");
		$v_mostra = $CI->session->userdata("v_mostra");
		
		if ($v_mostra == 0){
			if ($id > 0) {
				$ret = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
							  "<a href='". base_url('/') ."' class='btn btn-primary'>  </a>",
					          "<a href='". base_url('/new') ."' class='btn btn-primary'> New </a>",
					          "<a href='". base_url('/edit/'.$id) ."' class='btn btn-primary'> Continue </a>");
			} else {
				$ret = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
					          "<a href='". base_url('/') ."' class='btn btn-primary'> </a>",                                                                                    
					          "<a href='". base_url('/new') ."' class='btn btn-primary'> New </a>");         
			}
		} else {
				$ret = array( "<a href='". base_url() ."' class='btn btn-info'> Home </a>", 
							  "<a href='". base_url('/view') ."' class='btn btn-primary'> View </a>");			
		}				 		
		return $ret;		
	}


	function configure_pagination($controller, $total_general, $per_page=10) {
		
		if ($controller == "") {
			return array(); 
		}
        
        $config['base_url'] = base_url("$controller");
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
		
		return $config;
	}
	
	function title_table($name = '') {			
		if ($name != '') {
			$title = array( 'academic_area' => 'Academic Area', 'disciplines' => 'Disciplines', 
							'situation' => 'Situation',	'application_mode' => 'Application Mode', 
							'application_type' => 'Application Type', 'presentation_type' => 'Presentation Type', 
							'questionnaries_type' => 'Questionnaries Type', 'alternatives_type' => 'Alternatives Type', 
							'level_type' => 'Level Type', 'grade_type' => 'Grade Type', 
							'occupation_area' => 'Occupation Area', 'categories' => 'Categories',
							'allows_interrupt' => 'Allows Interrupt', 'allows_navigate' => 'Allows Navigate',
							'mandatory_answers' => 'Mandatory Answers', 'flow_issues' => 'Flow Issues',
							'acquisition_type' => 'Acquisition Type'
						  );			
			return $title[$name];
		} else {
			return '';
		}									
	}

	function methods($name) {
		if ($name != '') {
					
			$title = array(
				'academic_area' => array( 'router' => 'acr_',
		   						  		 'method' => 'academic_area',				
					 					 'sequential' => '01',			
		   						  		 'table' => 'tbacademic_area',					   						  		 
		   						  		 'title' => 'Academic Area',
		   						  		 'letter' => 'A',
		   						  		 'icon' => 'ion ion-ios-photos'
				),
				'disciplines' => array( 'router' => 'dsc_',
										 'method' => 'disciplines',
										 'sequential' => '02',
		   						  		 'table' => 'tbdisciplines',
		   						  		 'title' => 'Disciplines',
		   						  		 'letter' => 'D',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'situation' => array( 'router' => 'stn_',
										 'method' => 'situation',
										 'sequential' => '03',
		   						  		 'table' => 'tbsituation',
		   						  		 'title' => 'Situation',
		   						  		 'letter' => 'S',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'application_mode' => array( 'router' => 'apm_',
										 'method' => 'application_mode',					
										 'sequential' => '04',
		   						  		 'table' => 'tbapplication_mode',
		   						  		 'title' => 'Application Mode',
		   						  		 'letter' => 'M',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    											  
				'application_type' => array( 'router' => 'apt_',
										 'method' => 'application_type',
										 'sequential' => '05',
		   						  		 'table' => 'tbapplication_type',
		   						  		 'title' => 'Application Type',
		   						  		 'letter' => 'T',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'presentation_type' => array( 'router' => 'prt_',
										 'method' => 'presentation_type',					
										 'sequential' => '06',
		   						  		 'table' => 'tbpresentation_type',
		   						  		 'title' => 'Presentation Type',
		   						  		 'letter' => 'P',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'questionnaries_type' => array( 'router' => 'qnt_',
										 'method' => 'questionnaries_type',					
										 'sequential' => '07',
		   						  		 'table' => 'tbquestionnaries_type',
		   						  		 'title' => 'Questionnaries Type',
		   						  		 'letter' => 'Q',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'alternatives_type' => array( 'router' => 'alt_',
										 'method' => 'alternatives_type',					
										 'sequential' => '08',
		   						  		 'table' => 'tbalternatives_type',
		   						  		 'title' => 'Alternatives Type',
		   						  		 'letter' => 'L',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'level_type' => array( 'router' => 'lvt_',
										 'method' => 'level_type',					
										 'sequential' => '09',
		   						  		 'table' => 'tblevel_type',
		   						  		 'title' => 'Level Type',
		   						  		 'letter' => 'E',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    											  
				'grade_type' => array( 'router' => 'grt_',
										 'method' => 'grade_type',					
										 'sequential' => '10',
		   						  		 'table' => 'tbgrade_type',
		   						  		 'title' => 'Grade Type',
		   						  		 'letter' => 'G',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'occupation_area' => array( 'router' => 'occ_',
										 'method' => 'occupation_area',					
										 'sequential' => '11',
		   						  		 'table' => 'tboccupation_area',
		   						  		 'title' => 'Occupation Area',
		   						  		 'letter' => 'O',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'categories' => array( 'router' => 'ctg_',
										 'method' => 'categories',					
										 'sequential' => '12',
		   						  		 'table' => 'tbcategories',
		   						  		 'title' => 'Categories',
		   						  		 'letter' => 'C',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'allows_interrupt' => array( 'router' => 'awi_',
										 'method' => 'allows_interrupt',
										 'sequential' => '13',
		   						  		 'table' => 'tballows_interrupt',
		   						  		 'title' => 'Allows Interrupt',
		   						  		 'letter' => 'I',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'allows_navigate' => array( 'router' => 'awn_',
										 'method' => 'allows_navigate',					
										 'sequential' => '14',
		   						  		 'table' => 'tballows_navigate',
		   						  		 'title' => 'Allows Navigate',
		   						  		 'letter' => 'N',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'mandatory_answers' => array( 'router' => 'myw_',
										 'method' => 'mandatory_answers',					
										 'sequential' => '15',
		   						  		 'table' => 'tbmandatory_answers',
		   						  		 'title' => 'Mandatory Answers',
		   						  		 'letter' => 'Y',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'flow_issues' => array( 'router' => 'fwi_',
										 'method' => 'flow_issues',					
										 'sequential' => '16',
		   						  		 'table' => 'tbflow_issues',
		   						  		 'title' => 'Flow Issues',
		   						  		 'letter' => 'F',
		   						  		 'icon' => 'ion ion-ios-photos'
				),	    
				'acquisition_type' => array( 'router' => 'acq_',
									 	 'method' => 'acquisition_type',					
										 'sequential' => '17',
			   					  		 'table' => 'tbacquisition_type',
			   					  		 'title' => 'Acquisition Type',
			   					  		 'letter' => 'U',
		   					  		 	 'icon' => 'ion ion-ios-photos'
				)	    
			);
		}
	}

	
	function table_letter($name = '') {
		if ($name != '') {		
			$title = array( 'academic_area' => 'A', 'disciplines' => 'D',
							'situation' => 'S',	'application_mode' => 'M', 
							'application_type' => 'T', 'presentation_type' => 'P', 
							'questionnaries_type' => 'Q', 'alternatives_type' => 'L', 
							'level_type' => 'E', 'grade_type' => 'G', 
							'occupation_area' => 'O', 'categories' => 'C',
							'allows_interrupt' => 'I', 'allows_navigate' => 'N',
							'mandatory_answers' => 'Y', 'flow_issues' => 'F',
							'acquisition_type' => 'U' 
						  );	
			return $title[$name];
		} else {
			return 'X';
		}									
	}	

	define("TABLE_SYSTEM", array('academic_area' => 'Academic Area', 'disciplines' => 'Disciplines', 
							'situation' => 'Situation',	'application_mode' => 'Application Mode', 
							'application_type' => 'Application Type', 'presentation_type' => 'Presentation Type', 
							'questionnaries_type' => 'Questionnaries Type', 'alternatives_type' => 'Alternatives Type', 
							'level_type' => 'Level Type', 'grade_type' => 'Grade Type', 
							'occupation_area' => 'Occupation Area', 'categories' => 'Categories',
							'allows_interrupt' => 'Allows Interrupt', 'allows_navigate' => 'Allows Navigate',
							'mandatory_answers' => 'Mandatory Answers', 'flow_issues' => 'Flow Issues',
							'acquisition_type' => 'Acquisition Type'
						  ));	
	

	define("TABLE_BUSINESS", array('industry' => 'Industry', 'modules' => 'Modules', 
							'questionnaries' => 'Questionnaries', 'customization' => 'Customization', 
							'images' => 'Images', 'questions' => 'Questions', 
							'alternatives' => 'Alternatives', 'applicationq' => 'Application', 
							'evaluation' => 'Evaluation', 'answers' => 'Answers',
							'invitations' => 'Invitations' 
						  ));	

	function icons_business($name = '') {
		if ($name != '') {		
			$icon = array('industry' => 'ion ion-ios-home', 'modules' => 'ion ion-ios-photos', 
							'questionnaries' => 'ion ion-ios-paper', 'customization' => 'ion ion-load-b', 
							'images' => 'ion ion-images', 'questions' => 'ion ion-ios-list', 
							'alternatives' => 'ion ion-android-checkbox', 'applicationq' => 'ion ion-android-desktop', 
							'evaluation' => 'ion ion-ios-bookmarks', 'answers' => 'ion ion-calendar',
							'invitations' => 'ion ion-android-mail' 
						  );	
			return $icon[$name];
		} else {
			return '';
		}									
	}
	

	define("TABLE_REGISTRATION", array('people' => 'People', 'users' => 'Users', 
							'userlevel' => 'User Level', 'setup' => 'Global Setup'
						  ));	

	function icons_registration($name = '') {
		if ($name != '') {		
			$icon = array('people' => 'ion ion-person', 'users' => 'ion ion-person-stalker', 
							'userlevel' => 'ion ion-android-menu', 'setup' => 'ion ion-android-settings'
						  );	
			return $icon[$name];
		} else {
			return '';
		}									
	}
			
	function send_email_generall($data) {
		$CI =& get_instance();
		
		$in = $data['name_sender'];
		$in_email = $data['email_sender'];
		$for = $data['name_recipient'];
		$for_email = $data['email_recipient'];
		$subject = $data['subject'];
		$msg = $data['message'];
		
		$CI->load->library('email');
		$CI->email->from($in_email, $in);
		$CI->email->to($for_email);  
		$CI->email->subject($subject);
		$CI->email->message($msg);
		
		if ($CI->email->send()) {
			$CI->session->set_userdata('message_email','Email successfully sent!');
			$ret = TRUE;            
		
		} else {
            $CI->session->set_userdata('message_email',$CI->email->print_debugger());
			$ret = FALSE;											
		}

		//echo $this->email->print_debugger();         //COMANDO QUE MOSTRA COMO ACONTECEU O ENVIO DA MENSAGEM NO SERVIDOR		
		//redirect(base_url("home"));
		
		return $ret;								
	}

	function message_invitation($parm, $link, $name) {
		
		if ($parm == 1) {
			$msg = " \n\nGood Morning  ! \n\n\n";
			$msg .= "          We came across this email inviting you to test the Avaleea platform of application questionnaires, ";
			$msg .= " we would like you to create some questionnaires and validate our service. \n";
						
			$msg .= "          If you are interested in our invitation you can access the link below to confirm "; 
			$msg .= "your registration and receive your access data, username and password, in the "; 
			$msg .= "first time you use will have to change the password. \n\n\n";
		
		    $msg .=	" Link: ". $link ."\n\n\n\n";
			$msg .= " Congratulations, \n\n\n";
			$msg .= " ". $name ."\n";
			$msg .= " Avaleea Questionnaires Platform \n";
			$msg .= " https://cied.inf.br \n";						
		
		} else {
			$msg = " \n\nGood Morning  ! \n\n\n";
			$msg .= " 		   We came across this email inviting you to test the Avaleea platform of application questionnaires, we would like you to answer some questionnaires and validate our service. \n";
						
			$msg .= "		   If you are interested in our invitation you can access the link below to confirm your registration and receive your access data, username and password, in the first time you use will have to change the password. \n\n\n";
		
		    $msg .=	"Link: ". $link ."\n\n\n\n";
			$msg .= " Congratulations, \n\n";
			$msg .= " ". $name. " \n";
			$msg .= "Avaleea Questionnaires Platform \n";
			$msg .= "https://cied.inf.br \n\n";									
		}
			
		return $msg;
	}	
	
	function message_registration($login, $pass) {
		
		$msg = " \n\nGood Morning  ! \n\n\n";
		$msg .= "          Thank you very much, your registration has been confirmed, we are "; 
		$msg .= "sending in this email your login ";

		if (trim($pass) != "" ) {
			$msg .= "and your new password, the first time you have to change it, for security reasons. ";
		} else {
			$msg .= ", to remind you, if you have forgotten your password use the option in the login screen '<forgot password>'. ";
		}

		$msg .= "\n\n\n Your login is: ". $login;
		if (trim($pass) != "" ) {
			$msg .= "\n\n Your password is: ". $pass  ." \n";
		}
					
		$msg .= " \n\n\n Congratulations, \n\n\n";
		$msg .= " System Support, " ."\n";
		$msg .= " Avaleea Questionnaires Platform \n";
		$msg .= " https://avaleea.pesabreu.com.br \n";						
			
		return $msg;
	}	
	
	
	