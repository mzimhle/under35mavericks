<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.realpath(__DIR__.'/../../public_html/library/classes/').PATH_SEPARATOR.realpath(__DIR__.'/../../public_html/'));

/* Setup Database Connection. */

require_once('Zend/Db.php');
require_once('Zend/Db/Table.php');

try {

	$conn = Zend_Db::factory('Mysqli', array(
		'host'     	=> 'localhost',
		'username' 	=> 'undercwp_wp319', 
		'password' 	=> 'ds*jd7dks',
		'dbname'   	=> 'undercwp_wp319'
	));
	
	$conn->getConnection();
} catch (Zend_Db_Adapter_Exception $e) {
	/* perhaps a failed login credential, or perhaps the RDBMS is not running */
} catch (Zend_Exception $e) {
	/* perhaps factory() failed to load the specified Adapter class */
	echo 'Failed to connect to database.';
}

/* set the fetchmode to object (this enables you to choose fetchAssoc as well as object */
$conn->setFetchMode(Zend_Db::FETCH_ASSOC);

/* set $conn as the default adapter for all abstracted tables */
Zend_Db_Table_Abstract::setDefaultAdapter($conn);

?>