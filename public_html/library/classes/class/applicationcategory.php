<?php
/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_applicationcategory extends Zend_Db_Table_Abstract
{
	//declare table variables
    protected $_name 		= 'applicationcategory';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['applicationcategory_added'] = date('Y-m-d H:i:s');
        $data['applicationcategory_code'] 	= $this->createCode();
		
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
        $data['applicationcategory_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('applicationcategory' => 'applicationcategory'))	
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationcategory.applicationcategory_reference and application_deleted = 0')
					   ->where('applicationcategory_code = ?', $reference)
					   ->where('applicationcategory_deleted = 0')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByApplication($application) {
		$select = $this->_db->select()	
						->from(array('applicationcategory' => 'applicationcategory'))	
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationcategory.application_code ')
						->joinLeft(array('awardcategory' => 'awardcategory'), 'awardcategory.awardcategory_code = applicationcategory.category_code')						
					   ->where('applicationcategory.application_code = ?', $application)
					   ->where('applicationcategory_deleted = 0 and application_deleted = 0 and awardcategory_deleted = 0');

		$result = $this->_db->fetchAll($select);	
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
						->from(array('applicationcategory' => 'applicationcategory'))	
					   ->where('applicationcategory_code = ?', $reference)
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
		
		for($i=0;$i<5;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		$reference .= time().$reference;
		
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