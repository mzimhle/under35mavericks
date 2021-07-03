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

$applicationentityData = $applicationentityObject->getByType('EMPLOYEE', $code);
if($applicationentityData) $smarty->assign('applicationentityData', $applicationentityData);

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
	
		$item = $applicationentityObject->getByYear('EMPLOYEE', $code, trim($_POST['applicationentity_year']));
		
		if($item) {
			$errorArray[] = 'Year has already been added';
			$formValid = false;				
		}
	}
	
	if(isset($_POST['applicationentity_employee_number']) && trim($_POST['applicationentity_employee_number']) == '') {
		$errorArray[] = 'Number of employees is required';
		$formValid = false;		
	}
	
	if(isset($_POST['applicationentity_employee_amount']) && trim($_POST['applicationentity_employee_amount']) == '') {
		$errorArray[] = 'Average employee remuneration is required';
		$formValid = false;		
	}
	
	if(isset($_POST['applicationentity_description']) && trim($_POST['applicationentity_description']) == '') {
		$errorArray[] = 'Drivers of total employee growth or reduction required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {

		$data 	= array();				
		$data['applicationentity_type']							= 'EMPLOYEE';		
		$data['applicationentity_reference']					= $applicationData['application_code'];	
		$data['applicationentity_year']						= trim($_POST['applicationentity_year']);		
		$data['applicationentity_employee_number']	= trim($_POST['applicationentity_employee_number']);			
		$data['applicationentity_employee_amount']	= trim($_POST['applicationentity_employee_amount']);
		$data['applicationentity_description']				= trim($_POST['applicationentity_description']);		
		
		$success	= $applicationentityObject->insert($data);
				
		if(count($errorArray) == 0) {
			header('Location: /awards/entryapplication/employee.php?code='.$applicationData['application_code']);	
			exit;		
		}
	}
	/* if we are here there are errors. */
	$smarty->assign('errorArray', implode('<br />', $errorArray));	
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
		$where[] 	= $applicationentityObject->getAdapter()->quoteInto('applicationentity_type = ?', 'EMPLOYEE');
		$success	= $applicationentityObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not change status, please try again.';
			$errorArray['result']	= 0;				
		}
	}

	echo json_encode($errorArray);
	exit;

}

$smarty->display('awards/entryapplication/employee.tpl');
?>