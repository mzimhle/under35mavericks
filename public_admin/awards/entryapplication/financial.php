<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';
/**
 * Check for login
 */
require_once 'includes/auth.php';
/* objects. */
require_once 'class/application.php';
require_once 'class/applicationentity.php';

$applicationObject 			= new class_application();
$applicationentityObject	= new class_applicationentity();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$applicationData = $applicationObject->getByCode($code);

	if($applicationData) {		
		
		$smarty->assign('applicationData', $applicationData);
		
	} else {
		header('Location: /awards/entryapplication/');
		exit;		
	}
} else {
	header('Location: /awards/entryapplication/');
	exit;
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
	
	/* People details. */
	
	if(isset($_POST['applicationentity_year']) && trim($_POST['applicationentity_year']) == '') {
		$errorArray[] = 'Year period is required';
		$formValid = false;		
	} else {
	
		$item = $applicationentityObject->getByYear('FINANCIAL', $code, trim($_POST['applicationentity_year']));
		
		if($item) {
			$errorArray[] = 'Year has already been added';
			$formValid = false;				
		}
	}
	
	if(isset($_POST['applicationentity_revenue']) && trim($_POST['applicationentity_revenue']) == '') {
		$errorArray[] = 'Revenue is required';
		$formValid = false;		
	}
	
	if(isset($_POST['applicationentity_profit']) && trim($_POST['applicationentity_profit']) == '') {
		$errorArray[] = 'Gross profit is required';
		$formValid = false;		
	}
	
	if(isset($_POST['applicationentity_description']) && trim($_POST['applicationentity_description']) == '') {
		$errorArray[] = 'Drivers of profit growth or reduction required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {

		$data 	= array();				
		$data['applicationentity_type']				= 'FINANCIAL';		
		$data['applicationentity_reference']		= $applicationData['application_code'];	
		$data['applicationentity_year']			= trim($_POST['applicationentity_year']);		
		$data['applicationentity_revenue']		= trim($_POST['applicationentity_revenue']);			
		$data['applicationentity_profit']			= trim($_POST['applicationentity_profit']);
		$data['applicationentity_description']	= trim($_POST['applicationentity_description']);		
		
		$success	= $applicationentityObject->insert($data);
				
		if(count($errorArray) == 0) {
			header('Location: /awards/entryapplication/financial.php?code='.$applicationData['application_code']);	
			exit;		
		}
	}
	/* if we are here there are errors. */
	$smarty->assign('errorArray', implode('<br />', $errorArray));	
}

if(isset($_GET['update_code'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$formValid				= true;
	$success				= NULL;
	$item					= trim($_GET['update_code']);
	
	if(!isset($_REQUEST['revenue'])) {
		$errorArray['error']	= 'Please add revenue';
		$errorArray['result']	= 0;
	} else if(trim($_REQUEST['revenue']) == ''){
		$errorArray['error']	= 'Please add revenue';
		$errorArray['result']	= 0;	
	}
	
	if(!isset($_REQUEST['profit'])) {
		$errorArray['error']	= 'Please add profit';
		$errorArray['result']	= 0;
	} else if(trim($_REQUEST['profit']) == ''){
		$errorArray['error']	= 'Please add profit';
		$errorArray['result']	= 0;	
	}

	if(!isset($_REQUEST['description'])) {
		$errorArray['error']	= 'Please add description';
		$errorArray['result']	= 0;
	} else if(trim($_REQUEST['description']) == ''){
		$errorArray['error']	= 'Please add description';
		$errorArray['result']	= 0;	
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1 ) {
		$data	= array();
		$data['applicationentity_revenue'] = trim($_REQUEST['revenue']);
		$data['applicationentity_profit'] = trim($_REQUEST['profit']);
		$data['applicationentity_description'] = trim($_REQUEST['description']);
		
		$where		= array();
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_code = ?', $item);
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_reference = ?', $applicationData['application_code']);
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_type = ?', 'FINANCIAL');
		$success	= $applicationentityObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'We could not update the record, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

if(isset($_GET['delete_code'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$item						= trim($_GET['delete_code']);
	
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['applicationentity_deleted'] = 1;
		
		$where		= array();
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_code = ?', $item);
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_reference = ?', $applicationData['application_code']);
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_type = ?', 'FINANCIAL');
		$success	= $applicationentityObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete record, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

$applicationentityData = $applicationentityObject->getByType('FINANCIAL', $code);
if($applicationentityData) $smarty->assign('applicationentityData', $applicationentityData);

$smarty->display('awards/entryapplication/financial.tpl');
?>