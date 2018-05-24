<?php
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	           		
    public function __construct() {

        parent::__construct();                        
		session_start();
	    //$var = $this->session->userdata("external_questions");
    	//$external_questions = isset($var) ? $var : FALSE;
		//if ($external_questions) { $this->session->set_userdata("logged", '0'); }
    	//$var = $this->session->userdata("logged");
    	//$logged = isset($var) ? $var : '0';
		
		
		//$this->session->set_userdata("id_edit", 0);
		//$this->session->set_userdata("type_edit", "");
		$this->session->set_userdata("external_questions", FALSE);
        $this->session->set_userdata("external_test", FALSE);
		$this->session->set_userdata("quantity", 0);
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
		$this->session->unset_userdata('quantity');
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
			if ($logged == "2" || $logged == "3") {	// External
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
 
	

/**************************************************************************************************
*
*		Method interface external
*  
* **************************************************************************************************/

    
	public function external_questions($action = "") {
        //ob_start();
        session_start();
		//$this->session->set_userdata("external_questions", TRUE);
		
		$logged = "2";
		$type_edit = "";
		
//		setcookie("teste", "nada", ( time() + 3600 ), "/");
		$ret = $_COOKIE['avaleea'];
		$cook = isset($ret) ? $_COOKIE['avaleea'] : FALSE;
		if ($cook) {
			$cookie = unserialize($cook);
			$logged = $cookie['logged'];	
		}
		
		if (trim($action) == "edit_questions_file") {
					
			$id = $this->input->get("id");
			$id_test = $this->input->get("id_test");
			$type = strtolower($this->input->get("type"));
	
			$this->session->set_userdata("id_edit", $id);		
			$this->update_cookie("id_edit", $id);
			//$_SESSION['id_edit'] = $id;
			
			$this->session->set_userdata("id_test", $id_test);		
			$this->update_cookie("id_test", $id_test);
			//$_SESSION['id_test'] = $id_test;
			
			$this->session->set_userdata("type_edit", $type);
			$this->update_cookie("type_edit", $type);				
			//$_SESSION['type_edit'] = $type;
			
			$cookie = unserialize($_COOKIE['avaleea']);
			$action == "edit_questions";
			echo "TRUE";
			exit;
		}
				
		if (trim($action) == "edit_questions") {			
			$id_edit = $this->session->userdata("id_edit");
			if ($id_edit == 0) {
				$id_edit = $cookie['id_edit'];
			}
						
			$id_test = $this->session->userdata("id_test");
			if ($id_test == 0) {
				$id_test = $cookie['id_test'];		
			}
			
			$type_edit = strtolower($this->session->userdata("type_edit"));
			if (trim($type_edit) == "") {
				$type_edit = strtolower($cookie['type_edit']);
			}
			
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
			$action = "dashboard";
			$data['action'] = trim($action);
			//redirect(base_url('home/external_questions/dashboard'));		
		}
					
		$cookie = $this->cookie_exists($logged);
		
		if ($cookie) {			
			//echo "<br /><br />";
			//echo "Tem Cookie => ". $logged;
			//exit;
			
			if ($logged < 3) {				
				$name_file = $cookie["name_file"];
				$quantity =	$cookie["quantity"];
	
				//echo "<br /> Arq. => ". $name_file;

				$fp = fopen(URL_UPL_QUESTIONS.$name_file, "a+");							
				if ( ! $fp ) {
					return FALSE;
				}
				
				$this->session->set_userdata("logged", '2');
				$this->session->set_userdata("file_pointer", $fp);
				$this->session->set_userdata("name_file", $name_file);
				$this->session->set_userdata("quantity", $quantity);
				$this->session->set_userdata("id_edit", 0);		
				$this->session->set_userdata("type_edit", '');

				$update_cookie = $this->update_cookie("file_pointer", $fp);
				$cookie = unserialize($_COOKIE["avaleea"]);
																
				if ($action == 'edit_questions') {				
					$data['tests'] = $this->filter_question_edit($id_edit, $type_edit);					
					$data['id_edit'] = $id_edit;
					$data['type_edit'] = $type_edit;
					
				} else {					
					$data['tests'] = $this->load_file_questions($cookie);
				}				
						
			} else {			
				$create_cookie = $cookie;	// Cookie user (Logged)
				$cookie = unserialize($_COOKIE["avaleea"]);
			}				
			
		} else {						
			//echo "<br /><br /><br />";
			//echo "Não Tem Cookie => ". $logged;
			//exit;

			if ($logged < 3) {
				$create_cookie = $this->create_cookie(1);	// Cookie visitor (not logged)
				$cookie = unserialize($_COOKIE["avaleea"]);
				
				if ($action == 'edit_questions') {				
					$data['tests'] = $this->filter_question_edit($id_edit, $type_edit);					
					$data['id_edit'] = $id_edit;
					$data['type_edit'] = $type_edit;
					
				} else {					
					$data['tests'] = $this->load_file_questions($cookie);
				}								
//				$data['tests'] = array();									
						
			} else {			
				$create_cookie = $this->create_cookie(1);	// Cookie user (Logged)
				$cookie = unserialize($_COOKIE[avaleea]);													
			}				
		}

		if ($logged == 3) {
			
			switch ($action) {
				case '':
				case 'dashboard':
					$id_usuario = $this->session->userdata("id_users");
					if ($id_usuario == 0) {
						$id_usuario = $cookie["id_users"];					
					}	
					$data['tests'] = $this->m_questionnaries->return_tests_external($id_usuario);
					break;
				
				case 'test_questions':
					$id_test = $this->session->userdata("id_test");
					if ($id_test == 0) {
						$id_test = $cookie["id_test"];					
					}
					
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
				
				case 'new':
					$id_test = $this->session->userdata("id_test");
					if ($id_test == 0) {
						$cookie['id_test'];
					}					
					$data['id_test'] = $id_test;			
					break;

				default:
					//return FALSE;
					break;
			}						
		}	
		
		$this->session->set_userdata("type_edit", $type_edit);
		$this->update_cookie("type_edit", $type_edit);
								
		$this->session->set_userdata("source", "external_question");
		$this->update_cookie("type_edit", "external_question");
			
		$this->session->set_userdata("external_questions", TRUE);
		$this->update_cookie("external_questions", TRUE);
								
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
			//$user = $this->session->userdata("user");
			//$name_cookie = "avaleea_". $user;
			$name_cookie = "avaleea";			 			
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
		$fp = 0;
		$name_cookie = "avaleea";
		$prefix = randString(12);
				
		switch ($tipo) {
			
			case '1':
				
												// Not logged
				$name_cookie = "avaleea";
				$time = time() + (3600*24*30*1*1);	// 1 day expiry date
                
        		$root =  $_SERVER['DOCUMENT_ROOT'];

   				$name_file = $prefix ."_". date("Y-m-d") .".avl";
        
                if ( trim($name_file) == "" ) {
                    return FALSE;
                }

                $fp = fopen($root."avaleea/uploads/temp_questions/".$name_file, "w+");
              	if ( ! $fp ) {
					return FALSE;
				}
                $this->session->set_userdata("name_file", $name_file);
                $this->session->set_userdata("quantity", 0);								 			
				$this->session->set_userdata("logged", '2');
			    $this->session->set_userdata("prefix", $prefix);				
				$this->session->set_userdata("file_pointer", $fp);
				break;

			case '2':								// Logged
				$prefix = $this->session->userdata("user");
//				$name_file = $prefix ."_". date("Y-m-d") .".avl";

				//$name_cookie = "avaleea_". $prefix;
				$name_cookie = "avaleea";

				$time = time() + (3600*24*30*1*1);	// 30 days expiry date				
				break;
		}

		$value_cookie = array(
			"identify" => $prefix,
			"name_file" => $name_file,
			"quantity" => 0,
			"logged" => '2',
			"file_pointer" => $fp,
			"id_edit" => 0,
			"id_test" => 0,
			"type_edit" => "",
			"type" => 0,
			"id_users" => "",
			"source" => "external_question",						
			"external_questions" => TRUE,		
			"user" => "",
            "id_users" => 0,
			"category_user" => 5,						
			"id_people_admin" => 0,
			"name_user" => "",
			"email_admin" => "",        
			"id_level_users" => 4,
			"dt_creation" => "",
			"origem" => 0,
			"itens_per_page" => $this->m_setup->return_setup()->row()->items_per_page
		);
		
		$ret = setcookie('avaleea', serialize($value_cookie), $time, "/");		
		//$cookie = $_COOKIE[$name_cookie];
		
		return $ret;
	}		
			
	public function update_cookie($fields="", $value="") {

		$time = time() + (3600*24*30*1*1);	// 30 days expiry date
		
		$var = $_COOKIE["avaleea"];		
		$cook = isset($var) ? $_COOKIE["avaleea"] : FALSE;
		if (! $cook) {
			return FALSE;
		}
		
		$cookie = unserialize($cook);	
		
		$value_cookie = array(
			"identify" => ($fields == "identify") ? $value : $cookie["identify"],
			"name_file" => ($fields == "name_file") ? $value : $cookie["name_file"],
			"quantity" => ($fields == "quantity") ? $value : $cookie["quantity"],
			"logged" => ($fields == "logged") ? $value : $cookie["logged"],
			"file_pointer" => ($fields == "file_pointer") ? $value : $cookie["file_pointer"],
			"id_edit" => ($fields == "id_edit") ? $value : $cookie["id_edit"],
			"id_test" => ($fields == "id_test") ? $value : $cookie["id_test"],
			"type_edit" => ($fields == "type_edit") ? $value : $cookie["type_edit"],
			"type_edit" => ($fields == "type_edit") ? $value : $cookie["type_edit"],
			"id_users" => ($fields == "id_users") ? $value : $cookie["id_users"],
			"source" => ($fields == "source") ? $value : $cookie["source"],
			"external_questions" => ($fields == "external_questions") ? $value : $cookie["external_questions"],
			"user" => ($fields == "user") ? $value : $cookie["user"],
			"id_users" => ($fields == "id_users") ? $value : $cookie["id_users"],
			"category_user" => ($fields == "category_user") ? $value : $cookie["category_user"],
			"id_people_admin" => ($fields == "id_people_admin") ? $value : $cookie["id_people_admin"],
			"name_user" => ($fields == "name_user") ? $value : $cookie["name_user"],				
			"email_admin" => ($fields == "email_admin") ? $value : $cookie["email_admin"],
			"id_level_users" => ($fields == "id_level_users") ? $value : $cookie["id_level_users"],
			"dt_creation" => ($fields == "dt_creation") ? $value : $cookie["dt_creation"],
			"origem" => ($fields == "origem") ? $value : $cookie["origem"],
			"itens_per_page" => ($fields == "itens_per_page") ? $value : $cookie["itens_per_page"]
		);

		unset($_COOKIE['avaleea']);
		$ret = setcookie("avaleea", serialize($value_cookie), $time, "/");

		return $ret;		
	}

	public function load_file_questions($cookie) {
		
		$ret = array();
		
		$var = $cookie['name_file'];
		$name_file = isset($var) ? $cookie['name_file'] : '';
		
		if (trim("$name_file") == "") {
		    $name_file = $this->session->userdata("name_file");
		}
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
		//ob_start();
		
		$cookie = unserialize($_COOKIE["avaleea"]);	
		
		//$filename = URL_UPL_QUESTIONS. $this->session->userdata('name_file');
		$filename = URL_UPL_QUESTIONS. $cookie['name_file'];
		unlink($filename);
		
		$var = $this->session->userdata("logged");
		$logged = isset($var) ? $var : 0;
		$name_cookie = "avaleea";
		if ($logged == "3") {
			//$name_cookie = "avaleea_".$this->session->userdata("user");
		}
						
		$this->session->sess_destroy();
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('source');
		$this->session->unset_userdata('name_file');
		$this->session->unset_userdata('file_pointer');
		$this->session->unset_userdata('quantity');
		$this->session->unset_userdata("id_edit");		
		$this->session->unset_userdata("type_edit");

		setcookie('avaleea');							
		unset($_COOKIE["avaleea"]);
		
		$_COOKIE = array();
		return TRUE;
	}

	public function filter_question_edit($id, $type) {

		$cookie = unserialize($_COOKIE['avaleea']);		
		
		//$arquivo = $this->session->userdata("name_file");
		$arquivo = $cookie['name_file'];
					
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
			
			$this->session->set_userdata("quantity", count($tests));
			$this->update_cookie("quantity", count($tests));																			
			$this->session->set_userdata("type", $value['id_alternatives_type']);
			$this->update_cookie("type", $value['id_alternatives_type']);		
					
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
					if (trim($value['gap_3']) != "" && trim($value['gap_3']) !=  "Third gap") {
						$qty = 3;
					} else {
						if (trim($value['gap_2']) != "" && trim($value['gap_2']) !=  "Second gap") {
							$qty = 2;
						} 
					}					
					$arr = array(
						"qty" => $qty
					);					
					array_push($array, $arr);
					$this->session->set_userdata("qty", $qty);																			
/*
		echo "<br /><br /> fg => ". trim($value['gap_2']). " - ". trim($value['gap_3']). " - ". $qty ."<br /><br />";
		print_r($array);
										
		echo "<br /><br />";								
		exit;			
*/					
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
							"pt2" => trim($value['part_4'])
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
					
						if (trim($tests['gap_3']) == "") {					
							$arr = array(
								"pt3" => trim($value['part_4'])
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
								"pt4" => trim($value['part_4'])
							);					
							array_push($array, $arr);					
						}
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
/*					
		echo "<br /><br /> Monta questões => ".">>><br /><br />";
		print_r($array);										
		echo "<br /><br />";										
		exit;
*/
		return $array;
	}


	

/**************************************************************************************************
*
*		Method of questions external
*  
* **************************************************************************************************/


	public function save_external_questions() {
		session_start();

		/*
		echo "<br /><br /> save external <br />";
		if (trim($_POST['answer4']) == "Option 4") {
			echo " Option => ".$_POST['answer4']. " <br />"; 
		}
		print_r($_POST);
		exit;
		*/
		
		$ret = $_COOKIE['avaleea'];
		$cook = isset($ret) ? $_COOKIE['avaleea'] : FALSE;
		if ($cook) {
			$cookie = unserialize($cook);	
		}

		$total_questions = $this->session->userdata("quantity");
		$total_questions = $total_questions > 0 ? $total_questions : $cookie["quantity"];
		
    	$logged = $this->session->userdata("logged");
		$logged = ($logged != "0") ? $logged : $cookie['logged']; 
		
    	if ($logged == "2") {
			$total_questions = $this->save_external_file();

		} else {
	    	if ($logged == "3") {    	
				$total_questions = $this->save_external_db();
				
			} else {
				$total_questions = "Error, contact Support !";
			}
		}
        //echo "Total saved questions: " .$total_questions;	
		redirect(base_url('home/external_questions/new'));	
		return TRUE;		
	}


	public function save_external_file() {

		$qty_question =	$this->session->userdata("quantity");
		$arquivo = $this->session->userdata("name_file");			
		$fp = $this->session->userdata("file_pointer");
		
		if (trim($arquivo) == "") {
			$cookie = unserialize($_COOKIE['avaleea']);
			$qty_question =	$cookie["quantity"];
			$arquivo =	$cookie["name_file"];
			$fp =	$cookie["file_pointer"];
		}
		
		$nro_question = $qty_question + 1;
			
		if ($fp == 0) {
			$fp = fopen(URL_UPL_QUESTIONS.$arquivo, "a+");						
			if ( ! $fp ) {
				return FALSE;
			}			
		}
		
		$tot_bytes = filesize(URL_UPL_QUESTIONS.$arquivo);		
		
	    $type_question = $this->input->post("chosen_option");
		$linha = "[ start - ". $type_question ." - ". str_pad($nro_question, 3, "0", STR_PAD_LEFT) ." ]";
		$tot_bytes += fwrite($fp, $linha ."\r\n");
	    $type_question = $this->input->post("chosen_option");

	    $text_statement = $this->input->post("text-statement");
		$tot_bytes += fwrite($fp, "stt - ". $text_statement ."\r\n\r\n");		
		
		switch (trim($type_question)) {
			
			case 'mc':				 
				$right_wrong = $this->input->post("right-wrong");
				if (trim($right_wrong) == "") {
					$right_wrong = "right-wrong1";
				}				
				$tot_bytes += fwrite($fp, $right_wrong ."\r\n");
				
				$answer1 = trim($this->input->post("answer1"));
				$tot_bytes += fwrite($fp, "asw1 - ". $answer1 ."\r\n");
				
				$answer2 = trim($this->input->post("answer2"));
				$tot_bytes += fwrite($fp, "asw2 - ". $answer2 ."\r\n");
				
				$var = $this->input->post("answer3");
				$answer3 = isset($var) ? trim($var) : '';
				if ($answer3 != '' && substr(trim($answer3), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw3 - ". $answer3 ."\r\n");
				}
								
				$var = $this->input->post("answer4");
				$answer4 = isset($var) ? trim($var) : '';
				if ($answer4 != '' && substr(trim($answer4), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw4 - ". $answer4 ."\r\n"); 
				}
				
				$var = $this->input->post("answer5");
				$answer5 = isset($var) ? trim($var) : '';
				if ($answer5 != '' && substr(trim($answer5), 0, 6) != "Option") {
					$tot_bytes += fwrite($fp, "asw5 - ". $answer5 ."\r\n"); 
				}
				break;

			case 'tf':
				$issue1 = trim($this->input->post("issue1"));				
				$issue_tf1 = trim($this->input->post("issue-tf1"));
				$linha = $issue1 ." - ". $issue_tf1;
				$tot_bytes += fwrite($fp, "iss1 - ". $linha ."\r\n");

				$issue2 = trim($this->input->post("issue2"));
				$issue_tf2 = trim($this->input->post("issue-tf2"));
				$linha = $issue2 ." - ". $issue_tf2;
				$tot_bytes += fwrite($fp, "iss2 - ". $linha ."\r\n");

				$var = $this->input->post("issue3");
				$issue3 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf3");
				$issue_tf3 = isset($var) ? trim($var)  : '';
				if (($issue3 != '') && ($issue_tf3 != '') && (substr(trim($issue_tf3), 0, 5) != "Issue") ) {
					$linha = $issue3 ." - ". $issue_tf3; 
					$tot_bytes += fwrite($fp, "iss3 - ". $linha ."\r\n"); 
				}
								
				$var = $this->input->post("issue4");
				$issue4 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf4");
				$issue_tf4 = isset($var) ? trim($var) : '';
				if (($issue4 != '') && ($issue_tf4 != '') && (substr(trim($issue_tf4), 0, 5) != "Issue") ) {
					$linha = $issue4 ." - ". $issue_tf4;
					$tot_bytes += fwrite($fp, "iss4 - ". $linha ."\r\n"); 
				}

				$var = $this->input->post("issue5");
				$issue5 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf5");
				$issue_tf5 = isset($var) ? trim($var) : '';
				if (($issue5 != '') && ($issue_tf5 != '') && (substr(trim($issue_tf5), 0, 5) != "Issue") ) {
					$linha = $issue5 ." - ". $issue_tf5;
					$tot_bytes += fwrite($fp, "iss5 - ". $linha ."\r\n"); 
				}			
				break;

			case 'fg':
				$qty_gap = 1;
				if (trim($this->input->post("inlineRadioOptions")) == "") {
					if (trim($this->input->post("part-fg3")) != "") {
						$qty_gap = 3;
					} else {
						if (trim($this->input->post("part-fg2")) != "") {
							$qty_gap = 2;
						}						
					}
				} else {
					$qty_gap = trim($this->input->post("inlineRadioOptions"));
				}
				$tot_bytes += fwrite($fp, "qty - ". $qty_gap ."\r\n"); 
				
				$part_fg1 = trim($this->input->post("part-fg1"));
				$tot_bytes += fwrite($fp, "pt1 - ". $part_fg1 ."\r\n");
				
				$gap_fg1 = trim($this->input->post("gap-fg1"));
				$tot_bytes += fwrite($fp, "gp1 - ". $gap_fg1 ."\r\n");
				
				$var = $this->input->post("part-fg2");
				$part_fg2 = isset($var) ? trim($var) : '';
				if ($part_fg2 != '' && substr(trim($part_fg2), 0, 6) != "Second") {
					$tot_bytes += fwrite($fp, "pt2 - ". $part_fg2 ."\r\n"); 
				}
				
				$var = $this->input->post("gap-fg2");
				$gap_fg2 = isset($var) ? trim($var)  : '';
				if ($gap_fg2 != '' && substr(trim($gap_fg2), 0, 6) != "Second") {
					$tot_bytes += fwrite($fp, "gp2 - ". $gap_fg2 ."\r\n"); 
				}

				$var = $this->input->post("part-fg3");
				$part_fg3 = isset($var) ? trim($var) : '';
				if ($part_fg3 != '' && substr(trim($part_fg3), 0, 5) != "Third") {
					$tot_bytes += fwrite($fp, "pt3 - ". $part_fg3 ."\r\n"); 
				}

				$var = $this->input->post("gap-fg3");
				$gap_fg3 = isset($var) ? trim($var)  : '';
				if ($gap_fg3 != '' && substr(trim($gap_fg3), 0, 5) != "Third") {
					$tot_bytes += fwrite($fp, "gp3 - ". $gap_fg3 ."\r\n"); 
				}							

				$part_fg_last = trim($this->input->post("part-fg-last"));
				$tot_bytes += fwrite($fp, "lst - ". $part_fg_last ."\r\n");
				break;

			case 'sq':
				$text_sq = trim($this->input->post("text-sq"));
				$tot_bytes += fwrite($fp, "sbq - ". $text_sq ."\r\n");
				break;
				
			default:
				//return FALSE;				
				break;
		}
		
		$linha = "[ end - ".  ($tot_bytes + 20)    ." ]\r\n";
		$tot_bytes += fwrite($fp, $linha);
		
		$tot_bytes += fwrite($fp, "\r\n");
		fclose($fp);
		
		$this->session->set_userdata("quantity", $nro_question);
		$this->update_cookie("quantity", $nro_question);
		
		$total_questions = str_pad($nro_question, 3, "0", STR_PAD_LEFT);
		
		$id_edit = $this->input->post("id_edit");		
				
		if ($id_edit != "0" && trim($type_question) != "" && $type_question != "") {								
			$this->delete_questions_file(1, $id_edit);
		}
		renumber_questions_file();					
		
		return $total_questions;		
	}

	public function save_external_db() {
		
		$tot_questions = 0;

	   	$type_question = $this->input->post("chosen_option");		
		$id_test = $this->input->post("id_test");
		$id_edit = $this->input->post("id_edit");
	   	$text_statement = $this->input->post("text-statement");				
		$order = $this->m_questions->return_next_order($id_test);

		if ($type_question != "fg") {				
			$data = array(
				"id_test" => $id_test,
				"id_edit" => $id_edit,
				"type" => $type_question,
				"statement" => $text_statement,
				"order" => $order
			);
			$id_edit = $this->m_questions->save_external($data);
		}
		
		//echo "<br /><br /><br /> statement => ". $text_statement ."<br /><br />";
		//exit;
		
		switch ($type_question) {			
			case 'mc':
				$right_wrong = substr($this->input->post("right-wrong"), 11, 1);				
				$answer1 = trim($this->input->post("answer1"));				
				$answer2 = trim($this->input->post("answer2"));

				$var = $this->input->post("answer3");
				$answer3 = isset($var) ? trim($var) : '';
								
				$var = $this->input->post("answer4");
				$answer4 = isset($var) ? trim($var) : '';
				
				$var = $this->input->post("answer5");
				$answer5 = isset($var) ? trim($var) : '';

				$rw = $right_wrong == '1' ? "1" : "0";
				$data = array(
					"id_alternative" => 0,
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $answer1,
					"right" => $rw,
					"order" => 1
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}

				$rw = $right_wrong == '2' ? "1" : "0";
				$data = array(
					"id_alternative" => 0,
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $answer2,
					"right" => $rw,
					"order" => 2
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}
						
				if ( trim($ansewr3) == "" ) {					
					$rw = $right_wrong == '3' ? "1" : "0";
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $answer3,
						"right" => $rw,
						"order" => 3
					);										
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}					
				}
								
				if (trim($ansewr4) == "") {
					$rw = $right_wrong == '4' ? "1" : "0";
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $answer4,
						"right" => $rw,
						"order" => 4
					);
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}					
				}

				if (trim($ansewr5) == "") {
					$rw = $right_wrong == '5' ? "1" : "0";
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $answer5,
						"right" => $rw,
						"order" => 5
					);
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}					
				}
				break;

			case 'tf':
				$issue1 = trim($this->input->post("issue1"));				
				$issue_tf1 = trim($this->input->post("issue-tf1"));

				$issue2 = trim($this->input->post("issue2"));
				$issue_tf2 = trim($this->input->post("issue-tf2"));

				$var = $this->input->post("issue3");
				$issue3 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf3");
				$issue_tf3 = isset($var) ? trim($var)  : '';

				$var = $this->input->post("issue4");
				$issue4 = ($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf4");
				$issue_tf4 = isset($var) ? trim($var) : '';

				$var = $this->input->post("issue5");
				$issue5 = isset($var) ? trim($var) : '';
				$var = $this->input->post("issue-tf5");
				$issue_tf5 = isset($var) ? trim($var) : '';

				$data = array(
					"id_alternative" => 0,
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $issue_tf1,
					"tf" => $issue1,
					"order" => 1
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}					
				
				$data = array(
					"id_alternative" => 0,
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $issue_tf2,
					"tf" => $issue2,
					"order" => 2
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}					

				if (trim($issue3) != "") {
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $issue_tf3,
						"tf" => $issue3,
						"order" => 3
					);
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}										
				}

				if (trim($issue4) != "") {
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $issue_tf4,
						"tf" => $issue4,
						"order" => 4
					);
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}										
				}

				if (trim($issue5) != "") {
					$data = array(
						"id_alternative" => 0,
						"id_question" => $id_edit,
						"type" => $type_question,
						"alternative" => $issue_tf5,
						"tf" => $issue5,
						"order" => 5
					);
					$ret_q = $this->m_alternatives->save_external($data, $id_edit);
					if (! $ret_q) {
						return FALSE;					
					}										
				}				
				break;

			case 'fg':
