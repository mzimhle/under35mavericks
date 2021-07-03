<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

/*** Check for login */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/application.php';
require_once 'class/applicationanswer.php';
require_once 'class/applicationcategory.php';


$applicationObject 				= new class_application();
$applicationanswerObject 	= new class_applicationanswer();
$applicationcategoryObject	= new class_applicationcategory();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$applicationData = $applicationObject->getByCode($code);

	if($applicationData) {
	
		$smarty->assign('applicationData', $applicationData);
		
		$answerData = $applicationanswerObject->getAnswers(date('Y'), $code);
		
		if($answerData) {
			$smarty->assign('answerData', $answerData);
		}
		
		$categoryData = $applicationcategoryObject->getByApplication($code);
		if($categoryData) {
			$smarty->assign('categoryData', $categoryData);
		}

	} else {
		header('Location: /awards/entryapplication/');
		exit;		
	}
}

$smarty->display('awards/entryapplication/question.tpl');

?>