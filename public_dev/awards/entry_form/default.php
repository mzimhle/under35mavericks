<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/application.php';
require_once 'class/category.php';
require_once 'class/awardquestion.php';
require_once 'class/awardcategory.php';
require_once 'class/applicationanswer.php';
require_once 'class/applicationcategory.php';
require_once 'class/applicationentity.php';
require_once 'class/companypeople.php';

$applicationObject 				= new class_application();
$categoryObject 				= new class_category();
$awardquestionObject		= new class_awardquestion();
$awardcategoryObject 		= new class_awardcategory();
$applicationanswerObject	= new class_applicationanswer();
$applicationcategoryObject	= new class_applicationcategory();
$applicationentityObject		= new class_applicationentity();
$companypeopleObject		= new class_companypeople();

$categoryData = $categoryObject->pairs();

if($categoryData) $smarty->assign('categoryData', $categoryData);

$questions = $awardquestionObject->getQuestions(date('Y'));

if($questions) $smarty->assign('questions', $questions);

$awardcategoryData = $awardcategoryObject->getAll();

if($awardcategoryData) $smarty->assign('awardcategoryData', $awardcategoryData);

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= 1;	
	
	if(isset($_POST['application_name']) && trim($_POST['application_name']) == '') {
		$errorArray['message'][] = 'Your name is required please.';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_surname']) && trim($_POST['application_surname']) == '') {
		$errorArray['message'][] = 'Your surname is required please';
		$errorArray['result'] = 0;	
	}
	
	if(isset($_POST['application_title']) && trim($_POST['application_title']) == '') {
		$errorArray['message'][] = 'Your business title is required';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_email']) && trim($_POST['application_email']) != '') {
		if($applicationObject->validateEmail(trim($_POST['application_email'])) == '') {
			$errorArray['message'][] = 'Your email address is required';
			$errorArray['result'] = 0;	
		}
	} else {
		$errorArray['message'][] = 'Please add your email address';
		$errorArray['result'] = 0;			
	}
	 
	if(isset($_POST['application_cellphone']) && trim($_POST['application_cellphone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_cellphone'])) == '') {
			$errorArray['message'][] = 'Please add a valid cellphone number';
			$errorArray['result'] = 0;	
		}
	} else {
		$errorArray['message'][] = 'Please add your cellphone number';
		$errorArray['result'] = 0;		
	}

	if(isset($_POST['application_telephone']) && trim($_POST['application_telephone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_telephone'])) == '') {
			$errorArray['message'][] = 'Please add your telephone number';
			$errorArray['result'] = 0;
		}
	}
	
	if(isset($_POST['application_birthdate']) && trim($_POST['application_birthdate']) == '') {
		$errorArray['message'][] = 'Please add your birthdate';
		$errorArray['result'] = 0;
	}
	
	/* Company details. */
	if(isset($_POST['application_entity_name']) && trim($_POST['application_entity_name']) == '') {
		$errorArray['message'][] = 'Please add your company name';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_entity_number']) && trim($_POST['application_entity_number']) == '') {
		$errorArray['message'][] = 'Please add your company registration number';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_entity_tax']) && trim($_POST['application_entity_tax']) == '') {
		$errorArray['message'][] = 'Please add your tax number';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_entity_beelevel']) && trim($_POST['application_entity_beelevel']) == '') {
		$errorArray['message'][] = 'Please add your bbee level';
		$errorArray['result'] = 0;		
	}
	
	if(isset($_POST['application_entity_years']) && (int)trim($_POST['application_entity_years']) == 0) {
		$errorArray['message'][] = 'Please add business number of years';
		$errorArray['result'] = 0;	
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['areapost_code'] = 'Add your business area / town';
		$formValid = false;		
	}	
	
	if(isset($_POST['application_entity_telephone']) && trim($_POST['application_entity_telephone']) != '') {
		if($applicationObject->validateCell(trim($_POST['application_entity_telephone'])) == '') {
			$errorArray['message'][] = 'Please add your company telephone number';
			$errorArray['result'] = 0;
		}
	}
	
	if(isset($_POST['category_code']) && trim($_POST['category_code']) == '') {
		$errorArray['message'][] = 'Please add your business industry';
		$errorArray['result'] = 0;	
	}
	
	if(isset($_POST['application_entity_physical']) && trim($_POST['application_entity_physical']) == '') {
		$errorArray['message'][]	= 'Please add your physical address';
		$errorArray['result'] 			= 0;		
	}
	
	/******************************************************************** PEOPLE */
	if(isset($_POST['people_name'])) {
		
		for($i = 0; $i < count($_POST['people_name']); $i++) {
			/* Name. */
			if(isset($_POST['people_name'][$i]) && trim($_POST['people_name'][$i]) == '') {
				$errorArray['message'][]	= 'Please add a name';
				$errorArray['result'] 			= 0;						
			}
			/* Surname. */
			if(isset($_POST['people_surname'][$i]) && trim($_POST['people_surname'][$i]) == '') {
				$errorArray['message'][]	= 'Please add a surname';
				$errorArray['result'] 			= 0;						
			}
			/* Birthdate. */
			if(isset($_POST['people_birthdate'][$i]) && trim($_POST['people_birthdate'][$i]) == '') {
				$errorArray['message'][]	= 'Please add a birthdate';
				$errorArray['result'] 			= 0;						
			}
			/* Designation. */
			if(isset($_POST['people_designation'][$i]) && trim($_POST['people_designation'][$i]) == '') {
				$errorArray['message'][]	= 'Please add a designation';
				$errorArray['result'] 			= 0;						
			}		
		}
	} else {
		$errorArray['message'][]	= 'Please add a list of people in your organization';
		$errorArray['result'] 			= 0;				
	}	
	/********************************************************************/
	/******************************************************************** FINANCIALS */
	if(isset($_POST['gross_revenue_11']) && trim($_POST['gross_revenue_11']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['gross_profit_11']) && trim($_POST['gross_profit_11']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['drivers_11']) && trim($_POST['drivers_11']) == '') {
		$errorArray['message'][]	= 'Please add your reasons for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['gross_revenue_12']) && trim($_POST['gross_revenue_12']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['gross_profit_12']) && trim($_POST['gross_profit_12']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['drivers_12']) && trim($_POST['drivers_12']) == '') {
		$errorArray['message'][]	= 'Please add your reasons for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['gross_revenue_13']) && trim($_POST['gross_revenue_13']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['gross_profit_13']) && trim($_POST['gross_profit_13']) == '') {
		$errorArray['message'][]	= 'Please add your gross revenue for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['drivers_13']) && trim($_POST['drivers_13']) == '') {
		$errorArray['message'][]	= 'Please add your reasons for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}
	/********************************************************************/
	/******************************************************************** EMPLOYEE */
	if(isset($_POST['employee_number_11']) && trim($_POST['employee_number_11']) == '') {
		$errorArray['message'][]	= 'Please add your number of employees for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['employee_remuneration_11']) && trim($_POST['employee_remuneration_11']) == '') {
		$errorArray['message'][]	= 'Please add remuneration of employees for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['employee_drivers_11']) && trim($_POST['employee_drivers_11']) == '') {
		$errorArray['message'][]	= 'Please add your number and remuneration reasons for 2011 / 2012';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['employee_number_12']) && trim($_POST['employee_number_12']) == '') {
		$errorArray['message'][]	= 'Please add your number of employees for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['employee_remuneration_12']) && trim($_POST['employee_remuneration_12']) == '') {
		$errorArray['message'][]	= 'Please add remuneration of employees for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['employee_drivers_12']) && trim($_POST['employee_drivers_12']) == '') {
		$errorArray['message'][]	= 'Please add your number and remuneration reasons for 2012 / 2013';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['employee_number_13']) && trim($_POST['employee_number_13']) == '') {
		$errorArray['message'][]	= 'Please add your number of employees for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}	
	
	if(isset($_POST['employee_remuneration_13']) && trim($_POST['employee_remuneration_13']) == '') {
		$errorArray['message'][]	= 'Please add remuneration of employees for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['employee_drivers_13']) && trim($_POST['employee_drivers_13']) == '') {
		$errorArray['message'][]	= 'Please add your number and remuneration reasons for 2013 / 2014';
		$errorArray['result'] 			= 0;		
	}
	/********************************************************************/
	/******************************************************************** QUESTIONS */
	for($sec = 0; $sec < count($questions); $sec++) {
		for($sub = 0; $sub < count($questions[$sec]['subsections']); $sub++) {
			for($q = 0; $q < count($questions[$sec]['subsections'][$sub]['question']); $q++) {
			
				$question = $questions[$sec]['subsections'][$sub]['question'][$q];
				$questionid = $question['awardquestion_code'];

				if(isset($_POST['question_'.$questionid]) && trim($_POST['question_'.$questionid]) == '') {
					$errorArray['message'][]	= 'Question has not been answered';
					$errorArray['result'] 			= 0;		
				}				
			}
		}	
	}
	/********************************************************************/
	/******************************************************************** CATEGORIES */
	if(isset($_POST['categoryhidden_1']) && trim($_POST['categoryhidden_1']) == '') {
		$errorArray['message'][]	= 'Please add a category from the check box list';
		$errorArray['result'] 			= 0;		
	}
	if(isset($_POST['categorydescription_1']) && trim($_POST['categorydescription_1']) == '') {
		$errorArray['message'][]	= 'Please add a description of the first category';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['categoryhidden_2']) && trim($_POST['categoryhidden_2']) == '') {
		$errorArray['message'][]	= 'Please add a category from the check box list';
		$errorArray['result'] 			= 0;		
	}
	if(isset($_POST['categorydescription_2']) && trim($_POST['categorydescription_2']) == '') {
		$errorArray['message'][]	= 'Please add a description of the first category';
		$errorArray['result'] 			= 0;		
	}
	
	if(isset($_POST['categoryhidden_3']) && trim($_POST['categoryhidden_3']) == '') {
		$errorArray['message'][]	= 'Please add a category from the check box list';
		$errorArray['result'] 			= 0;		
	}
	if(isset($_POST['categorydescription_3']) && trim($_POST['categorydescription_3']) == '') {
		$errorArray['message'][]	= 'Please add a description of the first category';
		$errorArray['result'] 			= 0;		
	}		
	/********************************************************************/	
	if(count($errorArray['message']) == 0 && $errorArray['result'] == 1) {

		$data 									= array();				
		$data['areapost_code']			= trim($_POST['areapost_code']);		
		$data['year_code']					= date('Y');	
		$data['category_code']			= trim($_POST['category_code']);	
		$data['application_type']			= 'ENTRY';	
		$data['application_title']			= trim($_POST['application_title']);		
		$data['application_name']		= trim($_POST['application_name']);		
		$data['application_surname']	= trim($_POST['application_surname']);			
		$data['application_email']		= trim($_POST['application_email']);
		$data['application_cellphone']	= trim($_POST['application_cellphone']);	
		$data['application_birthdate']	= trim($_POST['application_birthdate']);				
		$data['application_telephone']	= trim($_POST['application_telephone']);	
		
		$data['application_social_twitter']		= trim($_POST['application_social_twitter']);	

		$data['application_entity_name']			= trim($_POST['application_entity_name']);	
		$data['application_entity_number']		= trim($_POST['application_entity_number']);	
		$data['application_entity_tax']				= trim($_POST['application_entity_tax']);	
		$data['application_entity_type']			= trim($_POST['application_entity_type']);			
		$data['application_entity_beelevel']		= trim($_POST['application_entity_beelevel']);	
		$data['application_entity_years']			= trim($_POST['application_entity_years']);	
		$data['application_entity_physical']		= trim($_POST['application_address_physical']);	
		$data['application_entity_postal']			= trim($_POST['application_address_postal']);	
		$data['application_entity_telephone']	= trim($_POST['application_entity_telephone']);	
		$data['application_entity_twitter']		= trim($_POST['application_entity_twitter']);			
		$data['application_entity_website']		= trim($_POST['application_entity_website']);		
		
		$applicationcode	= $applicationObject->insert($data);

		if($applicationcode) {		
			/* Add the people. */
			for($i = 0; $i < count($_POST['people_name']); $i++) {
			
				$people 	= array();				
				$people['companypeople_type']				= 'APPLICATION';		
				$people['companypeople_reference']		= $applicationcode;	
				$people['companypeople_name']			= trim($_POST['people_name'][$i]);		
				$people['companypeople_surname']		= trim($_POST['people_surname'][$i]);			
				$people['companypeople_birthdate']		= trim($_POST['people_birthdate'][$i]);
				$people['companypeople_designation']	= trim($_POST['people_designation'][$i]);
				
				$success	= $companypeopleObject->insert($people);		
		
			}
				
			/* Add financials. */
			$data 	= array();				
			$data['applicationentity_type']				= 'FINANCIAL';		
			$data['applicationentity_reference']		= $applicationcode;	
			$data['applicationentity_year']			= '2011 / 2012';		
			$data['applicationentity_revenue']		= trim($_POST['gross_revenue_11']);			
			$data['applicationentity_profit']			= trim($_POST['gross_profit_11']);
			$data['applicationentity_description']	= trim($_POST['drivers_11']);		
			
			$success	= $applicationentityObject->insert($data);
			
			$data 	= array();				
			$data['applicationentity_type']				= 'FINANCIAL';		
			$data['applicationentity_reference']		= $applicationcode;	
			$data['applicationentity_year']			= '2012 / 2013';		
			$data['applicationentity_revenue']		= trim($_POST['gross_revenue_12']);			
			$data['applicationentity_profit']			= trim($_POST['gross_profit_12']);
			$data['applicationentity_description']	= trim($_POST['drivers_12']);		
			
			$success	= $applicationentityObject->insert($data);			
	
			$data 	= array();				
			$data['applicationentity_type']				= 'FINANCIAL';		
			$data['applicationentity_reference']		= $applicationcode;	
			$data['applicationentity_year']			= '2013 / 2014';		
			$data['applicationentity_revenue']		= trim($_POST['gross_revenue_13']);			
			$data['applicationentity_profit']			= trim($_POST['gross_profit_13']);
			$data['applicationentity_description']	= trim($_POST['drivers_13']);		
			
			$success	= $applicationentityObject->insert($data);		
			
			/* Add people. */
			$data 	= array();				
			$data['applicationentity_type']							= 'EMPLOYEE';		
			$data['applicationentity_reference']					= $applicationcode;	
			$data['applicationentity_year']						= '2011 / 2012';		
			$data['applicationentity_employee_number']	= trim($_POST['employee_number_11']);			
			$data['applicationentity_employee_amount']	= trim($_POST['employee_remuneration_11']);
			$data['applicationentity_description']				= trim($_POST['employee_drivers_11']);		
			
			$success	= $applicationentityObject->insert($data);
			
			$data 	= array();				
			$data['applicationentity_type']							= 'EMPLOYEE';		
			$data['applicationentity_reference']					= $applicationcode;	
			$data['applicationentity_year']						= '2012 / 2013';		
			$data['applicationentity_employee_number']	= trim($_POST['employee_number_12']);			
			$data['applicationentity_employee_amount']	= trim($_POST['employee_remuneration_12']);
			$data['applicationentity_description']				= trim($_POST['employee_drivers_12']);		
			
			$success	= $applicationentityObject->insert($data);	
 
			$data 	= array();				
			$data['applicationentity_type']							= 'EMPLOYEE';		
			$data['applicationentity_reference']					= $applicationcode;	
			$data['applicationentity_year']						= '2013 / 2014';		
			$data['applicationentity_employee_number']	= trim($_POST['employee_number_13']);			
			$data['applicationentity_employee_amount']	= trim($_POST['employee_remuneration_13']);
			$data['applicationentity_description']				= trim($_POST['employee_drivers_13']);		
			
			$success	= $applicationentityObject->insert($data);	
			
			/* Add category and notes. */
			$data 	= array();				
			$data['application_code']				= $applicationcode;		
			$data['category_code']					= trim($_POST['categoryhidden_1']);			
			$data['applicationcategory_notes']	= trim($_POST['categorydescription_1']);
			
			$success	= $applicationcategoryObject->insert($data);	
			
			$data 	= array();				
			$data['application_code']				= $applicationcode;		
			$data['category_code']					= trim($_POST['categoryhidden_2']);			
			$data['applicationcategory_notes']	= trim($_POST['categorydescription_2']);
			
			$success	= $applicationcategoryObject->insert($data);	
			
			$data 	= array();				
			$data['application_code']				= $applicationcode;
			$data['category_code']					= trim($_POST['categoryhidden_3']);			
			$data['applicationcategory_notes']	= trim($_POST['categorydescription_3']);
			
			$success	= $applicationcategoryObject->insert($data);

			/* Add questions and answers. */
			for($sec = 0; $sec < count($questions); $sec++) {
				for($sub = 0; $sub < count($questions[$sec]['subsections']); $sub++) {
					for($q = 0; $q < count($questions[$sec]['subsections'][$sub]['question']); $q++) {
					
						$question = $questions[$sec]['subsections'][$sub]['question'][$q];
						$questionid = $question['awardquestion_code'];

						if(isset($_POST['question_'.$questionid]) && trim($_POST['question_'.$questionid]) != '') {
							$data 											= array();				
							$data['application_code']				= $applicationcode;		
							$data['awardquestion_code']			= $questionid;			
							$data['applicationanswer_notes']		= trim($_POST['question_'.$questionid]);
							
							$success = $applicationanswerObject->insert($data);
						}				
					}
				}	
			}
			
		} else {
			$errorArray['message'][] = 'Nomination entry has not been successfully added, please try again.';
			$errorArray['result'] = 0;			
		}
	}
	
	$errorArray['message'] = implode('<br />', $errorArray['message']);
	echo json_encode($errorArray);
	exit;
	
}

/* Display the template */	
$smarty->display('awards/entry_form/default.tpl');

$applicationObject = $categoryObject = $awardquestionObject =  $awardcategoryObject = $applicationanswerObject = $applicationcategoryObject = $applicationentityObject = $companypeopleObject = $categoryData = $questions = $awardcategoryData = $errorArray = $question = $sec = $sub = $q = $questionid = $data = $success = null;
unset($applicationObject, $categoryObject, $awardquestionObject,  $awardcategoryObject, $applicationanswerObject, $applicationcategoryObject, $applicationentityObject, $companypeopleObject, $categoryData, $questions, $awardcategoryData, $errorArray, $question, $sec, $sub, $q, $questionid, $data, $success);

?>