/*
		echo "<br /><br /> fg => <br /><br />";
		print_r($_POST);
										
		echo "<br /><br />";								
		//exit;
*/ 			
				$qt = $this->input->post("inlineRadioOptions");
				$qty_gap = isset($qt) ? $this->input->post("inlineRadioOptions") : "option1";				
				$part_fg1 = trim($this->input->post("part-fg1"));
				$gap_fg1 = trim($this->input->post("gap-fg1"));
				$part_fg_last = trim($this->input->post("part-fg-last"));

				$part_fg2 = "";
				$gap_fg2 = "";
				$part_fg3 = "";
				$gap_fg3 = "";
				
				if (intval(substr($qt, 6, 1)) > 1) {
					$var = $this->input->post("part-fg2");
					$part_fg2 = isset($var) ? trim($var) : '';				
					$var = $this->input->post("gap-fg2");
					$gap_fg2 = isset($var) ? trim($var)  : '';
				}
				if (intval(substr($qt, 6, 1)) > 2) {

					$var = $this->input->post("part-fg3");
					$part_fg3 = isset($var) ? trim($var) : '';
					$var = $this->input->post("gap-fg3");
					$gap_fg3 = isset($var) ? trim($var)  : '';
				}
				$data = array(
					"id_test" => $id_test,
					"id_edit" => $id_edit,
					"type" => $type_question,
					"statement" => $text_statement,
					"title_questions" => $part_fg1,
					"part_2" => $part_fg2,
					"part_3" => $part_fg3,
					"part_4" => $part_fg_last,
					"order" => $order							
				);	
				$ret_q = $this->m_questions->save_external($data);
				if (! $ret_q) {
					return FALSE;					
				}
				$id_edit = intval($ret_q); 


				$data = array(
					"id_alternative" => 0,	
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $gap_fg1,					
					"gap_2" => $gap_fg2,
					"gap_3" => $gap_fg3,
					"order" => 1
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}
				break;

			case 'sq':
				$text_sq = trim($this->input->post("text-sq"));

				$data = array(
					"id_alternative" => 0,
					"id_question" => $id_edit,
					"type" => $type_question,
					"alternative" => $text_sq,
					"order" => 1
				);
				$ret_q = $this->m_alternatives->save_external($data, $id_edit);
				if (! $ret_q) {
					return FALSE;					
				}					
				break;
				
			default:
				//return FALSE;			
				break;
		}

		return TRUE;
	}

	public function edit_questions_file() {

		$id = $this->input->get("id");
		$id_test = $this->input->get("id_test");
		$type = strtolower($this->input->get("type"));

		$this->session->set_userdata("id_edit", $id);		
		$this->update_cookie("id_edit", $id);
		
		$this->session->set_userdata("id_test", $id_test);		
		$this->update_cookie("id_test", $id_test);
		
		$this->session->set_userdata("type_edit", $type);
		$this->update_cookie("type_edit", $type);
		
//		echo "<br /><br /><br /> funct => " .$id ." - ". $id_test ." - ". $type. "<br /><br /> session ";
//		print_r($_COOKIE);
//		exit;
		return $cookie;
	}

	public function edit_questions_db() {

		$id = $this->input->get("id");

		$this->session->set_userdata("id_test", $id);
		$this->update_cookie("id_test", $id);
		
		return TRUE;
	}

	public function delete_questions_file($edit=0, $id_edit=0) {
			
		if ($edit == 0) {	
			$id = $this->input->get("id");
		} else {
			
			if ($edit == 1) {
				$id = $id_edit;
			
			} else {		
				return FALSE;
			}
		}

		$logged = $this->session->userdata("logged");
		if ($logged == "0") {
			$cookie = unserialize($_COOKIE['avaleea']);
			$logged = $cookie["logged"];		
		}
				
		if ($logged != "3") {
			$find = FALSE;
						
			$arquivo = $this->session->userdata("name_file");			
			if (trim($arquivo) == "") {
				$arquivo = $cookie['name_file'];
			}
						
			$file = file(URL_UPL_QUESTIONS.$arquivo); 			// Lê todo o arquivo para um vetor
			 			
		    foreach($file as $k => $linha) {		// passa linha a linha do arquivo  
				if ( (substr($linha, 2, 5) == "start") && (substr($linha, 15, 3) == $id) ) {
	        		$find = TRUE;
					if ($k > 0) {
						unset($file[$k-1]); // Eliminando a linha
					}
					unset($file[$k]); // Eliminando a linha
				}	        	
	        	if ( $find && (substr($linha, 2, 3) == "end") ) {
	        		$find = FALSE;
	        		unset($file[$k]); // Eliminando a linha		
	        	}	            
	            if ($find) {
	            	unset($file[$k]); // Eliminando a linha
				}
			} 	     	 
	    	file_put_contents(URL_UPL_QUESTIONS.$arquivo, $file);		// Reescrevendo o arquivo	
			$delete = TRUE;
		
		} else {			
			$delete = $this->m_questions->delete($id);			
		}
		
		$ret = FALSE;
		
		if ($delete) {
			$quantity = ($this->session->userdata("quantity") - 1);
			if ($this->session->userdata("quantity") == 0) {
				$quantity = (intval($cookie['quantity']) - 1);
			}
					
			$this->session->set_userdata("quantity", $quantity);
			$this->update_cookie("quantity", $quantity);
			
			$ret = TRUE;
		}		
		return $ret;
	}

	public function prepare_preview_questions() {
			
		$id = $this->input->get("id");

		//$logged = $this->session->userdata("logged");			
		$cookie = unserialize($_COOKIE['avaleea']);
		$logged = $cookie["logged"];		
				
		if ($logged == "3") {		// Search in DB
			
			$data = $this->m_questions->return_questions_completed(0, $id)->result_array();
			$tp = $data[0]['id_alternatives_type'];

			switch ($tp) {
				case 1:
					$type = "mc";				
					break;
				case 2:
					$type = "tf";				
					break;
				case 3:
					$type = "fg";				
					break;
				case 4:
					$type = "sq";				
					break;
			}
			
			$question = $this->format_preview_db($data);
			
			$html = $this->format_preview($question, $type);
			
		} else {					// Search in file

			//$arquivo = $this->session->userdata("name_file");			
			$arquivo = $cookie['name_file'];
			 
			$file = file(URL_UPL_QUESTIONS.$arquivo); // Lê todo o arquivo para um vetor 
	
			$qty_fg = 0;
			$find = FALSE;
			$data = array();
			
		    foreach($file as $k => $linha) {		// passa linha a linha do arquivo 
		    		    
		    	if (trim(substr($linha, 0, 3)) == "" || substr($linha, 0, 3) == "   ") {
		    		continue;
		    	}
		    	
				if ( (substr($linha, 2, 5) == "start") && (intval(substr($linha, 15, 3)) == intval($id)) ) {					
	        		$find = TRUE;
					$type = substr($linha, 10, 2);
					continue;
				} else {

		        	if ( $find && (substr($linha, 0, 3) == "stt") ) {					
						$array = array(
							"type" => $type,	
							"id" => $id,
							"statement" => substr($linha, 6)
						);	        		
		        		array_push($data, $array);
						continue;		
		        	} else {
			        		
						if ( $find ) {
						
							switch ($type) {
								case 'mc':
									if ( (substr($linha, 0, 2) == "  ") || (substr(trim($linha), 0, 2) == "") ) {
										continue;
									}
									if ( $find && (substr($linha, 0, 5) == "right") ) {
										
										$array = array(
											"correct_alternative" => substr($linha, 11)
										);
						        		array_push($data, $array);	
										continue;															
									}						
									if ( $find && (substr($linha, 0, 3) == "asw") ) {							
										$array = array(
											"id_alternative" => substr($linha, 3, 1),
											"alternative" => substr($linha, 7)		
										);
						        		array_push($data, $array);
										continue;																
									}																	
									break;
								
								case 'tf':						
									if ( $find && (substr($linha, 0, 3) == "iss") ) {							
										$array = array(
											"id_alternative" => substr($linha, 3, 1),
											"true_false" => substr($linha, 7, 1),
											"alternative" => substr($linha, 11)		
										);
						        		array_push($data, $array);
										continue;																
									}
									if ( $find && (substr($linha, 0, 5) == "right") ) {
										
										$array = array(
											"correct_alternative" => substr($linha, 11)
										);
						        		array_push($data, $array);
										continue;																
									}						
									break;
								
								case 'fg':						
									if ( $find && (substr($linha, 0, 3) == "qty") ) {							
										$array = array(
											"quantity" => substr($linha, 12, 1)		
										);										
										$qty_fg = substr($linha, 12, 1);
						        		
						        		array_push($data, $array);																
										continue;
										
									} else {								
										if ( $find && (substr($linha, 0, 3) == "lst") ) {
												
											if ($qty_fg > 1) {	
												$arr = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);	

											} else {
												$array = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);
								        		array_push($data, $array);																																									
											}
											continue;
												
										} else {										
											if ( $find && (substr($linha, 0, 2) == "pt" || substr($linha, 0, 2) == "gp") ) {							
												$array = array(
													"type" => substr($linha, 0, 3),									
													"alternative" => substr($linha, 6) 		
												);
							        			array_push($data, $array);
							        			continue;																
											}
										}
									}
									break;
								
								case 'sq':						
									if ( $find && (substr($linha, 0, 3) == "sbq") ) {							
										$array = array(
											"alternative" => substr($linha, 6)		
										);
						        		array_push($data, $array);
										continue;																
									}
									
									if ( (substr($linha, 2, 3) != "end") && (substr($linha, 0, 3) != "sbq")) {							
									
										if ( $find && (substr($linha, 0, 1) != " ") && 
												(trim(substr($linha, 0, 1)) != "") && (trim(substr($linha, 0, 1)) != "[") ) {
											
											$array = array(
												"alternative" => substr($linha, 6)
											);
							        		array_push($data, $array);
							        		continue;																
										}						
									}
									break;
							}
						}
					}
		        	if ( $find && (substr($linha, 2, 3) == "end") ) {
		        		if ($type == "fg" && $qty_fg > 1) {
							array_push($data, $arr);
						}	
		        		$find = FALSE;
						break;
					}					
				}
			}							// End Foreach
		
			$html = $this->format_preview($data, $type);
		}								// End If($logged)
			
