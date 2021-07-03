<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_awardsection extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'awardsection';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['awardsection_added'] 	= date('Y-m-d H:i:s');
        $data['awardsection_code'] 		= $this->createCode();
		$data['awardsection_index'] 	= $this->getLastIndex($data['year_code'])+1;

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
        $data['awardsection_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getLastIndex($year) {
	
		$select = $this->_db->select()	
						->from(array('awardsection' => 'awardsection'), array('max(awardsection_index) as awardsection_index'))	
						->joinLeft('year', 'year.year_code = awardsection.year_code', array())
						->where('awardsection.year_code = ?', $year)
						->where('awardsection_deleted = 0 and year_deleted = 0');
	
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? 0 : $result['awardsection_index'];
		
	}
	
	public function getAll() {
	
		$select = $this->_db->select()	
						->from(array('awardsection' => 'awardsection'))	
						->joinLeft('year', 'year.year_code = awardsection.year_code')
						->where('awardsection_deleted = 0 and year_deleted = 0')
						->where('awardsection_active = 1 and year_active = 1')
					   ->order(array('year.year_code desc', 'awardsection_name'));
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function pairs() {
	
		$select = $this->_db->select()	
						->from(array('awardsection' => 'awardsection'), array('awardsection_code', "concat(awardsection_name, ' for the ', year_name) as awardsection_name"))	
						->joinLeft('year', 'year.year_code = awardsection.year_code', array())
						->where('awardsection_deleted = 0 and year_deleted = 0')
						->where('awardsection_active = 1 and year_active = 1')
					   ->order(array('year.year_code desc', 'awardsection_name'));
	
		$result = $this->_db->fetchPairs($select);
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
						->from(array('awardsection' => 'awardsection'))	
						->joinLeft('year', 'year.year_code = awardsection.year_code')
						->where('awardsection_deleted = 0 and year_deleted = 0')
						->where('awardsection_active = 1 and year_active = 1')
					   ->where('awardsection_code = ?', $code)					   
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($code)
	{
		$select = $this->_db->select()	
						->from(array('awardsection' => 'awardsection'))	
					   ->where('awardsection_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createCode() {
		/* New code. */
		$code = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<3;$i++){
			$code .= $codeAlphabet[rand(0,$count)];
		}
		
		$code = time().$code;
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($code);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createCode();
		} else {
			return $code;
		}
	}	
	
}
?>