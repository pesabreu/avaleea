<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	           		
    public function __construct() {

        parent::__construct();                        

	    //$var = $this->session->userdata("external_questions");
    	//$external_questions = isset($var) ? $var : FALSE;
		//if ($external_questions) { $this->session->set_userdata("logged", '0'); }
    	//$var = $this->session->userdata("logged");
    	//$logged = isset($var) ? $var : '0';
		
		
		//$this->session->set_userdata("id_edit", 0);
		//$this->session->set_userdata("type_edit", "");
		$this->session->set_userdata("external_questions", FALSE);
        $this->session->set_userdata("external_test", FALSE);
		$this->session->set_userdata("qty", 0);
    }

	public function index() {
/*
		echo "<br /><br />";	
		print_r($this->session->all_userdata());		//error_reporting(E_ALL);		
		echo "<br /><br />";
		var_dump($_COOKIE);
		echo "<br /><br />";
		echo " serialize => ". serialize($_COOKIE["avaleea"]);
		exit;
		//echo "cookie => ". serialize($_COOKIE);
			
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('source');
		$this->session->unset_userdata('name_file');
		$this->session->unset_userdata('file_pointer');
		$this->session->unset_userdata('save_questions_external');
		$_COOKIE = array();
		setcookie('avaleea', '', time() - 3600);
		unset($_COOKIE["avaleea"]);
		
		echo "<br />userdata : <br /> ";
		print_r($this->session->all_userdata());		//error_reporting(E_ALL);
		echo "<br /> cookie : <br />";
		var_dump($_COOKIE);
	//	exit;
*/			
		$this->session->set_userdata("source", 'home');
		
	    $var = $this->session->userdata("logged");
    	$logged = isset($var) ? $var : 0;
    
		$var = $this->session->userdata("category_user");
		$category_user = isset($var) ? $var : 0;
	 
    	$var = $this->session->userdata("id_people_admin");
    	$id_people_admin = isset($var) ? $var : 0;	
		
		if ($logged == '1') {		
	        $data['authors'] = $this->m_people->return_categorie(0);		// with invited authors
			$data['candidates'] = $this->m_people->return_categorie(0);	// with invited candidate
			
			$var = $this->session->userdata("candidate_questionnaries");
			$candidate_questionnaries = isset($var) ? $var : "0"; 			
			if ($candidate_questionnaries == "1") {						//  <====================			
				$var = $this->session->userdata("id_questionnaries");
				$id_questionnaries = isset($var) ? $var : 0;
				
					$id_questionnaries = 1;										//  <====================

				$data['questionnaries'] = $this->m_questionnaries->return_questionnaries($id_questionnaries)->row();																
				$data['questions'] = $this->m_questions->return_questions_completed($id_questionnaries);	// with invited candidate							
				$this->session->set_userdata("candidate_questionnaries", "0");				
												
			} else {
				$data['questionnaries'] = $this->m_questionnaries->return_questionnaries_people($id_people_admin);	// without invited candidate
				$data['applications'] = $this->m_application->return_applications_people($id_people_admin);	// without invited candidate
								
				if ($category_user == 3) {
	//				print_r($data['questionnaries']);
					//exit;
					$data['list_modules'] = $this->m_modules->list_modules();						
					$data['list_questionnaries_type'] = $this->m_tabsys->list_tabsys('tbquestionnaries_type');						
					$data['list_alternatives_type'] = $this->m_tabsys->list_tabsys('tbalternatives_type');
					$data['list_level_type'] = $this->m_tabsys->list_tabsys('tblevel_type');		
					$data['list_situation'] = $this->m_tabsys->list_tabsys('tbsituation');
					
					$data['list_presentation_type'] = $this->m_tabsys->list_tabsys('tbpresentation_type');
					$data['list_allows_interrupt'] = $this->m_tabsys->list_tabsys('tballows_interrupt');
					$data['list_allows_navigate'] = $this->m_tabsys->list_tabsys('tballows_navigate');
					$data['list_mandatory_answers'] = $this->m_tabsys->list_tabsys('tbmandatory_answers');
					$data['list_flow_issues'] = $this->m_tabsys->list_tabsys('tbflow_issues');						

					$data['list_application_type'] = $this->m_tabsys->list_tabsys('tbapplication_type');						
					$data['list_application_mode'] = $this->m_tabsys->list_tabsys('tbapplication_mode');						
					$data['people'] = $this->m_people->return_people();	// without invited candidate	
				}			// $category_user != 3
				
				if ($category_user == 4) {
					$data['invitations'] = $this->m_invitations->return_application_candidate(0, $id_people_admin);						
				}		
			}											
		} else {			
			if (intval($logged) > 2) {	// External
				redirect(base_url('home/external_questions'));

			} else {				// Not Logged
				//
			}
		}								
        $data['name_view'] = 'v_home';
        $this->load->view('v_layout', $data);
	}
	
    public function ajuda() {

        $data['name_view'] = 'v_ajuda';
        $this->load->view('v_layout', $data);        
    }
    
	public function external_questions($action = "") {
		
		$var = $this->session->userdata("logged");
		$logged = isset($var) ? intval($var) : 0;
		$type_edit = "";
		
		if (trim($action) == "edit_questions") {
			$id_edit = $this->session->userdata("id_edit");
			$id_test = $this->session->userdata("id_test");		
			$type_edit = strtolower($this->session->userdata("type_edit"));
			if ($id_edit == "0" || trim($type_edit) == "" || $type_edit == '') {				
				$action = "";
			}			
		}
		
		$data['tests'] = array(); 
		$data['action'] = "";
		if (trim($action) != "") {
			$data['action'] = trim($action);			
		}

		if ($action == "dashboard") {
			if ($logged != '3') {	
				renumber_questions_file();
			}
		}
		
		if ($action == "clear") {			
			$this->clear_all();
			redirect(base_url());		
		}
					
		$cookie = $this->cookie_exists($logged);
		
		if ($cookie) {			
			//echo "<br /><br /><br />";
			//echo "Tem Cookie => ". $logged;
			//exit;
			
			if ($logged < 3) {				
				$name_file = $cookie["name_file"];
				$quantity =	$cookie["quantity"];

				$fp = fopen(URL_UPL_QUESTIONS.$name_file, "a+");							
				if ( ! $fp ) {
					return FALSE;
				}
				
				$this->session->set_userdata("logged", '2');
				$this->session->set_userdata("file_pointer", $fp);
				$this->session->set_userdata("name_file", $name_file);
				$this->session->set_userdata("save_questions_external", $quantity);
				$this->session->set_userdata("id_edit", 0);		
				$this->session->set_userdata("type_edit", '');
				
				if ($action == 'edit_questions') {				
					$data['tests'] = $this->filter_question_edit($id_edit, $type_edit);					
					$data['id_edit'] = $id_edit;
					$data['type_edit'] = $type_edit;
					
				} else {					
					$data['tests'] = $this->load_file_questions($cookie);
				}				
						
			} else {			
				$create_cookie = $cookie;	// Cookie user (Logged)
			}				
			
		} else {						
			//echo "<br /><br /><br />";
			//echo "Não Tem Cookie => ". $logged;
			//exit;

			if ($logged < 3) {
				$create_cookie = $this->create_cookie(1);	// Cookie visitor (not logged)
				$data['tests'] = array();									
						
			} else {			
				$create_cookie = $this->create_cookie(2);	// Cookie user (Logged)													
			}				
		}

		if ($logged == 3) {
			
			switch ($action) {
				case '':
				case 'dashboard':
					$id_usuario = $this->session->userdata("id_users");
					$data['tests'] = $this->m_questionnaries->return_tests_external($id_usuario);
					break;
				
				case 'test_questions':
					$id_test = $this->session->userdata("id_test");
					$data['tests'] = $this->m_questionnaries->return_test_questions($id_test);
					$data['id_test'] = $id_test;			
					break;
													
				case 'edit_questions':
					$tests = $this->m_questions->return_questions_completed(0, $id_edit)->result_array();					
					$data['tests'] = $this->filter_questions_db($tests, $type_edit);
					$data['id_edit'] = $id_edit;
					$data['id_test'] = $id_test;					
					$data['type_edit'] = $type_edit;
					break;

				default:
					//return FALSE;
					break;
			}						
		}	
		
		$this->session->set_userdata("type_edit", $type_edit);						
		$this->session->set_userdata("source", 'external_question');	
		$this->session->set_userdata("external_questions", TRUE);
								
        $data['name_view'] = 'v_home';
        $this->load->view('v_layout', $data);
	}
    
	public function external_test() {
		
		$this->session->set_userdata("source", 'external_test');	
		$this->session->set_userdata("external_test", TRUE);
		echo "<br /> <br /> External Test <br />";	
	}

	public function cookie_exists($logged) {
		
		if ($logged < 3) {
			$name_cookie = "avaleea";
			
		} else {
			$user = $this->session->userdata("user");
			$name_cookie = "avaleea_". $user; 			
		}				
		
		$cookie = isset($_COOKIE[$name_cookie]) ? $_COOKIE[$name_cookie] : FALSE;
		if ($cookie) {
			$ret = unserialize($cookie);	
		
		} else {
			$ret = FALSE;
		}
		
		return $ret;
	}

	public function create_cookie($tipo = 1) {

		switch ($tipo) {
			
			case '1':								// Not logged
				$prefix = randString(12);

				$name_cookie = "avaleea";
				$time = time() + (3600*24*1*1*1);	// 1 day expiry date

				$name_file = $prefix ."_". date("Y-m-d") .".avl";														
				$fp = fopen(URL_UPL_QUESTIONS.$name_file, "w+");
							
				if ( ! $fp ) {
					return FALSE;
				}
				
				$this->session->set_userdata("name_file", $name_file);
				$this->session->set_userdata("prefix", $prefix);
				$this->session->set_userdata("logged", '2');
				$this->session->set_userdata("file_pointer", $fp);
				$this->session->set_userdata("save_questions_external", 0);								 			
				break;

			case '2':								// Logged
				$prefix = $this->session->userdata("user");
				$name_file = $prefix ."_". date("Y-m-d") .".avl";

				$name_cookie = "avaleea_". $prefix;
				$name_file = $name_cookie;
				$time = time() + (3600*24*30*1*1);	// 30 days expiry date				
				break;
		}
		
		$value_cookie = array(
			"identify" => $prefix,
			"name_file" => $name_file,
			"quantity" => $this->session->userdata("save_questions_external")
		);

		$cookie = setcookie($name_cookie, serialize($value_cookie), $time, "http://localhost/avaleea/home/external_questions");
		return $cookie;
	}		
	
	public function load_file_questions($cookie) {
		
		$ret = array();
		
		$name_file = $cookie['name_file'];
		
		$size_file = filesize(URL_UPL_QUESTIONS.$name_file);

		if ( !$size_file ) {
			return FALSE; 
		}		
		if ($size_file > 0) {
			
			$fp = $this->session->userdata("file_pointer");
			$ret = file(URL_UPL_QUESTIONS.$name_file);
		}
		return $ret;
	}

	public function clear_all() {
		ob_start();
		$filename = URL_UPL_QUESTIONS. $this->session->userdata('name_file');
		unlink($filename);
		
		$var = $this->session->userdata("logged");
		$logged = isset($var) ? $var : 0;
		$name_cookie = "avaleea";
		if ($logged == "3") {
			$name_cookie = "avaleea_".$this->session->userdata("user");
		}
						
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('source');
		$this->session->unset_userdata('name_file');
		$this->session->unset_userdata('file_pointer');
		$this->session->unset_userdata('save_questions_external');
		$this->session->unset_userdata("id_edit");		
		$this->session->unset_userdata("type_edit");

		setcookie('avaleea');							
//		setcookie('avaleea', '', time() - 3600, "http://localhost/avaleea/home/external_questions");
		unset($_COOKIE["avaleea"]);

		setcookie($name_cookie);			
//		setcookie($name_cookie, '', time() - 3600, ""http://localhost/avaleea/home/external_questions"");
		unset($_COOKIE[$name_cookie]);
		
		$_COOKIE = array();
		return TRUE;
	}
	
	public function renumber_questions_file1() {

		$arquivo = $this->session->userdata("name_file");			
		$file = file(URL_UPL_QUESTIONS.$arquivo); 			// Lê todo o arquivo para um vetor 

		$i = 0;
	    foreach($file as $k => $linha) {					// passa linha a linha do arquivo 
									
			if ( substr($linha, 2, 5) == "start" ) {
	        	$i++;	 
	        	$num = str_pad( $i, 3, "0", STR_PAD_LEFT);
				$p1 = substr($linha, 0, 15);
				$p2 = substr($linha, 18);
				$file[$k] = $p1. $num .$p2;	
			}
 		} 
		     	 
    	file_put_contents(URL_UPL_QUESTIONS.$arquivo, $file);		// Reescrevendo o arquivo	

		$this->session->set_userdata("save_questions_external", $i);

		return TRUE;
	}

	public function filter_question_edit($id, $type) {
		
		$arquivo = $this->session->userdata("name_file");			
		$file = file(URL_UPL_QUESTIONS.$arquivo); 			// Lê todo o arquivo para um vetor 

		$array = array();
		$find = FALSE;
		$right = "";
			
	    foreach($file as $k => $linha) { // passa linha a linha do arquivo 
        	
        	if ( (substr($linha, 0, 3) == "   ") || (trim(substr($linha, 0, 3)) == "") ) {
        		continue;
        	}
        				
			if ( substr($linha, 2, 5) == "start" ) {
				if( intval(substr($linha, 15, 3)) == intval($id) && substr($linha, 10, 2) == $type ) {
	        		$find = TRUE;
					//array_push($array, $file[$k]);					
				}
				continue;
			}

			if ( $find && (substr($linha, 0, 3) == "stt" )) {
				$arr = array(
					substr($linha, 0, 3) => substr($linha, 6)
				);					

				array_push($array, $arr);
				continue;				
			}
        	
			if ( $find && (substr($linha, 0, 5) == "right" )) {
				$right = intval(substr($linha, 11, 1));				
				continue;				
			}			
        	
			if ( $find && (substr($linha, 0, 3) == "qty" )) {
				$qty = intval(substr($linha, 12, 1));
				$arr = array(
					substr($linha, 0, 3) => $qty
				);					
				array_push($array, $arr);				
				continue;				
			}			
			
        	if ( $find && (substr($linha, 2, 3) == "end") ) {
        		$find = FALSE;
        		//array_push($array, $file[$k]);		        	
        	}
            
            if ($find && (substr($linha, 2, 5) != "start")) {
            		
				if ($type == "mc") {
					
					$rw = 'w';
					if ( intval( substr($linha, 3, 1)) == $right ) { $rw = 'r'; }
					$arr = array(
						substr($linha, 0, 4) => substr($linha, 7),
						'right' => $rw
					);					
				}					
				if ($type == "tf") {
					
					$tf = strtoupper(substr($linha, 7, 1));
					
					$arr = array(
						substr($linha, 0, 4) => substr($linha, 11),
						'truefalse' => $tf
					);					
				}					
				if ($type == "fg") {
										
					$arr = array(
						substr($linha, 0, 3) => substr($linha, 6)
					);
				}						
				if ($type == "sq") {
										
					$arr = array(
						substr($linha, 0, 3) => substr($linha, 6)
					);					
				}					
            	array_push($array, $arr);
			}			
		}		
			
		return $array;
	}
	
	public function filter_questions_db($tests, $type_edit) {	

		$array = array();
		$find = FALSE;
		$i = 0;

		foreach ($tests as $value) {
/*
			echo "<br /><br /><br /><br /> inicio =>";
			echo $value['id_alternatives_type'];
			//print_r($value);
			echo "<br />";
*/
			$i++;
			if ($i == 1) {	
				$arr = array(
					"stt" => $value['enunciation']
				);					
				array_push($array, $arr);
			}
			
			$this->session->set_userdata("qty", count($tests));																			
			$this->session->set_userdata("type", $value['id_alternatives_type']);
					
			switch ($value['id_alternatives_type']) {
				case 1:									// MC
					$arr = array(
						"asw".$i => $value['description_alternatives'],
						'right' => $value['right_wrong'] == '1' ? 'r' : 'w'
					);					
					array_push($array, $arr);
					break;

				case 2:									// TF
					$arr = array(
						"iss".$i => $value['description_alternatives'],
						'truefalse' => $value['right_wrong'] == '1' ? 'T' : 'F'
					);					
					array_push($array, $arr);
					break;

				case 3:										// FG
					$qty = 1;
					if (trim($value['gap_3']) != "") {
						$qty = 3;
					} else {
						if (trim($value['gap_2']) != "") {
							$qty = 2;
						} 
					}					
					$arr = array(
						"qty" => $qty
					);					
					array_push($array, $arr);
					$this->session->set_userdata("qty", $qty);																			
					
					$arr = array(
						"pt1" => trim($value['name_questions'])
					);					
					array_push($array, $arr);
					
					$arr = array(
						"gp1" => trim($value['description_alternatives'])
					);					
					array_push($array, $arr);
					
					if (trim($value['gap_2']) == "") {					
						$arr = array(
							"lst" => trim($value['part_2'])
						);					
						array_push($array, $arr);					
						
					} else {
						$arr = array(
							"pt2" => trim($value['part_2'])
						);											
						array_push($array, $arr);
											
						$arr = array(
							"gp2" => trim($value['gap_2'])
						);											
						array_push($array, $arr);					
					}
					
					if (trim($tests['gap_3']) == "") {					
						$arr = array(
							"lst" => trim($value['part_3'])
						);					
						array_push($array, $arr);					
					
					} else {
						$arr = array(
							"pt3" => trim($value['part_3'])
						);											
						array_push($array, $arr);

						$arr = array(
							"gp3" => trim($value['gap_3'])
						);											
						array_push($array, $arr);					
						
						$arr = array(
							"lst" => trim($value['part_4'])
						);					
						array_push($array, $arr);					
					}
					break;

				case '4':								// SQ
					$arr = array(
						"sbq" => $value['description_alternatives']
					);					
					array_push($array, $arr);
					break;
				
				default:
					return FALSE;
					break;
			}			
		}

		return $array;
	}

}					// End Class
