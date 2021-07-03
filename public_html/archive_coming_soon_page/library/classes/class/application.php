<?php

require_once '_comm.php';

//custom account item class as account table abstraction
class class_application extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name				= 'application';
	protected $_primary			= 'application_code';
	public $_comm						= null;
	
	function init()	{
		$this->_comm					= new class_comm();
	}
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['application_added']		= date('Y-m-d H:i:s');
        $data['application_code']		= $this->createReference();
		
		return parent::insert($data);
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where) {
        // add a timestamp
        $data['application_updated'] = date('Y-m-d H:i:s'); 
        
        return parent::update($data, $where);
    }
	
	public function getByType($type)	{
	
		$select = $this->_db->select()	
						->from(array('application' => 'application'))
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
						->joinLeft('participant', 'participant.participant_code = application.participant_code and participant_deleted = 0')
						->joinLeft('year', 'year.year_code = application.year_code')	
						->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')							
						->where('application_deleted = 0 and year_deleted = 0')
						->where('application_type = ?', $type)
						->order(array('year_name', 'application_name'));

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}

	/**
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_title');
	 * @param string $order
     * @return object
	 */
	public function checkLogin($username = '', $password= '') {
		$select = $this->_db->select()	
							->from(array('application' => 'application'))	
							->where('application_email = ?', $username)
							->where('application_active = 1')
							->where('application_deleted = 0')
							->where('application_password = ?', $password);

	   $result = $this->_db->fetchRow($select);
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
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
						->joinLeft('year', 'year.year_code = application.year_code')						
						->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')	
						->where('application_deleted = 0 and year_deleted = 0')						
					   ->where('application.application_code = ?', $code)					   
					   ->where('application_deleted = 0')
					   ->group('application.application_code')
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
						->from(array('application' => 'application'))	
					   ->where('application_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<15;$i++){
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
	 * get job by job application Id
 	 * @param string job id
     * @return object
	 */
	public function getByCell($cell, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_cellphone = ?', $cell)
						->where('application_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_cellphone = ?', $cell)
						->where('application_code != ?', $code)
						->where('application_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job application Id
 	 * @param string job id
     * @return object
	 */
	public function getByEmail($email, $type, $code = null) {
	
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_email = ?', $email)
						->where('application_type = ?', $type)
						->where('application_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_email = ?', $email)
						->where('application_code != ?', $code)
						->where('application_type = ?', $type)
						->where('application_deleted = 0')
						->limit(1);		
	   }

	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}

	/**
	 * get job by job application Id
 	 * @param string job id
     * @return object
	 */
	public function getByIDnumber($idnumber, $code = null)
	{
		if($code == null) {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_idnumber = ?', $idnumber)
						->where('application_deleted = 0')
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('application' => 'application'))	
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->where('application_idnumber = ?', $idnumber)
						->where('application_code != ?', $code)
						->where('application_deleted = 0')
						->limit(1);		
	   }
	   
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function validateIDnumber($idnr) {	
		if(strlen(trim($idnr)) == 13) {
			if(preg_match('/([0-9][0-9])(([0][1-9])|([1][0-2]))(([0-2][0-9])|([3][0-1]))([0-9])([0-9]{3})([0-9])([0-9])([0-9])/', trim($idnr))) {
				return trim($idnr);
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
		
	public function validateEmail($string) {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
			return trim($string);
		} else {
			return '';
		}
	}
	
	public function validateCell($string) {
		if(preg_match('/^0[0-9]{9}$/', $this->onlyCellNumber(trim($string)))) {
			return $this->onlyCellNumber(trim($string));
		} else {
			return '';
		}
	}
	
	public function onlyCellNumber($string) {

		/* Remove some weird charactors that windows dont like. */
		$string = strtolower($string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace('___' , '' , $string);
		$string = str_replace('__' , '' , $string);	
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);
		$string = str_replace("é", "", $string);
		$string = str_replace("è", "", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "", $string);
		$string = str_replace("\\", "", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace(".", "", $string);
		$string = str_replace("ë", "", $string);	
		$string = str_replace("â€“", "", $string);	
		$string = str_replace("â", "", $string);	
		$string = str_replace("€", "", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(':' , '' , $string);		
		$string = str_replace('[' , '' , $string);		
		$string = str_replace(']' , '' , $string);		
		$string = str_replace('|' , '' , $string);		
		$string = str_replace('\\' , '' , $string);		
		$string = str_replace('%' , '' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '' , $string);
		$string = str_replace('__' , '' , $string);
		$string = str_replace(' ' , '' , $string);	
		$string = str_replace('-' , '' , $string);	
		$string = str_replace('+27' , '0' , $string);	
		$string = str_replace('(0)' , '' , $string);	
		
		$string = preg_replace('/^00/', '0', $string);
		$string = preg_replace('/^27/', '0', $string);
		
		$string = preg_replace('!\s+!',"", strip_tags($string));
		
		return $string;
				
	}
}
?>