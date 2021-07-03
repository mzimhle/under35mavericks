<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_awardsubsection extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'awardsubsection';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['awardsubsection_added'] 	= date('Y-m-d H:i:s');
        $data['awardsubsection_code'] 	= $this->createCode();
		$data['awardsubsection_index'] 	= $this->getLastIndex($data['awardsection_code'])+1;
		
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
        $data['awardsubsection_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getLastIndex($awardsection) {
	
		$select = $this->_db->select()	
						->from(array('awardsubsection' => 'awardsubsection'), array('max(awardsubsection_index) as awardsubsection_index'))	
						->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code', array())
						->where('awardsubsection.awardsection_code = ?', $awardsection)
						->where('awardsubsection_deleted = 0 and awardsection_deleted = 0');
	
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? 0 : $result['awardsubsection_index'];
		
	}
	
	public function getAll() {
	
		$select = $this->_db->select()	
						->from(array('awardsubsection' => 'awardsubsection'))	
						->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code')
						->where('awardsubsection_deleted = 0 and awardsection_deleted = 0')
						->where('awardsubsection_active = 1 and awardsection_active = 1')
					   ->order(array('awardsection.awardsection_code desc', 'awardsubsection_name'));
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getBySection($section) {
	
		$select = $this->_db->select()	
						->from(array('awardsubsection' => 'awardsubsection'))	
						->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code')
						->where('awardsubsection_deleted = 0 and awardsection_deleted = 0')
						->where('awardsubsection_active = 1 and awardsection_active = 1')
						->where('awardsubsection.awardsection_code = ?', $section)
					   ->order(array('awardsection.year_code desc', 'awardsubsection_index'));
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function changeOrder($section, $code, $newindex)
	{
		/* Check if the ordering is the same as current one. */
		$subsectionData = $this->getByCode($code);
		
		if($subsectionData) {
			
			if((int)$subsectionData['awardsubsection_index'] == (int)$newindex) {
				/* Nothing is changing. */
				return true;
			} else {
				/* Get subsection by section and index.*/
				$othersubsectionData = $this->getByIndex($section, $newindex);
				
				if($othersubsectionData) {
					
					/* update with the previous ones index. */
					$data = array();
					$data['awardsubsection_index'] = $subsectionData['awardsubsection_index'];
					
					$where		= array();
					$where[]	= $this->getAdapter()->quoteInto('awardsubsection_code = ?', $othersubsectionData['awardsubsection_code']);
					$where[]	= $this->getAdapter()->quoteInto('awardsection_code = ?', $othersubsectionData['awardsection_code']);
					$success	= $this->update($data, $where);
					
					/* Update new sub section with the new order. */
					$data = $where = null; unset($where, $data); 
					$data = array();
					$data['awardsubsection_index'] = $newindex;
					
					$where		= array();
					$where[]	= $this->getAdapter()->quoteInto('awardsubsection_code = ?', $subsectionData['awardsubsection_code']);
					$where[]	= $this->getAdapter()->quoteInto('awardsection_code = ?', $subsectionData['awardsection_code']);
					$success	= $this->update($data, $where);
					
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByIndex($section, $index)
	{
		$select = $this->_db->select()	
				->from(array('awardsubsection' => 'awardsubsection'))	
				->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code')
				->where('awardsubsection_deleted = 0 and awardsection_deleted = 0')
				->where('awardsubsection_active = 1 and awardsection_active = 1')
				->where('awardsubsection.awardsection_code = ?', $section)					   
				->where('awardsubsection.awardsubsection_index = ?', $index)					   
				->limit(1);
		
		$result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code, $section = null)
	{
		if($section == null) {
			$select = $this->_db->select()	
							->from(array('awardsubsection' => 'awardsubsection'))	
							->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code')
							->where('awardsubsection_deleted = 0 and awardsection_deleted = 0')
							->where('awardsubsection_active = 1 and awardsection_active = 1')
						   ->where('awardsubsection_code = ?', $code)					   
						   ->limit(1);
		} else {
			$select = $this->_db->select()	
							->from(array('awardsubsection' => 'awardsubsection'))	
							->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code')
							->where('awardsubsection_deleted = 0 and awardsection_deleted = 0')
							->where('awardsubsection_active = 1 and awardsection_active = 1')
						   ->where('awardsubsection.awardsubsection_code = ?', $code)					   
						   ->where('awardsubsection.awardsection_code = ?', $section)		
						   ->limit(1);		
		}
		
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
						->from(array('awardsubsection' => 'awardsubsection'))	
					   ->where('awardsubsection_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	 public function pairs() {

		$select = $this->select()
					   ->from(array('awardsubsection' => 'awardsubsection'), array('awardsubsection.awardsubsection_code', 'awardsubsection.awardsubsection_name'))
					   ->where('awardsubsection_deleted = 0')
					   ->order('awardsubsection_name ASC');

	   $result = $this->_db->fetchPairs($select);	
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