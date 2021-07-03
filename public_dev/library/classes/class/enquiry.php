<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 02 December 2013
 * Author: Mzimhle Mosiwe
 */
require_once '_comm.php';
require_once 'mailinglist.php';

//custom enquiry item class as enquiry table abstraction
class class_enquiry extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= 'enquiry';
	protected $_primary 	= 'enquiry_code';
	public $_comm				= null;
	public $_mailinglist		= null;
	
	function init()	{
		$this->_comm		= new class_comm();
		$this->_mailinglist	= new class_mailinglist();
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['enquiry_added']	= date('Y-m-d H:i:s');
		$data['enquiry_code']		= $this->createReference();		
		
		$success = parent::insert($data);
		
		if($success) {
			$tempData = $this->getByCode($data['enquiry_code']);			
			if($tempData) {
				/* Create a new mailerlist record. */
				$this->_mailinglist->insertMailinglist('enquiry', $tempData);						
			}			
		}
		
		return $success;
		
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where)
    {
        // add a timestamp
        $data['enquiry_updated'] = date('Y-m-d H:i:s');
		
        $success = parent::update($data, $where);	

		$tempData = $this->getByCode($data['enquiry_code']);
		
		if($tempData) {
			$this->_mailinglist->updateMailinglist('enquiry', $tempData);
		}
		
		return $success;
    }
	
	public function getAll($where = 'enquiry.enquiry_deleted = 0', $order = 'enquiry_closing desc') {
	
			$select = $this->_db->select() 
					   ->from(array('enquiry' => 'enquiry'))					   
					   ->joinLeft('participant', 'participant.participant_code = enquiry.participant_code and participant_deleted = 0')
					   ->joinLeft('areapost', 'areapost.areapost_code = enquiry.areapost_code')
					   ->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = enquiry.enquiry_code and mailinglist_category = \'enquiry\'')							
					   ->where('enquiry.enquiry_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code)
	{
		$select = $this->_db->select()	
						->from(array('enquiry' => 'enquiry'))								
						->joinLeft('participant', 'participant.participant_code = enquiry.participant_code and participant_deleted = 0')			
						->joinLeft('areapost', 'areapost.areapost_code = enquiry.areapost_code')
						->joinLeft('mailinglist', 'mailinglist.mailinglist_reference = enquiry.enquiry_code and mailinglist_category = \'enquiry\'')							
						->where('enquiry_code = ?', $code)
						->where('enquiry_deleted = 0')
						->limit(1);
		
	   $result = $this->_db->fetchRow($select);	
       return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('enquiry' => 'enquiry'))					
						->where('enquiry_code = ?', $reference)
						->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<10;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getFilename($filename)
	{
		$select = $this->_db->select()	
						->from(array('enquiry' => 'enquiry'))					
						->where('enquiry_file_name = ?', $filename)
						->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createFile() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<10;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getFilename($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createFile();
		} else {
			return $reference;
		}
	}
	
}
?>