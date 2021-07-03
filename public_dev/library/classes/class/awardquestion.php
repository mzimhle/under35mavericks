<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
require_once 'class/awardsubsection.php';
require_once 'class/awardsection.php';

//custom enquiry item class as enquiry table abstraction
class class_awardquestion extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= 'awardquestion';
	protected $_primary	= 'awardquestion_code';
	
	public $_awardsubsection	= null;
	public $_awardsection		= null;
	
	function init()	{
		$this->_awardsubsection	= new class_awardsubsection();
		$this->_awardsection			= new class_awardsection();
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
        $data['awardquestion_added'] 	= date('Y-m-d H:i:s');
        $data['awardquestion_code'] 	= $this->createCode();
		$data['awardquestion_index'] 	= $this->getLastIndex($data['awardsubsection_code'])+1;
		
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
        $data['awardquestion_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getLastIndex($awardsubsection) {
	
		$select = $this->_db->select()	
						->from(array('awardquestion' => 'awardquestion'), array('max(awardquestion_index) as awardquestion_index'))	
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code', array())
						->where('awardquestion.awardsubsection_code = ?', $awardsubsection)
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0');
	
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? 0 : $result['awardquestion_index'];
		
	}
	
	public function askQuestion($year) {
	
		$select = $this->_db->select()	
						->from(array('awardquestion' => 'awardquestion'), array('max(awardquestion_index) as awardquestion_index', 'awardquestion_name'))	
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code', array('awardsubsection_name', 'awardsubsection_code'))
						->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code', array('awardsection_name', 'awardsection_code', 'year_code'))
						->where('awardsection.year_code = ?', $year)
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0')
						->group('awardquestion_code');
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getQuestions($year) {
		
		$sections = $this->_awardsection->getByYear($year);
		
		if($sections) {
			for($s = 0; $s < count($sections); $s++) {
				
				$subsections = $this->_awardsubsection->getBySection($sections[$s]['awardsection_code']);
				
				if($subsections) {
					
					for($sub = 0; $sub < count($subsections); $sub++) {
						
						$sections[$s]['subsections'][$sub] = $subsections[$sub];
						
						$question = $this->getBySubSection($subsections[$sub]['awardsubsection_code']);
						
						if($question) {
							$sections[$s]['subsections'][$sub]['question'] = $question;
						}

					}
				}
			}
		} else {
			return false;
		}

		return $sections;
	}
		
	
	public function getAll() {
	
		$select = $this->_db->select()	
						->from(array('awardquestion' => 'awardquestion'))	
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code')
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0')
						->where('awardquestion_active = 1 and awardsubsection_active = 1')
					   ->order(array('awardsubsection.awardsubsection_code desc', 'awardquestion_name'));
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getBySubSection($section) {
	
		$select = $this->_db->select()	
						->from(array('awardquestion' => 'awardquestion'))	
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code')
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0')
						->where('awardquestion_active = 1 and awardsubsection_active = 1')
						->where('awardquestion.awardsubsection_code = ?', $section)
					   ->order(array('awardquestion_name'));
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code) {
		$select = $this->_db->select()	
						->from(array('awardquestion' => 'awardquestion'))	
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code')
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0')
						->where('awardquestion_active = 1 and awardsubsection_active = 1')
					   ->where('awardquestion_code = ?', $code)					   
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
						->from(array('awardquestion' => 'awardquestion'))	
					   ->where('awardquestion_code = ?', $code)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	 public function pairs() {

		$select = $this->select()
					   ->from(array('awardquestion' => 'awardquestion'), array('awardquestion.awardquestion_code', 'awardquestion.awardquestion_name'))
					   ->where('awardquestion_deleted = 0')
					   ->order('awardquestion_name ASC');

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