<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_awardcategory extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'awardcategory';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['awardcategory_added'] = date('Y-m-d H:i:s');
        $data['awardcategory_code'] 	= $this->createCode();
		
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
        $data['awardcategory_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getAll() {
	
		$select = $this->_db->select()	
						->from(array('awardcategory' => 'awardcategory'))	
						->joinLeft('year', 'year.year_code = awardcategory.year_code')
						->where('awardcategory_deleted = 0 and year_deleted = 0')
						->where('awardcategory_active = 1 and year_active = 1')
					   ->order(array('year.year_code desc', 'awardcategory_name'));
	
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
						->from(array('awardcategory' => 'awardcategory'))	
						->joinLeft('year', 'year.year_code = awardcategory.year_code')
						->where('awardcategory_deleted = 0 and year_deleted = 0')
						->where('awardcategory_active = 1 and year_active = 1')
					   ->where('awardcategory_code = ?', $code)					   
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
						->from(array('awardcategory' => 'awardcategory'))	
					   ->where('awardcategory_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	 public function pairs() {

		$select = $this->select()
					   ->from(array('awardcategory' => 'awardcategory'), array('awardcategory.awardcategory_code', 'awardcategory.awardcategory_name'))
					   ->where('awardcategory_deleted = 0')
					   ->order('awardcategory_name ASC');

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
	
	public function toUrl($string) {

		/* Remove some weird charactors that windows dont like. */
		$string = strtolower($string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace('___' , '_' , $string);
		$string = str_replace('__' , '_' , $string);	
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace("â€“", "ae", $string);	
		$string = str_replace("â", "a", $string);	
		$string = str_replace("€", "e", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '_' , $string);		
		$string = str_replace(':' , '_' , $string);		
		$string = str_replace('[' , '_' , $string);		
		$string = str_replace(']' , '_' , $string);		
		$string = str_replace('|' , '_' , $string);		
		$string = str_replace('\\' , '_' , $string);		
		$string = str_replace('%' , '_' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '' , $string);	
		
		return $string;
				
	}
	
}
?>