<?php

ini_set('memory_limit','365M');
ini_set('max_execution_time', '600');

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';

/* objects. */
require_once 'class/gallery.php';
require_once 'class/galleryimage.php';
require_once 'class/File.php';

$galleryObject			= new class_gallery();
$galleryimageObject 	= new class_galleryimage();
$fileObject 				= new File(array('gif', 'png', 'jpg', 'jpeg', 'gif'));

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$galleryData = $galleryObject->getByCode($code);

	if($galleryData) {
		$smarty->assign('galleryData', $galleryData);
		
		$galleryimageData = $galleryimageObject->getByGallery($galleryData['gallery_code']);

		if($galleryimageData) {
			$smarty->assign('galleryimageData', $galleryimageData);
		}	
	} else {
		header('Location: /awards/galleries/');
		exit;	
	}
	
} else {
	header('Location: /awards/galleries/');
	exit;	
}

/* Check posted data. */
if(isset($_GET['galleryimage_code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['galleryimage_code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {	
		$data	= array();
		$data['galleryimage_deleted'] = 1;
		
		$where		= array();
		$where[]	= $galleryimageObject->getAdapter()->quoteInto('galleryimage_code = ?', $itemcode);
		$where[]	= $galleryimageObject->getAdapter()->quoteInto('gallery_code = ?', $galleryData['gallery_code']);
		
		$success	= $galleryimageObject->update($data, $where);	
		
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
if(isset($_GET['galleryimage_code_update'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$itemcode					= trim($_GET['galleryimage_code_update']);

	if($errorArray['error']  == '') {

		if(isset($_GET['galleryimage_primary']) && trim($_GET['galleryimage_primary']) == $itemcode) {			
			$galleryimageObject->updatePrimaryByGallery(trim($_GET['galleryimage_primary']), $galleryData['gallery_code']);			
		}
		
		$data 	= array();		
		$data['galleryimage_description']	= isset($_GET['galleryimage_description']) && trim($_GET['galleryimage_description']) != '' ? trim($_GET['galleryimage_description']) : '';			
		$data['galleryimage_active'] 			= isset($_GET['galleryimage_active']) && (int)trim($_GET['galleryimage_active']) == 1 ? 1 : 0;	
		
		$where		= array();
		$where[]	= $galleryimageObject->getAdapter()->quoteInto('galleryimage_code = ?', $itemcode);
		$where[]	= $galleryimageObject->getAdapter()->quoteInto('gallery_code = ?', $galleryData['gallery_code']);
		$success	= $galleryimageObject->update($data, $where);	

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
if(count($_FILES) > 0) {

	$errorArray	= '';
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_FILES['imagefile']['name']) && count($_FILES['imagefile']['name']) > 0) {
		for($i = 0; $i < count($_FILES['imagefile']['name'][$i]); $i++) {
			/* Check validity of the CV. */
			if((int)$_FILES['imagefile']['size'][$i] != 0 && trim($_FILES['imagefile']['name'][$i]) != '') {
				/* Check if its the right file. */
				$ext = $fileObject->file_extention($_FILES['imagefile']['name'][$i]); 

				if($ext != '') {
					$checkExt = $fileObject->getValidateExtention('imagefile', $ext, $i);

					if(!$checkExt) {
						$errorArray = 'Invalid file type something funny with the file format';
						$formValid = false;						
					}
				} else {
					$errorArray = 'Invalid file type';
					$formValid = false;									
				}
			} else {			
				switch((int)$_FILES['imagefile']['error'][$i]) {
					case 1 : $errorArray = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
					case 2 : $errorArray = 'File size exceeds the maximum file size'; $formValid = false; break;
					case 3 : $errorArray = 'File was only partically uploaded, please try again'; $formValid = false; break;
					case 4 : $errorArray = 'No file was uploaded'; $formValid = false; break;
					case 6 : $errorArray = 'Missing a temporary folder'; $formValid = false; break;
					case 7 : $errorArray = 'Faild to write file to disk'; $formValid = false; break;
				}
			}
		}
	}

	if(trim($errorArray) == '' && $formValid == true) {
		
		if(isset($_FILES['imagefile']) && count($_FILES['imagefile']['name']) > 0) {
			for($i = 0; $i < count($_FILES['imagefile']['name']); $i++) {				
				$data = array();
				$data['galleryimage_code']	= $galleryimageObject->createReference();		
				$data['gallery_code']			= $galleryData['gallery_code'];
					
				$ext 			= strtolower($fileObject->file_extention($_FILES['imagefile']['name'][$i]));					
				$filename	= $data['galleryimage_code'].'.'.$ext;		
				$directory	= realpath(__DIR__.'/../../../public_html/').'/media/awards/galleries/'.$galleryData['gallery_code'].'/'.$data['galleryimage_code'];
				$file			= $directory.'/'.$filename;	
	
				if(!is_dir($directory)) mkdir($directory, 0777, true); 

				/* Create files for this product type. */
				foreach($fileObject->logo as $item) {
					
					$newfilename = str_replace($filename, $item['code'].$filename, $file);
					
					/* Create new file and rename it. */
					$uploadObject	= PhpThumbFactory::create($_FILES['imagefile']['tmp_name'][$i]);
					$uploadObject->adaptiveResize($item['width'], $item['height']);
					$uploadObject->save($newfilename);		
				}

				$data['galleryimage_path']			= '/media/awards/galleries/'.$galleryData['gallery_code'].'/'.$data['galleryimage_code'];
				$data['galleryimage_filename']	= trim($_FILES['imagefile']['name'][$i]);
				$data['galleryimage_ext']			= '.'.$ext ;
		
				/* Check for other images. */
				$primary = $galleryimageObject->getPrimaryByGallery($galleryData['gallery_code']);		
				
				if($primary) {
					$data['galleryimage_primary']	= 0;
				} else {
					$data['galleryimage_primary']	= 1;
				}
		
				$success	= $galleryimageObject->insert($data);	
			}
		}
		header('Location: /awards/galleries/image.php?code='.$galleryData['gallery_code']);
		exit;
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}

/* Display the template */	
$smarty->display('awards/galleries/image.tpl');
$galleryimageObject = $errorArray = $data = $galleryData = $primary = $ext = $newfilename = $uploadObject = $item = $i = $filename = $file = $directory = $fileObject = $formValid = $checkExt = null;
unset($galleryimageObject, $errorArray, $data, $galleryData, $primary, $ext, $newfilename, $uploadObject, $item, $i, $filename, $file, $directory, $fileObject, $formValid, $checkExt);
?>