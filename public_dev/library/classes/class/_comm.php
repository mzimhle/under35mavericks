<?php

//custom account item class as account table abstraction
class class_comm extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 		= '_comm';
	protected $_primary	= '_comm_code';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        $data['_comm_added'] 	= date('Y-m-d H:i:s');
        $data['_comm_code'] 	= isset($data['_comm_code']) ? $data['_comm_code'] : $this->createReference();        		
		
		return parent::insert($data);		
    }
	
	/**
	 * get job by job _comm Id
 	 * @param string job id
     * @return object
	 */
	public function viewComm($code) {
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))				
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')		
					->where('_comm_code = ?', $code)					
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get job by job _comm Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{		
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))				
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')				
					->where('_comm_code = ?', $code)					
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	public function getAll($where = '_comm_added != \'\'', $order = '_comm_added asc') {		
	
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))	
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')
					->where($where)
					->order($order);	

		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function sendEmail($participant, $message, $subject, $file) {

		// require 'config/smarty.php';
		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$data						= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('participant', $participant);
		$smarty->assign('message', $message);
		$smarty->assign('domain', $_SERVER['HTTP_HOST']);
		
		$template = $smarty->fetch($file);
		
		$mail->setFrom('info@bizlounge.co.za', 'Business Lounge'); //EDIT!!											
		$mail->addTo($participant['participant_email']);
		$mail->setSubject($subject);
		$mail->setBodyHtml($template);			

		/* Save data to the comms table. */
		$data['participant_code']			= $participant['participant_code'];
		$data['_comm_type']				= 'EMAIL';
		$data['_comm_name']			= $participant['participant_name'];
		$data['_comm_sent']				= null;
		$data['_comm_email']			= $participant['participant_email'];
		$data['_comm_html']				= $template;
		$data['_comm_reference']		= $participant['reference'];
		$data['_custom_category'] 		= isset($participant['category']) ? $participant['category'] : null;
		$data['_custom_reference'] 	= isset($participant['_custom_reference']) ? $participant['_custom_reference'] : null;
		$data['enquiry_code'] 			= isset($participant['enquiry_code']) ? $participant['enquiry_code'] : null;
		$data['enquiry_code'] 			= isset($participant['enquiry_code']) ? $participant['enquiry_code'] : null;
				
		$this->insert($data);

		try {		
			$mail->send();
			$data['_comm_sent']	= 1;	
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']		= 0;	
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		$mail = null; unset($mail);
		$return = $data['_comm_sent'] == 1 ? $data['_comm_code'] : false;
		return $return;
	}
	
	public function sendCampaign($participantData, $campaignData) {
		
		require_once('Zend/Mail.php');
		
		$mail = null; unset($mail);
		$mail = new Zend_Mail();

		$data				= array();
		$data['_comm_code']	= $this->createReference();
		
		$message = $campaignData['campaign_html'];
		
		$message = str_replace('[fullname]', $participantData['participant_name'], $message);
		$message = str_replace('[cellphone]', $participantData['participant_cellphone'], $message);
		$message = str_replace('[email]', $participantData['participant_email'], $message);
		$message = str_replace('[area]', $participantData['areapost_name'], $message);
		$message = str_replace('[tracking]', $data['_comm_code'], $message);
		$message = str_replace('[datetime]', date("F j, Y, g:i a"), $message);
		
		$mail->setFrom('info@under35mavericks.com', 'Under 25 Mavericks'); //EDIT!!
		$mail->addTo($participantData['participant_email']);
		$mail->setSubject($campaignData['campaign_subject']);
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['participant_code']	= $participantData['participant_code'];
		$data['_comm_type']			= 'EMAIL';
		$data['_comm_email']		= trim($participantData['participant_email']);
		$data['_comm_cellphone']	= trim($participantData['participant_cellphone']);
		$data['_comm_output']		= '';
		$data['campaign_code']		= $campaignData['campaign_code'];
		$data['_comm_sent']			= null;
		$data['_comm_html']			= str_replace($data['_comm_code'], '', $message);
		$data['_comm_name']		= $campaignData['campaign_name'];
		$data['_comm_reference']	= 'CAMPAIGN';

		$this->insert($data);
		$return = false;
		
		try {
			$mail->send();
			$data['_comm_sent']	= 1;
			$return = $data['_comm_code'];
			$data['_comm_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comm_sent']	= 0;	
			$return = 0;
			$data['_comm_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comm_code = ?', $data['_comm_code']);
		$success = $this->update($data, $where);
		
		return $return;
	}
	
	public function getByCampaign($code) {
		$select = $this->_db->select()	
					->from(array('_comm' => '_comm'))	
					->joinLeft('participant', 'participant.participant_code = _comm.participant_code and participant_deleted = 0')	
					->joinLeft(array('areapost' => 'areapost'), 'areapost.areapost_code = participant.areapost_code')
					->where('_comm.campaign_code = ?', $code);	

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
						->from(array('_comm' => '_comm'))		
					   ->where('_comm_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;				   		
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "123456789";

		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<15;$i++) {
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

	function reference() {
		return date('Y-m-d-H:i:s');
	}	
}
?>