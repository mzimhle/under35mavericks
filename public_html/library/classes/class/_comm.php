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
	
	public function sendNominator($file, $reference, $application, $subject) {

		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$data						= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('application', $application);
		$smarty->assign('message', $message);
		
		$template = $smarty->fetch($file);
		
		$mail->setFrom('nominations@under35mavericks.com', 'Maverick Awards Nominations'); //EDIT!!											
		$mail->addTo($application['application_nominator_email']);
		if($application['application_active'] == 1) {
			$mail->addTo('nominations@under35mavericks.com');
			$mail->addTo($application['application_email']);
		}
		$mail->setSubject($subject);
		$mail->setBodyHtml($template);			

		/* Save data to the comms table. */
		$data['application_code']		= $application['application_code'];
		$data['_comm_type']				= 'EMAIL';
		$data['_comm_name']			= $subject;
		$data['_comm_sent']				= null;
		$data['_comm_email']			= $application['application_nominator_email'];
		$data['_comm_cellphone']		= $application['application_nominator_cellphone'];
		$data['_comm_html']				= $template;
		$data['_comm_reference']		= $reference;
		$data['_comm_message']		= '';
		
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
	
	public function sendEntry($file, $reference, $application, $subject) {

		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$data						= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('tracking', $data['_comm_code']);
		$smarty->assign('application', $application);
		$smarty->assign('message', $message);
		
		$template = $smarty->fetch($file);
		
		$mail->setFrom('entries@under35mavericks.com', 'Maverick Awards Entries'); //EDIT!!											
		$mail->addTo($application['application_email']);
		if($application['application_active'] == 1) {
			$mail->addTo('entries@under35mavericks.com');
		}
		$mail->setSubject($subject);
		$mail->setBodyHtml($template);			

		/* Save data to the comms table. */
		$data['application_code']		= $application['application_code'];
		$data['_comm_type']				= 'EMAIL';
		$data['_comm_name']			= $subject;
		$data['_comm_sent']				= null;
		$data['_comm_email']			= $application['application_email'];
		$data['_comm_cellphone']		= $application['application_cellphone'];
		$data['_comm_html']				= $template;
		$data['_comm_reference']		= $reference;
		$data['_comm_message']		= '';
		
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
	
	public function sendComm($file, $message, $subject, $attachment = array()) {

		global $smarty;
		
		require_once('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$data						= array();
		$data['_comm_code']	= $this->createReference();
		
		$smarty->assign('message', $message);
		$smarty->assign('tracking', $data['_comm_code']);
		
		$template = $smarty->fetch($file);
		
		/* Check for attachements. */
		for($i=0; $i < count($attachment); $i++) {		
			$at = new Zend_Mime_Part(file_get_contents($attachment[$i]['path']));
			$at->disposition = Zend_Mime::DISPOSITION_INLINE;
			$at->encoding = Zend_Mime::ENCODING_BASE64;
			$at->filename = $attachment[$i]['name'];

			$mail->addAttachment($at);
		}
		
		$mail->setFrom('admin@willow-nettica.co.za', 'Admin Mail'); //EDIT!!											
		$mail->addTo('bokang@under35mavericks.com');
		$mail->addTo('admin@willow-nettica.co.za');
		//$mail->addTo('mzimhle.mosiwe@gmail.com');
		$mail->setSubject($subject);
		$mail->setBodyHtml($template);			

		/* Save data to the comms table. */
		$data['_comm_type']			= 'EMAIL';
		$data['_comm_name']			= $subject;
		$data['_comm_sent']			= null;
		$data['_comm_email']		= 'bokang@under35mavericks.com';
		$data['_comm_html']			= $template;
		$data['_comm_reference']	= 'CRON_NOMINATIONS';
		
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