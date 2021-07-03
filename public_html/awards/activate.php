<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/smarty.php';
require_once 'config/database.php';

$code = isset($_GET['code']) && trim($_GET['code']) != '' ? trim($_GET['code']) : '';

if($code == '') {

	/* Get the hell out of here. */
	header('Location: /404/');
	exit;
	
} else {
	
	require_once 'class/application.php';
	
	/* Object. */
	$applicationObject 			= new class_application();

	/* Fetch the use. */
	$applicationData = $applicationObject->getByHash($code, 0);

	if($applicationData) {
	
		$data = array('application_active' => 1);
		/* Activate account and stay on this page. */
		$where = $applicationObject->getAdapter()->quoteInto('application_code = ?', $applicationData['application_code']);
		$success = $applicationObject->update($data, $where);
		
		$applicationsendData = $applicationObject->getByCode($applicationData['application_code']);
		
		if($applicationsendData) {
			switch($applicationData['application_type']) {
				case 'ENTRY' : 
						$applicationObject->_comm->sendEntry(realpath(__DIR__.'/../../public_html/').'/templates/awards_entry_completed.html', 'AWARDS_ENTRY_COMPLETED', $applicationsendData, 'Awards Entry Application - Completed by '.$applicationsendData['application_name'].' '.$applicationsendData['application_surname']);
				break;
				case 'NOMINATION' : 
						$applicationObject->_comm->sendNominator(realpath(__DIR__.'/../../public_html/').'/templates/awards_nomination_completed.html', 'AWARDS_NOMINATION_COMPLETED', $applicationsendData, 'Awards Nomination Application - Completed by '.$applicationsendData['application_nominator_name']);
				break;
			}
		}
	} else {

		/* Get the hell out of here. */
		header('Location: /');
		exit;

	}
}

$smarty->assign('applicationData', $applicationData);

/* Display the template */	
$smarty->display('awards/activate.tpl');

?>