//		print_r($data);
//		exit;
			
		echo $html;				
	}									// End Function

	public function format_preview($data, $type) {		
		$html = "";
		$i = 0;		
/*				
		echo "<br /><br /><br /> tipo => ". $type ."<br />";	
		print_r($data);
		exit;	
*/				
		foreach ($data as $linha) {
			$i++;
			
			if ($i == 1) {
				$html .= "<div class='row pl-3'> <h4> ". $linha['id']. " - ". 
					ucfirst($linha['statement']) ." </h4> </div> <div class='row pl-5'> ";				
				
			} else {
				switch ($type) {
					case 'mc':
						if ($i > count($data)) {
							continue;
						}
						if ($i == 2) {
							$id_right = $linha['correct_alternative'];
							continue;
						}						
						$right = (intval($id_right) == intval($linha['id_alternative'])) ? " - (Right)" : " - (Wrong)";													
						$html .= " <div class='col-12'> ". str_pad($linha['id_alternative'], 2, "0", STR_PAD_LEFT)
								." - ".  trim($linha['alternative']). $right ." </div> ";
						break;
	
					case 'tf':
						$html .= " <div class='col-12'> ". str_pad($linha['id_alternative'], 2, "0", STR_PAD_LEFT)
								." - [". strtoupper(trim($linha['true_false'])). "] - ".  trim($linha['alternative']). " </div> ";
						break;
	
					case 'fg':
						$bg_color = '';
						if ($i == 2 || $i > count($data)) {
							continue;
						}
						if (substr($linha['type'], 0, 2) == "pt" || substr($linha['type'], 0, 2) == "ls") {
							$tp = "Part ";
						}
						if (substr($linha['type'], 0, 2) == "gp") {
							$tp = "Gap ";
							$bg_color = ' style="background-color: #fff;"';
						}																			
						$html .= " <div class='col-12' ". $bg_color ."> ". $tp ." - ".  trim($linha['alternative']). " </div> ";
						break;					

					case 'sq':
						$html .= " <div class='col-12'> - ". trim($linha['alternative']). " </div> ";
						break;
				}												
			}
		}

		$html .= " </div> ";
		
		echo $html;
	}
		
	public function format_preview_db($data)	{
	
		$html = "";
		$question = array();
		$i = 0;
		$type = "";
		
		foreach ($data as $value) {
			$i++;
				
			if ($i == 1) {
				switch ($value['id_alternatives_type']) {
					case 1:
						$type = "mc";				
						break;
					case 2:
						$type = "tf";				
						break;
					case 3:
						$type = "fg";				
						break;
					case 4:
						$type = "sq";				
						break;
				}
				$array = array(
					"type" => $type,
					"id" => $value['id_questions'],
					"statement" => $value['enunciation']
				);				
				array_push($question, $array);
				
				$array = array(
					"correct_alternative" => 1
				);
				array_push($question, $array);
				//continue;				
			}
			
			if ($type == "mc" && $value['right_wrong'] == '1') {
				$question[1]['correct_alternative'] = $i;
			}	
		
			switch ($type) {
				case 'mc':
					$array = array(
						"id_alternative" => $i,
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;

				case 'tf':
					$array = array(
						"id_alternative" => $i,
						"true_false" => ($value['right_wrong'] == '0' ? "F" : "T"),
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;

				case 'fg':				
					$qty = 1;
					if (trim($value['gap_3']) != "") {
						$qty = 3;
					
					} else {
						if (trim($value['gap_2']) != "") {
							$qty = 2;							
						}	
					}
				
					$array = array(
						"quantity" => $qty
					);
					array_push($question, $array);				

					$array = array(
						"type" => "pt1",
						"alternative" => $value['title_questions']					
					);
					array_push($question, $array);
									
					$array = array(
						"type" => "gp1",
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				

					if (trim($value['gap_2']) != "" ) {
						$array = array(
							"type" => "pt2",	
							"alternative" => $value['part_2']					
						);
						array_push($question, $array);				

						$array = array(
							"type" => "gp2",
							"alternative" => $value['gap_2']					
						);
						array_push($question, $array);				
					}

					if (trim($value['gap_3']) != "" ) {											
						$array = array(
							"type" => "pt3",	
							"alternative" => $value['part_3']					
						);
						array_push($question, $array);				

						$array = array(
							"type" => "gp3",
							"alternative" => $value['gap_3']					
						);
						array_push($question, $array);				
					}
					$array = array(
						"type" => "lst",
						"alternative" => $value['gap_4']					
					);
					array_push($question, $array);							
					break;

				case 'sq':	
					$array = array(
						"alternative" => $value['description_alternatives']					
					);
					array_push($question, $array);				
					break;
			}			
		}

	//	print_r($question);
	//	exit;
				
		return $question;
	}
		
	

/**************************************************************************************************
*
*		Method of questionnaires external
*  
* **************************************************************************************************/

	public function prepare_preview_test() {
		//$logged = $this->session->userdata("logged");
		//$cookie = unserialize($_COOKIE['avaleea']);
		//$logged = $cookie['logged'];
			
		$id = $this->input->get("id");
		
		$data = $this->m_questionnaries->return_data_view($id);
		
		if ($data) {
			$html = $this->format_preview_tests($data);
		
		} else {	
			$html = "There are no registered questions to show !"; 
		}		
		
		return $html;
	}
	

	public function format_preview_tests($data) {		
		$html = "";
		$i = 1;
		$tot = 0;	
		$id_question_ant = 0;	
		
		foreach ($data as $k => $linha) {			
			if ($i == 1) {
				$html .= "<div class='table table-hover'> <div class='row ml-1'> <h4> ". str_pad($linha['id_questionnaries'], 6, "0", STR_PAD_LEFT). " - ". 
					ucfirst($linha['name_questionnaries']) ." </h4> </div> <div class='row h5 mt-3'> ";				
			
				$html .= " <div class='col-2'> Identify </div> "; 
				$html .= "<div class='col-5'> Name question </div> ";
				$html .= " <div class='col-3'> Type </div> "; 
				$html .= "<div class='col-2'> Quantity </div> </div> ";
				
				$id_question_ant = $linha['id_questions'];
				$name_ant = $linha['name_questions'];				
				$tp = $linha['id_alternatives_type'];								
			}		
		
			if ($id_question_ant != $linha['id_questions']) {
				
				switch ($tp) {
					case 1:
						$type = "Multiple Choices";
						break;
					case 2:
						$type = "True and False";
						break;
					case 3:
						$type = "Fill in Gap";
						break;
					case 4:
						$type = "Subjective Question";
						break;											
					default:
						return FALSE;
						break;
				}
							
				$html .= "<div class='row mt-3'> ";							
				$html .= " <div class='col-2'> ". str_pad($id_question_ant, 6, "0", STR_PAD_LEFT) ." </div> "; 
				$html .= "<div class='col-5'> ". $name_ant ." </div> ";
				$html .= " <div class='col-3'> ". ucfirst($type) ." </div> "; 
				$html .= "<div class='col-2'> &nbsp; &nbsp; ". str_pad($tot, 3, "0", STR_PAD_LEFT) ." </div> </div> ";										
											
				$id_question_ant = $linha['id_questions'];
				$name_ant = $linha['name_questions'];												
				$tp = $linha['id_alternatives_type'];
				$tot = 0;												
			}
			$tot++;
			$i++;
		}	
				
		switch ($linha['id_alternatives_type']) {
			case 1:
				$type = "Multiple Choices";
				break;
			case 2:
				$type = "True and False";
				break;
			case 3:
				$type = "Fill in Gap";
				break;
			case 4:
				$type = "Subjective Question";
				break;											
			default:
				return FALSE;
				break;
		}
							
		$html .= "<div class='row mt-3'> ";							
		$html .= " <div class='col-2'> ". str_pad($linha['id_questions'], 6, "0", STR_PAD_LEFT) ." </div> "; 
		$html .= "<div class='col-5'> ". $linha['name_questions'] ." </div> ";
		$html .= " <div class='col-3'> ". ucfirst($type) ." </div> "; 
		$html .= "<div class='col-2'> &nbsp; &nbsp; ". str_pad($tot, 3, "0", STR_PAD_LEFT) ." </div> </div> </div> ";
		
		echo $html;
	}

	public function save_file_db() {		
	
		$name_questionnaries = $this->input->post("name_signin_save");
		
		if (trim($name_questionnaries) == "") {
			echo "<br /><br /><br /><br /><br />  save_test => " .$name_questionnaries ."---";
			exit;							
		}		

		if (! $this->login_external()) {
			echo  "message", "Incorrect User/Password, retype ! ";
			return FALSE;
		}
		
		if (! $this->save_test_external()) {
			echo  "message", " Error insert Test, contact support ! ";
			return FALSE;			
		}

							// Erase file questions
		$cookie = unserialize($_COOKIE['avaleea']);
		//$filename = URL_UPL_QUESTIONS. $this->session->userdata('name_file');
		$filename = URL_UPL_QUESTIONS. $cookie['name_file'];
		unlink($filename);
				
		return TRUE;	
	}
		
	public function login_external() {

        $user = $this->input->post("email_signin_save");
        $password = $this->input->post("password_signin_save");        
		
        $consult = $this->m_users->recovery_user_password($user, $password);
		 		 		 
        if (count($consult) == 0) {
            $this->session->set_userdata("logged", "0");
            $this->update_cookie("logged", "0");
			                    
            echo "Incorrect User/Password, retype ! ";
			return FALSE;                                       
            //redirect(base_url('home/external_questions'));                
                    
        } else {
        	
			$ret = $_COOKIE['avaleea'];
			$cookie = isset($ret) ? $_COOKIE['avaleea'] : FALSE;
			if (! $cookie) {
				$cookie = create_cookie(1);
			}
				
			$this->session->set_userdata("logged", '3');
			$this->update_cookie("logged", "3");

			$this->session->set_userdata("user", $user);
            $this->update_cookie("user", $user);
			
            $this->session->set_userdata("id_users", $consult[0]['id_users']);
			$this->update_cookie("id_users", $consult[0]['id_users']);
			
			$this->session->set_userdata("category_user", 5);
			$this->update_cookie("category_user", 5);
			
			$this->session->set_userdata("id_people_admin", $consult[0]['id_people']);
			$this->update_cookie("id_people_admin", $consult[0]['id_people']);
			
			$this->session->set_userdata("name_user", $user);
			$this->update_cookie("name_user", $user);
			
			$this->session->set_userdata("email_admin", $user);
			//$this->update_cookie("email_admin", $user);
			        
			$this->session->set_userdata("id_level_users", 4);
			$this->update_cookie("id_level_users", 4);
			
			$itens = $this->m_setup->return_setup()->row()->items_per_page;
			$this->session->set_userdata("itens_per_page", $itens);
			//$this->update_cookie("itens_per_page", $itens);
			
        	$this->session->set_userdata("source", 'home');
			$this->update_cookie("source", "home");
			
			return TRUE;
		}
	}

	public function save_test_external($name_questionnaries = "") {

		$data = array(
			"name_questionnaries" => $name_questionnaries 	
		);
		
		$ret = $this->m_questionnaries->save_external($data);		
		if (! $ret) {
			return FALSE;					
		}
		
		$id_test = intval($ret);

		$arquivo = $this->session->userdata("name_file");
		if (trim($arquivo) == "") {
			$cookie = unserialize($_COOKIE['avaleea']);			
			$arquivo = $cookie['name_file'];
		}
			
		$file = file(URL_UPL_QUESTIONS.$arquivo); 			// Lê todo o arquivo para um vetor 

		$array = array();
		$find = FALSE;
		$right = "";
		$order = 0;
		$i = 0;
		$sbq = FALSE;	
				
	    foreach($file as $k => $linha) { // passa linha a linha do arquivo 
        
        	$i++;	
        	if ( (substr($linha, 0, 3) == "   ") || (trim(substr($linha, 0, 3)) == "") ) {
        		continue;
        	}
        				
			if ( substr($linha, 2, 5) == "start" ) {
        		$find = TRUE;
				$type = substr($linha, 10, 2);
				$order++;
				$order_alt = 0;										
				continue;
			}
						
			switch ($type) {
				case 'mc':
				case 'tf':
				case 'sq':		
					if ( $find && (substr($linha, 0, 3) == "stt" )) {
						$enunciation = substr($linha, 6);
		
						$data = array(
							"id_test" => $id_test,
							"id_edit" => 0,
							"type" => $type,
							"statement" => $enunciation,
							"order" => $order
						);
						$ret_q = $this->m_questions->save_external($data);
						if (! $ret_q) {
							return FALSE;					
						}
						$id_question = intval($ret_q); 
						continue;				
					}
        	
					if ( $find && (substr($linha, 0, 5) == "right" )) {
						$right = intval(substr($linha, 11, 1));				
						continue;				
					}					        	
					if ( $find && (substr($linha, 0, 3) == "qty" )) {
						$qty = intval(substr($linha, 12, 1));
						continue;				
					}
					
					if (substr($linha, 0, 3) == "asw") {						
						$rw = "0";
						if (intval(substr($linha, 3, 1)) == $right) {
							$rw = "1";	
						}
						$order_alt++;
						
						$data = array(
							"id_alternative" => substr($linha, 3, 1),
							"id_question" => $id_question,
							"type" => $type,
							"alternative" => substr($linha, 7),
							"right" => $rw,
							"order" => $order_alt
						);
						$ret_q = $this->m_alternatives->save_external($data, 0);
						if (! $ret_q) {
							return FALSE;					
						}
						continue;											
					}

					if (substr($linha, 0, 3) == "iss") {
						$order_alt++;
												
						$data = array(
							"id_alternative" => substr($linha, 3, 1),
							"id_question" => $id_question,
							"type" => $type,
							"alternative" => substr($linha, 11),
							"tf" => strtolower(trim(substr($linha, 7))),
							"order" => $order_alt
						);
						$ret_q = $this->m_alternatives->save_external($data, 0);
						if (! $ret_q) {
							return FALSE;					
						}
						continue;											
					}						
					if (substr($linha, 0, 3) == "sbq") {
						$sbq = TRUE;						
						$order_alt++;
						$alternative = substr($linha, 6);
						continue;											
					}
					if ($sbq && trim(substr($linha, 0, 1)) != "") {
						$order_alt++;
						$alternative += trim(substr($linha, 0));																	
						continue;																	
					}
											
					break;

				case 'fg':
					
					$pt1 = "";
					$gp1 = "";
					$pt2 = "";
					$gp2 = "";
					$pt3 = "";
					$gp3 = "";
					$lst = "";					
					
					if ( $find && (substr($linha, 0, 3) == "stt" )) {
						$enunciation = substr($linha, 6);
					}
					
					if (substr($linha, 0, 3) == "pt1" ) {
						$pt1 = substr($linha, 6);
					}
					if (substr($linha, 0, 3) == "gp1" ) {
						$gp1 = substr($linha, 6);
					}
					
					if (substr($linha, 0, 3) == "pt2" ) {
						$pt2 = substr($linha, 6);
					}
					if (substr($linha, 0, 3) == "gp2" ) {
						$gp2 = substr($linha, 6);
					}
					
					if (substr($linha, 0, 3) == "pt3" ) {
						$pt3 = substr($linha, 6);
					}					
					if (substr($linha, 0, 3) == "gp3" ) {
						$gp3 = substr($linha, 6);
					}					
					
					if (substr($linha, 0, 3) == "lst" ) {
						$lst = substr($linha, 6);
					}					

					if ( substr($linha, 2, 3) == "end" ) {
						$data = array(
							"id_test" => $id_test,
							"id_edit" => 0,
							"type" => $type,
							"statement" => $enunciation,
							"title_questions" => $pt1,
							"part_2" => $pt2,
							"part_3" => $pt3,
							"part_4" => $lst,
							"order" => $order							
						);	
						$ret_q = $this->m_questions->save_external($data);
						if (! $ret_q) {
							return FALSE;					
						}
						$id_question = intval($ret_q); 

						$data = array(
							"id_question" => $id_question,
							"type" => $type,
							"text_alternatives" => $gp1,
							"gap_2" => $gp2,
							"gap_3" => $gp3,
							"order" => 1
						);
						$ret_q = $this->m_alternatives->save_external($data, 0);
						if (! $ret_q) {
							return FALSE;					
						}

		        		$find = FALSE;
						$id_question = 0;
						$sbq = FALSE;
						continue;
					}
					break;
													
				default:					
					break;
			}
		
			if ( substr($linha, 2, 3) == "end" ) {
				if ($sbq) {																		
					$data = array(
						"id_alternative" => 1,
						"id_question" => $id_question,
						"type" => $type,
						"alternative" => $alternative,
						"order" => 1
					);
					$ret_q = $this->m_alternatives->save_external($data, 0);
					if (! $ret_q) {
						return FALSE;					
					}					
				}				
        		$find = FALSE;
        		$sbq = FALSE;
				$id_question = 0;
				continue;
			}
		}
		return TRUE;
	}		


/**************************************************************************************************
*
*		Method of users external
*  
* **************************************************************************************************/

	public function login_external_users() {
		//session_start();

        $user = $this->input->post("email_login");
        $password = $this->input->post("password_login");        
		
        $consult = $this->m_users->recovery_user_password($user, $password);
		 		 		 
        if (count($consult) == 0) {
            $this->session->set_userdata("logged", "0");                    
            $this->update_cookie("logged", "0");
			
            echo "Incorrect User/Password, retype ! ";                                       
            //redirect(base_url('home/external_questions'));                
        
        } else {

        	$this->session->set_userdata("source", "home");
			$this->update_cookie("source", "home");			
			
			if ($this->make_login($consult[0], $user, $consult[0]['name'])) {
				echo $consult[0]['name'];			// "Login Ok ! ";				
			} else {
				echo "message", "Incorrect User/Password, retype ! ";
			}
		}
	}

	public function save_external_users() {
		
		//print_r($_POST);
		//exit;
        $first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");						
		$email = $this->input->post("email_login");
		
		if (trim($first_name) == "" || trim($last_name) == "" || trim($email) == "") {
			return FALSE;
		}
				
		$ret = $this->m_users->save_external();	
		
		if (count($ret) > 0) {
			
			if ($this->make_login($ret)) {						

				echo "Ok, wrote and logging user !";
			} else {
				echo "Error, login user !";
			}
		} else {
			echo "Error, insert user, contact Support !";
		}
	}
	
	public function search_email() {				
		$email = $_GET['email'];
				
		$existe_email = $this->m_users->search_email($email); 
		
		if (trim($existe_email) == '') {
			echo 'Ok';
		
		} else {		
			echo $existe_email;
		}
	}

	public function make_login($dados, $em = "", $nm = "") {					
		//$this->clear_all();
		
		if (trim($nm) == "" || trim($em) == "") {		
	        $first_name = $this->input->post("first_name");
			$last_name = $this->input->post("last_name");
			$name = $first_name ." ". $last_name;				 
			$email = $this->input->post("email_login");

		} else {
			$name = $nm;
			$email = $em;
		}
                                                                                                          	  	
		$ret = $_COOKIE['avaleea'];
		$cookie = isset($ret) ? $_COOKIE['avaleea'] : FALSE;
		if (! $cookie) {
			$cookie = create_cookie(1);
		}	
			
    	$this->session->set_userdata("logged", "3");
		$this->update_cookie("logged", "3");

        $this->session->set_userdata("user", $email);					
        $this->update_cookie("user", $email);

        $this->session->set_userdata("id_users", $dados['id_users']);
		$this->update_cookie("id_users", $dados['id_users']);
        
        $this->session->set_userdata("category_user", 5);
		$this->update_cookie("category_user", 5);
		
		$this->session->set_userdata("id_people_admin", $dados['id_people']);
		$this->update_cookie("id_people_admin", $dados['id_people']);
		
		$this->session->set_userdata("name_user", $name);
		$this->update_cookie("name_user", $name);
		
		$this->session->set_userdata("dt_creation", date("Y-m-d"));
		$this->update_cookie("dt_creation", date("Y-m-d"));
								           
		$this->session->set_userdata("email_admin", $email);
		$this->update_cookie("email_admin", $user);
		        
		$this->session->set_userdata("id_level_users", 4);
		$this->update_cookie("id_level_users", 4);
		
		$this->session->set_userdata("origem", '0');
		$this->update_cookie("origem", "0");
		
		$itens = $this->m_setup->return_setup()->row()->items_per_page;
		$this->session->set_userdata("itens_per_page", $itens);
		$this->update_cookie("itens_per_page", $itens);

//		$this->create_cookie();
						
		return TRUE;
	}

}					// End Class
