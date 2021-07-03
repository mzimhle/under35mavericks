<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/category.php';

$categoryObject = new class_category();

$categoryData = $categoryObject->pairs();

if($categoryData) $smarty->assign('categoryData', $categoryData);

/* Display the template */	
$smarty->display('awards/gallery/default.tpl');

?>