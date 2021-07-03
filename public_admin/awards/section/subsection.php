<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';

/* objects. */
require_once 'class/awardsection.php';
require_once 'class/awardsubsection.php';

$awardsectionObject		= new class_awardsection();
$awardsubsectionObject	= new class_awardsubsection();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$awardsectionData = $awardsectionObject->getByCode($code);

	if($awardsectionData) {
		$smarty->assign('awardsectionData', $awardsectionData);
		
		$awardsubsectionData = $awardsubsectionObject->getBySection($awardsectionData['awardsection_code']);

		if($awardsubsectionData) {
			$smarty->assign('awardsubsectionData', $awardsubsectionData);
		}	
	} else {
		header('Location: /awards/section/');
		exit;	
	}
	
} else {
	header('Location: /awards/section/');
	exit;	
}

/* Check posted data. */
if(isset($_GET['awardsubsection_code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['awardsubsection_code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {	
		$data	= array();
		$data['awardsubsection_deleted'] = 1;
		
		$where		= array();
		$where[]	= $awardsubsectionObject->getAdapter()->quoteInto('awardsubsection_code = ?', $itemcode);
		$where[]	= $awardsubsectionObject->getAdapter()->quoteInto('awardsection_code = ?', $code);
		
		$success	= $awardsubsectionObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {		
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Check posted data. */
if(isset($_GET['awardsubsection_code_update'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['awardsubsection_code_update']);
	
	if(!isset($_GET['name'])) {
		$errorArray['error']  = 'Please add a description';
		$errorArray['result']	= 0;
	} else if(trim($_GET['name']) == '') {
		$errorArray['error']  = 'Please add a description';
		$errorArray['result']	= 0;
	}
	
	if(!isset($_GET['index'])) {
		$errorArray['error']  = 'Please add an ordering';
		$errorArray['result']	= 0;
	} else if((int)trim($_GET['index']) == 0) {
		$errorArray['error']  = 'Please add an ordering';
		$errorArray['result']	= 0;
	}
	
	if($errorArray['error']  == '') {

		$index = $awardsubsectionObject->changeOrder($code, $itemcode, (int)trim($_GET['index']));
		
		if($index) {
			$data 	= array();
			$data['awardsubsection_name']	= trim($_GET['name']);	
			
			$where		= array();
			$where[]	= $awardsubsectionObject->getAdapter()->quoteInto('awardsubsection_code = ?', $itemcode);
			$success	= $awardsubsectionObject->update($data, $where);	
		} else {
			$errorArray['error']	= 'Could not update index, please try again';
			$errorArray['result']	= 0;					
		}
		
		if(is_numeric($success)) {		
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not update, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['awardsubsection_name']) && trim($_POST['awardsubsection_name']) == '') {
		$errorArray['awardsubsection_name'] = 'Sub section name is required.';
		$formValid = false;		
	}

	if(count($errorArray) == 0 && $formValid == true) {

		$data 	= array();					
		$data['awardsubsection_name']	= trim($_POST['awardsubsection_name']);						
		$data['awardsection_code']			= $awardsectionData['awardsection_code'];	
		
		$success	= $awardsubsectionObject->insert($data);			

		
		if(count($errorArray) == 0) {
			header('Location: /awards/section/subsection.php?code='.$awardsectionData['awardsection_code']);	
			exit;		
		}
	}
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}

/* Display the template */	
$smarty->display('awards/section/subsection.tpl');

?>