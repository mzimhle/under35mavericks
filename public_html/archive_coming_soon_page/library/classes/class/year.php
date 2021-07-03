<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_year extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'year';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['year_added'] = date('Y-m-d H:i:s');
		
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
        $data['year_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getAll($where = 'year_deleted = 0', $order = 'year_name desc') {
	
			$select = $this->_db->select() 
					   ->from(array('year' => 'year'))
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
	public function getByCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('year' => 'year'))	
					   ->where('year_code = ?', $reference)
					   ->where('year_deleted = 0')
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
						->from(array('year' => 'year'))	
					   ->where('year_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	public function pairs() {

		$select = $this->select()
					   ->from(array('year' => 'year'), array('year.year_code', 'year.year_name'))
					   ->where('year_deleted = 0')
					   ->order('year_name ASC');

	   $result = $this->_db->fetchPairs($select);	
       return ($result == false) ? false : $result = $result;			

	}
}
?>