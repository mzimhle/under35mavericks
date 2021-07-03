<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].PATH_SEPARATOR.realpath(__DIR__.'/../../public_html/library/classes/').PATH_SEPARATOR.realpath(__DIR__.'/../../public_html/'));

/* 
	Setup Smarty Templating System.
*/

require_once('smarty/Smarty.class.php');

$smarty = new Smarty;

/* config smarty debug build setup. */
$smarty->debugging 		= false;

/* set smarty cache settings */
$smarty->caching 			= false;
$smarty->force_compile 	= true;

$smarty->compile_check 	= true; 	/* don't check for dependent file changes */
$smarty->cache_lifetime 	= 0; 		/* 2 = per template defined! 0=disabled */

/* set smarty folders */
$smarty->template_dir 	= $_SERVER['DOCUMENT_ROOT'].'/';
$smarty->compile_dir 	= realpath(__DIR__.'/../../public_html/').'/cache/smarty/compile/';
$smarty->config_dir 		= realpath(__DIR__.'/../../public_html/').'/library/classes/smarty/config/';
$smarty->cache_dir 		= realpath(__DIR__.'/../../public_html/').'/cache/smarty/cache/';
$smarty->plugins_dir 	= array(realpath(__DIR__.'/../../public_html/').'/library/classes/smarty/plugins/', realpath(__DIR__.'/../../public_html/').'/library/classes/smarty/smarty_custom_plugins/');

/* Get a random number for the images. */
$cachRandom = substr(md5(rand(123,9876123) . time()), 1, 30); $smarty->assign('nc',$cachRandom); 
?>