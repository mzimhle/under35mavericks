<?php
/* Add this on all pages on top. */
/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_applicationentity extends Zend_Db_Table_Abstract
{
	//declare table variables
    protected $_name 		= 'applicationentity';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['applicationentity_added'] = date('Y-m-d H:i:s');
        $data['applicationentity_code'] 	= $this->createCode();
		
		return parent::insert($data);
		
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
        $data['applicationentity_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getByType($type, $reference = null) {
		
		if($reference == null) {

			$select = $this->_db->select() 
							->from(array('applicationentity' => 'applicationentity'))
							->joinLeft(array('application' => 'application'), 'application.application_code = applicationentity.applicationentity_reference and application_deleted = 0')
							->where('applicationentity_deleted = 0')					   
							->where('applicationentity_type = ?', $type)
							->order('applicationentity_year');

			$result = $this->_db->fetchAll($select);
			
		} else {

			$select = $this->_db->select() 
						->from(array('applicationentity' => 'applicationentity'))
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationentity.applicationentity_reference and application_deleted = 0')
						->where('applicationentity_deleted = 0')					   
						->where('applicationentity_type = ?', $type)
						->where('applicationentity_reference = ?', $reference)
						->order('applicationentity_year');

			$result = $this->_db->fetchAll($select);

		}
		
		return ($result == false) ? false : $result = $result;
	}
	
	public function getByYear($type, $reference, $year) {

		$select = $this->_db->select() 
						->from(array('applicationentity' => 'applicationentity'))
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationentity.applicationentity_reference and application_deleted = 0')
						->where('applicationentity_deleted = 0')					   
						->where('applicationentity_type = ?', $type)
						->where('applicationentity_reference = ?', $reference)
						->where('applicationentity_year = ?', $year)
						->limit(1);

		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('applicationentity' => 'applicationentity'))	
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationentity.applicationentity_reference and application_deleted = 0')			
					   ->where('applicationentity_code = ?', $reference)
					   ->where('applicationentity_deleted = 0')
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
						->from(array('applicationentity' => 'applicationentity'))	
					   ->where('applicationentity_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createCode() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '1234567890';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<15;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createCode();
		} else {
			return $reference;
		}
	}
}
?>