<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/company.php';

$companyObject	= new class_company();

$results 				= array();
$list						= array();	

if(isset($_REQUEST['term'])) {
	
	$q						= trim($_REQUEST['term']); 
	$companyData	= $companyObject->search($q);
	
	
	if(count($companyData) > 0) {
		for($i = 0; $i < count($companyData); $i++) {
			$list[] = array(
				"id" 		=> $companyData[$i]["company_code"],
				"label" 	=> $companyData[$i]['company_name'],
				"value" 	=> $companyData[$i]['company_name']
			);			
		}
		
		foreach ($list as $details) {
			if (strpos(strtolower($details["value"]), $q) !== false) {
				$results[] = $details;
			}
		}	
	}
}

if(count($results) > 0) {
	echo json_encode($results); 
	exit;
} else {
	echo json_encode(array('id' => '', 'label' => 'no results')); 
	exit;
}
exit;

?>