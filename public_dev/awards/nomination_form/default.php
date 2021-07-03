<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/category.php';
require_once 'class/application.php';

$categoryObject 	= new class_category();
$applicationObject 	= new class_application();

$categoryData = $categoryObject->pairs();

if($categoryData) $smarty->assign('categoryData', $categoryData);

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray				= array();
	$errorArray['message']	= array();
	$errorArray['result']	= 1;	
	
	/* Nominator details. */
	if(isset($_POST['application_nominator_name']) && trim($_POST['application_nominator_name']) == '') {
		$errorArray['message'][] = 'Your full name(s) and surname are required.';
		$errorArray['result'] = 0;		
	}

	if(isset($_POST['application_nominator_email']) && trim($_POST['application_nominator_email']) != '') {
		if($applicationObject->validateEmail(trim($_POST['application_nominator_email'])) == '') {
			$errorArray['message'][] = 'Your email address needs to be valid.';
			$errorArray['result'] = 0;	
		}
	} else {
		$errorArray['message'][] = 'Please add your email address.';
		$errorArray['result'] = 0;			
	}
	
	if(isset($_POST['application_nominator_cellphone']) && trim($_POST['application_nominator_cellphone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_nominator_cellphone'])) == '') {
			$errorArray['message'][] = 'Your cellphone number needs to be valid, e.g. 0812569874.';
			$errorArray['result'] = 0;	
		}
	}

	if(isset($_POST['application_nominator_telephone']) && trim($_POST['application_nominator_telephone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_nominator_telephone'])) == '') {
			$errorArray['message'][] = 'Your telephone number needs to be valid. e.g. 0115896458';
			$errorArray['result'] = 0;	
		}
	}
	
	if(isset($_POST['application_nominator_relationship']) && trim($_POST['application_nominator_relationship']) == '') {
		$errorArray['message'][] = 'Please tell us your relationship with the nominee.';
		$errorArray['result'] = 0;		
	} 
	
	if(isset($_POST['application_nominator_area']) && trim($_POST['application_nominator_area']) == '') {
		$errorArray['message'][] = 'Please tell us where you are, select from drop down after 3 letters.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_name']) && trim($_POST['application_name']) == '') {
		$errorArray['message'][] = 'Nominee name is required please.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_surname']) && trim($_POST['application_surname']) == '') {
		$errorArray['message'][] = 'Nominee surname is required please.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_title']) && trim($_POST['application_title']) == '') {
		$errorArray['message'][] = 'Nominee title is required please.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_email']) && trim($_POST['application_email']) != '') {
		if($applicationObject->validateEmail(trim($_POST['application_email'])) == '') {
			$errorArray['message'][] = 'Nominee email address needs to be valid.';
			$errorArray['result'] = 0;	
		}
	} else {
		$errorArray['message'][] = 'Nominee email address is required please.';
		$errorArray['result'] = 0;			
	}
	
	if(isset($_POST['application_cellphone']) && trim($_POST['application_cellphone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_cellphone'])) == '') {
			$errorArray['message'][] = 'Nominee cellphone number is required please.';
			$errorArray['result'] = 0;	
		}
	}

	if(isset($_POST['application_telephone']) && trim($_POST['application_telephone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_telephone'])) == '') {
			$errorArray['message'][] = 'Nominee telephone number is required please.';
			$errorArray['result'] = 0;	
		}
	}
	
	/* Company details. */
	if(isset($_POST['application_entity_name']) && trim($_POST['application_entity_name']) == '') {
		$errorArray['message'][] = 'Nominee\'s company name is required please.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['category_code']) && trim($_POST['category_code']) == '') {
		$errorArray['message'][] = 'Nomiee\'s industry is required please.';
		$errorArray['result'] = 0;		
	}	
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['message'][] = 'Nominee\'s business location is required, select from drop down after 3 letters.';
		$errorArray['result'] = 0;		
	}	
	
	if(count($errorArray['message']) == 0 && $errorArray['result'] == 1) {

		$data 	= array();						
		$data['year_code']										= date('Y');	
		$data['application_nominator_name']			= trim($_POST['application_nominator_name']);		
		$data['application_nominator_email']			= trim($_POST['application_nominator_email']);			
		$data['application_nominator_cellphone']		= trim($_POST['application_nominator_cellphone']);
		$data['application_nominator_telephone']		= trim($_POST['application_nominator_telephone']);	
		$data['application_nominator_relationship']	= trim($_POST['application_nominator_relationship']);	
		$data['application_nominator_area']			= trim($_POST['application_nominator_area']);			

		$data['application_name']							= trim($_POST['application_name']);	
		$data['application_surname']						= trim($_POST['application_surname']);	
		$data['application_title']								= trim($_POST['application_title']);	
		$data['application_email']							= trim($_POST['application_email']);	
		$data['application_cellphone']						= trim($_POST['application_cellphone']);		
		$data['application_telephone']						= trim($_POST['application_telephone']);

		$data['areapost_code']								= trim($_POST['areapost_code']);						
		$data['category_code']								= trim($_POST['category_code']);
		$data['application_entity_name']					= trim($_POST['application_entity_name']);	
		$data['application_type']								= 'NOMINATION';

		$success	= $applicationObject->insert($data);
		
		if(!$success) {
			$errorArray['message'][] = 'Nomination has not been successfully added, please try again.';
			$errorArray['result'] = 0;				
		}
	}
	
	$errorArray['message'] = implode('<br />', $errorArray['message']);
	echo json_encode($errorArray);
	exit;
}

/* Display the template */	
$smarty->display('awards/nomination_form/default.tpl');

?>