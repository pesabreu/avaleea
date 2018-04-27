//

function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}

function date_today(){
	
	var dt = new Date;		

	var day =  dt.getDate();
	var dia = day.toString();		
	if (day < 10) dia = '0'+dia;		

	var month = dt.getMonth()+1;
	var mes = month.toString();
	if (month < 10) mes = '0'+mes;	
		
	var dt_today = dia+'/'+mes+'/'+dt.getFullYear();
	
	return dt_today;
}

function date_normal(dta) {

	var dt = dta.substr(8, 2) + '/' + dta.substr(5, 2) + '/' + dta.substr(0, 4);
	hr = dta.substr(11, 8);

	return dt + ' ' + hr;
}

function type(id) {		

	var id_tipo = parseInt(id);
	var tipo_solicitacao = ""; 

	var solicitacoes = ["Denúncia", "Dúvida", "Elogio", "Pedido de Acesso à Informação",
								"Solicitação", "Sugestão", "Reclamação", "", "Outros"];				

	if (id_tipo > solicitacoes.length || id_tipo < 1 ) {
		tipo_solicitacao = "Erro Tipo Solicitação";
	
	} else {
		tipo_solicitacao = solicitacoes[id_tipo];
	}
	
	return  tipo_solicitacao;
}

function date_br(dt) {				// receive: aaaa/mm/dd   -   return: dd/mm/aaaa
	if (dt == '') {
		return '';
	}
	return dt.substring(8) + "/" + dt.substring(5, 7)  + "/" + dt.substring(0, 4);			
}	
	
function data_complete_user(id_user) {    
    var link = "<a href='" + base_url + "users/edit/" + id_user + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_user').html(link);
       
    $.post(base_url+"users/window_data_complete_user", {
        id_users : id_user
    }, function(data) {
        $('#id_users').html(data.id_users);
        $('#name').html(data.name);
        $('#logi').html(data.login);
        $('#id_user_level').html(data.code);
        $('#logged').html(data.logged);
        $('#note').html(data.note);                                                                                                                                                                        
        $('#windowDataCompleteUser').modal('show');
    }, 'json');    
}

function data_complete_user_level(id_user_level) {   
    var link = "<a href='" + base_url + "user_level/edit_user_level/" + id_user_level + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_user_level').html(link);
    
    $.post(base_url+"user_level/window_data_complete_user_level", {
        id_user_level : id_user_level
    }, function(data) {
        $('#id_user_level').html(data.id_user_level);
        $('#level').html(data.level);
        $('#code').html(data.code);        
        $('#description').html(data.description_user_level);        
        $('#note').html(data.note);
                                                                                                                                                                        
        $('#windowDataCompleteUser_Level').modal('show');
    }, 'json');    
}

function data_complete_tabsys(id_tabsys) {   
    var link = "<a href='" + base_url + "tabsys/edit/" + id_tabsys + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_tabsys').html(link);
    
    $.post(base_url+"tabsys/window_data_complete_tabsys", {
        id : id_tabsys
    }, function(data) {
        $('#id').html(data.id);
        $('#code').html(data.code);        
        $('#description').html(data.desc);        
        $('#note').html(data.note);
                                                                                                                                                                                
        $('#windowDataCompleteTabsys').modal('show');
    }, 'json');    
}

function data_complete_people(id) {   
    var link = "<a href='" + base_url + "people/edit/" + id + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_people').html(link);
    
    $.post(base_url+"people/window_data_complete_people", {
        id_people : id
    }, function(data) {
        $('#id_people').html(data.id);
        $('#type_people').html(data.type_people);                
		$('#id_categories').html(data.code_categories);
		$('#id_occupation_area').html(data.code_occupation_area);
		$('#name').html(data.name);
		$('#name_fantasy').html(data.name_fantasy);				
		$('#legal_identification').html(data.legal_identification);				                
		$('#physical_identification').html(data.physical_identification);
		$('#dt_birthday').html(data.dt_birthday);				                
		$('#city').html(data.city);				                
		$('#state').html(data.state);
		$('#country').html(data.country);						                				                
        $('#note').html(data.note);
                                                                                                                                                                                
        $('#windowDataCompletePeople').modal('show');
    }, 'json');    
}

function data_complete_addresses(id) {   
    var link = "<a href='" + base_url + "addresses/edit/" + id + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_addresses').html(link);
    
    $.post(base_url+"addresses/window_data_complete_addresses", {
        id_addresses : id
    }, function(data) {
        $('#id_addresses').html(data.id);
        $('#id_people').html(data.name);                
		$('#public_place').html(data.public_place);
		$('#number').html(data.number);
		$('#neighborhood').html(data.neighborhood);
		$('#complement_1').html(data.complement_1);				
		$('#complement_2').html(data.complement_2);				                
		$('#complement_3').html(data.complement_3);
		$('#zipcode').html(data.zipcode);				                
                                                                                                                                                                                
        $('#windowDataCompleteAddresses').modal('show');
    }, 'json');    
}

function data_complete_phones(id) {   
    var link = "<a href='" + base_url + "phones/edit/" + id + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_phones').html(link);
    
    $.post(base_url+"phones/window_data_complete_phones", {
        id_phones : id
    }, function(data) {
        $('#id_phones').html(data.id);
        $('#id_people').html(data.name);                
		$('#area_code_1').html(data.area_code_1);
		$('#ddd_1').html(data.ddd_1);
		$('#number_phone_1').html(data.number_phone_1);
		$('#area_code_2').html(data.area_code_2);
		$('#ddd_2').html(data.ddd_2);
		$('#number_phone_2').html(data.number_phone_2);
		$('#area_code_3').html(data.area_code_3);
		$('#ddd_3').html(data.ddd_3);
		$('#number_phone_3').html(data.number_phone_3);
                                                                                                                                                                                
        $('#windowDataCompletePhones').modal('show');
    }, 'json');    
}

function data_complete_web_contact(id) {   
    var link = "<a href='" + base_url + "web_contact/edit/" + id + "' class='btn btn-primary'> Edit </a>";
    
    $('#link_edit_web_contact').html(link);
    
    $.post(base_url+"web_contact/window_data_complete_web_contact", {
        id_web_contact : id
    }, function(data) {
        $('#id_web_contact').html(data.id);
        $('#id_people').html(data.name);                
		$('#email_1').html(data.email_1);
		$('#email_2').html(data.email_2);
		$('#email_3').html(data.email_3);				
		$('#website').html(data.website);
		$('#facebook').html(data.facebook);
		$('#twitter').html(data.twitter);
		$('#instagram').html(data.instagram);
		$('#linkedin').html(data.linkedin);
		$('#other_social_network_1').html(data.other_social_network_1);
		$('#url_other_sn_1').html(data.url_other_sn_1);
		$('#other_social_network_2').html(data.other_social_network_2);
		$('#url_other_sn_2').html(data.url_other_sn_2);
                                                                                                                                                                                
        $('#windowDataCompleteWeb_Contact').modal('show');
    }, 'json');    
}








