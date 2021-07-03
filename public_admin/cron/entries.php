<?php

ini_set('max_execution_time', 500); //300 seconds = 5 minutes

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/application.php';
require_once 'class/companypeople.php';
require_once 'class/applicationentity.php';
require_once 'class/applicationanswer.php';
require_once 'class/applicationcategory.php';
require_once 'class/_comm.php';
require_once 'pdfcrowd/pdfcrowd.php';

$applicationObject 				= new class_application();
$companypeopleObject		= new class_companypeople();
$applicationentityObject		= new class_applicationentity();
$applicationanswerObject 	= new class_applicationanswer();
$applicationcategoryObject	= new class_applicationcategory();
$commObject					= new class_comm();

$previous_week = strtotime("-1 week +1 day");
$start_week = strtotime("last sunday midnight",$previous_week);
$end_week = strtotime("next saturday",$start_week);
$start_week = date("Y-m-d",$start_week);
$end_week = date("Y-m-d",$end_week);


$smarty->assign('weekstart', $start_week);
$smarty->assign('weekend', $end_week);

if(isset($_REQUEST['code'])) {
	/* */
	$applicationData = $applicationObject->getByType('ENTRY', trim($_REQUEST['code']));
	
} else {
	/* Setup Pagination. */
	$applicationData = $applicationObject->getByType('ENTRY');
}

if($applicationData) {
		
	for($i = 0; $i < count($applicationData); $i++) {
	
		/* Get people. */
		$applicationData[$i]['people'] 						= $companypeopleObject->getByType('APPLICATION', $applicationData[$i]['application_code']);		
		/* Get financials. */
		$applicationData[$i]['financials'] 					= $applicationentityObject->getByType('FINANCIAL', $applicationData[$i]['application_code']);		
		/* Get employees. */
		$applicationData[$i]['employees'] 				= $applicationentityObject->getByType('EMPLOYEE', $applicationData[$i]['application_code']);		
		/* Get category questionair. */
		$applicationData[$i]['questionaircategory'] 	= $applicationcategoryObject->getByApplication($applicationData[$i]['application_code']);		
		/* Get section questionair. */
		$applicationData[$i]['questionairsection'] 	= $applicationanswerObject->getAnswers(date('Y'), $applicationData[$i]['application_code']);
		
		$application = $applicationData[$i];
		
		$fileexists = true;
		
		/* Create folder. */
		$directory	= realpath(__DIR__.'/../../public_html/').'/media/pdf/'.$application['application_code'].'/';
		
		if(!is_dir($directory)) mkdir($directory, 0777, true);
		
		$filename	= $directory.$application['application_code'].'.html';
		$pdffile		= $directory.$application['application_code'].'.pdf';
		
		//if(!file_exists($pdffile)) {
		
			/* Get the Template. */
			$smarty->assign('application', $application);
			
			$template = $smarty->fetch(realpath(__DIR__.'/../../public_html/').'/templates/application_pdf_entry.html');
			
			if(file_put_contents($filename, $template)) {
				try {
					/* Create pdf file. */
					$pdfObject	= new Pdfcrowd("willow_nettica", "6be184b78c92a8da33964db13d079b6e");
					
					$pdfdata = $pdfObject->convertFile($filename);

					if(file_put_contents($pdffile, $pdfdata)) {
						echo 'File created<br />';
					} else {
						$fileexists = false;
						echo 'ERROR: File not created<br />';
					}
				} catch(PdfcrowdException $e)  {										
					echo 'ERROR: PDF ERROR: '.$e->getMessage().'<br />';
					$fileexists = false;
				}				
			}
/*
		} else {
			echo 'File exists<br />';
		}
*/
		if($fileexists) {
			$attachments = array(array('name' => $application['application_code'].'.pdf', 'path' => $pdffile));
			
			$message 			= array();
			$message['title'] 	= 'Entry Form - '.$application['application_name'].' '.$application['application_name'];
			$message['message'] = 'Entry form for '.$application['application_name'].' '.$application['application_name'].' made on '.$application['application_added'];
			
			/* Email the pdf file. */
			$sent = $commObject->sendComm(realpath(__DIR__.'/../../public_html/').'/templates/standard.html', $message, 'Entry Form: '.$application['application_name'].' '.$application['application_name'].' - '.$application['application_added'], $attachments);
			
			if($sent) {
				echo 'Mail sent<br />';
			} else {
				echo 'ERROR: Mail not sent<br />';
			}
		} else {
			echo 'ERROR: FILE not created<br />';
		}
		
		echo '==========================================<br />';

	}
}

$nominationData = false; //$applicationObject->getByType('NOMINATION');

/*
if($nominationData) {
	
	for($i = 0; $i < count($nominationData); $i++) {
	
		$application = $nominationData[$i];

		$smarty->assign('application', $application);
		
		$template = $smarty->fetch(realpath(__DIR__.'/../../public_html/').'/templates/application_pdf_nomination.html');


		$directory	= realpath(__DIR__.'/../../public_html/').'/media/pdf/'.$application['application_code'].'/';
		
		if(!is_dir($directory)) mkdir($directory, 0777, true);
		
		$filename	= $directory.$application['application_code'].'.html';
		$pdffile	= $directory.$application['application_code'].'.pdf';
		
		if(file_put_contents($filename, $template)) {
			
			try {

				$pdfObject	= new Pdfcrowd("willow_nettica", "6be184b78c92a8da33964db13d079b6e");
				
				$pdfdata = $pdfObject->convertFile($filename);

				if(file_put_contents($pdffile, $pdfdata)) {
				
					$attachments = array(array('name' => $application['application_code'].'.pdf', 'path' => $pdffile));
					
					$message 			= array();
					$message['title'] 	= 'Nomination Form - '.$application['application_name'].' '.$application['application_name'];
					$message['message'] = 'Nomination form for '.$application['application_name'].' '.$application['application_name'].' made on '.$application['application_added'];

					$sent = $commObject->sendComm(realpath(__DIR__.'/../../public_html/').'/templates/standard.html', $message, 'Nomination Form: '.$application['application_name'].' '.$application['application_name'].' - '.$application['application_added'], $attachments);					
				}					
			} catch(PdfcrowdException $e)  {						
				echo 'Pdfcrowd Error: ' . $e->getMessage();					
			}				
		}	
	}
}
*/
	
?>
