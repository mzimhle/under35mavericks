<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/galleryimage.php';

$galleryimageObject = new class_galleryimage();

$galleryimageData = $galleryimageObject->getByGallery('6752376643');

if($galleryimageData) {
	$smarty->assign('galleryimageData', $galleryimageData);
}

/* Display the template */	
$smarty->display('awards/gallery/default.tpl');

?>