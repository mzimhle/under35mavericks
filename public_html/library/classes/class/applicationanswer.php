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
require_once 'class/awardquestion.php';

//custom enquiry item class as enquiry table abstraction
class class_applicationanswer extends Zend_Db_Table_Abstract
{
	//declare table variables
    protected $_name 		= 'applicationanswer';
	
	public $_awardsubsection	= null;
	public $_awardsection		= null;
	public $_awardquestion		= null;
	
	function init()	{
		$this->_awardsubsection	= new class_awardsubsection();
		$this->_awardsection			= new class_awardsection();
		$this->_awardquestion		= new class_awardquestion();
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
        $data['applicationanswer_added'] = date('Y-m-d H:i:s');
        $data['applicationanswer_code'] 	= $this->createCode();
		
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
        $data['applicationanswer_updated'] = date('Y-m-d H:i:s');
		
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
						->from(array('applicationanswer' => 'applicationanswer'))	
						->joinLeft(array('application' => 'application'), 'application.application_code = applicationanswer.applicationanswer_reference and application_deleted = 0')
					   ->where('applicationanswer_code = ?', $reference)
					   ->where('applicationanswer_deleted = 0')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	public function answeredQuestions($year, $application) {
	
		$select = $this->_db->select()	
						->from(array('applicationanswer' => 'applicationanswer'))
						->joinLeft('awardquestion', 'awardquestion.awardquestion_code = applicationanswer.awardquestion_code', array('awardquestion_name', 'awardsubsection_code'))
						->joinLeft('awardsubsection', 'awardsubsection.awardsubsection_code = awardquestion.awardsubsection_code', array('awardsubsection_name', 'awardsubsection_code'))
						->joinLeft('awardsection', 'awardsection.awardsection_code = awardsubsection.awardsection_code', array('awardsection_name', 'awardsection_code', 'year_code'))
						->where('awardsection.year_code = ?', $year)
						->where('applicationanswer.application_code = ?', $application)
						->where('awardquestion_deleted = 0 and awardsubsection_deleted = 0 and awardquestion_deleted = 0 and applicationanswer_deleted = 0')
						->group('awardquestion_code');
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function answersBySubSection($subsubsection, $application) {
	
		$select = $this->_db->select()	
						->from(array('applicationanswer' => 'applicationanswer'))
						->joinLeft('awardquestion', 'awardquestion.awardquestion_code = applicationanswer.awardquestion_code', array('awardquestion_name', 'awardsubsection_code'))
						->where('awardquestion.awardsubsection_code = ?', $subsubsection)
						->where('applicationanswer.application_code = ?', $application)
						->where('awardquestion_deleted = 0 and applicationanswer_deleted = 0')
						->group('awardquestion_code');
	
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getAnswers($year, $application) {
		
		$sections = $this->_awardsection->getByYear($year);
		
		if($sections) {
			for($s = 0; $s < count($sections); $s++) {
				
				$subsections = $this->_awardsubsection->getBySection($sections[$s]['awardsection_code']);
				
				if($subsections) {
					
					for($sub = 0; $sub < count($subsections); $sub++) {
						
						$sections[$s]['subsections'][$sub] = $subsections[$sub];
						
						$answer = $this->answersBySubSection($subsections[$sub]['awardsubsection_code'], $application);
						
						if($answer) {
							$sections[$s]['subsections'][$sub]['answer'] = $answer;
						}

					}
				}
			}
		} else {
			return false;
		}

		return $sections;
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('applicationanswer' => 'applicationanswer'))	
					   ->where('applicationanswer_code = ?', $reference)
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