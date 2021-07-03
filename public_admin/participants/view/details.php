<?php/* Add this on all pages on top. */set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');/*** Standard includes */require_once 'config/database.php';require_once 'config/smarty.php';/*** Check for login */require_once 'includes/auth.php';/* objects. */require_once 'class/participant.php';$participantObject 	= new class_participant();if (isset($_GET['code']) && trim($_GET['code']) != '') {		$code = trim($_GET['code']);		$participantData = $participantObject->getByCode($code);	if($participantData) {		$smarty->assign('participantData', $participantData);	} else {		header('Location: /participants/view/');		exit;			}}/* Check posted data. */if(count($_POST) > 0) {	$errorArray		= array();	$data 				= array();	$formValid		= true;	$success			= NULL;	$areaByName	= NULL;		if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {		$errorArray['areapost_code'] = 'Area post is required';		$formValid = false;			}		if(isset($_POST['participant_name']) && trim($_POST['participant_name']) == '') {		$errorArray['participant_name'] = 'Name is required';		$formValid = false;			}		if(isset($_POST['participant_surname']) && trim($_POST['participant_surname']) == '') {		$errorArray['participant_surname'] = 'Surname is required';		$formValid = false;			}		if(isset($_POST['participant_email']) && trim($_POST['participant_email']) != '') {		if($participantObject->validateEmail(trim($_POST['participant_email'])) == '') {			$errorArray['participant_email'] = 'Needs to be a valid email address';			$formValid = false;			} else {						$email = isset($participantData) ? $participantData['participant_code'] : null;						$emailData = $participantObject->_participantlogin->checkEmail(trim($_POST['participant_email']), $email);			if($emailData) {				$errorArray['participant_email'] = 'Email already exists';				$formValid = false;							}		}	} else {		$errorArray['participant_email'] = 'Please add an email address';		$formValid = false;				}		if(isset($_POST['participant_cellphone']) && trim($_POST['participant_cellphone']) != '') {		if($participantObject->validateCell(trim($_POST['participant_cellphone'])) == '') {			$errorArray['participant_cellphone'] = 'Needs to be a valid cellphone';			$formValid = false;			}	}		if(isset($_POST['participant_birthdate']) && trim($_POST['participant_birthdate']) != '') {		if($participantObject->validateDate(trim($_POST['participant_birthdate'])) == '') {			$errorArray['participant_birthdate'] = 'Please add a valid birth date';			$formValid = false;			}	}		if(count($errorArray) == 0 && $formValid == true) {		$data 	= array();						$data['areapost_code']			= trim($_POST['areapost_code']);				$data['participant_name']		= trim($_POST['participant_name']);				$data['participant_surname']	= trim($_POST['participant_surname']);					$data['participant_email']		= trim($_POST['participant_email']);				$data['participant_cellphone']	= trim($_POST['participant_cellphone']);			$data['participant_birthdate']	= trim($_POST['participant_birthdate']);					if(isset($participantData)) {			/* Update. */			$data['participant_code']	= $participantData['participant_code'];							$success	= $participantObject->updateParticipant($data, 'EMAIL');		} else {			/* Update. */			$success	= $participantObject->insertParticipant($data, 'EMAIL');		}				if(count($errorArray) == 0) {			header('Location: /participants/view/');				exit;				}	}		/* if we are here there are errors. */	$smarty->assign('errorArray', $errorArray);	}$smarty->display('participants/view/details.tpl');?>