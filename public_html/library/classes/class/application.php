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
		$data['application_hash']		= md5(date('Y-m-d H:i:s').$data['application_code']);
		$data['application_active']		= 0;
		
		$success = parent::insert($data);
		
		if($success) {
			
			$applicationData = $this->getByCode($success);
			
			if($applicationData) {				
				/* Send email. */
				switch($applicationData['application_type']) {
					case 'ENTRY' : 
							$this->_comm->sendEntry(realpath(__DIR__.'/../../../../public_html/').'/templates/awards_entry_activate.html', 'AWARDS_ENTRY_ACTIVATE', $applicationData, 'Awards Entry Application - Verification');
							
							/* Add information to mailbok. */
							$mail = array('name' => $applicationData['application_name'], 'surname' => $applicationData['application_surname'], 'email' => $applicationData['application_email'], 'cell' => $applicationData['application_cellphone'], 'code' => $applicationData['application_code']);
							$this->mailbok($mail, '75691486', 'add');
					break;
					case 'NOMINATION' : 
							$this->_comm->sendNominator(realpath(__DIR__.'/../../../../public_html/').'/templates/awards_nomination_activate.html', 'AWARDS_NOMINATION_ACTIVATE', $applicationData, 'Awards Nomination Application - Verification');
							
							$mail = array('name' => $applicationData['application_nominator_name'], 'surname' => '', 'email' => $applicationData['application_nominator_email'], 'cell' => $applicationData['application_nominator_cellphone'], 'code' => $applicationData['application_code']);
							$this->mailbok($mail, '63874554', 'add');
							
							$mail = array('name' => $applicationData['application_name'], 'surname' => $applicationData['application_surname'], 'email' => $applicationData['application_email'], 'cell' => $applicationData['application_cellphone'], 'code' => $applicationData['application_code']);
							$this->mailbok($mail, '75691486', 'add');							
					break;
				}
				return 	$success;	
			} else {
				return false;
			}
		} else {
			return false;
		}
    }
	
	public function mailbok(array $data, $client, $type = 'add') {
		
		$url = "http://www.mailbok.co.za/webservice/paticipant";

		$data = array(
			'username' => 'mzimhle@under35mavericks.com',
			'password' => 'uhc2sl',
			'client' => $client,
			'subscriber_name' => $data['name'],
			'subscriber_surname' => $data['surname'],
			'subscriber_email' => $data['email'],
			'subscriber_cellphone' => $data['cell'],
			'subscriber_reference' => $data['code'],
			'type' => $type
		);

		foreach($data as $key=>$value) { $content .= $key.'='.$value.'&'; }

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		return json_decode($json_response, true);
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
	
	public function getByType($type, $code = '')	{
		
		if($code == '') {
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
		} else {
			
			$select = $this->_db->select()	
							->from(array('application' => 'application'))
							->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
							->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
							->joinLeft('participant', 'participant.participant_code = application.participant_code and participant_deleted = 0')
							->joinLeft('year', 'year.year_code = application.year_code')	
							->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')							
							->where('application_deleted = 0 and year_deleted = 0')
							->where('application_type = ?', $type)
							->where('application.application_code = ?', $code)
							->order(array('year_name', 'application_name'));			
			
		}
		
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}

	public function getByPreviousWeek($type)	{
	
		$select = $this->_db->select()
						->from(array('application' => 'application'))
						->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
						->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
						->joinLeft('participant', 'participant.participant_code = application.participant_code and participant_deleted = 0')
						->joinLeft('year', 'year.year_code = application.year_code')	
						->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')							
						->where('application_deleted = 0 and year_deleted = 0')
						->where('application_type = ?', $type)
						->where('application_added >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY and application_added < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY')
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
	public function getByCode($code, $status = null)
	{
		if($status == null) {
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
		} else {
			$select = $this->_db->select()	
							->from(array('application' => 'application'))	
							->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
							->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
							->joinLeft('year', 'year.year_code = application.year_code')						
							->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')	
							->where('application_deleted = 0 and year_deleted = 0')						
						   ->where('application.application_code = ?', $code)					   
						   ->where('application.application_status = ?', $status)
						   ->where('application_deleted = 0')
						   ->group('application.application_code')
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
	public function getByHash($code, $status = 1)
	{
			$select = $this->_db->select()	
							->from(array('application' => 'application'))	
							->joinLeft('areapost', 'areapost.areapost_code = application.areapost_code')
							->joinLeft('areapostregion', 'areapostregion.areapostregion_code = areapost.areapostregion_code')
							->joinLeft('year', 'year.year_code = application.year_code')						
							->joinLeft('category', 'category.category_code = application.category_code and category_deleted = 0')	
							->where('application_deleted = 0 and year_deleted = 0')						
						   ->where('application.application_hash = ?', $code)					   
						   ->where('application.application_active = ?', $status)	
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