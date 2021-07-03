<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

require_once 'company.php';

//custom enquiry item class as enquiry table abstraction
class class_companyservice extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= 'companyservice';
	protected $_company 	= null;
	
	protected $_rule 			= array('SERVICE' => 6, 'CATEGORY' => 3);
	
	function init()	{
		$this->_company		= new class_company();
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
        $data['companyservice_added'] = date('Y-m-d H:i:s');
        $data['companyservice_code'] 	= $this->createReference();
		
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
        $data['companyservice_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getAll($where = 'companyservice_deleted = 0', $order = 'companyservice_name desc') {
	
			$select = $this->_db->select() 
					   ->from(array('companyservice' => 'companyservice'))					   
						->joinLeft(array('category' => 'category'), 'category.category_code = companyservice.category_code')	
						->where('companyservice_deleted = 0')
					   ->where($where)
					   ->order($order);
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getByCompany($company, $type, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select() 
					   ->from(array('companyservice' => 'companyservice'))
						->joinLeft(array('category' => 'category'), 'category.category_code = companyservice.category_code')	
						->where('companyservice_deleted = 0')					   
					   ->where('company_code = ?', $company)
					   ->where('companyservice_type = ?', $type)
					   ->order('companyservice_name');
	
			$result = $this->_db->fetchAll($select);
		} else {
			$select = $this->_db->select() 
					   ->from(array('companyservice' => 'companyservice'))
						->joinLeft(array('category' => 'category'), 'category.category_code = companyservice.category_code')	
						->where('companyservice_deleted = 0')					   
					   ->where('company_code = ?', $company)
					   ->where('companyservice.category_code = ?', $code)
					   ->where('companyservice_type = ?', $type)
					   ->order('companyservice_name');
	
			$result = $this->_db->fetchRow($select);			
		}
		
		return ($result == false) ? false : $result = $result;
	}
	
	public function _rule_count($companycode, $type) {
		
		$companyData = $this->_company->getByCode($companycode);
		
		$return = 0;
		
		if($companyData) {
		
			$items = $this->getByCompany($companycode, $type);			
			
			if($items) {
				return $this->_rule[$type] - count($items);
			} else {
				return $this->_rule[$type];
			}
		
		} else {
			return $return;
		}
	}
	
	public function updatePrimaryByCompany($code, $company, $type) {
		
		$item = $this->getPrimaryByCompany($company, $type);
		
		if($item) {
			$data = array();
			$where = null;
			$data['companyservice_primary'] = 0;
			
			$where		= $this->getAdapter()->quoteInto('companyservice_code = ?', $item['companyservice_code']);
			$success	= $this->update($data, $where);				
		}

		$data = array();
		$data['companyservice_primary'] = 1;
			
		$where		= $this->getAdapter()->quoteInto('companyservice_code = ?', $code);
		$success	= $this->update($data, $where);
		
		return $code;
	}
	
	public function getPrimaryByCompany($code, $type) {
		
		$select = $this->_db->select()	
					->from(array('companyservice' => 'companyservice'))	
					->joinLeft(array('category' => 'category'), 'category.category_code = companyservice.category_code')	
					->where('companyservice_deleted = 0')
					->where('companyservice.company_code = ?', $code)
					->where('companyservice.companyservice_type = ?', $type)
					->where('companyservice_deleted = 0')
					->where('companyservice_primary = 1')
					->order('companyservice_added desc')
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
						->from(array('companyservice' => 'companyservice'))	
						->joinLeft(array('category' => 'category'), 'category.category_code = companyservice.category_code')					
					   ->where('companyservice_code = ?', $reference)
					   ->where('companyservice_deleted = 0')
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
						->from(array('companyservice' => 'companyservice'))	
					   ->where('companyservice_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
}
?>