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
require_once 'class/awardsubsection.php';
require_once 'class/awardquestion.php';

$awardsubsectionObject	= new class_awardsubsection();
$awardquestionObject	= new class_awardquestion();

if ((isset($_GET['code']) && trim($_GET['code']) != '') && (isset($_GET['section']) && trim($_GET['section']) != '')) {
	
	$code		= trim($_GET['code']);
	$section	= trim($_GET['section']);
	
	$awardsubsectionData = $awardsubsectionObject->getByCode($section, $code);

	if($awardsubsectionData) {
		$smarty->assign('awardsubsectionData', $awardsubsectionData);
		
		$questionData = $awardquestionObject->getBySubSection($awardsubsectionData['awardsubsection_code']);

		if($questionData) {
			$smarty->assign('questionData', $questionData);
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
if(isset($_GET['awardquestion_code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['awardquestion_code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {	
		$data	= array();
		$data['awardquestion_deleted'] = 1;
		
		$where		= array();
		$where[]	= $awardquestionObject->getAdapter()->quoteInto('awardquestion_code = ?', $itemcode);
		$where[]	= $awardquestionObject->getAdapter()->quoteInto('awardsubsection_code = ?', $awardsubsectionData['awardsubsection_code']);
		
		$success	= $awardquestionObject->update($data, $where);	
		
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
if(isset($_GET['awardquestion_code_update'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['awardquestion_code_update']);
	
	if(!isset($_GET['name'])) {
		$errorArray['error']  = 'Please add a question';
		$errorArray['result']	= 0;
	} else if(trim($_GET['name']) == '') {
		$errorArray['error']  = 'Please add a question';
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

		$index = $awardquestionObject->changeOrder($section, $itemcode, (int)trim($_GET['index']));
		
		if($index) {
			$data 	= array();
			$data['awardquestion_name']	= trim($_GET['name']);	
			
			$where		= array();
			$where[]	= $awardquestionObject->getAdapter()->quoteInto('awardquestion_code = ?', $itemcode);
			$success	= $awardquestionObject->update($data, $where);	
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
	
	if(isset($_POST['awardquestion_name']) && trim($_POST['awardquestion_name']) == '') {
		$errorArray['awardquestion_name'] = 'Question is required.';
		$formValid = false;		
	}

	if(count($errorArray) == 0 && $formValid == true) {

		$data 	= array();					
		$data['awardquestion_name']		= trim($_POST['awardquestion_name']);						
		$data['awardsubsection_code']			= $awardsubsectionData['awardsubsection_code'];	
		
		$success	= $awardquestionObject->insert($data);			

		
		if(count($errorArray) == 0) {
			header('Location: /awards/section/question.php?code='.$awardsubsectionData['awardsection_code'].'&section='.$awardsubsectionData['awardsubsection_code']);	
			exit;		
		}
	}
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}

/* Display the template */	
$smarty->display('awards/section/question.tpl');

?>